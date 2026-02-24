<?php

namespace App\Http\Livewire;

use App\Models\ActionLog;
use Livewire\Component;
use App\Models\Biosample;
use App\Models\Bioarchive;
use App\Models\Bioexperiment;
use App\Models\Bioproject;
use App\Models\FileType;
use App\Models\Instrument;
use App\Models\LibraryLayout;
use App\Models\LibrarySelection;
use App\Models\LibrarySource;
use App\Models\LibraryStrategy;
use App\Models\Lab;
use App\Models\Center;
use Illuminate\Support\Str;

class EditBioarchive extends Component
{
    public $currentStep = 1;

    public $accession;
    public $bioarchiveId;

    // submitter
    public $submitter_name;
    public $submitter_email;
    public $submitter_lab;
    public $submitter_center;

    public $submitter_lab_name;
    public $submitter_center_name;

    // Filter table
    public $searchBioproject = '';
    public $searchBiosample = '';

    // submitter
    public $hold_release;

    // bioproject
    public $bioprojects;
    public $bioproject_id;

    // biosample
    public $biosamples;
    public $biosample_id = [];

    // bioexperiment
    public $bioexperiment_id = [];
    public $experimentAlias = [];

    // Lib Source
    public $libsources;
    // Lib Selection
    public $libselections;
    // Lib Strategy
    public $libstrategies;
    // Instrument
    public $instruments;
    // Lib Layout
    public $liblayouts;

    // Filetype (kept for parity, even if edit wizard doesn't use it yet)
    public $filetypes;

    // Alias prefix (6 chars) used for any new experiments added during edit
    public $alias;

    /**
     * Keep experiment rows in sync with the biosample checkbox selection.
     * Livewire checkbox binding can leave false/null entries in the array, so we normalize.
     */
    private function syncExperimentsToSelectedBiosamples(): void
    {
        $this->biosample_id = $this->normalizeSelectedBiosampleIds($this->biosample_id);

        $selected = array_flip(array_keys($this->biosample_id ?? []));

        foreach (array_keys($this->bioexperiment_id ?? []) as $biosampleId) {
            if (!isset($selected[(int) $biosampleId])) {
                unset($this->bioexperiment_id[$biosampleId]);
            }
        }

        foreach (array_keys($this->experimentAlias ?? []) as $biosampleId) {
            if (!isset($selected[(int) $biosampleId])) {
                unset($this->experimentAlias[$biosampleId]);
            }
        }

        $this->ensureExperimentRowsInitialized();
    }

    private function normalizeSelectedBiosampleIds($value): array
    {
        $normalized = [];
        foreach (($value ?? []) as $key => $val) {
            // most common shape: biosample_id.{id} => "{id}" when checked, false/null when unchecked
            if (is_numeric($key)) {
                if ($val === false || $val === null || $val === '' || $val === 0 || $val === '0') {
                    continue;
                }
                $id = (int) $key;
                $normalized[$id] = $id;
                continue;
            }

            // fallback shape: a numeric list of IDs
            if (is_numeric($val)) {
                $id = (int) $val;
                $normalized[$id] = $id;
            }
        }

        return $normalized;
    }

    private function normalizeHoldRelease($value): bool
    {
        if (is_bool($value)) return $value;
        if (is_int($value)) return $value === 1;
        if (is_string($value)) {
            $v = strtolower(trim($value));
            return in_array($v, ['1', 'true', 'yes', 'on'], true);
        }
        return false;
    }

    public function mount($accession)
    {
        $this->accession = $accession;

        $bioarchive = Bioarchive::where('accession', $accession)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $this->bioarchiveId = $bioarchive->id;

        // submitter
        $this->submitter_name = auth()->user()->name;
        $this->submitter_email = auth()->user()->email;
        $this->submitter_lab = auth()->user()->lab_id;
        $this->submitter_center = auth()->user()->center_id;
        $this->submitter_lab_name = Lab::where('id', $this->submitter_lab)->value('name');
        $this->submitter_center_name = Center::where('id', $this->submitter_center)->value('name');

        // load existing archive state
        $this->hold_release = $bioarchive->hold_release ? '1' : '0';
        $this->bioproject_id = $bioarchive->bioproject_id;

        $selectedBiosampleIds = [];
        foreach (array_filter(explode(',', (string) $bioarchive->biosample_id)) as $id) {
            if (is_numeric($id)) {
                $intId = (int) $id;
                $selectedBiosampleIds[$intId] = $intId;
            }
        }
        $this->biosample_id = $selectedBiosampleIds;

        // lookup lists
        $this->bioprojects = Bioproject::where('title', 'like', '%' . $this->searchBioproject . '%')->get();
        $this->biosamples = Biosample::where('draft', false)->get();
        $this->libsources = LibrarySource::all();
        $this->libselections = LibrarySelection::all();
        $this->libstrategies = LibraryStrategy::all();
        $this->instruments = Instrument::all();
        $this->liblayouts = LibraryLayout::all();
        $this->filetypes = FileType::all();

        // load existing experiments
        $experiments = Bioexperiment::where('bioarchive_id', $bioarchive->id)->get();
        foreach ($experiments as $exp) {
            $sampleId = (int) $exp->biosample_id;
            $this->experimentAlias[$sampleId] = $exp->alias;
            $this->bioexperiment_id[$sampleId] = [
                'title' => (string) ($exp->title ?? ''),
                'libname' => (string) ($exp->libname ?? ''),
                'libsource_id' => $exp->libsource_id ?? '',
                'libselection_id' => $exp->libselection_id ?? '',
                'libstrategy_id' => $exp->libstrategy_id ?? '',
                'libconsprot' => (string) ($exp->libconsprot ?? ''),
                'instrument_id' => $exp->instrument_id ?? 0,
                'liblayout_id' => $exp->liblayout_id ?? '',
                'inp_size' => $exp->input_size ?? '',
            ];
        }

        // determine alias prefix (keep the existing one if present)
        $this->alias = $this->extractAliasPrefix($this->experimentAlias) ?? Str::random(6);

        // ensure all selected biosamples have initialized experiment rows
        $this->ensureExperimentRowsInitialized();
    }

    private function extractAliasPrefix(array $aliasMap): ?string
    {
        foreach ($aliasMap as $alias) {
            if (!is_string($alias)) continue;
            if (preg_match('/^INNAX\-([A-Za-z0-9]{6})\-\d+$/', $alias, $m)) {
                return $m[1];
            }
        }
        return null;
    }

    private function ensureExperimentRowsInitialized(): void
    {
        $nextNo = $this->nextAliasNumber();

        foreach (array_keys($this->biosample_id ?? []) as $biosampleId) {
            if (!isset($this->bioexperiment_id[$biosampleId]) || !is_array($this->bioexperiment_id[$biosampleId])) {
                $this->bioexperiment_id[$biosampleId] = [];
            }

            $this->bioexperiment_id[$biosampleId] = array_merge([
                'title' => '',
                'libname' => '',
                'libsource_id' => '',
                'libselection_id' => '',
                'libstrategy_id' => '',
                'libconsprot' => '',
                'instrument_id' => 0,
                'liblayout_id' => '',
                'inp_size' => '',
            ], $this->bioexperiment_id[$biosampleId]);

            if (!isset($this->experimentAlias[$biosampleId]) || !$this->experimentAlias[$biosampleId]) {
                $this->experimentAlias[$biosampleId] = 'INNAX-' . $this->alias . '-' . $nextNo;
                $nextNo++;
            }
        }
    }

    private function nextAliasNumber(): int
    {
        $max = 0;
        foreach (($this->experimentAlias ?? []) as $alias) {
            if (!is_string($alias)) continue;
            if (preg_match('/\-(\d+)$/', $alias, $m)) {
                $num = (int) $m[1];
                if ($num > $max) $max = $num;
            }
        }
        return $max + 1;
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'hold_release' => 'required',
        ]);
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'bioproject_id' => 'required',
        ]);
        $this->currentStep = 3;
    }

    public function thirdStepSubmit()
    {
        // normalize selection first (prevents "unchecked but still present" rows)
        $this->syncExperimentsToSelectedBiosamples();

        $this->validate([
            'biosample_id' => 'required|array|min:1',
        ]);

        $this->currentStep = 4;
    }

    public function updatedBiosampleId()
    {
        // keep experiments/aliases synced whenever checkboxes change
        $this->syncExperimentsToSelectedBiosamples();
    }

    public function fourthStepSubmit()
    {
        $rules = [
            'bioexperiment_id' => 'array',
            'bioexperiment_id.*.title' => 'required|string',
            'bioexperiment_id.*.libname' => 'required|string',
            'bioexperiment_id.*.libsource_id' => 'required',
            'bioexperiment_id.*.libselection_id' => 'required',
            'bioexperiment_id.*.libstrategy_id' => 'required',
            'bioexperiment_id.*.libconsprot' => 'required|string',
            'bioexperiment_id.*.instrument_id' => 'required|not_in:0',
            'bioexperiment_id.*.liblayout_id' => 'required',
            'bioexperiment_id.*.inp_size' => 'required',
        ];

        $messages = [
            'bioexperiment_id.*.instrument_id.not_in' => 'Instrument is required.',
        ];

        $attributes = [
            'bioexperiment_id.*.title' => 'Title',
            'bioexperiment_id.*.libname' => 'Library Name',
            'bioexperiment_id.*.libsource_id' => 'Library Source',
            'bioexperiment_id.*.libselection_id' => 'Library Selection',
            'bioexperiment_id.*.libstrategy_id' => 'Library Strategy',
            'bioexperiment_id.*.libconsprot' => 'Library Construction Protocol',
            'bioexperiment_id.*.instrument_id' => 'Instrument',
            'bioexperiment_id.*.liblayout_id' => 'Library Layout',
            'bioexperiment_id.*.inp_size' => 'Insert Size',
        ];

        $this->validate($rules, $messages, $attributes);
        $this->currentStep = 5;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function submitForm()
    {
        // final validation before persisting
        $this->fourthStepSubmit();

        $bioarchive = Bioarchive::where('id', $this->bioarchiveId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $selectedIds = array_map('intval', array_keys($this->biosample_id ?? []));

        $bioarchive->hold_release = $this->normalizeHoldRelease($this->hold_release);
        $bioarchive->bioproject_id = $this->bioproject_id;
        $bioarchive->biosample_id = implode(',', $selectedIds);
        $bioarchive->draft = false;
        $bioarchive->status = 2; //submitted back after edit
        $bioarchive->save();

        $existing = Bioexperiment::where('bioarchive_id', $bioarchive->id)->get()->keyBy(function ($row) {
            return (int) $row->biosample_id;
        });

        $keepIds = array_flip($selectedIds);

        // upsert selected experiments
        foreach ($selectedIds as $biosampleId) {
            $row = $this->bioexperiment_id[$biosampleId] ?? [];

            $payload = [
                'bioarchive_id' => $bioarchive->id,
                'biosample_id' => $biosampleId,
                'alias' => $this->experimentAlias[$biosampleId] ?? ('INNAX-' . $this->alias . '-' . $this->nextAliasNumber()),
                'title' => $row['title'] ?? null,
                'libname' => $row['libname'] ?? null,
                'libsource_id' => $row['libsource_id'] ?? null,
                'libselection_id' => $row['libselection_id'] ?? null,
                'libstrategy_id' => $row['libstrategy_id'] ?? null,
                'libconsprot' => $row['libconsprot'] ?? null,
                'instrument_id' => $row['instrument_id'] ?? null,
                'liblayout_id' => $row['liblayout_id'] ?? null,
                'input_size' => $row['inp_size'] ?? null,
            ];

            if (isset($existing[$biosampleId])) {
                // keep existing alias stable if already present
                $payload['alias'] = $existing[$biosampleId]->alias;
                $existing[$biosampleId]->update($payload);
            } else {
                Bioexperiment::create($payload);
            }
        }

        // delete removed experiments
        foreach ($existing as $biosampleId => $exp) {
            if (!isset($keepIds[$biosampleId])) {
                $exp->delete();
            }
        }

        ActionLog::create([
            'action' => "bioarchiveEdited",
            'type' => 'Bioarchive',
            'item_id' => $bioarchive->accession,
            'user_target'=> $bioarchive->curator_id,
            'created_by' =>auth()->id(),
            'desc' => null,
        ]);

        session()->flash('message', 'Bioarchive successfully updated.');
        return redirect()->to('/dashboard/bioarchives/' . $bioarchive->accession);
    }

    public function removeBiosample($index)
    {
        unset($this->biosample_id[$index]);
        unset($this->bioexperiment_id[$index]);
        unset($this->experimentAlias[$index]);
    }

    public function bioprojectName($id)
    {
        return Bioproject::select('accession')->where('id', $id)->pluck('accession')->first();
    }

    public function biosampleName($id)
    {
        return Biosample::select('accession')->where('id', $id)->pluck('accession')->first();
    }

    public function biosampleSubmission($id)
    {
        return Biosample::select('submission_id')->where('id', $id)->pluck('submission_id')->first();
    }

    public function libsourceName($id)
    {
        if (!is_numeric($id) || (int) $id <= 0) {
            return '';
        }
        return LibrarySource::select('name')->where('id', $id)->pluck('name')->first();
    }

    public function libselectionName($id)
    {
        if (!is_numeric($id) || (int) $id <= 0) {
            return '';
        }
        return LibrarySelection::select('name')->where('id', $id)->pluck('name')->first();
    }

    public function libstrategyName($id)
    {
        if (!is_numeric($id) || (int) $id <= 0) {
            return '';
        }
        return LibraryStrategy::select('name')->where('id', $id)->pluck('name')->first();
    }

    public function instrumentName($id)
    {
        if (!is_numeric($id) || (int) $id <= 0) {
            return '';
        }
        return Instrument::select('name')->where('id', $id)->pluck('name')->first();
    }

    public function liblayoutName($id)
    {
        if (!is_numeric($id) || (int) $id <= 0) {
            return '';
        }
        return LibraryLayout::select('name')->where('id', $id)->pluck('name')->first();
    }

    public function render()
    {
        // refresh lists for search filter usage
        $this->bioprojects = Bioproject::where('title', 'like', '%' . $this->searchBioproject . '%')->get();

        $biosampleQuery = Biosample::where('draft', false);
        if ($this->searchBiosample !== '') {
            $biosampleQuery->where('title', 'like', '%' . $this->searchBiosample . '%');
        }
        $this->biosamples = $biosampleQuery->get();

        return view('livewire.bioarchive.edit');
    }
}

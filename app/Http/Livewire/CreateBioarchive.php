<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Biosample;
use App\Models\Bioarchive;
use App\Models\Bioexperiment;
use App\Models\Bioproject;
use App\Models\Biorun;
use App\Models\FileType;
use App\Models\Instrument;
use App\Models\LibraryLayout;
use App\Models\LibrarySelection;
use App\Models\LibrarySource;
use App\Models\LibraryStrategy;
use App\Models\Lab;
use App\Models\Center;
use Illuminate\Support\Str;
use App\Models\BioarchiveDraft;

class CreateBioarchive extends Component
{


    public $currentStep = 1;
    public $draftId = null;

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
    public $experiments = [];
    public $bioexperiment_id = [];

    // biorun
    public $biorun_id = [];

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

    // Filetype
    public $filetypes;

    // Alias number
    public $alias;

    public function mount()
    {
        // submitter 
        $this->submitter_name = auth()->user()->name;
        $this->submitter_email = auth()->user()->email;
        // $this->submitter_lab = auth()->user()->lab->name;
        // $this->submitter_center = auth()->user()->lab->center->name;
        $this->submitter_lab = auth()->user()->lab_id;
        $this->submitter_center = auth()->user()->center_id;


        $this->submitter_lab_name = Lab::where('id', $this->submitter_lab)->value('name');
        $this->submitter_center_name = Center::where('id', $this->submitter_center)->value('name');
        // bioproject
        // $this->bioprojects = Bioproject::get();
        $this->bioprojects = Bioproject::where('title', 'like', '%' . $this->searchBioproject . '%')->get();

        // biosample
        $this->biosamples = Biosample::where('draft', false)->get();
        // lib source 
        $this->libsources = LibrarySource::all();
        // lib selection
        $this->libselections = LibrarySelection::all();
        // lib strategies
        $this->libstrategies = LibraryStrategy::all();
        // Instrument
        $this->instruments = Instrument::all();
        // lib layouts
        $this->liblayouts = LibraryLayout::all();
        // file type
        $this->filetypes = FileType::all();
        // generate alias
        $this->alias = Str::random(6);

        // Auto-load the latest draft for this user (if any)
        try {
            $latest = BioarchiveDraft::where('user_id', auth()->id())->where('status', 'draft')->first();
            if ($latest) {
                $this->loadDraft($latest->id);
            }
        } catch (\Exception $e) {
            // don't break mounting if drafts table/migration doesn't exist yet
            logger()->debug('bioarchive draft autoload skipped: ' . $e->getMessage());
        }
    }

    // Submitter form
    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'hold_release' => 'required',
        ]);
        // dd($this->hold_release);
        $this->currentStep = 2;
    }
    // Bioproject form
    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'bioproject_id' => 'required',
        ]);
        $this->currentStep = 3;
    }
    // Biosample form
    public function thirdStepSubmit()
    {
        $validatedData = $this->validate([
            'biosample_id' => 'required',
        ]);
        // dd($this->biosample_id);
        // dd($this->searchBioproject);
        $this->currentStep = 4;
    }
    // Run form
    public function fourthStepSubmit()
    {
        $validatedData = $this->validate([
            'bioexperiment_id' => 'required',
            'bioexperiment_id.*.liblayout_id' => 'required',
        ]);
        // foreach ($this->biosample_id as $key => $value) {
        //     $this->biorun_id['sample_id'] = $value;
        // }
        // dd($this->bioexperiment_id);
        // dd($this->biorun_id);
        $this->currentStep = 5;
    }
    // preview
    public function fifthStepSubmit()
    {
        // dd($this->biorun_id);
        $this->currentStep = 6;
        // dd($this->bioexperiment_id);
        // dd($this->biorun_id);
    }
    public function back($step)
    {
        $this->currentStep = $step;
    }
    public function submitForm()
    {
        $bioarchive = new Bioarchive();
        $bioarchive->accession = 'INNAAR' . sprintf('%06d', intval($bioarchive->query()->max("id")) + 1);
        $bioarchive->submission_id = 'SUBINNAAR' . sprintf('%06d', intval($bioarchive->query()->max("id")) + 1);
        $bioarchive->bioproject_id = $this->bioproject_id;
        $bioarchive->biosample_id = implode(",", $this->biosample_id);
        $bioarchive->user_id = auth()->user()->id;
        $bioarchive->hold_release = $this->hold_release;
        // $bioarchive->draft = true;
        $bioarchive->save();
        // dd($bioarchive);
        // dd($this->bioexperiment_id);
        $no = 1;
        foreach ($this->bioexperiment_id as $item => $value) {
            $dataExp = [
                'bioarchive_id' => $bioarchive->id,
                'biosample_id' => $item,
                'alias' => "INNAX-" . $this->alias . "-" . $no,
                'title' => $this->bioexperiment_id[$item]['title'],
                'libname' => $this->bioexperiment_id[$item]['libname'],
                'libsource_id' => $this->bioexperiment_id[$item]['libsource_id'],
                'libselection_id' => $this->bioexperiment_id[$item]['libselection_id'],
                'libstrategy_id' => $this->bioexperiment_id[$item]['libstrategy_id'],
                'libconsprot' => $this->bioexperiment_id[$item]['libconsprot'],
                'instrument_id' => $this->bioexperiment_id[$item]['instrument_id'],
                'liblayout_id' => $this->bioexperiment_id[$item]['liblayout_id'],
                'input_size' => $this->bioexperiment_id[$item]['inp_size'],
            ];
            $no++;
            $bioexp = Bioexperiment::create($dataExp);
        }
        session()->flash('message', 'Bioarchive successfully created.');
        // return redirect()->to('/dashboard/bioarchives/' . $bioarchive->accession);
        return redirect()->to('/dashboard/bioarchives');
    }

    /**
     * Save current component state as a draft for the authenticated user.
     */
    public function saveDraft()
    {
        $payload = [
            'currentStep' => $this->currentStep,
            'hold_release' => $this->hold_release,
            'bioproject_id' => $this->bioproject_id,
            'biosample_id' => $this->biosample_id,
            'bioexperiment_id' => $this->bioexperiment_id,
            'alias' => $this->alias,
        ];

        if ($this->draftId) {
            $draft = BioarchiveDraft::where('id', $this->draftId)->where('user_id', auth()->id())->first();
            if ($draft) {
                $draft->update([
                    'data' => $payload,
                    'status' => 'draft',
                    'title' => $draft->title ?? 'Bioarchive draft ' . now()->toDateTimeString(),
                ]);
            } else {
                $draft = BioarchiveDraft::create([
                    'user_id' => auth()->id(),
                    'title' => 'Bioarchive draft ' . now()->toDateTimeString(),
                    'data' => $payload,
                    'status' => 'draft',
                ]);
            }
        } else {
            $draft = BioarchiveDraft::create([
                'user_id' => auth()->id(),
                'title' => 'Bioarchive draft ' . now()->toDateTimeString(),
                'data' => $payload,
                'status' => 'draft',
            ]);
        }

        $this->draftId = $draft->id;

        $this->dispatchBrowserEvent('ajax-alert', ['type' => 'success', 'message' => 'Draft saved']);
    }

    /**
     * Load a draft into the component state. Only loads drafts owned by the user.
     */
    public function loadDraft($id)
    {
        $draft = BioarchiveDraft::where('id', $id)->where('user_id', auth()->id())->first();
        if (! $draft) {
            $this->dispatchBrowserEvent('ajax-alert', ['type' => 'danger', 'message' => 'Draft not found']);
            return;
        }

        $this->draftId = $draft->id;
        $data = $draft->data ?? [];
        // restore basic fields (guarded with null coalescing)
        $this->currentStep = $data['currentStep'] ?? $this->currentStep;
        $this->hold_release = $data['hold_release'] ?? $this->hold_release;
        $this->bioproject_id = $data['bioproject_id'] ?? $this->bioproject_id;
        $this->biosample_id = $data['biosample_id'] ?? $this->biosample_id;
        $this->bioexperiment_id = $data['bioexperiment_id'] ?? $this->bioexperiment_id;
        $this->alias = $data['alias'] ?? $this->alias;

        // notify front-end in case client-side JS needs to adjust dynamic controls
        $this->dispatchBrowserEvent('draft-loaded', ['draft' => $data]);
        $this->dispatchBrowserEvent('ajax-alert', ['type' => 'success', 'message' => 'Draft loaded']);
    }

    /**
     * Permanently delete the current draft for this user and clear draftId.
     */
    public function discardDraft()
    {
        if (! $this->draftId) {
            $this->dispatchBrowserEvent('ajax-alert', ['type' => 'warning', 'message' => 'No draft to discard']);
            return;
        }

        try {
            $draft = BioarchiveDraft::where('id', $this->draftId)->where('user_id', auth()->id())->first();
            if ($draft) {
                $draft->delete();
                $this->draftId = null;
                $this->dispatchBrowserEvent('draft-discarded');
                $this->dispatchBrowserEvent('ajax-alert', ['type' => 'success', 'message' => 'Draft discarded']);
            } else {
                $this->dispatchBrowserEvent('ajax-alert', ['type' => 'danger', 'message' => 'Draft not found']);
            }
        } catch (\Exception $e) {
            logger()->error('Failed to discard bioarchive draft: ' . $e->getMessage());
            $this->dispatchBrowserEvent('ajax-alert', ['type' => 'danger', 'message' => 'Failed to discard draft']);
        }
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
        return LibrarySource::select('name')->where('id', $id)->pluck('name')->first();
    }

    public function libselectionName($id)
    {
        return LibrarySelection::select('name')->where('id', $id)->pluck('name')->first();
    }
    public function libstrategyName($id)
    {
        return LibraryStrategy::select('name')->where('id', $id)->pluck('name')->first();
    }
    public function instrumentName($id)
    {
        return Instrument::select('name')->where('id', $id)->pluck('name')->first();
    }
    public function liblayoutName($id)
    {
        return LibraryLayout::select('name')->where('id', $id)->pluck('name')->first();
    }
    public function filetypeName($id)
    {
        return FileType::select('name')->where('id', $id)->pluck('name')->first();
    }

    public function removeBiosample($index)
    {
        unset($this->biosample_id[$index]);
        unset($this->bioexperiment_id[$index]);
    }
    public function render()
    {
        return view('livewire.bioarchive.create');
    }
}

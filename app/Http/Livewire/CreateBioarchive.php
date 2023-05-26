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
use Illuminate\Support\Str;

class CreateBioarchive extends Component
{


    public $currentStep = 1;

    // submitter 
    public $submitter_name;
    public $submitter_email;
    public $submitter_lab;
    public $submitter_center;

    // Filter table
    public $searchBioproject = '';
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
        $this->submitter_lab = auth()->user()->lab->name;
        $this->submitter_center = auth()->user()->lab->center->name;
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
        dd($this->searchBioproject);
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
        $bioarchive->draft = true;
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

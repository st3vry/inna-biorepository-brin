<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Biosample;
use App\Models\Bioarchive;
use App\Models\Bioproject;
use App\Models\FileType;
use App\Models\Instrument;
use App\Models\LibraryLayout;
use App\Models\LibrarySelection;
use App\Models\LibrarySource;
use App\Models\LibraryStrategy;
use Livewire\WithPagination;

class CreateBioarchive extends Component
{

    public $currentStep = 1;

    // submitter 
    public $submitter_name;
    public $submitter_email;
    public $submitter_lab;
    public $submitter_center;

    // Filter table
    public $search = '';
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

    public function mount()
    {
        // submitter 
        $this->submitter_name = auth()->user()->name;
        $this->submitter_email = auth()->user()->email;
        $this->submitter_lab = auth()->user()->lab->name;
        $this->submitter_center = auth()->user()->lab->center->name;
        // bioproject
        $this->bioprojects = Bioproject::search($this->search)->get();
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
        // dd($this->bioproject_id);
        $this->currentStep = 3;
    }
    // Biosample form
    public function thirdStepSubmit()
    {
        $validatedData = $this->validate([
            'biosample_id' => 'required',
        ]);
        // dd($this->biosample_id);
        $this->currentStep = 4;
    }
    // Run form
    public function fourthStepSubmit()
    {
        $validatedData = $this->validate([
            'bioexperiment_id' => 'required',
            'bioexperiment_id.*.alias_exp' => 'required',
            'bioexperiment_id.*.liblayout_id' => 'required',
        ]);
        foreach ($this->biosample_id as $key => $value) {
            $this->biorun_id[] = $value;
        }
        // dd($this->biorun_id);
        $this->currentStep = 5;
    }
    // preview
    public function fifthStepSubmit()
    {
        // dd($this->biorun_id);
        $this->currentStep = 6;
    }
    public function back($step)
    {
        $this->currentStep = $step;
    }
    public function submitForm()
    {
        $bioarchive = new Bioarchive();

        $bioarchive->accession = 'INA' . sprintf('%06d', intval($bioarchive->query()->max("id")) + 1);
        $bioarchive->submission_id = 'SUBINA' . sprintf('%06d', intval($bioarchive->query()->max("id")) + 1);
        $bioarchive->bioproject_id = $this->bioproject_id;

        dd($bioarchive);
    }

    public function bioprojectName($id)
    {
        return Bioproject::select('accession')->where('id', $id)->pluck('accession')->first();
    }

    public function biosampleName($id)
    {
        return Biosample::select('title')->where('id', $id)->pluck('title')->first();
    }

    public function biosampleSubmission($id)
    {
        return Biosample::select('submission_id')->where('id', $id)->pluck('submission_id')->first();
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

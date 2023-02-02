<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Biosample;
use App\Models\Bioarchive;
use App\Models\Bioproject;
use App\Models\Instrument;
use App\Models\LibraryLayout;
use App\Models\LibrarySelection;
use App\Models\LibrarySource;
use App\Models\LibraryStrategy;
use Livewire\WithPagination;

class CreateBioarchive extends Component
{

    public $currentStep = 1;
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
    // Lib Source
    public $libsources;
    // Lib Selection
    public $libselections;
    // Lib Strategy
    public $libstrategies;
    // Instrument
    public $instruments;
    // Layout
    public $layouts;

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
    }
    // Submitter form
    public function firstStepSubmit()
    {
        $this->currentStep = 2;
    }
    // Bioproject form
    public function secondStepSubmit()
    {
        $this->currentStep = 3;
    }
    // Biosample form
    public function thirdStepSubmit()
    {
        $this->currentStep = 4;
    }
    // Run form
    public function fourthStepSubmit()
    {
        $this->currentStep = 5;
    }
    // preview
    public function fifthStepSubmit()
    {
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
    }

    public function biosampleName($id)
    {
        return Biosample::select('title')->where('id', $id)->pluck('title')->first();
    }

    public function biosampleAccession($id)
    {
        return Biosample::select('accession')->where('id', $id)->pluck('accession')->first();
    }

    public function removeBiosample($biosample_id)
    {
        // dd($this->biosample_id);
        if (in_array($biosample_id, $this->biosample_id)) {
            $this->biosample_id = array_diff($this->biosample_id, array($biosample_id));
        } else {
            $this->types[] = $biosample_id;
        }
    }
    public function render()
    {
        return view('livewire.bioarchive.create');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Biosample;
use App\Models\Bioarchive;
use App\Models\Bioproject;
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
    // biosample
    public $biosamples;



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
    public function render()
    {
        return view('livewire.bioarchive.create');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Bioproject;
use App\Models\Biosample;

class CreateBioarchive extends Component
{
    public $currentStep = 1;
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
        $this->bioprojects = Bioproject::where('draft', false)->get();
        // biosample
        $this->biosamples = Biosample::where('draft', false)->get();
    }
    public function submitForm()
    {
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
    public function render()
    {
        return view('livewire.bioarchive.create');
    }
}

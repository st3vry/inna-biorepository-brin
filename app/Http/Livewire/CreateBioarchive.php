<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateBioarchive extends Component
{
    public $currentStep = 1;
    public function mount()
    {
    }
    public function submitForm()
    {
    }

    public function firstStepSubmit()
    {
    }
    public function secondStepSubmit()
    {
    }
    public function thirdStepSubmit()
    {
    }
    public function fourthStepSubmit()
    {
    }
    public function fifthStepSubmit()
    {
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

<?php

namespace App\Http\Livewire;

use App\Models\Biosample;
use Livewire\Component;

class CreateBiosample extends Component
{
    public $currentStep = 1;
    public $title;

    protected $rules = [
        'title' => 'required|min:6',
    ];

    public function firstStepSubmit()
    {
        // $validatedData = $this->validate([
        //     'name' => 'required',
        //     'price' => 'required|numeric',
        //     'detail' => 'required',
        // ]);

        $this->currentStep = 2;
    }

    /**
     * Write code on Method
     */
    public function secondStepSubmit()
    {
        // $validatedData = $this->validate([
        //     'status' => 'required',
        // ]);

        $this->currentStep = 3;
    }
    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function mount()
    {
    }


    public function submitForm()
    {

        $validatedData = $this->validate();
        $biosample = new Biosample();

        $biosample->title = $validatedData['title'];

        $biosample->save();


        session()->flash('message', 'Biosample successfully created.');
        return redirect()->to('/dashboard/biosamples/' . $biosample->accession);
    }

    public function render()
    {
        // info($this->grants);
        return view('livewire.biosample.create');
    }
}

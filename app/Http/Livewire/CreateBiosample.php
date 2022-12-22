<?php

namespace App\Http\Livewire;

use App\Models\Biosample;
use App\Models\User;
use Livewire\Component;

class CreateBiosample extends Component
{
    public $currentStep = 1;
    public $successMsg = '';

    public $submitter_name;
    public $submitter_email;
    public $submitter_lab;
    public $hold_release;


    protected $rules = [
        'title' => 'required|min:6',
    ];

    public function firstStepSubmit()
    {
        $this->currentStep = 2;
    }

    /**
     * Write code on Method
     */
    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'hold_release' => 'required',
        ]);
        $this->currentStep = 3;
    }

    public function thirdStepSubmit()
    {
        $this->currentStep = 4;
    }
    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function mount()
    {
        $this->submitter_name = auth()->user()->name;
        $this->submitter_email = auth()->user()->email;
        $this->submitter_lab = auth()->user()->lab->name;
        $this->submitter_center = auth()->user()->lab->center->name;

        $this->biosample_links = [
            ['biosamplelink_id' => '', 'biosample_link_description' => 'desc', 'biosample_link_url' => 'url']
        ];
    }

    public function addLink()
    {
        $this->biosample_links[] = ['biosamplelink_id' => '', 'biosample_link_description' => 'desc', 'biosample_link_url' => 'url'];
    }

    public function removeLink($index)
    {
        unset($this->biosample_links[$index]);
        $this->biosample_links = array_values($this->biosample_links);
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

<?php

namespace App\Http\Livewire;

use App\Models\Biosample;
use App\Models\User;
use App\Models\Sampletype;
use Livewire\Component;

class CreateBiosample extends Component
{
    public $currentStep = 1;
    public $successMsg = '';

    public $submitter_name;
    public $submitter_email;
    public $submitter_lab;
    public $hold_release;
    public $comments;

    public $sampletypes = [];
    public $sampletype_id;



    protected $rules = [
        'title' => 'required|min:6',
        'sampletype_id' => 'required',
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
        $validatedData = $this->validate([
            'sampletype_id' => 'required',
        ]);
        $this->currentStep = 4;
    }

    public function fourthStepSubmit()
    {
        $this->currentStep = 5;
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

        $this->sampletypes = Sampletype::all();
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
        $biosample->accession = 'SAM' . sprintf('%06d', intval($biosample->query()->max("id")) + 1);
        $biosample->submission_id = 'SUBSAM' . sprintf('%06d', intval($biosample->query()->max("id")) + 1);
        $biosample->sampletype_id = $validatedData['sampletype_id'];

        $biosample->title = $validatedData['title'];
        $biosample->center_id = auth()->user()->lab->center_id;
        $biosample->user_id = auth()->user()->id;

        $biosample->save();

        if (count($validatedData['biosample_link']) > 0) {
            foreach ($validatedData['biosample_link'] as  $item => $value) {
                $data1 = array(
                    'biosample_id' => $biosample->id,
                    'link_description' => $validatedData['biosample_link'][$item]['biosample_link_description'],
                    'link_url' => $validatedData['biosample_link'][$item]['biosample_link_url'],
                );
                BioSampleExternalLink::create($data1);
            }
        }

        session()->flash('message', 'Biosample successfully created.');
        return redirect()->to('/dashboard/biosamples/' . $biosample->accession);
    }

    public function render()
    {
        // info($this->grants);
        return view('livewire.biosample.create');
    }


}

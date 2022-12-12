<?php

namespace App\Http\Livewire;

use App\Models\Biosample;
use Livewire\Component;

class CreateBiosample extends Component
{

    public $title;

    protected $rules = [
        'title' => 'required|min:6',
    ];

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

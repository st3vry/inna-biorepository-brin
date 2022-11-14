<?php

namespace App\Http\Livewire;

use App\Models\Bioproject;
use App\Models\Grant;
use App\Models\Datatype;
use App\Models\Fundagency;
use App\Models\Organism;
use App\Models\Samplescope;
use App\Models\Umbrellaproject;
use Livewire\Component;

class EditBioproject extends Component
{
    public $umbrellas = [];
    public $organisms = [];
    public $datatypes = [];
    public $samplescopes = [];
    public $fundagencies = [];
    public $grants = [];
    public $relevance;
    public $data_type_id;
    public $selectedDatatype;
    public $samplescope_id;
    public $organism_id;
    public $title;
    public $umbproject_id;
    public $description;

    public $message;

    protected $rules = [
        'title' => 'required|min:6',
        'umbproject_id' => 'required',
        'organism_id' => 'required',
        'relevance' => 'required|min:6',
        'description' => 'required|min:6',
        'data_type_id' => 'required',
        'data_type_id.*' => 'numeric',
        'samplescope_id' => 'required',
        'grants.*.fundagency_id' => 'required',
        'grants.*.program' => 'required',
        'grants.*.title' => 'required',
    ];

    public function mount($bioproject)
    {
        $this->id = $bioproject->id;
        $this->title = $bioproject->title;
        $this->umbrellas = $bioproject->umbproject_id;
        $this->organisms = $bioproject->organism_id;
        $this->datatypes = $bioproject->data_type_id;
        $this->samplescopes = $bioproject->samplescope_id;
        // $this->grants = [
        //     ['fundagency_id' => '', 'program' => '1', 'title' => '1']
        // ];
    }

    public function render()
    {
        return view('livewire.bioproject.edit');
    }
}

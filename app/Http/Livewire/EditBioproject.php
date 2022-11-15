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
    public $selectedUmbrella;
    public $organisms = [];
    public $selectedOrganism;
    public $datatypes = [];
    public $selectedDatatypes = [];
    public $samplescopes = [];
    public $fundagencies = [];
    public $selectedFundAgency = [];
    public $grants = [];
    public $grantDatas = [];
    public $relevance;
    public $data_type_id;
    public $selectedDatatype;
    public $samplescope_id;
    public $organism_id;
    public $title;
    public $umbproject_id;
    public $description;

    public $editedGrantIndex = null;

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

        $this->umbrellas = Umbrellaproject::all();
        $this->selectedUmbrella = $bioproject->umbproject_id;

        $this->organisms = Organism::all();
        $this->selectedOrganism = $bioproject->organism_id;

        $this->relevance = $bioproject->relevance;
        $this->description = $bioproject->description;

        $this->datatypes = Datatype::all();
        $this->selectedDatatypes = explode(',', $bioproject->data_type_id);


        $this->samplescopes = Samplescope::all();
        $this->selectedSampleScope = $bioproject->samplescope_id;

        $this->fundagencies = Fundagency::all();
        $this->grants = Grant::select('id', 'fundagency_id', 'grant_program', 'grant_title')->where('bioproject_id', $bioproject->id)->get()->toArray();
        // dd($this->grants);

        // if ($this->grants) {
        //     dd($this->grants->attributesToArray());
        //     // foreach ($this->grants as $fundagency) {
        //     //     $this->grantDatas[] = [
        //     //         'fundagency_id' => $fundagency->id, 'program' => '1', 'title' => '1'
        //     //     ];
        //     // }
        // }
    }
    public function editgrant($grantIndex)
    {
        $this->editedGrantIndex = $grantIndex;
    }
    public function addGrant()
    {
        $this->grants[] = ['fundagency_id' => '', 'grant_program' => '1', 'grant_title' => '1'];
    }


    public function render()
    {
        return view('livewire.bioproject.edit');
    }
}

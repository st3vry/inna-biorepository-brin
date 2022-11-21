<?php

namespace App\Http\Livewire;

use App\Models\Bioproject;
use App\Models\Capture;
use App\Models\CaptureBioproject;
use App\Models\Consortium;
use App\Models\Grant;
use App\Models\Datatype;
use App\Models\Fundagency;
use App\Models\Material;
use App\Models\MaterialBioproject;
use App\Models\Methodology;
use App\Models\MethodologyBioproject;
use App\Models\Organism;
use App\Models\Relevance;
use App\Models\RelevanceBioproject;
use App\Models\Samplescope;
use Livewire\Component;

class CreateBioproject extends Component
{
    public $umbrellas = [];
    public $organisms = [];
    public $consortia = [];
    public $datatypes = [];
    public $samplescopes = [];
    public $fundagencies = [];
    public $grants = [];
    public $relevances = [];
    public $relevance_id;
    public $reldesc;

    public $materials = [];
    public $material_id;
    public $matdesc;

    public $captures = [];
    public $capture_id;
    public $capdesc;

    public $methodologies = [];
    public $methodology_id;
    public $metdesc;

    public $data_type_id;
    public $selectedDatatype;
    public $samplescope_id;
    public $organism_id;
    public $consortium_id;
    public $title;
    public $umbproject_id;
    public $description;

    public $message;

    protected $rules = [
        'title' => 'required|min:6',
        'umbproject_id' => '',
        'organism_id' => 'required',
        'consortium_id' => 'required',
        'relevance_id' => 'required',
        'reldesc' => '',

        'material_id' => 'required',
        'matdesc' => '',

        'capture_id' => 'required',
        'capdesc' => '',

        'methodology_id' => 'required',
        'metdesc' => '',

        'description' => 'required|min:6',
        'data_type_id' => 'required',
        'data_type_id.*' => 'numeric',
        'samplescope_id' => 'required',
        'grants.*.fundagency_id' => 'required',
        'grants.*.grant_program' => 'required',
        'grants.*.grant_title' => 'required',
    ];

    public function mount()
    {
        $this->umbrellas = Bioproject::where('draft', false)->get();
        $this->relevances = Relevance::all();
        $this->materials = Material::all();
        $this->captures = Capture::all();
        $this->methodologies = Methodology::all();
        $this->consortia = Consortium::all();
        $this->organisms = Organism::all();
        $this->datatypes = Datatype::all();
        $this->samplescopes = Samplescope::all();
        $this->fundagencies = Fundagency::all();
        $this->grants = [
            ['fundagency_id' => '', 'grant_program' => '1', 'grant_title' => '1']
        ];
    }
    public function addGrant()
    {
        $this->grants[] = ['fundagency_id' => '', 'grant_program' => '1', 'grant_title' => '1'];
    }

    public function removeGrant($index)
    {
        unset($this->grants[$index]);
        $this->grants = array_values($this->grants);
    }

    public function updatedRelevanceOther()
    {
    }

    public function submitForm()
    {

        $this->message = '';

        $validatedData = $this->validate();
        $bioproject = new Bioproject();
        $bioproject->accession = 'PRJ' . sprintf('%06d', intval($bioproject->query()->max("id")) + 1);
        $bioproject->submission_id = 'SUBPRJ' . sprintf('%06d', intval($bioproject->query()->max("id")) + 1);
        $bioproject->data_type_id = implode(",", $validatedData['data_type_id']);
        $bioproject->samplescope_id = $validatedData['samplescope_id'];
        $bioproject->umbproject_id = $validatedData['umbproject_id'];
        $bioproject->organism_id = $validatedData['organism_id'];
        $bioproject->consortium_id = $validatedData['consortium_id'];
        $bioproject->title = $validatedData['title'];
        $bioproject->description = $validatedData['description'];
        $bioproject->center_id = auth()->user()->lab->center_id;
        $bioproject->user_id = auth()->user()->id;

        $bioproject->save();
        $relevanceData = [
            'bioproject_id' => $bioproject->id,
            'relevance_id' => $validatedData['relevance_id'],
            'description' => $validatedData['reldesc']
        ];
        RelevanceBioproject::create($relevanceData);

        $materialData = [
            'bioproject_id' => $bioproject->id,
            'material_id' => $validatedData['material_id'],
            'description' => $validatedData['matdesc']
        ];
        MaterialBioproject::create($materialData);

        $captureData = [
            'bioproject_id' => $bioproject->id,
            'capture_id' => $validatedData['capture_id'],
            'description' => $validatedData['capdesc']
        ];

        CaptureBioproject::create($captureData);

        $methodologyData = [
            'bioproject_id' => $bioproject->id,
            'methodology_id' => $validatedData['methodology_id'],
            'description' => $validatedData['metdesc']
        ];

        MethodologyBioproject::create($methodologyData);

        if (count($validatedData['grants']) > 0) {
            foreach ($validatedData['grants'] as  $item => $value) {
                $data2 = array(
                    'bioproject_id' => $bioproject->id,
                    'fundagency_id' => $validatedData['grants'][$item]['fundagency_id'],
                    'grant_title' => $validatedData['grants'][$item]['grant_title'],
                    'grant_program' => $validatedData['grants'][$item]['grant_program'],
                );
                Grant::create($data2);
            }
        }
        session()->flash('message', 'Bioproject successfully created.');
        return redirect()->to('/dashboard/bioprojects/' . $bioproject->accession);
    }

    public function render()
    {
        info($this->grants);
        return view('livewire.bioproject.create');
    }
}

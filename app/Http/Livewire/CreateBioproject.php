<?php

namespace App\Http\Livewire;

use App\Models\Bioproject;
use App\Models\Grant;
use App\Models\Datatype;
use App\Models\Fundagency;
use App\Models\Organism;
use App\Models\Relevance;
use App\Models\RelevanceBioproject;
use App\Models\Samplescope;
use App\Models\Umbrellaproject;
use Livewire\Component;

class CreateBioproject extends Component
{
    public $umbrellas = [];
    public $organisms = [];
    public $datatypes = [];
    public $samplescopes = [];
    public $fundagencies = [];
    public $grants = [];
    public $relevance_id = [];
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
        'umbproject_id' => '',
        'organism_id' => 'required',
        'relevance_id' => 'required',
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

    public function submitForm()
    {

        $this->message = '';

        $validatedData = $this->validate();
        $bioproject = new Bioproject();
        $bioproject->accession = 'PRJ' . sprintf('%06d', intval($bioproject->query()->max("id")) + 1);
        $bioproject->submission_id = 'SUBPRJ' . sprintf('%06d', intval($bioproject->query()->max("id")) + 1);
        $bioproject->relevance = $validatedData['relevance_id'];
        $bioproject->data_type_id = implode(",", $validatedData['data_type_id']);
        $bioproject->samplescope_id = $validatedData['samplescope_id'];
        $bioproject->umbproject_id = $validatedData['umbproject_id'];
        $bioproject->organism_id = $validatedData['organism_id'];
        $bioproject->title = $validatedData['title'];
        $bioproject->description = $validatedData['description'];
        $bioproject->center_id = auth()->user()->lab->center_id;
        $bioproject->user_id = auth()->user()->id;

        $bioproject->save();
        // dd($bioproject);
        // dd($validatedData);
        // $bioproject = Bioproject::create($validatedData);

        if (count($validatedData['grants']) > 0) {
            foreach ($validatedData['grants'] as  $item => $value) {
                $data2 = array(
                    'bioproject_id' => $bioproject->id,
                    'fundagency_id' => $validatedData['grants'][$item]['fundagency_id'],
                    'grant_title' => $validatedData['grants'][$item]['grant_title'],
                    'grant_program' => $validatedData['grants'][$item]['grant_program'],
                );
                // dd($data2);
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

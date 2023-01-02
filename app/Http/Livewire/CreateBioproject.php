<?php

namespace App\Http\Livewire;

use App\Models\Bioproject;
use App\Models\Capture;
use App\Models\CaptureBioproject;
use App\Models\Consortium;
use App\Models\Grant;
use App\Models\BioProjectExternalLink;
use App\Models\Datatype;
use App\Models\DatatypeBioproject;
use App\Models\Fundagency;
use App\Models\Material;
use App\Models\MaterialBioproject;
use App\Models\Methodology;
use App\Models\MethodologyBioproject;
use App\Models\Organism;
use App\Models\PubIdentifier;
use App\Models\Publication;
use App\Models\Relevance;
use App\Models\RelevanceBioproject;
use App\Models\Samplescope;
use App\Models\User;
use Livewire\Component;

class CreateBioproject extends Component
{
    public $currentStep = 1;
    public $successMsg = '';

    public $submitter_name;
    public $submitter_email;
    public $submitter_lab;
    public $submitter_center;

    public $hold_release;

    public $umbrellas = [];
    public $organisms = [];
    public $consortia = [];
    public $datatypes = [];
    public $datatypedesc;

    public $samplescopes = [];
    public $samplescope_id;
    public $samplescopedesc;

    public $fundagencies = [];
    public $grants = [];
    public $externallinks = [];
    public $publications = [];
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
        // 'consortium_id' => 'required',

        'material_id' => 'required',
        'matdesc' => '',

        'capture_id' => 'required',
        'capdesc' => '',

        'methodology_id' => 'required',
        'metdesc' => '',

        'description' => 'required|min:6',
        'data_type_id' => 'required',
        'data_type_id.*' => 'numeric',
        'datatypedesc' => '',

        'samplescope_id' => 'required',
        'samplescopedesc' => '',

        'publications.*.pub_identifier_id' => 'required',
        'publications.*.pub_id' => 'required',
        'publications.*.article_title' => 'required',
    ];
    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'hold_release' => 'required',
        ]);

        $this->currentStep = 2;
    }
    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'title' => 'required|min:6',
            'description' => 'required|min:6',
            'relevance_id' => 'required',
            'reldesc' => '',

            'grants.*.fundagency_id' => 'required',
            'grants.*.grant_program' => 'required',
            'grants.*.grant_title' => 'required',

            'externallinks.*.link_description' => 'required',
            'externallinks.*.link_url' => 'required',

            
        ]);

        $this->currentStep = 3;
    }
    public function thirdStepSubmit()
    {
        // $validatedData = $this->validate([
        //     'status' => 'required',
        // ]);

        $this->currentStep = 4;
    }
    public function fourthStepSubmit()
    {
        // $validatedData = $this->validate([
        //     'status' => 'required',
        // ]);

        $this->currentStep = 5;
    }
    public function fifthStepSubmit()
    {
        // $validatedData = $this->validate([
        //     'status' => 'required',
        // ]);

        $this->currentStep = 6;
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


        $this->umbrellas = Bioproject::where('draft', false)->get();
        $this->relevances = Relevance::all();
        $this->materials = Material::all();
        $this->captures = Capture::all();
        $this->methodologies = Methodology::all();
        $this->consortia = Consortium::all();
        $this->organisms = Organism::all();
        $this->pub_identifiers = PubIdentifier::all();
        $this->datatypes = Datatype::all();
        $this->samplescopes = Samplescope::all();
        $this->fundagencies = Fundagency::all();
        // $this->grants = [
        //     ['fundagency_id' => '', 'grant_program' => '1', 'grant_title' => '1']
        // ];
        // $this->publications = [
        //     ['pub_identifier_id' => '', 'pub_id' => '1', 'article_title' => '1']
        // ];
        // $this->externallinks = [
        //     ['link_description' => '', 'link_url' => '']
        // ];
    }
    public function addGrant()
    {
        $this->grants[] = ['fundagency_id' => '', 'grant_program' => '', 'grant_title' => ''];
    }

    public function removeGrant($index)
    {
        unset($this->grants[$index]);
        $this->grants = array_values($this->grants);
    }

    public function addPublication()
    {
        $this->publications[] = ['pub_identifier_id' => '', 'pub_id' => '1', 'article_title' => '1'];
    }

    public function removePublication($index)
    {
        unset($this->publications[$index]);
        $this->publications = array_values($this->publications);
    }

    public function addExternalLink()
    {
        $this->externallinks[] = ['link_description' => '', 'link_url' => ''];
    }

    public function removeExternalLink($index)
    {
        unset($this->externallinks[$index]);
        $this->externallinks = array_values($this->externallinks);
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
        if (count($validatedData['publications']) > 0) {
            foreach ($validatedData['publications'] as  $item => $value) {
                $data3 = array(
                    'bioproject_id' => $bioproject->id,
                    'pub_identifier_id' => $validatedData['publications'][$item]['pub_identifier_id'],
                    'pub_id' => $validatedData['publications'][$item]['pub_id'],
                    'article_title' => $validatedData['publications'][$item]['article_title'],
                );
                Publication::create($data3);
            }
        }

        if (count($validatedData['data_type_id']) > 0) {
            foreach ($validatedData['data_type_id'] as $item => $value) {
                $data4 = array(
                    'bioproject_id' => $bioproject->id,
                    'datatype_id' => $validatedData['data_type_id'][$item],
                );
                DatatypeBioproject::create($data4);
            }
        }
        if (count($validatedData['externallinks']) > 0) {
            foreach ($validatedData['externallinks'] as  $item => $value) {
                $data5 = array(
                    'bioproject_id' => $bioproject->id,
                    'link_description' => $validatedData['externallinks'][$item]['link_description'],
                    'link_url' => $validatedData['externallinks'][$item]['link_url'],
                );
                BioProjectExternalLink::create($data5);
            }
        }

        session()->flash('message', 'Bioproject successfully created.');
        return redirect()->to('/dashboard/bioprojects/' . $bioproject->accession);
    }

    public function render()
    {
        // info($this->grants);
        return view('livewire.bioproject.create');
    }
}

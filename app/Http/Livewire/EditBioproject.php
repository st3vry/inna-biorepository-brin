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
    public $newGrants = [];
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
    public $addNewGrant = false;

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
        'newGrants.*.fundagency_id' => 'required',
        'newGrants.*.program' => 'required',
        'newGrants.*.title' => 'required',
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
        $this->grants = Grant::select('id', 'fundagency_id', 'grant_program', 'grant_title')->with('fundagency')->where('bioproject_id', $bioproject->id)->get()->toArray();
        // $this->newGrants = [
        //     ['fundagency_id' => '', 'grant_program' => '1', 'grant_title' => '1']
        // ];
        // dd($this->grants);
    }

    public function editGrant($grantIndex)
    {
        $this->editedGrantIndex = $grantIndex;
    }

    public function saveGrant($grantIndex)
    {
        $grant = $this->grants[$grantIndex] ?? NULL;
        if (!is_null($grant)) {
            $editedGrant = Grant::find($grant['id']);
            if ($editedGrant) {
                $editedGrant->update($grant);
            }
        }
        $this->editedGrantIndex = null;
    }

    public function deleteGrant($grantIndex)
    {
        dd($grantIndex);
    }

    public function newGrant()
    {
        $this->addNewGrant = true;
        $this->newGrants[] = ['fundagency_id' => '', 'grant_program' => '1', 'grant_title' => '1'];
    }

    public function removeGrant($index)
    {
        unset($this->newGrants[$index]);
        $this->newGrants = array_values($this->newGrants);
    }

    public function submitForm()
    {

        $this->message = '';

        $validatedData = $this->validate();
        $bioproject = new Bioproject();
        // $bioproject->accession = 'PRJ' . sprintf('%06d', intval($bioproject->query()->max("id")) + 1);
        // $bioproject->submission_id = 'SUBPRJ' . sprintf('%06d', intval($bioproject->query()->max("id")) + 1);
        $bioproject->relevance = $validatedData['relevance'];
        $bioproject->data_type_id = implode(",", $validatedData['data_type_id']);
        $bioproject->samplescope_id = $validatedData['samplescope_id'];
        $bioproject->umbproject_id = $validatedData['umbproject_id'];
        $bioproject->organism_id = $validatedData['organism_id'];
        $bioproject->title = $validatedData['title'];
        $bioproject->description = $validatedData['description'];
        // $bioproject->center_id = auth()->user()->lab->center_id;
        // $bioproject->user_id = auth()->user()->id;

        // $bioproject->update();
        // dd($bioproject);
        // dd($validatedData);
        // $bioproject = Bioproject::create($validatedData);

        if (count($validatedData['newGrants']) > 0) {
            foreach ($validatedData['newGrants'] as  $item => $value) {
                $data2 = array(
                    'bioproject_id' => $bioproject->id,
                    'fundagency_id' => $validatedData['newGrants'][$item]['fundagency_id'],
                    'grant_title' => $validatedData['newGrants'][$item]['grant_title'],
                    'grant_program' => $validatedData['newGrants'][$item]['grant_program'],
                );
                dd($data2);
                // Grant::create($data2);
            }
        }
        session()->flash('message', 'Bioproject successfully created.');
        return redirect()->to('/dashboard/bioprojects/' . $bioproject->accession);
    }

    public function render()
    {
        return view('livewire.bioproject.edit');
    }
}

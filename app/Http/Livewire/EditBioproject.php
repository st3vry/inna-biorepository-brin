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
    public $bioproject_id;
    public $accession;
    public $selectedSampleScope;
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
        'selectedOrganism' => 'required',
        'selectedDatatypes' => 'required',
        'selectedUmbrella' => 'required',
        'selectedSampleScope' => 'required',
        'relevance' => 'required|min:6',
        'description' => 'required|min:6',
        'newGrants.*.fundagency_id' => 'required',
        'newGrants.*.grant_program' => 'required',
        'newGrants.*.grant_title' => 'required',
    ];

    public function mount($bioproject)
    {
        $this->bioproject_id = $bioproject->id;
        $this->accession = $bioproject->accession;
        $this->title = $bioproject->title;

        $this->umbrellas = Umbrellaproject::all();
        $this->selectedUmbrella = $bioproject->umbproject_id;

        $this->organisms = Organism::all();
        $this->selectedOrganism = $bioproject->organism_id;

        $this->relevance = $bioproject->relevance;
        $this->description = $bioproject->description;

        $this->datatypes = Datatype::all();
        $this->selectedDatatypes = array_map('intval', explode(',', $bioproject->data_type_id));

        $this->samplescopes = Samplescope::all();
        $this->selectedSampleScope = $bioproject->samplescope_id;

        $this->fundagencies = Fundagency::all();
        $this->grants = Grant::select('id', 'fundagency_id', 'grant_program', 'grant_title')->with('fundagency')->where('bioproject_id', $bioproject->id)->get()->toArray();
        $this->newGrants = [];
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

    public function update()
    {
        $this->message = '';
        $validatedData = $this->validate();
        // dd($bioproject->data_type_id);
        // dd(implode(',', $this->selectedDatatypes));
        try {
            Bioproject::find($this->bioproject_id)->fill([
                'title' => $this->title,
                'umbproject_id' =>  $this->selectedUmbrella,
                'organism_id' => $this->selectedOrganism,
                'relevance' => $this->relevance,
                'description' => $this->description,
                'data_type_id' => implode(',', $this->selectedDatatypes),
                'samplescope_id' => $this->selectedSampleScope,
            ])->save();

            if (count($validatedData['newGrants']) > 0) {
                foreach ($validatedData['newGrants'] as  $item => $value) {
                    $data2 = array(
                        'bioproject_id' => $this->bioproject_id,
                        'fundagency_id' => $validatedData['newGrants'][$item]['fundagency_id'],
                        'grant_title' => $validatedData['newGrants'][$item]['grant_title'],
                        'grant_program' => $validatedData['newGrants'][$item]['grant_program'],
                    );
                    // dd($data2);
                    Grant::create($data2);
                }
            }
            $this->message = 'Bioproject Updated Successfully!!';
            session()->flash('success', $this->message);
        } catch (\Exception $e) {
            $this->message = 'Something goes wrong while updating Bioproject!!';
            session()->flash('error', $this->message);
        }
        return redirect()->to('/dashboard/bioprojects/' . $this->accession);
    }

    public function render()
    {
        return view('livewire.bioproject.edit');
    }
}

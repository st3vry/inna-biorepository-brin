<?php

namespace App\Http\Livewire;

use App\Models\Bioproject;
use App\Models\Capture;
use App\Models\CaptureBioproject;
use App\Models\Consortium;
use App\Models\Grant;
use App\Models\BioProjectExternalLink;
use App\Models\BioticRelationship;
use App\Models\Datatype;
use App\Models\DatatypeBioproject;
use App\Models\Fundagency;
use App\Models\Material;
use App\Models\MaterialBioproject;
use App\Models\Methodology;
use App\Models\MethodologyBioproject;
use App\Models\Organism;
use App\Models\Celularity;
use App\Models\Reproduction;
use App\Models\Ploidy;
use App\Models\GenomeSize;
use App\Models\Habitat;
use App\Models\OxygenReq;
use App\Models\ProMorphShape;
use App\Models\PubIdentifier;
use App\Models\Publication;
use App\Models\Relevance;
use App\Models\RelevanceBioproject;
use App\Models\ReplLocation;
use App\Models\ReplType;
use App\Models\Salinity;
use App\Models\Samplescope;
use App\Models\TempRange;
use App\Models\TrophicLevel;
use App\Models\Objective;
use App\Models\ObjectiveBioProject;
use App\Models\SampleBioproject;
use App\Models\User;
use App\Models\Umbrellaproject;
use Livewire\Component;

class EditBioproject extends Component
{
    public $currentStep = 1;
    public $successMsg = '';

    public $submitter_name;
    public $submitter_email;
    public $submitter_lab;
    public $submitter_center;

    public $hold_release;

    public $umbrellas = [];
    public $consortia = [];
    public $datatypes = [];
    public $datatypedesc;
    public $objectives = [];
    public $objdesc;


    public $samplescopes = [];
    public $samplescope_id;
    public $samplescopedesc;

    public $fundagencies = [];
    public $grants = [];
    public $externallinks = [];
    public $publications = [];
    public $pub_identifiers;
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
    public $objective_id;


    public $consortium_id;
    public $title;
    public $umbproject_id;
    public $description;

    public $message;

    // TARGET TAB
    public $organisms = [];
    public $organism_id;
    public $novel_org;
    public $novel_desc;
    public $sbc;
    public $isolate;
    public $org_desc;
    public $celularities = [];
    public $celularity_id;
    public $reproductions = [];
    public $reproduction_id;
    public $ploidies = [];
    public $ploidy_id;
    public $haploid_size;
    public $genome_sizes = [];
    public $genome_size_id;
    public $plodesc;

    // PHENOTYPE
    public $disease;
    public $bio_rels = [];
    public $bio_rel_id;
    public $trop_levels = [];
    public $trop_level_id;

    // PROKARYOTE
    public $shapes = [];
    public $shape_id;
    public $gram;
    public $enveloped;
    public $motility;
    public $endospores;

    //ECOLOGICAL ENV
    public $habitats = [];
    public $habitat_id;
    public $salinities = [];
    public $salinity_id;
    public $oxygens = [];
    public $oxygen_id;
    public $temp_ranges = [];
    public $temp_range_id;
    public $optimum_temp;

    // ORGANISM REPLICON
    public $repl_types = [];
    public $repl_type_id;
    public $repls = [];
    public $repl_name;
    public $repl_locs = [];
    public $repl_loc_id;
    public $repl_size;
    public $genome_sizes2 = [];
    public $genome_size2_id;
    public $genome2_sizes = [];
    public $genome2_size_id;

    // EDIT
    public $bioproject_id;
    public $accession;
    public $selectedUmbrella;
    public $selectedOrganism;
    public $relevance;
    public $selectedDatatypes;
    public $selectedSampleScope;
    public $newGrants;
    public $editedGrantIndex;
    public $addNewGrant;
    public $selected_hold_release;
    public $selectedConsortium;

    public $relevanceBioproject;
    public $selectedRelevance;
    public $relevanceDescription;

    public $objectiveBioproject;
    public $selectedObjective = ["1", "2"];
    public $objectiveDescription;

    

    protected $rules = [
        'title' => 'required|min:6',
        'umbproject_id' => '',
        'organism_id' => 'required',
        'consortium_id' => 'required',

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

        'objective_id' => 'required',
        'objective_id.*' => 'numeric',
        'objdesc' => '',

        'samplescope_id' => 'required',
        'samplescopedesc' => '',

        'relevance_id' => 'required',
        'reldesc' => '',

        'grants' => '',
        'externallinks' => '',

        'publications' => '',
        'publications.*.pub_identifier_id' => 'required',
        'publications.*.pub_id' => 'required',
        'publications.*.article_title' => 'required',

        'hold_release' => 'required',
    ];

    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'selected_hold_release' => 'required',
        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'title' => 'required|min:6',
            'description' => 'required|min:6',
            // 'relevance_id' => 'required',
            'selectedConsortium' => 'required',
            'reldesc' => '',

            'grants.*.fundagency_id' => 'required',
            'grants.*.grant_program' => 'required',
            'grants.*.grant_title' => 'required',

            'externallinks.*.link_description' => '',
            'externallinks.*.link_url' => '',

            'selectedConsortium' => 'required',
            // 'consortium_id' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function thirdStepSubmit()
    {
        // $validatedData = $this->validate([
        //     'status' => 'required',
        // ]);
        $validatedData = $this->validate([]);

        $this->currentStep = 4;
    }

    public function mount($bioproject)
    {
        $this->submitter_name = $bioproject->user->name;
        $this->submitter_email = $bioproject->user->email;
        $this->submitter_lab = $bioproject->user->lab->name;
        $this->submitter_center = $bioproject->user->lab->center->name;

        // $this->hold_release = $bioproject->hold_release;
        $this->selected_hold_release = $bioproject->hold_release;
        // dd($this->selected_hold_release);
        
        $this->bioproject_id = $bioproject->id;
        $this->accession = $bioproject->accession;
        $this->title = $bioproject->title;

        $this->umbrellas = Umbrellaproject::all();
        $this->selectedUmbrella = $bioproject->umbproject_id;

        $this->consortia = Consortium::all();
        $this->selectedConsortium = $bioproject->consortium_id;

        $this->organisms = Organism::all();
        $this->selectedOrganism = $bioproject->organism_id;

        $this->description = $bioproject->description;
        $this->relevanceBioproject = RelevanceBioproject::where('bioproject_id', $bioproject->id)->first();
        $this->relevances = Relevance::all();
        $this->selectedRelevance = $this->relevanceBioproject['relevance_id'];
        $this->relevanceDescription = $this->relevanceBioproject['description'];

        // dd($this->relevanceBioproject['description']);
        // dd($this->relevanceBioproject['relevance_id']);
        // $this->description = $bioproject->description;
        $this->objectiveBioproject = ObjectiveBioProject::where('bioproject_id', $bioproject->id)->get();
        $this->objectives = Objective::all();
        $this->selectedObjective = $this->objectiveBioproject;
        // $this->objectiveDescription = $this->objectiveDescription['description'];


        // dd($this->objectiveBioproject);


        $this->datatypes = Datatype::all();
        $this->selectedDatatypes = array_map('intval', explode(',', $bioproject->data_type_id));

        $this->samplescopes = Samplescope::all();
        $this->selectedSampleScope = $bioproject->samplescope_id;

        $this->relevances = Relevance::all();
        // $this->selectedRelevance = ;

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
    public function addRepl()
    {
        $this->repls[] = ['repl_name' => '', 'repl_type_id' => '', 'repl_loc' => '', 'repl_size' => '', 'genome_size2_id' => ''];
    }

    public function removeRepl($index)
    {
        unset($this->repls[$index]);
        $this->repls = array_values($this->repls);
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

    public static function relevanceName($id)
    {
        if (!empty($id))
            return Relevance::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
    }
    public static function bioprojectName($id)
    {
        if (!empty($id))
            return Bioproject::select('accession')->where('id', $id)->pluck('accession')->first();
        else
            return null;
    }
    public static function consortiumName($id)
    {
        if (!empty($id))
            return Consortium::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
    }
    public static function dataTypeName($id)
    {
        if (!empty($id))
            return Datatype::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
    }
    public static function sampleScopeName($id)
    {
        if (!empty($id))
            return Samplescope::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
    }
    public static function sampleMaterialName($id)
    {
        if (!empty($id))
            return Material::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
    }
    public static function sampleCaptureName($id)
    {
        if (!empty($id))
            return Capture::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
    }
    public static function sampleMethodologyName($id)
    {
        if (!empty($id))
            return Methodology::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
    }
    public static function objectiveName($id)
    {
        if (!empty($id))
            return Objective::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
    }
    public static function organismName($id)
    {
        if (!empty($id))
            return Organism::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
    }
    public static function celularityName($id)
    {
        if (!empty($id))
            return Celularity::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
    }
    public static function reproductionName($id)
    {
        if (!empty($id))
            return Reproduction::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
    }
    public static function ploidyName($id)
    {
        if (!empty($id))
            return Ploidy::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
    }
    public static function genomeSizeName($id)
    {
        if (!empty($id))
            return GenomeSize::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
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

    public function back($step)
    {
        $this->currentStep = $step;
    }
    public function addGrant()
    {
        $this->grants[] = ['fundagency_id' => '', 'grant_program' => '', 'grant_title' => ''];
    }
}

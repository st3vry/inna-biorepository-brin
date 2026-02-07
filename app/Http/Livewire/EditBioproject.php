<?php

namespace App\Http\Livewire;

use App\Models\ActionLog;
use App\Models\Bioproject;
use App\Models\BioprojectTarget;
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
use App\Models\OrganismReplicon;
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
    public $editedGrantIndex;

    

    protected $messages = [
        'reldesc.required_if' => 'Please provide a description of Other relevance.',
        'genome_size_id.required_with' => 'Required',
        'repls.*.repl_type_id' => 'Required',
        'repls.*.repl_name' => 'Required',
        'repls.*.repl_loc_id' => 'Required',
        'repls.*.repl_size' => 'Required',
        'repls.*.genome_size2_id' => 'Required',
        'publications.*.pub_identifier_id' => 'Required',
        'publications.*.pub_id' => 'Required',
        'publications.*.article_title' => 'Required',
    ];

    protected $validationAttributes = [
        'reldesc' => 'relevance description',
        'genome_size_id' => 'genome size',
    ];

    protected $rules = [
        'title' => 'required|min:6',
        'umbproject_id' => '',
        'organism_id' => 'required',
        'consortium_id' => '',

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
        'reldesc' => 'nullable|required_if:relevance_id,7',

        'grants' => '',
        'externallinks' => '',

        'publications' => '',
        'publications.*.pub_identifier_id' => 'required',
        'publications.*.pub_id' => 'required',
        'publications.*.article_title' => 'required',

        'hold_release' => 'required',

        'haploid_size' => 'nullable',
        'genome_size_id' => 'nullable|required_with:haploid_size',

        'repls' => 'nullable|array',
        'repls.*.repl_type_id' => 'required',
        'repls.*.repl_name' => 'required',
        'repls.*.repl_loc_id' => 'required',
        'repls.*.repl_size' => 'required',
        'repls.*.genome_size2_id' => 'required',

        'novel_org' => '',
        'novel_desc' => 'nullable|required_if:novel_org,true',
        'sbc' => '',
        'isolate' => '',
        'org_desc' => '',
        'celularity_id' => '',
        'reproduction_id' => '',
        'ploidy_id' => '',
        'plodesc' => '',
        'disease' => '',
        'bio_rel_id' => '',
        'trop_level_id' => '',
        'gram' => '',
        'enveloped' => '',
        'motility' => '',
        'endospores' => '',
        'habitat_id' => '',
        'salinity_id' => '',
        'oxygen_id' => '',
        'temp_range_id' => '',
        'optimum_temp' => '',
    ];

    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'hold_release' => 'required',
            'submitter_name' => 'required',
            'submitter_email' => 'required|email',
            'submitter_lab' => 'required',
            'submitter_center' => 'required',
        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'title' => 'required|min:6',
            'description' => 'required|min:6',
            'relevance_id' => 'required',
            'reldesc' => 'nullable|required_if:relevance_id,7',

            'grants.*.fundagency_id' => 'required',
            'grants.*.grant_program' => 'required',
            'grants.*.grant_title' => 'required',

            'externallinks.*.link_description' => '',
            'externallinks.*.link_url' => '',
            'consortium_id' => '',
        ]);

        $this->currentStep = 3;
    }

    public function thirdStepSubmit()
    {
        // $validatedData = $this->validate([
        //     'status' => 'required',
        // ]);
        $validatedData = $this->validate([
            'samplescope_id' => 'required',
            'material_id' => 'required',
            'capture_id' => 'required',
            'methodology_id' => 'required',
            'data_type_id' => 'required',
            'objective_id' => 'required',
        ]);

        $this->currentStep = 4;
    }

    public function fourthStepSubmit()
    {
        $validatedData = $this->validate([
            'organism_id' => 'required',
            'haploid_size' => 'nullable',
            'genome_size_id' => 'nullable|required_with:haploid_size',
            'repls' => 'nullable|array',
            'repls.*.repl_type_id' => 'required',
            'repls.*.repl_name' => 'required',
            'repls.*.repl_loc_id' => 'required',
            'repls.*.repl_size' => 'required',
            'repls.*.genome_size2_id' => 'required',
        ]);

        $this->currentStep = 5;
    }

    public function fifthStepSubmit()
    {
        $this->validate([
            'publications' => '',
            'publications.*.pub_identifier_id' => 'required',
            'publications.*.pub_id' => 'required',
            'publications.*.article_title' => 'required',
        ]);

        $this->currentStep = 6;
    }

    public function mount($bioproject)
    {
        // Submitter display values
        $this->submitter_name = $bioproject->user->name;
        $this->submitter_email = $bioproject->user->email;
        $this->submitter_lab = $bioproject->user->lab->name;
        $this->submitter_center = $bioproject->user->lab->center->name;

        // Use same values as Create (`true`/`false` strings)
        $this->hold_release = $bioproject->hold_release ? 'true' : 'false';

        $this->bioproject_id = $bioproject->id;
        $this->accession = $bioproject->accession;
        $this->title = $bioproject->title;
        $this->description = $bioproject->description;

                // Lookups (mirror Create)
                $this->umbrellas = Bioproject::where('draft', false)->get();
                $this->relevances = Relevance::all();
                $this->materials = Material::all();
                $this->captures = Capture::all();
                $this->methodologies = Methodology::all();
                $this->consortia = Consortium::all();
                $this->organisms = Organism::all();
                $this->celularities = Celularity::all();
                $this->reproductions = Reproduction::all();
                $this->ploidies = Ploidy::all();
                $this->bio_rels = BioticRelationship::all();
                $this->trop_levels = TrophicLevel::all();
                $this->genome_sizes = GenomeSize::all();
                $this->genome_sizes2 = GenomeSize::all();
                $this->shapes = ProMorphShape::all();
                $this->habitats = Habitat::all();
                $this->salinities = Salinity::all();
                $this->oxygens = OxygenReq::all();
                $this->temp_ranges = TempRange::all();
                $this->repl_types = ReplType::all();
                $this->repl_locs = ReplLocation::all();
                $this->pub_identifiers = PubIdentifier::all();
                $this->datatypes = Datatype::all();
                $this->objectives = Objective::all();
                $this->samplescopes = Samplescope::all();
                $this->fundagencies = Fundagency::all();

                // Bioproject base fields
                $this->umbproject_id = $bioproject->umbproject_id;
                $this->consortium_id = $bioproject->consortium_id;
                $this->organism_id = $bioproject->organism_id;
                $this->samplescope_id = $bioproject->samplescope_id;

                // Related single-row detail tables
                $relevance = RelevanceBioproject::where('bioproject_id', $bioproject->id)->first();
                $this->relevance_id = $relevance?->relevance_id;
                $this->reldesc = $relevance?->description;

                $material = MaterialBioproject::where('bioproject_id', $bioproject->id)->first();
                $this->material_id = $material?->material_id;
                $this->matdesc = $material?->description;

                $capture = CaptureBioproject::where('bioproject_id', $bioproject->id)->first();
                $this->capture_id = $capture?->capture_id;
                $this->capdesc = $capture?->description;

                $methodology = MethodologyBioproject::where('bioproject_id', $bioproject->id)->first();
                $this->methodology_id = $methodology?->methodology_id;
                $this->metdesc = $methodology?->description;

                $samplescope = SampleBioproject::where('bioproject_id', $bioproject->id)->first();
                $this->samplescopedesc = $samplescope?->description;

                // Grants / links / publications
                $this->externallinks = BioProjectExternalLink::where('bioproject_id', $bioproject->id)
                    ->get(['id', 'link_description', 'link_url'])
                    ->toArray();
                $this->grants = Grant::where('bioproject_id', $bioproject->id)
                    ->get(['id', 'fundagency_id', 'grant_program', 'grant_title'])
                    ->toArray();
                $this->publications = Publication::where('bioproject_id', $bioproject->id)
                    ->get(['id', 'pub_identifier_id', 'pub_id', 'article_title'])
                    ->toArray();

                // Datatypes / objectives (pivot-like)
                $datatypeRows = DatatypeBioproject::where('bioproject_id', $bioproject->id)->get();
                $this->data_type_id = $datatypeRows
                    ->pluck('datatype_id')
                    ->map(fn($id) => (int) $id)
                    ->toArray();
                $this->datatypedesc = $datatypeRows->first()?->description;

                $objectiveRows = ObjectiveBioProject::where('bioproject_id', $bioproject->id)->get();
                $this->objective_id = $objectiveRows
                    ->pluck('objective_id')
                    ->map(fn($id) => (int) $id)
                    ->toArray();
                $this->objdesc = $objectiveRows->first()?->description;

                // Target + Replicons
                $target = $bioproject->target;
                if ($target) {
                    $this->novel_org = $target->organism_novel;
                    $this->novel_desc = $target->organism_novel_description;
                    $this->sbc = $target->organism_sbc;
                    $this->isolate = $target->organism_isolate;
                    $this->org_desc = $target->organism_desc;
                    $this->celularity_id = $target->celularity_id;
                    $this->reproduction_id = $target->reproduction_id;
                    $this->ploidy_id = $target->ploidy_id;
                    $this->plodesc = $target->ploidy_description;
                    $this->haploid_size = $target->haploid_genome_size;
                    $this->genome_size_id = $target->genome_size_id;
                    $this->disease = $target->phenotypes_disease;
                    $this->bio_rel_id = $target->biotic_relationship_id;
                    $this->trop_level_id = $target->trophic_level_id;
                    $this->gram = $target->prokaryote_morphology_gram;
                    $this->motility = $target->prokaryote_morphology_motility;
                    $this->enveloped = $target->prokaryote_morphology_enveloped;
                    $this->endospores = $target->prokaryote_morphology_endospores;
                    $this->habitat_id = $target->habitat_id;
                    $this->salinity_id = $target->salinity_id;
                    $this->oxygen_id = $target->oxygen_req_id;
                    $this->temp_range_id = $target->temp_range_id;
                    $this->optimum_temp = $target->optimum_temp;
                }

                $this->repls = $bioproject->organismReplicons()
                    ->get(['name', 'repl_type_id', 'repl_location_id', 'size', 'genome_size_id'])
                    ->map(function ($row) {
                        return [
                            'repl_name' => $row->name,
                            'repl_type_id' => $row->repl_type_id,
                            'repl_loc_id' => $row->repl_location_id,
                            'repl_size' => $row->size,
                            'genome_size2_id' => $row->genome_size_id,
                        ];
                    })
                    ->toArray();
        $this->newGrants = [];

        //tab target

        $this->shapes = ProMorphShape::all();



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
        $this->removeGrant($grantIndex);
    }

    public function newGrant()
    {
        $this->addGrant();
    }

    public function removeGrant($index)
    {
        unset($this->grants[$index]);
        $this->grants = array_values($this->grants);
    }
    public function addRepl()
    {
        $this->repls[] = ['repl_name' => '', 'repl_type_id' => '', 'repl_loc_id' => '', 'repl_size' => '', 'genome_size2_id' => ''];
    }

    public function removeRepl($index)
    {
        unset($this->repls[$index]);
        $this->repls = array_values($this->repls);
    }

    public function addPublication()
    {
        $this->publications[] = ['pub_identifier_id' => '', 'pub_id' => '', 'article_title' => ''];
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

    public static function pubIdentifierName($id)
    {
        if (!empty($id))
            return PubIdentifier::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
    }
    
    public function fundagencyName($id)
    {
        if (!empty($id))
            return Fundagency::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
    }

    public function replTypeName($id)
    {
        if (!empty($id))
            return ReplType::select('name')->where('id', $id)->pluck('name')->first();
        else
            return
         null;
    }

    public function replLocationName($id)
    {
        if (!empty($id))
            return ReplLocation::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
    }

    public function bioticRelName($id)
    {
        if (!empty($id))
            return BioticRelationship::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
    }

    public function trophicLevelName($id)
    {
        if (!empty($id))
            return TrophicLevel::select('name')->where('id', $id)->pluck('name')->first();
        else
            return null;
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

    public function submitForm()
    {
        $bioproject = Bioproject::findOrFail($this->bioproject_id);

        $this->message = '';

        $validatedData = $this->validate();

        $bioproject->umbproject_id = $validatedData['umbproject_id'] ?? null;
        $bioproject->organism_id = $validatedData['organism_id'];
        $bioproject->consortium_id = $validatedData['consortium_id'];
        $bioproject->title = $validatedData['title'];
        $bioproject->description = $validatedData['description'];
        $bioproject->hold_release = $validatedData['hold_release'];
        $bioproject->samplescope_id = $validatedData['samplescope_id'];
        $bioproject->data_type_id = implode(",", $validatedData['data_type_id']);
        $bioproject->draft = false;
        $bioproject->status = 2; //submitted back after edit
        $bioproject->save();



        // Target
        $targetPayload = [
            'bioproject_id' => $bioproject->id,
            'organism_novel' => $validatedData['novel_org'] ?? null,
            'organism_novel_description' => $validatedData['novel_desc'] ?? null,
            'organism_sbc' => $validatedData['sbc'] ?? null,
            'organism_isolate' => $validatedData['isolate'] ?? null,
            'organism_desc' => $validatedData['org_desc'] ?? null,
            'celularity_id' => $validatedData['celularity_id'] ?? null,
            'reproduction_id' => $validatedData['reproduction_id'] ?? null,
            'ploidy_id' => $validatedData['ploidy_id'] ?? null,
            'ploidy_description' => $validatedData['plodesc'] ?? null,
            'haploid_genome_size' => $validatedData['haploid_size'] ?? null,
            'genome_size_id' => $validatedData['genome_size_id'] ?? null,
            'phenotypes_disease' => $validatedData['disease'] ?? null,
            'biotic_relationship_id' => $validatedData['bio_rel_id'] ?? null,
            'trophic_level_id' => $validatedData['trop_level_id'] ?? null,
            'prokaryote_morphology_gram' => $validatedData['gram'] ?? null,
            'prokaryote_morphology_motility' => $validatedData['motility'] ?? null,
            'prokaryote_morphology_enveloped' => $validatedData['enveloped'] ?? null,
            'prokaryote_morphology_endospores' => $validatedData['endospores'] ?? null,
            'habitat_id' => $validatedData['habitat_id'] ?? null,
            'salinity_id' => $validatedData['salinity_id'] ?? null,
            'oxygen_req_id' => $validatedData['oxygen_id'] ?? null,
            'temp_range_id' => $validatedData['temp_range_id'] ?? null,
            'optimum_temp' => $validatedData['optimum_temp'] ?? null,
        ];
        BioprojectTarget::updateOrCreate(['bioproject_id' => $bioproject->id], $targetPayload);

        // Replicons (replace all)
        OrganismReplicon::where('bioproject_id', $bioproject->id)->delete();
        if (!empty($validatedData['repls']) && is_array($validatedData['repls'])) {
            foreach ($validatedData['repls'] as $repl) {
                OrganismReplicon::create([
                    'bioproject_id' => $bioproject->id,
                    'name' => $repl['repl_name'] ?? null,
                    'repl_type_id' => $repl['repl_type_id'] ?? null,
                    'repl_location_id' => $repl['repl_loc_id'] ?? null,
                    'size' => $repl['repl_size'] ?? null,
                    'genome_size_id' => $repl['genome_size2_id'] ?? null,
                ]);
            }
        }

        $relevanceData = [
            'bioproject_id' => $bioproject->id,
            'relevance_id' => $validatedData['relevance_id'],
            'description' => $validatedData['reldesc'],
        ];
        RelevanceBioproject::updateOrCreate(
            ['bioproject_id' => $bioproject->id],
            $relevanceData
        );

        $materialData = [
            'bioproject_id' => $bioproject->id,
            'material_id' => $validatedData['material_id'],
            'description' => $validatedData['matdesc'],
        ];
        MaterialBioproject::updateOrCreate(
            ['bioproject_id' => $bioproject->id],
            $materialData
        );

        $captureData = [
            'bioproject_id' => $bioproject->id,
            'capture_id' => $validatedData['capture_id'],
            'description' => $validatedData['capdesc'],
        ];
        CaptureBioproject::updateOrCreate(
            ['bioproject_id' => $bioproject->id],
            $captureData
        );

        $methodologyData = [
            'bioproject_id' => $bioproject->id,
            'methodology_id' => $validatedData['methodology_id'],
            'description' => $validatedData['metdesc'],
        ];
        MethodologyBioproject::updateOrCreate(
            ['bioproject_id' => $bioproject->id],
            $methodologyData
        );

        $samplescopeData = [
            'bioproject_id' => $bioproject->id,
            'samplescope_id' => $validatedData['samplescope_id'],
            'description' => $validatedData['samplescopedesc'],
        ];
        SampleBioproject::updateOrCreate(
            ['bioproject_id' => $bioproject->id],
            $samplescopeData
        );


        // Grants (update existing by id; create new; delete removed)
        $keptGrantIds = [];
        if (!empty($validatedData['grants']) && is_array($validatedData['grants'])) {
            foreach ($validatedData['grants'] as $grantRow) {
                $payload = [
                    'bioproject_id' => $bioproject->id,
                    'fundagency_id' => $grantRow['fundagency_id'] ?? null,
                    'grant_title' => $grantRow['grant_title'] ?? null,
                    'grant_program' => $grantRow['grant_program'] ?? null,
                ];

                if (!empty($grantRow['id'])) {
                    $model = Grant::where('bioproject_id', $bioproject->id)->where('id', $grantRow['id'])->first();
                    if ($model) {
                        $model->update($payload);
                        $keptGrantIds[] = $model->id;
                        continue;
                    }
                }

                $model = Grant::create($payload);
                $keptGrantIds[] = $model->id;
            }
        }
        Grant::where('bioproject_id', $bioproject->id)
            ->when(count($keptGrantIds) > 0, fn($q) => $q->whereNotIn('id', $keptGrantIds))
            ->when(count($keptGrantIds) === 0, fn($q) => $q)
            ->delete();

        // Publications (update by id; create new; delete removed)
        $keptPublicationIds = [];
        if (!empty($validatedData['publications']) && is_array($validatedData['publications'])) {
            foreach ($validatedData['publications'] as $pubRow) {
                $payload = [
                    'bioproject_id' => $bioproject->id,
                    'pub_identifier_id' => $pubRow['pub_identifier_id'] ?? null,
                    'pub_id' => $pubRow['pub_id'] ?? null,
                    'article_title' => $pubRow['article_title'] ?? null,
                ];

                if (!empty($pubRow['id'])) {
                    $model = Publication::where('bioproject_id', $bioproject->id)->where('id', $pubRow['id'])->first();
                    if ($model) {
                        $model->update($payload);
                        $keptPublicationIds[] = $model->id;
                        continue;
                    }
                }

                $model = Publication::create($payload);
                $keptPublicationIds[] = $model->id;
            }
        }
        Publication::where('bioproject_id', $bioproject->id)
            ->when(count($keptPublicationIds) > 0, fn($q) => $q->whereNotIn('id', $keptPublicationIds))
            ->when(count($keptPublicationIds) === 0, fn($q) => $q)
            ->delete();

        if (!empty($validatedData['data_type_id']) && count($validatedData['data_type_id']) > 0) {
            DatatypeBioproject::where('bioproject_id', $bioproject->id)
                ->whereNotIn('datatype_id', $validatedData['data_type_id'])
                ->delete();

            foreach ($validatedData['data_type_id'] as $item => $value) {
                $data4 = array(
                    'bioproject_id' => $bioproject->id,
                    'datatype_id' => $validatedData['data_type_id'][$item],
                    'description' => $validatedData['datatypedesc']
                );
                DatatypeBioproject::updateOrCreate(
                    ['bioproject_id' => $bioproject->id, 'datatype_id' => $validatedData['data_type_id'][$item]],
                    $data4
                );
            }
        }

        // External links (update by id; create new; delete removed)
        $keptExternalLinkIds = [];
        if (!empty($validatedData['externallinks']) && is_array($validatedData['externallinks'])) {
            foreach ($validatedData['externallinks'] as $linkRow) {
                $payload = [
                    'bioproject_id' => $bioproject->id,
                    'link_description' => $linkRow['link_description'] ?? null,
                    'link_url' => $linkRow['link_url'] ?? null,
                ];

                if (!empty($linkRow['id'])) {
                    $model = BioProjectExternalLink::where('bioproject_id', $bioproject->id)->where('id', $linkRow['id'])->first();
                    if ($model) {
                        $model->update($payload);
                        $keptExternalLinkIds[] = $model->id;
                        continue;
                    }
                }

                $model = BioProjectExternalLink::create($payload);
                $keptExternalLinkIds[] = $model->id;
            }
        }
        BioProjectExternalLink::where('bioproject_id', $bioproject->id)
            ->when(count($keptExternalLinkIds) > 0, fn($q) => $q->whereNotIn('id', $keptExternalLinkIds))
            ->when(count($keptExternalLinkIds) === 0, fn($q) => $q)
            ->delete();

        if (!empty($validatedData['objective_id']) && count($validatedData['objective_id']) > 0) {
            ObjectiveBioProject::where('bioproject_id', $bioproject->id)
                ->whereNotIn('objective_id', $validatedData['objective_id'])
                ->delete();

            foreach ($validatedData['objective_id'] as $item => $value) {
                $data6 = array(
                    'bioproject_id' => $bioproject->id,
                    'objective_id' => $validatedData['objective_id'][$item],
                    'description' => $validatedData['objdesc']
                );
                ObjectiveBioProject::updateOrCreate(
                    ['bioproject_id' => $bioproject->id, 'objective_id' => $validatedData['objective_id'][$item]],
                    $data6
                );
            }
        }

        ActionLog::create([
            'action' => "bioprojectEdited",
            'type' => 'Bioproject',
            'item_id' => $bioproject->accession,
            'user_target'=> $bioproject->curator_id,
            'created_by' =>auth()->id(),
            'desc' => null,
        ]);

        session()->flash('message', 'Bioproject successfully updated.');
        return redirect()->to('/dashboard/bioprojects/' . $bioproject->accession);
    }
}

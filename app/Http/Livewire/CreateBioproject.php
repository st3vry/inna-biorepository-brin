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
use App\Models\BioprojectTarget;
use App\Models\OrganismReplicon;
use App\Models\User;
use App\Models\Lab;
use App\Models\Center;
use Livewire\Component;
use App\Models\BioprojectDraft;

class CreateBioproject extends Component
{
    public $currentStep = 1;
    public $draftId = null;
    public $successMsg = '';

    public $submitter_name;
    public $submitter_email;
    public $submitter_lab;
    public $submitter_center;

    public $submitter_lab_name;
    public $submitter_center_name;

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
    public $selectedObjective;


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
        $validatedData = $this->validate([
            // 'status' => 'required',
            'publications' => '',
            'publications.*.pub_identifier_id' => 'required',
            'publications.*.pub_id' => 'required',
            'publications.*.article_title' => 'required',
        ]);

        $this->currentStep = 6;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function mount()
    {
        // dd(auth()->user());
        $this->submitter_name = auth()->user()->name;
        $this->submitter_email = auth()->user()->email;
        $this->submitter_lab = auth()->user()->lab_id;
        $this->submitter_center = auth()->user()->center_id;
        
        $this->submitter_lab_name = Lab::where('id', $this->submitter_lab)->value('name');
        $this->submitter_center_name = Center::where('id', $this->submitter_center)->value('name');

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
        // $this->grants = [
        //     ['fundagency_id' => '', 'grant_program' => '1', 'grant_title' => '1']
        // ];
        // $this->publications = [
        //     ['pub_identifier_id' => '', 'pub_id' => '1', 'article_title' => '1']
        // ];
        // $this->externallinks = [
        //     ['link_description' => '', 'link_url' => '']
        // ];

        // Auto-load latest draft for this user if present
        try {
            $latest = BioprojectDraft::where('user_id', auth()->id())->orderByDesc('id')->first();
            if ($latest) {
                $this->loadDraft($latest->id);
            }
        } catch (\Throwable $e) {
            logger()->debug('bioproject draft autoload skipped: ' . $e->getMessage());
        }
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
    public function addRepl()
    {
        $this->repls[] = ['repl_name' => '', 'repl_type_id' => '', 'repl_loc_id' => '', 'repl_size' => '', 'genome_size2_id' => '1'];
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

    public function submitForm()
    {

        $this->message = '';

        $validatedData = $this->validate();
        // dd( $validatedData );
        $bioproject = new Bioproject();
        $bioproject->accession = 'PRJ' . sprintf('%06d', intval($bioproject->query()->max("id")) + 1);
        $bioproject->submission_id = 'SUBPRJ' . sprintf('%06d', intval($bioproject->query()->max("id")) + 1);
        $bioproject->data_type_id = implode(",", $validatedData['data_type_id']);
        // $bioproject->objective_id = implode(",", $validatedData['objective_id']);
        $bioproject->samplescope_id = $validatedData['samplescope_id'];
        // sample scope

        $bioproject->umbproject_id = $validatedData['umbproject_id'];
        $bioproject->organism_id = $validatedData['organism_id'];
        $bioproject->consortium_id = $validatedData['consortium_id'];
        $bioproject->title = $validatedData['title'];
        $bioproject->description = $validatedData['description'];
        $bioproject->hold_release = $validatedData['hold_release'];
        // $bioproject->center_id = auth()->user()->lab->center_id;
        $bioproject->center_id = auth()->user()->center_id;
        $bioproject->user_id = auth()->user()->id;

        $bioproject->save();

        // Store Bio Project Target (optional; create only if any target field is provided)
        $targetPayload = [
            'bioproject_id' => $bioproject->id,
            'organism_novel' => $this->novel_org,
            'organism_novel_description' => $this->novel_desc,
            'organism_sbc' => $this->sbc,
            'organism_isolate' => $this->isolate,
            'organism_desc' => $this->org_desc,
            'celularity_id' => $this->celularity_id,
            'reproduction_id' => $this->reproduction_id,
            'ploidy_id' => $this->ploidy_id,
            'ploidy_description' => $this->plodesc,
            'haploid_genome_size' => $this->haploid_size,
            'genome_size_id' => $this->genome_size_id,
            'phenotypes_disease' => $this->disease,
            'biotic_relationship_id' => $this->bio_rel_id,
            'trophic_level_id' => $this->trop_level_id,
            'prokaryote_morphology_gram' => $this->gram,
            'prokaryote_morphology_motility' => $this->motility,
            'prokaryote_morphology_enveloped' => $this->enveloped,
            'prokaryote_morphology_endospores' => $this->endospores,
            'habitat_id' => $this->habitat_id,
            'salinity_id' => $this->salinity_id,
            'oxygen_req_id' => $this->oxygen_id,
            'temp_range_id' => $this->temp_range_id,
            'optimum_temp' => $this->optimum_temp,
        ];

        $hasTargetData = collect($targetPayload)
            ->except(['bioproject_id'])
            ->filter(function ($value) {
                return !is_null($value) && $value !== '';
            })
            ->isNotEmpty();

        if ($hasTargetData) {
            BioprojectTarget::create($targetPayload);
        }

        // Store Organism Replicons (optional)
        if (is_array($this->repls) && count($this->repls) > 0) {
            foreach ($this->repls as $repl) {
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

        $samplescopeData = [
            'bioproject_id' => $bioproject->id,
            'samplescope_id' => $validatedData['samplescope_id'],
            'description' => $validatedData['samplescopedesc']
        ];
        SampleBioproject::create($samplescopeData);

        $targetData = [
            'bioproject_id' => $bioproject->id,
            'organism_novel' => $validatedData['novel_org'],
            'organism_novel_description' => $validatedData['novel_desc'],
            'organism_sbc' => $validatedData['sbc'],
            'organism_isolate' => $validatedData['isolate'],
            'organism_desc' => $validatedData['org_desc'],
            'celularity_id' => $validatedData['celularity_id'],
            'reproduction_id' => $validatedData['reproduction_id'],
            'ploidy_id' => $validatedData['ploidy_id'],
            'ploidy_description' => $validatedData['plodesc'],
            'haploid_genome_size' => $validatedData['haploid_size'],
            'genome_size_id' => $validatedData['genome_size_id'],
            'phenotypes_disease' => $validatedData['disease'],
            'biotic_relationship_id' => $validatedData['bio_rel_id'],
            'trophic_level_id' => $validatedData['trop_level_id'],
            'prokaryote_morphology_gram' => $validatedData['gram'],
            'prokaryote_morphology_enveloped' => $validatedData['enveloped'],
            'prokaryote_morphology_motility' => $validatedData['motility'],
            'prokaryote_morphology_endospores' => $validatedData['endospores'],
            'habitat_id' => $validatedData['habitat_id'],
            'salinity_id' => $validatedData['salinity_id'],
            'oxygen_req_id' => $validatedData['oxygen_id'],
            'temp_range_id' => $validatedData['temp_range_id'],
            'optimum_temp' => $validatedData['optimum_temp'],
        ];
        // $bioproject->target()->create($targetData);
        BioprojectTarget::create($targetData);

        if (count($validatedData['repls']) > 0) {
            foreach ($validatedData['repls'] as  $item => $value) {
                $data1 = array(
                    'bioproject_id' => $bioproject->id,
                    'repl_type_id' => $validatedData['repls'][$item]['repl_type_id'],
                    'repl_name' => $validatedData['repls'][$item]['repl_name'],
                    'repl_loc_id' => $validatedData['repls'][$item]['repl_loc_id'],
                    'repl_size' => $validatedData['repls'][$item]['repl_size'],
                    'genome_size2_id' => $validatedData['repls'][$item]['genome_size2_id'],
                );
                OrganismReplicon::create($data1);
            }
        }


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
                    'description' => $validatedData['datatypedesc']
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

        if (count($validatedData['objective_id']) > 0) {
            foreach ($validatedData['objective_id'] as $item => $value) {
                $data6 = array(
                    'bioproject_id' => $bioproject->id,
                    'objective_id' => $validatedData['objective_id'][$item],
                    'description' => $validatedData['objdesc']
                );
                ObjectiveBioProject::create($data6);
            }
        }

        session()->flash('message', 'Bioproject successfully created.');
        // delete associated draft if present
        if ($this->draftId) {
            try {
                BioprojectDraft::where('id', $this->draftId)->where('user_id', auth()->id())->delete();
            } catch (\Throwable $e) {
                logger()->debug('Failed to delete bioproject draft after submit: ' . $e->getMessage());
            }
        }
        return redirect()->to('/dashboard/bioprojects/' . $bioproject->accession);
    }

    /** Save current component state as a draft for the authenticated user. */
    public function saveDraft()
    {
        $payload = [
            'currentStep' => $this->currentStep,
            'hold_release' => $this->hold_release,
            'title' => $this->title,
            'description' => $this->description,
            'relevance_id' => $this->relevance_id ?? null,
            'umbproject_id' => $this->umbproject_id ?? null,
            'externallinks' => $this->externallinks ?? [],
            'grants' => $this->grants ?? [],
            'publications' => $this->publications ?? [],
            'data_type_id' => $this->data_type_id ?? [],
            'samplescope_id' => $this->samplescope_id ?? null,
            'material_id' => $this->material_id ?? null,
            'capture_id' => $this->capture_id ?? null,
            'methodology_id' => $this->methodology_id ?? null,
            'consortium_id' => $this->consortium_id ?? null,
            'organism_id' => $this->organism_id ?? null,

            // target + replicons
            'novel_org' => $this->novel_org ?? null,
            'novel_desc' => $this->novel_desc ?? null,
            'sbc' => $this->sbc ?? null,
            'isolate' => $this->isolate ?? null,
            'org_desc' => $this->org_desc ?? null,
            'celularity_id' => $this->celularity_id ?? null,
            'reproduction_id' => $this->reproduction_id ?? null,
            'ploidy_id' => $this->ploidy_id ?? null,
            'plodesc' => $this->plodesc ?? null,
            'haploid_size' => $this->haploid_size ?? null,
            'genome_size_id' => $this->genome_size_id ?? null,
            'disease' => $this->disease ?? null,
            'bio_rel_id' => $this->bio_rel_id ?? null,
            'trop_level_id' => $this->trop_level_id ?? null,
            'gram' => $this->gram ?? null,
            'enveloped' => $this->enveloped ?? null,
            'motility' => $this->motility ?? null,
            'endospores' => $this->endospores ?? null,
            'habitat_id' => $this->habitat_id ?? null,
            'salinity_id' => $this->salinity_id ?? null,
            'oxygen_id' => $this->oxygen_id ?? null,
            'temp_range_id' => $this->temp_range_id ?? null,
            'optimum_temp' => $this->optimum_temp ?? null,
            'repls' => $this->repls ?? [],
        ];

        if ($this->draftId) {
            $draft = BioprojectDraft::where('id', $this->draftId)->where('user_id', auth()->id())->first();
            if ($draft) {
                $draft->update(['data' => $payload, 'status' => 'draft']);
            } else {
                $draft = BioprojectDraft::create(['user_id' => auth()->id(), 'title' => 'Bioproject draft ' . now()->toDateTimeString(), 'data' => $payload, 'status' => 'draft']);
            }
        } else {
            $draft = BioprojectDraft::create(['user_id' => auth()->id(), 'title' => 'Bioproject draft ' . now()->toDateTimeString(), 'data' => $payload, 'status' => 'draft']);
        }

        $this->draftId = $draft->id;
        $this->dispatchBrowserEvent('ajax-alert', ['type' => 'success', 'message' => 'Draft saved']);
    }

    /** Load draft into component state (only drafts owned by user). */
    public function loadDraft($id)
    {
        $draft = BioprojectDraft::where('id', $id)->where('user_id', auth()->id())->first();
        if (! $draft) {
            $this->dispatchBrowserEvent('ajax-alert', ['type' => 'danger', 'message' => 'Draft not found']);
            return;
        }

        $this->draftId = $draft->id;
        $data = $draft->data ?? [];
        $this->currentStep = $data['currentStep'] ?? $this->currentStep;
        $this->hold_release = $data['hold_release'] ?? $this->hold_release;
        $this->title = $data['title'] ?? $this->title;
        $this->description = $data['description'] ?? $this->description;
        $this->relevance_id = $data['relevance_id'] ?? $this->relevance_id;
        $this->umbproject_id = $data['umbproject_id'] ?? $this->umbproject_id;
        $this->externallinks = $data['externallinks'] ?? $this->externallinks;
        $this->grants = $data['grants'] ?? $this->grants;
        $this->publications = $data['publications'] ?? $this->publications;
        $this->data_type_id = $data['data_type_id'] ?? $this->data_type_id;
        $this->samplescope_id = $data['samplescope_id'] ?? $this->samplescope_id;
        $this->material_id = $data['material_id'] ?? $this->material_id;
        $this->capture_id = $data['capture_id'] ?? $this->capture_id;
        $this->methodology_id = $data['methodology_id'] ?? $this->methodology_id;
        $this->consortium_id = $data['consortium_id'] ?? $this->consortium_id;
        $this->organism_id = $data['organism_id'] ?? $this->organism_id;

        // target + replicons
        $this->novel_org = $data['novel_org'] ?? $this->novel_org;
        $this->novel_desc = $data['novel_desc'] ?? $this->novel_desc;
        $this->sbc = $data['sbc'] ?? $this->sbc;
        $this->isolate = $data['isolate'] ?? $this->isolate;
        $this->org_desc = $data['org_desc'] ?? $this->org_desc;
        $this->celularity_id = $data['celularity_id'] ?? $this->celularity_id;
        $this->reproduction_id = $data['reproduction_id'] ?? $this->reproduction_id;
        $this->ploidy_id = $data['ploidy_id'] ?? $this->ploidy_id;
        $this->plodesc = $data['plodesc'] ?? $this->plodesc;
        $this->haploid_size = $data['haploid_size'] ?? $this->haploid_size;
        $this->genome_size_id = $data['genome_size_id'] ?? $this->genome_size_id;
        $this->disease = $data['disease'] ?? $this->disease;
        $this->bio_rel_id = $data['bio_rel_id'] ?? $this->bio_rel_id;
        $this->trop_level_id = $data['trop_level_id'] ?? $this->trop_level_id;
        $this->gram = $data['gram'] ?? $this->gram;
        $this->enveloped = $data['enveloped'] ?? $this->enveloped;
        $this->motility = $data['motility'] ?? $this->motility;
        $this->endospores = $data['endospores'] ?? $this->endospores;
        $this->habitat_id = $data['habitat_id'] ?? $this->habitat_id;
        $this->salinity_id = $data['salinity_id'] ?? $this->salinity_id;
        $this->oxygen_id = $data['oxygen_id'] ?? $this->oxygen_id;
        $this->temp_range_id = $data['temp_range_id'] ?? $this->temp_range_id;
        $this->optimum_temp = $data['optimum_temp'] ?? $this->optimum_temp;
        $this->repls = $data['repls'] ?? $this->repls;

        $this->dispatchBrowserEvent('draft-loaded', ['draft' => $data]);
        $this->dispatchBrowserEvent('ajax-alert', ['type' => 'success', 'message' => 'Draft loaded']);
    }

    /** Permanently delete the current draft for this user and clear draftId. */
    public function discardDraft()
    {
        if (! $this->draftId) {
            $this->dispatchBrowserEvent('ajax-alert', ['type' => 'warning', 'message' => 'No draft to discard']);
            return;
        }

        try {
            $draft = BioprojectDraft::where('id', $this->draftId)->where('user_id', auth()->id())->first();
            if ($draft) {
                $draft->delete();
                $this->draftId = null;
                $this->dispatchBrowserEvent('draft-discarded');
                $this->dispatchBrowserEvent('ajax-alert', ['type' => 'success', 'message' => 'Draft discarded']);
            } else {
                $this->dispatchBrowserEvent('ajax-alert', ['type' => 'danger', 'message' => 'Draft not found']);
            }
        } catch (\Exception $e) {
            logger()->error('Failed to discard bioproject draft: ' . $e->getMessage());
            $this->dispatchBrowserEvent('ajax-alert', ['type' => 'danger', 'message' => 'Failed to discard draft']);
        }
    }

    public function render()
    {
        // info($this->grants);
        return view('livewire.bioproject.create');
    }
}

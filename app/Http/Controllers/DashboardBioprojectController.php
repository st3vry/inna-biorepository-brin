<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\Bioproject;
use App\Models\Datatype;
use App\Models\Fundagency;
use App\Models\Grant;
use App\Models\MaterialBioproject;
use App\Models\CaptureBioproject;
use App\Models\RelevanceBioproject;
use App\Models\MethodologyBioproject;
use App\Models\Publication;
use App\Models\SampleBioproject;
use App\Models\DatatypeBioproject;
use App\Models\BioProjectExternalLink;
use App\Models\BioprojectDraft;
use App\Models\ObjectiveBioProject;
use App\Models\BioprojectTarget;
use App\Models\OrganismReplicon;

use Illuminate\Http\Request;

class DashboardBioprojectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bioproject = Bioproject::with(['organism', 'center', 'user'])->where('user_id', auth()->user()->id)->orderBy('id')->get();

        $hasDraft = false;
        try {
            $hasDraft = BioprojectDraft::where('user_id', auth()->id())->where('status', 'draft')->exists();
        } catch (\Throwable $e) {
            // ignore if drafts table/model not available
            logger()->debug('Could not check bioarchive drafts: ' . $e->getMessage());
        }
        return view('dashboard.bioproject.index', [
            'bioprojects' => $bioproject
            ,'hasDraft' => $hasDraft,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.bioproject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'relevance' => 'required',
            'data_type_id' => 'required',
            'data_type_id.*' => 'numeric',
            'samplescope_id' => 'required',
            'organism_id' => 'required',
            'title' => 'required',
            'umbproject_id' => 'required',
            'description' => 'required',
            'grants.*.fundagency_id' => 'required',
            'grants.*.program' => 'required',
            'grants.*.title' => 'required',
        ]);
        $bioproject = new Bioproject;;
        $bioproject->accession = 'INNAP' . sprintf('%06d', intval($bioproject->query()->max("id")) + 1);
        $bioproject->submission_id = 'INNASUBP' . sprintf('%06d', intval($bioproject->query()->max("id")) + 1);
        $bioproject->relevance = $data['relevance'];
        $bioproject->data_type_id = implode(",", $data['data_type_id']);
        // $bioproject->objective_id = implode(",", $data['objective_id']);
        $bioproject->samplescope_id = $data['samplescope_id'];
        $bioproject->umbproject_id = $data['umbproject_id'];
        $bioproject->organism_id = $data['organism_id'];
        $bioproject->consortium_id = $data['consortium_id'];
        $bioproject->title = $data['title'];
        $bioproject->description = $data['description'];
        $bioproject->center_id = auth()->user()->lab->center_id;
        $bioproject->user_id = auth()->user()->id;
        // dd($data);
        // $bioproject->save();
        $result = $bioproject->save();
        if ($result) {
            return redirect('/dashboard/bioprojects')->with('success', 'New Bioproject has been added!');
            $relevanceData = [
                'bioproject_id' => $bioproject->id,
                'relevance_id' => $data['relevance_id'],
                'description' => $data['reldesc']
            ];
            RelevanceBioproject::create($relevanceData);
            $materialData = [
                'bioproject_id' => $bioproject->id,
                'material_id' => $data['material_id'],
                'description' => $data['matdesc']
            ];
            MaterialBioproject::create($materialData);

            $captureData = [
                'bioproject_id' => $bioproject->id,
                'capture_id' => $data['capture_id'],
                'description' => $data['capdesc']
            ];
            CaptureBioproject::create($captureData);

            $methodologyData = [
                'bioproject_id' => $bioproject->id,
                'methodology_id' => $data['methodology_id'],
                'description' => $data['metdesc']
            ];
            MethodologyBioproject::create($methodologyData);

            $samplescopeData = [
                'bioproject_id' => $bioproject->id,
                'samplescope_id' => $data['samplescope_id'],
                'description' => $data['samplescopedesc']
            ];
            SampleBioproject::create($samplescopeData);


            if (count($data['grants']) > 0) {
                foreach ($data['grants'] as  $item => $value) {
                    $data2 = array(
                        'bioproject_id' => $bioproject->id,
                        'fundagency_id' => $data['grants'][$item]['fundagency_id'],
                        'grant_title' => $data['grants'][$item]['grant_title'],
                        'grant_program' => $data['grants'][$item]['grant_program'],
                    );
                    Grant::create($data2);
                }
            }
            if (count($data['publications']) > 0) {
                foreach ($data['publications'] as  $item => $value) {
                    $data3 = array(
                        'bioproject_id' => $bioproject->id,
                        'pub_identifier_id' => $data['publications'][$item]['pub_identifier_id'],
                        'pub_id' => $data['publications'][$item]['pub_id'],
                        'article_title' => $data['publications'][$item]['article_title'],
                    );
                    Publication::create($data3);
                }
            }

            if (count($data['data_type_id']) > 0) {
                foreach ($data['data_type_id'] as $item => $value) {
                    $data4 = array(
                        'bioproject_id' => $bioproject->id,
                        'datatype_id' => $data['data_type_id'][$item],
                        'description' => $data['datatypedesc']
                    );
                    DatatypeBioproject::create($data4);
                }
            }

            if (count($data['externallinks']) > 0) {
                foreach ($data['externallinks'] as  $item => $value) {
                    $data5 = array(
                        'bioproject_id' => $bioproject->id,
                        'link_description' => $data['externallinks'][$item]['link_description'],
                        'link_url' => $data['externallinks'][$item]['link_url'],
                    );
                    BioProjectExternalLink::create($data5);
                }
            }

            if (count($data['objective_id']) > 0) {
                foreach ($data['objective_id'] as $item => $value) {
                    $data6 = array(
                        'bioproject_id' => $bioproject->id,
                        'objective_id' => $data['objective_id'][$item],
                        'description' => $data['objdesc']
                    );
                    ObjectiveBioProject::create($data6);
                }
            }
        } else {
            return 0;
        }
        // else {
        //       return ke java script        
        // }


        // if (count($data['grants']) > 0) {
        //     foreach ($data['grants'] as  $item => $value) {
        //         $data2 = array(
        //             'bioproject_id' => $bioproject->id,
        //             'fundagency_id' => $data['grants'],
        //             'grant_title' => $data['grants'],
        //             'grant_program' => $data['grants'][$item],
        //         );
        //         // dd($data2);
        //         Grant::create($data2);
        //     }
        // }
        // dd($bioproject);

        // return nanti redirect ke reload halaman if else untuk check error
        // action log storing
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bioproject  $bioproject
     * @return \Illuminate\Http\Response
     */
    public function show(Bioproject $bioproject)
    {
        //
        // return $bioproject;

        //get dari model
        $pubs = $bioproject->publication()->get();
        $grants = $bioproject->grant()->get();
        $externallinks = $bioproject->externallink()->get();
        $id_data_type = explode(',', $bioproject->getAttribute('data_type_id'));
        $data_types = Datatype::whereIn('id', $id_data_type)->pluck('name');
        $umbrella = Bioproject::where('id', $bioproject->umbproject_id)->first();
        $consortium = Bioproject::where('id', $bioproject->consortium_id)->first();
        $relevanceBioproject = RelevanceBioproject::where('bioproject_id', $bioproject->id)->first();
        $materialBioproject = MaterialBioproject::where('bioproject_id', $bioproject->id)->first();
        $captureBioproject = CaptureBioproject::where('bioproject_id', $bioproject->id)->first();
        $methodologyBioproject = MethodologyBioproject::where('bioproject_id', $bioproject->id)->first();
        $histories = ActionLog::with(['creator'])->where('item_id', $bioproject->accession)->orderBy('created_at', 'desc')->get();
        $sampleScopeBioproject = SampleBioproject::where('bioproject_id', $bioproject->id)->first();

        $target = BioprojectTarget::with([
            'celularity',
            'reproduction',
            'ploidy',
            'genomeSize',
            'bioticRelationship',
            'trophicLevel',
            'habitat',
            'salinity',
            'oxygenReq',
            'tempRange',
        ])->where('bioproject_id', $bioproject->id)->first();

        $replicons = OrganismReplicon::with([
            'replType',
            'replLocation',
            'genomeSize',
        ])->where('bioproject_id', $bioproject->id)->get();

        //kirim data ke view
        return view('dashboard.bioproject.show', [
            'bioproject' => $bioproject,
            'pubs' => $pubs,
            'grants' => $grants,
            'data_types' => $data_types,
            'relevance' => $relevanceBioproject,
            'material' => $materialBioproject,
            'capture' => $captureBioproject,
            'methodology' => $methodologyBioproject,
            'umbrella' => $umbrella,
            'externallinks' => $externallinks,
            'histories' => $histories,
            'consortium' => $consortium,
            'target' => $target,
            'replicons' => $replicons,
            'sampleScopeBioproject' => $sampleScopeBioproject,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bioproject  $bioproject
     * @return \Illuminate\Http\Response
     */
    public function edit(Bioproject $bioproject)
    {
        //
        // if (!empty($bioproject->published_at)) {
        //     // return 'ada published at';
        //     return view('error.404');
        // }

        if ($bioproject->draft == false) {
            return view('error.404');
        }
        // dd($bioproject);
        return view('dashboard.bioproject.edit')->with('bioproject', $bioproject);
        // return (!empty($bioproject->published_at));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bioproject  $bioproject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bioproject $bioproject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bioproject  $bioproject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bioproject $bioproject)
    {
        //
        Bioproject::destroy($bioproject->id);
        return redirect('/dashboard/bioprojects')->with('success', 'Bioproject has been deleted!');
    }

    public function fetchfundingagency()
    {
        $fundagencies = Fundagency::All();
        return response()->json($fundagencies);
    }
}

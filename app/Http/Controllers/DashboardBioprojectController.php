<?php

namespace App\Http\Controllers;

use App\Models\Bioproject;
use App\Models\Datatype;
use App\Models\Fundagency;
use App\Models\Grant;
use App\Models\MaterialBioproject;
use App\Models\CaptureBioproject;
use App\Models\RelevanceBioproject;
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
        return view('dashboard.bioproject.index', [
            'bioprojects' => Bioproject::with(['organism', 'center', 'user'])->where('user_id', auth()->user()->id)->paginate(5),
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
        $bioproject = new Bioproject;
        $bioproject->accession = 'PRJ' . sprintf('%06d', intval($bioproject->query()->max("id")) + 1);
        $bioproject->submission_id = 'SUBPRJ' . sprintf('%06d', intval($bioproject->query()->max("id")) + 1);
        $bioproject->relevance = $data['relevance'];
        $bioproject->data_type_id = implode(",", $data['data_type_id']);
        $bioproject->samplescope_id = $data['samplescope_id'];
        $bioproject->umbproject_id = $data['umbproject_id'];
        $bioproject->organism_id = $data['organism_id'];
        $bioproject->title = $data['title'];
        $bioproject->description = $data['description'];
        $bioproject->center_id = auth()->user()->lab->center_id;
        $bioproject->user_id = auth()->user()->id;
        // dd($data);
        $bioproject->save();


        if (count($data['grants']) > 0) {
            foreach ($data['grants'] as  $item => $value) {
                $data2 = array(
                    'bioproject_id' => $bioproject->id,
                    'fundagency_id' => $data['grants'],
                    'grant_title' => $data['grants'],
                    'grant_program' => $data['grants'][$item],
                );
                // dd($data2);
                Grant::create($data2);
            }
        }
        // dd($bioproject);
        return redirect('/dashboard/bioprojects')->with('success', 'New Bioproject has been added!');
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

        $pubs = $bioproject->publication()->get();
        $grants = $bioproject->grant()->get();
        $id_data_type = explode(',', $bioproject->getAttribute('data_type_id'));
        $data_types = Datatype::whereIn('id', $id_data_type)->pluck('name');
        $umbrella = Bioproject::where('id', $bioproject->umbproject_id)->first();
        $relevanceBioproject = RelevanceBioproject::where('bioproject_id', $bioproject->id)->first();
        $materialBioproject = MaterialBioproject::where('bioproject_id', $bioproject->id)->first();
        $captureBioproject = CaptureBioproject::where('bioproject_id', $bioproject->id)->first();
        return view('dashboard.bioproject.show', [
            'bioproject' => $bioproject,
            'pubs' => $pubs,
            'grants' => $grants,
            'data_types' => $data_types,
            'relevance' => $relevanceBioproject,
            'material' => $materialBioproject,
            'capture' => $captureBioproject,
            'umbrella' => $umbrella
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
        if (!empty($bioproject->published_at)) {
            // return 'ada published at';
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

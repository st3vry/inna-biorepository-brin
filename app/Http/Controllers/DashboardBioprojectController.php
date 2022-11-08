<?php

namespace App\Http\Controllers;

use App\Models\Bioproject;
use App\Models\Datatype;
use App\Models\Fundagency;
use App\Models\Grant;
use App\Models\Organism;
use App\Models\Samplescope;
use App\Models\Umbrellaproject;
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
        // return Bioproject::all();
        return view('dashboard.bioproject.index', [
            'bioprojects' => Bioproject::with(['organism'])->where('user_id', auth()->user()->id)->paginate(6),
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
        $organisms = Organism::all();
        $fundagencies = Fundagency::all();
        $umbrellas = Umbrellaproject::all();
        $datatypes = Datatype::all();
        $samplescopes = Samplescope::all();
        return view('dashboard.bioproject.create', [
            'organisms' => $organisms,
            'fundagencies' => $fundagencies,
            'umbrellas' => $umbrellas,
            'datatypes' => $datatypes,
            'samplescopes' => $samplescopes,
        ]);
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
            'grant_title.*' => 'required',
            'grant_program.*' => 'required',
            'fundagency_id.*' => 'required'
        ]);
        // dd($data);
        $bioproject = new Bioproject;
        $bioproject->alias = 'PRJ' . sprintf('%06d', intval($bioproject->query()->max("id")) + 1);
        $bioproject->relevance = $data['relevance'];
        $bioproject->data_type_id = implode(",", $data['data_type_id']);
        $bioproject->samplescope_id = $data['samplescope_id'];
        $bioproject->umbproject_id = $data['umbproject_id'];
        $bioproject->organism_id = $data['organism_id'];
        $bioproject->title = $data['title'];
        $bioproject->description = $data['description'];
        $bioproject->center_id = auth()->user()->lab->center_id;
        $bioproject->user_id = auth()->user()->id;
        // $bioproject->save();


        if (count($data['fundagency_id']) > 0) {
            foreach ($data['fundagency_id'] as  $item => $value) {
                $data2 = array(
                    'bioproject_id' => $bioproject->id,
                    'fundagency_id' => $data['fundagency_id'][$item],
                    'grant_title' => $data['grant_title'][$item],
                    'grant_program' => $data['grant_program'][$item],
                );
                // Grant::create($data2);
                dd($data2);
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
        return view('dashboard.bioproject.show', [
            'bioproject' => $bioproject,
            'pubs' => $pubs,
            'grants' => $grants,
            'data_types' => $data_types
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
    }

    public function fetchfundingagency()
    {
        $fundagencies = Fundagency::All();
        return response()->json($fundagencies);
    }
}

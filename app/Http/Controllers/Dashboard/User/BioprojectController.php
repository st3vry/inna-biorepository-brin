<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Models\Bioproject;
use App\Models\Datatype;
use App\Models\RelevanceBioproject;
use App\Models\MaterialBioproject;
use App\Models\CaptureBioproject;
use App\Models\MethodologyBioproject;
use App\Models\ActionLog;
use Illuminate\Http\Request;

class BioprojectController extends Controller
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
            // 'bioprojects' => Bioproject::with(['organism', 'center', 'user'])->where('user_id', auth()->user()->id)->where('status', 1)->where('published_at', '<>', null)->orderBy('published_at', 'desc')->orderBy('draft', 'desc')->paginate(5),
            'bioprojects' => Bioproject::with(['organism', 'center', 'user'])->where('user_id', auth()->user()->id)->orderBy('id')->get(),
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
        $validatedData = $request->validate([
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
        $bioproject = new Bioproject();
        $bioproject->accession = 'INNAP' . sprintf('%06d', intval($bioproject->query()->max("id")) + 1);
        $bioproject->submission_id = 'INNASUBP' . sprintf('%06d', intval($bioproject->query()->max("id")) + 1);
        $bioproject->data_type_id = implode(",", $validatedData['data_type_id']);
        $bioproject->objective_id = implode(",", $validatedData['objective_id']);
        $bioproject->samplescope_id = $validatedData['samplescope_id'];
        // sample scope

        $bioproject->umbproject_id = $validatedData['umbproject_id'];
        $bioproject->organism_id = $validatedData['organism_id'];
        $bioproject->consortium_id = $validatedData['consortium_id'];
        $bioproject->title = $validatedData['title'];
        $bioproject->description = $validatedData['description'];
        $bioproject->hold_release = $validatedData['hold_release'];
        $bioproject->center_id = auth()->user()->lab->center_id;
        $bioproject->user_id = auth()->user()->id;

        $bioproject->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    public function show(Bioproject $bioproject)
    {
        //
        $pubs = $bioproject->publication()->get();
        $grants = $bioproject->grant()->get();
        $externallinks = $bioproject->externallink()->get();
        $id_data_type = explode(',', $bioproject->getAttribute('data_type_id'));
        $data_types = Datatype::whereIn('id', $id_data_type)->pluck('name');
        $umbrella = Bioproject::where('id', $bioproject->umbproject_id)->first();
        $relevanceBioproject = RelevanceBioproject::where('bioproject_id', $bioproject->id)->first();
        $materialBioproject = MaterialBioproject::where('bioproject_id', $bioproject->id)->first();
        $captureBioproject = CaptureBioproject::where('bioproject_id', $bioproject->id)->first();
        $methodologyBioproject = MethodologyBioproject::where('bioproject_id', $bioproject->id)->first();
        $histories = ActionLog::with(['creator'])->where('item_id', $bioproject->accession)->orderBy('created_at', 'desc')->get();

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
            'histories' => $histories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

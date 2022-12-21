<?php

namespace App\Http\Controllers;

use App\Models\Bioproject;
use App\Models\CaptureBioproject;
use App\Models\Datatype;
use App\Models\MaterialBioproject;
use App\Models\MethodologyBioproject;
use App\Models\RelevanceBioproject;

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

        return view('frontend.bioproject', [
            'title' => 'Bioproject',
            'bioprojects' => Bioproject::with(['organism'])->whereNotNull('published_at')->paginate(5),
        ]);
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
        if ($bioproject->published_at == null) {
            return view('error.404');
        }
        $pubs = $bioproject->publication()->get();
        $grants = $bioproject->grant()->get();
        $externallinks = $bioproject->bp_externalLinks()->get();
        $id_data_type = explode(',', $bioproject->getAttribute('data_type_id'));
        $data_types = Datatype::whereIn('id', $id_data_type)->pluck('name');
        $umbrella = Bioproject::where('id', $bioproject->umbproject_id)->first();
        $relevanceBioproject = RelevanceBioproject::where('bioproject_id', $bioproject->id)->first();
        $materialBioproject = MaterialBioproject::where('bioproject_id', $bioproject->id)->first();
        $captureBioproject = CaptureBioproject::where('bioproject_id', $bioproject->id)->first();
        $methodologyBioproject = MethodologyBioproject::where('bioproject_id', $bioproject->id)->first();
        return view('frontend.showbioproject', [
            'title' => 'Bioproject',
            'bioproject' => $bioproject,
            'pubs' => $pubs,
            'grants' => $grants,
            'data_types' => $data_types,
            'relevance' => $relevanceBioproject,
            'material' => $materialBioproject,
            'capture' => $captureBioproject,
            'methodology' => $methodologyBioproject,
            'umbrella' => $umbrella,
            'externallinks' => $externallinks
        ]);
    }
}

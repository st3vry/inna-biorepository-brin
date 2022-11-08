<?php

namespace App\Http\Controllers;

use App\Models\Bioproject;
use App\Models\Datatype;
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
        $pubs = $bioproject->publication()->get();
        $grants = $bioproject->grant()->get();
        $id_data_type = explode(',', $bioproject->getAttribute('data_type_id'));
        $data_types = Datatype::whereIn('id', $id_data_type)->pluck('name');
        return view('frontend.showbioproject', [
            'title' => 'Bioproject',
            'bioproject' => $bioproject,
            'pubs' => $pubs,
            'grants' => $grants,
            'data_types' => $data_types
        ]);
    }
}

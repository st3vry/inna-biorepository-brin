<?php

namespace App\Http\Controllers;

use App\Models\Bioproject;
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
            // 'bioprojects' => Bioproject::with(['organism'])->get(),
            'bioprojects' => Bioproject::with(['organism'])->paginate(5),
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
        return view('frontend.showbioproject', [
            'title' => 'Bioproject',
            'bioproject' => $bioproject,
            'pubs' => $pubs,
            'grants' => $grants
        ]);
    }
}

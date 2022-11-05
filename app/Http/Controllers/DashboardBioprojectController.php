<?php

namespace App\Http\Controllers;

use App\Models\Bioproject;
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
        return view('dashboard.bioproject.create', []);
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
        // dd($pubs);
        return view('dashboard.bioproject.show', [
            'bioproject' => $bioproject,
            'pubs' => $pubs
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
}

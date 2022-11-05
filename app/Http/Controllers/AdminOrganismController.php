<?php

namespace App\Http\Controllers;

use App\Models\Organism;
use Illuminate\Http\Request;

class AdminOrganismController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $this->authorize('admin');
        return view('dashboard.organism.index', [
            'organisms' => Organism::all(),
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
     * @param  \App\Models\Organism  $organism
     * @return \Illuminate\Http\Response
     */
    public function show(Organism $organism)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organism  $organism
     * @return \Illuminate\Http\Response
     */
    public function edit(Organism $organism)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organism  $organism
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organism $organism)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organism  $organism
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organism $organism)
    {
        //
    }
}

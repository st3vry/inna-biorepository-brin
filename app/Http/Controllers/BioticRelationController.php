<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BioticRelationship;

class BioticRelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // dd("here");
        return view('dashboard.bioticrel.index', [
            'bioticrels' => BioticRelationship::all(),
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
        return view('dashboard.bioticrel.create');
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
            'name' => 'required'
        ]);

        BioticRelationship::create($validatedData);
        return redirect('/dashboard/bioticrels')->with('success', 'New Biotic Relationship has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BioticRelationship $bioticrel)
    {
        //
        return view('dashboard.bioticrel.edit', [
            'bioticrel' => $bioticrel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BioticRelationship $bioticrel)
    {
        //
        $rules = [
            'name' => 'required'
        ];

        if ($request->taxon_id != $bioticrel->taxon_id) {
            $rules['code'] = 'required|unique:roles';
        }

        $validatedData = $request->validate($rules);

        BioticRelationship::where('id', $bioticrel->id)->update($validatedData);
        return redirect('/dashboard/bioticrels')->with('success', 'Biotic Relationship has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BioticRelationship $bioticrel)
    {
        //
        BioticRelationship::destroy($bioticrel->id);
        return redirect('/dashboard/bioticrels')->with('success', 'Biotic Relationship has been deleted!');
    }
}

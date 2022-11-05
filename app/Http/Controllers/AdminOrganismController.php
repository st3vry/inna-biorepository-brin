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
        return view('dashboard.organism.create');
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
        // return $request;
        $validatedData = $request->validate([
            'taxon_id' => 'required|unique:organisms',
            'name' => 'required'
        ]);

        Organism::create($validatedData);
        return redirect('/dashboard/organisms')->with('success', 'New Organism has been added!');
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
        return view('dashboard.organism.edit', [
            'organism' => $organism,
        ]);
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
        $rules = [
            'name' => 'required'
        ];

        if ($request->taxon_id != $organism->taxon_id) {
            $rules['taxon_id'] = 'required|unique:organism';
        }

        $validatedData = $request->validate($rules);

        Organism::where('id', $organism->id)->update($validatedData);
        return redirect('/dashboard/organisms')->with('success', 'Organism has been updated!');
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
        Organism::destroy($organism->id);
        return redirect('/dashboard/organisms')->with('success', 'Organism has been deleted!');
    }
}

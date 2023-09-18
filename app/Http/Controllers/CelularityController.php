<?php

namespace App\Http\Controllers;

use App\Models\Celularity;
use Illuminate\Http\Request;

class CelularityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.celularity.index', [
            'celularities' => Celularity::all(),
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
        return view('dashboard.celularity.create');
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

        Celularity::create($validatedData);
        return redirect('/dashboard/celularities')->with('success', 'New Celularity has been added!');
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
    public function edit(Celularity $celularity)
    {
        //
        return view('dashboard.celularity.edit', [
            'celularity' => $celularity,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Celularity $celularity)
    {
        //
        $rules = [
            'name' => 'required'
        ];

        $validatedData = $request->validate($rules);

        Celularity::where('id', $celularity->id)->update($validatedData);
        return redirect('/dashboard/celularities')->with('success', 'Celularity has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Celularity $celularity)
    {
        //
        Celularity::destroy($celularity->id);
        return redirect('/dashboard/celularities')->with('success', 'Celularity has been deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Administrative;
use Illuminate\Http\Request;

class AdministrativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.administrative.index', [
            'administratives' => Administrative::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.administrative.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'website' => ''
        ]);

        Administrative::create($validatedData);
        return redirect('/dashboard/administratives')->with('success', 'New Administrative has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrative  $administrative
     * @return \Illuminate\Http\Response
     */
    public function show(Administrative $administrative)
    {
        return view('dashboard.administrative.show', [
            'administrative' => $administrative
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Administrative  $administrative
     * @return \Illuminate\Http\Response
     */
    public function edit(Administrative $administrative)
    {
        return view('dashboard.administrative.edit', [
            'administrative' => $administrative
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administrative  $administrative
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Administrative $administrative)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'website' => ''
        ]);

        Administrative::where('id', $administrative->id)->update($validatedData);
        return redirect('/dashboard/administratives')->with('success', 'Administrative updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrative  $administrative
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrative $administrative)
    {
        Administrative::destroy($administrative->id);
        return redirect('/dashboard/administratives')->with('success', 'Administrative deleted successfully!');
    }
}

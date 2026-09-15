<?php

namespace App\Http\Controllers;

use App\Models\Consortium;
use Illuminate\Http\Request;

class ConsortiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.consortia.index', [
            'consortium' => Consortium::all(),
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
        return view('dashboard.consortia.create');
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
            'name' => 'required',
            'url' => 'required',
        ]);

        Consortium::create($validatedData);
        return redirect('/dashboard/consortium')->with('success', 'New Consortia has been added!');
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
    public function edit(Consortium $consortium)
    {
        //
        return view('dashboard.consortia.edit', [
            'consortia' => $consortium,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consortium $consortium)
    {
        //
        $rules = [
            'name' => 'required',
            'url' => 'required'
        ];

        $validatedData = $request->validate($rules);

        Consortium::where('id', $consortium->id)->update($validatedData);
        return redirect('/dashboard/consortium')->with('success', 'Center has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consortium $consortium)
    {
        //
        Consortium::destroy($consortium->id);
        return redirect('/dashboard/consortium')->with('success', 'Consortia has been deleted!');
    }
}

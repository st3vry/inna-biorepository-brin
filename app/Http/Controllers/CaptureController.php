<?php

namespace App\Http\Controllers;

use App\Models\Capture;
use Illuminate\Http\Request;

class CaptureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.capture.index', [
            'captures' => Capture::all(),
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
        return view('dashboard.capture.create');
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

        Capture::create($validatedData);
        return redirect('/dashboard/captures')->with('success', 'New Capture has been added!');
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
    public function edit(Capture $capture)
    {
        //
        return view('dashboard.capture.edit', [
            'capture' => $capture,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Capture $capture)
    {
        //
        $rules = [
            'name' => 'required'
        ];

        $validatedData = $request->validate($rules);

        Capture::where('id', $capture->id)->update($validatedData);
        return redirect('/dashboard/captures')->with('success', 'Capture has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Capture $capture)
    {
        //
        Capture::destroy($capture->id);
        return redirect('/dashboard/captures')->with('success', 'Biotic Relationship has been deleted!');
    }
}

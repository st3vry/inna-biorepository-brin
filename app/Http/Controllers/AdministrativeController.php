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
     * @param  \App\Models\Administrative  $administrative
     * @return \Illuminate\Http\Response
     */
    public function show(Administrative $administrative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Administrative  $administrative
     * @return \Illuminate\Http\Response
     */
    public function edit(Administrative $administrative)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrative  $administrative
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrative $administrative)
    {
        //
    }
}

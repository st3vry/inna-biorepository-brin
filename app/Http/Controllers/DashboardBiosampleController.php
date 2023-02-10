<?php

namespace App\Http\Controllers;

use App\Models\Biosample;
use Illuminate\Http\Request;

class DashboardBiosampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.biosample.index', [
            'biosamples' => Biosample::with(['organism', 'center'])->where('user_id', auth()->user()->id)->paginate(5),
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
        return view('dashboard.biosample.create');
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
     * @param  \App\Models\Biosample  $biosample
     * @return \Illuminate\Http\Response
     */
    public function show(Biosample $biosample)
    {
        //
        return view('dashboard.biosample.show', [
            'biosample' => $biosample,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Biosample  $biosample
     * @return \Illuminate\Http\Response
     */
    public function edit(Biosample $biosample)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Biosample  $biosample
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Biosample $biosample)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Biosample  $biosample
     * @return \Illuminate\Http\Response
     */
    public function destroy(Biosample $biosample)
    {
        //
        Biosample::destroy($biosample->id);
        return redirect('/dashboard/biosamples')->with('success', 'Biosamples has been deleted!');
    }

    public function curation()
    {
        //
        return view('dashboard.curation.biosample.index', [
            'biosamples' => Biosample::with(['organism', 'center'])->where('published_at', null)->where('draft',false)->paginate(5),
        ]);
    }
}

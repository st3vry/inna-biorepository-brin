<?php

namespace App\Http\Controllers;

use App\Models\Biosample;
use Illuminate\Http\Request;

class CuratorBioSampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $biosamples = BioSample::with(['organism', 'center'])
            ->where('published_at', null)
            ->orderBy('published_at','desc')
            ->orderBy('curator_id','asc')
            ->paginate(5);
        if (auth()->user()->role_id == 2) {
            $biosamples = BioSample::with(['organism', 'center'])
                ->where('curator_id', auth()->id())
                ->where('draft',false)
                ->orderBy('published_at','desc')
                ->paginate(5);
        }
        return view('dashboard.curator.biosample.index', [
            'title' => 'Biosample',
            'biosamples' => $biosamples,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Biosample $biosample)
    {
        // dd($biosample);
        
        return view('dashboard.curator.biosample.show', [
            'biosample' => $biosample,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

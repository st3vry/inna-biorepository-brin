<?php

namespace App\Http\Controllers;

use App\Models\Biosample;
use App\Models\Datatype;
use Illuminate\Http\Request;

class BiosampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('frontend.biosample', [
            'title' => 'Biosamples',
            'biosamples' => Biosample::with(['organism', 'center', 'user'])->whereNotNull('published_at')->paginate(5),
        ]);
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
        if ($biosample->published_at == null) {
            return view('error.404');
        }

        $biosample_links = $biosample->externallink()->get();

        return view('frontend.showbiosample', [
            'title' => 'Biosample',
            'biosample' => $biosample,
            'biosample_links' => $biosample_links
        ]);
    }
}

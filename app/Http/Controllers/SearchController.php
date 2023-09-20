<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bioproject;
use App\Models\Bioarchive;
use App\Models\Biosample;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $bioprojects =  Bioproject::where('title', 'like', '%'.$request->search.'%')->whereNotNull('published_at')->orderBy('published_at','desc')->pluck('title')->take(3);
        $biosamples = Biosample::where('title', 'like', '%'.$request->search.'%')->whereNotNull('published_at')->orderBy('published_at','desc')->pluck('title')->take(3);
        // $bioarchives = Bioarchive::where('title', 'ILIKE', '%'.$request->search.'%')->whereNotNull('published_at')->orderBy('published_at','desc')->pluck('title')->take(5);
        return response()->json([
            'bioprojects' =>$bioprojects,
            'biosamples' => $biosamples,
            // 'bioarchives' => $bioarchives
        ]);
    
    }
}

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
        $biosamples = Biosample::where('id', 0)->pluck('title')->take(5);
        $bioprojects = Bioproject::where('id', 0)->pluck('title')->take(5);
        $bioarchives = Bioarchive::where('id', 0)->pluck('accession')->take(5);

        if ($request->searchType == "biosample" || $request->searchType == "all") {
            $biosamples = Biosample::where('title', 'ILIKE', '%'.$request->search.'%')->whereNotNull('published_at')->orderBy('published_at','desc')->select('title','accession')->limit(5)->get();
        }
        if ($request->searchType == "bioproject" || $request->searchType == "all") {
            $bioprojects =  Bioproject::where('title', 'ILIKE', '%'.$request->search.'%')->whereNotNull('published_at')->orderBy('published_at','desc')->select('title','accession')->limit(5)->get();
        }
        if ($request->searchType == "bioarchive" || $request->searchType == "all") {
            $bioarchives = Bioarchive::where('accession', 'ILIKE', '%'.$request->search.'%')->whereNotNull('published_at')->orderBy('published_at','desc')->select('accession')->limit(5)->get();
        }
        return response()->json([
            'bioprojects' =>$bioprojects,
            'biosamples' => $biosamples,
            'bioarchives' => $bioarchives
        ]);

    }
}

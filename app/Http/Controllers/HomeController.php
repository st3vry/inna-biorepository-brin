<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bioarchive;
use App\Models\Bioproject;
use App\Models\Biosample;
use App\Models\Datainconcern;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Services\SsoService;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $data_in_concerns = Datainconcern::latest()->take(4)->get();
        $bioprojects_latest = Bioproject::latest()->take(2)->where('draft', FALSE)->whereNotNull('published_at')->get();
        $biosamples_latest = Biosample::latest()->take(2)->where('draft', FALSE)->whereNotNull('published_at')->get();
        $bioarchives_latest = Bioarchive::latest()->take(2)->where('draft', TRUE)->get();


        $bioprojects_count = Bioproject::where('draft', FALSE)->whereNotNull('published_at')->count();
        $biosamples_count = Biosample::where('draft', FALSE)->whereNotNull('published_at')->count();
        $bioarchives_count = Bioarchive::where('draft', FALSE)->count();


        return view('frontend.home', [
            'title' => 'Home',
            'data_in_concerns' => $data_in_concerns,
            'bioprojects_latest' => $bioprojects_latest,
            'biosamples_latest' => $biosamples_latest,
            'bioarchives_latest' => $bioarchives_latest,
            'bioprojects_count' => $bioprojects_count,
            'biosamples_count' => $biosamples_count,
            'bioarchives_count' => $bioarchives_count,

        ]);
    }
}

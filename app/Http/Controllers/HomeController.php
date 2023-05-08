<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bioarchive;
use App\Models\Bioproject;
use App\Models\Biosample;
use App\Models\Datainconcern;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $data_in_concerns = Datainconcern::latest()->take(4)->get();
        $bioprojects_latest = Bioproject::latest()->take(2)->where('draft', FALSE)->get();
        $biosamples_latest = Biosample::latest()->take(2)->where('draft', FALSE)->get();
        $bioarchives_latest = Bioarchive::latest()->take(2)->where('draft', TRUE)->get();
        // dd($data_in_concern);
        return view('frontend.home', [
            'title' => 'Home',
            'data_in_concerns' => $data_in_concerns,
            'bioprojects_latest' => $bioprojects_latest,
            'biosamples_latest' => $biosamples_latest,
            'bioarchives_latest' => $bioarchives_latest,
        ]);
    }
}

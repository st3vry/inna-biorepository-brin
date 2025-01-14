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
        $bioprojects_latest = Bioproject::where('status', 5)->take(3)->orderBy('published_at')->get();
        $biosamples_latest = Biosample::where('status', 5)->take(3)->orderBy('published_at')->get();
        $bioarchives_latest = Bioarchive::where('status', 5)->take(3)->orderBy('published_at')->get();


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

    public function tos()
    {
        return view('frontend.tos', [
            'title' => "Term of Service"
        ]);
    }
    public function privpol()
    {
        return view('frontend.privpol', [
            'title' => "Privacy and Policy"
        ]);
    }
}

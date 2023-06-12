<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bioarchive;
use Illuminate\Http\Request;
use App\Models\Bioproject;
use App\Models\Biosample;

class DashboardIndexController extends Controller
{
    //
    public function index()
    {
        $bioproject = Bioproject::where('user_id', auth()->user()->id)->where('status', 5)->get();
        $bioproject_count = $bioproject->count();
        $bioproject_pub = Bioproject::where('user_id', auth()->user()->id)->where('status', '<>', 5)->get();
        $bioproject_pub_count = $bioproject_pub->count();

        $biosample = Biosample::where('user_id', auth()->user()->id)->where('status', 5)->get();
        $biosample_count = $biosample->count();
        $biosample_pub = Biosample::where('user_id', auth()->user()->id)->where('status', '<>', 5)->get();
        $biosample_pub_count = $biosample_pub->count();

        $bioarchive = Bioarchive::where('user_id', auth()->user()->id)->where('status', 5)->get();
        $bioarchive_count = $bioarchive->count();
        $bioarchive_pub = Bioarchive::where('user_id', auth()->user()->id)->where('status', '<>', 5)->get();
        $bioarchive_pub_count = $bioarchive_pub->count();

        return view('dashboard.index', [
            'bioproject_count' => $bioproject_count,
            'bioproject_pub_count' => $bioproject_pub_count,

            'biosample_count' => $biosample_count,
            'biosample_pub_count' => $biosample_pub_count,

            'bioarchive_count' => $bioarchive_count,
            'bioarchive_pub_count' => $bioarchive_pub_count,

        ]);
    }
}

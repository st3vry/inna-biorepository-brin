<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bioarchive;
use App\Models\Bioproject;
use Illuminate\Http\Request;

class BioarchiveController extends Controller
{
    //
    public function index()
    {
        $bioarchives = Bioarchive::with(['bioproject'])->paginate(5);
        $centers = Bioproject::leftJoin('centers', 'centers.id', '=', 'bioprojects.center_id')->selectRaw('centers.name, count(bioprojects.center_id) as count')->groupBy('centers.name')->get();
        // $biosamples = Bioarchive::leftJoin('biosamples', 'biosamples.id', '=', 'bioarchives.biosample_id')->selectRaw('count(bioarchives.biosamples_id) as count')->groupBy('biosamples.title')->get();
        // dd($biosamples);
        return view('frontend.bioarchive', [
            'title' => 'Bioarchive',
            'bioarchives' => $bioarchives,
            'centers' => $centers,
            // 'biosamples' => $biosamples,
            // 'bioprojects' => $biorpoject,
        ]);
    }
}

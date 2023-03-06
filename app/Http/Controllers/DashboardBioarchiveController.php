<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bioarchive;
use App\Models\Bioexperiment;
use App\Models\Biorun;
use App\Models\Biosample;
use Illuminate\Http\Request;

class DashboardBioarchiveController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.bioarchive.index', [
            'bioarchives' => Bioarchive::with(['bioproject', 'user'])->where('user_id', auth()->user()->id)->orderBy('published_at', 'desc')->orderBy('draft', 'desc')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('dashboard.bioarchive.create');
    }

    public function show(Bioarchive $bioarchive)
    {
        $biosample_id =  explode(",", $bioarchive->biosample_id);
        $bioexperiment = $bioarchive->bioexperiment()->get();
        // dd($biosample_id);
        return view('dashboard.bioarchive.show', [
            'bioarchive' => $bioarchive,
            'biosample_id' => $biosample_id,
            'bioexperiment' => $bioexperiment,
            // 'biorun' => $biorun,
        ]);
    }

    public function biosampleName($id)
    {
        return Biosample::select('accession')->where('id', $id)->pluck('accession')->first();
    }
}

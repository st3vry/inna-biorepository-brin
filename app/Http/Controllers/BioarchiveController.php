<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bioarchive;
use App\Models\Bioproject;
use App\Models\Bioexperiment;
use App\Models\Biorun;
use App\Models\PermissionRequest;
use App\Models\Center;
use App\Models\User;
use Illuminate\Http\Request;

class BioarchiveController extends Controller
{
    //
    public function index()
    {
        // eager-load the bioproject and the bioproject's center so views can access
        // the center via $bioarchive->bioproject->center->name
        $bioarchives = Bioarchive::with(['bioproject','bioproject.center', 'bioproject.user'])->where([
            'status' => 5,
            'hold_release' => false,
        ])->orderBy('published_at', 'desc')->paginate(10);
        // $centers = Bioproject::leftJoin('centers', 'centers.id', '=', 'bioprojects.center_id')->selectRaw('centers.name, count(bioprojects.center_id) as count')->where('bioprojects.status', 5)->groupBy('centers.name')->get();
        // $biosamples = Bioarchive::leftJoin('biosamples', 'biosamples.id', '=', 'bioarchives.biosample_id')->selectRaw('count(bioarchives.biosamples_id) as count')->groupBy('biosamples.title')->get();
        // dd($biosamples);
        return view('frontend.bioarchive', [
            'title' => 'Bioarchive',
            'bioarchives' => $bioarchives,
            // 'centers' => $centers,
            // 'biosamples' => $biosamples,
            // 'bioprojects' => $biorpoject,
        ]);
    }

    public function show(Bioarchive $bioarchive)
    {
        //
        if ($bioarchive->published_at == null || $bioarchive->hold_release == true) {
            return view('error.404');
        }
        $bioarchive->load(['bioproject', 'bioproject.center', 'bioproject.user']);

        // $biosample_links = $bioarchive->externallink()->get();
        // $user_id = auth()->user()->id;
        if (auth()->user()) {
            $user_id = auth()->user()->id;
            $get_permission_info = PermissionRequest::where('bioarchive_id', $bioarchive->id)
                ->where('user_id', $user_id)
                ->where('temporary_url_expiration', '>', now())
                ->first();
        } else {
            $get_permission_info = null;
        }
        $bioexperiments = Bioexperiment::where('bioarchive_id', $bioarchive->id)->get();
        $bioruns = Biorun::where('bioexperiment_id', $bioexperiments[0]->id)->get();
        // dd($get_permission_info->is_approved);
        // dd($bioruns);
        // dd($bioexperiments[0]->id);
        return view('frontend.showbioarchive', [
            'title' => 'Biosample',
            'bioarchive' => $bioarchive,
            'bioexperiments' => $bioexperiments,
            'bioruns' => $bioruns,
            'permission_info' => $get_permission_info
            // 'biosample_links' => $biosample_links
        ]);
    }
}

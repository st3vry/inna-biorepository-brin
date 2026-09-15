<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InnalysisGalaxyController extends Controller
{
    //
    public function index()
    {
        $response = Http::get(env('INNALYSIS_GALAXY_URL') . '/workflows');

        $workflows = json_decode($response);
        // return $workflows;
        return view('dashboard.innalysis.galaxy', [
            'workflows' => $workflows
        ]);

    }

    public function run(Request $request)
    {
        $wf = ([
                'user_id' => "test",
                "wf_id" => "bfa3e789fd89d473",
                "inputs" => [
                    "0" => [
                        "uuid" => "bed3bd53-ffda-4d94-9ef8-59790875fcee",
                    "filename" => ["/home/inna/A1_1.fq.gz", "/home/inna/A1_2.fq.gz"]
                    ]
                ],
            ]);
        $response = Http::get(env('INNALYSIS_GALAXY_URL') . '/run');
        return $response;
    }
}

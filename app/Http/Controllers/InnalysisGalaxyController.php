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
        $response = Http::get('http://202.46.7.138:8081/workflows');
        $workflows = json_decode($response);
        return $workflows;
    }

    public function run(Request $request)
    {
        $wf = ([
                'user_id' => "test",
                "wf_id" => "bfa3e789fd89d473",
                "inputs" => [
                    "0" => [
                        "uuid" => "bed3bd53-ffda-4d94-9ef8-59790875fcee",
                        "filename" => ["run_id/exp_id/acc_id/A1_1.fq.gz", "run_id/exp_id/acc_id/A1_2.fq.gz"]
                    ]
                ],
            ]);

        // dd(json_encode($wf));
        // return $wf;
        $response = Http::post('202.46.7.138:8081/run', $wf);
        return $response;
    }
}

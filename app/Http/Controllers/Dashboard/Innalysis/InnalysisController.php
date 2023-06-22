<?php

namespace App\Http\Controllers\Dashboard\Innalysis;

use App\Http\Controllers\Controller;
use App\Models\InnalysisGalaxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InnalysisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $response = Http::get('http://10.10.253.7:8080/workflows');
        $response = Http::timeout(5)->get('http://202.46.7.138:8080/workflows');
        $workflows = json_decode($response);

        return view('dashboard.innalysis.innalysis_galaxy', [
            'workflows' => $workflows
        ]);
    }

    public function create()
    {
        //
        // $response = Http::get('http://10.10.253.7:8080/workflows');
        $response = Http::timeout(5)->get('http://202.46.7.138:8080/workflows');
        $workflows = json_decode($response);

        return view('dashboard.innalysis.create_galaxy', [
            'workflows' => $workflows
        ]);
    }

    public function send(Request $request)
    {
        /*
        {
            "user_id": "test",
            "wf_id": "bfa3e789fd89d473",
            "inputs": { "0": {"uuid":"bed3bd53-ffda-4d94-9ef8-59790875fcee", "filename": ["run_id/exp_id/acc_id/A1_1.fq.gz", "run_id/exp_id/acc_id/A1_2.fq.gz"] } } ,
            "parameter": "ini nnti"
        }
        */
        $data = array(
            'user_id' => auth()->user()->id,
            'wf_id' => $request->workflow,
            'inputs' => (object)array(
                array(
                    'uuid' => 'bed3bd53-ffda-4d94-9ef8-59790875fcee',
                    'filename' => array($request->input1, $request->input2),
                ),
            ),
            'parameter' => '',
        );
        // dd(json_encode($data));
        $response = Http::post('http://202.46.7.138:8080/run', [$data]);
        $json_data = $response->json();
        // dd($json_data['status']);
        if ($json_data['status'] == 200) {
            // echo "success";
            $innalysis_galaxy = new InnalysisGalaxy();
            $innalysis_galaxy->user_id = auth()->user()->id;
            $innalysis_galaxy->wf_id = $request->workflow;
            $innalysis_galaxy->status = 1;
            $result = $innalysis_galaxy->save();
            if ($result) {
                return redirect()->to('/dashboard/innalysis_galaxy')->with('statusJob', 'Job Submitted!');
            } else {
                return 0;
            }
        } else {
            echo "not success";
        }
    }
}

<?php

namespace App\Http\Controllers\Dashboard\Innalysis;

use App\Http\Controllers\Controller;
use App\Models\Bioarchive;
use App\Models\Bioexperiment;
use App\Models\Biorun;
use App\Models\Biosample;
use App\Models\InnalysisGalaxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        // $response = Http::timeout(5)->get('http://202.46.7.138:8080/workflows');
        // $response = Http::timeout(5)->get('http://192.168.100.17:8080/workflows');
        // $workflows = json_decode($response);
        // $workflows = InnalysisGalaxy::where('user_id', auth()->user()->id)->orderBy('id')->get();
        $workflows = InnalysisGalaxy::where('user_id', auth()->user()->user_id)->get();
        // dd(auth()->user());
        return view('dashboard.innalysis.innalysis_galaxy', [
            // 'workflows' => $workflows
            'workflows' => $workflows,
        ]);
    }

    public function show(InnalysisGalaxy $innalysisGalaxy)
    {
        $detail_wf = InnalysisGalaxy::where('_id', $innalysisGalaxy->id)->first();
        // dd($detail_wf->outputs);
        return view('dashboard.innalysis.innalysis_show', [
            // 'workflows' => $workflows
            'detail_wf' => $detail_wf,
        ]);
    }

    public function create()
    {
        try {
            $response = Http::timeout(10)->get('http://192.168.100.17:8080/workflows');
            if ($response->successful()) {
                $workflows = json_decode($response->body());
                $archive = Bioarchive::get();

                return view('dashboard.innalysis.create_galaxy', [
                    'workflows' => $workflows,
                    'archive' => $archive
                ]);
            } else {
                return redirect()->back()->with('error', 'Failed to load workflows from Galaxy API');
            }
        } catch (\Exception $e) {
            Log::error('Galaxy workflows API error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Cannot connect to Galaxy API. Please try again later.');
        }
        //
        // // $response = Http::get('http://10.10.253.7:8080/workflows');
        // $response = Http::timeout(5)->get('http://192.168.100.17:8080/workflows');
        // $workflows = json_decode($response);
        // // $sample = Biosample::get();
        // $archive = Bioarchive::get();
        // return view('dashboard.innalysis.create_galaxy', [
        //     'workflows' => $workflows,
        //     'archive' => $archive
        // ]);
    }

    public function getArchive($id)
    {
        $results = Bioarchive::where('biosample_id', $id)->get();
        return response()->json($results);
    }

    public function getExperiment($id)
    {
        $results = Bioexperiment::with(['biosample'])->where('bioarchive_id', $id)->get();
        return response()->json($results);
    }

    public function getExperiment2($id)
    {
        $results = Bioexperiment::with(['biosample'])->where('bioarchive_id', $id)->get();
        return response()->json($results);
    }

    public function getRun($id)
    {
        $results = Biorun::where('bioexperiment_id', $id)->get();
        return response()->json($results);
    }


    public function send(Request $request)
    {
        // dd($request);
        // Validate basic required fields
        $request->validate([
            'workflow' => 'required',
            'archive' => 'required',
            'experiment' => 'required',
        ]);
        $archive = $request->archive;
        $experiment = $request->experiment;
        $workflow = $request->workflow;

        // Get biodata with error handling
        $bioarchive = Bioarchive::find($archive);
        $bioexperiment = Bioexperiment::find($experiment);

        if (!$bioarchive || !$bioexperiment) {
            return redirect()->back()->with('error', 'Selected archive or experiment not found.');
        }
        // Process dynamic run inputs
        $inputs = new \stdClass();
        $processedInputs = [];
        $hasValidInputs = false;

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'run_') === 0) {
                $inputKey = str_replace('run_', '', $key);
                $uuidKey = 'input_uuid_' . $inputKey;

                // Validate that run value is not empty
                if (empty($value) || $value === "Choose Run") {
                    return redirect()->back()->with('error', 'Please select all required run files.');
                }

                // Get biorun data
                $biorun = Biorun::find($value);

                if ($biorun) {
                    $file = "/var/www/innalysis_ops/files/{$bioarchive->accession}/{$bioexperiment->alias}/{$biorun->filename}";

                    // Check if file exists (optional)
                    if (!file_exists($file)) {
                        Log::warning("File not found: {$file}");
                        // Uncomment below line if you want to stop execution when file doesn't exist
                        // return redirect()->back()->with('error', "File not found: {$biorun->filename}");
                    }

                    // Create input object for this specific input key
                    $inputs->$inputKey = (object)[
                        'uuid' => $request->$uuidKey,
                        'filename' => $file
                    ];

                    $processedInputs[$inputKey] = [
                        'uuid' => $request->$uuidKey,
                        'filename' => $file,
                        'biorun_filename' => $biorun->filename
                    ];

                    $hasValidInputs = true;
                } else {
                    return redirect()->back()->with('error', "Selected run file not found: {$value}");
                }
            }
        }
        if (!$hasValidInputs) {
            return redirect()->back()->with('error', 'No valid input files found. Please select workflow inputs.');
        }

        // Prepare workflow payload
        $wf = [
            'user_id' => auth()->user()->user_id,
            'wf_id' => $workflow,
            'inputs' => $inputs,
            'parameter' => 'Dynamic workflow submission'
        ];

        // Log for debugging (remove in production)
        Log::info('Galaxy API Payload:', [
            'user_id' => $wf['user_id'],
            'wf_id' => $wf['wf_id'],
            'inputs_count' => count((array)$wf['inputs']),
            'processed_inputs' => $processedInputs
        ]);

        try {
            // Send to Galaxy API with timeout
            $response = Http::timeout(30)->post('http://192.168.100.17:8080/run', $wf);
            if (!$response->successful()) {
                Log::error('Galaxy API HTTP Error:', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return redirect()->back()->with('error', 'Galaxy API returned error: ' . $response->status());
            }
            $json_data = $response->json();
            // Log response for debugging
            Log::info('Galaxy API Response:', $json_data);
            if (isset($json_data['status']) && $json_data['status'] == 200) {
                // Optional: Save job to database
                // $this->saveJobToDatabase($workflow, $processedInputs, auth()->user()->user_id);

                return redirect()->to('/dashboard/innalysis_galaxy')->with('statusJob', 'Job Submitted Successfully!');
            } else {
                $errorMessage = $json_data['message'] ?? $json_data['error'] ?? 'Unknown error from Galaxy API';
                Log::error('Galaxy API Business Logic Error:', $json_data);
                return redirect()->back()->with('error', 'Job submission failed: ' . $errorMessage);
            }
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Galaxy API Connection Error:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to connect to Galaxy API. Please check your network connection.');
        } catch (\Exception $e) {
            Log::error('Galaxy API General Error:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }


        // <versi-lama>
        // $archive = $request->archive;
        // $experiment = $request->experiment;
        // $run = $request->run;
        // $workflow = $request->workflow;
        // $bioarchive = Bioarchive::where('id', $archive)->get();
        // $bioexperiment = Bioexperiment::where('id', $experiment)->get();
        // $biorun = Biorun::where('id', $run)->get();
        // // dd($bioarchive);
        // // $file = "/home/inna/sto/files/{$bioarchive[0]->accession}/{$bioexperiment[0]->alias}/{$biorun[0]->filename}";
        // $file = "/var/www/innalysis_ops/files/{$bioarchive[0]->accession}/{$bioexperiment[0]->alias}/{$biorun[0]->filename}";
        // // $fileContent = file_get_contents($file);
        // // dd($fileContent);


        // // $files = array();
        // // if (Storage::disk('sftp')->exists($file)) {
        // //     // $d = Storage::disk('sftp')->files($file);
        // //     $obj = new \stdClass();
        // //     $obj = Storage::disk('sftp')->file($file);
        // //     // array_push($files, $obj);
        // // }

        // // dd($obj);

        // $wf = ([
        //     'user_id' => auth()->user()->user_id,
        //     // 'wf_id' => "f2db41e1fa331b3e",
        //     'wf_id' => $workflow,
        //     'inputs' => (object)array(
        //         (object)array(
        //             // "uuid" => "bed3bd53-ffda-4d94-9ef8-59790875fcee",
        //             // "filename" => ["/home/inna/A1_1.fq.gz", "/home/inna/A1_2.fq.gz"]
        //             "filename" => $file
        //         )
        //     ),
        //     'paramter' => 'ini nanti'
        // ]);

        // // dd(json_encode($wf));

        // // $data = array(
        // //     'user_id' => auth()->user()->user_id,
        // //     'wf_id' => $request->workflow,
        // //     'inputs' => (object)array(
        // //         array(
        // //             'uuid' => 'bed3bd53-ffda-4d94-9ef8-59790875fcee',
        // //             'filename' => array($request->input1, $request->input2),
        // //         ),
        // //     ),
        // //     'parameter' => '',
        // // );
        // // dd(json_encode($data));
        // // $response = Http::post('http://192.168.100.17:8080/run', [$data]);
        // $response = Http::post(
        //     'http://192.168.100.17:8080/run',
        //     $wf
        // );
        // $json_data = $response->json();
        // // dd($json_data['status']);
        // if ($json_data['status'] == 200) {
        //     // echo "success";
        //     return redirect()->to('/dashboard/innalysis_galaxy')->with('statusJob', 'Job Submitted!');
        //     // $innalysis_galaxy = new InnalysisGalaxy();
        //     // $innalysis_galaxy->user_id = auth()->user()->user_id;
        //     // $innalysis_galaxy->wf_id = $request->workflow;
        //     // $innalysis_galaxy->status = 1;
        //     // $result = $innalysis_galaxy->save();
        //     // if ($result) {
        //     //     return redirect()->to('/dashboard/innalysis_galaxy')->with('statusJob', 'Job Submitted!');
        //     // } else {
        //     //     return 0;
        //     // }
        // } else {
        //     echo "not success";
        // }
        // </versi-lama>
    }
}

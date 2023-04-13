<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Models\Bioarchive;
use App\Models\Bioexperiment;
use App\Models\Biosample;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Exception;

class CuratorBioArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bioarchives = Bioarchive::with(['bioproject', 'user'])
            ->where('published_at', null)
            ->where('draft', false)
            ->where('status', 1)
            // ->where(function ($query) {
            //     $query->where('draft', false)
            //         ->orWhere('curator_id', '<>', null);
            // })
            ->orderBy('created_at', 'desc')
            ->orderBy('curator_id', 'asc')
            ->paginate(5);
        if (auth()->user()->role_id == 2) {
            $bioarchives = Bioarchive::with(['bioproject', 'user'])
                ->where('curator_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        }
        return view('dashboard.curator.bioarchive.index', [
            'title' => 'Bioarchives',
            'bioarchives' => $bioarchives
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bioarchive $bioarchive)
    {
        $biosample_id =  explode(",", $bioarchive->biosample_id);
        $bioexperiment = $bioarchive->bioexperiment()->get();
        $curators = User::select(['id', 'name'])->where('role_id', 2)->where('is_activated', true)->orderBy('name')->get();
        $histories = ActionLog::with(['creator'])->where('item_id', $bioarchive->accession)->orderBy('created_at', 'desc')->get();
        $files = array();

        foreach ($bioexperiment as $key => $value) {
            $directory = "files/{$bioarchive->accession}/{$value['alias']}";
            if (Storage::disk('sftp')->exists($directory)) {
                $d = Storage::disk('sftp')->files($directory);
                $obj = new \stdClass();
                $obj->{$value['alias']} = Storage::disk('sftp')->files($directory);
                array_push($files, $obj);
            }
        }
        // dd($biosample_id);
        return view('dashboard.curator.bioarchive.show', [
            'bioarchive' => $bioarchive,
            'biosample_id' => $biosample_id,
            'bioexperiment' => $bioexperiment,
            'curators' => $curators,
            'histories' => $histories,
            'files' => $files
            // 'biorun' => $biorun,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        // dd($request->bioarchive_id);
        $action = false;
        $success = '';
        if ($request->action === "assignedToCurator") {
            $action = Bioarchive::where('accession', $id)->update([
                'curator_id' => $request->target,
                'status' => 2,
            ]);
            $success = 'Assigned to Curator';
        } else {
            if ($request->action === 'returnedToSubmitter') {
                $action = Bioarchive::where('accession', $id)->update([
                    'draft' => true,
                    'status' => 3
                ]);
                $success = 'Returned to Submitter';
            }
            if ($request->action === 'proceedToFileUpload') {
                $action = Bioarchive::where('accession', $id)->update([
                    'draft' => true,
                    'status' => 4
                ]);
                // approving bioarchive
                $success = 'BioArchive Approved for File Upload';
                // create directory
                $bioexperiments = Bioexperiment::where('bioarchive_id', $request->bioarchive_id)->get();
                foreach ($bioexperiments as $bioexperiment) {
                    // dd($bioexperiment->alias);
                    $path = storage_path('app/public') . '/' . $id . '/' . $bioexperiment->alias;
                    if (!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0755, true, true);
                    }

                    try {
                        // Nama direktori yang akan dibuat
                        $directory = '/'.$id.'/'.$bioexperiment->alias; // Ganti dengan direktori yang ingin Anda buat pada SFTP storage
                        // dd($directory);
                        // Buat direktori baru jika belum ada
                        if (!Storage::disk('sftp')->exists($directory)) {
                            Storage::disk('sftp')->makeDirectory($directory);
                        }
                    } catch (Exception $e) {
                        // Tangani kesalahan
                        // Anda dapat menambahkan kode untuk menampilkan pesan kesalahan atau melakukan tindakan lain sesuai kebutuhan Anda
                        echo $e->getMessage();
                    }
                    // try {
                    //     // Konfigurasi adapter
                    //     $config = [
                    //         'host' => env('SFTP_HOST'), // Mengambil alamat SFTP dari file .env
                    //         'username' => env('SFTP_USERNAME'), // Mengambil username SFTP dari file .env
                    //         'password' => env('SFTP_PASSWORD'), // Mengambil password SFTP dari file .env
                    //         'root' => '/', // Ganti dengan root directory pada SFTP
                    //         'port' => 22, // Port default untuk SFTP
                    //         'timeout' => 10, // Timeout untuk koneksi SFTP
                    //         'directoryPerm' => 0755, // Hak akses direktori baru yang akan dibuat
                    //     ];

                    //     // Buat adapter
                    //     $adapter = new SftpAdapter($config);

                    //     // Buat instance Filesystem dengan adapter SFTP
                    //     $filesystem = new Filesystem($adapter);

                    //     // Nama direktori yang akan dibuat
                    //     $directory = 'path/to/directory'; // Ganti dengan direktori yang ingin Anda buat pada SFTP storage

                    //     // Buat direktori baru jika belum ada
                    //     if (!$filesystem->has($directory)) {
                    //         Storage::disk('sftp')->makeDirectory($directory);
                    //     } else {
                    //         echo 'Folder already exists on SFTP';
                    //     }
                    // } catch (Exception $e) {
                    //     // Tangani kesalahan
                    //     // Anda dapat menambahkan kode untuk menampilkan pesan kesalahan atau melakukan tindakan lain sesuai kebutuhan Anda
                    //     echo $e->getMessage();
                    // }
                }
            }
            if ($request->action === 'approved') {
                $action = Bioarchive::where('accession', $id)->update([
                    'published_at' => now(),
                    'status' => 5
                ]);
                $success = 'BioArchive Approved';
            }
            if ($request->action === 'rejected') {

                $action = Bioarchive::where('accession', $id)->update([
                    'status' => 0
                ]);
                $action = Bioarchive::where('accession', $id)->update(['published_at' => now()]);
                $success = 'BioArchive rejected';
            }
        }

        if ($action) {
            ActionLog::create([
                'action' => $request->action,
                'type' => 'Bioarchive',
                'item_id' => $id,
                'user_target' => $request->target,
                'created_by' => auth()->id(),
                'desc' => !isset($request->desc) ? null : $request->desc
            ]);
            return redirect('/dashboard/curator/bioarchives/' . $id)->with('success', $success);
        } else {
            return redirect('/dashboard/curator/bioarchives/' . $id)->with('error', 'Something went wrong, please try again later!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function biosampleName($id)
    {
        return Biosample::select('accession')->where('id', $id)->pluck('accession')->first();
    }
}

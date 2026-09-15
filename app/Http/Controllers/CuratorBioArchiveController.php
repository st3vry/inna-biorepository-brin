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
use App\Http\Helper;
use App\Models\Biorun;
use App\Models\FtpUser;
use Carbon\Carbon;
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
            // ->where('published_at', null)
            // ->where('draft', false)
            // ->where('status', 1)
            // ->where(function ($query) {
            //     $query->where('draft', false)
            //         ->orWhere('curator_id', '<>', null);
            // })
            ->orderBy('created_at', 'desc')
            ->orderBy('curator_id', 'asc')
            ->get();
        if (auth()->user()->role_id == 2) {
            $bioarchives = Bioarchive::with(['bioproject', 'user'])
                ->where('curator_id', auth()->id())
                ->where('status', '<>', 1)
                ->orderBy('created_at', 'desc')
                ->get();
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
        $ftp_users = FtpUser::where("bioarchive_id", $bioarchive->id)->first();

        if ($bioarchive->status != 5) {
            $dir_type = "temp";
        } else {
            $dir_type = "files";
        }
        $ftp_user = FtpUser::where("username", $bioarchive->accession)->first();
        if ($ftp_user) {
            $disk = Storage::build([
                'driver' => 'sftp',
                'host' => env('FTP_HOST'),
                'username' => "{$bioarchive->accession}",
                'password' =>  "{$ftp_user->password}",
                'root'=> "/"
            ]);
            foreach ($bioexperiment as $key => $value) {
                $directory = "/innasto/{$dir_type}/{$bioarchive->accession}/{$value['alias']}";
                // $directory = "/innasto/{$dir_type}/INNAAR000008/INNAX-r9K9Do-1";
                try {
                    if ($disk->exists($directory)) {
                        $d = $disk->files($directory);
                        $obj = new \stdClass();
                        $obj->{$value['alias']} = $d;
                        array_push($files, $obj);
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }


        return view('dashboard.curator.bioarchive.show', [
            'bioarchive' => $bioarchive,
            'biosample_id' => $biosample_id,
            'bioexperiment' => $bioexperiment,
            'curators' => $curators,
            'histories' => $histories,
            'files' => $files,
            'ftp_user' => $ftp_users
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
                //crete ftp user & storing data
                $SSHController = new SSHController();
                $start_day = Carbon::now();
                $exp_date = $start_day->addWeek();
                $password = $SSHController->createFtpUser($id);
                $ftpUserdata = array(
                    'bioarchive_id' => $request->bioarchive_id,
                    'username' => $id,
                    'password' => $password,
                    'exp_date' => $exp_date,
                );
                FtpUser::create($ftpUserdata);

                // create directory
                $bioexperiments = Bioexperiment::where('bioarchive_id', $request->bioarchive_id)->get();
                foreach ($bioexperiments as $bioexperiment) {
                    $command = [
                        "sudo mkdir /innasto/temp/{$id}/{$bioexperiment->alias}",
                        "sudo chown -R {$id}:{$id} /innasto/temp/{$id}"
                    ];
                    $createFolder = $SSHController->customSSHCommand(env('FTP_USERNAME'), $command);
                }
            }
            if ($request->action === 'approved') {
                $bioarchive = Bioarchive::where('accession', $id)->first();
                $bioexperiment = $bioarchive->bioexperiment()->get();
                $files = array();
                $ftp_user = FtpUser::where("username", $id)->first();

                if ($ftp_user) {
                    $disk = Storage::build([
                        'driver' => 'sftp',
                        'host' => env('FTP_HOST'),
                        'username' => "{$bioarchive->accession}",
                        'password' =>  "{$ftp_user->password}",
                        'root'=> "/"
                    ]);
                    foreach ($bioexperiment as $key => $value) {
                        $directory = "/innasto/temp/{$bioarchive->accession}/{$value['alias']}";
                        $target = "innasto/files/{$bioarchive->accession}/{$value['alias']}";
                        try {
                            if ($disk->exists($directory)) {
                                $d = $disk->files($directory);
                                $obj = new \stdClass();
                                $obj->{$value['alias']} = $d;
                                $obj->bioexperiment_id = $value['id'];
                                array_push($files, $obj);
                            }
                        } catch (\Throwable $th) {
                            throw $th;
                        }
                    }
                    foreach ($files as $key => $values) {
                        foreach ($values as $key2 => $children) {
                            if(gettype($children) !="integer") {
                                foreach ($children as $child) {
                                    $SSHController = new SSHController();
                                    $filename = substr($child, strrpos($child, '/') + 1);
                                    $rename = Helper::biorunRegex($filename,$id, $key2);
                                    $target = "innasto/files/{$bioarchive->accession}/{$key2}";
                                    try {
                                        $md5 = $SSHController->customSSHCommand(env('FTP_USERNAME'), 
                                        [
                                            "mkdir -p innasto/files/$bioarchive->accession",
                                            "mkdir -p innasto/files/$bioarchive->accession/$key2",
                                            "cp {$child} {$target}/{$rename}", 
                                            "md5sum {$target}/{$rename}"
                                        ]);
                                    } catch (\Throwable $th) {
                                        return $th->getMessage();
                                    }
                                    list($firstWord) = explode(' ', $md5);
                                    $biorun = new BioRun;
                                    $biorun->bioexperiment_id = $values->bioexperiment_id;
                                    $biorun->alias = $key2;
                                    $biorun->filename = $rename;
                                    $biorun->md5 = $firstWord;
                                    $biorun->filetype_id = 1;
                                    $action = $biorun->save();
                                }
                            }
                        }
                    }
                }
                if($action) {
                    $action = Bioarchive::where('accession', $id)->update([
                        'published_at' => now(),
                        'status' => 5
                    ]);
                    $success = 'BioArchive Approved';
                }
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

    public function updateBiorun(Request $request)
    {
        $biorun = new BioRun;
        $biorun->bioexperiment_id = $request->bioexperiment_id;
        $biorun->alias = $request->alias;
        $biorun->filename = $request->fileNameInModal;
        $biorun->md5 = $request->md5InModal;
        $biorun->filetype_id = $request->filetype;
        $action = $biorun->save();
        // $action = Biorun::where('id', $request->biorun_id)->get();
        if ($action) {
            return back()->with('success', "Success");
        } else {
            return back()->with('error', 'Something went wrong, please try again later!');
        }
    }

    public function fileCuration(Request $request) {
        $SSHController = new SSHController();
        try {
            $curation = $SSHController->customSSHCommand(env('FTP_USERNAME'), $request->cmd);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        return $curation;
    }
}

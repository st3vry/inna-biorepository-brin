<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Http\Controllers\Controller;
use App\Models\Bioarchive;
use App\Models\Biosample;
use App\Models\Instrument;
use App\Models\LibraryLayout;
use App\Models\LibrarySelection;
use App\Models\LibrarySource;
use App\Models\LibraryStrategy;
use App\Models\FileType;
use App\Models\FtpUser;
use App\Models\BioarchiveDraft;
use Storage;
use Illuminate\Http\Request;

class DashboardBioarchiveController extends Controller
{
    //
    public function index()
    {
        $bioarchives = Bioarchive::with(['bioproject', 'user'])->where('user_id', auth()->user()->id)->orderBy('id')->get();

        $hasDraft = false;
        try {
            $hasDraft = BioarchiveDraft::where('user_id', auth()->id())->where('status', 'draft')->exists();
        } catch (\Throwable $e) {
            // ignore if drafts table/model not available
            logger()->debug('Could not check bioarchive drafts: ' . $e->getMessage());
        }

        return view('dashboard.bioarchive.index', [
            'bioarchives' => $bioarchives,
            'hasDraft' => $hasDraft,
        ]);
    }

    public function create()
    {
        return view('dashboard.bioarchive.create');
    }

    public function edit($id)
    {
        $bioarchive = Bioarchive::where('accession', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('dashboard.bioarchive.edit', [
            'bioarchive' => $bioarchive,
        ]);
    }

    public function show(Bioarchive $bioarchive)
    {

        $biosample_id =  explode(",", $bioarchive->biosample_id);
        $bioexperiment = $bioarchive->bioexperiment()->get();
        $histories = ActionLog::with(['creator'])->where('item_id', $bioarchive->accession)->orderBy('created_at', 'desc')->get();
        $files = array();
        $filetypes = FileType::get();
        $ftp_users = FtpUser::where("bioarchive_id", $bioarchive->id)->first();
        // dd($filetypes);

        if ($bioarchive->status != 5) {
            $dir_type = "temp";
        } else {
            $dir_type = "files";
        }
        $ftp_user = FtpUser::where("username", $bioarchive->accession)->first();
        if ($bioarchive->status == 4 ) {
            $disk = Storage::build([
                'driver' => 'sftp',
                'host' => env('FTP_HOST'),
                'username' => "{$bioarchive->accession}",
                'password' =>  "{$ftp_user->password}",
                'root'=> "/"
            ]);
        }
        foreach ($bioexperiment as $key => $value) {
            $directory = "/innasto/{$dir_type}/{$bioarchive->accession}/{$value['alias']}";
            try {
                if ($disk->exists($directory)) {
                    $d = $disk->files($directory);
                    $obj = new \stdClass();
                    $obj->{$value['alias']} = $d;
                    array_push($files, $obj);
                }
            } catch (\Throwable $th) {
                $obj = new \stdClass();
                $item = array();
                $item[] = "Failed to read file(s)";
                $obj->{$value['alias']} = $item;
                array_push($files, $obj);
                // throw $th;
            }
        }

        // Storage::disk('ftp')->files("files/{$bioarchive->accession}/");
        // Storage::disk('ftp')->put("files/{$request->mainFolder}/{$request->subFolder}/{$fileName}")

        // dd($files);
        return view('dashboard.bioarchive.show', [
            'bioarchive' => $bioarchive,
            'biosample_id' => $biosample_id,
            'bioexperiment' => $bioexperiment,
            'histories' => $histories,
            'files' => $files,
            'filetypes' => $filetypes,
            'ftp_user'=> $ftp_users,
        ]);
    }

    public function update(Request $request, $id)
    {
        $action = false;
        $success = '';
        // dd($request);
        if ($request->action === "fileUploaded") {
            $action = Bioarchive::where('accession', $id)->update([
                'draft' => false,
                'status' => 2
            ]);
            $success = 'File Upload Completed, Returned to Curator.';
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
            return redirect('/dashboard/bioarchives/' . $id)->with('success', $success);
        } else {
            return redirect('/dashboard/bioarchives/' . $id)->with('error', 'Something went wrong, please try again later!');
        }
    }

    public function destroy(Bioarchive $bioarchive)
    {
        //
        Bioarchive::destroy($bioarchive->id);
        return redirect('/dashboard/bioarchives')->with('success', 'Bioarchives has been deleted!');
    }

    public static function biosampleName($id)
    {
        return Biosample::select('accession')->where('id', $id)->pluck('accession')->first();
    }
    public static function getLibSourceName($id)
    {
        return LibrarySource::select('name')->where('id', $id)->pluck('name')->first();
    }
    public static function getLibSelectionName($id)
    {
        return LibrarySelection::select('name')->where('id', $id)->pluck('name')->first();
    }
    public static function getLibStrategyName($id)
    {
        return LibraryStrategy::select('name')->where('id', $id)->pluck('name')->first();
    }
    public static function getInstrumentName($id)
    {
        return Instrument::select('name')->where('id', $id)->pluck('name')->first();
    }
    public static function getLibLayoutName($id)
    {
        return LibraryLayout::select('name')->where('id', $id)->pluck('name')->first();
    }

    /**
     * Release a published bioarchive by clearing the hold_release flag.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bioarchive  $bioarchive
     * @return \Illuminate\Http\Response
     */
    public function release(Request $request, Bioarchive $bioarchive)
    {
        $bioarchive->hold_release = false;
        $bioarchive->save();

        return response()->json(['status' => 'OK']);
    }
}

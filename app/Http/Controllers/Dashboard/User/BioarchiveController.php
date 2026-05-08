<?php

namespace App\Http\Controllers\Dashboard\User;

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
use App\Models\FtpUsers;
use Storage;
use Illuminate\Http\Request;

class BioarchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.bioarchive.index', [
            // 'bioarchives' => Bioarchive::with(['bioproject', 'user'])->where('user_id', auth()->user()->id)->where('status', 1)->where('published_at', '<>', null)->orderBy('published_at', 'desc')->orderBy('draft', 'desc')->paginate(10),
            'bioarchives' => Bioarchive::with(['bioproject', 'user'])->where('user_id', auth()->user()->id)->orderBy('id')->get(),
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
        //
        $biosample_id =  explode(",", $bioarchive->biosample_id);
        $bioexperiment = $bioarchive->bioexperiment()->get();
        $histories = ActionLog::with(['creator'])->where('item_id', $bioarchive->accession)->orderBy('created_at', 'desc')->get();
        $files = array();
        $filetypes = FileType::get();
        $ftp_users = FtpUsers::where("bioarchive_id", $bioarchive->id);
        // dd($filetypes);
        $file_location = $bioarchive->status == 5 ? "pub" : "temp";

        foreach ($bioexperiment as $key => $value) {
            $directory = "/innasto/{$file_location}/{$bioarchive->accession}/{$value['alias']}";
            if (Storage::disk('ftp')->exists($directory)) {
                $d = Storage::disk('ftp')->files($directory);
                $obj = new \stdClass();
                $obj->{$value['alias']} = Storage::disk('ftp')->files($directory);
                array_push($files, $obj);
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
            'ftp_user'=> $ftp_users
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
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
}

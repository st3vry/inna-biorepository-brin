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
use Storage;
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
        $histories = ActionLog::with(['creator'])->where('item_id', $bioarchive->accession)->orderBy('created_at', 'desc')->get();
        $files = array();
        
        foreach ($bioexperiment as $key => $value) {
            $obj = new \stdClass();
            $obj->{$value['alias']} = Storage::disk('ftp')->files("files/{$bioarchive->accession}/{$value['alias']}");
            array_push($files, $obj);
        }
        
        // Storage::disk('ftp')->files("files/{$bioarchive->accession}/");
        // Storage::disk('ftp')->put("files/{$request->mainFolder}/{$request->subFolder}/{$fileName}")

        // dd($files);
        return view('dashboard.bioarchive.show', [
            'bioarchive' => $bioarchive,
            'biosample_id' => $biosample_id,
            'bioexperiment' => $bioexperiment,
            'histories' => $histories,
            'files' => $files
            // 'biorun' => $biorun,
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

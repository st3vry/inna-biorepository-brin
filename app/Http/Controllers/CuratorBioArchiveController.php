<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Models\Bioarchive;
use App\Models\Biosample;
use App\Models\User;

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
            ->where(function ($query) {
                $query->where('draft', false)
                      ->orWhere('curator_id','<>', null);
            })
            ->orderBy('published_at','desc')
            ->orderBy('curator_id','asc')
            ->paginate(5);
        if (auth()->user()->role_id == 2) {
            $bioarchives = Bioarchive::with(['bioproject', 'user'])
                ->where('curator_id', auth()->id())
                ->orderBy('published_at','desc')
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
        $curators = User::select(['id','name'])->where('role_id',2)->where('is_activated',true)->orderBy('name')->get();
        $histories = ActionLog::with(['creator'])->where('item_id',$bioarchive->accession)->orderBy('created_at', 'desc')->get();

        // dd($biosample_id);
        return view('dashboard.curator.bioarchive.show', [
            'bioarchive' => $bioarchive,
            'biosample_id' => $biosample_id,
            'bioexperiment' => $bioexperiment,
            'curators' => $curators,
            'histories' => $histories
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
        dd($id);
        $action = false;
        $success = '';
        if ($request->action === "assignedToCurator") {
            
            $action = Bioarchive::where('accession', $id)->update(['curator_id' => $request->target]);
            $success = 'Assigned to Curator';
        } else {
            if ($request->action === 'returnedToSubmitter') {
                $action = Bioarchive::where('accession', $id)->update(['draft' => true]);
                $success = 'Returned to Submitter';
            }
            if ($request->action === 'approved') {
                $action = Bioarchive::where('accession', $id)->update(['published_at' => now()]);
                $success = 'BioArchive Approved';
            }
            if ($request->action === 'rejected') {
                // waiting for action rules
                dd($request->action);
                $action = Bioarchive::where('accession', $id)->update(['published_at' => now()]);
                $success = 'BioArchive rejected';
            }
        }

        if ($action) {
            ActionLog::create([
                'action' => $request->action,
                'type' => 'Bioarchive',
                'item_id' => $id,
                'user_target'=> $request->target,
                'created_by' =>auth()->id(),
                'desc' => !isset($request->desc) ? null : $request->desc
            ]);
            return redirect('/dashboard/curator/bioarchives/'.$id)->with('success', $success);
        } else {
            return redirect('/dashboard/curator/bioarchives/'.$id)->with('error', 'Something went wrong, please try again later!');
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

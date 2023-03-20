<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\User;
use App\Models\Biosample;
use Illuminate\Http\Request;

class CuratorBioSampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $biosamples = BioSample::with(['organism', 'center'])
            ->where('published_at', null)
            ->where('draft',false)
            ->where('status',1)
            // ->where(function ($query) {
            //     $query->where('draft', false)
            //           ->orWhere('curator_id','<>', null);
            // })
            ->orderBy('published_at','desc')
            ->orderBy('curator_id','asc')
            ->paginate(5);
        if (auth()->user()->role_id == 2) {
            $biosamples = BioSample::with(['organism', 'center'])
                ->where('curator_id', auth()->id())
                ->orderBy('published_at','desc')
                ->paginate(5);
        }
        return view('dashboard.curator.biosample.index', [
            'title' => 'Biosample',
            'biosamples' => $biosamples,
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
    public function show(Biosample $biosample)
    {
        // dd($biosample);
        $curators = User::select(['id','name'])->where('role_id',2)->where('is_activated',true)->orderBy('name')->get();
        $histories = ActionLog::with(['creator'])->where('item_id',$biosample->accession)->orderBy('created_at', 'desc')->get();

        return view('dashboard.curator.biosample.show', [
            'biosample' => $biosample,
            'curators' => $curators,
            'histories' => $histories
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
            $action = BioSample::where('accession', $id)->update([
                'curator_id' => $request->target,
                'status' => 2,
            ]);
            $success = 'Assigned to Curator';
        } else {
            if ($request->action === 'returnedToSubmitter') {
                $action = BioSample::where('accession', $id)->update([
                    'draft' => true,
                    'status'=>3
                ]);
                $success = 'Returned to Submitter';
            }
            if ($request->action === 'approved') {
                $action = BioSample::where('accession', $id)->update([
                    'published_at' => now(),
                    'status' => 5
                ]);
                $success = 'BioSample Approved';
            }
            if ($request->action === 'rejected') {
                // waiting for action rules
                dd($request->action);
                $action = BioSample::where('accession', $id)->update([
                    'status' => 0
                ]);
                $success = 'BioSample rejected';
            }
        }
        
        if ($action) {
            ActionLog::create([
                'action' => $request->action,
                'type' => 'Biosample',
                'item_id' => $id,
                'user_target'=> $request->target,
                'created_by' =>auth()->id(),
                'desc' => !isset($request->desc) ? null : $request->desc
            ]);
            return redirect('/dashboard/curator/biosamples/'.$id)->with('success', $success);
        } else {
            return redirect('/dashboard/curator/biosamples/'.$id)->with('error', 'Something went wrong, please try again later!');
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
}

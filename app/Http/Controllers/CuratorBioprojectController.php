<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\Bioproject;
use App\Models\Datatype;
use App\Models\Fundagency;
use App\Models\Grant;
use App\Models\MaterialBioproject;
use App\Models\CaptureBioproject;
use App\Models\RelevanceBioproject;
use App\Models\MethodologyBioproject;
use App\Models\User;
use Illuminate\Http\Request;

class CuratorBioprojectController extends Controller
{
    //
    public function index()
    {
        //
        $bioprojects = Bioproject::with(['organism'])
            ->where('published_at', null)
            ->orderBy('published_at','desc')
            ->orderBy('curator_id','asc')
            ->paginate(5);
        if (auth()->user()->role_id == 2) {
            $bioprojects = Bioproject::with(['organism', 'center'])
                ->where('curator_id', auth()->id())
                ->where('draft',false)
                ->orderBy('published_at','desc')
                ->paginate(5);
        }
        return view('dashboard.curator.bioproject.index', [
            'title' => 'Bioproject',
            'bioprojects' => $bioprojects
        ]);
    }
    public function show(Bioproject $bioproject)
    {
        // dd($biosample);
        $pubs = $bioproject->publication()->get();
        $grants = $bioproject->grant()->get();
        $externallinks = $bioproject->externallink()->get();
        $id_data_type = explode(',', $bioproject->getAttribute('data_type_id'));
        $data_types = Datatype::whereIn('id', $id_data_type)->pluck('name');
        $umbrella = Bioproject::where('id', $bioproject->umbproject_id)->first();
        $relevanceBioproject = RelevanceBioproject::where('bioproject_id', $bioproject->id)->first();
        $materialBioproject = MaterialBioproject::where('bioproject_id', $bioproject->id)->first();
        $captureBioproject = CaptureBioproject::where('bioproject_id', $bioproject->id)->first();
        $methodologyBioproject = MethodologyBioproject::where('bioproject_id', $bioproject->id)->first();
        $curators = User::select(['id','name'])->where('role_id',2)->where('is_activated',true)->orderBy('name')->get();
        $histories = ActionLog::where('item_id',$bioproject->accession)->orderBy('created_at', 'desc')->get();

        return view('dashboard.curator.bioproject.show', [
            'bioproject' => $bioproject,
            'pubs' => $pubs,
            'grants' => $grants,
            'data_types' => $data_types,
            'relevance' => $relevanceBioproject,
            'material' => $materialBioproject,
            'capture' => $captureBioproject,
            'methodology' => $methodologyBioproject,
            'umbrella' => $umbrella,
            'externallinks' => $externallinks,
            'curators' => $curators,
            'histories' => $histories
        ]);
    }
    public function edit(Bioproject $bioproject)
    {
        $pubs = $bioproject->publication()->get();
        $grants = $bioproject->grant()->get();
        $id_data_type = explode(',', $bioproject->getAttribute('data_type_id'));
        $data_types = Datatype::whereIn('id', $id_data_type)->pluck('name');
        return view('dashboard.curator.show_bioproject', [
            'title' => 'Bioproject',
            'bioproject' => $bioproject,
            'pubs' => $pubs,
            'grants' => $grants,
            'data_types' => $data_types
        ]);
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
        if ($request->action === "assignToCurator") {
            $action = Bioproject::where('accession', $id)->update(['curator_id' => $request->curator_id]);
            if ($action) {
                ActionLog::create([
                    'action' => $request->action,
                    'type' => 'Bioproject',
                    'item_id' => $id,
                    'user_target'=> $request->curator_id,
                    'created_by' =>auth()->id(),
                    'desc' => !isset($request->comment) ? null : $request->comment
                ]);
            }
        }
        if ($action) {
            return redirect('/dashboard/curator/bioprojects/'.$id)->with('success', 'Assigned to curator');
        } else {
            return redirect('/dashboard/curator/bioprojects/'.$id)->with('error', 'Something went wrong, please try again later!');
        }
    }
}

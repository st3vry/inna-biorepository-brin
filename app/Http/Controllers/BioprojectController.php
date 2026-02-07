<?php

namespace App\Http\Controllers;

use App\Models\Bioproject;
use App\Models\CaptureBioproject;
use App\Models\Datatype;
use App\Models\MaterialBioproject;
use App\Models\MethodologyBioproject;
use App\Models\Objective;
use App\Models\SampleBioproject;
use App\Models\RelevanceBioproject;
use App\Models\BioprojectTarget;
use App\Models\OrganismReplicon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class BioprojectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bioprojects = Bioproject::with(['organism', 'samplescope'])->where('status', 5)->paginate(5);
        if ($request->organism) {
            $bioprojects = Bioproject::with(['organism', 'samplescope'])->where(['status' => 5, 'organism_id' => Crypt::decrypt($request->organism)])->paginate(5);
        }
        if ($request->center) {
            $bioprojects = Bioproject::with(['organism', 'samplescope'])->where(['status' => 5, 'center_id' => Crypt::decrypt($request->center)])->paginate(5);
        }

        if ($request->scope) {
            $bioprojects = Bioproject::with(['organism', 'samplescope'])->where(['status' => 5, 'samplescope_id' => Crypt::decrypt($request->scope)])->paginate(5);
        }
        $organisms = Bioproject::leftJoin('organisms', 'organisms.id','=','bioprojects.organism_id')->selectRaw('organisms.name, organisms.id, organisms.taxon_id, count(bioprojects.organism_id) as count')->where('bioprojects.status', 5)->groupBy('organisms.id')->orderBy('organisms.name')->get();
        $centers = Bioproject::leftJoin('centers', 'centers.id','=','bioprojects.center_id')->selectRaw('centers.name, centers.id, count(bioprojects.center_id) as count')->where('bioprojects.status', 5)->groupBy('centers.id')->get();
        $scopes = Bioproject::leftJoin('samplescopes', 'samplescopes.id','=','bioprojects.samplescope_id')->selectRaw('samplescopes.name, samplescopes.id,  count(bioprojects.samplescope_id) as count')->where('bioprojects.status', 5)->groupBy('samplescopes.id')->get();
        return view('frontend.bioproject', [
            'title' => 'Bioproject',
            'bioprojects' => $bioprojects,
            'organisms' => $organisms,
            'centers' => $centers,
            'scopes' => $scopes
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bioproject  $bioproject
     * @return \Illuminate\Http\Response
     */
    public function show(Bioproject $bioproject)
    {
        //
        if ($bioproject->published_at == null) {
            return view('error.404');
        }
        $pubs = $bioproject->publication()->get();
        $grants = $bioproject->grant()->get();
        $externallinks = $bioproject->externallink()->get();
        $id_data_type = explode(',', $bioproject->getAttribute('data_type_id'));
        $id_objective = explode(',', $bioproject->getAttribute('objective_id'));
        $data_types = Datatype::whereIn('id', $id_data_type)->pluck('name');
        //$objectives = Objective::whereIn('id', $id_objective)->pluck('name');
        $umbrella = Bioproject::where('id', $bioproject->umbproject_id)->first();
        $relevanceBioproject = RelevanceBioproject::where('bioproject_id', $bioproject->id)->first();
        $materialBioproject = MaterialBioproject::where('bioproject_id', $bioproject->id)->first();
        $captureBioproject = CaptureBioproject::where('bioproject_id', $bioproject->id)->first();
        $methodologyBioproject = MethodologyBioproject::where('bioproject_id', $bioproject->id)->first();

        $sampleScopeBioproject = SampleBioproject::where('bioproject_id', $bioproject->id)->first();

        $target = BioprojectTarget::with([
            'celularity',
            'reproduction',
            'ploidy',
            'genomeSize',
            'bioticRelationship',
            'trophicLevel',
            'habitat',
            'salinity',
            'oxygenReq',
            'tempRange',
        ])->where('bioproject_id', $bioproject->id)->first();

        $replicons = OrganismReplicon::with([
            'replType',
            'replLocation',
            'genomeSize',
        ])->where('bioproject_id', $bioproject->id)->get();

        return view('frontend.showbioproject', [
            'title' => 'Bioproject',
            'bioproject' => $bioproject,
            'pubs' => $pubs,
            'grants' => $grants,
            'data_types' => $data_types,
            //'objectives' => $objectives,
            'relevance' => $relevanceBioproject,
            'material' => $materialBioproject,
            'capture' => $captureBioproject,
            'methodology' => $methodologyBioproject,
            'umbrella' => $umbrella,
            'externallinks' => $externallinks,
            'sampleScopeBioproject' => $sampleScopeBioproject,
            'target' => $target,
            'replicons' => $replicons,
        ]);
    }
}

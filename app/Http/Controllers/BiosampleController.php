<?php

namespace App\Http\Controllers;

use App\Models\Biosample;
use App\Models\AttributeValue;
use App\Models\Datatype;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class BiosampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $biosamples = Biosample::with(['organism', 'center', 'user'])->where('status', 5)->paginate(5);
        if ($request->organism) {
            $biosamples = Biosample::with(['organism', 'center', 'user'])->where(['status' => 5, 'organism_id' => Crypt::decrypt($request->organism)])->paginate(5);
        }
        if ($request->center) {
            $biosamples = Biosample::with(['organism', 'center', 'user'])->where(['status' => 5, 'center_id' => Crypt::decrypt($request->center)])->paginate(5);
        }
        $organisms = Biosample::leftJoin('organisms', 'organisms.id', '=', 'biosamples.organism_id')->selectRaw('organisms.name, organisms.taxon_id, organisms.id, count(biosamples.organism_id) as count')->where('biosamples.status',5)->groupBy('organisms.id')->orderBy('organisms.name')->get();
        $centers = Biosample::leftJoin('centers', 'centers.id', '=', 'biosamples.center_id')->selectRaw('centers.name, centers.id, count(biosamples.center_id) as count')->where('biosamples.status',5)->groupBy('centers.id')->get();
        return view('frontend.biosample', [
            'title' => 'Biosamples',
            'biosamples' => $biosamples,
            'organisms' => $organisms,
            'centers' => $centers,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Biosample  $biosample
     * @return \Illuminate\Http\Response
     */
    public function show(Biosample $biosample)
    {
        //
        if ($biosample->published_at == null) {
            return view('error.404');
        }

        $biosample_links = $biosample->externallink()->get();
        $sample_attr = AttributeValue::where('biosample_id', $biosample->id)->get();
        return view('frontend.showbiosample', [
            'title' => 'Biosample',
            'biosample' => $biosample,
            'biosample_links' => $biosample_links,
            'sample_attr' => $sample_attr,
        ]);
    }
}

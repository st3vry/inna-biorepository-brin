<?php

namespace App\Http\Controllers;

use App\Models\Biosample;
use App\Models\AttributeValue;
use App\Models\Datatype;
use Illuminate\Http\Request;

class BiosampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $biosamples = Biosample::with(['organism', 'center', 'user'])->whereNotNull('published_at')->paginate(5);
        $organisms = Biosample::leftJoin('organisms', 'organisms.id', '=', 'biosamples.organism_id')->selectRaw('organisms.name, organisms.taxon_id, count(biosamples.organism_id) as count')->groupBy('organisms.id')->orderBy('organisms.name')->get();
        $centers = Biosample::leftJoin('centers', 'centers.id', '=', 'biosamples.center_id')->selectRaw('centers.name, count(biosamples.center_id) as count')->groupBy('centers.name')->get();
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

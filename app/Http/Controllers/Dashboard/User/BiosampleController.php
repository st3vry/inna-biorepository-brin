<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\Biosample;
use App\Models\ActionLog;
use App\Models\AttributeValue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SampletypePackage;
use App\Models\Sampletype;
use App\Models\Attributesample;

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
        return view('dashboard.biosample.index', [
            // 'biosamples' => Biosample::with(['organism', 'center'])->where('user_id', auth()->user()->id)->where('status', 1)->where('published_at', '<>', null)->orderBy('published_at', 'desc')->orderBy('id')->paginate(5),
            'biosamples' => Biosample::with(['organism', 'center'])->where('user_id', auth()->user()->id)->orderBy('id')->paginate(5),
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
        $submitter = new \stdClass();
        $submitter->name = auth()->user()->name;
        $submitter->email = auth()->user()->email;
        $submitter->lab = auth()->user()->affiliate;
        $submitter->center = auth()->user()->administrative;

        $return = [
            "submitter" => $submitter,
            "packages" => SampletypePackage::All()
        ];



        return view('dashboard.v2.biosample.create', $return);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Biosample $biosample)
    {
        //
        $histories = ActionLog::with(['creator'])->where('item_id', $biosample->accession)->orderBy('created_at', 'desc')->get();
        $sample_attr = AttributeValue::where('biosample_id', $biosample->id)->get();
        return view('dashboard.biosample.show', [
            'biosample' => $biosample,
            'histories' => $histories,
            'sample_attr' => $sample_attr,
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Biosample $biosample)
    {
        //
        Biosample::destroy($biosample->id);
        return redirect('/dashboard/biosamples')->with('success', 'Biosamples has been deleted!');
    }

    public function getSample($id) {
        $results = Sampletype::where("sampletype_package_id", $id)->get();
        return response()->json($results);
    }

    public function getAttributes($id) {
        $sampletypes = Sampletype::where('id', $id)->first();
        $attr_sample = explode(',', $sampletypes['attribute_property']);
        $attributes = Attributesample::whereIn('id', $attr_sample)->get();
        $results = new \stdClass();
        $results->attributes = $attributes;
        $results->attributesM = explode(',', $sampletypes['attribute_M']);
        $results->attributesE = explode(',', $sampletypes['attribute_E']);
        // dd($results);
        return response()->json($results);
    }
}

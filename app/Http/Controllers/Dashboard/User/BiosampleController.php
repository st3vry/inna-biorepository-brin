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
use App\Models\Organism;

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
            'biosamples' => Biosample::with(['organism', 'center'])->where('user_id', auth()->user()->id)->orderBy('id')->get(),

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
        $submitter->lab = auth()->user()->lab_id;
        $submitter->center = auth()->user()->center_id;

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

        // dd($request);
        $biosample = new Biosample();
        $biosample->accession = 'SAM' . sprintf('%06d', intval($biosample->query()->max("id")) + 1);
        $biosample->submission_id = 'SUBSAM' . sprintf('%06d', intval($biosample->query()->max("id")) + 1);
        $biosample->title = $request->sample_title;
        $biosample->description = $request->description;
        $biosample->hold_release = $request->hold_release;
        $biosample->sampletype_id = $request->sample_type_select;

        // $biosample->comments = $request->comments;
        $biosample->description = $request->description;
        // $biosample->hold_release = $validatedData['hold_release'];
        // $biosample->comments = $validatedData['comments'];
        // $biosample->sampletype_id = $validatedData['sampletype_id'];

        // $biosample->center_id = auth()->user()->lab->center_id;
        $biosample->center_id = auth()->user()->center_id;
        $biosample->user_id = auth()->user()->id;
        // need to change if organism table ready
        $biosample->organism_id = $request->organism;
        // $biosample->organism_name = $request->organism;
        // $biosample->organism_name = $validatedData['organism'];
        //
        $biosample->save();

        $sample_types = Sampletype::where('id', $request->sample_type_select)->first();
        $attr_arr = explode(',', $sample_types['attribute_property']);
        $attr_sample = Attributesample::whereIn('id', $attr_arr)->get();
        foreach ($attr_sample as $attr) {
            $attribute_value = new AttributeValue();
            $attribute_value->biosample_id = $biosample->id;
            $attribute_value->sampletype_id = $request->sample_type_select;
            $attribute_value->attributesample_id = $attr->id;
            $attribute_value->value = $request[$attr->attr_name];
            // dd($request[$attr->attr_name]);
            $attribute_value->save();
        }
        return redirect('/dashboard/v2/biosamples')->with('success', 'New Biosample has been added!');
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
        $organism = Organism::where('id', $biosample->organism_id)->first();
        return view('dashboard.biosample.show', [
            'biosample' => $biosample,
            'histories' => $histories,
            'sample_attr' => $sample_attr,
            'organism' => $organism,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Biosample $biosample)
    {
        //
        //
        $submitter = new \stdClass();
        $submitter->name = auth()->user()->name;
        $submitter->email = auth()->user()->email;
        $submitter->lab = auth()->user()->lab_id;
        $submitter->center = auth()->user()->center_id;
        $sample_attr = AttributeValue::where('biosample_id', $biosample->id)->get();

        // dd($biosample->externallink());
        $externallinks = $biosample->externallink()->get();
        $sampletype = Sampletype::where('id', $biosample->sampletype_id)->first();
        $organism = Organism::where('id', $biosample->organism_id)->first();
        // dd($sampletype);
        // dd($sample_attr[0]->value);
        $return = [
            "submitter" => $submitter,
            "packages" => SampletypePackage::All(),
            "biosample" => $biosample,
            "externallinks" => $externallinks,
            "sampletype" => $sampletype,
            "sample_attr" => $sample_attr,
            "organism" => $organism,
        ];
        return view('dashboard.v2.biosample.edit', $return);
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

    public function getSample($id)
    {
        $results = Sampletype::where("sampletype_package_id", $id)->get();
        return response()->json($results);
    }

    public function getAttributes($id)
    {
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

    public function getValueAttributes(Biosample $biosample)
    {
        $sample_attr = AttributeValue::where('biosample_id', $biosample->id)->get();
        $results = new \stdClass();
        $results->sample_attr = $sample_attr;
        return response()->json($results);
    }

    public function getOrganism($slug)
    {
        $organism =  Organism::where('name', 'ilike', '%' . $slug . '%')->select("name as text", "id", "taxon_id")->take(10)->get();
        return response()->json($organism);
    }
}

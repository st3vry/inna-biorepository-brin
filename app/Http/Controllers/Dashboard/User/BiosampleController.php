<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\Biosample;
use App\Models\Bioproject;
use App\Models\BioSampleExternalLink;
use App\Models\ActionLog;
use App\Models\AttributeValue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SampletypePackage;
use App\Models\Sampletype;
use App\Models\Attributesample;
use App\Models\Organism;
use App\Models\Lab;
use App\Models\Center;
use App\Models\BiosampleDraft;

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
        $draft = BiosampleDraft::where('user_id', auth()->id())->where('status', 0)->count();
        return view('dashboard.biosample.index', [
            'draft' => $draft,
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
        $bioprojects = Bioproject::whereNotNull('published_at')
            ->where(function ($q) {
                $q->where('hold_release', false)
                  ->orWhere('user_id', auth()->id());
            })
            ->orderBy('id')
            ->get();
        $submitter = new \stdClass();
        $submitter->name = auth()->user()->name;
        $submitter->email = auth()->user()->email;
        $submitter->lab = auth()->user()->lab_id;
        $submitter->center = auth()->user()->center_id;
        $submitter->lab_name = Lab::where('id', $submitter->lab)->value('name');
        $submitter->center_name = Center::where('id', $submitter->center)->value('name');
        $draft = BiosampleDraft::where('user_id', auth()->id())->where('status', 0)->first();
        $return = [
            "draft" => $draft,
            "submitter" => $submitter,
            "packages" => SampletypePackage::All(),
            "bioprojects" => $bioprojects,
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

        if ($request->draft_id) {
            // delete draft after submit
            BiosampleDraft::destroy($request->draft_id);
        }
        $biosample = new Biosample();
        $biosample->accession = 'INNAS' . sprintf('%06d', intval($biosample->query()->max("id")) + 1);
        $biosample->submission_id = 'INNASUBS' . sprintf('%06d', intval($biosample->query()->max("id")) + 1);
        $biosample->title = $request->sample_title;
        // $biosample->description = $request->description;
        $biosample->hold_release = $request->hold_release;
        $biosample->sampletype_id = $request->sample_type_select;
        $biosample->comments = $request->comments;
        $biosample->description = $request->sample_description;
        $biosample->bioproject_id = $request->bioproject_id;
        $biosample->center_id = auth()->user()->center_id;
        $biosample->user_id = auth()->user()->id;

        // need to change if organism table ready
        $biosample->organism_id = $request->organism;
        $biosample->organism_name = $request->organism_name;
        $biosample->organism_detail = is_string($request->organism_detail) ? json_decode($request->organism_detail, true) : $request->organism_detail;
        // $biosample->organism_name = $validatedData['organism'];
        //
        $biosample->save();

        // External Links
        if ($request->has('external_link_description')) {
            for ($i = 0; $i < count($request->external_link_description); $i++) {
                $externalLink = new BioSampleExternalLink();
                $externalLink->biosample_id = $biosample->id;
                $externalLink->link_description = $request->external_link_description[$i];;
                $externalLink->link_url = $request->external_link_url[$i];;
                $externalLink->save();
            }
        } 

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
        $externallinks = $biosample->externallink()->get();
        $organism = Organism::where('id', $biosample->organism_id)->first();
        return view('dashboard.biosample.show', [
            'biosample' => $biosample,
            'histories' => $histories,
            'sample_attr' => $sample_attr,
            'externallinks' => $externallinks,
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
        if ($biosample->draft == false) {
            return view('error.404');
        }

        $bioprojects = Bioproject::whereNotNull('published_at')
            ->where(function ($q) {
                $q->where('hold_release', false)
                  ->orWhere('user_id', auth()->id());
            })
            ->orderBy('id')
            ->get();
        $submitter = new \stdClass();
        $submitter->name = auth()->user()->name;
        $submitter->email = auth()->user()->email;
        $submitter->lab = auth()->user()->lab_id;
        $submitter->center = auth()->user()->center_id;
        $submitter->lab_name = Lab::where('id', $submitter->lab)->value('name');
        $submitter->center_name = Center::where('id', $submitter->center)->value('name');
        $sample_attr = AttributeValue::where('biosample_id', $biosample->id)->get();

        // dd($biosample->externallink());
        $externallinks = $biosample->externallink()->get();
        $sampletype = Sampletype::where('id', $biosample->sampletype_id)->first();
        $organism = Organism::where('id', $biosample->organism_id)->first();
        // dd($sampletype);
        // dd($sample_attr[0]->value);
        $return = [
            "bioprojects" => $bioprojects,
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
     * @param  \App\Models\Biosample  $biosample
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Biosample $biosample)
    {
        if ($biosample->user_id !== auth()->id()) {
            abort(403);
        }

        // Update main biosample fields that exist in the v2 edit form
        $biosample->hold_release = $request->input('hold_release', $biosample->hold_release);
        $biosample->comments = $request->input('comments', $biosample->comments);
        $biosample->bioproject_id = $request->input('bioproject_id', $biosample->bioproject_id);
        $biosample->organism_name = $request->input('organism_name', $biosample->organism_name);
        $biosample->organism_detail = is_string($request->input('organism_detail')) ? json_decode($request->input('organism_detail'), true) : $request->input('organism_detail', $biosample->organism_detail);

        if ($request->filled('sample_type_select')) {
            $biosample->sampletype_id = $request->input('sample_type_select');
        }

        // Optional fields (only update if present in request)
        if ($request->filled('sample_title')) {
            $biosample->title = $request->input('sample_title');
        }
        if ($request->filled('sample_description')) {
            $biosample->description = $request->input('sample_description');
        }

        // organism comes from the dynamic formAttributes inputs (select2)
        if ($request->filled('organism')) {
            $biosample->organism_id = $request->input('organism');
        }
        $biosample->draft = false;
        $biosample->status = 2; //submitted back after edit
        $biosample->save();

        // Replace external links
        BioSampleExternalLink::where('biosample_id', $biosample->id)->delete();
        $descriptions = $request->input('external_link_description', []);
        $urls = $request->input('external_link_url', []);
        if (is_string($descriptions)) {
            $descriptions = [$descriptions];
        }
        if (is_string($urls)) {
            $urls = [$urls];
        }
        $max = max(count($descriptions), count($urls));
        for ($i = 0; $i < $max; $i++) {
            $description = trim((string) ($descriptions[$i] ?? ''));
            $url = trim((string) ($urls[$i] ?? ''));
            if ($description === '' && $url === '') {
                continue;
            }
            BioSampleExternalLink::create([
                'biosample_id' => $biosample->id,
                'link_description' => $description,
                'link_url' => $url,
            ]);
        }

        // Replace attribute values for the selected sample type (the dynamic inputs in #formAttributes)
        $sampletypeId = $biosample->sampletype_id;
        $sampletype = Sampletype::where('id', $sampletypeId)->first();
        if ($sampletype) {
            AttributeValue::where('biosample_id', $biosample->id)->delete();

            $attrIds = array_filter(explode(',', (string) $sampletype->attribute_property));
            $attrSamples = Attributesample::whereIn('id', $attrIds)->get();

            foreach ($attrSamples as $attr) {
                $rawValue = $request->input($attr->attr_name);
                $value = ($rawValue === '' || $rawValue === null) ? null : $rawValue;

                AttributeValue::create([
                    'biosample_id' => $biosample->id,
                    'sampletype_id' => $sampletypeId,
                    'attributesample_id' => $attr->id,
                    'value' => $value,
                ]);
            }
        }
        ActionLog::create([
            'action' => "biosampleEdited",
            'type' => 'Biosample',
            'item_id' => $biosample->accession,
            'user_target'=> $biosample->curator_id,
            'created_by' =>auth()->id(),
            'desc' => null,
        ]);

        return redirect('/dashboard/v2/biosamples')->with('success', 'Biosample has been updated!');
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
        return redirect('/dashboard/v2/biosamples')->with('success', 'Biosamples has been deleted!');
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

    public function getValueAttributes($id)
    {
        $sample_attr = AttributeValue::where('biosample_id', $id)->get();
        $results = new \stdClass();
        $results->sample_attr = $sample_attr;
        return response()->json($results);
    }

    public function getOrganism($slug)
    {
        $organism =  Organism::where('name', 'ilike', '%' . $slug . '%')->select("name as text", "id", "taxon_id")->take(10)->get();
        return response()->json($organism);
    }

    public function getOrganismById($id)
    {
        $organism = Organism::where('id', $id)
            ->select('name as text', 'id', 'taxon_id')
            ->first();

        if (!$organism) {
            return response()->json(null, 404);
        }

        return response()->json($organism);
    }

    public function saveDraft(Request $request)
    {
        try {
            $user = $request->user();
            if (!$user) return response()->json(['status'=>'error','message'=>'Unauthenticated'], 401);

            // accept the full serialized form as JSON (or pick fields)
            $payload = $request->input('data', []);
            // if payload was sent as JSON string, decode it
            if (is_string($payload)) {
                $decoded = json_decode($payload, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $payload = $decoded;
                }
            }

            $title = $request->input('title') ?? ($payload['title'] ?? null);
            $draftId = $request->input('draft_id');

            if ($draftId) {
                $draft = BiosampleDraft::where('id', $draftId)->where('user_id', $user->id)->first();
                if (!$draft) return response()->json(['status'=>'error','message'=>'Draft not found'], 404);
                $draft->update([
                    'data' => $payload,
                    'title' => $title,
                ]);
            } else {
                $draft = BiosampleDraft::create([
                    'user_id' => $user->id,
                    'title' => $title,
                    'data' => $payload,
                ]);
            }

            return response()->json(['status' => 'OK', 'draft_id' => $draft->id]);
        } catch (\Throwable $e) {
            // log details for debugging
            \Log::error('Error saving biosample draft: ' . $e->getMessage(), [
                'user_id' => $request->user() ? $request->user()->id : null,
                'payload_keys' => is_array($request->input('data', [])) ? array_keys($request->input('data', [])) : null,
            ]);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function loadDraft(BiosampleDraft $draft, Request $request)
    {
        $user = $request->user();
        if (!$user || $draft->user_id !== $user->id) {
            abort(403);
        }
        return response()->json(['status' => 'OK', 'data' => $draft->data]);
    }

    public function discardDraft(BiosampleDraft $draft, Request $request)
    {
        $user = $request->user();
        if (!$user || $draft->user_id !== $user->id) {
            abort(403);
        }
        $draft->delete();
        return response()->json(['status' => 'OK']);
    }
}

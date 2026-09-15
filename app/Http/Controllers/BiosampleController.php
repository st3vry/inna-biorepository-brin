<?php

namespace App\Http\Controllers;

use App\Models\Biosample;
use App\Models\AttributeValue;
use App\Models\Datatype;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Helpers\InnaKmApiHelper;

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
        $biosamples = Biosample::with(['organism', 'center', 'user'])->where([
            'status' => 5,
            'hold_release' => false,
        ])->orderBy('published_at', 'desc')->paginate(10);
        if ($request->organism) {
            $biosamples = Biosample::with(['organism', 'center', 'user'])->where([
                'status' => 5,
                'hold_release' => false,
                'organism_id' => Crypt::decrypt($request->organism)
            ])->paginate(10);
        }
        if ($request->center) {
            $biosamples = Biosample::with(['organism', 'center', 'user'])->where([
                'status' => 5,
                'hold_release' => false,
                'center_id' => Crypt::decrypt($request->center)
            ])->paginate(10);
        }
        $organisms = Biosample::leftJoin('organisms', 'organisms.id', '=', 'biosamples.organism_id')->selectRaw('organisms.name, organisms.taxon_id, organisms.id, count(biosamples.organism_id) as count')->where('biosamples.status', 5)->groupBy('organisms.id')->orderBy('organisms.name')->get();
        $centers = Biosample::leftJoin('centers', 'centers.id', '=', 'biosamples.center_id')->selectRaw('centers.name, centers.id, count(biosamples.center_id) as count')->where('biosamples.status', 5)->groupBy('centers.id')->get();
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
        if ($biosample->published_at == null || $biosample->hold_release == true) {
            return view('error.404');
        }

        $externallinks = $biosample->externallink()->get();
        $sample_attr = AttributeValue::where('biosample_id', $biosample->id)->get();

        $endpoint = '/terms/get';
        $body = [
            // 'ncbi_taxon_id' => [(string) $biosample->organism_id]
            'ncbi_taxon_id' => [$sample_attr[3]->value],
        ];

        $apiResponse = InnaKmApiHelper::contactApi($endpoint, $body);
        if (isset($apiResponse["data"]["data"][0]["data"])) {
            $data = $apiResponse["data"]["data"][0]["data"];
        } else {
            $data = "Data not available";
        }
        // $data = $apiResponse["data"]["data"][0]["data"];

        return view('frontend.showbiosample', [
            'title' => 'Biosample',
            'biosample' => $biosample,
            'externallinks' => $externallinks,
            'sample_attr' => $sample_attr,
            'data' => $data
        ]);
    }

    public function showFAIR(Biosample $biosample)
    {
        $biosample = Biosample::with(['organism', 'center', 'user'])->where('id', $biosample->id)->first();

        // Get external links and sample attributes
        $biosample_links = $biosample->externallink()->get();
        $sample_attr = AttributeValue::with(['sampletypeFAIR', 'attributesampleFAIR'])->where('biosample_id', $biosample->id)->get();

        $fairJson = [
            "id" => $biosample->id,
            "accession" => $biosample->accession,
            "submission_id" => $biosample->submission_id,
            "title" => $biosample->title,
            "hold_release" => (bool) $biosample->hold_release,
            "comments" => $biosample->comments,
            "sampletype_id" => $biosample->sampletype_id,
            "organism_id" => $biosample->organism_id,
            "organism_name" => $biosample->organism_name,
            "description" => $biosample->description,
            "center_id" => $biosample->center_id,
            "user_id" => $biosample->user_id,
            "curator_id" => $biosample->curator_id,
            "draft" => (bool) $biosample->draft,
            "status" => $biosample->status,
            "published_at" => $biosample->published_at,
            "created_at" => $biosample->created_at,
            "updated_at" => $biosample->updated_at,
            "dv_published_at" => $biosample->dv_published_at,
            "dv_persistent_id" => $biosample->dv_persistent_id,
            "metadata" => [
                "license" => "CC-BY-4.0",
                "provenance" => [
                    "submitted_by" => $biosample->submitter->name ?? null,
                    "curated_by" => $biosample->curator->name ?? null,
                    "submission_date" => $biosample->created_at,
                ],
                // Add attribute_values as detailed metadata
                "sampletype" => $biosample->sampletype->name ?? null,
                "attribute_values" => $sample_attr->map(function ($attr) {
                    return [
                        "id" => $attr->id,
                        // "sampletype" => $attr->sampletype->name ?? null,
                        "attributesample" => $attr->attributesample->attr_text ?? null,
                        "value" => $attr->value,
                        "created_at" => $attr->created_at,
                        "updated_at" => $attr->updated_at
                    ];
                })->toArray(),
                // Add external links
                "external_links" => $biosample_links->map(function ($link) {
                    return [
                        "id" => $link->id,
                        "url" => $link->url, // adjust field names as per your table
                        "description" => $link->description ?? null,
                        "created_at" => $link->created_at,
                        "updated_at" => $link->updated_at
                    ];
                })->toArray()
                // "keywords" => ["biosample", "human", "blood", "genomics"],
                // "related_resources" => [
                //     [
                //         "relation_type" => "isPartOf",
                //         "identifier" => "doi:10.5678/parent-dataset"
                //     ]
                // ]
            ]
        ];

        return response()->json($fairJson, 200, [], JSON_PRETTY_PRINT);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class TaxonController extends Controller
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl = rtrim(env('NCBI_API_URL'), '/');
        $this->apiKey  = env('NCBI_API_KEY');
    }

    /**
     * GET /organism/query/{taxon_query}
     * NCBI_QUERY_PATH = /taxonomy/taxon_suggest/{taxon_query}
     */
    public function query(string $taxon_query): JsonResponse
    {
        $path = str_replace('{taxon_query}', $taxon_query, ltrim(env('NCBI_QUERY_PATH'), '/'));
        $url  = "{$this->baseUrl}/{$path}";

        $response = Http::get($url, ['api_key' => $this->apiKey]);

        return response()->json($response->json(), $response->status());
    }

    /**
     * GET /organism/name/{taxons}
     * NCBI_NAME_PATH = /taxonomy/taxon/{taxons}/name_report
     */
    public function nameReport(string $taxons): JsonResponse
    {
        $path = str_replace('{taxons}', $taxons, ltrim(env('NCBI_NAME_PATH'), '/'));
        $url  = "{$this->baseUrl}/{$path}";

        $response = Http::get($url, ['api_key' => $this->apiKey]);

        return response()->json($response->json(), $response->status());
    }

    /**
     * GET /organism/dataset/{taxons}
     * NCBI_DATASET_PATH = /taxonomy/taxon/{taxons}/dataset_report
     */
    public function datasetReport(string $taxons): JsonResponse
    {
        $path = str_replace('{taxons}', $taxons, ltrim(env('NCBI_DATASET_PATH'), '/'));
        $url  = "{$this->baseUrl}/{$path}";

        $response = Http::get($url, ['api_key' => $this->apiKey]);

        return response()->json($response->json(), $response->status());
    }
}

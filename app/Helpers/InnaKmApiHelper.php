<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class InnaKmApiHelper
{
    /**
     * Send a POST request to an API and return the response.
     *
     * @param string $endpoint The API endpoint.
     * @param array $data The data to be sent in the request body.
     * @return array Returns an array with 'success', 'data', and 'message'.
     */
    public static function contactApi(string $endpoint, array $data)
    {
        try {
            $response = Http::post($endpoint, $data);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(),
                    'message' => 'API call successful.',
                ];
            }

            return [
                'success' => false,
                'data' => null,
                'message' => 'API responded with an error: ' . $response->status(),
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'data' => null,
                'message' => 'Error while contacting the API: ' . $e->getMessage(),
            ];
        }
    }
}

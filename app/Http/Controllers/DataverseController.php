<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Bioproject;
use App\Models\Datatype;
use App\Models\Fundagency;
use App\Models\Grant;
use App\Models\MaterialBioproject;
use App\Models\CaptureBioproject;
use App\Models\RelevanceBioproject;
use App\Models\MethodologyBioproject;
use App\Models\Biosample;
use App\Models\AttributeValue;
use App\Models\Bioarchive;
use App\Models\Bioexperiment;
use App\Models\Biorun;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class DataverseController extends Controller
{
    public function createDataverse(Request $request)
    {
        $appUrl = rtrim(config('app.url'), '/');
        $accession = $request->accession;
        $bioproject = Bioproject::where('accession', $accession)->first();
        $organism = $bioproject->organism()->first();
        $umbrellaProjects = Bioproject::where('id', $bioproject->umbproject_id)->first();
        $relevanceBioproject = RelevanceBioproject::where('bioproject_id', $bioproject->id)->first();
        $materialBioproject = MaterialBioproject::where('bioproject_id', $bioproject->id)->first();
        $captureBioproject = CaptureBioproject::where('bioproject_id', $bioproject->id)->first();
        $methodologyBioproject = MethodologyBioproject::where('bioproject_id', $bioproject->id)->first();

        $umbrella = $umbrellaProjects ?  "<p><strong>Umbrella Projects: </strong><a href='{$appUrl}/bioprojects/{$umbrellaProjects->accession}'> {$umbrellaProjects->title}</a></p>" : "";
        $consortioum = $bioproject->consortium ?  "<p><strong>Consortium: </strong><a href='https://{ $bioproject->consortium->url }'>{$bioproject->consortium->url}</a></p>" : "";
        $relevance = $relevanceBioproject->relevance->id == 7 ? "<p><strong>Relevance: </strong>{$relevanceBioproject->relevance->name} &mdash; {$relevanceBioproject->description} </p>" : "<p><strong>Relevance: </strong>{$relevanceBioproject->relevance->name}</p>";
        $material =  $materialBioproject->material->id == 7 ? "<p><strong>Material: </strong>{$materialBioproject->material->name} &mdash; {$materialBioproject->description} </p>" : "<p><strong>Material: </strong>{$materialBioproject->material->name}</p>";
        $capture =  $captureBioproject->capture->id == 6 ? "<p><strong>Capture: </strong>{$captureBioproject->capture->name} &mdash; {$captureBioproject->description} </p>" : "<p><strong>Capture: </strong>{$captureBioproject->capture->name}</p>";
        $methodology =  $methodologyBioproject->methodology->id == 4 ? "<p><strong>Methodology: </strong>{$methodologyBioproject->methodology->name} &mdash; {$methodologyBioproject->description} </p>" : "<p><strong>Methodology: </strong>{$methodologyBioproject->methodology->name}</p>";
        $userData = $bioproject->user()->first();
        $affiliate = "Badan Riset dan Inovasi Nasional";
        $dataverseContact = "{
                \"contactEmail\" : \"inna.repository@brin.go.id\",
            }";
        if ($userData != null) {
            $userDataJson = json_decode($userData->user_data);
            $affiliate = isset($userDataJson->pegawaiData) ? "{$userDataJson->pegawaiData->administrative_name} - {$userDataJson->pegawaiData->affiliate_name}" : $userDataJson->userData->first_name;
            $dataverseContact = "{
                \"contactEmail\" : \"inna.repository@brin.go.id\",
                \"contactEmail\" : \"{$userDataJson->userData->email}\"
            }";
        }

        $affiliate = isset($userDataJson->pegawaiData) ? "{$userDataJson->pegawaiData->administrative_name} - {$userDataJson->pegawaiData->affiliate_name}" : $userDataJson->userData->first_name;
        $description = "
            <p>{$bioproject->description}</p>
            <p><strong>Accession Number: </strong>{$bioproject->accession}</p>
            <p><strong>Organism &mdash; Taxonomy ID: </strong>{$bioproject->organism->name} &mdash; {$bioproject->organism->taxon_id}</p>
            {$umbrella}
            {$consortioum}
            {$relevance}
            {$material}
            {$capture}
            {$methodology}
            <p>This BioProject was automatically submitted from the <a href='{$appUrl}'>INNA Repository</a>. For more details about this BioProject, please refer to the following link: <a href='{$appUrl}/bioprojects/{$accession}'>{$appUrl}/bioprojects/{$accession}</a></p>
        ";

        $rawJson = "{
            \"name\": \"[BIOPROJECT] - {$bioproject->title}\",
            \"alias\": \"{$bioproject->accession}\",
            \"dataverseContacts\": [{$dataverseContact}],
            \"affiliation\": \"{$affiliate}\",
            \"description\": \"{$description}\",
            \"dataverseType\": \"RESEARCH_PROJECTS\"
        }";
        $client = new Client();
        // Use configured base URL and key
        $baseUrl = config('services.api_dataverse.base_url_dataverse');
        // $apiKey  = config('services.api_dataverse.api_key_dataverse');
        // Ambil API-key dari header jika ada, jika tidak pakai default config
        $apiKey  = $request->header('X-DATAVERSE-KEY') ?? config('services.api_dataverse.api_key_dataverse');
        $endpoint = "{$baseUrl}/api/dataverses/INNA";

        $response = $client->post($endpoint, [
            'headers' => [
                'X-Dataverse-key' => $apiKey,
            ],
            'body' => Psr7\Utils::streamFor(preg_replace('!\s+!', ' ', $rawJson))
        ]);

        $jsonResponse = json_decode($response->getBody());
        if ($jsonResponse->status == "OK") {
            $action = Bioproject::where('accession', $accession)->update([
                'dv_published_at' => NOW()
            ]);

            if ($action) {
                ActionLog::create([
                    'action' => "Sync Bioproject to Dataverse",
                    'type' => 'Bioproject',
                    'item_id' => $accession,
                    'created_by' => auth()->id()
                ]);
            }
        }
        return json_decode($response->getBody());
    }

    public function buildCsvFile($columns, $content, $type): string
    {
        $file = tmpfile();
        fputcsv($file, $columns);
        if ($type == "biosample") {
            fputcsv($file, $content);
        } else {
            foreach ($content as $item) {
                fputcsv($file, $item);
            }
        }
        $metaDatas = stream_get_meta_data($file);
        return file_get_contents($metaDatas['uri']);
    }

    public function cleanFileName($filename)
    {
        $sanitized_filename = preg_replace('/[^A-Za-z0-9-_\.[:blank:]]/', '', $filename);
        $sanitized_filename = preg_replace('/[[:blank:]]+/', '_', $sanitized_filename);
        return $sanitized_filename;
    }

    public function createDataFile(Request $request,  $type, $accession)
    {
        $fileName = ".csv";
        $header = array();
        $data = array();
        $dataForFile = array();
        $parent = "Biaosample";
        if ($type == "biosample") {
            $biosample = Biosample::where('accession', $accession)->first();
            $parent = $biosample->title;
            $fileName =  $this->cleanFileName($biosample->sampletype->name . $fileName);
            $persistentId = $biosample->dv_persistent_id;
            $sampleAttributes = AttributeValue::where('biosample_id', $biosample->id)->get();
            $description = "This datafile contains {$biosample->sampletype->name} Biosample Attributes details.";
            $directory = "INNA/{$accession}";
            foreach ($sampleAttributes as $sampleAttribute => $value) {
                array_push($header, $value->attributesample->attr_text);
                array_push($data, $value->value);
            }
        }
        if ($type == "bioarchive") {
            $bioarchive = Bioarchive::where('accession', $accession)->first();
            $parent = $bioarchive->bioproject->accession;
            $fileName =  $this->cleanFileName($bioarchive->submission_id . $fileName);
            $persistentId = $bioarchive->dv_persistent_id;
            $bioexperiments = Bioexperiment::where('bioarchive_id', $bioarchive->id)->get();
            $description = "This datafile contains {$accession} Bioexperiments Sample details.";
            $directory  = "INNA/{$parent}/{$accession}";
            array_push($header, "Biosample");
            array_push($header, "Title");
            array_push($header, "Library Source");
            array_push($header, "Library Selection");
            array_push($header, "Library Strategy");
            array_push($header, "Instrument");
            array_push($header, "Library Layout");
            foreach ($bioexperiments as $bioexperiment) {
                array_push($data, $bioexperiment->biosample->accession);
                array_push($data, $bioexperiment->title);
                array_push($data, $bioexperiment->libsource->name);
                array_push($data, $bioexperiment->libselection->name);
                array_push($data, $bioexperiment->libstrategy->name);
                array_push($data, $bioexperiment->instrument->name);
                array_push($data, $bioexperiment->liblayout->name);
                array_push($dataForFile, $data);
                $data = array();
            }
        }

        $cb = $this->buildCsvFile($header, $dataForFile, $type);
        $tes = Storage::disk('local')->put("datafile/{$fileName}", $cb);
        if (!$tes) {
            return "error";
        }
        $client = new Client();
        // Use configured base URL and key
        $baseUrl = config('services.api_dataverse.base_url_dataverse');
        // $apiKey  = config('services.api_dataverse.api_key_dataverse');
        // Ambil API-key dari header jika ada, jika tidak pakai default config
        $apiKey  = $request->header('X-DATAVERSE-KEY') ?? config('services.api_dataverse.api_key_dataverse');

        $endpoint = "{$baseUrl}/api/datasets/:persistentId/add?persistentId={$persistentId}";
        try {
            $response = $client->post($endpoint, [
                'headers' => [
                    'X-Dataverse-key' => $apiKey,
                ],
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => Psr7\Utils::streamFor(Psr7\Utils::tryFopen(Storage::disk('local')->path("datafile/{$fileName}"), 'r'))
                    ],
                    [
                        'name' => 'jsonData',
                        'contents' => "{\"description\":\"{$description}\",\"directoryLabel\":\"INNA/{$accession}\",\"categories\":[\"Data\"], \"restrict\":\"false\"}"
                    ]
                ]
            ]);
        } catch (\Throwable $th) {
            $rawJson = "{
                \"status\": \"ERROR\",
                \"message\": \"{$th->getMessage()}\"
            }";
            return json_decode($rawJson);
        }

        $jsonResponse = json_decode($response->getBody());
        if ($jsonResponse->status == "OK") {
            Storage::delete("datafile/{$fileName}");
        }
        return json_decode($response->getBody());
    }

    public function createDatasetSample(Request $request)
    {
        $appUrl = rtrim(config('app.url'), '/');
        $accession = $request->accession;
        $biosample = Biosample::where('accession', $accession)->first();
        $biosample_links = $biosample->externallink()->get();
        $sample_attr = AttributeValue::where('biosample_id', $biosample->id)->get();
        $userData = $biosample->user()->first();
        $userDataJson = json_decode($userData->user_data);
        $affiliate = isset($userDataJson->pegawaiData) ? "{$userDataJson->pegawaiData->administrative_name} - {$userDataJson->pegawaiData->affiliate_name}" : $userDataJson->userData->first_name;
        $description = "<p>This BioSample was automatically submitted from the <a href='{$appUrl}'>INNA Repository</a>. For more details about this BioSamples, please refer to the following link: <a href='{$appUrl}/biosamples/{$accession}'>{$appUrl}/biosamples/{$accession}</a></p>";
        $rawJson = "
            {
                \"datasetVersion\": {
                    \"license\": \"CC0\",
                    \"termsOfUse\": \"CC0 Waiver\",
                    \"metadataBlocks\": {
                        \"citation\": {
                            \"displayName\": \"Citation Metadata\",
                            \"fields\": [
                                {
                                    \"typeName\": \"title\",
                                    \"multiple\": false,
                                    \"typeClass\": \"primitive\",
                                    \"value\": \"[BIOSAMPLE] - {$biosample->title}\"
                                },
                                {
                                    \"typeName\": \"otherId\",
                                    \"multiple\": true,
                                    \"typeClass\": \"compound\",
                                    \"value\": [
                                        {
                                            \"otherIdAgency\": {
                                                \"typeName\": \"otherIdAgency\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"Accession Number\"
                                            },
                                            \"otherIdValue\": {
                                                \"typeName\": \"otherIdValue\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$accession}\"
                                            }
                                        }
                                    ]
                                },
                                {
                                    \"typeName\": \"author\",
                                    \"multiple\": true,
                                    \"typeClass\": \"compound\",
                                    \"value\": [
                                        {
                                            \"authorName\": {
                                                \"typeName\": \"authorName\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"Repository, Inna\"
                                            },
                                            \"authorAffiliation\": {
                                                \"typeName\": \"authorAffiliation\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"Badan Riset dan Inovasi Nasional\"
                                            }
                                        },
                                        {
                                            \"authorName\": {
                                                \"typeName\": \"authorName\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$userDataJson->userData->last_name}, {$userDataJson->userData->first_name}\"
                                            },
                                            \"authorAffiliation\": {
                                                \"typeName\": \"authorAffiliation\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$affiliate}\"
                                            }
                                        }
                                    ]
                                },
                                {
                                    \"typeName\": \"datasetContact\",
                                    \"multiple\": true,
                                    \"typeClass\": \"compound\",
                                    \"value\": [
                                        {
                                            \"datasetContactName\": {
                                                \"typeName\": \"datasetContactName\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"Repository, Inna\"
                                            },
                                            \"datasetContactAffiliation\": {
                                                \"typeName\": \"datasetContactAffiliation\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"Badan Riset dan Inovasi Nasional\"
                                            },
                                            \"datasetContactEmail\": {
                                                \"typeName\": \"datasetContactEmail\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"inna.repository@brin.go.id\"
                                            }
                                        },
                                        {
                                            \"datasetContactName\": {
                                                \"typeName\": \"datasetContactName\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$userDataJson->userData->last_name}, {$userDataJson->userData->first_name}\"
                                            },
                                            \"datasetContactAffiliation\": {
                                                \"typeName\": \"datasetContactAffiliation\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$affiliate}\"
                                            },
                                            \"datasetContactEmail\": {
                                                \"typeName\": \"datasetContactEmail\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$userDataJson->userData->email}\"
                                            }
                                        }
                                    ]
                                },
                                {
                                    \"typeName\": \"dsDescription\",
                                    \"multiple\": true,
                                    \"typeClass\": \"compound\",
                                    \"value\": [
                                        {
                                            \"dsDescriptionValue\": {
                                                \"typeName\": \"dsDescriptionValue\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$biosample->description}\"
                                            },
                                            \"dsDescriptionDate\": {
                                                \"typeName\": \"dsDescriptionDate\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$biosample->published_at->format('Y-m-d')}\"
                                            }
                                        },
                                        {
                                            \"dsDescriptionValue\": {
                                                \"typeName\": \"dsDescriptionValue\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$description}\"
                                            },
                                            \"dsDescriptionDate\": {
                                                \"typeName\": \"dsDescriptionDate\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$biosample->published_at->format('Y-m-d')}\"
                                            }
                                        }
                                    ]
                                },
                                {
                                    \"typeName\": \"subject\",
                                    \"multiple\": true,
                                    \"typeClass\": \"controlledVocabulary\",
                                    \"value\": [
                                        \"Medicine, Health and Life Sciences\"
                                    ]
                                },
                                {
                                    \"typeName\": \"depositor\",
                                    \"multiple\": false,
                                    \"typeClass\": \"primitive\",
                                    \"value\": \"{$userDataJson->userData->last_name}, {$userDataJson->userData->first_name}\"
                                },
                                {
                                    \"typeName\": \"dateOfDeposit\",
                                    \"multiple\": false,
                                    \"typeClass\": \"primitive\",
                                    \"value\": \"{$biosample->created_at->format('Y-m-d')}\"
                                }
                            ]
                        }
                    }
                }
            }
        ";
        $client = new Client();
        // Use configured base URL and key
        $baseUrl = config('services.api_dataverse.base_url_dataverse');
        // $apiKey  = config('services.api_dataverse.api_key_dataverse');
        // Ambil API-key dari header jika ada, jika tidak pakai default config
        $apiKey  = $request->header('X-DATAVERSE-KEY') ?? config('services.api_dataverse.api_key_dataverse');
        $endpoint = "{$baseUrl}/api/dataverses/INNA/datasets";
        $response = $client->post($endpoint, [
            'headers' => [
                'X-Dataverse-key' => $apiKey,
            ],
            'body' => Psr7\Utils::streamFor(preg_replace('!\s+!', ' ', $rawJson))
        ]);
        $jsonResponse = json_decode($response->getBody());
        if ($jsonResponse->status == "OK") {
            $action = Biosample::where('accession', $accession)->update([
                'dv_published_at' => NOW(),
                'dv_persistent_id' => $jsonResponse->data->persistentId
            ]);
            if ($action) {
                $this->createDataFile($request, "biosample", $accession);
                ActionLog::create([
                    'action' => "Sync Biosample to Dataverse",
                    'type' => 'Biosample',
                    'item_id' => $accession,
                    'created_by' => auth()->id()
                ]);
            }
        }
        return json_decode($response->getBody());
    }

    public function createDatasetArchive(Request $request)
    {
        $appUrl = rtrim(config('app.url'), '/');
        $accession = $request->accession;
        $bioarchive = Bioarchive::where('accession', $accession)->first();
        $parent = $bioarchive->bioproject->accession;
        $bioexperiments = Bioexperiment::where('bioarchive_id', $bioarchive->id)->get();
        $bioruns = Biorun::where('bioexperiment_id', $bioexperiments[0]->id)->get();
        $userData = $bioarchive->user()->first();
        $userDataJson = json_decode($userData->user_data);
        $affiliate = isset($userDataJson->pegawaiData) ? "{$userDataJson->pegawaiData->administrative_name} - {$userDataJson->pegawaiData->affiliate_name}" : $userDataJson->userData->first_name;
        $description = "<p>This BioArchive was automatically submitted from the <a href='{$appUrl}'>INNA Repository</a>. For more details about this BioArchive, please refer to the following link: <a href='{$appUrl}/bioarchives/{$accession}'>{$appUrl}/bioarchives/{$accession}</a></p>";
        $rawJson = "
            {
                \"datasetVersion\": {
                    \"license\": \"CC0\",
                    \"termsOfUse\": \"CC0 Waiver\",
                    \"metadataBlocks\": {
                        \"citation\": {
                            \"displayName\": \"Citation Metadata\",
                            \"fields\": [
                                {
                                    \"typeName\": \"title\",
                                    \"multiple\": false,
                                    \"typeClass\": \"primitive\",
                                    \"value\": \"[BIOARCHIVE] - Bioproject Title: {$bioarchive->bioproject->title}\"
                                },
                                {
                                    \"typeName\": \"otherId\",
                                    \"multiple\": true,
                                    \"typeClass\": \"compound\",
                                    \"value\": [
                                        {
                                            \"otherIdAgency\": {
                                                \"typeName\": \"otherIdAgency\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"Accession Number\"
                                            },
                                            \"otherIdValue\": {
                                                \"typeName\": \"otherIdValue\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$accession}\"
                                            }
                                        }
                                    ]
                                },
                                {
                                    \"typeName\": \"author\",
                                    \"multiple\": true,
                                    \"typeClass\": \"compound\",
                                    \"value\": [
                                        {
                                            \"authorName\": {
                                                \"typeName\": \"authorName\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"Repository, Inna\"
                                            },
                                            \"authorAffiliation\": {
                                                \"typeName\": \"authorAffiliation\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"Badan Riset dan Inovasi Nasional\"
                                            }
                                        },
                                        {
                                            \"authorName\": {
                                                \"typeName\": \"authorName\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$userDataJson->userData->last_name}, {$userDataJson->userData->first_name}\"
                                            },
                                            \"authorAffiliation\": {
                                                \"typeName\": \"authorAffiliation\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$affiliate}\"
                                            }
                                        }
                                    ]
                                },
                                {
                                    \"typeName\": \"datasetContact\",
                                    \"multiple\": true,
                                    \"typeClass\": \"compound\",
                                    \"value\": [
                                        {
                                            \"datasetContactName\": {
                                                \"typeName\": \"datasetContactName\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"Repository, Inna\"
                                            },
                                            \"datasetContactAffiliation\": {
                                                \"typeName\": \"datasetContactAffiliation\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"Badan Riset dan Inovasi Nasional\"
                                            },
                                            \"datasetContactEmail\": {
                                                \"typeName\": \"datasetContactEmail\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"inna.repository@brin.go.id\"
                                            }
                                        },
                                        {
                                            \"datasetContactName\": {
                                                \"typeName\": \"datasetContactName\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$userDataJson->userData->last_name}, {$userDataJson->userData->first_name}\"
                                            },
                                            \"datasetContactAffiliation\": {
                                                \"typeName\": \"datasetContactAffiliation\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$affiliate}\"
                                            },
                                            \"datasetContactEmail\": {
                                                \"typeName\": \"datasetContactEmail\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$userDataJson->userData->email}\"
                                            }
                                        }
                                    ]
                                },
                                {
                                    \"typeName\": \"dsDescription\",
                                    \"multiple\": true,
                                    \"typeClass\": \"compound\",
                                    \"value\": [
                                        {
                                            \"dsDescriptionValue\": {
                                                \"typeName\": \"dsDescriptionValue\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"<p><strong>Bioproject Description:</strong> {$bioarchive->bioproject->description}</p>\"
                                            },
                                            \"dsDescriptionDate\": {
                                                \"typeName\": \"dsDescriptionDate\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$bioarchive->published_at->format('Y-m-d')}\"
                                            }
                                        },
                                        {
                                            \"dsDescriptionValue\": {
                                                \"typeName\": \"dsDescriptionValue\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$description}\"
                                            },
                                            \"dsDescriptionDate\": {
                                                \"typeName\": \"dsDescriptionDate\",
                                                \"multiple\": false,
                                                \"typeClass\": \"primitive\",
                                                \"value\": \"{$bioarchive->published_at->format('Y-m-d')}\"
                                            }
                                        }
                                    ]
                                },
                                {
                                    \"typeName\": \"subject\",
                                    \"multiple\": true,
                                    \"typeClass\": \"controlledVocabulary\",
                                    \"value\": [
                                        \"Medicine, Health and Life Sciences\"
                                    ]
                                },
                                {
                                    \"typeName\": \"depositor\",
                                    \"multiple\": false,
                                    \"typeClass\": \"primitive\",
                                    \"value\": \"{$userDataJson->userData->last_name}, {$userDataJson->userData->first_name}\"
                                },
                                {
                                    \"typeName\": \"dateOfDeposit\",
                                    \"multiple\": false,
                                    \"typeClass\": \"primitive\",
                                    \"value\": \"{$bioarchive->created_at->format('Y-m-d')}\"
                                }
                            ]
                        }
                    }
                }
            }
        ";
        $client = new Client();
        $baseUrl = config('services.api_dataverse.base_url_dataverse');
        // $apiKey  = config('services.api_dataverse.api_key_dataverse');
        // Ambil API-key dari header jika ada, jika tidak pakai default config
        $apiKey  = $request->header('X-DATAVERSE-KEY') ?? config('services.api_dataverse.api_key_dataverse');
        $endpoint = "{$baseUrl}/api/dataverses/{$parent}/datasets";
        try {
            $response = $client->post($endpoint, [
                'headers' => [
                    'X-Dataverse-key' => $apiKey,
                ],
                'body' => Psr7\Utils::streamFor(preg_replace('!\s+!', ' ', $rawJson))
            ]);
        } catch (\Throwable $th) {
            $rawJson = "{
                \"status\": \"ERROR\",
                \"message\": \"Bioproject  {$parent} doesn't exist in dataverse. You must sync the Bioproject first!\"
            }";
            return json_decode($rawJson);
        }

        $jsonResponse = json_decode($response->getBody());
        if ($jsonResponse->status == "OK") {
            $action = Bioarchive::where('accession', $accession)->update([
                'dv_published_at' => NOW(),
                'dv_persistent_id' => $jsonResponse->data->persistentId
            ]);
            if ($action) {
                $this->createDataFile($request, "bioarchive", $accession);
                ActionLog::create([
                    'action' => "Sync Bioproject to Dataverse",
                    'type' => 'Bioarchive',
                    'item_id' => $accession,
                    'created_by' => auth()->id()
                ]);
            }
        }
        return json_decode($response->getBody());
    }
}

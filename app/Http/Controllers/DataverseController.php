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
    public function createDataverse(Request $request) {
        $accession = $request->accession;
        $bioproject = Bioproject::where('accession', $accession)->first();
        $organism = $bioproject->organism()->first();
        $umbrellaProjects = Bioproject::where('id', $bioproject->umbproject_id)->first();
        $relevanceBioproject = RelevanceBioproject::where('bioproject_id', $bioproject->id)->first();
        $materialBioproject = MaterialBioproject::where('bioproject_id', $bioproject->id)->first();
        $captureBioproject = CaptureBioproject::where('bioproject_id', $bioproject->id)->first();
        $methodologyBioproject = MethodologyBioproject::where('bioproject_id', $bioproject->id)->first();

        $umbrella = $umbrellaProjects ?  "<p><strong>Umbrella Projects: </strong><a href='https://inna.brin.go.id/bioprojects/{$umbrellaProjects->accession}'> {$umbrellaProjects->title}</a></p>" : "";
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
            $affiliate = "{$userDataJson->pegawaiData->administrative_name} - {$userDataJson->pegawaiData->affiliate_name}";
            $dataverseContact = "{
                \"contactEmail\" : \"inna.repository@brin.go.id\",
                \"contactEmail\" : \"{$userDataJson->pegawaiData->email_corporate}\"
            }";
        }
        $affiliate = "{$userDataJson->pegawaiData->administrative_name} - {$userDataJson->pegawaiData->affiliate_name}";
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
            <p>This BioProject was automatically submitted from the <a href='https://inna.brin.go.id'>INNA Repository</a>. For more details about this BioProject, please refer to the following link: <a href='https://inna.brin.go.id/bioprojects/{$accession}'>https://inna.brin.go.id/bioprojects/{$accession}</a></p>
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
        $response = $client->post('https://data.brin.go.id/api/dataverses/INNA', [
            'headers' => [
                'X-Dataverse-key' => 'a0031e48-838e-4b4a-b375-a48c597745ba',
            ],
            'body'=> Psr7\Utils::streamFor(preg_replace('!\s+!', ' ', $rawJson))
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

    public function buildCsvFile($columns, $content): string {
        $file = tmpfile();
        fputcsv($file, $columns);
        fputcsv($file, $content);

        // foreach ($content as $item) {
        //     dd($item);
        //     $val = explode(",", $item);
        //     fputcsv($file, $val);
        // }
        $metaDatas = stream_get_meta_data($file);
        return file_get_contents($metaDatas['uri']);
    }

    public function createDataFile(Request $request,  $type, $accession) {
        $fileName = ".csv";
        $header = array();
        $data = array();
        $dataForFile = array();
        if ($type == "biosample") {
            $biosample = Biosample::where('accession', $accession)->first();
            $fileName = $biosample->sampletype->name.$fileName;
            $persistentId = $biosample->sampletype->dv_persistent_id;
            $sampleAttributes = AttributeValue::where('biosample_id', $biosample->id)->get();
            foreach ($sampleAttributes as $sampleAttribute => $value) {
                array_push($header,$value->attributesample->attr_text);
                array_push($data,$value->value);
                array_push($data,$value->value);
            }
        }

        $cb = $this->buildCsvFile($header, $data);
        // header('Content-Type: text/csv');
        // header('Content-Disposition: attachment; filename="sample.csv"');
        // $fp = fopen('php://output', 'wb');
        // $a = fputcsv($fp, $header);
        // foreach ( $data as $line ) {
        //     $val = explode(",", $line);
        //     $a = fputcsv($fp, $val);
        // }

        // foreach ( $header as $line ) {
        //     $val = explode(",", $line);
        //     array_push($dataForFile,$val);
        //     // $a = fputcsv($fp, $val);
        // }


        // foreach ( $data as $line ) {
        //     $val = explode(",", $line);
        //     array_push($dataForFile,$val);
        // }
        // dd($dataForFile);

        $tes = Storage::disk('local')->put('test.csv', $cb);
        dd($tes);
        $client = new Client();
        try {
            $response = $client->post("https://demo.dataverse.org/api/datasets/{$accession}/add?persistentId={$persistentId}", [
            'headers' => [
                'X-Dataverse-key' => 'a0031e48-838e-4b4a-b375-a48c597745ba',
            ],
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => Psr7\Utils::tryFopen(getenv('FILENAME') ?? '', 'r')
                ],
                [
                    'name' => 'jsonData',
                    'contents' => '{"description":"My description.","directoryLabel":"data/subdir1","categories":["Data"], "restrict":"false"}'
                ]
            ]
            // 'body'=> Psr7\Utils::streamFor(preg_replace('!\s+!', ' ', $rawJson))
        ]);
        } catch (\Throwable $th) {
            $rawJson = "{
                \"status\": \"ERROR\",
                \"message\": \"Bioproject  {$parent} doesn't exist in dataverse. You must sync the Bioproject first!\"
            }";
            return json_decode($rawJson);
        }

        $jsonResponse = json_decode($response->getBody());
        // if ($jsonResponse->status == "OK") {
        //     $action = Bioarchive::where('accession', $accession)->update([
        //         'dv_published_at' => NOW(),
        //         'dv_persistent_id' => $jsonResponse->data->persistentId
        //     ]);
        //     if ($action) {
        //         ActionLog::create([
        //             'action' => "Sync Bioproject to Dataverse",
        //             'type' => 'Bioarchive',
        //             'item_id' => $accession,
        //             'created_by' => auth()->id()
        //         ]);
        //     }
        // }

        fclose($fp);
        return json_decode($response->getBody());
    }

    public function createDatasetSample(Request $request) {
        $accession = $request->accession;
        $biosample = Biosample::where('accession', $accession)->first();
        $biosample_links = $biosample->externallink()->get();
        $sample_attr = AttributeValue::where('biosample_id', $biosample->id)->get();
        $userData = $biosample->user()->first();
        $userDataJson = json_decode($userData->user_data);
        // dd($userDataJson);
        $affiliate = "{$userDataJson->pegawaiData->administrative_name} - {$userDataJson->pegawaiData->affiliate_name}";
        $description = "<p>This BioSample was automatically submitted from the <a href='https://inna.brin.go.id'>INNA Repository</a>. For more details about this BioSamples, please refer to the following link: <a href='https://inna.brin.go.id/biosamples/{$accession}'>https://inna.brin.go.id/biosamples/{$accession}</a></p>";
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
        // dd(preg_replace('!\s+!', ' ', $rawJson));
        $client = new Client();
        $response = $client->post('https://data.brin.go.id/api/dataverses/INNA/datasets', [
            'headers' => [
                'X-Dataverse-key' => 'a0031e48-838e-4b4a-b375-a48c597745ba',
            ],
            'body'=> Psr7\Utils::streamFor(preg_replace('!\s+!', ' ', $rawJson))
        ]);
        $jsonResponse = json_decode($response->getBody());
        if ($jsonResponse->status == "OK") {
            $action = Bioarchive::where('accession', $accession)->update([
                'dv_published_at' => NOW(),
                'dv_persistent_id' => $jsonResponse->data->persistentId
            ]);
            if ($action) {
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

    public function createDatasetArchive(Request $request) {
        $accession = $request->accession;
        $bioarchive = Bioarchive::where('accession', $accession)->first();
        $parent = $bioarchive->bioproject->accession;
        $bioexperiments = Bioexperiment::where('bioarchive_id', $bioarchive->id)->get();
        $bioruns = Biorun::where('bioexperiment_id', $bioexperiments[0]->id)->get();
        $userData = $bioarchive->user()->first();
        $userDataJson = json_decode($userData->user_data);
        $affiliate = "{$userDataJson->pegawaiData->administrative_name} - {$userDataJson->pegawaiData->affiliate_name}";
        $description = "<p>This BioArchive was automatically submitted from the <a href='https://inna.brin.go.id'>INNA Repository</a>. For more details about this BioArchive, please refer to the following link: <a href='https://inna.brin.go.id/bioarchives/{$accession}'>https://inna.brin.go.id/bioarchives/{$accession}</a></p>";
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
        try {
            $response = $client->post("https://data.brin.go.id/api/dataverses/{$parent}/datasets", [
            'headers' => [
                'X-Dataverse-key' => 'a0031e48-838e-4b4a-b375-a48c597745ba',
            ],
            'body'=> Psr7\Utils::streamFor(preg_replace('!\s+!', ' ', $rawJson))
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

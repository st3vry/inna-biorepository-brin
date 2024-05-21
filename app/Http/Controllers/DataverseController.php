<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Storage;

class DataverseController extends Controller
{
    public function createDataverse(Request $request) {

        $datas = '<dl>
            <dt>Accession Number</dt>
            <dd>INNAAR000002</dd>
            <dt>Bioproject Accession</dt>
            <dd>PRJ000004</dd>
            <dt>Biosample Accession</dt>
            <dd>SAM000006</dd>
            <dt>Alias</dt>
            <dd>INNAX-UsGvM8-1</dd>
            <dt>Title</dt>
            <dd>labseqbrin_wgskoleksi_2_1</dd>
            <dt>Library Name</dt>
            <dd>2023-10-18_BC20</dd>
            <dt>Library Source</dt>
            <dd>GENOMIC</dd>
            <dt>Library Selection</dt>
            <dd>other</dd>
            <dt>Library Strategy</dt>
            <dd>WGS</dd>
            <dt>Library Con Protocol</dt>
            <ddSQK.LSK-109></dd>
            <dt>Library Strategy</dt>
            <dd>WGS</dd>
            <dt>Instrument</dt>
            <dd>PromethION</dd>
            <dt>Library layout</dt>
            <dd>single</dd>
        </dl>';

        $rw = [
            'name' => 'INNAAR000002',
            'alias' => 'INNAAR000002',
            'dataverseContacts' => [
                'contactEmail' => 'inna.repository@brin.go.id',
                'contactEmail' => 'inna.repository@brin.go.id',
            ],
            'affiliation' => 'Badan Riset dan Inovasi Nasional',
            'description' => $datas,
            'dataverseType' => 'LABORATORY',
        ];

        $jsn = '
            {
                "name": "INNAAR000002",
                "alias": "INNAAR000002",
                "dataverseContacts": [
                    {
                    "contactEmail": "inna.repository@brin.go.id"
                    },
                    {
                    "contactEmail": "inna.repository@brin.go.id"
                    }
                ],
                "affiliation": "Badan Riset dan Inovasi Nasional",
                "description": "<dl><dt>Accession Number</dt><dd>INNAAR000002</dd><dt>Bioproject Accession</dt><dd>PRJ000004</dd><dt>Biosample Accession</dt><dd>SAM000006</dd><dt>Alias</dt><dd>INNAX-UsGvM8-1</dd><dt>Title</dt><dd>labseqbrin_wgskoleksi_2_1</dd><dt>Library Name</dt><dd>2023-10-18_BC20</dd><dt>Library Source</dt><dd>GENOMIC</dd><dt>Library Selection</dt><dd>other</dd><dt>Library Strategy</dt><dd>WGS</dd><dt>Library Con Protocol</dt><ddSQK.LSK-109></dd><dt>Library Strategy</dt><dd>WGS</dd><dt>Instrument</dt><dd>PromethION</dd><dt>Library layout</dt><dd>single</dd></dl>",
                "dataverseType": "LABORATORY"
            }
        ';
        $fp=fopen('../storage/app/dataverse-tes.json','r');
        $post = array('file_contents'=> $fp);
        // dd($fp);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://data.brin.go.id/api/dataverses/INNA');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_UPLOAD, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 86400); // 1 Day Timeout
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        // curl_setopt($ch, CURLOPT_INFILE, $fp);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-Dataverse-key: a0031e48-838e-4b4a-b375-a48c597745ba',
        ]);

        $response = curl_exec($ch);
        dd($response);

        // $jsn = `
        //     {
        //         "name": "INNAAR000002",
        //         "alias": "INNAAR000002",
        //         "dataverseContacts": [
        //             {
        //             "contactEmail": "inna.repository@brin.go.id"
        //             },
        //             {
        //             "contactEmail": "inna.repository@brin.go.id"
        //             }
        //         ],
        //         "affiliation": "Badan Riset dan Inovasi Nasional",
        //         "description": "<dl><dt>Accession Number</dt><dd>INNAAR000002</dd><dt>Bioproject Accession</dt><dd>PRJ000004</dd><dt>Biosample Accession</dt><dd>SAM000006</dd><dt>Alias</dt><dd>INNAX-UsGvM8-1</dd><dt>Title</dt><dd>labseqbrin_wgskoleksi_2_1</dd><dt>Library Name</dt><dd>2023-10-18_BC20</dd><dt>Library Source</dt><dd>GENOMIC</dd><dt>Library Selection</dt><dd>other</dd><dt>Library Strategy</dt><dd>WGS</dd><dt>Library Con Protocol</dt><ddSQK.LSK-109></dd><dt>Library Strategy</dt><dd>WGS</dd><dt>Instrument</dt><dd>PromethION</dd><dt>Library layout</dt><dd>single</dd></dl>",
        //         "dataverseType": "LABORATORY"
        //     }

        // `;

        // $datas = '<dl>
        //     <dt>Accession Number</dt>
        //     <dd>INNAAR000002</dd>
        //     <dt>Bioproject Accession</dt>
        //     <dd>PRJ000004</dd>
        //     <dt>Biosample Accession</dt>
        //     <dd>SAM000006</dd>
        //     <dt>Alias</dt>
        //     <dd>INNAX-UsGvM8-1</dd>
        //     <dt>Title</dt>
        //     <dd>labseqbrin_wgskoleksi_2_1</dd>
        //     <dt>Library Name</dt>
        //     <dd>2023-10-18_BC20</dd>
        //     <dt>Library Source</dt>
        //     <dd>GENOMIC</dd>
        //     <dt>Library Selection</dt>
        //     <dd>other</dd>
        //     <dt>Library Strategy</dt>
        //     <dd>WGS</dd>
        //     <dt>Library Con Protocol</dt>
        //     <ddSQK.LSK-109></dd>
        //     <dt>Library Strategy</dt>
        //     <dd>WGS</dd>
        //     <dt>Instrument</dt>
        //     <dd>PromethION</dd>
        //     <dt>Library layout</dt>
        //     <dd>single</dd>
        // </dl>';

        // $response = Http::withHeaders([
        //     'X-Dataverse-key' => env('DATAVERSE_TOKEN')
        // ])->attach(
        //     'attachment', $jsn, 'dataverse_tes.json', ['Content-Type' => 'application/json']
        // )
        // ->post('https://data.brin.go.id/api/dataverses/INNA', [

        //     'name' => 'INNAAR000002',
        //     'alias' => 'INNAAR000002',
        //     'dataverseContacts' => [
        //         'contactEmail' => 'inna.repository@brin.go.id',
        //         'contactEmail' => 'inna.repository@brin.go.id',
        //     ],
        //     'affiliation' => 'Badan Riset dan Inovasi Nasional',
        //     'description' => $datas,
        //     'dataverseType' => 'LABORATORY',
        // ]);
        // dd($response);
    }
}

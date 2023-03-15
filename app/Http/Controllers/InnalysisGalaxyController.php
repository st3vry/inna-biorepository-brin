<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InnalysisGalaxyController extends Controller
{
    //
    public function index()
    {
        $response = Http::get('http://202.46.7.138:8081/workflows');
        $workflows = json_decode($response);
        // dd($workflows);
        // return $response->json();
        return view('dashboard.innalysis.galaxy', [
            'workflows' => $workflows
        ]);
    }
}

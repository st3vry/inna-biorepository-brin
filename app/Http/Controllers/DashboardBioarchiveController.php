<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardBioarchiveController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.bioarchive.index', []);
    }

    public function create()
    {
        return view('dashboard.bioarchive.create');
    }
}

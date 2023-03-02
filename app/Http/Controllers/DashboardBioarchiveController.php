<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bioarchive;
use Illuminate\Http\Request;

class DashboardBioarchiveController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.bioarchive.index', [
            'bioarchives' => Bioarchive::with(['bioproject', 'user'])->where('user_id', auth()->user()->id)->orderBy('published_at', 'desc')->orderBy('draft', 'desc')->paginate(5),
        ]);
    }

    public function create()
    {
        return view('dashboard.bioarchive.create');
    }
}

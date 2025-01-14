<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PermissionRequest;

class DashboardMyRequestController extends Controller
{
    public function index()
    {
        $requests = PermissionRequest::where('user_id', auth()->user()->id)->orderBy('id')->get();
        // dd($requests->path);
        return view('dashboard.bioarchive.myrequest', [
            'requests' =>  $requests
        ]);
    }
}

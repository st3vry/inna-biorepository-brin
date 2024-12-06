<?php

namespace App\Http\Controllers;

use App\Models\Bioarchive;
use App\Models\PermissionRequest;
use Illuminate\Http\Request;

class PermissionApprovalController extends Controller
{
    public function index()
    {
        $permissionReq = PermissionRequest::where('is_approved', FALSE)->get();
        // dd($permissionReq);
        return view('dashboard.disemofficer.index', [
            'permissionReqs' => $permissionReq,
        ]);
    }
}

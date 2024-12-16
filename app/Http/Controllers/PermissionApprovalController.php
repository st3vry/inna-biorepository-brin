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

    public function show($id)
    {
        // dd($id);
        $permissionrequest = PermissionRequest::where('bioarchive_accession', $id)->first();
        // dd($permissionrequest);
        return view('dashboard.disemofficer.show', [
            'permissionRequest' => $permissionrequest,
        ]);
        // $permissionReq=PermissionRequest
    }

    public function proof($filename)
    {
        $filePath = storage_path("app/public/proofs/{$filename}");
        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        abort(404, 'File not found');
    }
    public function agreement($filename)
    {
        $filePath = storage_path("app/public/agreements/{$filename}");
        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        abort(404, 'File not found');
    }
    public function proposal($filename)
    {
        $filePath = storage_path("app/public/proposals/{$filename}");
        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        abort(404, 'File not found');
    }
    public function cv($filename)
    {
        $filePath = storage_path("app/public/cvs/{$filename}");
        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        abort(404, 'File not found');
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $permissionRequest = PermissionRequest::findOrFail($id);

        if ($request->action === 'approve') {
            $permissionRequest->update([
                'is_approved' => true,
                'is_declined' => false,
                'updated_at' => now(),
            ]);
            return redirect()->route('permission-approval.index')->with('success', 'Permission request ' . $permissionRequest->bioarchive_accession . ' approved successfully.');
        } elseif ($request->action === 'decline') {
            $permissionRequest->update([
                'is_approved' => false,
                'is_declined' => true,
                'updated_at' => now(),
            ]);
            return redirect()->route('permission-approval.index')->with('success', 'Permission request ' . $permissionRequest->bioarchive_accession . ' declined successfully.');
        }

        return redirect()->route('permission-approval.index')->withErrors(['Invalid action.']);
    }
}

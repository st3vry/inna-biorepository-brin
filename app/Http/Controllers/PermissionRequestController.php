<?php

namespace App\Http\Controllers;

use App\Models\Bioarchive;
use App\Models\PermissionRequest;
use Illuminate\Http\Request;

class PermissionRequestController extends Controller
{
    //
    public function showForm($bioarchive_id)
    {
        // dd($bioarchive_id);
        $bioarchive = BioArchive::where('id', $bioarchive_id)->first();
        $_name = auth()->user()->name;
        $user_name = auth()->user()->username;
        $email = auth()->user()->email;
        $user_int_id = auth()->user()->id;
        // dd(auth()->user() - id);

        return view('frontend.permissionrequest', [
            'title' => 'Bioarchive',
            'bioarchive_id' => $bioarchive_id,
            'bioarchive_accession' => $bioarchive->accession,
            'user_id' => $user_int_id,
            '_name' => $_name,
            'username' => $user_name,
            'email' => $email
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        // Dynamically get base URL from the app config
        $baseUrl = config('app.url');
        // dd($baseUrl);

        // Validate and store the request logic (if needed)
        $request->validate([
            'reason' => 'required',
            'is_agreed' => 'required|accepted',
        ]);

        // Save the permission request with the generated temporary URL
        PermissionRequest::create([
            'user_id' => auth()->id(),
            'request_reason' => $request->reason,
            'temporary_url' => "http://testing",  // Use the generated temporary URL
            'is_agreed' => $request->is_agreed,
        ]);

        // Store the permission request logic (optional)
        // Redirect back with a success message
        return redirect("{$baseUrl}/bioarchives/{$request->bioarchive_accession}")->with('success', 'Permission request submitted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Bioarchive;
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
            'accession' => $bioarchive->accession,
            'user_id' => $user_int_id,
            '_name' => $_name,
            'username' => $user_name,
            'email' => $email
        ]);
    }

    public function store(Request $request)
    {
        dd($request);
        // Validate and store the request logic (if needed)
        // $request->validate([
        //     'username' => 'required',
        //     'email' => 'required|email',
        //     'permission' => 'required',
        //     'reason' => 'required',
        // ]);

        // Store the permission request logic (optional)
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Permission request submitted successfully.');
    }
}

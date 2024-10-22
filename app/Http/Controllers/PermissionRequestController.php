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
        $record = BioArchive::where('id', $bioarchive_id)->first();


        return view('frontend.permissionrequest', [
            'title' => 'Bioarchive',
            'bioarchive' => $bioarchive_id,
            'accession' => $record->accession,
            // 'centers' => $centers,
            // 'biosamples' => $biosamples,
            // 'bioprojects' => $biorpoject,
        ]);
    }

    public function store(Request $request)
    {
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

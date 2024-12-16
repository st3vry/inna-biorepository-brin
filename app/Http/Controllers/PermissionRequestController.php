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
            // 'reason' => 'required',
            // 'is_agreed' => 'required|accepted',
            'user_id' => 'required|integer',
            'bioarchive_id' => 'required|integer',
            'bioarchive_accession' => 'required|string|max:255',
            'reason' => 'required|string|max:1000',
            'research_area' => 'required|string|max:255',
            'research_title' => 'required|string|max:255',
            'abstract' => 'required|string|max:2000',
            'proof_of_funding' => 'required|file|mimes:pdf',
            'letter_of_agreement' => 'required|file|mimes:pdf',
            'research_proposal' => 'required|file|mimes:pdf',
            'cv' => 'required|file|mimes:pdf',
            'is_agreed' => 'required|boolean',
        ]);

        // Process file uploads
        $validatedData['proof_of_funding'] = $request->file('proof_of_funding')->store('proofs', 'public');
        $validatedData['letter_of_agreement'] = $request->file('letter_of_agreement')->store('agreements', 'public');
        $validatedData['research_proposal'] = $request->file('research_proposal')->store('proposals', 'public');
        $validatedData['cv'] = $request->file('cv')->store('cvs', 'public');
        $validatedData['bioarchive_id'] = $request->bioarchive_id;
        $validatedData['bioarchive_accession'] = $request->bioarchive_accession;
        $validatedData['reason'] = $request->reason;
        $validatedData['research_area'] = $request->research_area;
        $validatedData['research_title'] = $request->research_title;
        $validatedData['abstract'] = $request->abstract;
        $validatedData['is_agreed'] = $request->is_agreed;
        // Save the permission request with the generated temporary URL
        // PermissionRequest::create([
        //     'user_id' => auth()->id(),
        //     'request_reason' => $request->reason,
        //     'temporary_url' => "http://testing",  // Use the generated temporary URL
        //     'is_agreed' => $request->is_agreed,
        // ]);
        // Save the validated data into the database (example)
        $permissionRequest = new \App\Models\PermissionRequest(); // Make sure this model exists
        $permissionRequest->user_id = auth()->id();
        $permissionRequest->bioarchive_id = $validatedData['bioarchive_id'];
        $permissionRequest->bioarchive_accession = $validatedData['bioarchive_accession'];
        $permissionRequest->reason = $validatedData['reason'];
        $permissionRequest->research_area = $validatedData['research_area'];
        $permissionRequest->research_title = $validatedData['research_title'];
        $permissionRequest->abstract = $validatedData['abstract'];
        $permissionRequest->proof_of_funding = $validatedData['proof_of_funding'];
        $permissionRequest->letter_of_agreement = $validatedData['letter_of_agreement'];
        $permissionRequest->research_proposal = $validatedData['research_proposal'];
        $permissionRequest->cv = $validatedData['cv'];
        $permissionRequest->is_agreed = $validatedData['is_agreed'];
        $permissionRequest->save();

        // Store the permission request logic (optional)
        // Redirect back with a success message
        return redirect("{$baseUrl}/bioarchives/{$request->bioarchive_accession}")->with('success', 'Permission request submitted successfully.');
    }

    public function download($id)
    {
        // Find the bioarchive entry
        $bioarchive = PermissionRequest::findOrFail($id);
        $rootfolder = env('DOWNLOAD_PATH');
        $rndfolder = $bioarchive->path;
        // Check if the permission is granted
        if (!$bioarchive->permissionRequest || !$bioarchive->permissionRequest->is_agreed) {
            abort(403, 'You are not authorized to download this file.');
        }

        // Define the file path (adjust based on your storage setup)
        // $filePath = storage_path("app/public/bioarchives/{$bioarchive->file_name}");
        $folderpath = $rootfolder . '/' . $rndfolder;


        // Ensure the file exists before downloading
        // if (!file_exists($filePath)) {
        // abort(404, 'File not found.');
        // }

        return response()->download($folderpath);
    }
}

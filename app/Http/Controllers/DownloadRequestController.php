<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadRequestController extends Controller
{
    //
    public function handleButtonClick(Request $request)
    {
        // Redirect to the Permission Request Form when the button is clicked
        
        $bioarchive_id = $request->input('bioarchive_id');
        // dd($bioarchive_id);
        return redirect()->route('permission.request.form', ['bioarchive_id' => $bioarchive_id]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\AuthSso;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LoginSsoController extends Controller
{
    //
    public function index(Request $request)
    {
        $token = session('is_login_baladeva');
        $allSessions = session()->all();
        //dd($token);
        if (Cache::has($token)) {
            //dd('masuk ke cace');
            $Auth = Cache::get($token)->userData;
            return redirect(route('admin.dashboard'));
        } else {
            $SSO = new AuthSso();
            $data = $SSO->authorize($request);
            $response = null;
            $accessToken = null;
            // dd($data);

            if (is_array($data) && $data['success'] == 1) {
                $token = $SSO->loginsso($request, $response, $accessToken);
                // dd('gak ada return sukses');
                return redirect(route('admin.dashboard'));
            } else {
                dd('Redirek');
                // return Redirect::to($data);
            }
        }
    }
}

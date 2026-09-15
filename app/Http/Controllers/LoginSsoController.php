<?php

namespace App\Http\Controllers;

use App\Services\SsoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;


class LoginSsoController extends Controller
{
    //
    public function __construct()
    {
    }
    public function index()
    {
        return redirect(route('loginsso'));
    }
    public function sso(Request $request)
    {
        $token = session('is_login_inna_repo');
        if (Cache::has($token)) {
            $Auth = Cache::get($token);
            return redirect()->action([DashboardIndexController::class, 'index']);
        } else {
            $ssoService = new SsoService;
            $data = $ssoService->authorize($request);
            if (is_array($data) && $data['success'] == 1) {
                
                $token = $ssoService->loginsso($request);
                return 'Langsung Masuk Karena masih ada Token';
            } else {
                return Redirect::to($data);
            }
        }
    }
}

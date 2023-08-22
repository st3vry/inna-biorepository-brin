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
        // return view('login.index', [
        //     'title' => 'Login'
        // ]);
        return redirect(route('loginsso'));
    }
    // public function authenticate(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_activated' => true])) {
    //         $request->session()->regenerate();
    //         return redirect()->intended('/dashboard');
    //     }

    //     return back()->with('loginError', 'Login Failed');
    //     // dd('berhasil loginhttps://dev-sso.brin.go.id/dashpproval_prompt=auto&redirect_uri=http%3A%2F%2Finna-biorepository.test%2Flogin%2Fsso&client_id=demo');
    // }
    // public function logout()
    // {
    //     Auth::logout();
    //     request()->session()->invalidate();
    //     request()->session()->regenerateToken();
    //     return redirect('/');
    // }
    // 0f9ddf78222ab1870cc91890c68112c5dddfb86e
    // Kodingan Farham
    public function sso(Request $request)
    {
        // dd($request);
        $token = session('is_login_inna_repo');
        // dd($token);
        if (Cache::has($token)) {
            $Auth = Cache::get($token);
            // dd($Auth);
            // return $Auth;
            return redirect()->action([DashboardIndexController::class, 'index']);
        } else {
            $ssoService = new SsoService;
            $data = $ssoService->authorize($request);
            
            if (is_array($data) && $data['success'] == 1) {
                // dd($token);
                $token = $ssoService->loginsso($request);
                // dd($token);
                // return 'Langsung Masuk Karena masih ada Token';
                return redirect()->action([DashboardIndexController::class, 'index']);
            } else {
                // dd('Redirek');
                // dd($data);
                return Redirect::to($data);
            }
        }
    }
}

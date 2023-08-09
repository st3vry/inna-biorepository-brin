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
    private $ssoService;
    public function __construct()
    {
    }
    public function index()
    {
        return view('login.index', [
            'title' => 'Login'
        ]);
        // return redirect(route('loginsso'));
    }
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_activated' => true])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Failed');
        // dd('berhasil login');
    }
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
    // Kodingan Farham
    public function sso(Request $request)
    {
        $token = session('is_login_inna_repo');
        $allSessions = session()->all();

        if (Cache::has($token)) {

            $Auth = Cache::get($token);

            return $Auth;
        } else {
            $ssoService = new SsoService;
            $data = $ssoService->authorize($request);

            if (is_array($data) && $data['success'] == 1) {
                $token = $ssoService->loginsso($request);

                return 'Langsung Masuk Karena masih ada Token';
            } else {
                //dd('Redirek');
                return Redirect::to($data);
            }
        }
    }
}

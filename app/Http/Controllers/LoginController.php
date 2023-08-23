<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\SsoServices\AuthSso;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login.index', [
            'title' => 'Login'
        ]);
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
        //@gelar
        Session::flush();
        //End @gelar
        return redirect('/');
    }
}

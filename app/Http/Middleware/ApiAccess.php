<?php

namespace App\Http\Middleware;

use App\Services\SsoService;

use Closure;

class ApiAccess
{
    public function handle($request, Closure $next)
    {
        // if (!$request->session()->exists('brin_sso_access_token')) {
        //     // return response()->json('You do not have access!!');
        //     return redirect('/login/sso');
        // }
        $session = session()->all();
        // dd($session['is_login_inna_repo']);
        if (isset($session['is_login_inna_repo'])) {
            return $next($request);
        }
        // @gelar
        return redirect('/');
        // END @gelar
    }
}

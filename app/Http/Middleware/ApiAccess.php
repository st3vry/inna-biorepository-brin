<?php

namespace App\Http\Middleware;

use App\Services\SsoService;

use Closure;

class ApiAccess
{
    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('brin_sso_access_token')) {
            // return response()->json('You do not have access!!');
            return redirect('/login/sso');
        }

        return $next($request);
    }
}

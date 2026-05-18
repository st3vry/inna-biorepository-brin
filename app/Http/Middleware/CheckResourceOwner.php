<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class CheckResourceOwner
{
    /**
     * Handle an incoming request.
     *
     * Check if the authenticated user owns the resource or is an admin (role 0).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the first route model binding (typically the resource)
        $resource = null;
        foreach ($request->route()->parameters() as $param) {
            if ($param instanceof Model) {
                $resource = $param;
                break;
            }
        }

        // If no model binding found, allow (shouldn't happen for resource routes)
        if (!$resource) {
            return $next($request);
        }

        // Check: user owns resource OR user is admin (role 0)
        $isOwner = $resource->user_id === auth()->id();
        $isAdmin = auth()->user() && auth()->user()->role_id === 0;

        if (!$isOwner && !$isAdmin) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}

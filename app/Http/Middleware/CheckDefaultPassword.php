<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckDefaultPassword
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->is_default_password) {
            if (!$request->is('setup-account*')) {
                return redirect()->route('setup.account');
            }
        } 
        return $next($request);
    }
}



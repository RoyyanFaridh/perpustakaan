<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureEmailVerified
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && !$user->hasVerifiedEmail()) {
            if (!$request->is('setup-account*')) {
                return redirect()->route('setup.account');
            }
        }

        return $next($request);
    }
}


<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureEmailVerified
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if ($user && !$user->hasVerifiedEmail()) {
            return redirect()->route('setup.verify-email');
        }

        return $next($request);
    }
}


<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckDefaultPassword
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('CheckDefaultPassword middleware running for user: ' . optional(Auth::user())->id);
        $user = Auth::user();

        if ($user && $user->is_default_password && !$request->routeIs('password.change.form')) {
            return redirect()->route('password.change.form');
        }

        return $next($request);
    }
}

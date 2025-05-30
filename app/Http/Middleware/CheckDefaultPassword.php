<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckDefaultPassword
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->is_default_password) {
            $route = $request->route();

            if ($user->role === 'admin' && !$route->named('admin.profile')) {
                return redirect()->route('admin.profile');
            }

            if (in_array($user->role, ['siswa', 'guru']) && !$route->named('user.profile')) {
                return redirect()->route('user.profile');
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureAnggotaEmailIsFilled
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->role !== 'admin' && empty($user->anggota->email)) {
            if (!$request->routeIs('user.profile')) {
                return redirect()->route('user.profile')->with('force_fill_email', true);
            }
        }
        return $next($request);
    }



}

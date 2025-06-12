<?php

namespace App\Http\Middleware;

use Closure;

class CheckDefaultPassword
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        // Jika user punya anggota, dan plain_password-nya masih ada (belum diganti)
        if ($user && $user->anggota && !empty($user->anggota->plain_password)) {
            return redirect()->route('setup.password');
        }

        return $next($request);
    }
}

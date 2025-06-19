<?php

namespace App\Http\Middleware;

use Closure;

class CheckDefaultPassword
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user()->loadMissing('anggota');

        if (!$user->anggota) {
            \Log::warning('User tanpa anggota: '.$user->id);
            return redirect()->route('setup.password');
        }

        if ($user->anggota->plain_password !== null && $user->anggota->plain_password !== '') {
            return redirect()->route('setup.password');
        }

        return $next($request);

    }
}

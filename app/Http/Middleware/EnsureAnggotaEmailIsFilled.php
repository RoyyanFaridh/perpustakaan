<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAnggotaEmailIsFilled
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Jika user login dan belum isi email di tabel members
        if ($user && optional($user->anggota)->email === null) {
            session(['show_email_modal' => true]);
        }

        return $next($request);
    }
}


<?php

namespace App\Livewire\Forms;

use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|string')]
    public string $nis_nip = '';

    #[Validate('required|string|min:8')]
    public string $password = ''; // Menambahkan validasi panjang minimal password (misalnya 8 karakter).

    #[Validate('boolean')]
    public bool $remember = false; // Menandakan apakah user ingin mengingat sesi login.

    /**
     * Mencoba untuk melakukan autentikasi menggunakan kredensial yang diberikan.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Cari user berdasarkan nis_nip
        $user = \App\Models\User::where('nis_nip', $this->nis_nip)->first();

        // Kalau user tidak ditemukan atau password salah, hit rate limiter dan throw error
        if (!$user || !\Illuminate\Support\Facades\Hash::check($this->password, $user->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'form.nis_nip' => trans('auth.failed'),
            ]);
        }

        // Login user
        Auth::login($user, $this->remember);

        RateLimiter::clear($this->throttleKey());

        // Cek apakah user menggunakan password default
        if ($user->is_default_password) {
            redirect()->route('password.change.form');
            return;
        }
        if ($user->hasRole('admin')) {
            redirect()->route('admin.dashboard');
        } else {
            redirect()->route('user.dashboard');
        }


    }

    /**
     * Memastikan bahwa request autentikasi tidak dibatasi oleh rate limiting.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return; // Jika tidak terlalu banyak percobaan, lanjutkan.
        }

        // Jika sudah terlalu banyak percobaan, lakukan event lockout dan lempar error.
        event(new Lockout(request()));

        // Dapatkan waktu sisa sebelum percobaan berikutnya diperbolehkan.
        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.nis_nip' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60), // Menampilkan waktu dalam menit jika perlu.
            ]),
        ]);
    }

    /**
     * Mendapatkan kunci throttle rate limit untuk autentikasi.
     */
    protected function throttleKey(): string
    {
        // Menggabungkan email dan IP pengguna untuk menghasilkan throttle key yang unik.
        return Str::transliterate(Str::lower($this->nis_nip).'|'.request()->ip());
    }
}

<?php

namespace App\Livewire\Forms;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|string|email')]
    public string $email = ''; // Validasi email dengan format yang benar.

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
        // Pastikan request tidak dibatasi berdasarkan rate limit.
        $this->ensureIsNotRateLimited();

        // Mencoba autentikasi dengan email dan password yang diberikan.
        if (! Auth::attempt($this->only(['email', 'password']), $this->remember)) {
            // Jika autentikasi gagal, tingkatkan rate limit dan lempar error.
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'form.email' => trans('auth.failed'), // Pesan error jika kredensial salah.
            ]);
        }

        // Jika login berhasil, bersihkan rate limit.
        RateLimiter::clear($this->throttleKey());
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
            'form.email' => trans('auth.throttle', [
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
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}

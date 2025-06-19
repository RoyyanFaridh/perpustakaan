<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Form;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;


class LoginForm extends Form
{
    #[Validate('required|string')]
    public string $nis_nip = '';

    #[Validate('required|string|min:8')]
    public string $password = '';

    #[Validate('boolean')]
    public bool $remember = false;

    /**
     * Authenticate the user.
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        $user = User::where('nis_nip', $this->nis_nip)->first();

        if (! $user || ! Hash::check($this->password, $user->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                // Ubah jadi error umum (bukan per field)
                'form.email' => trans('auth.failed'),
            ]);
        }

        Auth::login($user, $this->remember);

        RateLimiter::clear($this->throttleKey());

        // Jika user masih pakai password default, arahkan ke halaman setup password
        if ($user->is_default_password) {
            return redirect()->route('setup.password');
        }

        // Redirect sesuai peran
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    /**
     * Cek apakah user terlalu sering gagal login.
     */
    protected function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Generate key throttle berdasarkan NIS/NIP dan IP.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->nis_nip) . '|' . request()->ip());
    }
}

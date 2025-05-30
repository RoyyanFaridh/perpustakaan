<?php
namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
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

    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        $user = \App\Models\User::where('nis_nip', $this->nis_nip)->first();

        if (!$user || !\Illuminate\Support\Facades\Hash::check($this->password, $user->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'form.nis_nip' => trans('auth.failed'),
            ]);
        }

        Auth::login($user, $this->remember);

        RateLimiter::clear($this->throttleKey());

        if ($user->is_default_password) {
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.profile');
            }
            return redirect()->route('user.profile');
        }

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }

    protected function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.nis_nip' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->nis_nip).'|'.request()->ip());
    }
}

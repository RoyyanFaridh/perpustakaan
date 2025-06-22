<?php

namespace App\Livewire\User\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UpdatePasswordForm extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the authenticated user's password.
     */
    public function updatePassword(): void
    {
        $this->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = Auth::user();

        if (!$user) {
            abort(403, 'User not authenticated');
        }

        $user->update([
            'password' => Hash::make($this->password),
        ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);

        // Dispatch event to show success message
        $this->dispatch('password-updated');
        $this->dispatch('notify', message: 'Password berhasil diperbarui');
    }

    /**
     * Render the password update form view.
     */
    public function render()
    {
        return view('livewire.user.profile.update-password-form');
    }
}

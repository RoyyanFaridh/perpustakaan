<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

#[Layout('layouts.guest')]
class ChangePasswordForm extends Component
{
    public $password;
    public $password_confirmation;

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->password = Hash::make($this->password);
        $user->is_default_password = false;
        $user->save();

        session()->flash('success', 'Password berhasil diubah!');

        return $user->hasRole('admin')
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }

    public function render()
    {
        return view('livewire.pages.auth.change-password-form');
    }
}

<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Password;

class Profile extends Component
{
    public $email;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->email = $user->email ?? '';
    }

    public function render()
    {
        return view('livewire.user.profile');
    }

    public function updateProfile()
    {
        $user = Auth::user();

        $this->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'new_password' => 'nullable|min:6|same:new_password_confirmation',
        ]);

        if ($user->email !== $this->email) {
            $user->email = $this->email;
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }

        if ($this->new_password) {
            $user->password = Hash::make($this->new_password);
            $user->is_default_password = false;
        }

        $user->save();

        if ($user->anggota) {
            $user->anggota->email = $this->email;
            $user->anggota->save();
        }

        session()->flash('message', 'Email & password berhasil diperbarui. Silakan cek email untuk verifikasi.');
        $this->new_password = '';
        $this->new_password_confirmation = '';
    }

}

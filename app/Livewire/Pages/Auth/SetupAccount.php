<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SetupAccount extends Component
{
    public $email;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->email = $user->email;
    }

    public function updatedEmail()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);
    }

    public function resendVerificationEmail()
    {
        $user = Auth::user();

        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            session()->flash('message', 'Verification email resent!');
        }
    }

    public function updateAccount()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->is_default_password = false;
        $user->save();

        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            sleep(1); // beri waktu email terkirim sebelum logout
        }


        // Tambahkan delay sedikit agar pengiriman email sempat diproses
        usleep(500000); // 0.5 detik

        // Logout setelahnya
        Auth::logout();

        return redirect()->route('login')->with('message', 'Account updated. Please verify your email and login again.');
    }



    public function render()
    {
        return view('livewire.pages.auth.setup-account')->layout('layouts.guest');
    }
}

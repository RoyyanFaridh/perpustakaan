<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SetupEmailVerify extends Component
{
    public $email;
    public $message = '';

    public function mount()
    {
        $this->email = Auth::user()->email;
    }

    public function resendVerificationEmail()
    {
        $user = Auth::user();

        // Cek kalau email tidak berubah dan sudah verified
        if ($user->email === $this->email && $user->hasVerifiedEmail()) {
            $this->message = 'Email sudah diverifikasi dan tidak perlu dikirim ulang.';
            return;
        }

        $this->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        // Jika email berubah, reset status verifikasi
        if ($user->email !== $this->email) {
            $user->email = $this->email;
            $user->email_verified_at = null;
            $user->save();
        }

        // Kirim ulang email verifikasi jika belum terverifikasi
        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            $this->message = 'Link verifikasi telah dikirim ulang ke email Anda.';
        } else {
            $this->message = 'Email sudah diverifikasi.';
        }
    }


    public function render()
    {
        return view('livewire.pages.auth.setup-email-verify')->layout('layouts.guest');
    }
}

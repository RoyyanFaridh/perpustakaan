<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public $email;

    public function mount()
    {
        $this->email = Auth::user()->anggota->email ?? '';
    }

    public function render()
    {
        return view('livewire.user.profile');
    }

    public function updateEmail()
    {
        $user = Auth::user();
        if ($user && $user->anggota) {
            $user->anggota->email = $this->email;
            $user->anggota->save();
            session()->flash('message', 'Email berhasil diperbarui');
        }
    }
}

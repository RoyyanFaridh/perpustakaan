<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\RegisterForm;
use Livewire\Component;

class Register extends Component
{
    public RegisterForm $form;
    
    public function render()
    {
        return view('livewire.pages.auth.register')
            ->layout('layouts.guest');
    }
    
    public function register()
    {
        $this->form->register();
        
        session()->flash('status', 'Registrasi berhasil! Silakan login.');
        
        return redirect()->route('login');
    }
}
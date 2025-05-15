<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterForm extends Form
{
    public string $name = '';
    public string $nis_nip = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $no_telp = '';
    public string $role = 'siswa';

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'nis_nip' => ['required', 'string', 'max:20', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
            'no_telp' => ['required', 'string', 'max:15'],
            'role' => ['required', 'in:siswa,guru'],
        ];
    }

    public function register(): void
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'nis_nip' => $this->nis_nip,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'no_telp' => $this->no_telp,
            'role' => $this->role,
        ]);

        $user->assignRole($this->role);
    }
}
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun Admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin_perpustakaan@smp12yk.sch.id',
            'password' => Hash::make('akuAdminKeren_13579'), // Ganti password aman
            'role' => 'admin',
        ]);
    }
}

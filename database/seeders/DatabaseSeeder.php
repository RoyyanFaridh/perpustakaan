<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'guru']);
        Role::firstOrCreate(['name' => 'siswa']);

        // Admin
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin_perpustakaan@smp12yk.sch.id',
            'password' => Hash::make('akuAdminKeren_13579'),
        ]);
        $admin->assignRole('admin');

        // Guru
        $guru = User::factory()->create([
            'name' => 'Guru Contoh',
            'email' => 'guru@example.com',
            'password' => Hash::make('guruPassword123'),
        ]);
        $guru->assignRole('guru');

        // Siswa
        $siswa = User::factory()->create([
            'name' => 'Siswa Contoh',
            'email' => 'siswa@example.com',
            'password' => Hash::make('siswaPassword123'),
        ]);
        $siswa->assignRole('siswa');
    }
}

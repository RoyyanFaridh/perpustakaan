<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Menghapus role yang sudah ada (agar tidak terjadi duplikasi)
        Role::findOrCreate('admin');
        Role::findOrCreate('guru');
        Role::findOrCreate('siswa');

        // Membuat permissions
        Permission::findOrCreate('manage users');
        Permission::findOrCreate('manage books');
        
        // Menetapkan permissions ke role
        $admin = Role::findByName('admin');
        $admin->givePermissionTo('manage users', 'manage books');

        $guru = Role::findByName('guru');
        $guru->givePermissionTo('manage books');

        $siswa = Role::findByName('siswa');
    }
}



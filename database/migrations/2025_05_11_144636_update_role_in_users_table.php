<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Rename tabel users → simpan data dulu
        DB::statement("ALTER TABLE users RENAME TO users_old");

        // Buat ulang tabel users dengan constraint role baru
        DB::statement("
            CREATE TABLE users (
                id integer primary key autoincrement,
                name varchar(255) not null,
                email varchar(255) not null,
                email_verified_at datetime null,
                password varchar(255) not null,
                remember_token varchar(100) null,
                role varchar(255) check( role in ('admin','guru','siswa') ) null,
                phone varchar(255) null,
                created_at datetime null,
                updated_at datetime null
            )
        ");

        // Pindahkan data lama
        DB::statement("
            INSERT INTO users (id, name, email, email_verified_at, password, remember_token, role, phone, created_at, updated_at)
            SELECT id, name, email, email_verified_at, password, remember_token, role, phone, created_at, updated_at
            FROM users_old
        ");

        // Hapus tabel lama
        DB::statement("DROP TABLE users_old");
    }

    public function down(): void
    {
        // Ga perlu rollback (optional)
    }
};

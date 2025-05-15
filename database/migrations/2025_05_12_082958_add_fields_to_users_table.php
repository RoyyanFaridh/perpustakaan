<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop semua kolom kecuali id
            if (Schema::hasColumn('users', 'name')) $table->dropColumn('name');
            if (Schema::hasColumn('users', 'nis_nip')) $table->dropColumn('nis_nip');
            if (Schema::hasColumn('users', 'email')) $table->dropColumn('email');
            if (Schema::hasColumn('users', 'email_verified_at')) $table->dropColumn('email_verified_at');
            if (Schema::hasColumn('users', 'password')) $table->dropColumn('password');
            if (Schema::hasColumn('users', 'remember_token')) $table->dropColumn('remember_token');
            if (Schema::hasColumn('users', 'no_telp')) $table->dropColumn('no_telp');
            if (Schema::hasColumn('users', 'role')) $table->dropColumn('role');
            if (Schema::hasColumn('users', 'created_at')) $table->dropColumn('created_at');
            if (Schema::hasColumn('users', 'updated_at')) $table->dropColumn('updated_at');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->default('')->after('id');
            $table->string('nis_nip')->default('')->after('name');
            $table->string('email')->default('')->after('nis_nip');
            $table->timestamp('email_verified_at')->nullable()->after('email');
            $table->string('password')->default('')->after('email_verified_at');
            $table->string('no_telp')->default('')->after('password');
            $table->enum('role', ['siswa', 'guru'])->default('siswa')->after('no_telp');
            $table->rememberToken()->after('role');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'nis_nip',
                'email',
                'email_verified_at',
                'password',
                'no_telp',
                'role',
                'remember_token',
                'created_at',
                'updated_at',
            ]);
        });
    }
};

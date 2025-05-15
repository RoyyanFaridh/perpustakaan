<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'nis_nip')) {
                $table->string('nis_nip')->nullable()->after('name');
            }

            if (!Schema::hasColumn('users', 'email')) {
                $table->string('email')->nullable()->after('nis_nip');
            }

            // Email verified at biar aman kalau pakai fitur verifikasi
            if (!Schema::hasColumn('users', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable()->after('email');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'nis_nip')) {
                $table->dropColumn('nis_nip');
            }

            if (Schema::hasColumn('users', 'email')) {
                $table->dropColumn('email');
            }

            if (Schema::hasColumn('users', 'email_verified_at')) {
                $table->dropColumn('email_verified_at');
            }
        });
    }
};

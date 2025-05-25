<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('status')->default('active'); // 'active' or 'inactive'
            $table->string('nis_nip', 20)->unique();
            $table->string('kelas', 1); // '7', '8', or '9'
            $table->string('jenis_kelamin', 1); // 'L' or 'P'
            $table->string('alamat', 255);
            $table->string('no_telp', 20);
            $table->string('email', 255)->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};


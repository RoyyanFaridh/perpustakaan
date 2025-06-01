<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori');
            $table->string('penulis')->nullable();
            $table->string('penerbit')->nullable();

            // Jika kamu pakai database selain SQLite, bisa pakai year
            // Tapi kalau SQLite error, bisa diganti jadi string:
            // $table->string('tahun_terbit', 4)->nullable();
            $table->year('tahun_terbit')->nullable();

            $table->string('isbn')->nullable()->unique();
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah_stok')->default(0);
            $table->string('lokasi_rak')->nullable();
            $table->string('cover')->nullable(); // path ke file cover
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};

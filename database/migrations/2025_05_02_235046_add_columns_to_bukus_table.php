<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->string('cover')->nullable(); // Kolom untuk cover buku
            $table->string('kategori')->nullable(); // Kolom untuk kategori
            $table->string('penulis')->nullable(); // Kolom untuk penulis
            $table->string('penerbit')->nullable(); // Kolom untuk penerbit
            $table->year('tahun_terbit')->nullable(); // Kolom untuk tahun terbit
            $table->string('isbn')->nullable(); // Kolom untuk ISBN
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->dropColumn(['cover', 'kategori', 'penulis', 'penerbit', 'tahun_terbit', 'isbn']);
        });
    }
};


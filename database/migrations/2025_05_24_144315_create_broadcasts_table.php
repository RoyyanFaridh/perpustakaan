<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void
    {
        Schema::create('broadcasts', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('broadcasts');
    }
};


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Jika tetap pakai nama tabel 'bukus', tambahkan baris ini:
    protected $table = 'bukus';

    // Kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'judul',
        'kategori',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'isbn'
    ];
}

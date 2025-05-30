<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'buku'; // sesuaikan dengan tabel di database

    protected $fillable = [
        'judul',
        'kategori',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'deskripsi',
        'jumlah_stok',
        'lokasi_rak',
        'cover',
    ];

    // Relasi: satu buku punya banyak peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }
}

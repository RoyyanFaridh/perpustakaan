<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = ['anggota_id', 'buku_id', 'tanggal_pinjam', 'tanggal_kembali'];

    // Tambahkan relasi ke model Anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    // Tambahkan relasi ke model Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = ['anggota_id', 'buku_id', 'tanggal_pinjam', 'tanggal_kembali'];
}

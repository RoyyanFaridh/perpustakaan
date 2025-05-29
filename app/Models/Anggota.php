<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'members'; // menggunakan tabel 'members'

    protected $fillable = [
        'nama',
        'status',         // 'siswa' atau 'guru'
        'role',
        'nis_nip',        // gabungan NIS/NIP
        'kelas',          // 7, 8, 9 (jika siswa)
        'jenis_kelamin',  // 'L' atau 'P'
        'alamat',
        'no_telp',
        'email',
    ];

    // Relasi: satu anggota bisa punya banyak peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'anggota_id');
    }

    // Accessor untuk NIS (jika status siswa)
    public function getNisAttribute()
    {
        return $this->status === 'siswa' ? $this->nis_nip : null;
    }

    // Accessor untuk NIP (jika status guru)
    public function getNipAttribute()
    {
        return $this->status === 'guru' ? $this->nis_nip : null;
    }
}

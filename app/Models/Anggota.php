<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model {
    use HasFactory;
    
    protected $table = 'members';

    protected $fillable = [
        'nama',
        'status',
        'role',
        'nis_nip',
        'kelas',
        'jenis_kelamin',
        'alamat',
        'no_telp',
        'email',
        'plain_password',      
    ];

    // Relasi satu anggota punya banyak peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'anggota_id');
    }
}

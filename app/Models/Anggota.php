<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model {
    use HasFactory;
    
    protected $table = 'anggotas';

    protected $fillable = [
        'nama',
        'alamat',
        'no_telp',
        'email',
        'status',
        'nis',
        'kelas',
        'jenis_kelamin'
    ];
}

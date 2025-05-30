<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;

    protected $table = 'visitors';

    protected $fillable = ['user_id', 'tanggal'];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


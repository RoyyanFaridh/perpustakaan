<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terlambat extends Model
{
    protected $fillable = ['anggota_id', 'jumlah_hari', 'denda'];
}

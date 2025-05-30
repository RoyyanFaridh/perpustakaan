<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Anggota;

class User extends Authenticatable

{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'nis_nip',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'nis_nip', 'nis_nip');
    }
}

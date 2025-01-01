<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 't_user';
    protected $primaryKey = 'id_user';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id_user',
        'nama',
        'no_handphone',
        'password',
        'rt',
        'rw',
        'foto_profil',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}

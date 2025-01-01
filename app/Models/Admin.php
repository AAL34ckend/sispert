<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 't_admin';
    protected $primaryKey = 'id_admin';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id_admin',
        'nama',
        'no_handphone',
        'password',
        'foto_profil',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}

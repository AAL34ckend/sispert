<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{
    use HasFactory;

    protected $table = 't_petugas';
    protected $primaryKey = 'id_petugas';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id_petugas',
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 't_pengaduan';
    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'id_pengaduan',
        'id_kategori',
        'id_user',
        'judul',
        'konten',
        'status',
        'lokasi',
        'berkas_bukti',
        'nama_bukti',
        'balasan',
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}

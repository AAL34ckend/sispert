<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_pengaduan', function (Blueprint $table) {
            $table->id('id_pengaduan');
            $table->text('judul');
            $table->text('konten');
            $table->text('lokasi');

            $table->text('berkas_bukti');
            $table->text('nama_bukti');

            $table->enum('status', ['terkirim', 'diterima', 'diproses', 'selesai', 'ditolak']);
            $table->text('balasan')->nullable();

            $table->foreignId('id_kategori');
            $table->char('id_user');

            $table->timestamps();

            $table->foreign('id_kategori')->references('id_kategori')->on('t_kategori');
            $table->foreign('id_user')->references('id_user')->on('t_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pengaduan');
    }
};

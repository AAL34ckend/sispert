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
        Schema::create('t_admin', function (Blueprint $table) {
            $table->char('id_admin');
            $table->string('no_handphone', 20)->unique();
            $table->string('nama', 50);
            $table->text('password');

            $table->text('foto_profil')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_admin');
    }
};

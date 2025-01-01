<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Kategori;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::factory()->create([
            'nama' => 'Test Admin',
            'no_handphone' => '081200000001',
            'password' => Hash::make('password123'),
        ]);

        Petugas::factory()->create([
            'nama' => 'Test Petugas',
            'no_handphone' => '081200000002',
            'password' => Hash::make('password123'),
        ]);

        User::factory()->create([
            'nama' => 'Test User',
            'no_handphone' => '081200000003',
            'password' => Hash::make('password123'),
            'rt' => '001',
            'rw' => '001',
        ]);

        Kategori::factory()->create([
            'nama' => 'Bencana Alam',
        ]);
    }
}

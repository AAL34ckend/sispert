<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Pengaduan;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->middleware(
        'auth:admin,petugas,user'
    );

    Route::prefix('/petugas')
        ->group(function () {
            Route::get('/', [PetugasController::class, 'index']);
            Route::get('/create', [PetugasController::class, 'create']);
            Route::get('/{id}/edit', [PetugasController::class, 'edit']);

            Route::post('/', [PetugasController::class, 'store']);
            Route::put('/{id}', [PetugasController::class, 'update']);
            Route::delete('/{id}', [PetugasController::class, 'destroy']);
        })
        ->middleware('auth:admin');

    Route::prefix('/user')
        ->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('/create', [UserController::class, 'create']);
            Route::get('/{id}/edit', [UserController::class, 'edit']);

            Route::post('/', [UserController::class, 'store']);
            Route::put('/{id}', [UserController::class, 'update']);
            Route::delete('/{id}', [UserController::class, 'destroy']);
        })
        ->middleware('auth:admin,petugas');

    Route::prefix('/kategori')
        ->group(function () {
            Route::get('/', [KategoriController::class, 'index']);
            Route::get('/create', [KategoriController::class, 'create']);
            Route::get('/{id}/edit', [KategoriController::class, 'edit']);

            Route::post('/', [KategoriController::class, 'store']);
            Route::put('/{id}', [KategoriController::class, 'update']);
            Route::delete('/{id}', [KategoriController::class, 'destroy']);
        })
        ->middleware('auth:admin,petugas');

    Route::prefix('/pengaduan')
        ->group(function () {
            Route::get('/', [PengaduanController::class, 'index']);
            Route::get('/create', [
                PengaduanController::class,
                'create',
            ])->middleware('auth:user');
            Route::get('/{id}/edit', [
                PengaduanController::class,
                'edit',
            ])->middleware('auth:user');

            Route::post('/', [PengaduanController::class, 'store'])->middleware(
                'auth:user'
            );
            Route::put('/{id}', [
                PengaduanController::class,
                'update',
            ])->middleware('auth:user');
            Route::delete('/{id}', [
                PengaduanController::class,
                'destroy',
            ])->middleware('auth:user');

            Route::get('/{id}/proses', [
                Pengaduan\ProsesController::class,
                'index',
            ])->middleware('auth:petugas,admin');
            Route::put('/{id}/proses', [
                Pengaduan\ProsesController::class,
                'proses',
            ])->middleware('auth:petugas,admin');
        })
        ->middleware('auth:admin,petugas,user');

    Route::prefix('/profil')
        ->group(function () {
            Route::get('/', [ProfilController::class, 'index']);

            Route::put('/', [ProfilController::class, 'update']);
        })
        ->middleware('auth:user,admin,petugas');
});

Route::get('/auth/login', [LoginController::class, 'index'])->name('login');

Route::post('/auth/login', [LoginController::class, 'login']);

Route::get('/auth/register', [RegisterController::class, 'index']);

Route::post('/auth/register', [RegisterController::class, 'register']);

Route::get('/', [LandingController::class, 'index']);

Route::post('/auth/logout', [LogoutController::class, 'logout']);

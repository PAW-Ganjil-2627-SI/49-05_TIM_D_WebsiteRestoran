<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('menu.daftar');
})->name('home');

// Route login dan logout
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Halaman menu hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {

    Route::get('/daftar-menu', [MenuController::class, 'daftar'])
        ->name('menu.daftar');

    Route::get('/menu/tambah', [MenuController::class, 'tambah'])
        ->name('menu.tambah');

    Route::post('/menu/tambah', [MenuController::class, 'store'])
        ->name('menu.store');

    Route::get('/menu/edit/{id}', [MenuController::class, 'edit'])
        ->name('menu.edit');

    Route::put('/menu/edit/{id}', [MenuController::class, 'update'])
        ->name('menu.update');

    Route::delete('/menu/hapus/{id}', [MenuController::class, 'hapus'])
        ->name('menu.hapus');
});

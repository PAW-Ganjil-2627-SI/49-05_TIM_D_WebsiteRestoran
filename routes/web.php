<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TambahController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', [SupplierController::class, 'daftar'])->name('supplier.daftar');
Route::get('/supplier', [SupplierController::class, 'daftar']);
Route::get('/meja', [MejaController::class, 'index'])->name('meja.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Modul Supplier Bahan Baku
    Route::middleware('role:admin,staff')->group(function () {
        Route::get('/supplier/tambah', [SupplierController::class, 'create'])->name('supplier.create');
        Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('/supplier/{supplier}/edit', [SupplierController::class, 'edit'])
            ->name('supplier.edit')
            ->can('update', 'supplier');
        Route::put('/supplier/{supplier}', [SupplierController::class, 'update'])
            ->name('supplier.update')
            ->can('update', 'supplier');
    });

    Route::delete('/supplier/{supplier}', [SupplierController::class, 'destroy'])
        ->name('supplier.destroy')
        ->middleware('role:admin')
        ->can('delete', 'supplier');

    Route::get('/admin/panel', fn () => view('panel'))
        ->middleware('can:akses-admin')
        ->name('admin.panel');

    // Modul Pegawai
    Route::get('/pegawai', [TambahController::class, 'index'])->name('tambah.index');

    Route::middleware('role:admin')->group(function () {
        Route::get('/daftar-tambah', [TambahController::class, 'daftar'])->name('tambah.daftar');
        Route::post('/tambah', [TambahController::class, 'store'])->name('tambah.store');
        Route::get('/tambah/{tambah}/edit', [TambahController::class, 'edit'])->name('tambah.edit');
        Route::put('/tambah/{tambah}', [TambahController::class, 'update'])->name('tambah.update');
        Route::delete('/tambah/{tambah}', [TambahController::class, 'destroy'])->name('tambah.destroy');
    });

    // Modul Master Meja
    Route::get('/meja/tambah', [MejaController::class, 'create'])
        ->can('tambah-meja')
        ->name('meja.create');

    Route::post('/meja', [MejaController::class, 'store'])
        ->middleware('role:admin')
        ->name('meja.store');

    Route::middleware('role:admin,staff')->group(function () {
        Route::get('/meja/{meja}/edit', [MejaController::class, 'edit'])
            ->name('meja.edit')
            ->can('update', 'meja');
        Route::put('/meja/{meja}', [MejaController::class, 'update'])
            ->name('meja.update')
            ->can('update', 'meja');
    });

    Route::delete('/meja/{meja}', [MejaController::class, 'destroy'])
        ->name('meja.destroy')
        ->middleware('role:admin')
        ->can('delete', 'meja');
});

Route::get('/tes-koneksi', function () {
    try {
        DB::connection()->getPdo();
        return 'DB berhasil connect!';
    } catch (\Exception $e) {
        return 'DB gagal connect: ' . $e->getMessage();
    }
})->withoutMiddleware('web');

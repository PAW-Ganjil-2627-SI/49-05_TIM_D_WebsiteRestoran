<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SupplierController::class, 'daftar'])->name('supplier.daftar');
Route::get('/supplier', [SupplierController::class, 'daftar']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
});
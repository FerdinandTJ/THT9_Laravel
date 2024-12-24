<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\WargaController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

/**
 * Admin Routes
 */
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index'); // Dashboard Admin
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create'); // Form tambah pengurus
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store'); // Simpan pengurus
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit'); // Form edit pengurus
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update'); // Update pengurus
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy'); // Hapus pengurus
});

Route::middleware(['auth', 'role:pengurus'])->group(function () {
    Route::get('/pengurus', [PengurusController::class, 'index'])->name('pengurus.index'); // Dashboard Pengurus
    Route::get('/pengurus/warga/create', [PengurusController::class, 'createWarga'])->name('pengurus.createWarga'); // Form tambah warga
    Route::post('/pengurus/warga', [PengurusController::class, 'storeWarga'])->name('pengurus.storeWarga'); // Simpan warga
    Route::get('/pengurus/cashflow', [PengurusController::class, 'manageCashflow'])->name('pengurus.cashflow'); // Kelola cashflow
    Route::get('/pengurus/tagihan', [PengurusController::class, 'manageTagihan'])->name('pengurus.tagihan'); // Kelola tagihan
    Route::post('/pengurus/tagihan', [PengurusController::class, 'storeTagihan'])->name('pengurus.storeTagihan'); // Simpan tagihan
    Route::delete('/pengurus/tagihan/{id}', [PengurusController::class, 'deleteTagihan'])->name('pengurus.deleteTagihan'); // Hapus tagihan
    Route::put('/pengurus/tagihan/{id}', [PengurusController::class, 'updateTagihan'])->name('pengurus.updateTagihan'); // Update tagihan
    Route::post('/pengurus/approve-payment/{id}', [PengurusController::class, 'approvePayment'])->name('pengurus.approvePayment'); // Setujui pembayaran warga
    Route::post('/pengurus/reject-payment/{id}', [PengurusController::class, 'rejectPayment'])->name('pengurus.rejectPayment'); // Tolak pembayaran warga
});

/**
 * Warga Routes
 */

Route::middleware(['auth', 'role:warga'])->group(function () {
    Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
    Route::get('/warga/cashflow', [WargaController::class, 'viewCashflow'])->name('warga.cashflow');
    Route::get('/warga/tagihan', [WargaController::class, 'viewTagihan'])->name('warga.tagihan');
    Route::get('/warga/riwayat-pembayaran', [WargaController::class, 'riwayatPembayaran'])->name('warga.riwayatPembayaran');
    Route::post('/warga/upload-payment', [WargaController::class, 'uploadPayment'])->name('warga.uploadPayment');
    Route::post('/warga/update-password', [WargaController::class, 'updatePassword'])->name('warga.updatePassword');
});

Route::middleware(['auth', 'role:pengurus'])->group(function () {
    Route::get('/pengurus', [PengurusController::class, 'index'])->name('pengurus.index');
    
    // Warga
    Route::get('/pengurus/warga/create', [PengurusController::class, 'createWarga'])->name('pengurus.createWarga');
    Route::post('/pengurus/warga', [PengurusController::class, 'storeWarga'])->name('pengurus.storeWarga');

    // Cashflow
    Route::get('/pengurus/cashflow', [PengurusController::class, 'manageCashflow'])->name('pengurus.cashflow');
    Route::post('/pengurus/cashflow', [PengurusController::class, 'storeCashflow'])->name('pengurus.storeCashflow');

    // Tagihan
    Route::get('/pengurus/tagihan', [PengurusController::class, 'manageTagihan'])->name('pengurus.tagihan');
    Route::post('/pengurus/tagihan', [PengurusController::class, 'storeTagihan'])->name('pengurus.storeTagihan');
    Route::put('/pengurus/tagihan/{id}', [PengurusController::class, 'updateTagihan'])->name('pengurus.updateTagihan');
    Route::delete('/pengurus/tagihan/{id}', [PengurusController::class, 'deleteTagihan'])->name('pengurus.deleteTagihan');

    // Konfirmasi Pembayaran
    Route::post('/pengurus/approve-payment/{id}', [PengurusController::class, 'approvePayment'])->name('pengurus.approvePayment');
    Route::post('/pengurus/reject-payment/{id}', [PengurusController::class, 'rejectPayment'])->name('pengurus.rejectPayment');
});

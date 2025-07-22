<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AdminScanController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ScanController; // ✅ Tambahan controller scan langsung

Route::get('/', function () {
    return view('welcome');
});

// Dashboard (hanya bisa diakses setelah login & verifikasi)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup route yang butuh login
Route::middleware('auth')->group(function () {

    // 🔐 Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 👥 Manajemen Pelanggan
    Route::get('/admin/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
    Route::get('/admin/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
    Route::post('/admin/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');

    // 📸 Scan QR Pelanggan (dengan tampilan admin)
    Route::get('/admin/scan', [AdminScanController::class, 'form'])->name('admin.scan.form');
    Route::post('/admin/scan/process', [AdminScanController::class, 'process'])->name('admin.scan.process');

    // 📄 Riwayat Cuci (opsional)
    Route::get('/admin/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
});

// 📲 Route scan QR langsung dari halaman scan (tanpa login jika kamu mau jadikan publik)
Route::post('/scan-proses', [ScanController::class, 'prosesScan'])->name('scan.proses');

require __DIR__.'/auth.php';

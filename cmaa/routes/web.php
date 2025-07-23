<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pelanggan/{kode}', [PelangganController::class, 'showByKode'])->name('pelanggan.show');
Route::get('/scan', function () {
    return view('pelanggan.scan');
})->name('pelanggan.scan');

Route::post('/scan-admin/{kode}', [PelangganController::class, 'tambahCuci'])->name('admin.scan');

Route::get('/generate-qr/{kode}', function ($kode) {
    $url = url('/pelanggan/' . $kode);
    return view('pelanggan.qrcode', compact('kode', 'url'));
});
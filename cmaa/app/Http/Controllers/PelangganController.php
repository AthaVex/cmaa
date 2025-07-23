<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    // 🔹 Ini untuk menampilkan statistik pelanggan berdasarkan kode
    public function showByKode($kode)
    {
        $pelanggan = Pelanggan::where('kode', $kode)->firstOrFail();
        $total = $pelanggan->riwayatCuci()->count();

        return view('pelanggan.show', compact('pelanggan', 'total'));
    }

    // 🔹 Ini untuk menambahkan 1x cuci
    public function tambahCuci($kode)
    {
        $pelanggan = Pelanggan::where('kode', $kode)->firstOrFail();

        $pelanggan->riwayatCuci()->create(); // auto tambah data waktu saat ini

        return redirect()->route('pelanggan.show', $kode)->with('success', 'Cuci berhasil ditambahkan!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\RiwayatCuci;

class AdminScanController extends Controller
{
    // Form scan QR
    public function form()
    {
        return view('admin.scan.form');
    }

    // Proses hasil scan
    public function process(Request $request)
    {
        $kode = $request->input('kode');

        // Cari pelanggan berdasarkan kode unik
        $pelanggan = Pelanggan::where('kartu_id', $kode)->first();

        if (!$pelanggan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pelanggan tidak ditemukan'
            ]);
        }

        // Tambah 1x cuci
        $pelanggan->total_cuci += 1;
        $pelanggan->save();

        // Simpan ke riwayat (opsional)
        RiwayatCuci::create([
            'pelanggan_id' => $pelanggan->id,
            'waktu_cuci' => now()
        ]);

        // Cek apakah gratis
        $gratis = $pelanggan->total_cuci % 6 === 0;

        return response()->json([
            'status' => 'success',
            'nama' => $pelanggan->nama,
            'total_cuci' => $pelanggan->total_cuci,
            'gratis' => $gratis
        ]);
    }
}

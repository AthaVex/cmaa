<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\RiwayatCuci;
use Illuminate\Support\Facades\Log;

class AdminScanController extends Controller
{
    // Menampilkan form scan QR
    public function form()
    {
        return view('admin.scan.form');
    }

    // Memproses hasil scan QR
    public function process(Request $request)
    {
        try {
            $kode = trim($request->input('kartu_id'));

            if (!$kode) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'ID kartu tidak terkirim'
                ], 400);
            }

            $pelanggan = Pelanggan::where('kartu_id', $kode)->first();

            if (!$pelanggan) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pelanggan tidak ditemukan'
                ], 404);
            }

            // Tambahkan cuci
            $pelanggan->total_cuci += 1;
            $pelanggan->save();

            // Simpan ke riwayat
            RiwayatCuci::create([
                'pelanggan_id' => $pelanggan->id,
                'waktu_cuci' => now()
            ]);

            // Cek gratis (setiap 6x)
            $gratis = $pelanggan->total_cuci % 6 === 0;

            // Jika gratis, reset kembali ke 0
            if ($gratis) {
                $pelanggan->total_cuci = 0;
                $pelanggan->save();
            }

            return response()->json([
                'status' => 'success',
                'nama' => $pelanggan->nama,
                'total_cuci' => $gratis ? 6 : $pelanggan->total_cuci, // tampilkan 6 dulu sebelum reset
                'gratis' => $gratis
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal memproses scan: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan server'
            ], 500);
        }
    }
}

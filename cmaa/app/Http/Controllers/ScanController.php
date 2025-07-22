<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class ScanController extends Controller
{
    public function formScan()
    {
        return view('admin.scan.form');
    }

    public function prosesScan(Request $request)
    {
        $kartuId = $request->input('kartu_id');

        $pelanggan = Pelanggan::where('kartu_id', $kartuId)->first();

        if (!$pelanggan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pelanggan tidak ditemukan'
            ]);
        }

        // Tambah 1x cuci
        $pelanggan->total_cuci += 1;

        $gratis = false;
        if ($pelanggan->total_cuci >= 6) {
            $gratis = true;
            $pelanggan->total_cuci = 0;
        }

        $pelanggan->save();

        return response()->json([
            'status' => 'success',
            'nama' => $pelanggan->nama,
            'total_cuci' => $pelanggan->total_cuci,
            'gratis' => $gratis
        ]);
    }
}

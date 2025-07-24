<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatCuci;
use App\Models\Pelanggan;
use Carbon\Carbon;

class RiwayatController extends Controller
{
    // Menampilkan semua riwayat cuci pelanggan
    public function index()
    {
        $riwayats = RiwayatCuci::with('pelanggan')->latest()->get();
        return view('admin.riwayat.index', compact('riwayats'));
    }

    // Menghapus semua data riwayat cuci
    public function destroyAll()
    {
        RiwayatCuci::truncate();

        return redirect()->route('riwayat.index')->with('success', 'Semua riwayat cuci berhasil dihapus.');
    }

    // Rekap gabungan mingguan dan bulanan
    public function rekapGabungan(Request $request)
    {
        $pelangganId = $request->input('pelanggan_id');

        // Periode mingguan: 7 hari terakhir
        $startWeek = Carbon::now()->subDays(6)->startOfDay();
        $endWeek = Carbon::now()->endOfDay();

        $weeklyQuery = RiwayatCuci::with('pelanggan')
            ->whereBetween('waktu_cuci', [$startWeek, $endWeek]);

        // Periode bulanan: 30 hari terakhir
        $startMonth = Carbon::now()->subDays(29)->startOfDay();
        $endMonth = Carbon::now()->endOfDay();

        $monthlyQuery = RiwayatCuci::with('pelanggan')
            ->whereBetween('waktu_cuci', [$startMonth, $endMonth]);

        // Filter jika memilih pelanggan
        if ($pelangganId) {
            $weeklyQuery->where('pelanggan_id', $pelangganId);
            $monthlyQuery->where('pelanggan_id', $pelangganId);
        }

        // Group by tanggal dan bulan
        $weeklyData = $weeklyQuery->get()->groupBy(function ($item) {
            return $item->waktu_cuci->format('Y-m-d');
        });

        $monthlyData = $monthlyQuery->get()->groupBy(function ($item) {
            return $item->waktu_cuci->format('Y-m');
        });

        $pelanggans = Pelanggan::all();

        return view('admin.riwayat.rekap-gabungan', compact(
            'pelanggans',
            'pelangganId',
            'weeklyData',
            'monthlyData',
            'startWeek',
            'endWeek',
            'startMonth',
            'endMonth'
        ));
    }
}

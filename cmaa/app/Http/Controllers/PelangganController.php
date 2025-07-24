<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $query = Pelanggan::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('kartu_id', 'like', "%{$search}%");
        }

        $pelanggans = $query->latest()->get();

        return view('admin.pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $kartuId = 'MCAA' . rand(100000, 999999);

        Pelanggan::create([
            'kartu_id' => $kartuId,
            'total_cuci' => 0,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan baru berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.show', compact('pelanggan'));
    }

    public function print($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.print', compact('pelanggan'));
    }

    public function printAll() // ✅ sudah diperbaiki
    {
        $pelanggans = Pelanggan::all();
        return view('admin.pelanggan.print-all', compact('pelanggans'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    // Menampilkan daftar pelanggan
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('admin.pelanggan.index', compact('pelanggans'));
    }

    // Menampilkan form tambah pelanggan
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    // Menyimpan pelanggan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Generate ID unik (MCAA + angka acak)
        do {
            $kartu_id = 'MCAA' . rand(100000, 999999);
        } while (Pelanggan::where('kartu_id', $kartu_id)->exists());

        // Simpan data
        Pelanggan::create([
            'nama' => $request->nama,
            'kartu_id' => $kartu_id,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    // ✅ Menampilkan form untuk scan pelanggan
    public function form()
    {
        return view('admin.pelanggan.scan.form');
    }
}

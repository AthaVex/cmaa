@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white shadow-md rounded-xl">
    <h2 class="text-2xl font-semibold text-center mb-4">Hasil Scan QR</h2>

    @if ($pelanggan)
        <div class="mb-4 text-center">
            <p class="text-lg font-bold">Nama: {{ $pelanggan->nama }}</p>
            <p class="text-gray-600">ID Kartu: {{ $pelanggan->kartu_id }}</p>
            <p class="text-gray-600">Jumlah Cuci: {{ $pelanggan->jumlah_cuci }}</p>
        </div>

        @if ($pelanggan->jumlah_cuci == 6)
            <div class="p-4 bg-green-100 text-green-800 font-semibold text-center rounded-lg">
                🎉 Selamat! Cuci ke-6 GRATIS!
            </div>
        @else
            <div class="p-4 bg-blue-100 text-blue-800 text-center rounded-lg">
                ✅ Data berhasil diperbarui.
            </div>
        @endif

        <div class="mt-6 text-center">
            <a href="{{ route('admin.scan.form') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                Scan Pelanggan Lain
            </a>
        </div>
    @else
        <div class="p-4 bg-red-100 text-red-800 text-center rounded-lg">
            ❌ Pelanggan tidak ditemukan!
        </div>
    @endif
</div>
@endsection

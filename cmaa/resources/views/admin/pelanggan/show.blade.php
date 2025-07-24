<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🧾 Detail Pelanggan
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    
                    {{-- Informasi Pelanggan --}}
                    <div>
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Kartu ID</h3>
                            <p class="text-xl text-blue-600 font-mono">{{ $pelanggan->kartu_id }}</p>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Total Cuci</h3>
                            <p class="text-lg text-gray-800">{{ $pelanggan->total_cuci }} kali</p>
                        </div>
                    </div>

                    {{-- QR Code --}}
                    <div class="flex justify-center md:justify-end">
                        {!! QrCode::size(160)->generate($pelanggan->kartu_id) !!}
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-8 flex flex-col md:flex-row justify-between gap-3">
                    <a href="{{ route('pelanggan.index') }}"
                       class="inline-block bg-gray-700 hover:bg-gray-800 text-white py-2 px-5 rounded shadow transition">
                        ← Kembali ke Daftar
                    </a>

                    <a href="{{ route('pelanggan.print', $pelanggan->id) }}" target="_blank"
                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white py-2 px-5 rounded shadow transition">
                        🖨️ Cetak QR
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

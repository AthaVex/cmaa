<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📋 Daftar Pelanggan
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Form Pencarian --}}
            <form method="GET" action="{{ route('pelanggan.index') }}" class="mb-4 flex items-center gap-2">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari berdasarkan Kartu ID..."
                    value="{{ request('search') }}"
                    class="w-full md:w-1/3 px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-200"
                >
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    🔍 Cari
                </button>
            </form>

            {{-- Tombol Aksi --}}
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('pelanggan.print.all') }}" target="_blank"
                   class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                    🖨️ Cetak Semua Kartu
                </a>

                <a href="{{ route('pelanggan.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                    ➕ Tambah Pelanggan
                </a>
            </div>

            {{-- Notifikasi --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tabel Data --}}
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kartu ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">QR Code</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($pelanggans as $index => $pelanggan)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap font-mono text-blue-600">{{ $pelanggan->kartu_id }}</td>
                                <td class="px-6 py-4">{!! QrCode::size(80)->generate($pelanggan->kartu_id) !!}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('pelanggan.show', $pelanggan->id) }}"
                                       class="bg-gray-700 hover:bg-gray-800 text-white px-3 py-2 rounded text-sm">
                                        🔍 Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada pelanggan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

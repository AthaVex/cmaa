<x-app-layout>
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6 mt-6">
        <h2 class="text-2xl font-semibold mb-4">Riwayat Cuci Pelanggan</h2>

        {{-- Tombol Hapus Semua --}}
        <form action="{{ route('riwayat.destroyAll') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua riwayat cuci?')" class="mb-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">
                Hapus Semua Riwayat
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Nama Pelanggan</th>
                        <th class="px-4 py-2 border">ID Kartu</th>
                        <th class="px-4 py-2 border">Waktu Cuci</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayats as $index => $r)
                        <tr class="text-center">
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $r->pelanggan->nama ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $r->pelanggan->kartu_id ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $r->waktu_cuci->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Belum ada data riwayat cuci.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

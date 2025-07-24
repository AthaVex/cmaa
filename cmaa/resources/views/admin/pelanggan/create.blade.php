<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🆕 Tambah Pelanggan
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
            

            <form method="POST" action="{{ route('pelanggan.store') }}">
                @csrf

                <p class="text-gray-700 mb-4">Klik tombol simpan untuk membuat pelanggan baru dengan kartu ID & QR otomatis.</p>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('pelanggan.index') }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
                        🔙 Kembali
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                        🎲 Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

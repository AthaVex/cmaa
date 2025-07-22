<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🆕 Tambah Pelanggan
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
            @if ($errors->any())
                <div class="mb-4 text-red-600 bg-red-100 p-3 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('pelanggan.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 font-medium mb-1">Nama Pelanggan</label>
                    <input type="text" id="nama" name="nama" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

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

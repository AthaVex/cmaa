<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-6">
        <h2 class="text-2xl font-semibold mb-4">Scan QR Pelanggan</h2>

        {{-- Kamera QR Scanner --}}
        <div id="reader" class="w-full rounded border border-gray-300"></div>

        {{-- 🎉 Popup Cuci Gratis --}}
        <div id="popup-gratis"
             class="fixed inset-0 bg-black bg-opacity-70 items-center justify-center z-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-xl text-center animate__animated animate__bounceIn">
                <h2 class="text-2xl font-bold text-green-600 mb-2">🎉 Selamat!</h2>
                <p class="mb-4 text-gray-700">Pelanggan mendapatkan <strong>1x cuci gratis</strong>!</p>
                <button onclick="tutupPopup()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Tutup
                </button>
            </div>
        </div>

        {{-- Alert info --}}
        <div id="result" class="mt-4 text-center text-lg font-medium text-gray-700"></div>
    </div>

    {{-- Animate.css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    {{-- Script QR Scanner --}}
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        const qrScanner = new Html5Qrcode("reader");

        function onScanSuccess(decodedText, decodedResult) {
            qrScanner.pause();

            fetch("{{ route('admin.scan.process') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    kartu_id: decodedText
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === "success") {
                    document.getElementById('result').innerHTML =
                        `✅ ${data.nama} telah dicuci. Total sekarang: ${data.total_cuci}x`;

                    if (data.gratis) {
                        tampilkanPopup();
                    }
                } else {
                    document.getElementById('result').innerHTML =
                        `❌ ${data.message}`;
                }

                setTimeout(() => {
                    qrScanner.resume();
                }, 2000); // lanjut scan lagi setelah 2 detik
            })
            .catch(err => {
                console.error("Error:", err);
                document.getElementById('result').innerText = "Terjadi kesalahan saat memproses.";
                qrScanner.resume();
            });
        }

        qrScanner.start(
            { facingMode: "environment" },
            {
                fps: 10,
                qrbox: { width: 250, height: 250 }
            },
            onScanSuccess
        ).catch(err => {
            console.error("Camera start error:", err);
        });

        function tampilkanPopup() {
            const popup = document.getElementById('popup-gratis');
            popup.classList.remove('hidden');
            popup.classList.add('flex');
        }

        function tutupPopup() {
            const popup = document.getElementById('popup-gratis');
            popup.classList.add('hidden');
            popup.classList.remove('flex');
        }
    </script>
</x-app-layout>

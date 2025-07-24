<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📊 Rekap Cuci (Mingguan & Bulanan)
        </h2>
    </x-slot>

  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Filter Pelanggan --}}
        <form method="GET" class="mb-4 flex flex-wrap gap-3 items-center">
            <select name="pelanggan_id" class="border rounded px-4 py-2">
                <option value="">📋 Semua Pelanggan</option>
                @foreach($pelanggans as $p)
                    <option value="{{ $p->id }}" {{ $pelangganId == $p->id ? 'selected' : '' }}>
                        {{ $p->kartu_id }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                🔍 Tampilkan
            </button>
        </form>

        {{-- Periode Info --}}
        <p class="text-gray-600 mb-4">
            🗓️ Mingguan: {{ $startWeek->format('d M') }} - {{ $endWeek->format('d M Y') }} |
            📅 Bulanan: {{ $startMonth->format('d M') }} - {{ $endMonth->format('d M Y') }}
        </p>

        {{-- Grafik Mingguan --}}
        <div class="bg-white rounded shadow p-4 mb-8">
            <h3 class="text-lg font-semibold mb-2 text-gray-800">📈 Grafik Cuci Mingguan</h3>
            <canvas id="weeklyChart" height="100"></canvas>
        </div>

        {{-- Grafik Bulanan --}}
        <div class="bg-white rounded shadow p-4">
            <h3 class="text-lg font-semibold mb-2 text-gray-800">📆 Grafik Cuci Bulanan</h3>
            <canvas id="monthlyChart" height="100"></canvas>
        </div>

    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const weeklyLabels = {!! json_encode($weeklyData->keys()) !!};
    const weeklyCounts = {!! json_encode($weeklyData->map->count()->values()) !!};

    const monthlyLabels = {!! json_encode($monthlyData->keys()) !!};
    const monthlyCounts = {!! json_encode($monthlyData->map->count()->values()) !!};

    const weeklyChart = new Chart(document.getElementById('weeklyChart'), {
        type: 'bar',
        data: {
            labels: weeklyLabels,
            datasets: [{
                label: 'Jumlah Cuci',
                data: weeklyCounts,
                backgroundColor: '#3b82f6'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true },
                x: { ticks: { maxRotation: 90, minRotation: 45 } }
            }
        }
    });

    const monthlyChart = new Chart(document.getElementById('monthlyChart'), {
        type: 'line',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Jumlah Cuci',
                data: monthlyCounts,
                fill: true,
                borderColor: '#10b981',
                backgroundColor: 'rgba(16,185,129,0.2)'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

</x-app-layout>

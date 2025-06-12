@extends('template.appuser')

@section('content')

@section('title', 'Halaman Hasil Prediksi')
@php
    use Carbon\Carbon;
    Carbon::setLocale('id');

    $lastData = $data->last(); // data terakhir

    $labels = [
        Carbon::parse($lastData->TANGGAL_KELUAR)->translatedFormat('d M'),
        Carbon::parse($next_date)->translatedFormat('d M')
    ];

    $values = [
        $lastData->JUMLAH_KELUAR,
        round($forecast, 2)
    ];
@endphp

<div class="row">
    <div class="col-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h4 class="card-title mb-4">Hasil Prediksi - Kategori: {{ $kategori }}</h4>
                <a href="{{ url('/prediksi') }}" class="btn btn-outline-primary mt-n3 mb-1">Kembali</a>
                <div class="mb-3">
                    <strong>Alpha (α):</strong> {{ $alpha }} <br>
                    <strong>Tanggal Prediksi:</strong> {{ \Carbon\Carbon::parse($next_date)->translatedFormat('d F Y') }}<br>
                    <strong>Hasil Prediksi Adalah:</strong> {{ $forecast }} {{ $satuan }}
                </div>

                <!-- Grafik 2 Titik -->
                <div class="mt-4">
                    <h5>Grafik Prediksi Singkat</h5>
                    <canvas id="chartPrediksi" height="100"></canvas>
                </div>
                <!-- Kesimpulan -->
<div class="mt-4">
    <h5>Kesimpulan</h5>
    @php
        $selisih = $forecast - $lastData->JUMLAH_KELUAR;
    @endphp

    @if ($selisih > 0)
        <div class="alert alert-success">
            Prediksi menunjukkan adanya <strong>kenaikan</strong> jumlah barang keluar sebanyak <strong>{{ abs($selisih) }} {{ $satuan }}</strong> dibandingkan hari sebelumnya.
        </div>
    @elseif ($selisih < 0)
        <div class="alert alert-warning">
            Prediksi menunjukkan adanya <strong>penurunan</strong> jumlah barang keluar sebanyak <strong>{{ abs($selisih) }} {{ $satuan }}</strong> dibandingkan hari sebelumnya.
        </div>
    @else
        <div class="alert alert-info">
            Prediksi menunjukkan <strong>jumlah yang sama</strong> seperti hari sebelumnya.
        </div>
    @endif
</div>

            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartPrediksi').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Prediksi Barang Keluar',
                data: {!! json_encode($values) !!},
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.3,
                fill: true,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                tooltip: { enabled: true }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: '{{ $satuan }}' }
                },
                x: {
                    title: { display: true, text: 'Tanggal' }
                }
            }
        }
    });
</script>
@endsection

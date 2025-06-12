@extends('template.appuser')
@section('content')
@section('title', 'Halaman dashboard')
@php
use Carbon\Carbon;
Carbon::setLocale('id');
@endphp
<style>
    .cards {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 30px;
        justify-content: center;
    }

    .cards .card {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
        height: 120px;
        width: 220px;
        border-radius: 10px;
        color: white;
        cursor: pointer;
        transition: 400ms;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .cards .card:hover {
        transform: scale(1.05);
    }

    .cards:hover > .card:not(:hover) {
        filter: blur(2px);
        transform: scale(0.98);
    }

    .cards .red { background-color: #f43f5e; }
    .cards .blue { background-color: #3b82f6; }
    .cards .green { background-color: #22c55e; }
    .cards .purple { background-color: #8b5cf6; }

    .card p.tip {
        font-size: 1.2em;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .card p.second-text {
        font-size: .9em;
    }

    .chart-card {
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
    }

    .chart-card h5 {
        font-weight: 600;
        margin-bottom: 20px;
        color: #111827;
    }

    .chart-card select {
        padding: 6px 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    #chartContainer {
        height: 320px;
    }
</style>

<main class="main" id="main">
    <section class="section dashboard">

        <!-- Kartu Statistik -->
        <div class="cards">
            <div class="card red">
                <p class="tip">Total Stok</p>
                <p class="second-text">{{ $gudang ?? 'Loading...' }} item</p>
            </div>
            <div class="card blue">
                <p class="tip">Stok Hampir Habis</p>
                <p class="second-text">{{ $stokHampirHabis ?? 'Loading...' }} item</p>
            </div>
            <div class="card green">
                <p class="tip">Barang Keluar</p>
                <p class="second-text">{{ $barangKeluar ?? 'Loading...' }} Hari ini</p>
            </div>
            <div class="card purple">
                <p class="tip">Jumlah User</p>
                <p class="second-text">{{ $jumlahUser ?? 'Loading...' }} orang</p>
            </div>
        </div>

        <!-- Grafik Barang Keluar Bulanan -->
        <div class="chart-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Grafik Barang Keluar Bulanan</h5>
                <form method="GET" class="d-flex gap-2">
                    <select name="bulan" class="form-select" style="width:auto">
                        @foreach($bulanList as $b)
                            <option value="{{ str_pad($b, 2, '0', STR_PAD_LEFT) }}" {{ $selectedMonth == $b ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
                            </option>
                        @endforeach
                    </select>

                    <select name="tahun" class="form-select" style="width:auto">
                        @foreach($tahunList as $t)
                            <option value="{{ $t }}" {{ $selectedYear == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
            <canvas id="chartBarangKeluar"></canvas>
        </div>
    </section>
</main>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Script Chart -->
<script>
    const ctx = document.getElementById('chartBarangKeluar').getContext('2d');
    const chartBarangKeluar = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Barang Keluar',
                data: {!! json_encode($data) !!},
                backgroundColor: 'rgba(59, 130, 246, 0.6)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endsection

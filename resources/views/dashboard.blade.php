@extends('template.appuser')
@section('content')

<style>
    .cards {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 30px;
        justify-content: center; /* ini bikin horizontal center di semua ukuran */
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
</style>

<main class="main" id="main">
    <section class="section dashboard">
        <div class="cards">
            <div class="card red">
                <p class="tip">Total Stok</p>
                <p class="second-text">{{ $totalStok ?? 'Loading...' }} item</p>
            </div>
            <div class="card blue">
                <p class="tip">Stok Hampir Habis</p>
                <p class="second-text">{{ $stokHampirHabis ?? 'Loading...' }} item</p>
            </div>
            <div class="card green">
                <p class="tip">Barang Keluar</p>
                <p class="second-text">{{ $barangKeluar ?? 'Loading...' }} bulan ini</p>
            </div>
            <div class="card purple">
                <p class="tip">Jumlah User</p>
                <p class="second-text">{{ $jumlahUser ?? 'Loading...' }} orang</p>
            </div>
        </div>
    </section>
</main>
@endsection

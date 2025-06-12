<?php

namespace App\Http\Controllers;
use App\Models\gudang;
use App\Models\keluar;
use App\Models\users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    //
    public function index(Request $request)
{
    $selectedMonth = $request->get('bulan', Carbon::now()->format('m'));
    $selectedYear = $request->get('tahun', Carbon::now()->year);


    // Data untuk grafik
    $barangKeluarBulanan = keluar::select(
        DB::raw("DATE(TANGGAL_KELUAR) as tanggal"),
        DB::raw("SUM(JUMLAH_KELUAR) as total")
    )
    ->whereMonth('TANGGAL_KELUAR', $selectedMonth)
    ->whereYear('TANGGAL_KELUAR', $selectedYear)
    ->groupBy(DB::raw("DATE(TANGGAL_KELUAR)"))
    ->orderBy('tanggal')
    ->get();

    $labels = $barangKeluarBulanan->pluck('tanggal')->map(function ($date) {
        return Carbon::parse($date)->format('d M');
    });

    $data = $barangKeluarBulanan->pluck('total');

    // Data dropdown bulan & tahun otomatis
    $availableDates = keluar::selectRaw('MONTH(TANGGAL_KELUAR) as bulan, YEAR(TANGGAL_KELUAR) as tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->orderBy('bulan')
        ->get();

    $bulanList = $availableDates->pluck('bulan')->unique();
    $tahunList = $availableDates->pluck('tahun')->unique();

    $gudang = gudang::sum('JUMLAH');
    $stokHampirHabis = gudang::where('JUMLAH', '<', 10)->count();
    $jumlahUser = users::where('level', '!=', 'admin')->count();
    $barangKeluar = keluar::whereDate('TANGGAL_KELUAR', Carbon::today())->sum('JUMLAH_KELUAR'); 

    return view('dashboard', compact(
        'gudang', 'stokHampirHabis', 'barangKeluar','jumlahUser', 'labels', 'data',
        'bulanList', 'tahunList', 'selectedMonth', 'selectedYear'
    ));
}
}

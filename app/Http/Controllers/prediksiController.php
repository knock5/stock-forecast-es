<?php

namespace App\Http\Controllers;
use App\Models\gudang;
use App\Models\keluar;
use Illuminate\Http\Request;
use Carbon\Carbon;

class prediksiController extends Controller
{
    //
    public function index()
    {
        $gudang = gudang::all();
        return view('prediksi', compact('gudang'));
    }

    public function prediksi(Request $request)
    {
        $kategori = $request->kategori;
        $barang = gudang::find($kategori);

        if (!$barang) {
            return back()->with('error', 'Kategori tidak ditemukan.');
        }

        $data = keluar::where('ID_BARANG', $kategori)
            ->orderBy('TANGGAL_KELUAR')
            ->get(['TANGGAL_KELUAR', 'JUMLAH_KELUAR', 'ID_BARANG']);

        if ($data->count() < 2) {
            return back()->with('error', 'Data tidak cukup untuk melakukan prediksi, silakan tambah data.');
        }

        $n = $data->count();
        $alpha = round(2 / ($n + 1), 6);

        $forecastData = [];
        $forecast = $data[0]->JUMLAH_KELUAR;

        $forecastData[] = [
            't' => 1,
            'tanggal' => Carbon::parse($data[0]->TANGGAL_KELUAR)->format('Y-m-d'),
            'aktual' => $data[0]->JUMLAH_KELUAR,
            'forecast' => $forecast,
            'rumus' => 'F_1 = A_1'
        ];

        // Perhitungan SES untuk seluruh data aktual
        for ($i = 1; $i < $n; $i++) {
            $prevForecast = $forecast;
            $prevActual = $data[$i - 1]->JUMLAH_KELUAR;
            $forecast = $prevForecast + $alpha * ($prevActual - $prevForecast);

            $forecastData[] = [
                't' => $i + 1,
                'tanggal' => Carbon::parse($data[$i]->TANGGAL_KELUAR)->format('Y-m-d'),
                'aktual' => $data[$i]->JUMLAH_KELUAR,
                'forecast' => round($forecast, 2),
                'rumus' => "F_t = {$prevForecast} + {$alpha} \\times ({$prevActual} - {$prevForecast})"
            ];
        }

        // Tambahkan prediksi untuk hari berikutnya
        $lastActual = $data->last()->JUMLAH_KELUAR;
        $prevForecast = $forecast;
        $forecast = $prevForecast + $alpha * ($lastActual - $prevForecast);

        $nextDate = Carbon::parse($data->last()->TANGGAL_KELUAR)->addDay()->format('Y-m-d');

        $forecastData[] = [
            't' => 'Prediksi',
            'tanggal' => $nextDate,
            'aktual' => '-',
            'forecast' => round($forecast, 2),
            'rumus' => "F_t = {$prevForecast} + {$alpha} \\times ({$lastActual} - {$prevForecast})"
        ];

        return view('hasil', [
            'kategori'     => $barang->NAMA,
            'satuan'       => $barang->SATUAN,
            'alpha'        => $alpha,
            'forecast'     => round($forecast, 2),
            'next_date'    => $nextDate,
            'data'         => $data,
            'forecastData' => $forecastData
        ]);
    }

}


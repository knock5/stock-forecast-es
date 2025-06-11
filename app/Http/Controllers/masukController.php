<?php

namespace App\Http\Controllers;
use App\Models\masuk;
use App\Models\gudang;
use Illuminate\Http\Request;

class masukController extends Controller
{
    //
    public function index()
    {
        $gudang = gudang::all();
        $masuk = masuk::all();
        return view('masuk',compact('masuk','gudang'));
    }
    public function tambah(Request $request)
    {
        $masuk = new masuk;
        $masuk->ID_BARANG= $request->barang;
        $masuk->TANGGAL_MASUK = $request->tanggal;
        $masuk->JUMLAH_MASUK = $request->jumlah;
        $masuk->save();
        $gudang = gudang::find($request->barang); // Asumsikan ID_BARANG = id gudang
        if ($gudang) {
            $gudang->JUMLAH += $request->jumlah;
            $gudang->save();
        }
        
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }
    public function ubah(Request $request, String $id)
    {
        $masuk = masuk::find($id);

        $jumlahLama = $masuk->JUMLAH_MASUK;
            $jumlahBaru = $request->jumlah;
            $selisih = $jumlahBaru - $jumlahLama;

        $masuk->ID_BARANG= $request->barang;
        $masuk->TANGGAL_MASUK = $request->tanggal;
        $masuk->JUMLAH_MASUK = $request->jumlah;
        $masuk->save();
        $gudang = gudang::find($request->barang);
    if ($gudang) {
        $gudang->JUMLAH += $selisih; // Bisa bertambah atau berkurang
        $gudang->save();
    }
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }
    public function hapus(String $id)
    {
        $masuk = masuk::find($id);
        $masuk->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}

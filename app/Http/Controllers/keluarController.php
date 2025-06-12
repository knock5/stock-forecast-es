<?php

namespace App\Http\Controllers;
use App\Models\gudang;
use App\Models\keluar;
use Illuminate\Http\Request;

class keluarController extends Controller
{
    //
    public function index()
    {
        $keluar = keluar::all();
        $gudang = gudang::all();
        return view('keluar',compact('keluar','gudang'));
    }
    public function tambah(Request $request)
    {
        $request->validate([
            'barang' => 'required', // pastikan ID barang ada di tabel gudang
            'tanggal' => 'required',
            'jumlah' => 'required|integer|min:1',
           
        ], [
            'barang.required' => 'Barang harus dipilih.',
            'tanggal.required' => 'Tanggal keluar harus diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'jumlah.integer' => 'Jumlah keluar harus berupa angka.',
            'jumlah.min' => 'Jumlah keluar minimal 1.',
        ]);
        $gudang = gudang::find($request->barang);
        if (!$gudang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan');
        }
    
        // Cek stok mencukupi
        if ($gudang->JUMLAH < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        }
    
        // Simpan data keluar
        $keluar = new keluar;
        $keluar->ID_BARANG = $request->barang;
        $keluar->TANGGAL_KELUAR = $request->tanggal;
        $keluar->JUMLAH_KELUAR = $request->jumlah;
        $keluar->LOKASI = $request->lokasi;
        $keluar->save();
    
        // Kurangi stok
        $gudang->JUMLAH -= $request->jumlah;
        $gudang->save();
    
        return redirect()->back()->with('success', 'Data keluar berhasil ditambahkan dan stok dikurangi');
    }
    public function ubah(Request $request, String $id)
{
    $request->validate([
        'barang' => 'required', // pastikan ID barang ada di tabel gudang
        'tanggal' => 'required',
        'jumlah' => 'required|integer|min:1',
       
    ], [
        'barang.required' => 'Barang harus dipilih.',
        'tanggal.required' => 'Tanggal keluar harus diisi.',
        'tanggal.date' => 'Format tanggal tidak valid.',
        'jumlah.integer' => 'Jumlah keluar harus berupa angka.',
        'jumlah.min' => 'Jumlah keluar minimal 1.',
    ]);
    $keluar = keluar::find($id);
    if (!$keluar) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    $jumlahLama = $keluar->JUMLAH_KELUAR;
    $jumlahBaru = $request->jumlah;
    $selisih = $jumlahBaru - $jumlahLama;

    $gudang = gudang::find($request->barang);
    if (!$gudang) {
        return redirect()->back()->with('error', 'Barang tidak ditemukan');
    }

    // Cek stok cukup jika jumlah baru > jumlah lama
    if ($selisih > 0 && $gudang->JUMLAH < $selisih) {
        return redirect()->back()->with('error', 'Stok tidak mencukupi untuk penyesuaian');
    }

    // Update data keluar
    $keluar->ID_BARANG = $request->barang;
    $keluar->TANGGAL_KELUAR = $request->tanggal;
    $keluar->JUMLAH_KELUAR = $jumlahBaru;
    $keluar->LOKASI = $request->lokasi;
    $keluar->save();

    // Sesuaikan stok
    $gudang->JUMLAH -= $selisih;
    $gudang->save();

    return redirect()->back()->with('success', 'Data keluar berhasil diubah dan stok diperbarui');
}

}

<?php

namespace App\Http\Controllers;
use App\Models\gudang;
use App\Models\masuk;
use App\Models\keluar;
use Illuminate\Http\Request;

class datasetController extends Controller
{
    //
    public function index()
    {
        $gudang = gudang::all();
        return view('dataset', compact('gudang'));
    }
    public function tambah(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'satuan' => 'required|string',
        ], [
            'nama.required' => 'Nama gudang harus diisi.',
            'satuan.required' => 'Satuan harus diisi.',
        ]);
        $id = auth()->user()->id;
        $gudang = new gudang;
        $gudang->NAMA = $request->nama;
        $gudang->id_user =$id;
        $gudang->SATUAN = $request->satuan;
        $gudang->save();
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }
    public function ubah(Request $request, String $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'satuan' => 'required|string',
        ], [
            'nama.required' => 'Nama gudang harus diisi.',
            'satuan.required' => 'Satuan harus diisi.',
        ]);
        $gudang = gudang::find($id);
        $gudang->NAMA = $request->nama;
        $gudang->SATUAN = $request->satuan;
        $gudang->save();
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }
    public function hapus(String $id)
    {
        keluar::where('ID_BARANG', $id)->delete();
        masuk::where('ID_BARANG', $id)->delete();
    
        // Hapus data dari tabel gudang
        $gudang = gudang::find($id);
        if ($gudang) {
            $gudang->delete();
        }
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}

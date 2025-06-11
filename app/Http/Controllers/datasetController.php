<?php

namespace App\Http\Controllers;
use App\Models\gudang;
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
        $gudang = new gudang;
        $gudang->NAMA = $request->nama;
        $gudang->id_user =1;
        $gudang->SATUAN = $request->satuan;
        $gudang->save();
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }
    public function ubah(Request $request, String $id)
    {
        $gudang = gudang::find($id);
        $gudang->NAMA = $request->nama;
        $gudang->SATUAN = $request->satuan;
        $gudang->save();
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }
}

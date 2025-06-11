<?php

namespace App\Http\Controllers;
use App\Models\gudang;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    //
    public function index()
    {
        $gudang = gudang::sum('JUMLAH');
        $stokHampirHabis = gudang::where('JUMLAH', '<', 10)->count();

        return view('dashboard',compact('gudang'));
    }
}

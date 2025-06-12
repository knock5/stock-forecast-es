<?php

namespace App\Http\Controllers;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class akunController extends Controller
{
    //
    public function index()
    {
        $users = users::where('level', '!=', 'admin')->get();
        return view('akun', compact('users'));
    }
    public function tambah(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
          
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
          
        ]);
       $user = new Users;
       $user->name = $request->nama;
       $user->email = $request->email;
       $user->password = Hash::make($request->password);
       $user->save();
       return redirect()->back()->with('success', 'Data Akun berhasil ditambahkan');
    }
    public function hapus(String $id)
    {
        $users = users::find($id);
        $users->delete();
        return redirect()->back()->with('success', 'Data Akun Berhasil Dihapus');
    }   
}

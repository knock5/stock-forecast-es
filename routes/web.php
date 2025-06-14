<?php

use App\Http\Controllers\akunController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\datasetController;
use App\Http\Controllers\keluarController;
use App\Http\Controllers\masukController;
use App\Http\Controllers\prediksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function(){
Route::get('/',[dashboardController::class,'index']);
Route::get('/dataset',[datasetController::class,'index']);
Route::post('/dataset/tambah',[datasetController::class,'tambah']);
Route::post('/dataset/ubah/{id}',[datasetController::class,'ubah']);
Route::delete('/dataset/hapus/{id}',[datasetController::class,'hapus']);
Route::get('/masuk',[masukController::class,'index']);
Route::post('/masuk/tambah',[masukController::class,'tambah']);
Route::post('/masuk/ubah/{id}',[masukController::class,'ubah']);
Route::delete('/masuk/hapus/{id}',[masukController::class,'hapus']);
Route::get('/keluar',[keluarController::class,'index']);
Route::post('/keluar/tambah',[keluarController::class,'tambah']);
Route::post('/keluar/ubah/{id}',[keluarController::class,'ubah']);
Route::get('/prediksi',[prediksiController::class,'index']);
Route::post('/hasil',[prediksiController::class,'prediksi']);
Route::get('/akun',[akunController::class,'index']);
Route::post('/akun/tambah',[akunController::class,'tambah']);
Route::delete('/akun/hapus/{id}',[akunController::class,'hapus']);
});
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

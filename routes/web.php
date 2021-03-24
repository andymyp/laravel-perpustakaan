<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
  // Master Pegawai
  Route::get('pegawai', 'App\Http\Controllers\PegawaiController@index');
  Route::get('pegawai/tambah', 'App\Http\Controllers\PegawaiController@tambah');
  Route::post('pegawai/tambah', 'App\Http\Controllers\PegawaiController@store');
  Route::get('pegawai/detail/{id}', 'App\Http\Controllers\PegawaiController@detail');
  Route::get('pegawai/edit/{id}', 'App\Http\Controllers\PegawaiController@edit');
  Route::put('pegawai/edit/{id}', 'App\Http\Controllers\PegawaiController@update');
  Route::delete('pegawai/hapus/{id}', 'App\Http\Controllers\PegawaiController@delete');

  // Master Anggota
  Route::get('anggota', 'App\Http\Controllers\AnggotaController@index');
  Route::get('anggota/tambah', 'App\Http\Controllers\AnggotaController@tambah');
  Route::post('anggota/tambah', 'App\Http\Controllers\AnggotaController@store');
  Route::get('anggota/detail/{id}', 'App\Http\Controllers\AnggotaController@detail');
  Route::get('anggota/kartu/{id}', 'App\Http\Controllers\AnggotaController@kartu');
  Route::get('anggota/edit/{id}', 'App\Http\Controllers\AnggotaController@edit');
  Route::put('anggota/edit/{id}', 'App\Http\Controllers\AnggotaController@update');
  Route::delete('anggota/hapus/{id}', 'App\Http\Controllers\AnggotaController@delete');

  // Master Kategori
  Route::get('kategori', 'App\Http\Controllers\KategoriController@index');
  Route::get('kategori/tambah', 'App\Http\Controllers\KategoriController@tambah');
  Route::post('kategori/tambah', 'App\Http\Controllers\KategoriController@store');
  Route::get('kategori/edit/{id}', 'App\Http\Controllers\KategoriController@edit');
  Route::put('kategori/edit/{id}', 'App\Http\Controllers\KategoriController@update');
  Route::delete('kategori/hapus/{id}', 'App\Http\Controllers\KategoriController@delete');

  // Master Buku
  Route::get('buku', 'App\Http\Controllers\BukuController@index');
  Route::get('buku/tambah', 'App\Http\Controllers\BukuController@tambah');
  Route::post('buku/tambah', 'App\Http\Controllers\BukuController@store');
  Route::get('buku/detail/{id}', 'App\Http\Controllers\BukuController@detail');
  Route::get('buku/edit/{id}', 'App\Http\Controllers\BukuController@edit');
  Route::put('buku/edit/{id}', 'App\Http\Controllers\BukuController@update');
  Route::delete('buku/hapus/{id}', 'App\Http\Controllers\BukuController@delete');

  // Transaksi Peminjaman
  Route::get('peminjaman', 'App\Http\Controllers\PinjamController@index');
  Route::get('peminjaman/tambah', 'App\Http\Controllers\PinjamController@tambah');
  Route::post('peminjaman/tambah', 'App\Http\Controllers\PinjamController@store');
  Route::get('peminjaman/detail/{id}', 'App\Http\Controllers\PinjamController@detail');
  Route::delete('peminjaman/hapus/{id}', 'App\Http\Controllers\PinjamController@delete');

  // Transaksi Pengembalian
  Route::get('pengembalian', 'App\Http\Controllers\KembaliController@index');
  Route::get('pengembalian/kembalikan', 'App\Http\Controllers\KembaliController@kembalikan');
  Route::put('pengembalian/kembalikan/{id}', 'App\Http\Controllers\KembaliController@update');
  Route::get('pengembalian/detail/{id}', 'App\Http\Controllers\KembaliController@detail');
  Route::delete('pengembalian/hapus/{id}', 'App\Http\Controllers\KembaliController@delete');

  // Transaksi Insiden
  Route::get('insiden', 'App\Http\Controllers\InsidenController@index');
  Route::get('insiden/tambah', 'App\Http\Controllers\InsidenController@tambah');
  Route::post('insiden/tambah', 'App\Http\Controllers\InsidenController@store');
  Route::get('insiden/detail/{id}', 'App\Http\Controllers\InsidenController@detail');
  Route::delete('insiden/hapus/{id}', 'App\Http\Controllers\InsidenController@delete');

  // Pengaturan
  Route::get('pengaturan', 'App\Http\Controllers\PengaturanController@index');
  Route::put('pengaturan', 'App\Http\Controllers\PengaturanController@update');

  // Get Data
  Route::get('get/anggota/{id}', 'App\Http\Controllers\GetController@anggota');
  Route::get('get/buku/{id}', 'App\Http\Controllers\GetController@buku');
  Route::get('get/pinjam/{id}', 'App\Http\Controllers\GetController@pinjam');
  Route::get('get/detail/{id}', 'App\Http\Controllers\GetController@detail');
  Route::get('get/pinjaman/{id}', 'App\Http\Controllers\GetController@pinjaman');
});

<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
  public function index()
  {
    $data = DB::table('anggota')->orderBy('id_anggota', 'desc')->get();

    return view('anggota.index', compact('data'));
  }

  public function tambah()
  {
    return view('anggota.tambah');
  }

  public function store(Request $request)
  {
    $kode_anggota = rand(000000, 999999);

    try {
      DB::table('anggota')->insert([
        'kode_anggota'    => $kode_anggota,
        'nama'            => $request->nama,
        'jenis_kelamin'   => $request->jenis_kelamin,
        'alamat'          => $request->alamat,
        'no_hp'           => $request->no_hp,
      ]);

      return redirect('anggota')->with('message', 'Data berhasil ditambahkan!');
    } catch (Exception $ex) {
      return back()->withInput()->with('message', $ex->getMessage());
    }
  }

  public function detail($id)
  {
    $data = DB::table('anggota')->where('kode_anggota', $id)->get()->first();

    return view('anggota.detail', compact('data'));
  }

  public function kartu($id)
  {
    $data = DB::table('anggota')->where('kode_anggota', $id)->get()->first();

    return view('anggota.kartu', compact('data'));
  }

  public function edit($id)
  {
    $data = DB::table('anggota')->where('kode_anggota', $id)->get()->first();

    return view('anggota.edit', compact('data'));
  }

  public function update(Request $request, $id)
  {
    try {
      DB::table('anggota')->where('kode_anggota', $id)->update([
        'nama'            => $request->nama,
        'jenis_kelamin'   => $request->jenis_kelamin,
        'alamat'          => $request->alamat,
        'no_hp'           => $request->no_hp,
      ]);

      return redirect('anggota')->with('message', 'Data berhasil diedit!');
    } catch (Exception $ex) {
      return back()->withInput()->with('message', $ex->getMessage());
    }
  }

  public function delete($id)
  {
    try {
      DB::table('anggota')->where('kode_anggota', $id)->delete();

      return redirect('anggota')->with('message', 'Data berhasil dihapus!');
    } catch (Exception $ex) {
      return redirect('anggota')->with('error', $ex->getMessage());
    }
  }
}

<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
  public function index()
  {
    $data = DB::table('pegawai')->orderBy('id_pegawai', 'desc')->get();

    return view('pegawai.index', compact('data'));
  }

  public function tambah()
  {
    return view('pegawai.tambah');
  }

  public function store(Request $request)
  {
    try {
      DB::table('pegawai')->insert([
        'nama'      => $request->nama,
        'alamat'    => $request->alamat,
        'no_hp'     => $request->no_hp,
        'username'  => $request->username,
        'password'  => Hash::make($request->password),
        'status'    => $request->status,
      ]);

      return redirect('pegawai')->with('message', 'Data berhasil ditambahkan!');
    } catch (Exception $ex) {
      return back()->withInput()->with('message', $ex->getMessage());
    }
  }

  public function detail($id)
  {
    $data = DB::table('pegawai')->where('id_pegawai', $id)->get()->first();

    return view('pegawai.detail', compact('data'));
  }

  public function edit($id)
  {
    $data = DB::table('pegawai')->where('id_pegawai', $id)->get()->first();

    return view('pegawai.edit', compact('data'));
  }

  public function update(Request $request, $id)
  {
    try {
      DB::table('pegawai')->where('id_pegawai', $id)->update([
        'nama'      => $request->nama,
        'alamat'    => $request->alamat,
        'no_hp'     => $request->no_hp,
        'status'    => $request->status,
      ]);

      return redirect('pegawai')->with('message', 'Data berhasil diedit!');
    } catch (Exception $ex) {
      return back()->withInput()->with('message', $ex->getMessage());
    }
  }

  public function delete($id)
  {
    try {
      DB::table('pegawai')->where('id_pegawai', $id)->delete();

      return redirect('pegawai')->with('message', 'Data berhasil dihapus!');
    } catch (Exception $ex) {
      return redirect('pegawai')->with('error', $ex->getMessage());
    }
  }
}

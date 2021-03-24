<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
  public function index()
  {
    $data = DB::table('buku as a')
      ->join('kategori as b', 'a.id_kategori', '=', 'b.id_kategori')
      ->orderBy('a.id_buku', 'desc')->get();

    return view('buku.index', compact('data'));
  }

  public function tambah()
  {
    $kategori = DB::table('kategori')->get();

    return view('buku.tambah', compact('kategori'));
  }

  public function store(Request $request)
  {
    $kode_buku = 'BK' . rand(000000, 999999);
    try {
      DB::table('buku')->insert([
        'id_kategori'   => $request->id_kategori,
        'kode_buku'     => $kode_buku,
        'judul'         => $request->judul,
        'pengarang'     => $request->pengarang,
        'penerbit'      => $request->penerbit,
        'tahun'         => $request->tahun,
        'harga'         => $request->harga,
        'jumlah'        => $request->jumlah,
      ]);

      return redirect('buku')->with('message', 'Data berhasil ditambahkan!');
    } catch (Exception $ex) {
      return back()->withInput()->with('message', $ex->getMessage());
    }
  }

  public function detail($id)
  {
    $data = DB::table('buku as a')
      ->join('kategori as b', 'a.id_kategori', '=', 'b.id_kategori')
      ->where('a.kode_buku', $id)->get()->first();

    return view('buku.detail', compact('data'));
  }

  public function edit($id)
  {
    $data = DB::table('buku as a')
      ->join('kategori as b', 'a.id_kategori', '=', 'b.id_kategori')
      ->where('a.kode_buku', $id)->get()->first();

    $kategori = DB::table('kategori')->get();

    return view('buku.edit', compact('data', 'kategori'));
  }

  public function update(Request $request, $id)
  {
    try {
      DB::table('buku')->where('kode_buku', $id)->update([
        'id_kategori'   => $request->id_kategori,
        'judul'         => $request->judul,
        'pengarang'     => $request->pengarang,
        'penerbit'      => $request->penerbit,
        'tahun'         => $request->tahun,
        'harga'         => $request->harga,
        'jumlah'        => $request->jumlah,
      ]);

      return redirect('buku')->with('message', 'Data berhasil diedit!');
    } catch (Exception $ex) {
      return back()->withInput()->with('message', $ex->getMessage());
    }
  }

  public function delete($id)
  {
    try {
      DB::table('buku')->where('kode_buku', $id)->delete();

      return redirect('buku')->with('message', 'Data berhasil dihapus!');
    } catch (Exception $ex) {
      return redirect('buku')->with('error', $ex->getMessage());
    }
  }
}

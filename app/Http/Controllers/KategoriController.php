<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
  public function index()
  {
    $data = DB::table('kategori')->orderBy('id_kategori', 'desc')->get();
    return view('kategori.index', compact('data'));
  }

  public function tambah()
  {
    return view('kategori.tambah');
  }

  public function store(Request $request)
  {
    try {
      DB::table('kategori')->insert([
        'kategori'  => $request->kategori,
      ]);

      return redirect('kategori')->with('message', 'Data berhasil ditambahkan!');
    } catch (Exception $ex) {
      return back()->withInput()->with('message', $ex->getMessage());
    }
  }

  public function edit($id)
  {
    $data = DB::table('kategori')->where('id_kategori', $id)->first();
    return view('kategori.edit', compact('data'));
  }

  public function update(Request $request, $id)
  {
    try {
      DB::table('kategori')->where('id_kategori', $id)->update([
        'kategori'  => $request->kategori,
      ]);

      return redirect('kategori')->with('message', 'Data berhasil diedit!');
    } catch (Exception $ex) {
      return back()->withInput()->with('message', $ex->getMessage());
    }
  }

  public function delete($id)
  {
    try {
      DB::table('kategori')->where('id_kategori', $id)->delete();

      return redirect('kategori')->with('message', 'Data berhasil dihapus!');
    } catch (Exception $ex) {
      return redirect('kategori')->with('error', $ex->getMessage());
    }
  }
}

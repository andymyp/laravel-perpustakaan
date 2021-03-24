<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsidenController extends Controller
{
  public function index()
  {
    $data = DB::table('insiden as a')
      ->join('anggota as b', 'a.kode_anggota', '=', 'b.kode_anggota')
      ->orderBy('a.id_insiden', 'desc')->get();

    return view('insiden.index', compact('data'));
  }

  public function tambah()
  {
    $p = DB::table('pengaturan')->where('id_pengaturan', '1')->get()->first();

    return view('insiden.tambah', compact('p'));
  }

  public function store(Request $request)
  {
    try {
      $insiden = DB::table('insiden')->insert([
        'kode_pinjam'    => $request->kode_pinjam,
        'kode_anggota'   => $request->kode_anggota,
        'tanggal'        => date('Y-m-d', strtotime($request->tanggal)),
        'ganti_rugi'     => $request->ganti_rugi,
      ]);

      if ($insiden) {
        try {
          $pinjam = DB::table('pinjam')->where('kode_pinjam', $request->kode_pinjam)->get()->first();

          if ($pinjam->status == 'P') {
            DB::table('pinjam')->where('kode_pinjam', $request->kode_pinjam)->update(['status' => 'I']);
          }

          for ($i = 0; $i < count($request->kode_buku); $i++) {
            DB::table('detail')->where('kode_pinjam', $request->kode_pinjam)->where('kode_buku', $request->kode_buku[$i])
              ->where('status', 'P')->limit(1)->update(['status' => $request->insiden[$i]]);
          }

          return redirect('insiden')->with('message', 'Insiden berhasil ditambahkan!');
        } catch (Exception $ex) {
          return back()->withInput()->with('message', $ex->getMessage());
        }
      }
    } catch (Exception $ex) {
      return back()->withInput()->with('message', $ex->getMessage());
    }
  }

  public function detail($id)
  {
    $insiden = DB::table('insiden as a')
      ->join('anggota as b', 'a.kode_anggota', '=', 'b.kode_anggota')
      ->where('a.kode_pinjam', $id)->get()->first();

    $detail = DB::table('detail as a')
      ->join('buku as b', 'a.kode_buku', '=', 'b.kode_buku')
      ->where('a.kode_pinjam', $id)->where('status', 'R')->orWhere('status', 'H')->get();

    return view('insiden.detail', compact('insiden', 'detail'));
  }

  public function delete($id)
  {
    try {
      $update = DB::table('detail')->where('kode_pinjam', $id)->where('status', 'R')->orWhere('status', 'H')
        ->update(['status' => 'P']);

      if ($update) {
        try {
          DB::table('insiden')->where('kode_pinjam', $id)->delete();

          return redirect('insiden')->with('message', 'Insiden berhasil dihapus!');
        } catch (Exception $ex) {
          return back()->withInput()->with('message', $ex->getMessage());
        }
      }
    } catch (Exception $ex) {
      return back()->withInput()->with('message', $ex->getMessage());
    }
  }
}

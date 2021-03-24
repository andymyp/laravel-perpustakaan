<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetController extends Controller
{
  public function anggota($id)
  {
    $data = DB::table('anggota')->where('kode_anggota', $id)->get()->first();
    return $data ? response()->json($data) : response()->json('notfound');
  }

  public function buku($id)
  {
    $data = DB::table('buku')->where('kode_buku', $id)->get()->first();
    return $data ? response()->json($data) : response()->json('notfound');
  }

  public function pinjam($id)
  {
    $data = DB::table('pinjam')->where('kode_anggota', $id)->get()->first();
    return ($data && $data->status == 'P') ? response()->json($data) : response()->json('notfound');
  }

  public function detail($id)
  {
    $data = DB::table('detail as a')
      ->join('buku as b', 'a.kode_buku', '=', 'b.kode_buku')
      ->where('a.kode_pinjam', $id)->get();

    return $data ? response()->json($data) : response()->json('notfound');
  }

  public function pinjaman($id)
  {
    $data = DB::table('pinjam')->where('kode_anggota', $id)->get()->first();
    return $data ? response()->json($data) : response()->json('notfound');
  }
}

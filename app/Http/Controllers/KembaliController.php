<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KembaliController extends Controller
{
  public function index()
  {
    $data = DB::table('pinjam as a')
      ->join('anggota as b', 'a.kode_anggota', '=', 'b.kode_anggota')
      ->where('a.status', 'K')
      ->orderBy('a.id_pinjam', 'desc')->get();

    return view('kembali.index', compact('data'));
  }

  public function kembalikan()
  {
    $p = DB::table('pengaturan')->where('id_pengaturan', '1')->get()->first();

    return view('kembali.kembalikan', compact('p'));
  }

  public function update(Request $request, $id)
  {
    try {
      $kembali = DB::table('pinjam')->where('kode_pinjam', $id)->update([
        'tanggal_kembali'   => date('Y-m-d', strtotime($request->tanggal_kembali)),
        'telat'             => $request->telat,
        'denda'             => $request->denda,
        'status'            => 'K',
      ]);

      if ($kembali) {
        try {
          for ($i = 0; $i < count($request->kode_buku); $i++) {
            $buku = DB::table('buku')->where('kode_buku', $request->kode_buku[$i])->get()->first();
            $jumlahBuku = $buku->jumlah;

            $total = intval($jumlahBuku) + 1;

            $upBuku = DB::table('buku')->where('kode_buku', $request->kode_buku[$i])->update(['jumlah' => $total]);
          }

          if ($upBuku) {
            try {
              for ($x = 0; $x < count($request->kode_buku); $x++) {
                DB::table('detail')->where('kode_pinjam', $id)->where('kode_buku', $request->kode_buku[$x])
                  ->limit(1)->update(['status' => 'K']);
              }

              return redirect('pengembalian')->with('message', 'Buku berhasil dikembalikan!');
            } catch (Exception $ex) {
              return back()->withInput()->with('message', $ex->getMessage());
            }
          }
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
    $pinjam = DB::table('pinjam as a')
      ->join('anggota as b', 'a.kode_anggota', '=', 'b.kode_anggota')
      ->where('a.kode_pinjam', $id)->get()->first();

    $detail = DB::table('detail as a')
      ->join('buku as b', 'a.kode_buku', '=', 'b.kode_buku')
      ->where('a.kode_pinjam', $id)->where('status', 'K')->get();

    return view('kembali.detail', compact('pinjam', 'detail'));
  }

  public function delete($id)
  {
    try {
      $update = DB::table('pinjam')->where('kode_pinjam', $id)->update([
        'tanggal_kembali'   => null,
        'telat'             => null,
        'denda'             => null,
        'status'            => 'P',
      ]);

      if ($update) {
        try {
          $detail = DB::table('detail')->where('kode_pinjam', $id)->where('status', 'K')->get();

          foreach ($detail as $dt) {
            $kode_buku = $dt->kode_buku;

            $buku = DB::table('buku')->where('kode_buku', $kode_buku)->get()->first();
            $jumlahBuku = $buku->jumlah;

            $total = intval($jumlahBuku) - 1;

            $upBuku = DB::table('buku')->where('kode_buku', $kode_buku)->update(['jumlah' => $total]);
          }

          if ($upBuku) {
            try {
              DB::table('detail')->where('kode_pinjam', $id)->where('status', 'K')->update(['status' => 'P']);

              return redirect('pengembalian')->with('message', 'Pengembalian berhasil dihapus!');
            } catch (Exception $ex) {
              return back()->withInput()->with('message', $ex->getMessage());
            }
          }
        } catch (Exception $ex) {
          return back()->withInput()->with('message', $ex->getMessage());
        }
      }
    } catch (Exception $ex) {
      return back()->withInput()->with('message', $ex->getMessage());
    }
  }
}

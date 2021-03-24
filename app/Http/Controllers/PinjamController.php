<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PinjamController extends Controller
{
  public function index()
  {
    $data = DB::table('pinjam as a')
      ->join('anggota as b', 'a.kode_anggota', '=', 'b.kode_anggota')
      ->orderBy('a.id_pinjam', 'desc')->get();

    return view('pinjam.index', compact('data'));
  }

  public function tambah()
  {
    // Pengaturan
    $p = DB::table('pengaturan')->where('id_pengaturan', '1')->get()->first();

    return view('pinjam.tambah', compact('p'));
  }

  public function store(Request $request)
  {
    $kode_pinjam = 'PJ' . rand(000000, 999999);

    try {
      $pinjam = DB::table('pinjam')->insert([
        'kode_pinjam'     => $kode_pinjam,
        'kode_anggota'    => $request->kode_anggota,
        'tanggal_pinjam'  => date('Y-m-d', strtotime($request->tanggal_pinjam)),
        'harus_kembali'   => date('Y-m-d', strtotime($request->harus_kembali)),
        'status'          => 'P',
      ]);

      if ($pinjam) {
        try {
          for ($i = 0; $i < count($request->kode_buku); $i++) {
            $dataDetail = array(
              'kode_pinjam'   => $kode_pinjam,
              'kode_buku'     => $request->kode_buku[$i],
              'status'        => 'P',
            );

            $insertDetail[] = $dataDetail;
          }

          $detail = DB::table('detail')->insert($insertDetail);

          if ($detail) {
            try {
              for ($x = 0; $x < count($request->kode_buku); $x++) {
                $kode_buku = $request->kode_buku[$x];

                $dataBuku = DB::table('buku')->where('kode_buku', $kode_buku)->get()->first();
                $jumlahBuku = $dataBuku->jumlah;

                $jumlah = intval($jumlahBuku) - 1;

                DB::table('buku')->where('kode_buku', $kode_buku)->update(['jumlah' => $jumlah]);
              }

              return redirect('peminjaman')->with('message', 'Data berhasil disimpan!');
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
      ->where('a.kode_pinjam', $id)->get();

    return view('pinjam.detail', compact('pinjam', 'detail'));
  }

  public function delete($id)
  {
    $detail = DB::table('detail')->where('kode_pinjam', $id)->get();

    foreach ($detail as $dt) {
      $kode_buku = $dt->kode_buku;

      $buku = DB::table('buku')->where('kode_buku', $kode_buku)->get()->first();
      $jumlahBuku = $buku->jumlah;

      $total = intval($jumlahBuku) + 1;

      $update = DB::table('buku')->where('kode_buku', $kode_buku)->update(['jumlah' => $total]);
    }

    if ($update) {
      try {
        DB::table('pinjam')->where('kode_pinjam', $id)->delete();

        return redirect('peminjaman')->with('message', 'Data berhasil dihapus!');
      } catch (Exception $ex) {
        return redirect('peminjaman')->with('error', $ex->getMessage());
      }
    } else {
      return redirect('peminjaman')->with('error', 'Gagal update stok buku!');
    }
  }
}

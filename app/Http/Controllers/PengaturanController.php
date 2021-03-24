<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaturanController extends Controller
{
  public function index()
  {
    $data = DB::table('pengaturan')->where('id_pengaturan', '1')->get()->first();
    return view('pengaturan.index', compact('data'));
  }

  public function update(Request $request)
  {
    try {
      DB::table('pengaturan')->where('id_pengaturan', '1')->update([
        'maks_pinjam'   => $request->maks_pinjam,
        'maks_lama'     => $request->maks_lama,
        'denda'         => $request->denda,
      ]);

      return redirect('pengaturan')->with('success', 'Pengaturan berhasil disimpan.');
    } catch (Exception $ex) {
      return back()->withInput()->with('error', $ex->getMessage());
    }
  }
}

@extends('layouts.app', ['page' => __('kembali'), 'title' => __('Detail Pengembalian')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon card-header-success">
            <div class="row">
              <div class="col-6 text-left">
                <div class="card-icon">
                  <i class="material-icons">search</i>
                </div>
                <h4 class="card-title">Detail Pengembalian</h4>
              </div>
              <div class="col-6 text-right">
                <a class="btn btn-sm btn-warning btn-round" href="javascript:history.back()">
                  <i class="material-icons" style="width: auto">backspace</i> Kembali
                </a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group bmd-form-group">
                  <label>Kode Pinjam</label>
                  <input type="text" class="form-control" value="{{ $pinjam->kode_pinjam }}" readonly>
                </div>
                <div class="form-group bmd-form-group">
                  <label>Kode Anggota</label>
                  <input type="text" class="form-control" value="{{ $pinjam->kode_anggota }}" readonly>
                </div>
                <div class="form-group bmd-form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" value="{{ $pinjam->nama }}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group bmd-form-group">
                      <label>Tanggal Pinjam</label>
                      <input type="text" class="form-control"
                        value="{{ date('d-m-Y', strtotime($pinjam->tanggal_pinjam)) }}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group bmd-form-group">
                      <label>Tgl. Harus Kembali</label>
                      <input type="text" class="form-control"
                        value="{{ date('d-m-Y', strtotime($pinjam->harus_kembali)) }}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group bmd-form-group">
                      <label>Tanggal Kembali</label>
                      <input type="text" class="form-control"
                        value="{{ date('d-m-Y', strtotime($pinjam->tanggal_kembali)) }}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group bmd-form-group">
                      <label>Telat</label>
                      <input type="text" class="form-control" value="{{ $pinjam->telat }}" readonly>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group bmd-form-group">
                      <label>Denda (Rp)</label>
                      <input type="text" class="form-control" value="{{ $pinjam->denda }}" readonly>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-hover table-bordered">
                  <thead style="background: linear-gradient(60deg, #66bb6a, #43a047); color:#fff; font-weight: bold;">
                    <tr>
                      <th width="120"><b>Kode Buku</b></th>
                      <th><b>Judul</b></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($detail as $dt)
                    <tr>
                      <td>{{ $dt->kode_buku }}</td>
                      <td>{{ $dt->judul }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card-footer pull-right">
            <button type="button" class="btn btn-fill btn-default" onclick="history.back()">Kembali</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
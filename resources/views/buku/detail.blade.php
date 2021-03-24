@extends('layouts.app', ['page' => __('buku'), 'title' => __('Detail Buku')])

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
                <h4 class="card-title">Detail Buku</h4>
              </div>
              <div class="col-6 text-right">
                <a class="btn btn-sm btn-warning btn-round" href="javascript:history.back()">
                  <i class="material-icons" style="width: auto">backspace</i> Kembali
                </a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group bmd-form-group">
              <label>Judul</label>
              <input type="text" class="form-control" value="{{ $data->judul }}" readonly>
            </div>
            <div class="form-group bmd-form-group">
              <label>Kategori</label>
              <input type="text" class="form-control" value="{{ $data->kategori }}" readonly>
            </div>
            <div class="form-group bmd-form-group">
              <label>Pengarang</label>
              <input type="text" class="form-control" value="{{ $data->pengarang }}" readonly>
            </div>
            <div class="form-group bmd-form-group">
              <label>Penerbit</label>
              <input type="text" class="form-control" value="{{ $data->penerbit }}" readonly>
            </div>
            <div class="form-group bmd-form-group">
              <label>Tahun</label>
              <input type="text" class="form-control" value="{{ $data->tahun }}" readonly>
            </div>
            <div class="form-group bmd-form-group">
              <label>Harga (Rp)</label>
              <input type="text" class="form-control" value="{{ $data->harga }}" readonly>
            </div>
            <div class="form-group bmd-form-group">
              <label>Jumlah</label>
              <input type="text" class="form-control" value="{{ $data->jumlah }}" readonly>
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
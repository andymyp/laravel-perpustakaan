@extends('layouts.app', ['page' => __('pegawai'), 'title' => __('Detail Pegawai')])

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
                <h4 class="card-title">Detail Pegawai</h4>
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
              <label>Nama</label>
              <input type="text" class="form-control" value="{{ $data->nama }}" readonly>
            </div>
            <div class="form-group bmd-form-group">
              <label>Alamat</label>
              <input type="text" class="form-control" value="{{ $data->alamat }}" readonly>
            </div>
            <div class="form-group bmd-form-group">
              <label>No. Hp</label>
              <input type="text" class="form-control" value="{{ $data->no_hp }}" readonly>
            </div>
            <div class="form-group bmd-form-group">
              <label>Username</label>
              <input type="text" class="form-control" value="{{ $data->username }}" readonly>
            </div>
            <div class="form-group bmd-form-group">
              <label>Status</label>
              <input type="text" class="form-control" value="{{ $data->status }}" readonly>
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
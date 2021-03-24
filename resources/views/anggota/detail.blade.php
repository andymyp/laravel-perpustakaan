@extends('layouts.app', ['page' => __('anggota'), 'title' => __('Detail Anggota')])

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
                <h4 class="card-title">Detail Anggota</h4>
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
              <label>Jenis Kelamin</label>
              <input type="text" class="form-control" value="{{ $data->jenis_kelamin }}" readonly>
            </div>
            <div class="form-group bmd-form-group">
              <label>Alamat</label>
              <input type="text" class="form-control" value="{{ $data->alamat }}" readonly>
            </div>
            <div class="form-group bmd-form-group">
              <label>No. Hp</label>
              <input type="text" class="form-control" value="{{ $data->no_hp }}" readonly>
            </div>
          </div>
          <div class="card-footer pull-right">
            <button type="button" class="btn btn-fill btn-default" onclick="history.back()">Kembali</button>
            <button type="button" class="btn btn-fill btn-success" onclick="cetak()">Cetak Kartu Anggota</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<iframe src="{{ url('anggota/kartu/'.$data->kode_anggota) }}" frameborder="0" style="display: none;"
  id="framePrint"></iframe>

@push('js')
<script>
  function cetak(){
    $('#framePrint').get(0).contentWindow.print();
  }
</script>
@endpush
@endsection
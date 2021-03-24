@extends('layouts.app', ['page' => __('pegawai'), 'title' => __('Tambah Pegawai')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon card-header-primary">
            <div class="row">
              <div class="col-6 text-left">
                <div class="card-icon">
                  <i class="material-icons">add</i>
                </div>
                <h4 class="card-title">Tambah Pegawai</h4>
              </div>
              <div class="col-6 text-right">
                <a class="btn btn-sm btn-warning btn-round" href="javascript:history.back()">
                  <i class="material-icons" style="width: auto">backspace</i> Kembali
                </a>
              </div>
            </div>
          </div>
          <form id="formField" method="post" action="{{ url('pegawai/tambah') }}" autocomplete="off"
            onsubmit="return handleSubmit()">
            <div class="card-body">
              {{ csrf_field() }}
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Nama</label>
                <input type="text" class="form-control" name="nama" required>
              </div>
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Alamat</label>
                <input type="text" class="form-control" name="alamat" required>
              </div>
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">No. Hp</label>
                <input type="text" class="form-control" name="no_hp" required>
              </div>
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Username</label>
                <input type="text" class="form-control" name="username" required>
              </div>
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Password</label>
                <input type="text" class="form-control" minlength="6" name="password" required>
              </div>
              <div class="form-group bmd-form-group">
                <label class="bmd-label">Status</label>
                <select class="selectpicker" name="status" title="- Pilih -" data-style="select-with-transition"
                  required>
                  <option value="aktif">Aktif</option>
                  <option value="non-aktif">Non-Aktif</option>
                </select>
              </div>
            </div>
            <div class="card-footer pull-right">
              <button type="submit" class="btn btn-fill btn-primary mr-2">Tambah</button>
              <button type="button" class="btn btn-fill btn-default" onclick="history.back()">Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@push('js')
@if (session('message'))
<script>
  $.notify({
    icon: 'notifications',
    title: 'Data gagal ditambahkan!',
    message: '{{ session("message") }}',
  },{
    type: 'danger',
    timer: 3000,
  });
</script>
@endif

<script>
  function handleSubmit(){
    var form = $('#formField')[0];
    
    if(form.checkValidity()){
      Swal.fire({
        title: 'Yakin ingin ditambahkan?',
        text: 'Anda akan menambahkan data baru',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Tambah',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.value) {
          form.submit();
        }
      });
    }
    return false;
  }
</script>
@endpush
@endsection
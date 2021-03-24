@extends('layouts.app', ['page' => __('anggota'), 'title' => __('Edit Anggota')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon card-header-warning">
            <div class="row">
              <div class="col-6 text-left">
                <div class="card-icon">
                  <i class="material-icons">edit</i>
                </div>
                <h4 class="card-title">Edit Anggota</h4>
              </div>
              <div class="col-6 text-right">
                <a class="btn btn-sm btn-warning btn-round" href="javascript:history.back()">
                  <i class="material-icons" style="width: auto">backspace</i> Kembali
                </a>
              </div>
            </div>
          </div>
          <form id="formField" method="post" action="{{ url('anggota/edit/'.$data->kode_anggota) }}" autocomplete="off"
            onsubmit="return handleSubmit()">
            <div class="card-body">
              {{ csrf_field() }}
              {{ method_field('put') }}
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Nama</label>
                <input type="text" class="form-control" name="nama" value="{{ $data->nama }}" required>
              </div>
              <div class="form-group bmd-form-group">
                <label class="bmd-label">Jenis Kelamin</label>
                <select class="selectpicker" name="jenis_kelamin" title="- Pilih -" data-style="select-with-transition"
                  required>
                  <option value="Laki-laki" {{ $data->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                  </option>
                  <option value="Perempuan" {{ $data->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                  </option>
                </select>
              </div>
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Alamat</label>
                <input type="text" class="form-control" name="alamat" value="{{ $data->alamat }}" required>
              </div>
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">No. Hp</label>
                <input type="text" class="form-control" name="no_hp" value="{{ $data->no_hp }}" required>
              </div>
            </div>
            <div class="card-footer pull-right">
              <button type="submit" class="btn btn-fill btn-primary mr-2">Simpan</button>
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
    title: 'Data gagal diedit!',
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
        title: 'Yakin ingin disimpan?',
        text: 'Anda akan mengubah data ini',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Simpan',
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
@extends('layouts.app', ['page' => __('pengaturan'), 'title' => __('Pengaturan')])

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
                  <i class="material-icons">settings</i>
                </div>
                <h4 class="card-title">Pengaturan</h4>
              </div>
            </div>
          </div>
          <form id="formField" method="post" action="{{ url('pengaturan') }}" autocomplete="off"
            onsubmit="return handleSubmit()">
            <div class="card-body">
              {{ csrf_field() }}
              {{ method_field('put') }}
              <div class="row col-md-10">
                <label class="col-md-6 col-form-label">Maksimal Jumlah Pinjam : </label>
                <div class="col-md-4">
                  <div class="form-group input-group">
                    <input type="number" class="form-control" name="maks_pinjam" min="1"
                      value="{{ $data->maks_pinjam }}" required>
                    <div class="input-group-prepend">
                      <span class="input-group-text">Buku</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row col-md-10">
                <label class="col-md-6 col-form-label">Maksimal Lama Pinjam : </label>
                <div class="col-md-4">
                  <div class="form-group input-group">
                    <input type="number" class="form-control" name="maks_lama" min="1" value="{{ $data->maks_lama }}"
                      required>
                    <div class="input-group-prepend">
                      <span class="input-group-text">Hari</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row col-md-10">
                <label class="col-md-6 col-form-label">Denda Harian : </label>
                <div class="col-md-4">
                  <div class="form-group input-group">
                    <input type="text" class="form-control money" name="denda" value="{{ $data->denda }}" required>
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rupiah</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer text-center">
              <div></div>
              <button type="submit" class="btn btn-fill btn-success mr-2">Simpan</button>
              <div></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@push('js')
@if (session('success'))
<script>
  $.notify({
    icon: 'notifications',
    message: '{{ session("success") }}',
  },{
    type: 'success',
    timer: 3000,
  });
</script>
@endif
@if (session('error'))
<script>
  $.notify({
    icon: 'notifications',
    title: 'Pengaturan gagal disimpan!',
    message: '{{ session("error") }}',
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
        text: 'Anda akan menyimpan pengaturan ini',
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
@extends('layouts.app', ['page' => __('pegawai'), 'title' => __('Pegawai')])

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
                  <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title">Pegawai</h4>
              </div>
              <div class="col-6 text-right">
                <a class="btn btn-sm btn-primary btn-round" href="{{ url('pegawai/tambah') }}">
                  <i class="material-icons" style="width: auto">add</i> Tambah
                </a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="material-datatables">
              <table class="table table-hover datatable">
                <thead class=" text-primary">
                  <tr>
                    <th align="center" width="20">No.</th>
                    <th>Nama</th>
                    <th>No. Hp</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th class="text-right">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $dt)
                  <tr>
                    <td></td>
                    <td>{{ $dt->nama }}</td>
                    <td>{{ $dt->no_hp }}</td>
                    <td>{{ $dt->username }}</td>
                    <td>
                      @if ($dt->status == 'aktif')
                      <span class="badge badge-success">Aktif</span>
                      @else
                      <span class="badge badge-danger">Non-Aktif</span>
                      @endif
                    </td>
                    <td class="td-actions text-right">
                      <a class="btn btn-success btn-round" title="Detail"
                        href="{{ url('pegawai/detail/'.$dt->id_pegawai) }}">
                        <i class="material-icons">search</i>
                      </a>
                      <a class="btn btn-warning btn-round" title="Edit"
                        href="{{ url('pegawai/edit/'.$dt->id_pegawai) }}">
                        <i class="material-icons">edit</i>
                      </a>
                      <a class="btn btn-danger btn-round" title="Hapus" href="javascript:;"
                        onclick="handleDelete('{{ url('pegawai/hapus/'.$dt->id_pegawai) }}')">
                        <i class="material-icons">delete</i>
                      </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<form id="formDelete" action="" method="POST" style="display: none;">
  {{ csrf_field() }}
  {{ method_field('delete') }}
</form>

@push('js')
@if (session('message'))
<script>
  $.notify({
    icon: 'notifications',
    message: '{{ session("message") }}',
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
    message: '{{ session("error") }}',
  },{
    type: 'danger',
    timer: 3000,
  });
</script>
@endif

<script>
  function handleDelete(url){
    Swal.fire({
      title: 'Yakin ingin dihapus?',
      text: 'Anda akan menghapus data ini',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: 'red',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        $('#formDelete').attr('action', url);
        $('#formDelete')[0].submit();
      }
    });
  }
</script>
@endpush
@endsection
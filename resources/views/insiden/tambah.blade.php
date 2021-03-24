@extends('layouts.app', ['page' => __('insiden'), 'title' => __('Tambah Insiden')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form id="formField" method="post" action="{{ url('insiden/tambah') }}" autocomplete="off"
          onsubmit="return handleSubmit()">
          {{ csrf_field() }}
          <div class="card">
            <div class="card-header card-header-icon card-header-primary">
              <div class="row">
                <div class="col-6 text-left">
                  <div class="card-icon">
                    <i class="material-icons">add</i>
                  </div>
                  <h4 class="card-title">Tambah Insiden</h4>
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
                  <div class="form-group input-group bmd-form-group">
                    <label>Kode Anggota</label>
                    <input type="text" class="form-control" id="kode_anggota" name="kode_anggota" required>
                    <div class="input-group-prepend">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-round btn-sm btn-primary" id="cariAnggota">
                          <i class="material-icons">search</i> Cari
                        </button>
                      </span>
                    </div>
                  </div>
                  <div class="form-group bmd-form-group">
                    <label>Kode Pinjam</label>
                    <input type="text" class="form-control" id="kode_pinjam" name="kode_pinjam" required readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group bmd-form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="nama" readonly>
                  </div>
                  <div class="form-group bmd-form-group">
                    <label>Tanggal Sekarang</label>
                    <input type="text" class="form-control" id="tanggal_sekarang" name="tanggal"
                      value="{{ date('d-m-Y') }}" required readonly>
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
                    <thead style="background: linear-gradient(60deg, #ab47bc, #8e24aa); color:#fff;">
                      <tr>
                        <th width="120"><b>Kode Buku</b></th>
                        <th><b>Judul</b></th>
                        <th width="150"><b>Pilih Insiden</b></th>
                        <th width="150"><b>Harga</b></th>
                      </tr>
                    </thead>
                    <tbody id="tableBuku"></tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="card-footer pull-right">
              <button type="button" class="btn btn-fill btn-default" onclick="history.back()">Batal</button>
              <button type="submit" class="btn btn-fill btn-success mr-2" id="btnSimpan">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('js')
@if (session('message'))
<script>
  $.notify({
    icon: 'notifications',
    title: 'Data gagal disimpan!',
    message: '{{ session("message") }}',
  },{
    type: 'danger',
    timer: 3000,
  });
</script>
@endif

<script>
  $(document).ready(function(){
    $('body').on('click', '#cariAnggota', function(){
      var kode = $('#kode_anggota').val();
      
      $.ajax({
        url: '{{ url("get/anggota") }}/' + kode,
        type: 'get',
        dataType: 'json',
        success: function(res){
          if(res == 'notfound'){
            notify('Anggota tidak ditemukan!', '', 'warning');
            $('#nama').val('');
            $('#kode_pinjam').val('');
          } else {
            $.ajax({
              url: '{{ url("get/pinjaman") }}/' + kode,
              type: 'get',
              dataType: 'json',
              success: function(res2){
                if(res2 == 'notfound'){
                  notify('Tidak ada peminjaman untuk anggota tersebut.', '', 'warning');
                } else {
                  $('#kode_pinjam').val(res2.kode_pinjam);
                  $('#nama').val(res.nama);

                  $.ajax({
                    url: '{{ url("get/detail") }}/' + res2.kode_pinjam,
                    type: 'get',
                    dataType: 'json',
                    success: function(res3){
                      if(res3 == 'notfound'){
                        notify('Tidak ada peminjaman untuk anggota tersebut.', '', 'warning');
                      } else {
                        var buku;
                        var total = 0;

                        for (var i = 0; i < res3.length; i++){
                          if(res3[i].status == 'P'){
                            var insiden = '<select class="form-control" name="insiden[]" required>' +
                                            '<option value="">- Pilih -</option>' +
                                            '<option value="R">Rusak</option>' +
                                            '<option value="H">Hilang</option>' +
                                          '</select>';

                            buku += '<tr>' +
                                      '<td>' + res3[i].kode_buku + '<input type="hidden" name="kode_buku[]" value="'+res3[i].kode_buku+'"></td>' +
                                      '<td>' + res3[i].judul + '</td>' +
                                      '<td class="text-center">'+insiden+'</td>' +
                                      '<td>Rp. ' + res3[i].harga + '</td>' +
                                    '</tr>';

                            total += parseInt(res3[i].harga.replaceAll('.', ''));
                          }
                        }

                        total = total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

                        buku += '<tr>' +
                                  '<td colspan="3" class="text-right"><b>Total</b></td>' +
                                  '<td><b>Rp. ' + total + '<input type="hidden" name="ganti_rugi" value="'+total+'"></b></td>' +
                                '</tr>';
                        
                        $('#tableBuku').append(buku);
                      }
                    }
                  });
                }
              }
            });
          }
        }
      });
    });
  });

  function notify(title, message, type){
    $.notify({
      icon: 'notifications',
      title: title,
      message: message,
    },{
      type: type,
      timer: 3000,
    });
  }

  function handleSubmit(){
    var form = $('#formField')[0];
    
    if(form.checkValidity()){
      Swal.fire({
        title: 'Yakin ingin disimpan?',
        text: 'Anda akan menyimpan data ini',
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
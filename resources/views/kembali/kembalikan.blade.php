@extends('layouts.app', ['page' => __('kembali'), 'title' => __('Kembalikan')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form id="formField" method="post" autocomplete="off" onsubmit="return handleSubmit()">
          {{ csrf_field() }}
          {{ method_field('put') }}
          <div class="card">
            <div class="card-header card-header-icon card-header-primary">
              <div class="row">
                <div class="col-6 text-left">
                  <div class="card-icon">
                    <i class="material-icons">reply</i>
                  </div>
                  <h4 class="card-title">Kembalikan</h4>
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
                    <input type="text" class="form-control" id="kode_anggota" required>
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
                  <div class="form-group bmd-form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="nama" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group bmd-form-group">
                        <label>Tanggal Pinjam</label>
                        <input type="text" class="form-control" id="tanggal_pinjam" required readonly>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group bmd-form-group">
                        <label>Tgl. Harus Kembali</label>
                        <input type="text" class="form-control" id="harus_kembali" required readonly>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group bmd-form-group">
                        <label>Tanggal Sekarang</label>
                        <input type="text" class="form-control" id="tanggal_sekarang" name="tanggal_kembali"
                          value="{{ date('d-m-Y') }}" required readonly>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group bmd-form-group">
                        <label>Telat</label>
                        <input type="text" class="form-control" id="telat" name="telat" required readonly>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group bmd-form-group">
                        <label>Denda (Rp)</label>
                        <input type="text" class="form-control" id="denda" name="denda" required readonly>
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
                    <thead style="background: linear-gradient(60deg, #ab47bc, #8e24aa); color:#fff;">
                      <tr>
                        <th width="120"><b>Kode Buku</b></th>
                        <th><b>Judul</b></th>
                        <th width="80" class="text-center"><b>Pilih</b></th>
                      </tr>
                    </thead>
                    <tbody id="tableBuku"></tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="card-footer pull-right">
              <button type="button" class="btn btn-fill btn-default" onclick="history.back()">Batal</button>
              <button type="submit" class="btn btn-fill btn-success mr-2" id="btnSimpan">Kembalikan</button>
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
            $('#status_pinjam').val('');
            $('#kode_pinjam').val('');
          } else {
            $.ajax({
              url: '{{ url("get/pinjam") }}/' + kode,
              type: 'get',
              dataType: 'json',
              success: function(res2){
                if(res2 == 'notfound'){
                  notify('Tidak ada peminjaman untuk anggota tersebut.', '', 'warning');
                } else {
                  var tanggal_pinjam = new Date(res2.tanggal_pinjam);
                  var harus_kembali = new Date(res2.harus_kembali);
                  var tanggal_sekarang = new Date();
                  var telat = Math.round(Math.round((tanggal_sekarang.getTime() - harus_kembali.getTime()) / (24*60*60*1000)));
                  var denda = 0;

                  tanggal_pinjam = ((tanggal_pinjam.getDate() > 9) ? tanggal_pinjam.getDate() : ('0' + tanggal_pinjam.getDate())) + '-' 
                  + ((tanggal_pinjam.getMonth() > 8) ? (tanggal_pinjam.getMonth() + 1) : ('0' + (tanggal_pinjam.getMonth() + 1))) + '-' 
                  + tanggal_pinjam.getFullYear();

                  harus_kembali = ((harus_kembali.getDate() > 9) ? harus_kembali.getDate() : ('0' + harus_kembali.getDate())) + '-'
                  + ((harus_kembali.getMonth() > 8) ? (harus_kembali.getMonth() + 1) : ('0' + (harus_kembali.getMonth() + 1))) + '-'
                  + harus_kembali.getFullYear();

                  if(parseInt(telat) >= 1) {
                    denda = parseInt('{{ str_replace(".", "", $p->denda) }}') * telat;
                  } else {
                    telat = 0;
                  }

                  $('#kode_pinjam').val(res2.kode_pinjam);
                  $('#nama').val(res.nama);
                  $('#tanggal_pinjam').val(tanggal_pinjam);
                  $('#harus_kembali').val(harus_kembali);
                  $('#telat').val(telat + ' Hari');
                  $('#denda').val(denda).mask('000.000.000.000.000', { reverse: true });

                  $.ajax({
                    url: '{{ url("get/detail") }}/' + res2.kode_pinjam,
                    type: 'get',
                    dataType: 'json',
                    success: function(res3){
                      if(res3 == 'notfound'){
                        notify('Tidak ada peminjaman untuk anggota tersebut.', '', 'warning');
                      } else {
                        var buku;

                        for (var i = 0; i < res3.length; i++){
                          if(res3[i].status == 'P'){
                            var checkbox = '<div class="form-check mr-auto ml-3 mt-3">' +
                                            '<label class="form-check-label">' +
                                              '<input class="form-check-input" type="checkbox" name="kode_buku[]" value="' + res3[i].kode_buku + '">' +
                                              '<span class="form-check-sign">' +
                                                '<span class="check"></span>' +
                                              '</span>' +
                                            '</label>' +
                                          '</div>';

                            buku += '<tr>' +
                                      '<td>' + res3[i].kode_buku + '</td>' +
                                      '<td>' + res3[i].judul + '</td>' +
                                      '<td class="text-center">'+checkbox+'</td>' +
                                    '</tr>';
                          }
                        }
                        
                        $('#tableBuku').append(buku);
                        $('#formField').attr('action', '{{ url("pengembalian/kembalikan") }}/' + res2.kode_pinjam);
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
        title: 'Yakin ingin dikembalikan?',
        text: 'Anda akan mengembalikan buku ini',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Kembalikan',
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
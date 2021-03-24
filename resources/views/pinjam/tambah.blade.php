@extends('layouts.app', ['page' => __('pinjam'), 'title' => __('Tambah Peminjaman')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form id="formField" method="post" action="{{ url('peminjaman/tambah') }}" autocomplete="off"
          onsubmit="return handleSubmit()">
          {{ csrf_field() }}
          <div class="card">
            <div class="card-header card-header-icon card-header-primary">
              <div class="row">
                <div class="col-6 text-left">
                  <div class="card-icon">
                    <i class="material-icons">add</i>
                  </div>
                  <h4 class="card-title">Tambah Peminjaman</h4>
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
                <div class="col-md-6"></div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group bmd-form-group">
                        <label>Tanggal Sekarang</label>
                        <input type="text" class="form-control" name="tanggal_pinjam" value="{{ date('d-m-Y') }}"
                          required readonly>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group bmd-form-group">
                        <label>Tgl. Harus Kembali</label>
                        <input type="text" class="form-control" name="harus_kembali"
                          value="{{ date('d-m-Y', strtotime('+'.$p->maks_lama.' day')) }}" required readonly>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <br>
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
                    <label>Nama</label>
                    <input type="text" class="form-control" id="nama" readonly>
                  </div>
                  <div class="form-group bmd-form-group">
                    <label>Status Pinjaman</label>
                    <input type="text" class="form-control" id="status_pinjam" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group input-group bmd-form-group">
                    <label>Kode Buku</label>
                    <input type="text" class="form-control" id="kode_buku">
                    <div class="input-group-prepend">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-round btn-sm btn-primary" id="cariBuku">
                          <i class="material-icons">search</i> Cari
                        </button>
                      </span>
                    </div>
                  </div>
                  <div class="form-group bmd-form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" id="judul" readonly>
                  </div>
                  <div class="form-group input-group bmd-form-group">
                    <label>Jumlah</label>
                    <input type="number" class="form-control" min="1" max="{{ $p->maks_pinjam }}" id="jumlah">
                    <div class="input-group-prepend">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-round btn-sm btn-primary" id="tambahBuku">
                          <i class="material-icons">add</i> Tambah Buku
                        </button>
                      </span>
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
                        <th width="80" class="text-center"><b>Aksi</b></th>
                      </tr>
                    </thead>
                    <tbody id="tableBuku"></tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="card-footer pull-right">
              <button type="button" class="btn btn-fill btn-default" onclick="history.back()">Batal</button>
              <button type="submit" class="btn btn-fill btn-success mr-2" id="btnSimpan"
                style="display: none">Simpan</button>
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
  var jumlahBuku = 0;

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
          } else {
            $('#nama').val(res.nama);

            $.ajax({
              url: '{{ url("get/pinjam") }}/' + kode,
              type: 'get',
              dataType: 'json',
              success: function(res2){
                if(res2 == 'notfound'){
                  $('#status_pinjam').val('Tidak ada pinjaman');
                } else {
                  $('#status_pinjam').val('Ada pinjaman!');
                }
              }
            });
          }
        }
      });
    });

    $('body').on('click', '#cariBuku', function(){
      if($('#nama').val() == ''){
        notify('Cari data anggota dahulu!', '', 'warning');
        return false;
      }

      if($('#status_pinjam').val() == 'Ada pinjaman!'){
        notify('Ada pinjaman yang belum dikembalikan!', '', 'warning');
        return false;
      }

      var kode = $('#kode_buku').val();
      
      $.ajax({
        url: '{{ url("get/buku") }}/' + kode,
        type: 'get',
        dataType: 'json',
        success: function(res){
          if(res == 'notfound'){
            notify('Buku tidak ditemukan!', '', 'warning');
            $('#judul').val('');
          } else {
            if(res.jumlah == '0'){
              notify('Stok buku habis!', '', 'warning');
            } else {
              $('#judul').val(res.judul);
              $('#jumlah').attr('data-stok', res.jumlah);
            }
          }
        }
      });
    });

    $('body').on('click', '#tambahBuku', function(){
      var stok = $('#jumlah').attr('data-stok');
      var kode = $('#kode_buku').val();
      var judul = $('#judul').val();
      var jumlah = $('#jumlah').val();
      var buku;

      if(judul == ''){
        notify('Cari data buku dahulu!', '', 'warning');
        return false;
      }

      if(jumlah == '' || parseInt(jumlah) == 0){
        notify('Input jumlah buku yang ingin dipinjam!', '', 'warning');
        return false;
      }
      
      if(parseInt(jumlah) > parseInt(stok)){
        notify('Stok buku yang tersedia ada ' + stok + ' buku!', '', 'warning');
        return false;
      }

      if($('#tableBuku').find('#'+kode).length >= 1){
        notify('Buku ini sudah ditambahkan!', '', 'warning');
        return false;
      }

      if(parseInt(jumlah) > parseInt('{{ $p->maks_pinjam }}') || (parseInt(jumlahBuku) + parseInt(jumlah)) > parseInt('{{ $p->maks_pinjam }}')){
        notify('Maksimal buku yang dipinjam adalah {{ $p->maks_pinjam }} buku!', '', 'warning');
        return false;
      }

      var btnAksi = '<button type="button" class="btn btn-sm btn-fab btn-danger btn-round" onclick="hapus('+kode+')">' +
                      '<i class="material-icons">delete</i>' +
                    '</button>';
      
      for (var $i = 0; $i < parseInt(jumlah); $i++) {
        buku += '<tr id="' + kode + '">' +
                  '<td>' + kode + '<input type="hidden" name="kode_buku[]" value="'+ kode +'"></td>' +
                  '<td>' + judul + '</td>' +
                  '<td class="text-center">' + btnAksi + '</td>' +
                '</tr>';
      }

      $('#tableBuku').append(buku);
      jumlahBuku = (parseInt(jumlahBuku) + parseInt(jumlah));

      $('#jumlah').attr('data-stok', '');
      $('#kode_buku').val('');
      $('#judul').val('');
      $('#jumlah').val('');

      cekBuku();
    });
  });

  function hapus(id){
    jumlahBuku = (parseInt(jumlahBuku) - 1);
    $(id).remove();
    cekBuku();
  }

  function cekBuku(){
    if(parseInt(jumlahBuku) < 1){
      $('#btnSimpan').hide();
    } else {
      $('#btnSimpan').show();
    }
  }

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
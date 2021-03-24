<div class="sidebar" data-color="purple" data-background-color="black"
  data-image="{{ asset('material') }}/img/login_bg.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="/" class="simple-text logo-mini">
      <img width="100%" src="{{ asset('material') }}/img/favicon.png" />
    </a>
    <a href="/" class="simple-text logo-normal">
      {{ __('SI Perpustakaan') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <div class="user">
      <div class="photo">
        <i class="material-icons">person</i>
      </div>
      <div class="user-info">
        <a data-toggle="collapse" href="#userInfo" class="username">
          <span>
            {{ Auth::user()->nama }}
            <b class="caret"></b>
          </span>
        </a>
        <div class="collapse {{ $page == 'profile' ? 'show' : '' }}" id="userInfo">
          <ul class="nav">
            <li class="nav-item {{ $page == 'profile' ? 'active' : '' }}">
              <a class="nav-link" href="#">
                <span class="sidebar-mini"> P </span>
                <span class="sidebar-normal"> Profile </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn-logout" href="javascript:;">
                <span class="sidebar-mini"> L </span>
                <span class="sidebar-normal"> Logout </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <ul class="nav">
      <li class="nav-item {{ $page == 'dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('dashboard') }}">
          <i class="material-icons">dashboard</i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li
        class="nav-item {{ ($page == 'pegawai' || $page == 'anggota' || $page == 'kategori' || $page == 'buku') ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#masterData">
          <i class="material-icons">folder</i>
          <p>{{ __('Master') }}
            <b class="caret"></b>
          </p>
        </a>
        <div
          class="collapse {{ ($page == 'pegawai' || $page == 'anggota' || $page == 'kategori' || $page == 'buku') ? 'show' : '' }}"
          id="masterData">
          <ul class="nav">
            <li class="nav-item {{ $page == 'pegawai' ? 'active' : '' }}">
              <a class="nav-link" href="{{ url('pegawai') }}">
                <span class="sidebar-mini"> PG </span>
                <span class="sidebar-normal"> {{ __('Pegawai') }} </span>
              </a>
            </li>
            <li class="nav-item {{ $page == 'anggota' ? 'active' : '' }}">
              <a class="nav-link" href="{{ url('anggota') }}">
                <span class="sidebar-mini"> AG </span>
                <span class="sidebar-normal"> {{ __('Anggota') }} </span>
              </a>
            </li>
            <li class="nav-item {{ $page == 'kategori' ? 'active' : '' }}">
              <a class="nav-link" href="{{ url('kategori') }}">
                <span class="sidebar-mini"> KT </span>
                <span class="sidebar-normal"> {{ __('Kategori') }} </span>
              </a>
            </li>
            <li class="nav-item {{ $page == 'buku' ? 'active' : '' }}">
              <a class="nav-link" href="{{ url('buku') }}">
                <span class="sidebar-mini"> BK </span>
                <span class="sidebar-normal"> {{ __('Buku') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($page == 'pinjam' || $page == 'kembali' || $page == 'insiden') ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#transaksiData">
          <i class="material-icons">folder</i>
          <p>{{ __('Transaksi') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($page == 'pinjam' || $page == 'kembali' || $page == 'insiden') ? 'show' : '' }}"
          id="transaksiData">
          <ul class="nav">
            <li class="nav-item {{ $page == 'pinjam' ? 'active' : '' }}">
              <a class="nav-link" href="{{ url('peminjaman') }}">
                <span class="sidebar-mini"> PJ </span>
                <span class="sidebar-normal"> {{ __('Peminjaman') }} </span>
              </a>
            </li>
            <li class="nav-item {{ $page == 'kembali' ? 'active' : '' }}">
              <a class="nav-link" href="{{ url('pengembalian') }}">
                <span class="sidebar-mini"> PB </span>
                <span class="sidebar-normal"> {{ __('Pengembalian') }} </span>
              </a>
            </li>
            <li class="nav-item {{ $page == 'insiden' ? 'active' : '' }}">
              <a class="nav-link" href="{{ url('insiden') }}">
                <span class="sidebar-mini"> IN </span>
                <span class="sidebar-normal"> {{ __('Insiden') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ $page == 'pengaturan' ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('pengaturan') }}">
          <i class="material-icons">settings</i>
          <p>{{ __('Pengaturan') }}</p>
        </a>
      </li>
      <li class="nav-item {{ $page == 'laporan' ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('laporan') }}">
          <i class="material-icons">report</i>
          <p>{{ __('Laporan') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>
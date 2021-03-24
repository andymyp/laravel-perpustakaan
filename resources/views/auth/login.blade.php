@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('Login')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-md-9 ml-auto mr-auto mb-3 text-center">
      <h3 class="m-0">
        {{ __('Sistem Informasi Perpustakaan') }}
      </h3>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('login') }}" autocomplete="off">
        @csrf

        <div class="card card-login mb-3">
          <div class="card-header card-header-primary text-center">
            <h4 class="card-title"><strong>{{ __('Login') }}</strong></h4>
          </div>
          <div class="card-body">
            <p class="card-description text-center">{{ __('Silahkan login') }}</p>
            <div class="bmd-form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">person</i>
                  </span>
                </div>
                <input type="text" name="username" class="form-control" placeholder="{{ __('Username') }}" required>
              </div>
            </div>
            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="password" id="password" class="form-control"
                  placeholder="{{ __('Password') }}" required>
              </div>
            </div>

          </div>
          <div class="card-footer justify-content-center">
            <div class="col-6 text-left">
              <div class="form-check mr-auto ml-3 mt-3">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                  {{ __('Ingat saya') }}
                  <span class="form-check-sign">
                    <span class="check"></span>
                  </span>
                </label>
              </div>
            </div>
            <div class="col-6 text-right">
              <button type="submit" class="btn btn-primary">{{ __('Masuk') }}</button>
            </div>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-12 text-center">
          <a href="/" class="text-light">
            <small>{{ __('Copyright © 2020 - Sistem Informasi Perpustakaan') }}</small>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@push('js')
@if ($errors->has('username'))
<script>
  $.notify({
    icon: 'notifications',
    message: '{{ $errors->first("username") }}',
  },{
    type: 'danger',
    timer: 3000,
  });
</script>
@endif
@endpush
@endsection
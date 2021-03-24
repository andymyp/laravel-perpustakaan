@guest()
@include('auth.login')
@endguest

@auth
@include('dashboard')
@endauth
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  /**
   * Get the login username to be used by the controller.
   *
   * @return string
   */
  public function username()
  {
    return 'username';
  }

  /**
   * Attempt to log the user into the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return bool
   */
  protected function attemptLogin(Request $request)
  {
    $request->merge(['status' => 'aktif']);

    return $this->guard()->attempt(
      $this->credentials($request),
      $request->filled('remember')
    );
  }

  /**
   * Get the needed authorization credentials from the request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  protected function credentials(Request $request)
  {
    return $request->only($this->username(), 'password', 'status', 'status');
  }

  /**
   * Get the failed login response instance.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Symfony\Component\HttpFoundation\Response
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  protected function sendFailedLoginResponse(Request $request)
  {
    // Load user from database
    $user = User::where($this->username(), $request->{$this->username()})->first();

    // check username
    if (!$user) {
      $errors = [$this->username() => 'Username tidak terdaftar.'];
    }
    // and check password match
    if ($user && $request->username == $user->username && !Hash::check($request->password, $user->password)) {
      $errors = [$this->username() => 'Password salah.'];
    }
    // and active is not active
    if ($user && $request->username == $user->username && Hash::check($request->password, $user->password) && $user->status != 'aktif') {
      $errors = [$this->username() => 'Status pegawai non-aktif.'];
    }

    if ($request->expectsJson()) {
      return response()->json($errors, 422);
    }
    return redirect()->back()
      ->withInput($request->only($this->username(), 'remember'))
      ->withErrors($errors);
  }
}

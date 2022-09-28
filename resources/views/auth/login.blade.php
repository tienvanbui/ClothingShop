@extends('layouts.app')
@section('title')
  Login
@endsection
@section('content')
  <div class="row justify-content-center">
    <div class="col-md-6 text-center mb-5">
      <h2 class="heading-section">{{ __('Login Your Account') }}</h2>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
      <div class="login-wrap p-0">
        <h3 class="mb-4 text-center">Have an account?</h3>
        <form method="POST" action="{{ route('login') }}" class="signin-form">
          @csrf
          <div class="form-group">
            <input id="username" type="username" class="form-control @error('username') is-invalid @enderror"
              name="username" value="{{ old('username') }}" required autocomplete="username" autofocus
              placeholder="Username">
            @error('username')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
            @if (session('status'))
              <div class="alert alert-danger">{{ session('status') }}</div>
            @endif
          </div>
          <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
              name="password" required autocomplete="current-password" placeholder="Password">

            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-secondary text-white submit px-3 form-control">
              {{ __('Sign In') }}
            </button>
          </div>
          <div class="form-group d-md-flex">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember"
                {{ old('remember') ? 'checked' : '' }}>

              <label class="form-check-label checkbox-wrap checkbox-primary" for="remember">
                {{ __('Remember Me') }}
              </label>
            </div>
            <div class="w-50 text-md-right">
              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="color: #fff">
                  {{ __('Forgot Password?') }}
                </a>
              @endif
            </div>
          </div>
        </form>
        <p class="w-100 text-center">&mdash; Or Sign In With &mdash;</p>
        <div class="social d-flex text-center">
          <a href="{{ route('redirect-facebook') }}" class="px-2 py-2 mr-md-1 rounded"><span
              class="ion-logo-facebook mr-2"></span> Facebook</a>
          <a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Twitter</a>
        </div>
        <p class="w-100 text-center">&mdash; Create New Account &mdash;</p>
        <div class="social d-flex text-center">
          <a href="{{ route('register') }}" class="px-2 py-2 mr-md-1 rounded"><span
              class="ion-logo-facebook mr-2"></span>Register</a>
        </div>
      </div>
    </div>
  </div>
@endsection

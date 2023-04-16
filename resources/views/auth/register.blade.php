@extends('layouts.app')
@section('title')
  Đăng ký
@endsection
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header bg-dark text-white">{{ __('Đăng ký') }}</div>
          <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end"
                  style="color: black;">{{ __('Tên') }}</label>

                <div class="col-md-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror "
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                    style="background-color: black;opacity:0.7;">

                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end"
                  style="color: black;">{{ __('Email') }}</label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email"
                    style="background-color: black;opacity:0.7;" >

                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="username" class="col-md-4 col-form-label text-md-end"
                  style="color: black;">{{ __('Tên đăng nhập') }}</label>

                <div class="col-md-6">
                  <input id="username" type="username" class="form-control @error('username') is-invalid @enderror"
                    name="username" required autocomplete="username" style="background-color: black;opacity:0.7;"
                    >

                  @error('username')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="address" class="col-md-4 col-form-label text-md-end"
                  style="color: black;">{{ __('Địa chỉ') }}</label>

                <div class="col-md-6">
                  <input id="address" type="address" class="form-control @error('address') is-invalid @enderror"
                    name="address" required autocomplete="address" style="background-color: black;opacity:0.7;"
                    >

                  @error('address')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="phoneNumber" class="col-md-4 col-form-label text-md-end"
                  style="color: black;">{{ __('Số điện thoại') }}</label>

                <div class="col-md-6">
                  <input id="phoneNumber" type="phoneNumber"
                    class="form-control @error('phoneNumber') is-invalid @enderror" name="phoneNumber" required
                    autocomplete="phoneNumber" style="background-color: black;opacity:0.7;" >

                  @error('phoneNumber')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end"
                  style="color: black;">{{ __('Mật khẩu') }}</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password" style="background-color: black;opacity:0.7;"
                    >

                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-end"
                  style="color: black;">{{ __('Xác nhận mật khẩu') }}</label>

                <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password" style="background-color: black;opacity:0.7;"
                    >
                </div>
              </div>
              <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-dark">
                    {{ __('Đăng ký') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('title')
  Tạo thông tin tài khoản
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tài khoản</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                <li><a href="{{ route('manage_user.index') }}" class="fw-normal">Danh sách tài khoản</a></li>
              </ol>
              <a href="{{ route('manage_user.create') }}"
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo
                tài khoản</a>
            </div>
          </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <div class="row">
      <h1 class="text-center my-4">TẠO THÔNG TIN TÀI KHOẢN</h1>
      <form action="{{ route('manage_user.store') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="name">Tên:</label>
          <input type="text" class="form-control" id="name" aria-describedby="name" name="name"
            value="{{ old('name') }}">
          @include('common.singleAlertError', ['field' => 'name'])
        </div>
        <div class="form-group">
          <label for="username">Tên đăng nhập:</label>
          <input type="text" class="form-control" id="username" aria-describedby="username" name="username"
            value="{{ old('username') }}">
          @include('common.singleAlertError', ['field' => 'username'])
        </div>
        <div class="form-group">
          <label for="password">Mật khẩu:</label>
          <input type="password" class="form-control" id="password" aria-describedby="password" name="password"
            value="{{ old('password') }}">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="text" class="form-control" id="email" aria-describedby="email" name="email"
            value="{{ old('email') }}">
          @include('common.singleAlertError', ['field' => 'email'])
        </div>
        <div class="form-group">
          <label for="phone">Số điện thoại:</label>
          <input type="text" class="form-control" id="phone" aria-describedby="phone" name="phoneNumber"
            value="{{ old('phoneNumber') }}">
          @include('common.singleAlertError', ['field' => 'phoneNumber'])
        </div>
        <div class="form-group">
          <label for="address">Địa chỉ:</label>
          <input type="text" class="form-control" id="address" aria-describedby="address" name="adrress"
            value="{{ old('adrress') }}">
          @include('common.singleAlertError', ['field' => 'adrress'])
        </div>
        <div class="form-group">
          <label for="status">Trạng thái:</label>
          <select name="status" id="status" class="form-control">
            <option value="1">Chặn</option>
            <option value="0">Hoạt động</option>
          </select>
        </div>
        <div class="form-group">
          <label for="role">Vai trò:</label>
          <select name="role_id" id="role" class="form-control">
            @foreach ($roles as $role)
              <option value="{{ $role->id }}">{{ $role->role_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary text-white mb-2">Lưu</button>
        </div>
      </form>
    </div>
  </div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')

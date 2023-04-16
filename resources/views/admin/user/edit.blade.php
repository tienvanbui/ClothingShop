@section('title')
  Cập nhật thôn tin tài khoản
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
                @if (auth()->user()->hasPermission('User_list'))
                
                <li><a href="{{ route('manage_user.index') }}" class="fw-normal">Danh sách tài khoản</a></li>
                @endif
              </ol>
              @if (auth()->user()->hasPermission('User_create'))

              <a href="{{ route('manage_user.create') }}"
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo
                tài khoản</a>
                @endif
            </div>
          </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <div class="row">
      <h1 class="text-center my-4">CẬP NHẬT THÔN TIN TÀI KHOẢN</h1>
      @include('common.message')
      <form action="{{ route('manage_user.update', ['manage_user' => $user->id]) }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
          <label for="name">Tên:</label>
          <input type="text" class="form-control" id="name" aria-describedby="name" name="name"
            value="{{ $user->name }}">
            @include('common.singleAlertError', ['field' => 'name'])
        </div>
        <div class="form-group">
          <label for="username">Tên đăng nhập:</label>
          <input type="text" class="form-control" id="username" aria-describedby="username" name="username"
            value="{{ $user->username }}">
            @include('common.singleAlertError', ['field' => 'username'])
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="text" class="form-control" id="email" aria-describedby="email" name="email"
            value="{{ $user->email }}">
            @include('common.singleAlertError', ['field' => 'email'])
        </div>
        <div class="form-group">
          <label for="phone">Số điện thoại:</label>
          <input type="text" class="form-control" id="phone" aria-describedby="phone" name="phoneNumber"
            value="{{ old('phoneNumber') }}">
            @include('common.singleAlertError', ['field' => 'phoneNumber'])
        </div>
        <div class="form-group">
          <label for="adrress">Địa chỉ:</label>
          <input type="text" class="form-control" id="adrress" aria-describedby="adrress" name="adrress"
            value="{{ old('adrress') }}">
            @include('common.singleAlertError', ['field' => 'adrress'])
        </div>
        <div class="form-group">
          <label for="status">Trạng thái:</label>
          <select name="status" id="status" class="form-control">
            <option value="1" @if(auth()->user()->status == 1) checked @endif>Chặn</option>
            <option value="0" @if(auth()->user()->status == 0) checked @endif>Hoạt động</option>
          </select>
          @include('common.singleAlertError', ['field' => 'status'])
        </div>
        <div class="form-group">
          <label for="role">Vai trò:</label>
          <select name="role_id" id="role" class="form-control">
            @foreach ($roles as $role)
              <option {{ $roleOfUser->contains('id', $role->id) ? 'selected' : '' }} value="{{ $role->id }}">
                {{ $role->role_name }}</option>
            @endforeach
          </select>
          @include('common.singleAlertError', ['field' => 'role_id'])
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary text-white mb-2">Cập nhật</button>
        </div>
      </form>
    </div>
  </div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')

@section('title')
  Danh sách vai trò người dùng
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Vai trò</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                <li><a href="{{ route('role.index') }}" class="fw-normal">Danh sách vai trò</a></li>
              </ol>
              <a href="{{ route('role.create') }}"
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo vai trò</a>
            </div>
          </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <div class="row">
      <div class="container">
        <h1 class="text-center">DANH SÁCH VAI TRÒ</h1>
        <div class="d-flex action-bar justify-content-between">
          @include('common.showPerPage')
          @include('common.search')
        </div>
        <div id="admin-data">
          @include('admin.role.role-item')
        </div>
        <input type="hidden" id="hidden_page_admin" value="1" />
        <input type="hidden" id="hidden_table" value="roles" />
        <input type="hidden" id="hidden_view" value="admin.role.role-item" />
        <input type="hidden" id="hidden_col" value="role_name" />
      </div>
    </div>
  </div>
@endsection
@include('layouts.admin..main')
@include('layouts.admin..footer')

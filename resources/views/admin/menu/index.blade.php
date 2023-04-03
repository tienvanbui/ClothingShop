@section('title')
  Mục lục
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Mục lục</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                @if (auth()->user()->hasPermission('Menu_list'))
                  <li><a href="{{ route('menu.index') }}" class="fw-normal">Danh sách mục lục</a></li>
                @endif
              </ol>
              @if (auth()->user()->hasPermission('Menu_create'))
                <a href="{{ route('menu.create') }}"
                  class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo
                  mục lục</a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="container">
<<<<<<< HEAD
        <h1 class="text-center">MENU</h1>
=======
        <h1 class="text-center mt-4">MỤC LỤC</h1>
>>>>>>> 4318ef38fa794457b12c41f5f72b711fe1242a06
        @include('common.message')
        <div class="d-flex action-bar justify-content-between">
          @include('common.showPerPage')
          @include('common.search')
        </div>
        <div id="admin-data">
          @include('admin.menu.menu-item')
        </div>
        <input type="hidden" id="hidden_page_admin" value="1" />
        <input type="hidden" id="hidden_table" value="menus" />
        <input type="hidden" id="hidden_view" value="admin.menu.menu-item" />
        <input type="hidden" id="hidden_col" value="name" />
      </div>
    </div>
  </div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')

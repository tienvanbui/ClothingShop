@section('title')
  Danh sách trình chiếu
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Trình chiếu</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                @if (auth()->user()->hasPermission('Slider_list'))
                  <li><a href="{{ route('slider.index') }}" class="fw-normal">Danh sách trình chiếu</a></li>
                @endif
              </ol>
              @if (auth()->user()->hasPermission('Slider_list'))
                <a href="{{ route('slider.create') }}"
                  class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo
                  trình chiếu</a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="container">
        <h1 class="text-center my-4">DANH SÁCH TRÌNH CHIẾU</h1>
        @include('common.message')
        <div class="d-flex action-bar justify-content-between">
          @include('common.showPerPage')
          @include('common.search')
        </div>
        <div id="admin-data">
          @include('admin.slider.slider-item')
        </div>
        <input type="hidden" id="hidden_page_admin" value="1" />
        <input type="hidden" id="hidden_table" value="sliders" />
        <input type="hidden" id="hidden_view" value="admin.slider.slider-item" />
        <input type="hidden" id="hidden_col" value="title" />
      </div>
    </div>
  </div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')

@section('title')
  Tạo màu sắc sản phẩm
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Màu sắc sản phẩm</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                @if (auth()->user()->hasPermission('Color_list'))
                  <li><a href="{{ route('color.index') }}" class="fw-normal">Danh sách màu sắc</a></li>
                @endif
              </ol>
              @if (auth()->user()->hasPermission('Color_create'))
                <a href="{{ route('color.create') }}"
                  class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo
                  màu sắc sản phẩm</a>
              @endif
            </div>
          </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <h2 class="text-center mt-3">TẠO MÀU SẮC SẢN PHẨM</h2>
        <form method="POST" action="{{ route('color.store') }}">
          @csrf
          <div class="form-group">
            <label for="color_name">Tên màu sắc</label>
            <input type="text" class="form-control" id="color_name" aria-describedby="color_name"
              placeholder="Tên màu sắc sản phẩm" name="color_name" value="{{ old('color_name') }}">
            @include('common.singleAlertError', ['field' => 'color_name'])
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary ">Tạo</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')

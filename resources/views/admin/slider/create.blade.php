@section('title')
  Tạo trình chiếu
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
                <li><a href="{{ route('slider.index') }}" class="fw-normal">Danh sách trình chiếu</a></li>
              </ol>
              <a href="{{ route('slider.create') }}"
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo
                trình chiếu</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="container">
        <h1 class="text-center my-4">TẠO TRÌNH CHIẾU</h1>
        @include('common.message')
        <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" class="form-control" id="title" aria-describedby="title" name="title"
              value="{{ old('title') }}">
            @include('common.singleAlertError', ['field' => 'title'])
          </div>
          <div class="form-group">
            <label for="slider_image">Hình ảnh</label>
            <input type="file" class="form-control" id="slider_image" aria-describedby="slider_image"
              name="slider_image">
            @include('common.singleAlertError', ['field' => 'slider_image'])
          </div>
          <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" id="ck_editor_slider_create" cols="30" rows="10"></textarea>
            @include('common.singleAlertError', ['field' => 'description'])
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

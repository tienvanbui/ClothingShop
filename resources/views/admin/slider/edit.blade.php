@section('title')
  Cập nhật trình chiếu
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
        <h1 class="text-center my-4">CẬP NHẬT TRÌNH CHIẾU</h1>
        <form action="{{ route('slider.update', [
            'slider' => $slider->id,
        ]) }}" method="post"
          enctype="multipart/form-data">
          @method('put')
          @csrf
          <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" class="form-control" id="title" aria-describedby="title" name="title"
              value="{{ $slider->title }}">
            @include('common.singleAlertError', ['field' => 'title'])
          </div>
          <div class="form-group">
            <label for="slider_image">Hình ảnh</label>
            <input type="file" class="form-control-file" id="slider_image" aria-describedby="slider_image"
              name="slider_image">
            @include('common.singleAlertError', ['field' => 'slider_image'])
            <img src="{{ asset($slider->slider_image) }}" width="60%" height="40%">
          </div>
          <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" id="ck_editor_slider_edit" cols="30" rows="10">{{ $slider->description }}</textarea>
            @include('common.singleAlertError', ['field' => 'description'])
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary ">Cập nhật</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')

@section('title')
  Cập nhật banner
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Banner</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                <li><a href="{{ route('banner.index') }}" class="fw-normal">Danh sách banner</a></li>
              </ol>
              <a href="{{ route('banner.create') }}"
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo
                banner</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="container">
        <h1 class="text-center">CẬP NHẬT THÔNG TIN BANNER</h1>
        <form method="POST" action="{{ route('banner.update', ['banner' => $banner]) }}" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" class="form-control" id="title" aria-describedby="title" name="title"
              value="{{ $banner->title }}">
            @include('common.singleAlertError', ['field' => 'title'])
          </div>
          <div class="form-group">
            <label for="banner_image">Hình ảnh</label>
            <input type="file" class="form-control" id="banner_image" aria-describedby="banner_image"
              name="banner_image">
            <p><img src="{{ asset($banner->banner_image) }}" width="350rem"></p>
            @include('common.singleAlertError', ['field' => 'banner_image'])
          </div>
          <div class="form-group">
            <label for="content">Mô tả</label>
            <textarea name="content" cols="30" rows="5" class="form-control" id="ck_banner_edit">{{ $banner->content }}</textarea>
            @include('common.singleAlertError', ['field' => 'content'])
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

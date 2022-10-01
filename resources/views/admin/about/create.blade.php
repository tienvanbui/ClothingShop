@section('title')
  Tạo thông tin về chúng tôi
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Về chúng tôi</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                <li><a href="{{ route('about.index') }}" class="fw-normal">Thông tin về chúng tôi</a></li>
              </ol>
              <a href="{{ route('about.create') }}"
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo thông tin</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <h2 class="text-center mt-3">TẠO THÔNG TIN VỀ CHÚNG TÔI</h2>
        @include('common.message')
        <form method="POST" action="{{ route('about.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="title">Tiêu đề</label>
          <input type="text" class="form-control" id="title" aria-describedby="title" name="title" value="{{old('title')}}">
            @include('common.singleAlertError',['field'=>'title'])
          </div>
          <div class="form-group">
            <label for="thumbnail">Ảnh</label>
          <input type="file" class="form-control" id="thumbnail" aria-describedby="thumbnail" name="thumbnail">
            @include('common.singleAlertError',['field'=>'thumbnail'])
          </div>
          <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" cols="30" rows="10" class="form-control" id="ck_about_description_create"></textarea>
            @include('common.singleAlertError',['field'=>'description'])
          </div>
          <div class="form-group">
            <label for="quote">Trích dẫn</label>
            <textarea name="quote" cols="30" rows="5"  class="form-control" id="ck_about_quote_create" ></textarea>
            @include('common.singleAlertError',['field'=>'quote'])
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
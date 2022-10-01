@section('title')
  Cập nhật tin tức
@endsection
@section('js')
  <script src="https://cdn.tiny.cloud/1/r928fye7qnf2rd5f2rv7qbqs1tsx6kpqtcagu23qrx9syycv/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '.mytextarea'
    });
  </script>
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tin tức</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                <li><a href="{{ route('blog.index') }}" class="fw-normal">Danh sách tin tức</a></li>
              </ol>
              <a href="{{ route('blog.create') }}"
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo tin tức</a>
            </div>
          </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <h2 class="text-center mt-3">CẬP NHẬT TIN TỨC</h2>
        <form method="POST" action="{{ route('blog.update', ['blog' => $blog->id]) }}" enctype="multipart/form-data">
          @method('PUT')
          @csrf

          <div class="form-group">
            <label for="blog_name">Tiêu đề</label>
            <input type="text" class="form-control" id="blog_name" aria-describedby="blog_name"
              placeholder="Nhập tiêu đề" name="blog_name" value="{{ $blog->blog_name }}">
            @include('common.singleAlertError', ['field' => 'blog_name'])
          </div>

          <div class="form-group">
            <label for="thumbnail">Ảnh</label>
            <input type="file" class="form-control" id="thumbnail" name="thumbnail" aria-describedby="thumbnail">
            <img src="{{ asset($blog->thumbnail) }}" width="400px" height="400px">
            @include('common.singleAlertError', ['field' => 'thumbnail'])
          </div>

          <div class="form-group">
            <label>Danh mục tin tức</label>
            <select class="form-control" multiple="multiple" name="tags[]" style="height:100px">
              @foreach ($tagAll as $item)
                <option {{ $BlogHasTag->contains('id', $item->id) ? 'selected' : '' }} value="{{ $item->id }}">
                  {{ $item->tag_name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Nội dung</label>
            <textarea name="blog_content" class="form-control" rows="20" id="ck_editor_blog_edit">{{ $blog->blog_content }}</textarea>
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

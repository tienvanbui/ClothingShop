@section('title')
Tạo mục lục
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
            <h1 class="text-center mt-4">TẠO MỤC LỤC</h1>
            <form action="{{route('menu.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Tên:</label>
                    <input type="text" class="form-control" id="name" aria-describedby="name"
                        placeholder="Nhập tên mục lục" name="name">
                    @include('common.singleAlertError',['field'=>'name'])
                </div>
                <div class="form-group">
                    <label for="parent_id">Thuộc về mục lục:</label>
                    <select class="form-select" aria-label="Default select example" name="parent_id">
                        <option selected value="0">Chọn mục lục này</option>
                        {{!! $htmlOption!!}}
                    </select>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary ">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')
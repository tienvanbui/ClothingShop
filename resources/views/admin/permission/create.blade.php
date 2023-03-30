@section('title')
  Tạo quyền
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Quyền</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                <li><a class="fw-normal">Quyền</a></li>
              </ol>
              <a href="{{ route('permission.create') }}"
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo
                quyền</a>
            </div>
          </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <div class="row">
      <h1 class="text-center">TẠO QUYỀN</h1>
      @include('common.message')
      <form action="{{ route('permission.store') }}" method="post">
        @csrf
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Tên chức năng</label>
                <select name="permission_name"class="form-control">
                  @foreach (config('permissions.modul') as $modulItem)
                    <option value="{{ $modulItem }}">{{ $modulItem }}</option>
                  @endforeach

                </select>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="col-md-12">
              <div class="row">
                @foreach (config('permissions.modul_features') as $modulFeature)
                  <div class="card-body col-md-2 ml-5">
                    <h5 class="card-title">
                      <label>
                        <input type="checkbox" name="modulFeatures[]" multiple class="checkbox_childrent"
                          value={{ $modulFeature }}>
                      </label>
                      {{ ucwords($modulFeature) }}
                    </h5>
                  </div>
                @endforeach

              </div>
            </div>
          </div>

        </div>

        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary text-white mb-2">Tạo</button>
        </div>
      </form>
    </div>

  </div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')

@section('title')
  Chi tiết sản phẩm
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Sản phẩm</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                @if (auth()->user()->hasPermission('Product_list'))
                  <li><a href="{{ route('product.index') }}" class="fw-normal">Danh sách sản phẩm</a></li>
                @endif
              </ol>
              @if (auth()->user()->hasPermission('Product_create'))
                <a href="{{ route('product.create') }}"
                  class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo
                  sản phẩm</a>
              @endif
            </div>
          </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <div class="row">
      <div class="card text-center">
        <div class="card-header bg-dark">
          <h3 class="text-center text-white fst-italic mt-4">CHI TIẾT SẢN PHẨM</h3>
        </div>
        <div class="card-body">
          <table class="table table-hover table-striped">
            <thead style="background-color: black;">
              <tr>
                <th scope="col">Mô tả chi tiết</th>
                <th scope="col">Cân nặng</th>
                <th scope="col">Kích thước</th>
                <th scope="col">Chất liệu</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{!! $product->productDetail->description !!}</td>
                <td>{{ $product->productDetail->weight }}</td>
                <td>{{ $product->productDetail->dimension }}</td>
                <td>{{ $product->productDetail->materials }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="card text-center ">
        <div class="card-body">
          <table class="table  table-sm">
            <thead class="text-white " style="background-color: black;">
              <tr>
                <th scope="col">Màu sắc</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($product->colors as $item)
                <tr>
                  <td>{{ $item->color_name }}</td>
                </tr>
              @endforeach
              </tr>
            </tbody>
          </table>
          <table class="table table-bordered table-sm mt-5">
            <thead class="text-white" style="background-color: black;">
              <tr>
                <th scope="col">Kích cỡ</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($product->sizes as $item)
                <tr>
                  <td>{{ $item->size_name }}</td>
                </tr>
              @endforeach
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="card text-center">
        <div class="card-header bg-dark">
          <h3 class="text-center text-white fst-italic">Hình ảnh chi tiết</h3>
        </div>
        <div class="card-body">
          <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($product->productImages as $item)
              <div class="col">
                <div class="card h-100">
                  <img src="{{ asset($item->img_path) }}" class="card-img-top" alt="{{ $item->img_path_name }}"
                    height="40%" width="80px">
                  <div class="card-body">
                    @php
                      $nameProductImgArray = explode('.', $item->img_path_name);
                      $nameProductImg = $nameProductImgArray[0];
                    @endphp
                    <h5 class="card-title text-center">{{ $nameProductImg }}</h5>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')

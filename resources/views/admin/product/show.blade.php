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
      <div class="card-header bg-dark">
        <h3 class="text-center text-white mt-4">CHI TIẾT SẢN PHẨM</h3>
      </div>
      <div class="row d-flex" style="flex-direction: row">
        <div class="col col-6 mt-2" style="margin-left:22px">
          <p>
            <span style="font-weight:800">Màu sắc:</span>
            @php
              $stringColor = '';
            @endphp
            @foreach ($product->colors as $item)
              @php
                $stringColor .= $item->color_name . ', ';
              @endphp
            @endforeach
            <span> {{ trim($stringColor, ', ') }}</span>
          </p>
          <p>
            <span style="font-weight:800">Kích thước:</span>
            @php
              $stringSize = '';
            @endphp
            @foreach ($product->sizes as $item)
              @php
                $stringSize .= $item->size_name . ', ';
              @endphp
            @endforeach
            <span>{{ trim($stringSize, ', ') }}</span>
          </p>
        </div>
        <div class="col col-6 mt-2" style="margin-left:22px">
          {!! $product->productDetail->description !!}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="card text-center">
        <div class="card-body">
          <div class="row row-cols-1 row-cols-md-3 g-4 d-flex">
            @foreach ($product->productImages as $item)
              <div class="col">
                <div class="card">
                  <img src="{{ asset($item->img_path) }}" class="card-img-top" alt="{{ $item->img_path_name }}"
                    height="10%" width="80px">
                  <div class="card-body">
                    @php
                      $nameProductImgArray = explode('.', $item->img_path_name);
                      $nameProductImg = $nameProductImgArray[0];
                    @endphp
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="card text-center">
        
        <div class="card-body">
          <table class="table table-hover table-striped">
            <thead style="background-color: black;color:white">
              <tr class="bg-dark text-white">
                <th scope="col" style="color: white">Cân nặng</th>
                <th scope="col" style="color: white">Kích thước</th>
                <th scope="col" style="color: white">Chất liệu</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $product->productDetail->weight }}</td>
                <td>{{ $product->productDetail->dimension }}</td>
                <td>{{ $product->productDetail->materials }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  @endsection
  @include('layouts.admin.main')
  @include('layouts.admin.footer')

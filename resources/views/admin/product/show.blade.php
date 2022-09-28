@section('title')
  Show Product
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Product</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                <li><a href="{{ route('product.index') }}" class="fw-normal">Products List</a></li>
              </ol>
              <a href="{{ route('product.create') }}"
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create
                Product</a>
            </div>
          </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <div class="row">
      <div class="card text-center">
        <div class="card-header bg-dark">
          <h3 class="text-center text-white fst-italic">Detail Product</h3>
        </div>
        <div class="card-body">
          <table class="table table-hover table-striped">
            <thead style="background-color: black;">
              <tr>
                <th scope="col">Description</th>
                <th scope="col">Weight</th>
                <th scope="col">Dimension</th>
                <th scope="col">Materials</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{!!$product->productDetail->description !!}</td>
                <td>{{ $product->productDetail->weight}}</td>
                <td>{{ $product->productDetail->dimension}}</td>
                <td>{{ $product->productDetail->materials}}</td>
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
                <th scope="col">Color Name</th>
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
                <th scope="col">Size Name</th>
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
          <h3 class="text-center text-white fst-italic">Product Images</h3>
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
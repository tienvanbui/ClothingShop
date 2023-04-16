@section('title')
  Cập nhật sản phẩm
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
      <h1 class="text-center mt-3">CẬP NHẬT SẢN PHẨM</h1>
      @include('common.message')
      <form action="{{ route('product.update', ['product' => $product->id]) }}" method="post"
        enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group">
          <label for="product_name">Tên sản phẩm:</label>
          <input type="text" class="form-control" id="product_name" aria-describedby="product_name" name="product_name"
            value="{{ $product->product_name }}">
          @include('common.singleAlertError', ['field' => 'product_name'])
        </div>

        <div class="form-group">
          <label for="product_image">Ảnh sản phẩm:</label>
          <input type="file" class="form-control-file" name="product_image" id="product_image">
          <div id="featureImgHelpBlock" class="form-text text-dark">
            Ảnh phải địng dạng *jpeg, *png, *bmp, *gif, *svg.
          </div>
          <div class="card h-100" style="width: 18rem;">
            <img src="{{ asset($product->product_image) }}" class="card-img-top" alt="{{ $product->product_image_name }}"
              style="height: 100%">
            <div class="card-body">
              <p class="card-text text-center">{{ $product->product_image_name }}</p>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="product_seo">Mô tả ngắn</label>
          <input type="text" class="form-control" id="product_seo" aria-describedby="product_seo" name="product_seo"
            value="{{ $product->seo_product }}">
        </div>
        <div class="form-group">
          <label for="price">Giá:</label>
          <input type="number" class="form-control" id="price" name='price' value="{{ $product->price }}">
          @include('common.singleAlertError', ['field' => 'price'])
        </div>
        <div class="form-group">
          <label for="img_path">Ảnh sản phẩm chi tiết:</label>
          <input type="file" class="form-control-file" name="img_path[]" id="img_path" multiple>
          <div id="img_pathHelpBlock" class="form-text text-dark">
            Ảnh phải định dạng type *jpeg, *png, *bmp, *gif, *svg.
          </div>
          <div class="card-group">
            @foreach ($product->productImages as $itemImgs)
              <div class="card" style="width:18rem;">
                <img src="{{ asset($itemImgs->img_path) }}" class="card-img-top" alt="{{ $itemImgs->img_path_name }}"
                  height="100%" width="100%">
                <div class="card-body">
                  @php
                    $nameProductImgArray = explode('.', $itemImgs->img_path_name);
                    $nameProductImg = $nameProductImgArray[0];
                  @endphp
                  <h5 class="card-title text-center">{{ $nameProductImg }}</h5>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <div class="form-group">
          <label for="category_id">Danh mục sản phẩm:</label>
          <select class="form-control" id="category_id" name="category_id">
            @foreach ($category as $itemcategory)
              <option name="category_id" value="{{ $product->category_id }}" value="{{ old('category_id') }}">
                {{ $itemcategory->name }}</option>
            @endforeach
          </select>
        </div>
        <label for="size_id">Kích thước</label>
        <div class="form-group">
          @foreach ($sizes as $item)
            <div class="form-check form-check-inline size-div_checkbox">
              <input class="form-check-input size_checkbox" type="checkbox" name="size_id[]"value="{{ $item->id }}"
                {{ $productHasSize->contains('id', $item->id) ? 'checked' : '' }}>
              <label class="form-check-label" for="inlineCheckbox2">{{ $item->size_name }}</label>
            </div>
          @endforeach
          <div class="form-check-inline">
            <input class="form-check-input remove-all-size_selection" type="radio" name="option-radio-size"
              id="SizeRemoveAll" style="visibility: hidden;">
            <label class="form-check-label" for="SizeRemoveAll">Bỏ hết</label>
          </div>
          <div class="form-check-inline">
            <input class="form-check-input select-all-size_selection" type="radio" name="option-radio-size"
              id="SizeSelectAll" style="visibility: hidden;">
            <label class="form-check-label" for="SizeSelectAll">Chọn hết</label>
          </div>
        </div>
        <label for="color_id">Màu sắc</label>
        <div class="form-group">
          @foreach ($colors as $item)
            <div class="form-check form-check-inline color-div_checkbox">
              <input class="form-check-input color_checkbox" type="checkbox" name="color_id[]"
                value="{{ $item->id }}" {{ $productHasColor->contains('id', $item->id) ? 'checked' : '' }}>
              <label class="form-check-label" for="inlineCheckbox1">{{ $item->color_name }}</label>
            </div>
          @endforeach
          <div class="form-check-inline">
            <input class="form-check-input remove-all-color_selection" type="radio" name="option-radio-color"
              id="ColorRemoveAll" style="visibility: hidden;">
            <label class="form-check-label" for="ColorRemoveAll">Bỏ hết</label>
          </div>
          <div class="form-check-inline">
            <input class="form-check-input select-all-color_selection" type="radio" name="option-radio-color"
              id="ColorSelectAll" style="visibility: hidden;">
            <label class="form-check-label" for="ColorSelectAll">Chọn hết</label>
          </div>
        </div>
        <button class="btn btn-success d-flex btn-sm set_quanlities mb-2"> +Thiết lập số lượng</button>
        <label>Số lượng</label>
        <div id="product_quanlities-by-sizes">
          @if (request()->ajax())
            @include('admin.product.manage-quanlities')
          @endif
        </div>
        <div class="form-group">
          <label for="description">Mô tả chi tiết:</label>
          <textarea name="description" id="ckeditor_product_edit" cols="30" rows="10" class="form-control">{{ $product->productDetail->description }}</textarea>
          @include('common.singleAlertError', ['field' => 'description'])
        </div>
        <div class="form-group">
          <label for="weight">Cân nặng:</label>
          <input type="text" class="form-control" id="weight" name='weight'
            value="{{ $product->productDetail->weight }}" value="{{ old('weight') }}">
          @include('common.singleAlertError', ['field' => 'weight'])
        </div>
        <div class="form-group">
          <label for="dimension">Kích thước:</label>
          <input type="text" class="form-control" id="dimension" name='dimension'
            value="{{ $product->productDetail->dimension }}" value="{{ old('dimension') }}">
          @include('common.singleAlertError', ['field' => 'dimension'])
        </div>
        <div class="form-group">
          <label for="materials">Chất liệu:</label>
          <input type="text" class="form-control" id="materials" name='materials'
            value="{{ $product->productDetail->materials }}" value="{{ old('materials') }}">
          @include('common.singleAlertError', ['field' => 'materials'])
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary text-white mb-2">Cập nhật</button>
        </div>
      </form>
    </div>
  </div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')

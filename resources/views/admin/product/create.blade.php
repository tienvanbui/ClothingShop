@section('title')
  Tạo sản phẩm
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
                  class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo sản phẩm</a>
                @endif
              </div>
            </div>
          </div>
          <!-- /.col-lg-12 -->
        </div>
<<<<<<< HEAD
        <div class="row">
            <div class="container">
                @include('common.message')
                <h1 class="text-center">TẠO SẢN PHẨM</h1>

                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="product_name">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="product_name" aria-describedby="product_name"
                            placeholder="Nhập tên sản phẩm" name="product_name" value="{{ old('product_name') }}">
                        @include('common.singleAlertError', ['field' => 'product_name'])
                    </div>
                    <div class="form-group">
                        <label for="product_image">Ảnh thumbnail</label>
                        <input type="file" class="form-control" id="product_image" aria-describedby="product_image"
                            name="product_image">
                    </div>
                    <div class="form-group">
                        <label for="img_path">Ảnh chi tiết sản phẩm</label>
                        <input type="file" class="form-control" id="img_path" aria-describedby="img_path"
                            name="img_path[]" multiple>
                    </div>
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input type="number" class="form-control" id="price" aria-describedby="price" name="price">
                        @include('common.singleAlertError', ['field' => 'price'])
                    </div>
                    <div class="form-group">
                        <label for="product_seo">Mô tả ngắn</label>
                        <input type="text" class="form-control" id="product_seo" aria-describedby="product_seo"
                            name="product_seo">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Danh mục sản phẩm</label>
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="size_id">Kích thước</label>
                    <div class="form-group">
                        @foreach ($sizes as $item)
                            <div class="form-check form-check-inline size-div_checkbox">
                                <input class="form-check-input size_checkbox" type="checkbox"
                                    name="size_id[]"value="{{ $item->id }}">
                                <label class="form-check-label" for="inlineCheckbox2">{{ $item->size_name }}</label>
                            </div>
                        @endforeach
                        <div class="form-check-inline">
                            <input class="form-check-input remove-all-size_selection" type="radio"
                                name="option-radio-size" id="SizeRemoveAll" style="visibility: hidden;">
                            <label class="form-check-label" for="SizeRemoveAll">Bỏ hết</label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input select-all-size_selection" type="radio"
                                name="option-radio-size" id="SizeSelectAll" style="visibility: hidden;">
                            <label class="form-check-label" for="SizeSelectAll">Chọn hết</label>
                        </div>
                    </div>
                    <label for="color_id">Màu sắc</label>
                    <div class="form-group">
                        @foreach ($colors as $item)
                            <div class="form-check form-check-inline color-div_checkbox">
                                <input class="form-check-input color_checkbox" type="checkbox" name="color_id[]"
                                    value="{{ $item->id }}">
                                <label class="form-check-label" for="inlineCheckbox1">{{ $item->color_name }}</label>
                            </div>
                        @endforeach
                        <div class="form-check-inline">
                            <input class="form-check-input remove-all-color_selection" type="radio"
                                name="option-radio-color" id="ColorRemoveAll" style="visibility: hidden;">
                            <label class="form-check-label" for="ColorRemoveAll">Bỏ hết</label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input select-all-color_selection" type="radio"
                                name="option-radio-color" id="ColorSelectAll" style="visibility: hidden;">
                            <label class="form-check-label" for="ColorSelectAll">Chọn hết</label>
                        </div>
                    </div>
                    <button class="btn btn-success d-flex btn-sm set_quanlities mb-2"> +Thiết lập số lượng</button>
                    @if (request()->ajax())
                        <label>Số lượng</label>
                    @endif
                    <div id="product_quanlities-by-sizes">
                        @if (request()->ajax())
                            @include('admin.product.manage-quanlities')
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả chi tiết</label>
                        <textarea name="description" cols="30" rows="10" class="form-control" id="ckeditor_product_create"></textarea>
                        @include('common.singleAlertError', ['field' => 'description'])
                    </div>
                    <div class="form-group">
                        <label for="weight">Cân nặng</label>
                        <input type="text" class="form-control" id="weight" aria-describedby="weight"
                            name="weight">
                        @include('common.singleAlertError', ['field' => 'weight'])
                    </div>
                    <div class="form-group">
                        <label for="dimension">Kích thước</label>
                        <input type="text" class="form-control" id="dimension" aria-describedby="dimension"
                            name="dimension">
                        @include('common.singleAlertError', ['field' => 'dimension'])
                    </div>
                    <div class="form-group">
                        <label for="materials">Chất liệu</label>
                        <input type="text" class="form-control" id="materials" aria-describedby="materials"
                            name="materials">
                        @include('common.singleAlertError', ['field' => 'materials'])
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary ">Lưu</button>
                    </div>
                </form>
=======
      </div>
    <div class="row">
      <div class="container">
        @include('common.message')
        <h1 class="text-center">TẠO SẢN PHẨM</h1>

        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="product_name">Tên sản phẩm</label>
            <input type="text" class="form-control" id="product_name" aria-describedby="product_name"
              placeholder="Nhập tên sản phẩm" name="product_name" value="{{ old('product_name') }}">
            @include('common.singleAlertError', ['field' => 'product_name'])
          </div>
          <div class="form-group">
            <label for="product_image">Ảnh thumbnail</label>
            <input type="file" class="form-control" id="product_image" aria-describedby="product_image"
              name="product_image">
          </div>
          <div class="form-group">
            <label for="img_path">Ảnh chi tiết sản phẩm</label>
            <input type="file" class="form-control" id="img_path" aria-describedby="img_path" name="img_path[]"
              multiple>
          </div>
          <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" class="form-control" id="price" aria-describedby="price" name="price">
            @include('common.singleAlertError', ['field' => 'price'])
          </div>
          <div class="form-group">
            <label for="product_seo">Mô tả ngắn</label>
            <input type="text" class="form-control" id="product_seo" aria-describedby="product_seo" name="product_seo">
          </div>
          <div class="form-group">
            <label for="category_id">Danh mục sản phẩm</label>
            <select name="category_id" class="form-control">
              @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <label for="size_id">Kích thước</label>
          <div class="form-group">
            @foreach ($sizes as $item)
              <div class="form-check form-check-inline size-div_checkbox">
                <input class="form-check-input size_checkbox" type="checkbox" name="size_id[]"value="{{ $item->id }}">
                <label class="form-check-label" for="inlineCheckbox2">{{ $item->size_name }}</label>
              </div>
            @endforeach
            <div class="form-check-inline">
              <input class="form-check-input remove-all-size_selection" type="radio" name="option-radio-size"
                id="SizeRemoveAll" style="visibility: hidden;">
              <label class="form-check-label" for="SizeRemoveAll">Bỏ hết</label>
>>>>>>> 4318ef38fa794457b12c41f5f72b711fe1242a06
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
                  value="{{ $item->id }}">
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
          @if (request()->ajax())
            <label>Số lượng</label>
          @endif
          <div id="product_quanlities-by-sizes">
            @if (request()->ajax())
              @include('admin.product.manage-quanlities')
            @endif
          </div>
          <div class="form-group">
            <label for="description">Mô tả chi tiết</label>
            <textarea name="description" cols="30" rows="10" class="form-control" id="ckeditor_product_create"></textarea>
            @include('common.singleAlertError', ['field' => 'description'])
          </div>
          <div class="form-group">
            <label for="weight">Cân nặng</label>
            <input type="text" class="form-control" id="weight" aria-describedby="weight" name="weight">
            @include('common.singleAlertError', ['field' => 'weight'])
          </div>
          <div class="form-group">
            <label for="dimension">Kích thước</label>
            <input type="text" class="form-control" id="dimension" aria-describedby="dimension" name="dimension">
            @include('common.singleAlertError', ['field' => 'dimension'])
          </div>
          <div class="form-group">
            <label for="materials">Chất liệu</label>
            <input type="text" class="form-control" id="materials" aria-describedby="materials" name="materials">
            @include('common.singleAlertError', ['field' => 'materials'])
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

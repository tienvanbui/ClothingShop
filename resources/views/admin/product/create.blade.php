@section('title')
    Create Product
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
            </div>
        </div>
        <div class="row">
            <div class="container">
                @include('common.message')
                <h1 class="text-center">CREATE PRODUCT </h1>

                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="product_name" aria-describedby="product_name"
                            placeholder="Enter Product Name" name="product_name" value="{{ old('product_name') }}">
                        @include('common.singleAlertError', ['field' => 'product_name'])
                    </div>
                    <div class="form-group">
                        <label for="product_image">Product Image</label>
                        <input type="file" class="form-control" id="product_image" aria-describedby="product_image"
                            name="product_image">
                    </div>
                    <div class="form-group">
                        <label for="img_path">Product Detail Image</label>
                        <input type="file" class="form-control" id="img_path" aria-describedby="img_path"
                            name="img_path[]" multiple>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" aria-describedby="price" name="price">
                        @include('common.singleAlertError', ['field' => 'price'])
                    </div>
                    <div class="form-group">
                        <label for="product_seo">Product Seo</label>
                        <input type="text" class="form-control" id="product_seo" aria-describedby="product_seo"
                            name="product_seo">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category Id</label>
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="size_id">Size Id</label>
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
                            <label class="form-check-label" for="SizeRemoveAll">Remove All</label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input select-all-size_selection" type="radio"
                                name="option-radio-size" id="SizeSelectAll" style="visibility: hidden;">
                            <label class="form-check-label" for="SizeSelectAll">Select All</label>
                        </div>
                    </div>
                    <label for="color_id">Color Id</label>
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
                            <label class="form-check-label" for="ColorRemoveAll">Remove All</label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input select-all-color_selection" type="radio"
                                name="option-radio-color" id="ColorSelectAll" style="visibility: hidden;">
                            <label class="form-check-label" for="ColorSelectAll">Select All</label>
                        </div>
                    </div>
                    <button class="btn btn-success d-flex btn-sm set_quanlities mb-2"> +Set Quanlities</button>
                    @if (request()->ajax())
                        <label>Quanlities</label>
                    @endif
                    <div id="product_quanlities-by-sizes">
                        @if (request()->ajax())
                            @include('admin.product.manage-quanlities')
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" cols="30" rows="10" class="form-control" id="ckeditor_product_create"></textarea>
                        @include('common.singleAlertError', ['field' => 'description'])
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input type="text" class="form-control" id="weight" aria-describedby="weight"
                            name="weight">
                        @include('common.singleAlertError', ['field' => 'weight'])
                    </div>
                    <div class="form-group">
                        <label for="dimension">Dimension</label>
                        <input type="text" class="form-control" id="dimension" aria-describedby="dimension"
                            name="dimension">
                        @include('common.singleAlertError', ['field' => 'dimension'])
                    </div>
                    <div class="form-group">
                        <label for="materials">Materials</label>
                        <input type="text" class="form-control" id="materials" aria-describedby="materials"
                            name="materials">
                        @include('common.singleAlertError', ['field' => 'materials'])
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary ">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')

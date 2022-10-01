@section('title', 'Create New Coupon')
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Phiếu giảm giá</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                <li><a href="{{ route('coupon.index') }}" class="fw-normal">Danh sách phiếu giảm giá</a></li>
              </ol>
              <a href="{{ route('coupon.create') }}"
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo
                phiếu giảm giá</a>
            </div>
          </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <div class="row">
      <div class="container">
        <h1 class="text-center my-4">TẠO PHIẾU GIẢM GIÁ </h1>
        <form action="{{ route('coupon.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="coupon_code">Mã:</label>
            <input type="text" class="form-control" id="coupon_code" aria-describedby="coupon_code"
              placeholder="Enter Coupon Code" name="coupon_code" value="{{ old('coupon_code') }}">
            @include('common.singleAlertError', ['field' => 'coupon_code'])

          </div>
          <div class="form-group">
            <label for="coupon_condition">Loại giảm giá:</label>
            <select name="coupon_condition" id="coupon_condition" class="form-control">
              <option selected>Loại giảm giá</option>
              <option value="0">Giảm giá tiền mặt</option>
              <option value="1">Giảm giá theo phần trăm</option>
            </select>
          </div>
          <div class="form-group">
            <label for="coupon_price_discount">Giá giảm:</label>
            <input type="number" class="form-control" id="coupon_price_discount" aria-describedby="coupon_price_discount"
              name="coupon_price_discount" value="{{ old('coupon_price_discount') }}">
            @include('common.singleAlertError', ['field' => 'coupon_price_discount'])
          </div>
          <div class="form-group">
            <label for="coupon_use_number" class="text-capitalize">Số phiếu giảm giá tồn:</label>
            <input type="number" class="form-control" id="coupon_use_number" aria-describedby="coupon_use_number"
              name="coupon_use_number" value="{{ old('coupon_use_number') }}">
            @include('common.singleAlertError', ['field' => 'coupon_use_number'])
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

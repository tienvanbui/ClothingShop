@section('title', 'Danh sách phiếu giảm giá')
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
                @if (auth()->user()->hasPermission('Coupon_list'))
                  <li><a href="{{ route('coupon.index') }}" class="fw-normal">Danh sách phiếu giảm giá</a></li>
                @endif
              </ol>
              @if (auth()->user()->hasPermission('Coupon_create'))
                <a href="{{ route('coupon.create') }}"
                  class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo
                  phiếu giảm giá</a>
              @endif
            </div>
          </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <div class="row">
      <div class="container">
        <h1 class="text-center my-4">DANH SÁCH PHIẾU GIẢM GIÁ</h1>
        @include('common.message')
        <div class="d-flex action-bar justify-content-between">
          @include('common.showPerPage')
          @include('common.search')
        </div>
        <div id="admin-data">
          @include('admin.coupon.coupon-item')
        </div>
        <input type="hidden" id="hidden_page_admin" value="1" />
        <input type="hidden" id="hidden_table" value="coupons" />
        <input type="hidden" id="hidden_view" value="admin.coupon.coupon-item" />
        <input type="hidden" id="hidden_col" value="coupon_code" />
      </div>
    </div>
  </div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')

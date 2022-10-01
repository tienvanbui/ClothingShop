@section('title', 'Duyệt đơn hàng')
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Đơn hàng</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                <li><a href="{{ route('admin.order-check') }}" class="fw-normal">Danh sách đơn hàng</a></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="container">
        <h1 class="text-center">DANH SÁCH ĐƠN HÀNG</h1>
        @include('common.message')
        <div class="d-flex action-bar justify-content-between">
          @include('common.showPerPage')
          @include('common.search')
        </div>
        <div id="admin-data">
          @include('admin.order.order-item')
        </div>
        <input type="hidden" id="hidden_page_admin" value="1" />
        <input type="hidden" id="hidden_table" value="orders" />
        <input type="hidden" id="hidden_view" value="admin.order.order-item" />
      </div>
    @endsection
    @include('layouts.admin.main')
    @include('layouts.admin.footer')

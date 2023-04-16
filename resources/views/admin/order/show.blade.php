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
                @if (auth()->user()->hasPermission('Order_list'))
                <li><a href="{{ route('admin.order-check') }}" class="fw-normal">Danh sách đơn hàng</a></li>
                @endif
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mt-5">
            <div class="card">
              <h5 class="card-header bg-dark text-white text-center">Thông tin người đặt hàng</h5>
              <div class="card-body">

                <p class="card-text"><strong>Tên</strong>{{ ':' . $order->user->name }}</p>
                <p class="card-text"><strong>Địa chỉ</strong>{{ ':' . $order->user->adrress }}</p>
                <p class="card-text"><strong>SĐT</strong>{{ ':' . $order->user->phoneNumber }}</p>
                <p class="card-text"><strong>Địa chỉ nhận hàng</strong>{{ ':' . $order->address_shipping }}</p>
                <p class="card-text"><strong>Số điện thoại nhận hàng</strong>{{ ':' . $order->phoneNumber_shipping }}</p>
                <p class="card-text"><strong>Thời gian đặt hàng</strong>{{ ':' . $order->created_at }}</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 mt-5">
            <div class="card">
              <h5 class="card-header bg-dark text-white text-center">Thông tin phương thức thanh toán</h5>
              <div class="card-body">

                <p class="card-text"><strong>Phương thức thanh toán</strong>{{ ':' . $order->payment->payment_method }}</p>

              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="container">
            <div class="row">
              <div class="col-sm-12 col-md-12 mt-5">
                <table class="table">
                  <thead >
                    <tr style="color:white" class="bg-dark">
                      <th scope="col" class="text-center text-white">Sản phẩm</th>
                      <th scope="col" class="text-white">Hình ảnh</th>
                      <th scope="col" class="text-center text-white">Số lượng</th>
                      <th scope="col" class="text-center text-white">Kích thước</th>
                      <th scope="col" class="text-center text-white">Màu sắc</th>
                      <th scope="col" class="text-center text-white">Giá</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($order->products as $product)
                      <tr>
                        <td class="fw-bold text-center text-primary">{{ $product->product_name }}</td>
                        <td><img src="{{ $product->product_image }}" alt="{{ $product->product_image_name }}"
                            width="100rem" height="100rem"></td>
                        <td class="text-center">{{ $product->pivot->buy_quanlity }}</td>
                        <td class="text-center">
                          {{ $product->sizes()->where('sizes.id', '=', $product->pivot->size_id)->first()->size_name }}
                        </td>
                        <td class="text-center">
                          {{ $product->colors()->where('colors.id', '=', $product->pivot->color_id)->first()->color_name }}
                        </td>
                        <td class="text-center">{{ number_format($product->price) .'VNĐ' }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endsection
    @include('layouts.admin.main')
    @include('layouts.admin.footer')

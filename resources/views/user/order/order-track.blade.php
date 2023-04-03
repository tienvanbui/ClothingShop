@section('title', 'Kiểm tra đơn hàng')
@include('layouts.user.header')
<div class="container" style="margin-top: 150px;margin-bottom:150px;">
  <div class="row">
    <h3 class="fw-bold" style="font-weight: bold;margin-bottom:40px;">Đơn hàng của bạn</h3>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col" style="font-weight: bold">#</th>
            <th scope="col" style="font-weight: bold">Tên sản phẩm</th>
            <th scope="col" style="font-weight: bold">Ảnh</th>
            <th scope="col" style="font-weight: bold">Giá</th>
            <th scope="col" style="font-weight: bold">Số lượng</th>
            <th scope="col" style="font-weight: bold">Ngày đặt</th>
            <th scope="col" style="font-weight: bold">Trạng thái</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($detailOrders as $index => $product)
            <tr>
              <th scope="row">{{ $index + 1 }}</th>
              <td>{{ $product->product_name }}</td>
              <td><img src="{{ asset($product->product_image) }} " width="100px" height="100px"></td>
              <td>{{ number_format($product->price).'VNĐ' }}</td>
              <td>{{ $product->buy_quanlity }}</td>
              <td>{{ date('d/m/Y H:i:s', strtotime($product->created_at)) }}</td>
              <td>
                @if ($product->status == 0)
                  <span class="text-primary">Pending</span>
                @elseif($product->status == 1)
                  <form method="post" id="btnOrderTrackForm{{ $product->id }}">
                    @csrf
                    <button class="btn btn-sm btn-danger track_order-button rounded-pill" data-order_status="2"
                      data-order_id="{{ $product->id }}">Shipping</button>
                  </form>
                @elseif ($product->status == 2)
                  <button class="text-white fw-bold btn btn-warning btn-sm rounded-pill">Shipped</button>
                @endif
                <div class="order-tracked_button_{{ $product->id }}"></div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@include('layouts.user.footer')

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
            <th scope="col" style="font-weight: bold">Mã đơn hàng</th>
            <th scope="col" style="font-weight: bold">Giá</th>
            <th scope="col" style="font-weight: bold">Ngày đặt</th>
            <th scope="col" style="font-weight: bold">Trạng thái</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($detailOrders as $index => $order)
            <tr>
              <th scope="row">{{ $index + 1 }}</th>
              <th scope="row">{{ $order->order_code }}</th>
              <td>{{ number_format($order->total).'VNĐ' }}</td>
              <td>{{ date('d/m/Y H:i:s', strtotime($order->created_at)) }}</td>
              <td>
                @if ($order->status == 0)
                  <span class="text-primary">Chờ</span>
                @elseif($order->status == 1)
                  <form method="post" id="btnOrderTrackForm{{ $order->id }}">
                    @csrf
                    <button class="btn btn-sm btn-danger track_order-button rounded-pill" data-order_status="2"
                      data-order_id="{{ $order->id }}">Đang chuyển</button>
                  </form>
                @elseif ($order->status == 2)
                  <button class="text-white fw-bold btn btn-warning btn-sm rounded-pill">Đã đến</button>
                @else

                @endif
                <div class="order-tracked_button_{{ $order->id }}"></div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@include('layouts.user.footer')

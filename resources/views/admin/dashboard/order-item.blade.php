<table class="table mt-5">
  <thead>
    <tr>
      <th scope="col" class="fw-bold text-dark">#</th>
      <th scope="col" class="fw-bold text-dark">Người dùng</th>
      <th scope="col" class="fw-bold text-dark">Ngày đặt</th>
      <th scope="col" class="fw-bold text-dark">Thanh toán</th>
      <th scope="col" class="fw-bold text-dark">Tổng tiền</th>
      <th scope="col" class="fw-bold text-dark">Trạng thái</th>
      <th class="fw-bold">
        @if (auth()->user()->hasPermission('Order_list'))
        <a href="{{ route('admin.order-check') }}" class="fw-bold btn btn-primary text-white rounded-pill"
          style="border-radius: 50%" role="button">Xem tất cả</a>
        @endif
      </th>
    </tr>
  </thead>
  <tbody>
    @foreach ($orders as $index => $order)
      <tr class="mt-1">
        <td><span class="text-success">{{ $index + 1 }}</span></td>
        <td>{{ ucwords($order->username) }}</td>
        <td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
        <td>{{ $order->payment_method }}</td>
        <td>{{ number_format($order->total) . 'VNĐ' }}</td>
        <td>
          @if ($order->status == 0)
            <form action="{{ route('admin.order-confirm', ['order' => $order->id]) }}"method="POST">
              @csrf
              <input type="number" class="d-none" value="1" name="status">
              <button class="text-white btn btn-primary btn-sm mt-1 rounded-pill">Chờ xử lý</button>
            </form>
          @elseif($order->status == 1)
            <form action="{{ route('admin.order-confirm', ['order' => $order->id]) }}"method="POST">
              @csrf
              <input type="number" class="d-none" value="2" name="status">
              <button class="text-white btn btn-success btn-sm mt-1 rounded-pill">Đang chuyển</button>
            </form>
          @else
            <form action="{{ route('admin.order-delete', ['order' => $order->id]) }}" method="post">
              @csrf
              <button class="text-white fw-bold btn btn-danger btn-sm rounded-pill remove-order"
                data-order_id="{{ $order->id }}">Loại bỏ</button>
            </form>
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<table class="table mt-5">
  <thead>
    <tr>
      <th scope="col" class="fw-bold text-dark">#</th>
      <th scope="col" class="fw-bold text-dark">User</th>
      <th scope="col" class="fw-bold text-dark">Date</th>
      <th scope="col" class="fw-bold text-dark">Payment Method</th>
      <th scope="col" class="fw-bold text-dark">Total</th>
      <th scope="col" class="fw-bold text-dark">Status</th>
      <th class="fw-bold">
        <a href="{{ route('admin.order-check') }}" class="fw-bold btn btn-primary text-white rounded-pill"
          style="border-radius: 50%" role="button">View All -></a>
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
        <td>{{ '$' . number_format($order->total) }}</td>
        <td>
          @if ($order->status == 0)
            <form action="{{ route('admin.order-confirm', ['order' => $order->id]) }}"method="POST">
              @csrf
              <input type="number" class="d-none" value="1" name="status">
              <button class="text-white btn btn-primary btn-sm mt-1 rounded-pill">On Progressing</button>
            </form>
          @elseif($order->status == 1)
            <form action="{{ route('admin.order-confirm', ['order' => $order->id]) }}"method="POST">
              @csrf
              <input type="number" class="d-none" value="2" name="status">
              <button class="text-white btn btn-success btn-sm mt-1 rounded-pill">Shipping</button>
            </form>
          @else
            <form action="{{route('admin.order-delete',['order'=>$order->id])}}" method="post">
              @csrf
              <button class="text-white fw-bold btn btn-danger btn-sm rounded-pill remove-order"
                data-order_id="{{ $order->id }}">Remove</button>
            </form>
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<table class="table table-sm table-hover">
  <thead style="background-color: #021919;color:white">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">User</th>
      <th scope="col" class="text-white">Date</th>
      <th scope="col" class="text-white">Payment Method</th>
      <th scope="col" class="text-white">Total</th>
      <th scope="col" class="text-white">Status</th>
      <th scope="col" class="text-white">Action</th>
    </tr>
  </thead>
  <tbody>
    @if (request()->ajax())
      @foreach ($orders as $index => $order)
        <tr class="mt-1">
          <td>{{ $index + 1 }}</td>
          <td>{{ $order->name }}</td>
          <td>{{ $order->created_at }}</td>
          <td>{{ $order->payment_method }}</td>
          <td>{{ '$' . $order->total }}</td>
          <td>
            @if ($order->status == 0)
              <form action="{{ route('admin.order-confirm', ['order' => $order->id]) }}"method="POST">
                @csrf
                <input type="number" class="d-none" value="0" name="status">
                <button class="text-white btn btn-danger btn-sm mt-1">On Progressing</button>
              </form>
            @else
              <form action="{{ route('admin.order-confirm', ['order' => $order->id]) }}"method="POST">
                @csrf
                <input type="number" class="d-none" value="1" name="status">
                <button class="text-white btn btn-primary btn-sm mt-1">Shipping</button>
              </form>
            @endif
          </td>
          <td>
            <a href="{{ route('admin.order-show', ['order' => $order->id]) }}"
              class="btn btn-info btn-inline text-white btn-sm mt-1"><i class="fas fa-eye"></i>
            </a>
          </td>
        </tr>
      @endforeach
    @else
      @foreach ($orders as $index => $order)
        <tr class="mt-1">
          <td>{{ $index + 1 }}</td>
          <td>{{ $order->user->username }}</td>
          <td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
          <td>{{ $order->payment->payment_method }}</td>
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
            <form action="{{ route('admin.order-delete', ['order' => $order->id]) }}"method="POST">
              @csrf
              <button class="text-white tex-white btn-sm btn-danger btn mt-1 rounded-pill">Remove</button>
            </form>
              
            @endif
          </td>
          <td>
            <a href="{{ route('admin.order-show', ['order' => $order->id]) }}"
              class="btn btn-info btn-inline text-white btn-sm mt-1 "><i class="fas fa-eye"></i>
            </a>
          </td>
        </tr>
      @endforeach
    @endif
  </tbody>
</table>
@include('common.paginate-admin', ['array' => $orders])

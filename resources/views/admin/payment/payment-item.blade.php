<table class="table table-hover table-bordered">
  <thead style="width: 100%;background-color:black;">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Phương thức thanh toán</th>
      <th style="width: 11%" class="text-white">Hoạt động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($payments as $index => $payment)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $payment->payment_method }}</td>
        <td>
          @if (auth()->user()->hasPermission('Payment Method_update'))
          <a href="{{ route('payment.edit', ['payment' => $payment->id]) }}" class="btn btn-success btn-sm text-white"><i
              class="fas fa-edit"></i></a>
          @endif
          @if (auth()->user()->hasPermission('Payment Method_delete'))
          @include('common.delete', [
              'routeName' => 'payment.destroy',
              'itemname' => 'payment',
              'item' => $payment->id,
          ])
          @endif
        </td>
      </tr>
    @endforeach
  </tbody> 
</table>
@include('common.paginate-admin', ['array' => $payments])

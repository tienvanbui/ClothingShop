<table class="table table-hover table-bordered">
  <thead style="width: 100%;background-color:black;">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Payment Method</th>
      <th style="width: 11%" class="text-white">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($payments as $index => $payment)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $payment->payment_method }}</td>
        <td>
          <a href="{{ route('payment.edit', ['payment' => $payment->id]) }}" class="btn btn-success btn-sm text-white"><i
              class="fas fa-edit"></i></a>
          @include('common.delete', [
              'routeName' => 'payment.destroy',
              'itemname' => 'payment',
              'item' => $payment->id,
          ])
        </td>
      </tr>
    @endforeach
  </tbody> 
</table>
@include('common.paginate-admin', ['array' => $payments])

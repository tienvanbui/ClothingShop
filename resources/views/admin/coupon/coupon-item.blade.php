<table class="table table-hover table-sm">
  <thead style="width: 100%;background-color:black;">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Coupon Code</th>
      <th scope="col" class="text-white">Discount Type</th>
      <th scope="col" class="text-white">Discount Price</th>
      <th scope="col" class="text-white">Number Of Coupons Available</th>
      <th scope="col" class="text-white">Number Of Coupons Used</th>
      <th style="width: 10%" class="text-white">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($coupons as $index => $coupon)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $coupon->coupon_code }}</td>
        <td>
          @if ($coupon->coupon_condition == 0)
            discount as a money
          @else
            discount as a percentage
          @endif
        </td>
        <td>
          @if ($coupon->coupon_condition == 0)
            {{ '$' . $coupon->coupon_price_discount }}
          @else
            {{ $coupon->coupon_price_discount . '%' }}
          @endif
        </td>
        <td>{{ $coupon->coupon_use_number }}</td>
        <td>{{ $coupon->coupon_used_count }}</td>
        <td>
          <a href="{{ route('coupon.edit', ['coupon' => $coupon->id]) }}" class="btn btn-success btn-sm text-white"><i
              class="fas fa-edit"></i></a>
          @include('common.delete', [
              'routeName' => 'coupon.destroy',
              'itemname' => 'coupon',
              'item' => $coupon->id,
          ])
        </td>
      </tr>
    @endforeach

  </tbody>
</table>
@include('common.paginate-admin', ['array' => $coupons])

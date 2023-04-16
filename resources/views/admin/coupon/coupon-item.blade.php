<table class="table table-hover table-sm">
  <thead style="width: 100%;background-color:black;">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Mã giảm giá</th>
      <th scope="col" class="text-white">Loại giảm giá</th>
      <th scope="col" class="text-white">Giá giảm</th>
      <th scope="col" class="text-white">Số lượng phiếu tồn</th>
      <th scope="col" class="text-white">Số lượng phiếu đã dùng</th>
      <th scope="col" class="text-white">Ngày hết hạn</th>
      <th style="width: 10%" class="text-white">Hoạt động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($coupons as $index => $coupon)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $coupon->coupon_code }}</td>
        <td>
          @if ($coupon->coupon_condition == 0)
            Giảm giá theo tiền
          @else
            Giảm giá theo phần trăm
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
        <td>{{ $coupon->created_at->addDays(7)->toDateString() }}</td>
        <td>
          @if (auth()->user()->hasPermission('Coupon_update'))
            <a href="{{ route('coupon.edit', ['coupon' => $coupon->id]) }}" class="btn btn-success btn-sm text-white"><i
                class="fas fa-edit"></i></a>
          @endif
          @if (auth()->user()->hasPermission('Coupon_delete'))
            @include('common.delete', [
                'routeName' => 'coupon.destroy',
                'itemname' => 'coupon',
                'item' => $coupon->id,
            ])
          @endif
        </td>
      </tr>
    @endforeach

  </tbody>
</table>
@include('common.paginate-admin', ['array' => $coupons])

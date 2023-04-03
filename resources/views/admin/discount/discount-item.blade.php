<table class="table table-hover table-bordered">
  <thead style="background-color:black">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Tên sự kiện</th>
      <th scope="col" class="text-white">Phần trăm giảm giá</th>
      <th scope="col" class="text-white">Ngày bắt đầu</th>
      <th scope="col" class="text-white">Ngày kết thúc </th>
      <th scope="col" class="text-white">Trạng thái</th>
      <th scope="col" class="text-white">Hành động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($discounts as $index => $discount)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $discount->discount_event_name }}</td>
        <td>{{ $discount->discount_percent . '%' }}</td>
        <td>{{ $discount->start_date_event }}</td>
        <td>{{ $discount->end_date_event }}</td>
        <td>
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="active" name="actived"
              value="{{ $discount->active }}">
            <label class="form-check-label" for="active">Hoạt động</label>
          </div>
        </td>
        <td>
          <a href="
                  {{ route('discount.show', ['discount' => $discount->id]) }}"
            class="btn btn-primary btn-sm  text-white "><i class="fas fa-eye"></i></a>
          <a href="
                  {{ route('discount.edit', ['discount' => $discount->id]) }}"
            class="btn btn-success btn-sm text-white "><i class="fas fa-edit"></i></a>
          @include('common.delete', [
              'routeName' => 'discount.destroy',
              'itemname' => 'discount',
              'item' => $discount->id,
          ])
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@include('common.paginate-admin', ['array' => $discounts])

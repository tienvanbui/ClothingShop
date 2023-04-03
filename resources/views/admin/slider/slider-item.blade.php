<table class="table table-hover table-bordered">
  <thead style="width: 100%;background-color:black">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Tiêu đề</th>
      <th style="width: 30%" class="text-white">Hỉnh ảnh</th>
      <th style="width: 10%" class="text-white">Hoạt động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($sliders as $index => $item)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $item->title }}</td>
        <td><img src="{{ asset($item->slider_image) }}" width="100%"></td>
        <td>
          @if (auth()->user()->hasPermission('Slider_update'))
            <a href="{{ route('slider.edit', ['slider' => $item->id]) }}" class="btn btn-success btn-sm text-white"><i
                class="fas fa-edit"></i></a>
          @endif
          @if (auth()->user()->hasPermission('Slider_delete'))
            @include('common.delete', [
                'routeName' => 'slider.destroy',
                'itemname' => 'slider',
                'item' => $item->id,
            ])
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@include('common.paginate-admin', ['array' => $sliders])

<table class="table table-hover table-bordered">
  <thead style="background-color:black;">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Kích thước</th>
      <th scope="col" class="text-white">Hoạt động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($sizes as $index => $item)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $item->size_name }}</td>
        <td>
          @if (auth()->user()->hasPermission('Size_update'))
            <a href="{{ route('size.edit', ['id' => $item->id]) }}" class="btn btn-success text-white btn-sm"><i
                class="fas fa-edit"></i></a>
          @endif
          @if (auth()->user()->hasPermission('Size_delete'))
            @include('common.delete', [
                'routeName' => 'size.destroy',
                'itemname' => 'id',
                'item' => $item->id,
            ])
          @endif
        </td>
      </tr>
    @endforeach

  </tbody>
</table>
@include('common.paginate-admin', ['array' => $sizes])

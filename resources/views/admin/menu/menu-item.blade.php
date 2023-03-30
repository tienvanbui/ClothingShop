<table class="table table-hover table-bordered">
  <thead style="width: 100%;background-color:black">
    <tr>
      <th scope="col"class="text-white">#</th>
      <th scope="col"class="text-white">Tên</th>
      <th style="width: 20%"class="text-white">Hoạt động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($menus as $index => $item)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $item->name }}</td>
        <td>
          @if (auth()->user()->hasPermission('Menu_update'))
            <a href="{{ route('menu.edit', ['menu' => $item->id]) }}" class="btn btn-success btn-sm text-white"><i
                class="fas fa-edit"></i></a>
          @endif
          @if (auth()->user()->hasPermission('Menu_delete'))
            @include('common.delete', [
                'routeName' => 'menu.destroy',
                'itemname' => 'menu',
                'item' => $item->id,
            ])
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@include('common.paginate-admin', ['array' => $menus])

<table class="table table-hover table-bordered">
  <thead style="width: 100%;background-color:black">
    <tr>
      <th scope="col"class="text-white">#</th>
      <th scope="col"class="text-white">Name</th>
      <th style="width: 8%"class="text-white">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($menus as $index => $item)
      <tr>
        <td>{{ $index + 1}}</td>
        <td>{{ $item->name }}</td>
        <td>
          <a href="{{ route('menu.edit', ['menu' => $item->id]) }}" class="btn btn-success btn-sm text-white"><i
              class="fas fa-edit"></i></a>
          @include('common.delete', [
              'routeName' => 'menu.destroy',
              'itemname' => 'menu',
              'item' => $item->id,
          ])
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@include('common.paginate-admin', ['array' => $menus])

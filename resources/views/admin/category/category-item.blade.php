<table class="table table-hover table-bordered">
  <thead style="background-color:black;">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Tên danh mục</th>
      <th scope="col" class="text-white">Hành động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($categories as $index => $item)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $item->name }}</td>
        <td>
          @if (auth()->user()->hasPermission('Category_update'))
            <a href="{{ route('category.edit', ['id' => $item->id]) }}" class="btn btn-success text-white btn-sm"><i
                class="fas fa-edit"></i></a>
          @endif
          @if (auth()->user()->hasPermission('Category_delete'))
            @include('common.delete', [
                'routeName' => 'category.destroy',
                'itemname' => 'id',
                'item' => $item->id,
            ])
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@include('common.paginate-admin', ['array' => $categories])

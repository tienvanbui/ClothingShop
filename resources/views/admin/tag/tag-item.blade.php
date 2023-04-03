<table class="table table-hover table-bordered">
  <thead style="background-color:black;">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Tên từ khóa</th>
      <th scope="col" class="text-white">Hoạt động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($tags as $index => $item)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $item->tag_name }}</td>
        <td>
          @if (auth()->user()->hasPermission('Tag_update'))
            <a href="{{ route('tag.edit', ['tag' => $item->id]) }}" class="btn btn-success text-white btn-sm"><i
                class="fas fa-edit"></i></a>
          @endif
          @if (auth()->user()->hasPermission('Tag_delete'))
            @include('common.delete', [
                'routeName' => 'tag.destroy',
                'itemname' => 'tag',
                'item' => $item->id,
            ])
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@include('common.paginate-admin', ['array' => $tags])

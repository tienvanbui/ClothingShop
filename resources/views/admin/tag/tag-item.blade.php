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
          <a href="{{ route('tag.edit', ['tag' => $item->id]) }}" class="btn btn-success text-white btn-sm"><i
              class="fas fa-edit"></i></a>
          @include('common.delete', [
              'routeName' => 'tag.destroy',
              'itemname' => 'tag',
              'item' => $item->id,
          ])
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@include('common.paginate-admin', ['array' => $tags])

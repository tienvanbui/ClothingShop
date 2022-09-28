<table class="table table-hover table-bordered">
  <thead style="background-color:black;">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Name</th>
      <th scope="col" class="text-white">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($sizes as $index => $item)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $item->size_name }}</td>
        <td>
          <a href="{{ route('size.edit', ['id' => $item->id]) }}" class="btn btn-success text-white btn-sm"><i
              class="fas fa-edit"></i></a>
          @include('common.delete', [
              'routeName' => 'size.destroy',
              'itemname' => 'id',
              'item' => $item->id,
          ])
        </td>
      </tr>
    @endforeach

  </tbody>
</table>
@include('common.paginate-admin', ['array' => $sizes])

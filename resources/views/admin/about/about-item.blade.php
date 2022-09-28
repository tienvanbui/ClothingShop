<table class="table table-hover table-bordered">
  <thead style="width: 100%;background-color:black;">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Title</th>
      <th style="width: 5%" class="text-white">Thumbnail</th>
      <th scope="col" class="text-white">Description</th>
      <th scope="col" class="text-white">Quote</th>
      <th scope="col" style="width: 8%" class="text-white">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($abouts as $index => $item)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $item->title }}</td>
        <td><img src="{{ asset($item->thumbnail) }}" width="100%"></td>
        <td>{!! $item->description !!}</td>
        <td>{!! $item->quote !!}</td>
        <td>
          <a href="{{ route('about.edit', ['about' => $item->id]) }}" class="btn btn-success btn-sm text-white"><i
              class="fas fa-edit"></i></a>
          @include('common.delete', [
              'routeName' => 'about.destroy',
              'itemname' => 'about',
              'item' => $item->id,
          ])

        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@include('common.paginate-admin', ['array' => $abouts])

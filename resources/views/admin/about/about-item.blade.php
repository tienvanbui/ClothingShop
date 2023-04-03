<table class="table table-hover table-bordered">
  <thead style="width: 100%;background-color:black;">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Tiêu đề</th>
      <th style="width: 25%" class="text-white">Ảnh</th>
      <th scope="col" style="width: 10%" class="text-white">Hành động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($abouts as $index => $item)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $item->title }}</td>
        <td><img src="{{ asset($item->thumbnail) }}" width="100%"></td>
        <td>
          @if (auth()->user()->hasPermission('About_update'))
            <a href="{{ route('about.edit', ['about' => $item->id]) }}" class="btn btn-success btn-sm text-white"><i
                class="fas fa-edit"></i></a>
          @endif
          @if (auth()->user()->hasPermission('About_delete'))
            @include('common.delete', [
                'routeName' => 'about.destroy',
                'itemname' => 'about',
                'item' => $item->id,
            ])
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@include('common.paginate-admin', ['array' => $abouts])

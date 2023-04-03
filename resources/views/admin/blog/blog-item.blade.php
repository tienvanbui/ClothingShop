<table class="table table-hover table-bordered">
  <thead style="background-color:black">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Tiêu đề</th>
      <th scope="col" class="text-white">Ảnh</th>
      <th scope="col" class="text-white">Ngày hết hạn</th>
      <th scope="col" class="text-white">Hành động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($blogs as $index => $blog)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $blog->blog_name }}</td>
        <td><img src="{{ asset($blog->thumbnail) }}" width="50px" height="50px"></td>
        <td>{{ $blog->outdate }}</td>
        <td>
          @if (auth()->user()->hasPermission('Blog_show'))
            <a href="
                {{ route('blog.show', ['blog' => $blog->id]) }}"
              class="btn btn-primary btn-sm  text-white "><i class="fas fa-eye"></i></a>
          @endif
          @if (auth()->user()->hasPermission('Blog_update'))
            <a href="
                {{ route('blog.edit', ['blog' => $blog->id]) }}"
              class="btn btn-success btn-sm text-white "><i class="fas fa-edit"></i></a>
          @endif
          @if (auth()->user()->hasPermission('Blog_delete'))
            @include('common.delete', [
                'routeName' => 'blog.destroy',
                'itemname' => 'blog',
                'item' => $blog->id,
            ])
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@include('common.paginate-admin', ['array' => $blogs])

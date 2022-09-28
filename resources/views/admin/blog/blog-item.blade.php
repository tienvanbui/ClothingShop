<table class="table table-hover table-bordered">
  <thead style="background-color:black">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Name</th>
      <th scope="col" class="text-white">Thumbnail</th>
      <th scope="col" class="text-white">Time Out</th>
      <th scope="col" class="text-white">Action</th>
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
          <a href="
                {{ route('blog.show', ['blog' => $blog->id]) }}"
            class="btn btn-primary btn-sm  text-white "><i class="fas fa-eye"></i></a>
          <a href="
                {{ route('blog.edit', ['blog' => $blog->id]) }}"
            class="btn btn-success btn-sm text-white "><i class="fas fa-edit"></i></a>
          @include('common.delete', [
              'routeName' => 'blog.destroy',
              'itemname' => 'blog',
              'item' => $blog->id,
          ])
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@include('common.paginate-admin', ['array' => $blogs])

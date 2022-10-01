<table class="table table-hover table-bordered">
  <thead style="width: 100%;background-color:black">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Tiêu đề</th>
      <th scope="col" class="text-white">Mô tả</th>
      <th scope="col" class="text-white">Hình ảnh</th>
      <th style="width: 10%" class="text-white">Hoạt động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($banners as $index => $banner)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $banner->title }}</td>
        <td>{!! $banner->content !!}</td>
        <td><img src="{{ asset($banner->banner_image) }}" style="width: 10rem"></td>
        <td>
          <a href="{{ route('banner.edit', ['banner' => $banner->id]) }}" class="btn btn-success btn-sm text-white"><i
              class="fas fa-edit"></i></a>
          @include('common.delete', [
              'routeName' => 'banner.destroy',
              'itemname' => 'banner',
              'item' => $banner->id,
          ])
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@include('common.paginate-admin', ['array' => $banners])

<table class="table table-hover table-bordered">
  <thead style="background-color:black;">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Tên</th>
      <th scope="col" class="text-white">Biệt danh</th>
      <th scope="col" class="text-white">Email</th>
      <th scope="col" class="text-white">SĐT</th>
      <th scope="col" class="text-white">Địa chỉ</th>
      <th scope="col" class="text-white">Ảnh</th>
      <th scope="col" class="text-white">Trạng thái</th>
      <th style="width: 10%" class="text-white">Hoạt động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $index => $user)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phoneNumber }}</td>
        <td>{{ $user->address }}</td>
        <td><img src="{{ asset($user->avatar) }}" style="width:3rem;height:3rem"></td>
        <td>
          @if ($user->status == 1)
            <label class=" mt-1 btn btn-danger">Chặn</label>
          @elseif ($user->status == 0)
            <label class="mt-1 btn btn-primary btn-sm">Hoạt động</label>
          @endif
        </td>
        <td>
          <a href="{{ route('manage_user.edit', ['manage_user' => $user->id]) }}"
            class="btn btn-success btn-sm text-white"><i class="fas fa-edit"></i></a>
          @include('common.delete', [
              'routeName' => 'manage_user.destroy',
              'itemname' => 'manage_user',
              'item' => $user->id,
          ])
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@include('common.paginate-admin', ['array' => $users])

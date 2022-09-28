<table class="table table-hover table-bordered">
  <thead style="background-color:black;">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Name</th>
      <th scope="col" class="text-white">Role Description</th>
      <th scope="col" class="text-white">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($roles as $index => $role)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $role->role_name }}</td>
        <td>{!! $role->role_description !!}</td>
        <td>
          <a href="{{ route('role.edit', ['role' => $role->id]) }}"
            class="btn btn-success btn-inline text-white btn-sm "><i class="fas fa-edit"></i></a>
          <a href="{{ route('role.show', ['role' => $role->id]) }}"
            class="btn btn-primary btn-inline text-white btn-sm "><i class="fas fa-eye"></i></a>
          @include('common.delete', [
              'routeName' => 'role.destroy',
              'itemname' => 'role',
              'item' => $role->id,
          ])
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@include('common.paginate-admin', ['array' => $roles])

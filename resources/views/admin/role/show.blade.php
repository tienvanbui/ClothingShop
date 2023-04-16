
@section('title')
  Chi tiết vai trò
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
<div class="container">
	<div class="row">            
		<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Vai trò</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('role.index')}}" class="fw-normal">Danh sách vai trò</a></li>
                            </ol>
                            <a href="{{route('role.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo vai trò</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
	</div>
  <div class="row">
   <h1 class="text-center mt-4">XEM CHI TIẾT VAI TRÒ</h1>
          <div class="col-md-12">
            <div class="form-group">
              <label for="role_name">Tên vai trò:</label>
              <input type="text" class="form-control" id="role_name" aria-describedby="role_name" name="role_name" value="{{$role->role_name}}" placeholder="Enter Role Name">
            </div>
            <div class="form-group">
              <label for="role_description">Mô tả:</label>
              <textarea name="role_description" id="ckeditor_user_role_show" cols="30" rows="10" class="form-control" placeholder="Enter Role Description">{{$role->role_description}}</textarea>
            </div>
          </div>
            <div class="col-md-12">
                <div class="row">
              @foreach ($permission as $item)         
              <div class="card text-white col-md-12 mb-3">
                <div class="card-header text-dark bg-success">
                  <label>
                    <input type="checkbox" class="checkbox_warpper" >                    
                  </label>
                  Chức năng {{ __($item->permission_name) }}
                </div>
                <div class="row">
                  @foreach ($item->permissions as $child)      
                <div class="card-body col-md-3 ml-1">
                    <h5 class="card-title">
                    <label>
                      <input type="checkbox" name="permission_id[]" class="checkbox_childrent" value={{$child->id}} multiple  {{$pemissionOfRole->contains('id',$child->id) ? 'checked': ''}}>
                    </label>
                    {{ __($child->permission_name) }}
                    </h5>                
                </div>
                                      
                  @endforeach  
                </div>
              </div>
               @endforeach
                </div>

            </div>
  </div>

</div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')
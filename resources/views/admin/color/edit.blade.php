@section('title')
    Update Color
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
<div class="container">
	<div class="row">            
		<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Color</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('color.index')}}" class="fw-normal">Colors List</a></li>
                            </ol>
                            <a href="{{route('color.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create Color</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
	</div>
  <div class="row">
    <div class="col-sm-12">
      <h2 class="text-center mt-3">Edit Color</h2>
<form method="POST" action="{{route('color.update',[
    'id'=>$color->id
])}}" >
    @csrf
    @method('put')
  <div class="form-group">
    <label for="color_name">Color Name</label>
  <input type="text" class="form-control" id="color_name" aria-describedby="color_name"  name="color_name" value="{{$color->color_name}}">
  @include('common.singleAlertError',['field'=>'color_name'])
  </div>
  <div class="d-grid gap-2">
  <button type="submit" class="btn btn-primary ">Update</button>
  </div>
</form>
    </div>
  </div>
</div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')
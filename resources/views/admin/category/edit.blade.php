@section('title')
    Edit Category
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
<div class="container">
  	<div class="row">            
		<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Category</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                             <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('category.index')}}" class="fw-normal">Category List</a></li>
                            </ol>
                            <a href="{{route('category.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Add Category</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
	</div>
	<div class="row">
	    <h1 class="text-center">EDIT CATEGORY</h1>
        <form action="{{ route('category.update',['id'=>$category->id]) }}" method="post" name="category">
        @method("put")
        @csrf
        <div class="form-group">
            <label for="name">CategoryName</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}">
            @include('common.singleAlertError',['field'=>'name'])
        </div>
          <div class="d-grid gap-2">
        <button type="submit" class="btn btn-danger btn-block">Accept Update</button>
          </div>
    </form>
	</div>
</div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')
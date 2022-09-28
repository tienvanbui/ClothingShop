@section('title')
    Create Menu
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
<div class="container">
	<div class="row"> 
        <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Menu</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('menu.index')}}" class="fw-normal">Menu List</a></li>
                            </ol>
                            <a href="{{route('menu.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create Menu Item</a>
                        </div>
                    </div>
                </div>
        </div> 
	</div>
    <div class="row">
        <div class="container">
            <h1 class="text-center">CREATE MENU</h1> 
            <form action="{{route('menu.store')}}" method="post">
                 @csrf
                <div class="form-group">
                    <label for="name">Menu Name</label>
                    <input type="text" class="form-control" id="name" aria-describedby="name" placeholder="ENTER NAME MENU" name="name">
                    @include('common.singleAlertError',['field'=>'name'])
                </div>
                <div class="form-group">
                    <label for="parent_id">Belong To Menu</label>
                    <select class="form-select" aria-label="Default select example" name="parent_id">
                        <option selected value="0">Open this select menu</option>
                        {{!! $htmlOption!!}}
                    </select>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary ">Create</button>
                </div>
            </form>
        </div>
	</div>
</div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')
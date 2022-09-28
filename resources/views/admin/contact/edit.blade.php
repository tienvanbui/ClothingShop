@section('title')
    Edit Contact
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
<div class="container">
	<div class="row"> 
        <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Contact</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">z
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('contact.index')}}" class="fw-normal">Contact Information</a></li>
                            </ol>
                            <a href="{{route('contact.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create Contact</a>
                        </div>
                    </div>
                </div>
        </div> 
	</div>
    <div class="row">
        <div class="container">
            <h1 class="text-center">EDIT CONTACT INFORMATION</h1> 
            <form action="{{route('contact.update',['contact'=>$contact])}}" method="post">
                @method('put')
                 @csrf
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" aria-describedby="address" placeholder="Enter address of your shop" name="address" value="{{$contact->address}}">
                    @include('common.singleAlertError',['field'=>'address'])
                </div>
                <div class="form-group">
                    <label for="talk">Lets Talk</label>
                     <input type="text" class="form-control" id="talk" aria-describedby="talk" placeholder="Lets Talk" name="talk" value="{{$contact->talk}}">
                     @include('common.singleAlertError',['field'=>'talk'])
                </div>
                 <div class="form-group">
                    <label for="saleEmail">Sales Support Email</label>
                     <input type="email" class="form-control" id="sale_email" aria-describedby="sale_email" placeholder="Enter Sales Email Support" name="sale_email" value="{{$contact->sales_email}}">
                     @include('common.singleAlertError',['field'=>'sale_email'])
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
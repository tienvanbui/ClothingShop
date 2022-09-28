@section('title', 'Create Payment Method')
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Payment Method</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                <li><a href="{{ route('payment.index') }}" class="fw-normal">Payment Method List</a></li>
              </ol>
              <a href="{{ route('payment.create') }}"
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create
                Payment Method</a>
            </div>
          </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <div class="row">
      <div class="container">
        <h1 class="text-center">EDIT PAYMENT METHOD</h1>
        <form action="{{ route('payment.update', ['payment' => $payment]) }}" method="post">
          @method('PUT')
          @csrf
          <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <input type="text" class="form-control" id="payment_method" aria-describedby="payment_method"
              placeholder="ENTER PAYMENT METHOD" name="payment_method" value="{{ $payment->payment_method }}">
            @include('common.singleAlertError', ['field' => 'payment_method'])
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

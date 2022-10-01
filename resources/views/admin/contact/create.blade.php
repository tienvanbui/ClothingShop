@section('title')
  Cập nhật thông tin
@endsection
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="container">
        <h1 class="text-center mt-4">CẬP NHẬT THÔNG TIN LIÊN HỆ</h1>
        <form action="{{ route('contact.update', ['contact' => $contact]) }}" method="post">
          @method('put')
          @csrf
          <div class="form-group">
            <label for="address">Địa chỉ</label><span style="color:red">*</span>
            <input type="text" class="form-control" id="address" aria-describedby="address"
              placeholder="Nhập địa chỉ cửa hàng" name="address" value="{{$contact->address}}">
            @include('common.singleAlertError', ['field' => 'address'])
          </div>
          <div class="form-group">
            <label for="talk">Số điện thoại cửa hàng</label><span style="color:red">*</span>
            <input type="text" class="form-control" id="talk" aria-describedby="talk"
              placeholder="Số điện thoại cửa hàng" name="talk" value="{{$contact->talk}}">
            @include('common.singleAlertError', ['field' => 'talk'])
          </div>
          <div class="form-group">
            <label for="saleEmail">Địa chỉ email hỗ trợ</label><span style="color:red">*</span>
            <input type="email" class="form-control" id="sale_email" aria-describedby="sale_email"
              placeholder="Nhập địa chỉ email hỗ trợ" name="sale_email" value="{{$contact->sale_email}}">
            @include('common.singleAlertError', ['field' => 'sale_email'])
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary ">Cập nhật</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')

@section('title', 'Thông tin tài khoản')
@include('layouts.user.header')
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url({{ asset('/images/user/bg-01.jpg') }});">
  <h2 class="ltext-105 cl0 txt-center">
    Thông tin tài khoản
  </h2>
</section>
<div class="container">
  <form action="{{ route('user.profile.update', ['profile' => auth()->user()->id]) }}" method="post"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
      <div class="col-lg-4 col-md-12 my-5">
        <div class="user-content">
          <img src="{{ auth()->user()->avatar }}" alt="img" style="width:300px;height:300px;border-radius:999px">
          <h4 class="text-white mt-2">{{ auth()->user()->username }}</h4>
        </div>
        <div class="user-btm-box d-md-flex">
          <label style="color: black;font-weight:900">Avatar:</label>
          <input type="file" name="avatar" class="form-control-file ml-1">
          @include('common.singleAlertError',['field'=>'avatar'])
        </div>
      </div>
      <div class="col-lg-8 col-md-12 my-5">
        <div class="form-group mb-4">
          <label class="col-md-12 p-0" style="font-weight:900 !important;color:black">Tên</label>
          <div class="col-md-12 p-0" style="border-bottom:1px solid black">
            <input type="text" placeholder="Johnathan Doe" class="form-control p-0 border-0"
              value="{{ auth()->user()->name }}" name="name">
              @include('common.singleAlertError',['field'=>'name'])
          </div>
        </div>
        <div class="form-group mb-4">
          <label for="example-email" class="col-md-12 p-0" style="font-weight:900 !important;color:black">Email</label>
          <div class="col-md-12 p-0" style="border-bottom:1px solid black">
            <input type="email" placeholder="johnathan@admin.com" class="form-control p-0 border-0" name="email"
              id="example-email" value="{{ auth()->user()->email }}">
              @include('common.singleAlertError',['field'=>'email'])
          </div>
        </div>
        <div class="form-group mb-4">
          <label class="col-md-12 p-0" style="font-weight:900 !important;color:black">Tên đăng nhập</label>
          <div class="col-md-12  p-0" style="border-bottom:1px solid black">
            <input type="username"class="form-control p-0 border-0" value="{{ auth()->user()->username }}"
              name="username">
              @include('common.singleAlertError',['field'=>'username'])
          </div>
        </div>
        <div class="form-group mb-4">
          <label class="col-md-12 p-0" style="font-weight:900 !important;color:black">Số điện thoại</label>
          <div class="col-md-12 p-0" style="border-bottom:1px solid black">
            <input type="text"class="form-control p-0 border-0" value="{{ auth()->user()->phoneNumber }}"
              name="phoneNumber">
              @include('common.singleAlertError',['field'=>'phoneNumber'])
          </div>
        </div>
        <div class="form-group mb-4">
          <label class="col-md-12 p-0" style="font-weight:900 !important;color:black">Địa chỉ</label>
          <div class="col-md-12  p-0" style="border-bottom:1px solid black">
            <input type="text"class="form-control p-0 border-0" value="{{ auth()->user()->address }}" name="address">
            @include('common.singleAlertError',['field'=>'address'])
          </div>
        </div>
        <div class="form-group mb-4">
          <button type="submit" class="btn btn-dark text-white">Cập nhật thông tin cá nhân</button>
        </div>
      </div>
    </div>
  </form>
</div>

@include('layouts.user.footer')

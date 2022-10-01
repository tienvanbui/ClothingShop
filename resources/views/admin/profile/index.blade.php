@section('title', 'Thông tin tài khoản')
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <h2 class="text-center text-dark mt-4">THÔNG TIN TÀI KHOẢN</h2>
      @include('common.message')
      <div class="wapper mt-5">
        <form action="{{ route('profile.update', ['profile' => auth()->user()->id]) }}" method="post"
          enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="row">
            <div class="col-lg-4 col-xlg-3 col-md-12">
              <div class="white-box">
                <div class="user-bg">
                  <div class="overlay-box">
                    <div class="user-content">
                      <img src="{{ auth()->user()->avatar }}"class="thumb-lg img-circle" alt="img">
                      <h4 class="text-white mt-2">{{ auth()->user()->username }}</h4>
                    </div>
                  </div>
                </div>
                <div class="user-btm-box mt-5 d-md-flex">
                  <label>Avatar:</label>
                  <input type="file" name="avatar" class="form-control-file ml-1">
                </div>
              </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-12">
              <div class="card">
                <div class="card-body">
                  <form class="form-horizontal form-material">
                    <div class="form-group mb-4">
                      <label class="col-md-12 p-0">Tên</label>
                      <div class="col-md-12 border-bottom p-0">
                        <input type="text" placeholder="Johnathan Doe" class="form-control p-0 border-0"
                          value="{{ auth()->user()->name }}" name="name">
                      </div>
                    </div>
                    <div class="form-group mb-4">
                      <label for="example-email" class="col-md-12 p-0">Email</label>
                      <div class="col-md-12 border-bottom p-0">
                        <input type="email" placeholder="johnathan@admin.com" class="form-control p-0 border-0"
                          name="email" id="example-email" value="{{ auth()->user()->email }}">
                      </div>
                    </div>
                    <div class="form-group mb-4">
                      <label class="col-md-12 p-0">Tên đăng nhập</label>
                      <div class="col-md-12 border-bottom p-0">
                        <input type="username"class="form-control p-0 border-0" value="{{ auth()->user()->username }}"
                          name="username">
                      </div>
                    </div>
                    <div class="form-group mb-4">
                      <label class="col-md-12 p-0">Số điện thoại</label>
                      <div class="col-md-12 border-bottom p-0">
                        <input type="text"class="form-control p-0 border-0" value="{{ auth()->user()->phoneNumber }}"
                          name="phoneNumber">
                      </div>
                    </div>
                    <div class="form-group mb-4">
                      <label class="col-md-12 p-0">Địa chỉ</label>
                      <div class="col-md-12 border-bottom p-0">
                        <input type="text"class="form-control p-0 border-0" value="{{ auth()->user()->address }}"
                          name="address">
                      </div>
                    </div>
                    <div class="form-group mb-4">
                      <div class="col-sm-12">
                        <button type="submit" class="btn btn-success text-white">Cập nhật thông tin tài khoản</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')

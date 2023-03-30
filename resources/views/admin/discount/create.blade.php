@section('title', 'Tạo sự kiện giảm giá')
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Sự kiện giảm giá</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{ route('discount.index') }}" class="fw-normal">Danh sách sự kiện giảm giá</a>
                                </li>
                            </ol>
                            <a href="{{ route('discount.create') }}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Tạo
                                sự kiện giảm giá</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <div class="row">
            <div class="container">
                <h1 class="text-center">TẠO SỰ KIỆN GIẢM GIÁ </h1>
                <form action="{{ route('discount.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="discount_event_name">Tên sự kiện giảm giá:</label>
                        <input type="text" class="form-control" id="discount_event_name"
                            aria-describedby="discount_event_name" placeholder="Nhập tên sự kiện giảm giá"
                            name="discount_event_name" value="{{ old('discount_event_name') }}">
                        @include('common.singleAlertError', ['field' => 'discount_event_name'])

                    </div>
                    <div class="form-group">
                        <label for="description_discount_event">Mô tả sự kiện giảm giá:</label>
                        <textarea name="description_discount_event" class="form-control" rows="20" id="ck_editor_discount_create"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="discount_percent">Phần trăm giảm giá:</label>
                        <input type="text" class="form-control" id="discount_percent" aria-describedby="discount_percent"
                            placeholder="Nhập phần trăm giảm giá" name="discount_percent"
                            value="{{ old('discount_percent') }}">
                        @include('common.singleAlertError', ['field' => 'discount_percent'])
                    </div>
                    <div class="form-group">
                        <label for="start_date_event">Thời gian bắt đầu:</label>
                        <input type="text" class="form-control" id="start_date_event" aria-describedby="start_date_event"
                            placeholder="Thời gian bắt đầu" name="start_date_event" value="{{ old('start_date_event') }}">
                            
                        @include('common.singleAlertError', ['field' => 'start_date_event'])
                    </div>
                    <div class="form-group">
                        <label for="end_date_event">Thời gian kết thúc:</label>
                        <input type="text" class="form-control" id="end_date_event" aria-describedby="end_date_event"
                            placeholder="Thời gian kết thúc" name="end_date_event" value="{{ old('end_date_event') }}">
                        @include('common.singleAlertError', ['field' => 'end_date_event'])
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="active" checked>
                        <label class="form-check-label" for="active">Hoạt động</label>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary ">Tạo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')

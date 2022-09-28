@section('title', 'Detail Blog')
@include('layouts.admin.header')
@include('layouts.admin.slidebar')
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Blog</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="
                                    {{ route('blog.index') }}
                                   "
                                        class="fw-normal">Blogs List</a></li>
                            </ol>
                            <a href="
                                    {{ route('blog.create') }}
                                   "
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create
                                Blog</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12">
                <h2 class="text-center">Content</h2>
                {!! $blog->blog_content !!}
            </div>
        </div>
    </div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')

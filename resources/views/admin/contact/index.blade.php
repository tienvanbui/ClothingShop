@section('title')
  Contact
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
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                <li><a href="{{ route('contact.index') }}" class="fw-normal">Contact Information</a></li>
              </ol>
              <a href="{{ route('contact.create') }}"
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create
                Contact</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="container">
        <h1 class="text-center">CONTACT</h1>
        @include('common.message')
        <table class="table table-hover table-bordered">
          <thead style="width: 100%;background-color:black">
            <tr>
              <th scope="col" class="text-white">Address</th>
              <th scope="col" class="text-white">Lets Talk</th>
              <th scope="col" class="text-white">Sales Support Email</th>
              <th scope="col" class="text-white">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ $contact->address }}</td>
              <td>{{ $contact->talk }}</td>
              <td>{{ $contact->sale_email }}</td>
              <td>
                <a href="{{ route('contact.edit', ['contact' => $contact->id]) }}"
                  class="btn btn-primary btn-sm text-white"><i class="fas fa-edit"></i></a>
                @include('common.delete', [
                    'routeName' => 'contact.destroy',
                    'itemname' => 'contact',
                    'item' => $contact,
                ])
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
@include('layouts.admin.main')
@include('layouts.admin.footer')

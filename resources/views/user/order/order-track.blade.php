@section('title', 'Track your order')
@include('layouts.user.header')
<div class="container" style="margin-top: 150px;margin-bottom:150px;">
  <div class="row">
    <h3 class="fw-bold" style="font-weight: bold;margin-bottom:40px;">Your Order</h3>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col" style="font-weight: bold">#</th>
            <th scope="col" style="font-weight: bold">Product Name</th>
            <th scope="col" style="font-weight: bold">Image</th>
            <th scope="col" style="font-weight: bold">Price</th>
            <th scope="col" style="font-weight: bold">Quanlity</th>
            <th scope="col" style="font-weight: bold">Date</th>
            <th scope="col" style="font-weight: bold">Status</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($detailOrders as $index => $product)
            <tr>
              <th scope="row">{{ $index + 1 }}</th>
              <td>{{ $product->product_name }}</td>
              <td><img src="{{ asset($product->product_image) }} " width="100px" height="100px"></td>
              <td>{{ '$' . number_format($product->price) }}</td>
              <td>{{ $product->buy_quanlity }}</td>
              <td>{{ date('d/m/Y H:i:s', strtotime($product->created_at)) }}</td>
              <td>
                @if ($product->status == 0)
                  <span class="text-primary">Pending</span>
                @elseif($product->status == 1)
                  <form method="post" id="btnOrderTrackForm{{ $product->id }}">
                    @csrf
                    <button class="btn btn-sm btn-danger track_order-button rounded-pill" data-order_status="2"
                      data-order_id="{{ $product->id }}">Shipping</button>
                  </form>
                @elseif ($product->status == 2)
                  <button class="text-white fw-bold btn btn-warning btn-sm rounded-pill">Shipped</button>
                @endif
                <div class="order-tracked_button_{{ $product->id }}"></div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@include('layouts.user.footer')

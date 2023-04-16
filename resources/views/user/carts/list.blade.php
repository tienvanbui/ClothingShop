@section('title', 'Giỏ hàng')
@include('layouts.user.header')
<!-- Shoping Cart -->
<div class="bg0 p-t-75 p-b-85 mt-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
        <div class=" m-r--38 m-lr-0-xl">
          <div class="wrap-table-shopping-cart">
            <table class="table-shopping-cart">
              <tr class="table_head">
                <th class="column-1">Ảnh</th>
                <th class="column-2" style="width:20%"></th>
                <th class="column-3">Giá</th>
                <th class="column-4 pr-5">Số lượng</th>
                <th class="column-5">Giá</th>
                <th class="column-6" style="width:15%">Hành động</th>
              </tr>
              @if (!empty($cart->products))
                @foreach ($cart->products as $index => $item)
                  <tr class="table_row">
                    <td class="column-1 item-data{{ $index }}" data-item_id="{{ $index }}">
                      <form method="POST">
                        @csrf
                        @method('DELETE')
                        <button type='submit' class="how-itemcart1 btnDelete-cart_product_item">
                          <img src="{{ asset($item->product_image) }}" alt="{{ $item->product_image_name }}">
                        </button>
                        <input type="hidden" name="user_id_delete" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="product_id_delete" value="{{ $item->pivot->product_id }}">
                        <input type="hidden" name="size_id_delete" value="{{ $item->pivot->size_id }}">
                        <input type="hidden" name="color_id_delete" value="{{ $item->pivot->color_id  }}">
                      </form>
                    </td>
                    <td class="column-2">{{ $item->product_name }}</td>
                    <td class="column-3">{{ number_format($item->price) }}</td>
                    <td class="column-4 item-update-data{{ $index }}">
                      <form method="post" class="update-cart-ajax{{$index}}">
                        @method('PUT')
                        @csrf
                        <input type="number" name="user_id" class="d-none" value="{{ auth()->user()->id }}">
                        <input type="number" name="cart_id" class="d-none" value="{{ $item->pivot->cart_id }}">
                        <input type="number" name="product_id" class="d-none" value="{{ $item->pivot->product_id }}">
                        <input type="hidden" name="size_id_update" value="{{ $item->pivot->size_id }}">
                        <input type="hidden" name="color_id_update" value="{{ $item->pivot->color_id }}">
                        <div class="wrap-num-product flex-w m-l-auto m-r-5">
                          <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                            <i class="fs-16 zmdi zmdi-minus"></i>
                          </div>

                          <input class="mtext-104 cl3 txt-center num-product" type="number" name="buy_quanlity"
                            value="{{ $item->pivot->buy_quanlity }}" disabled>

                          <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                            <i class="fs-16 zmdi zmdi-plus"></i>
                          </div>
                        </div>
                    </td>
                    <td class="column-5">
                      {{ number_format($item->pivot->total_price) }}</td>
                    <td class="column-6">
                      <button type="button" data-item_id="{{$index}}"
                        class="flex-c-m stext-110 cl2 size-122  bor13 hov-btn3  trans-04 pointer m-tb-10 mr-5 btnUpdateCartItem">
                        Cập nhật
                      </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              @endif
              @if (!empty(Session::has('cart') && !empty($cart)))
                @foreach ($cart as $index => $item)
                  <tr class="table_row">
                    <td class="column-1 item-data{{ $index }}" data-item_id="{{ $index }}">
                      <form method="POST">
                        @csrf
                        @method('DELETE')
                        <button type='submit' class="how-itemcart1 btnDelete-cart_product_item">
                          <img src="{{ asset($item['product_image']) }}" alt="{{ $item['product_image_name'] }}">
                        </button>
                        <input type="hidden" name="user_id_delete">
                        <input type="hidden" name="product_id_delete" value="{{ $item['product_id'] }}">
                        <input type="hidden" name="size_id_delete" value="{{ $item['size_id'] }}">
                        <input type="hidden" name="color_id_delete" value="{{ $item['color_id'] }}">
                      </form>
                    </td>
                    <td class="column-2">{{ $item['product_name'] }}</td>
                    <td class="column-3">{{ number_format($item['price']) }}</td>
                    <td class="column-4 item-update-data{{ $index }}">
                      <form method="post" class="update-cart-ajax">
                        @method('PUT')
                        @csrf
                        <input type="number" name="user_id" class="d-none">
                        <input type="number" name="cart_id" class="d-none" value="{{ $index }}">
                        <input type="number" name="product_id" class="d-none" value="{{ $item['product_id'] }}">
                        <input type="hidden" name="size_id_update" value="{{ $item['size_id'] }}">
                        <input type="hidden" name="color_id_update" value="{{ $item['color_id'] }}">
                        <div class="wrap-num-product flex-w m-l-auto m-r-5">
                          <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                            <i class="fs-16 zmdi zmdi-minus"></i>
                          </div>

                          <input class="mtext-104 cl3 txt-center num-product" type="number" name="buy_quanlity"
                            value="{{ $item['buy_quanlity'] }}" disabled>

                          <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                            <i class="fs-16 zmdi zmdi-plus"></i>
                          </div>
                        </div>
                    </td>
                    <td class="column-5">
                      {{ number_format($item['total_price']) }}</td>
                    <td class="column-6">
                      <button type="button" data-item_id="{{$index}}"
                        class="flex-c-m stext-110 cl2 size-122  bor13 hov-btn3  trans-04 pointer m-tb-10 mr-5 btnUpdateCartItem">
                        Cập nhật
                      </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              @endif
            </table>
          </div>
        </div>
      </div>

      <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
          <h4 class="mtext-109 cl2 p-b-30">
            Thông tin giỏ hàng
          </h4>

          <div class="flex-w flex-t bor12 p-b-13">
            <div class="size-208">
              <span class="stext-110 cl2">
                Tổng tiền:
              </span>
            </div>

            <div class="size-209">
              @if ($totalPrice)
                <span class="mtext-110 cl2">
                  {{ number_format($totalPrice) . 'VNĐ' }}
                </span>
              @endif
            </div>
          </div>
          @if (!empty($cart->products))
            @if ($cart->products->count() > 0)
              <a href="{{ route('payment.confirm') }}"
                class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer text-white">
                Tiến hàng đặt hàng
              </a>
            @endif
          @endif
          @if (Session::has('cart'))
            <a href="{{ route('payment.confirm') }}"
              class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer text-white">
              Tiến hàng đặt hàng
            </a>
          @endif

        </div>
      </div>
    </div>
  </div>
</div>
@include('layouts.user.footer')

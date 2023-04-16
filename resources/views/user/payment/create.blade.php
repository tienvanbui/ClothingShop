@section('title', 'Xác nhận phương thức thanh toán và thanh toán')
@include('layouts.user.header')
<div class="bg0 p-t-75 p-b-85 mt-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
        <div class="m-l-25 m-r--38 m-lr-0-xl">
          <div class="wrap-table-shopping-cart">
            <table class="table-shopping-cart">
              <tr class="table_head">
                <th class="column-1">Sản phẩm</th>
                <th class="column-2"></th>
                <th class="column-3">Giá</th>
                <th class="column-4 pr-5">Số lượng</th>
                <th class="column-5">Tổng tiền</th>
              </tr>
              @foreach ($cart->products as $item)
                <tr class="table_row">
                  <td class="column-1">

                    <div class="how-itemcart1">
                      <img src="{{ asset($item->product_image) }}" alt="{{ $item->product_image_name }}">
                    </div>
                  </td>
                  <td class="column-2">{{ $item->product_name }}</td>
                  <td class="column-3">{{ $item->price .'VNĐ' }}</td>
                  <td class="column-4">
                    <div class="text-center">
                      {{ 'x' . $item->pivot->buy_quanlity }}
                    </div>
                  </td>
                  <td class="column-5">{{ number_format($item->pivot->total_price) . 'VNĐ' }}</td>
                </tr>
              @endforeach
            </table>
          </div>
          <form method="POST">
            @csrf
            <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-l-40 p-lr-15-sm">
              <div class="flex-w flex-m m-r-20 m-tb-5">
                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-60 mr-5 m-tb-5 confirm-cart_couponCode_input"
                  type="text" name="coupon_code" placeholder="Coupon Code" style="width:390px">
                <button
                  class="flex-c-m stext-101 cl2 size-119 bg-dark bor13 hov-btn3 p-r-15 trans-04 pointer m-tb-10  text-white btn-confirm-cart_applyCoupon px-3"
                  type="submit">
                  Áp dụng giảm giá
                </button>
              </div>
            </div>
            <input type="hidden" class="discount-price-of-products" value="{{ $totalPrice }}">
          </form>
          <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-l-40 p-lr-15-sm input-data-request">
            <span class="text-dark font-weight-bold ml-4">Nếu sử dụng thanh toán bằng thẻ. Bạn sẽ được giảm giá 2%</span>
            <div class="flex-w flex-m m-r-20 m-tb-5 ">
              @foreach ($payments as $paymentMethod)
                <div class="form-check ml-5 payment-radio-button-cart-payment">
                  <input class="form-check-input" type="radio" value="{{ $paymentMethod->id }}"
                    id="defaultCheck{{ $paymentMethod->id }}" name="payment_id"
                    data-slug_payment="{{ $paymentMethod->slug }}">
                  <label class="form-check-label" for="defaultCheck{{ $paymentMethod->id }}">
                    {{ $paymentMethod->payment_method }}
                  </label>
                </div>
              @endforeach
              <div class="form-group">
                <input type="hidden" name="total" class="discount-price-of-products" value="{{ $totalPrice }}">
              </div>
              <div class="form-goup">
                <input type="hidden" value="{{ auth()->user()->cart->id }}" name="cart_id">
              </div>
              <div class="form-goup">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
              </div>
            </div>
            <button type="submit"
              class="flex-c-m stext-101 cl2 size-119 bg-dark bor13 hov-btn3  trans-04 pointer m-tb-10 mr-4 text-white start-payment-button px-2">
              Tiến hành đặt hàng
            </button>
          </div>
        </div>
      </div>
      <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
          <h4 class="mtext-109 cl2 p-b-30">
            Cart Totals
          </h4>
          <div class="flex-w flex-t bor12 p-b-13">
            <div class="size-208">
              <span class="stext-110 cl2">
                Tổng tiền:
              </span>
            </div>

            <div class="size-209">
              <span class="mtext-110 cl2">
                {{ number_format($totalPrice) .'VNĐ' }}
              </span>
            </div>
          </div>
          <div class="flex-w flex-t bor12 p-t-15 p-b-30">
            <div class="size-208 w-full-ssm">
              <span class="stext-110 cl2">
                Giảm giá:
              </span>
            </div>

            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
              <p class="discount_payment_type">
                @if (!request()->ajax())
                  {{ 0 .'VNĐ' }}
                @endif
              </p>
            </div>
          </div>
          <div class="flex-w flex-t bor12 p-t-15 p-b-30">
            <div class="size-208 w-full-ssm">
              <span class="stext-110 cl2">
                Vận chuyển:
              </span>
            </div>

            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
              <p class="stext-111 cl6 p-t-2">
                Chúng tôi sẽ gửi sản phẩm đến địa chỉ bạn viết bên dưới. Vui lòng kiểm tra địa chỉ của bạn để nhận sản phẩm. Cảm ơn!
              </p>

              <div class="p-t-15">
                <span class="stext-112 cl8">
                  Tính toán vận chuyển
                </span>
                <div class="bor8 bg0 m-b-12">
                  <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address" placeholder="Địa chỉ"
                    value="{{ auth()->user()->address }}">
                </div>
                <div class="bor8 bg0 m-b-12">
                  <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phoneNumber"
                    placeholder="phone number" value="{{ auth()->user()->phoneNumber }}">
                </div>
              </div>
            </div>
          </div>
          <div class="flex-w flex-t p-t-27 p-b-33">
            <div class="size-208">
              <span class="mtext-101 cl2">
                Tổng tiền:
              </span>
            </div>

            <div class="size-209 p-t-1">
              <span class="mtext-110 cl2 total-after-discounting">
                @if (!request()->ajax())
                  {{ number_format($totalPrice) . 'VNĐ' }}
                @endif
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('layouts.user.footer')

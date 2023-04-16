<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-lg-4 p-b-50">
        <h4 class="stext-301 cl0 p-b-30">
          ĐƠN HÀNG
        </h4>

        <ul>
          <li class="p-b-10">
            <a href="{{ route('order.track-user') }}" class="stext-107 cl7 hov-cl1 trans-04">
              Kiểm tra tình trạng
            </a>
          </li>
        </ul>
      </div>

      <div class="col-sm-6 col-lg-4 p-b-50">
        <h4 class="stext-301 cl0 p-b-30">
          GIÚP ĐỠ
        </h4>

        <ul>
          <li class="p-b-10">
            <a href="/view-about" class="stext-107 cl7 hov-cl1 trans-04">
              Về chúng tôi
            </a>
          </li>
        </ul>
      </div>

      <div class="col-sm-6 col-lg-4 p-b-50">
        <h4 class="stext-301 cl0 p-b-30">
          LIÊN LẠC
        </h4>

        <p class="stext-107 cl7 size-201">
          Nếu bạn có bất kỳ câu hỏi nào?Hãy gọi cho chúng tôi qua số điện thoại 0365936522
        </p>

      </div>

      {{-- <div class="col-sm-6 col-lg-3 p-b-50">
        <h4 class="stext-301 cl0 p-b-30">
          Bản tin
        </h4>

        <form>
          <div class="wrap-input1 w-full p-b-4">
            <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email"
              placeholder="email@example.com">
            <div class="focus-input1 trans-04"></div>
          </div>

          <div class="p-t-18">
            <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
              Đặt mua
            </button>
          </div>
        </form>
      </div> --}}
    </div>
  </div>
</footer>

<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
  <span class="symbol-btn-back-to-top">
    <i class="zmdi zmdi-chevron-up"></i>
  </span>
</div>

<script src="{{ asset('/css/user/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('/css/user/vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('/css/user/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/css/user/vendor/select2/select2.min.js') }}"></script>
<script>
  $(".js-select2").each(function() {
    $(this).select2({
      minimumResultsForSearch: 20,
      dropdownParent: $(this).next('.dropDownSelect2')
    });
  })
</script>
<script src="{{ asset('/css/user/vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('/js/user/slick-custom.js') }}"></script>
<script src="{{ asset('/css/user/vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
<script>
  $('.gallery-lb').each(function() { // the containers for all your galleries
    $(this).magnificPopup({
      delegate: 'a', // the selector for gallery item
      type: 'image',
      gallery: {
        enabled: true
      },
      mainClass: 'mfp-fade'
    });
  });
</script>
@include('sweetalert::alert')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('/css/user/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('/js/user/main.js') }}"></script>
<script src="{{ asset('/js/user/call-ajax.js') }}"></script>

</body>

</html>

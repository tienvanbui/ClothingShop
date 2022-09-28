<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title')</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="{{ asset('/fonts/linearicons-v1.0.0/icon-font.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/fonts/iconic/css/material-design-iconic-font.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('/images/user/icons/favicon.png') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/user/vendor/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/vendor/select2/select2.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/vendor/slick/slick.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/vendor/MagnificPopup/magnific-popup.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/util.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/main.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:ital,wght@0,400;1,300&display=swap"
    rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

  <!-- Header -->
  <header>
    <!-- Header desktop -->
    <div class="container-menu-desktop ">
      <!-- Topbar -->
      <div class="top-bar">
        <div class="content-topbar flex-sb-m h-full container">
          <div class="left-top-bar">
            Free shipping for standard order over $100
          </div>

          <div class="right-top-bar flex-w h-full">
            <a href="{{ route('about-user') }}" class="flex-c-m trans-04 p-lr-25">
              Help & FAQs
            </a>
            @if (auth()->check())
              <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
                <img src="{{ asset(auth()->user()->avatar) }}" alt="user-img" width="30" class="img-circle"><span
                  class="text-white font-medium">{{ auth()->user()->username }}</span>
              </a>
            @endif
            @if (auth()->check())
              <form action="{{ route('logout') }} " method="post" class="flex-c-m trans-04 p-lr-25">
                @csrf
                <button type='submit' class="btn btn-danger btn-sm">
                  Logout
                </button>
              </form>
            @else
              <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25" aria-pressed="true">Log
                In</a>
            @endif

          </div>
        </div>
      </div>

      <div class="wrap-menu-desktop bg-white">
        <nav class="limiter-menu-desktop container">

          <!-- Logo desktop -->
          <a href="{{ route('home-user') }}" class="logo">
            <img src="{{ asset('images/user/icons/logo-01.png') }}" alt="IMG-LOGO">
          </a>

          <!-- Menu desktop -->
          <div class="menu-desktop">
            <ul class="main-menu">
              @foreach ($menus as $parentMenuItem)
                <li>
                  <a href='{{ route("$parentMenuItem->slug-user") }}'>{{ $parentMenuItem->name }}</a>
                  @if ($parentMenuItem->menus()->count())
                    <ul class="sub-menu">
                      @foreach ($parentMenuItem->menus as $itemChild)
                        <li><a href="{{ route('user.shop.showByCategory', ['slug' => $itemChild->slug]) }}"
                            class="shop_show-category">{{ $itemChild->name }}</a>
                        </li>
                      @endforeach
                    </ul>
                    <span class="arrow-main-menu">
                      <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </span>
                  @endif
                </li>
              @endforeach
            </ul>
          </div>

          <!-- Icon header -->
          <div class="wrap-icon-header flex-w flex-r-m">
            <div
              class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart header-cart-count"
              data-notify="{{ $countCartProduct }}">
              <i class="zmdi zmdi-shopping-cart"></i>
            </div>

          </div>
        </nav>
      </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
      <!-- Logo moblie -->
      <div class="logo-mobile">
        <a href="{{ route('home-user') }}"><img src="{{ asset('images/user/icons/logo-01.png') }}" alt="IMG-LOGO"></a>
      </div>

      <!-- Icon header -->
      <div class="wrap-icon-header flex-w flex-r-m m-r-15">
        <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
          data-notify="{{ $countCartProduct }}">
          <i class="zmdi zmdi-shopping-cart"></i>
        </div>
      </div>

      <!-- Button show menu -->
      <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
        <span class="hamburger-box">
          <span class="hamburger-inner"></span>
        </span>
      </div>
    </div>

    <!-- Menu Mobile -->
    <div class="menu-mobile">
      <ul class="topbar-mobile">
        <li>
          <div class="left-top-bar">
            Free shipping for standard order over $100
          </div>
        </li>

        <li>
          <div class="right-top-bar flex-w h-full">
            <a href="{{ route('about-user') }}" class="flex-c-m p-lr-10 trans-04">
              Help & FAQs
            </a>

            @if (auth()->check())
              <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
                <img src="{{ asset(auth()->user()->avatar) }}" alt="user-img" width="30"
                  class="img-circle"><span class="text-white font-medium">{{ auth()->user()->username }}</span>
              </a>
            @endif
            @if (auth()->check())
              <form action="{{ route('logout') }} " method="post" class="flex-c-m trans-04 p-lr-25">
                @csrf
                <button type='submit' class="btn btn-danger btn-sm">
                  Logout
                </button>
              </form>
            @else
              <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25" aria-pressed="true">Log
                In</a>
            @endif
          </div>
        </li>
      </ul>

      <ul class="main-menu-m">
        @foreach ($menus as $parentMenuItem)
          <li>
            <a href='{{ route("$parentMenuItem->slug-user") }}'>{{ $parentMenuItem->name }}</a>
            @if ($parentMenuItem->menus()->count())
              <ul class="sub-menu">
                @foreach ($parentMenuItem->menus as $itemChild)
                  <li><a
                      href="{{ route('user.shop.showByCategory', ['slug' => $itemChild->slug]) }}">{{ $itemChild->name }}</a>
                  </li>
                @endforeach
              </ul>
              <span class="arrow-main-menu">
                <i class="fa fa-angle-down" aria-hidden="true"></i>
              </span>
            @endif
          </li>
        @endforeach
      </ul>
    </div>
  </header>

  <!-- Cart -->
  <div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
      <div class="header-cart-title flex-w flex-sb-m p-b-8">
        <span class="mtext-103 cl2">
          Your Cart
        </span>

        <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
          <i class="zmdi zmdi-close"></i>
        </div>
      </div>

      @if (auth()->check())
        <div class="header-cart-content flex-w js-pscroll">
          <ul class="header-cart-wrapitem w-full">
            @if (!empty($cart->products))
              @foreach ($cart->products as $product)
                <li class="header-cart-item flex-w flex-t m-b-12">
                  <div class="header-cart-item-img">
                    <img src="{{ $product->product_image }}" alt="{{ $product->product_image_name }}">
                  </div>

                  <div class="header-cart-item-txt p-t-8">
                    <a href="{{ route('shop.show', ['product' => $product->id]) }}"
                      class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                      {{ $product->product_name }}
                    </a>

                    <span class="header-cart-item-info">
                      {{ $product->pivot->buy_quanlity }} x
                      {{ '$' . number_format($product->price) }}
                    </span>
                  </div>
                </li>
              @endforeach
            @endif
            <div class="add-ajax-product-insert"></div>
          </ul>

          <div class="w-full">
            <div class="header-cart-total w-full p-tb-40">
              Total: {{ '$' . number_format($totalPrice) }}
            </div>
            <div class="header-cart-buttons flex-w w-full">
              <a href="{{ route('view-cart') }}"
                class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                View Cart
              </a>
              <a href="{{ route('payment.confirm') }}"
                class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                Check Out
              </a>
            </div>
          </div>
        </div>
      @endif
    </div>
  </div>

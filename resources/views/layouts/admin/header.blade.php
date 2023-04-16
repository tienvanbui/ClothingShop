<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/plugins/images/favicon.png') }}">
  <!-- Custom CSS -->
  <link href="{{ asset('/css/admin/css/style.min.css') }}" rel="stylesheet">
  @yield('css')
  {{-- CkEditor --}}
  <script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

  <style>
    body {
      font-size: 1rem !important;
      font-weight: 500 !important;
    }

    .accordion-button:not(.collapsed) {
      color: #ffffff;
      background-color: rgba(0, 0, 0, 0.8);
    }

    .sidebar-item>a:hover {
      background-color: rgba(0, 0, 0, 0.3) !important;
      color: #ffffff !important;
    }

    .item-link {
      width: 220px;
    }

    .accordion-item>h2>span>i {
      line-height: 20px !important;
      width: 32px !important;
      height: 20px !important;
      padding-left: 7px !important;
    }

    .page-wrapper {
      background: #ffffff !important;
    }

    /* .table thead th {
      color: #ffffff !important;
    } */
    ul>.select2-selection__choice {
      background-color: black !important;
      color: #ffffff !important;
    }
    .left-sidebar {
      z-index: 1;
    }
    #notification-icon{
      position: relative;
    }
    #notification-icon span{
      position: absolute;
      top: 0;
      background: red;
      border-radius: 99px;
      width: 20px;
      height: 20px;
      left: 12px;
      text-align: center;
    }
    .box-content_notification{
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 1000px;
      background: rgba(0, 0, 0, 0.3);
      z-index: 999;
      display: none;
    }
    .notificationContent {
      position: fixed;
      top: 0;
      right: 0;
      width: 400px;
      height: 1000px;
      background: white;
    }
    .unread_notify{
      color: black;
      font-weight: 400;
    }
    .unread_notify:hover{
      color: black;
    }
    /* svg {
      width: 60px !important;
      height: 40px !important;
    } */
  </style>
</head>

<body style="position: relative">
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->

  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin5">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">

        <div class="navbar-header" data-logobg="skin6">
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <a class="navbar-brand" href="{{ route('dashboard') }}">
            <!-- Logo icon -->
            <b class="logo-icon">
              <!-- Dark Logo icon -->
              <img src="{{ asset('/plugins/images/logo-icon.png') }}" alt="dashboard" />
            </b>
            <!--End Logo icon -->
            <!-- Logo text -->
            <span class="logo-text">
              <!-- dark Logo text -->
              <img src="{{ asset('/plugins/images/logo-text.png') }}" alt="dashboard" />
            </span>
          </a>
          <!-- ============================================================== -->
          <!-- End Logo -->
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5"
          style="background-color: black">
          <div style="margin-left: 20px" id="hidden-side_bar">
            <i class="fa fa-bars" aria-hidden="true"
              style="font-size: 25px;color:white"></i></div>
          <!-- ============================================================== -->
          <!-- Right side toggle and nav items -->
          <!-- ============================================================== -->
          
          <ul class="navbar-nav ms-auto d-flex align-items-center" >
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <li id="notification-icon">
              <i class="fa fa-bell" aria-hidden="true" style="font-size: 25px;color:white;cursor: pointer;margin-top:5px;margin-right:20px"></i>
              <span class="text-white" id="notifications_unread_count">{{$unread_notification_count}}</span>
            </li>
            <li>
              <div class="profile-pic" >
                <img src="{{ auth()->user()->avatar }}" alt="user-img" width="36" class="img-circle" style="height: 30px"><span
                  class="text-white font-medium" >{{ auth()->user()->name }}</span>
              </div>
            </li>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
          </ul>
          @include('layouts.admin.notification')
        </div>
      </nav>
    </header>

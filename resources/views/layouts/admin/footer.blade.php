<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ asset('/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('/css/admin/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/js/admin/js/app-style-switcher.js') }}"></script>
{{-- <script src="{{ asset('/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js') }}"></script> --}}
<!--Wave Effects -->
<script src="{{ asset('/js/admin/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('/js/admin/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('/js/admin/js/custom.js') }}"></script>

<script type="text/javascript">
  CKEDITOR.replace('ckeditor');

  CKEDITOR.replace('ck_about_description_create');
  CKEDITOR.replace('ck_about_quote_create');

  CKEDITOR.replace('ck_about_description_edit');
  CKEDITOR.replace('ck_about_quote_edit');

  CKEDITOR.replace('ck_banner_create');
  CKEDITOR.replace('ck_banner_edit');

  CKEDITOR.replace('ck_user_role_create')
  CKEDITOR.replace('ckeditor_user_role_edit')

  CKEDITOR.replace('ckeditor_product_create')
  CKEDITOR.replace('ckeditor_product_edit')

  CKEDITOR.replace('ck_editor_slider_create')
  CKEDITOR.replace('ck_editor_slider_edit')

  CKEDITOR.replace('ck_editor_blog_create')
  CKEDITOR.replace('ck_editor_blog_edit')
</script>
@yield('js')
@include('sweetalert::alert')
<script src="{{ asset('js/admin/js/custom-admin-ajax.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--chartis chart-->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="{{ asset('js/admin/js/chart.js') }}"></script>
<script type="text/javascript">
  new Morris.Donut({
    element: 'statistic-chart-donus',
    resize: true,
    colors: [
      '#f0488b',
      '#ffc36d',
      '#80DEEA',
      '#e6762c',
      '#fa0a0a',
      '#2ae240',
      '#0d15d5',
      '#7ee91c',
      '#17f3b5',
      '#0d4d0d',
    ],
    //labelColor:"#cccccc", // text color
    //backgroundColor: '#333333', // border color
    data: [{
        label: "Sản phẩm",
        value: <?php echo $product_count; ?>
      },
      {
        label: "Tin tức",
        value: <?php echo $blog_count; ?>
      },
      {
        label: "Banners",
        value: <?php echo $banner_count; ?>
      },
      {
        label: "Trình chiếu",
        value: <?php echo $slider_count; ?>
      },
      {
        label: "Từ khóa",
        value: <?php echo $tag_count; ?>
      },
      {
        label: "Phiếu giảm giá",
        value: <?php echo $coupon_count; ?>
      },
      {
        label: "Mục lục",
        value: <?php echo $menu_count; ?>
      },
      {
        label: "Về chúng tôi",
        value: <?php echo $about_count; ?>
      },
      {
        label: "Màu sắc",
        value: <?php echo $color_count; ?>
      },
      {
        label: "Danh mục sản phẩm",
        value: <?php echo $category_count; ?>
      },

    ]
  });
</script>

</body>

</html>

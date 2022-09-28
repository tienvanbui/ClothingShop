// {{-- call ajax for blog user page  --}}
$(document).ready(function () {
    // load data  blog with ajax for blog list page with condition 
    function fetch_data(page, keyword = "", tag = "") {
        $.ajax({
            url: '/view-list-blog/fetch-data?page=' + page + "&keyword= " + keyword + "&tag=" + tag,
            data: {
                tag: tag,
                keyword: keyword,
                page: page,
            },
            success: function (data) {
                $('#blog-data').html(data);
            }
        });
    }
    // search blogs when key press on search box in blog page 
    $(document).on('keyup', '.blogSearch', function () {
        var keyword = $('.blogSearch').val();
        var page = $('#hidden_page').val();
        var tag = $('#hidden_tag').val();
        fetch_data(page, keyword, tag);
    });
    // click to tag links in blog page 
    $(document).on('click', '.tag-selection', function () {
        var tag = ($(this).attr('href').split('tag-id=')[1]);
        $('#hidden_tag').val(tag);
        var keyword = $('.blogSearch').val();
        var page = $('#hidden_page').val();
    });
    // click to the number page for paginating blog page
    $(document).on('click', '.page-item  a', function (e) {
        e.preventDefault();
        var tag = $('#hidden_tag').val();
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);
        var keyword = $('.blogSearch').val();
        fetch_data(page, keyword, tag);
    });
    // call ajax to comment a blog 
    // insert comment to blog page 
    $(document).on('click', '.buton-post_comment', function (e) {
        e.preventDefault();
        var blogId = $('#hidden_tagId-blog-page').val();
        var username = $('.comment-user_blog').val();
        var userid = $('#comment-user_id_blog').val();
        var commentContent = $('.comment-user_comment').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '/insert-blog-coment-with-ajax',
            method: "POST",
            data: {
                username: username,
                commentContent: commentContent,
                blogId: blogId,
                userid: userid,
                _token: _token,
            },

            success: function (data) {
                $('#comment-post_with_ajax')[0].reset();
                swal({
                    title: "Thank for your comment!",
                    text: "Your comment is posetd!",
                    icon: "success",
                    closeOnClickOutside: true,
                    buttons: false
                });
                $('.user_blog-comments').prepend(data);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                window.location.href = "/login";
            }
        });
    });
    // load more comment in blog page 
    $(document).on('click', '.buton-blog_loadmore', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var comment_blog_id = $('#hidden_tagId-blog-page').val();
        $('.buton-blog_loadmore').html('<b>Loading...</b>')
        loadComment(id, _token, comment_blog_id);
    });
    function loadComment(id = '', _token, blog_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/loadComment-blog-with-ajax",
            data: {
                id: id,
                blog_id: blog_id,
                _token: _token
            },
            success: function (data) {
                $('.buton-blog_loadmore').remove();
                $('.user_blog-comments').append(data);
            }
        });
    }
    var comment_blog_id = $('#hidden_tagId-blog-page').val();
    var _token = $('input[name="_token"]').val();
    loadComment('', _token, comment_blog_id);
    // CODE  AJAX IN USER & CLIENT PRODUCT LANDING PAGE
    var categoryName = window.location.href.split('category=')[1];
    var category_name = {
        name: categoryName,
    };
    $(document).on('click', '.loadMoreButton-product_user', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var _token = $('input[name="_token"]').val();
        var categoryName = window.location.href.split('category=')[1];
        category_name.name = categoryName;
        $('.loadMoreButton-product_user').html("<b>...Loading...<b/>");
        loadMoreProduct(id, _token, category_name);
    });
    function loadMoreProduct(id = "", _token, category_name) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/product/load-more-with-ajax",
            data: {
                id: id,
                _token: _token,
                category_name: category_name.name
            },
            success: function (data) {
                $('.loadMoreButton-product_user').remove();
                $('.fetchData-whenLoadMore_product_user').append(data);
            }
        });
    }
    loadMoreProduct("", _token, category_name);
    // CODE QICK VIEW AJAX  IN USER & CLIENT LANDING PAGE
    $(document).on('click', '.qickView-product', function (param) {
        param.preventDefault();
        var id = $(this).data('product_id');
        var _token = $('input[name="_token"]').val();
        var data = { _token: _token, id: id };
        $.ajax({
            type: "POST",
            url: "/home/qick-view-ajax",
            data: data,
            dataType: "JSON",
            success: function (response) {
                $('#product_name').text(response.product_name);
                $('#product_price').text(response.product_price);
                $('#product_seo').text((response.seo_product).replace('$', ''));
                $('#product_size').html(response.sizes);
                $('#product_color').html(response.colors);
                $('#product_galleries  .item-slick3  .pos-relative  img').attr('src', response.product_image);
                $('#product_galleries  .item-slick3  .pos-relative  img ~ a').attr('href', response.product_image);
                $('#product_id_modal1').val(response.product_id);
            }
        });
    });
    // FILTER PRODUCT BY CONDITION
    // DISPLAY LIST PRODUCT WHEN SELECT TYPE FILTER
    function listProductWithSortProcess(_token, condition, category_name) {
        $.ajax({
            type: "POST",
            url: "/filter-product-with-ajax",
            data: {
                _token: _token,
                sort_by: condition.sort_by,
                price: condition.price,
                color: condition.color,
                category_name: category_name.name
            },
            success: function (data) {
                $('.fetchData-whenLoadMore_product_user').html(data);
            }

        });
    }
    var filter_condition = {
        sort_by: null,
        price: null,
        color: null,
        search_keyword: null,
    };
    var page = {
        pageItem: 1,
    };
    $('.filter-col1').find('.filter-link').on('click', function (param) {
        if ($(this).css('color') != '#6c7ae0') {
            $(this).css('color', '#6c7ae0');
            filter_condition.sort_by = $(this).data('sortting_by');
        }
        if ($(this).css('color') == 'rgb(108, 122, 224)') {
            $(this).css('color', 'inherit');
            filter_condition.sort_by = null;
        }
    });
    $('.filter-col2').find('.filter-link').on('click', function (param) {
        if ($(this).css('color') != '#6c7ae0') {
            $(this).css('color', '#6c7ae0');
            filter_condition.price = $(this).data('price');
        }
        if ($(this).css('color') == 'rgb(108, 122, 224)') {
            $(this).css('color', 'inherit');
            filter_condition.price = null;
        }
    });
    $('.filter-col3').find('.filter-link').on('click', function (param) {
        if ($(this).css('color') != '#6c7ae0') {
            $(this).css('color', '#6c7ae0');
            filter_condition.color = $(this).data('color');
        }
        if ($(this).css('color') == 'rgb(108, 122, 224)') {
            $(this).css('color', 'inherit');
            filter_condition.color = null;
        }
    });
    // FILTER WHEN CLICK ON FILTER BUTTON ON PRODUCT PAGE
    $('.filter-col4').find('.filter-accpet').on('click', function (param) {
        param.preventDefault();
        var _token = $('input[name="_token"]').val();
        category_name.name = window.location.href.split('category=')[1];
        if (filter_condition.sort_by != null || filter_condition.price != null || filter_condition.color != null) {
            page.pageItem = 1;
            listProductWithSortProcess(_token, filter_condition, category_name);
        }
        else {
            swal({
                title: "Something was wrong!",
                text: "Please choose the filter condition!",
                icon: "error",
                closeOnClickOutside: true,
                buttons: false
            });
        }
    })
    $(document).on('click', '.loadMoreButton-product_user_filter', function (e) {
        e.preventDefault();
        page.pageItem++;
        var _token = $('input[name="_token"]').val();
        $('.loadMoreButton-product_user_filter').html("<b>...Loading...<b/>");
        if (filter_condition.search_keyword == '') {
            filter_condition.search_keyword = null;
            loadMoreProductWhenFilter(_token, filter_condition, page.pageItem, filter_condition.search_keyword, category_name);
        }
        else {
            loadMoreProductWhenFilter(_token, filter_condition, page.pageItem, filter_condition.search_keyword, category_name);
        }

    });
    function loadMoreProductWhenFilter(_token, condition, page, search_keyword, category_name) {
        if (search_keyword != null) {
            $.ajax({
                type: "POST",
                url: "/product/filter-load-more-with-ajax?keyword=" + search_keyword + "&page=" + page + "&category_name=" + category_name.name,
                data: {
                    _token: _token,
                    page: page,
                    search_keyword: search_keyword,
                    category_name: category_name.name,

                },
                success: function (data) {
                    $('.loadMoreButton-product_user_filter').remove();
                    $('.fetchData-whenLoadMore_product_user').append(data);
                }
            });
        }
        else {
            $.ajax({
                type: "POST",
                url: "/product/filter-load-more-with-ajax?keyword=" + search_keyword + "&page=" + page + "&category_name=" + category_name.name,
                data: {
                    _token: _token,
                    sort_by: condition.sort_by,
                    price: condition.price,
                    color: condition.color,
                    page: page,
                    search_keyword: search_keyword,
                    category_name: category_name.name,
                },
                success: function (data) {
                    $('.loadMoreButton-product_user_filter').remove();
                    $('.fetchData-whenLoadMore_product_user').append(data);
                }
            });
        }
    }
    // CODE AJAX SEARCH PRODUCT WHEN CLICK ON BTN-SEARCH 
    function searchProductWithKeyWords(_token, search_keyword, category_name) {
        $.ajax({
            type: "POST",
            url: "/search-product?keyword = " + search_keyword,
            data: {
                _token: _token,
                search_keyword: search_keyword,
                category_name: category_name.name,
            },
            success: function (data) {
                $('.fetchData-whenLoadMore_product_user').html(data);
            }
        });
    }
    // SEARCH PRODUCT WHEN KEY PRESS ON SEARCH INPUT
    $(document).on('keyup', '.search-product-input', function (e) {
        e.preventDefault();
        var _token = $('input[name="_token"]').val();
        var search_keywords = $(this).val();
        filter_condition.search_keyword = search_keywords;
        page.pageItem = 1;
        category_name.name = window.location.href.split('category=')[1];
        if (filter_condition.search_keyword != null && category_name.name != undefined) {
            searchProductWithKeyWords(_token, filter_condition.search_keyword, category_name);
        }
        else if (filter_condition.search_keyword != null && category_name.name == undefined) {
            filter_condition.search_keyword = search_keywords;
            category_name.name = null;
            searchProductWithKeyWords(_token, filter_condition.search_keyword, category_name);
        }
        else {
            filter_condition.search_keyword = null;
            category_name.name = null;
            searchProductWithKeyWords(_token, filter_condition.search_keyword, category_name);
        }
    });
    $('.js-show-filter').on('click', function () {
        filter_condition.search_keyword = null;
    });
    $('.js-show-search').on('click', function () {
        filter_condition.sort_by = null;
        filter_condition.price = null;
        filter_condition.color = null;
    });
    // CODE AJAX IN DETAIL PRODUCT PAGE 
    // ADD PRODUCT TO CART 
    $(document).on('click', '.js-addcart-detail', function (param) {
        param.preventDefault();
        var _token = $('input[name="_token"]').val();
        var product_id = $('input[name="product_id"]').val();
        var buy_quanlity = $('input[name="buy_quanlity"]').val();
        var size_id = $('.size-select-option option:selected').val();
        var color_id = $('.color-select-option  option:selected').val();
        var nameProduct = $(this).parent().parent().parent().parent().parent().find('.js-name-detail').text();
        if (product_id == '' || buy_quanlity == '' || size_id == 'Choose an option' || color_id == 'Choose an option') {
            swal({
                title: "Something was wrong!",
                text: "Please choose the option and quanlities!",
                icon: "error",
                closeOnClickOutside: true,
                buttons: false
            });
        }
        else {
            addToCartInDetailProductPage(_token, product_id, buy_quanlity, size_id, color_id, nameProduct);
        }
    });
    function addToCartInDetailProductPage(_token, product_id, quanlities, size_id, color_id, product_name) {
        $.ajax({
            type: "POST",
            url: "/user/save-to-cart",
            data: {
                _token: _token,
                product_id: product_id,
                buy_quanlity: quanlities,
                size_id: size_id,
                color_id: color_id,
                product_name: product_name
            },
            dataType: "JSON",
            success: function (response) {
                if (response.status == 'fail') {
                    swal(response.product_name, "already exists in the cart.Please double check the product color and size!", "error").then((result) => { $('.js-modal1').removeClass('show-modal1') });
                    $('.icon-header-noti').attr('data-notify', response.product_in_cart);
                }
                else if (response.status == 'warning') {
                    swal(response.product_name, "out of stock.Please choose another products!", "error").then((result) => { $('.js-modal1').removeClass('show-modal1') });
                }
                else {
                    swal(response.product_name, "is added to cart !", "success").then((result) => { $('.js-modal1').removeClass('show-modal1') });
                    $('.header-cart-count').attr('data-notify', response.product_in_cart);
                    $('.add-ajax-product-insert').append(response.product_item_in_cart);
                    $('.header-cart-total').text('Total:$' + response.product_sum_all_product_price);
                };
            },
            error: function (jqXHR, textStatus, errorThrown) {
                window.location.href = "/login";
            }
        });
    }
    // CODE AJAX ADD PRODUCT TO CART QICK VIEW
    $(document).on('click', '.js-addcart-detail-qick-view', function (param) {
        param.preventDefault();
        var _token = $('input[name="_token"]').val();
        var product_id = $('input[name="product_id"]').val();
        var buy_quanlity = $('input[name="num-product"]').val();
        var size_id = $('#product_size option:selected').val();
        var color_id = $('#product_color option:selected').val();
        var nameProduct = $('#product_name').text();
        if (product_id == '' || buy_quanlity == '' || size_id == 'Choose an option' || color_id == 'Choose an option') {
            swal({
                title: "Something was wrong!",
                text: "Please choose the option and quanlities!",
                icon: "error",
                closeOnClickOutside: true,
                buttons: false
            });
        }
        else if (buy_quanlity <= 0) {
            swal({
                title: "Something was wrong!",
                text: "The qualities must greater than or equal to 0!",
                icon: "error",
                closeOnClickOutside: true,
                buttons: false
            });
        }
        else {
            addToCartInDetailProductPage(_token, product_id, buy_quanlity, size_id, color_id, nameProduct);

        }
    });
    // CODE AJAX ON CART LANDING PAGE 
    // DELETE PRODUCT IN CART
    $(document).on('click', '.btnDelete-cart_product_item', function (e) {
        e.preventDefault();
        var _token = $('input[name="_token"]').val();
        var user_id = $('input[name="user_id_delete"]').val();
        var product_id = $('input[name="product_id_delete"]').val();
        var data = {
            _token: _token,
            user_id: user_id,
            product_id: product_id,
        };
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "DELETE",
                    url: "/user/delete-form-cart/" + product_id,
                    data: data,
                    success: function (response) {
                        swal("Poof! Your data has been deleted!", {
                            icon: "success",
                        }).then((result) => {
                            location.reload();
                        });
                    }
                });
            }
        });
    });
    // UPDATE PRODUCT IN CART
    $(document).on('click', '.btnUpdateCartItem', function (e) {
        e.preventDefault();
        var _token = $('input[name="_token"]').val();
        var user_id = $('input[name="user_id"]').val();
        var product_id = $('input[name="product_id"]').val();
        var cart_id = $('input[name="cart_id"]').val();
        var buy_quanlity = $('.num-product').val();
        var data = {
            _token: _token,
            user_id: user_id,
            product_id: product_id,
            cart_id: cart_id,
            buy_quanlity: buy_quanlity
        };
        if (buy_quanlity > 0) {
            $.ajax({
                type: "PUT",
                url: "/user/update-cart/" + product_id,
                data: data,
                success: function (response) {
                    swal("Poof! Your data has been updated!", {
                        icon: "success",
                    }).then((result) => {
                        location.reload();
                    });
                }
            });
        }
        else {
            swal({
                title: "Something was wrong!",
                text: "The qualities must greater than or equal to 0!",
                icon: "error",
                closeOnClickOutside: true,
                buttons: false
            });
        }
    })
    //======================CoNFIRM PAYMENT CART PAGE AJAX CODE==================================
    $('.btn-confirm-cart_applyCoupon').on('click', function (param) {
        param.preventDefault();
        var _token = $('input[name="_token"]').val();
        var coupon_code = $('.confirm-cart_couponCode_input').val();
        var total_price_all_products_in_cart = $('.discount-price-of-products').val();
        if (_token != undefined && coupon_code != undefined && total_price_all_products_in_cart != undefined) {
            $.ajax({
                type: "POST",
                url: "/user/payment/apply-coupon-code",
                data: {
                    coupon_code: coupon_code,
                    _token: _token,
                    total_price_all_products_in_cart: total_price_all_products_in_cart
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.status == 'success') {
                        swal({
                            title: "Successfully!",
                            text: "You added discount code!",
                            icon: "success",
                        }).then(() => {
                            $('.discount_payment_type').text('$' + response.discountPrice);
                            $('.total-after-discounting').text('$' + response.totalAfterDiscount);
                            $('.discount-price-of-products').val(response.totalAfterDiscount);
                        });
                        $('.confirm-cart_couponCode_input').attr('disabled', 'disabled');
                    }
                    else if (response.status == 'full') {
                        swal({
                            title: "Unsuccessfully!",
                            text: "Coupon code has been used or expired!",
                            icon: "warning",
                        }).then(() => {
                            $('.discount_payment_type').text('$' + 0);
                            $('.total-after-discounting').text('$' + response.totalAfterDiscount);
                        });
                    }
                    else {
                        swal({
                            title: "Unsuccessfully!",
                            text: "Discount code wasn't added.Please check the coupon code!",
                            icon: "error",
                        }).then(() => {
                            $('.discount_payment_type').text('$' + 0);
                            $('.total-after-discounting').text('$' + response.totalAfterDiscount);
                        });
                    }
                }
            });
        }
    });
    // ======================PAYMENT CART PAGE AJAX SELECT PAYMENT METHOD==========
    $('.payment-radio-button-cart-payment > input').on('click', function (param) {
        var _token = $('input[name="_token"]').val();
        var slug_paymentMethod = $(this).data('slug_payment');
        if (slug_paymentMethod == 'Card') {
            swal({
                title: "Unsuccessfully!",
                text: "Current payment method not supported.Please choose another payment method!",
                icon: "error",
            }).then(() => {
                $(this).prop('checked', false);
            });
        }

    });
    // ======================PAYMENT CART PAGE AJAX START PAYMENT========== 
    $(document).on('click', '.start-payment-button', function (param) {
        param.preventDefault();
        var _token = $('input[name="_token"]').val();
        var user_id = $('input[name="user_id"]').val();
        var payment_id = $('input[name="payment_id"]').val();
        var total = $('input[name="total"]').val();
        var addressShipping = $('input[name="address"]').val();
        var phoneNumberShipping = $('input[name="phoneNumber"]').val();
        if (_token != undefined && user_id != undefined && payment_id != undefined && total != undefined && addressShipping != undefined && phoneNumberShipping != undefined) {
            var data = {
                _token: _token,
                payment_id: payment_id,
                total: total,
                addressShipping: addressShipping,
                phoneNumberShipping: phoneNumberShipping,
                user_id: user_id
            };
            swal({
                title: "Are you sure?",
                text: "Once placed, your order cannot be repaired!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willOrder) => {
                if (willOrder) {
                    $.ajax({
                        type: "POST",
                        url: "/user/payment/proceed-to-order",
                        data: data,
                        dataType: "JSON",
                        success: function (response) {
                            if (response.status == 'success') {
                                swal({
                                    title: "Order Success!",
                                    icon: "success",
                                }).then(() => {
                                    window.location.href = '/user/thank-to-order';
                                });
                            }
                            if (response.status == 'fail') {
                                swal({
                                    title: "Order Fail.",
                                    text: "Please check your cart after paying for your order!",
                                    icon: "error",
                                }).then(() => {
                                    window.location.href = '/product/view-product-list';
                                });
                            }
                        }
                    });
                }
            });
        }
    });
    // ======================REVIEW DETAIL PRODUCT ===============
    /*==================================================================
   [ Rating ]*/
    var rated = -1;
    $(document).on('mouseenter', '.item-rating ', function () {
        var index = $(this).data('index');
        var product_id = $(this).data('product_id');
        removeBackground(product_id);
        for (let i = 0; i <= index; i++) {
            $("#" + product_id + "-" + i).removeClass('zmdi-star-outline');
            $("#" + product_id + "-" + i).addClass('zmdi-star');
        }
    });
    $(document).on('click', '.item-rating ', function () {
        var index = $(this).data('index');
        var product_id = $(this).data('product_id');
        rated = index;
        $('input[name="rating-detail-product"]').val(rated);
    });
    function removeBackground(product_id) {
        for (let i = 0; i <= 5; i++) {
            $("#" + product_id + "-" + i).removeClass('zmdi-star');
            $("#" + product_id + "-" + i).addClass('zmdi-star-outline');
        }
    }
    $(document).on('mouseleave', '.item-rating ', function () {
        var product_id = $(this).data('product_id');
        removeBackground(product_id);
        for (i = 0; i <= rated; i++) {
            $("#" + product_id + "-" + i).removeClass('zmdi-star-outline');
            $("#" + product_id + "-" + i).addClass('zmdi-star');
        }

    });
    $(document).on('click', '.btnSubmit-rating', function (param) {
        param.preventDefault();
        var _token = $('input[name="_token"]').val();
        var rated_num = $('input[name="rating-detail-product"]').val();
        var review = $('.text-review-detail-product').val();
        var user_id = $('input[name="user_id"]').val();
        var product_id = $('input[name="product_id"]').val();
        if (_token == '' || rated_num == '' || review == '' || user_id == '' || product_id == '') {
            swal({
                title: "Ratting Fail!",
                text: "Please fill out all information before submitting a review!",
                icon: "error",
            });
        }
        else {
            var data = {
                _token: _token,
                rated_num: rated_num,
                review: review,
                user_id: user_id,
                product_id: product_id
            };
            $.ajax({
                type: "POST",
                url: "/product/rating-product/" + product_id,
                data: data,
                success: function (data) {

                    swal({
                        title: "Thank for your review!",
                        text: "Your review was posetd!",
                        icon: "success",
                        closeOnClickOutside: true,
                        buttons: false
                    }).then(() => {
                        $('#review-product-detail')[0].reset();
                        $('#list-review-of-user-products').prepend(data);
                    });

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    window.location.href = "/login";
                }
            });
        }
    });
    // =======================Load More Comment In Product Page ================
    function loadMoreProductComment(id, _token, product_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/loadComment-rating-product-with-ajax",
            data: {
                id: id,
                product_id: product_id,
                _token: _token
            },
            success: function (response) {
                $('.buton-product_comment_loadmore').remove();
                $('#list-review-of-user-products').append(response);
            }
        });
    }
    $(document).on('click', '.buton-product_comment_loadmore', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var comment_product_id = $('#hidden_product_id-page').val();
        $('.buton-product_comment_loadmore').html('<b>Loading...</b>')
        loadMoreProductComment(id, _token, comment_product_id);
    });
    var _token = $('input[name="_token"]').val();
    var comment_product_id = $('#hidden_product_id-page').val();
    loadMoreProductComment('', _token, comment_product_id);
    //accecpt track order 
    function checkIsPassCondition(variable) {
        if (variable != null && variable != undefined && variable != '') {
            return true;
        }
    }
    $(document).on('click', '.track_order-button', function name(params) {
        params.preventDefault();
        var _token = $('input[name="_token"]').val();
        var status = $(this).data('order_status');
        var id = $(this).data('order_id');
        if (checkIsPassCondition(status) && checkIsPassCondition(_token) && checkIsPassCondition(id)) {
            $.ajax({
                type: "POST",
                url: "/user/order/order-tracked-with-ajax",
                data: { _token: _token, status: status, order_id: id },
                dataType: "JSON",
                success: function (response) {
                    if (response['status']) {
                        $('.order-tracked_button_' + response['id']).append("<button class='btn btn-warning text-white fw-bold btn-sm'>Shipped</button>");
                        $('#btnOrderTrackForm' + response['id']).remove();
                    }

                }
            });
        }
    })
});
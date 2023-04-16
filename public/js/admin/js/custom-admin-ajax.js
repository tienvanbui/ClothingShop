// Call ajax in admin page 

//ready to run ajax file 
$(document).ready(function () {
    //get color id and size id
    var colors = [];
    var sizes = [];
    var size_length = [];
    var color_length = [];
    var _token = $('input[name="_token"]').val();

    function manageQuanlitiesProduct(colors, sizes, _token, size_length, color_length) {

        $.ajax({
            type: "POST",
            url: "/admin/product/quanlities-manager",
            data: {
                colors: colors,
                sizes: sizes,
                _token: _token,
                size_length: size_length[size_length.length - 1],
                color_length: color_length[color_length.length - 1]
            },
            success: function (data) {
                $('#product_quanlities-by-sizes').html(data);
            }
        });

    }
    function pushIdToArray(arr, id) {
        arr.push(id);
    }
    function removeIdToArray(arr, id) {
        index = arr.indexOf(id);
        arr.splice(index, 1);
    }
    function setArrayLength(arr) {
        if (arr === sizes) {
            size_length.push(arr.length);
        }
        else {
            color_length.push(arr.length);
        }
    }
    $('.size_checkbox').click(function (e) {
        var size_id = $(this).val();
        if ($(this).is(":checked")) {
            pushIdToArray(sizes, size_id)
        }
        else {
            removeIdToArray(sizes, size_id);
        }
        setArrayLength(sizes);
    });
    $('.color_checkbox').click(function (e) {
        var color_id = $(this).val();
        if ($(this).is(":checked")) {
            pushIdToArray(colors, color_id)
        }
        else {
            removeIdToArray(colors, color_id);
        }
        setArrayLength(colors);
    });
    $('.remove-all-color_selection').click(function (e) {
        $('.color-div_checkbox').find('.color_checkbox').each(function () {
            $(this).prop("checked", false);
            removeIdToArray(colors, $(this).val());
            setArrayLength(colors)
        });
    });
    $('.select-all-color_selection').click(function (e) {
        $('.color-div_checkbox').find('.color_checkbox').each(function () {
            $(this).prop("checked", true);
            pushIdToArray(colors, $(this).val());
            setArrayLength(colors);
        });
    });
    $('.remove-all-size_selection').click(function (e) {
        $('.size-div_checkbox').find('.size_checkbox').each(function () {
            $(this).prop("checked", false);
            removeIdToArray(sizes, $(this).val());
            setArrayLength(sizes);
        });
    });
    $('.select-all-size_selection').click(function (e) {
        $('.size-div_checkbox').find('.size_checkbox').each(function () {
            $(this).prop("checked", true);
            pushIdToArray(sizes, $(this).val());
            setArrayLength(sizes);
        });
    });
    $(document).on('click', '.set_quanlities', function (e) {
        e.preventDefault()
        if (size_length.length > 0 && color_length.length > 0) {
            manageQuanlitiesProduct(colors, sizes, _token, size_length, color_length);
        }
        else {
            swal("Opp!", "Please choose size and color first!", "error");
        }
    });
    $('input[name="product_quanlities"]').change(function (e) {
        var quanlity = $(this).val();
        $(this).val(quanlity);
    })
    // show listing when change action bar 
    function showListing(_token, showOnPerPgae, searchKey, page, table, view, collum) {
        var data = {
            _token: _token,
            showOnPerPgae: showOnPerPgae,
            searchKey: searchKey,
            page: page,
            table: table,
            view: view,
            collum: collum,
        };
        $.ajax({
            type: "POST",
            url: "/admin/show-listing-with-action-bar",
            data: data,
            success: function (response) {
                $('#admin-data').html(response);
            }
        });
    }
    // set show item in per page 
    $('#showInPerPage').change(function (param) {
        param.preventDefault();
        var _token = $("input[name='_token']").val();
        var page = 1;
        var showOnPerPage = $(this).val();
        var searchKey = $('#searchByName-admin_page').val();
        var table = $('#hidden_table').val();
        var view = $('#hidden_view').val();
        var collum = $('#hidden_col').val();
        showListing(_token, showOnPerPage, searchKey, page, table, view, collum);

    });
    // click to the number page for paginating blog page
    $(document).on('click', '.page-item  a', function (e) {
        e.preventDefault();
        var _token = $("input[name='_token']").val();
        var showOnPerPage = $('#showInPerPage').val();
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page_admin').val(page);
        var searchKey = $('#searchByName-admin_page').val();
        var table = $('#hidden_table').val();
        var view = $('#hidden_view').val();
        var collum = $('#hidden_col').val();
        showListing(_token, showOnPerPage, searchKey, page, table, view, collum);

    });
    // search admin page when key press on search box 
    $(document).on('keyup', '#searchByName-admin_page', function () {
        var searchKey = $('#searchByName-admin_page').val();
        var page = 1;
        var _token = $("input[name='_token']").val();
        var showOnPerPage = $('#showInPerPage').val();
        var table = $('#hidden_table').val();
        var view = $('#hidden_view').val();
        var collum = $('#hidden_col').val();
        showListing(_token, showOnPerPage, searchKey, page, table, view, collum);

    });
    $(function () {
        $("#datepicker").datepicker({
            prevText: "Previous Month",
            nextText: "Next Month",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["Mon", "Tue", "Wed", "Thur", "Fri", "Sat", "Sun"],
            duration: "slow"
        });
        $("#datepicker2").datepicker({
            prevText: "Previous Month",
            nextText: "Next Month",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["Mon", "Tue", "Wed", "Thur", "Fri", "Sat", "Sun"],
            duration: "slow"
        });
    });
    $('#hidden-side_bar').hover(function (e) {
        e.preventDefault();
        $(this).css('cursor', 'pointer');
    })
    var hidLeftSideBar = 0;
    $('#hidden-side_bar').click(function (e) {
        e.preventDefault();
        hidLeftSideBar++;
        if(hidLeftSideBar % 2 == 0){
            $('.left-sidebar').css('left','-240px');
            $('#main-wrapper[data-layout="vertical"][data-sidebartype="full"] .page-wrapper').css('margin-left',0);
        }
        else{
            $('#main-wrapper[data-layout="vertical"][data-sidebartype="full"] .page-wrapper').css('margin-left','240px');
            $('.left-sidebar').css('left',0);
        }
    })
    //Toggle display notification content
    function callAjaxProcessListNotification(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: "/admin/notifications",
            dataType: "JSON",
            success: function (response) {
                const notifications = response.data.notifications
                var stringNotficiation = '';
                for (let index = 0; index < notifications.length; index++) {
                    if(notifications[index]['read_at'] != null || notifications[index]['read_at'] != undefined){
                        stringNotficiation +="<li class='list-group-item'><a href='"+notifications[index]['data']['url']+"' style='color: black;font-weight:400'><p style='margin:0 !important;'>"+notifications[index]['created_at']+"</p><p>"+notifications[index]['data']['content']+"</p></a></li>"
                    }
                    else{
                        stringNotficiation +="<li class='list-group-item' data-uid="+notifications[index]['id']+" id='item-notification'><a href='"+notifications[index]['data']['url']+"' style='color: black;font-weight:900'><p style='margin:0 !important;'>"+notifications[index]['created_at']+"</p><p>"+notifications[index]['data']['content']+"</p></a></li>" 
                    }
                   
                }
                $('#list-group-notification').html(stringNotficiation)
                $('#notifications_unread_count').html(response.data.notifications_unread)
            }
        });
    }
    $(document).on('click','#notification-icon',function(e){
        e.preventDefault();
        $('.box-content_notification').css('display','block')
        $('body').css('overflow','hidden')
        callAjaxProcessListNotification()
    });
    $(document).on('click','.close-notification_content',function(e){
        e.preventDefault();
        callAjaxProcessListNotification()
        $('.box-content_notification').css('display','none')
        $('body').css('overflow','auto')
    });
    $(document).on('click','#item-notification',function (e) { 
        e.preventDefault();
        const uid = $(this).attr('data-uid');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/notifications/mark-as-read",
            data: {
                id:uid,
            },
            dataType: "JSON",
            success: function (response) {
                $('#item-notification').each(()=>{
                    var el = $('#item-notification');
                    if(el.attr('data-uid') == uid){
                        el.find('a').removeAttr('style').addClass('unread_notify')
                    }
                })
            },
            complete : function (response) {
                window.location.href = '/admin/order/order-check'
            }
        });
    })
    
})
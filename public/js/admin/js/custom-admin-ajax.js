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
    $('#hidden-side_bar').hover(function (param) {
        param.preventDefault();
        $(this).css('cursor', 'pointer');
    })


});
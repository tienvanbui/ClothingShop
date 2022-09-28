$(document).ready(function () {
  function checkIsPassCondition(variable) {
    if (variable != null && variable != undefined && variable != '') {
      return true;
    }
  }
  var chart = new Morris.Area({
    // ID of the element in which to draw the chart.
    element: 'statistic-chart',
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    lineColors: ["#ffc36d", "#26deee", "#1ff016"],
    fillOpacity: 0.3,
    // The name of the data record attribute that contains x-values.
    xkey: 'period',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['orders', 'sales', 'products_in_orders'],
    behaveLikeLine: true,
    hideHover: 'auto',
    parseTime: false,

    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['orders', 'sales', 'productsInOrder']
  });
  $(document).on('click', '#btn-dashboard-statistic-earnings', function (param) {
    param.preventDefault();
    var _token = $('input[name="_token"]').val();
    var from_date = $('input[name="from-date"]').val();
    var to_date = $('input[name="to-date"]').val();
    if (checkIsPassCondition(from_date) && checkIsPassCondition(to_date) && checkIsPassCondition(_token)) {
      $.ajax({
        type: "POST",
        url: "/admin/dashboard/filter-by-day-statistic-earnings-with-ajax",
        data: { _token: _token, from_date: from_date, to_date: to_date },
        dataType: "JSON",
        success: function (response) {
          chart.setData(response);
        }
      });
    }
    else {
      swal("Opp!", "Please choose value for fromDate and toDate collum!", "error");
    }
  });
  $('.filter-by-option-dashboard').change(function (e) {
    e.preventDefault();
    $('input[name="from-date"]').val('');
    $('input[name="to-date"]').val('');
    var _token = $('input[name="_token"]').val();
    var filTypeOption = $(this).val();
    if (checkIsPassCondition(_token), checkIsPassCondition(filTypeOption)) {
      $.ajax({
        type: "POST",
        url: "/admin/filter/filter-with-option",
        data: { _token: _token, filTypeOption: filTypeOption },
        dataType: "JSON",
        success: function (response) {
          chart.setData(response);
        }
      });
    }
  });
  // default statistic 30 days 
  function chartStatistic30Days() {
    var _token = $('input[name="_token"]').val();
    if (checkIsPassCondition(_token)) {
      $.ajax({
        type: "POST",
        url: "/admin/dashboard/filter-default-statistic-30-days",
        data: { _token: _token },
        dataType: "JSON",
        success: function (response) {
          chart.setData(response);
        }
      });
    }
  }
  chartStatistic30Days();
  // Chart statistic earings in dashboard

  
});
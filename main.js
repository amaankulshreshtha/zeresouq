$(function(){
  var totalSales = $('#total-sales')
  var salesman = $('#salesman')

  $('.side-menu-item').on("click", function(){
    $this = $(this);
    $this.siblings().removeClass("active");
    $this.addClass("active");
  });

  $('#settingTab a').on('click', function (e) {
    e.preventDefault()
    $(this).tab('show')
  });
});

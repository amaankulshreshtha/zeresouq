$(function(){
  var totalSales = $('#total-sales')
  var salesman = $('#salesman')

  $('.side-menu-item').on("click", function(){
    $this = $(this);
    // $this.siblings().removeClass("active");
    // $this.addClass("active");
    changeHighlight($this);
  });

  $('#settingTab a').on('click', function (e) {
    e.preventDefault()
    $(this).tab('show')
  });
  setInterval(timestamp, 1000);

});

function timestamp() {
    $.ajax({
        url: 'http://localhost/Zeresouq/timestamp.php',
        success: function(data) {
            $('#timestamp').html(data);
        },
    });
}

function changeHighlight(element) {
  $this = element;
  $this.siblings().removeClass("active");
  $this.addClass("active");
}

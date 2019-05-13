$(document).ready(function($) {
  // 1. get months from template

  var month = $('select#month').val();
  $('select#day').on('change', function() {
    var day = $('select#day').val();
    var ID = day + month;

    $([document.documentElement, document.body]).animate(
      {
        scrollTop: $('#' + ID).offset().top - 200
      },
      1000
    );
  });

  $.ajax({
    type: 'POST',
    url: window.smartakartan.ajaxurl,
    dataType: 'HTML',
    data: {
      action: 'calendar_date',
      month: month
    },
    success: function(response) {
      $('select#day').empty();
      $('select#day').append(response);
    },
    error: function(errorThrown) {
      console.log(errorThrown);
    }
  });

  $('select#month').on('change', function() {
    month = $('select#month').val();

    // 2. get days for the chosen month with ajax
    $.ajax({
      type: 'POST',
      url: window.smartakartan.ajaxurl,
      dataType: 'HTML',
      data: {
        action: 'calendar_date',
        month: month
      },
      success: function(response) {
        // 3. print days for select
        $('select#day').empty();
        $('select#day').append(response);
      },
      error: function(errorThrown) {
        console.log(errorThrown);
      }
    }).done(function() {
      var day = $('select#day').val();
      var ID = day + month;

      $([document.documentElement, document.body]).animate(
        {
          scrollTop: $('#' + ID).offset().top - 180
        },
        1000
      );
    });
  });

  // 4. scroll to day
});

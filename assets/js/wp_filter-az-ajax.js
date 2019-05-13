$(document).ready(function($) {
  var filterchunk = 0;

  $('#filter-az').click(function(e) {
    var filterchunk = 0;

    var elements = $('.grid').children();
    var maxPage = chunks.length;

    $('.grid').masonry('remove', elements);

    $('#load-more').css('display', 'none');
    $('#filter-more').css('display', 'block');

    $.ajax({
      type: 'POST',
      url: window.smartakartan.ajaxurl,
      dataType: 'HTML',
      data: {
        action: 'az_filter',
        shorted: shorted[filterchunk]
      },
      success: function(response) {
        var $items = $(response);
        $('.grid').prepend($items).masonry('prepended', $items);
        filterchunk++;
      }
    });
  });
});

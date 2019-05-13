$(document).ready(function($) {
  $('#secondary-menu').on(
    'change',
    '#category-buttons input[type=checkbox]',
    function() {
      var boxarray = [];
      var mainCatID = $('#category-buttons').attr('data-maincategory');
      var checkedBoxes = jQuery(
        '#category-buttons .sub-check:checkbox:checked'
      );

      for (var i = checkedBoxes.length - 1; i >= 0; i--) {
        var box = jQuery(checkedBoxes[i]);

        var subId = box.attr('data-subcategory');
        var subId_int = parseInt(subId);
        boxarray.push(subId_int);
      }

      if (boxarray.length === 0) {
        boxarray.push(0);
      }

      var filterchunk = 0;

      var elements = $('.grid').children();
      var maxPage = chunks.length;

      $('.grid').masonry('remove', elements);

      $('#load-more').css('display', 'none');
      $('#filter-more').css('display', 'none');

      $.ajax({
        type: 'POST',
        url: window.smartakartan.ajaxurl,
        dataType: 'HTML',
        data: {
          action: 'az_filter',
          subs: boxarray,
          mainCatID: mainCatID
        },
        success: function(response) {
          var $items = $(response);
          if ($items.length != 0) {
            $('#result-message').html('');
            $('.grid').prepend($items).masonry('prepended', $items);
          } else {
            $('#result-message').html(response);
          }
        }
      });
    }
  );
});

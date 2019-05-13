$(document).ready(function($) {
  window.chunk = 1;

  $('#load-more').click(function(e) {
    var maxPage = chunks.length;

    $.ajax({
      type: 'POST',
      url: window.smartakartan.ajaxurl,
      dataType: 'HTML',
      data: {
        action: 'load_more',
        chunk: chunks[chunk]
      },
      success: function(response) {
        if (maxPage > chunk) {
          var $content = $(response);

          $('.grid').append($content).masonry('appended', $content);

          window.chunk++;
          if (maxPage === window.chunk || maxPage === 0) {
            $('#load-more').css('display', 'none');
          }
        }

        if (window.lazyLoadInstance) {
          window.lazyLoadInstance.update();
        }
      }
    }).done(function() {
      window.afterLocationFound(window.singlePosts);
    });
  });

  $('#filter-more').click(function(e) {
    var maxPage = shorted.length;

    $.ajax({
      type: 'POST',
      url: window.smartakartan.ajaxurl,
      dataType: 'HTML',
      data: {
        action: 'load_more',
        shorted: shorted[filterchunk],
        filter: 1
      },
      success: function(response2) {
        if (maxPage > filterchunk) {
          var $content2 = $(response2);
          $('.grid').append($content2).masonry('appended', $content2);

          filterchunk++;
          if (maxPage == filterchunk) {
            $('#filter-more').css('display', 'none');
            filterchunk = 1;
          }
        }
      }
    });
  });
});

$(document).ready(function($) {
  var searchIDs = [];

  if ($('#main-content').hasClass('search')) {
    var searchIDs = searchResults;
  }

  // Activate overlay
  $('#filters').on('click', function() {
    $('#filter-popup').toggleClass('active');
    $('.filter-overlay').toggleClass('active');
  });
  $('.filter-overlay').on('click', function() {
    $('#filter-popup').removeClass('active');
    $('.filter-overlay').removeClass('active');
  });

  // Reset the result
  $('#reset').click(function(e) {
    $('.filter-controll #checkbox1').prop('checked', false);
    $('.filter-controll #srandom').prop('checked', true);
    $('.filter-controll .category-buttons input').prop('checked', false);
    $('.filter-controll .transaction-buttons input').prop('checked', true);
  });

  // Dont show transactions filters on transaction template
  if ($('#wrapper').hasClass('transactions')) {
    $('#filter-popup .transactions').css('display', 'none');
  }

  /*
   * Desktop filter TRIGGER
   *
   */
  $('.filter-menu .filter-section [data-filter]').on('change', function(e) {
    // set up the Chunks

    window.chunk = 0;
    var maxPage = window.chunks.length;

    // show load more if there is more card to load
    if (maxPage != window.chunk || maxPage != 0) {
      $('#load-more').css('display', 'inline-block');
    }

    var filterchunk = 0;
    var cat = 0;
    var elements = $('.grid').children();
    var maxPage = chunks.length;
    $('.grid').masonry('remove', elements);

    /*
     * Get data for SHORT BY filter attributes
     * returns: Array string
     */
    var sortBy = jQuery('.filter-controll .sort-buttons #shortBySelect');
    var dataFiltersShortBy = {};
    $(sortBy).each(function() {
      dataFiltersShortBy.sortBy = $(this).val();
    });

    /*
     * Get data for ONLINE/OFLINE filter attributes
     * returns: Array string
     */
    var dataFiltersOnline = {};
    dataFiltersOnline.isOnline = 'disabled';
    /*
     * Get data for TRANSACTIONS filter attributes
     * returns: Array string
     */

    var Transactions = jQuery(
      '.desktop-filter .transactions .transaction-buttons input:checked'
    );
    var dataTransactions = {};
    var dataTransactionInner = {};
    var i = 0;
    $(Transactions).each(function() {
      var vhat = $(this).attr('name');
      dataTransactionInner[i] = $(this).attr('data-filter');
      i = i + 1;
    });
    dataTransactions.transactions = dataTransactionInner;

    var numerOfTransactions = Transactions.length;

    /*
     * Get data for CATEGORIES filter attributes
     * returns: Array string
     */
    var categories = jQuery(
      '.desktop-filter .categories .category-buttons input:checked'
    );

    var dataCategories = {};
    var dataCategoriesInner = {};
    var i = 0;
    $(categories).each(function() {
      var vhat = $(this).attr('name');
      dataCategoriesInner[i] = $(this).attr('data-filter');
      i = i + 1;
    });
    dataCategories.cat = dataCategoriesInner;

    var numerOfTransactions = Transactions.length;

    /*
     * Get data for OPEN filter attributes
     * returns: Array string
     */

    var dataFiltersOpen = {};
    dataFiltersOpen.isOpen = 'all'

    if ($('.filter-controll .open .toggles-hd input').is(':checked')) {
      dataFiltersOpen.isOpen = 'open';
    }

    /*
     * Place all filter parameter in an Array
     * returns: Array string
     */
    var allFilterData = [];
    allFilterData.push(dataFiltersOnline);
    allFilterData.push(dataFiltersShortBy);
    allFilterData.push(dataTransactions);
    allFilterData.push(dataCategories);
    allFilterData.push(dataFiltersOpen);

    $.ajax({
      type: 'POST',
      url: window.smartakartan.ajaxurl,
      dataType: 'HTML',
      data: {
        action: 'filter_all',
        filters: allFilterData,
        cat: cat,
        user_location: {
          lat: window.smartakartan.user.lat,
          long: window.smartakartan.user.lng
        },
        searchIDs: searchIDs
      },
      success: function(response) {
        var $items = $(response);
        $('.grid').prepend($items).masonry('prepended', $items);
        window.chunk++;

        var chunksIds = [];
        for (let index = 0; index < chunks.length; index++) {
          chunks[index].map(function(id) {
            chunksIds.push(id);
          });
        }
        
        var postsOnMap = [];
        var count = 0;
        for (let index = 0; index < chunksIds.length; index++) {
          if (chunksIds[index] in singlePosts) {
            postsOnMap[count] = [];
            postsOnMap[count][0] = singlePosts[chunksIds[index]][0].postid;
            postsOnMap[count][1] = singlePosts[chunksIds[index]];
            count++;
          }
        }

        window.renderMap(postsOnMap);

        if (maxPage === window.chunk || maxPage === 0) {
          $('#load-more').css('display', 'none');
        }else{
          $('#load-more').css('display', 'block');
        }

        $('#filter-popup').removeClass('active');
      },
      error: function(errorThrown) {
        //     console.log(errorThrown);
      }
    }).done(function() {
      window.afterLocationFound(window.singlePosts);
      $('#numberOfResults').html($('#nmbOfResults').html());

      window.lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy"
      });

      window.hoverEffect();
    });
  }); // END Desktip filter TRIGGER

  /*
   * Mobile filter TRIGGER
   *
   */
  $('.show-filter-resuls').click(function(e) {
    // set up the Chunks
    window.chunk = 0;
    var maxPage = window.chunks.length;

    // show load more if there is more card to load
    if (maxPage != window.chunk || maxPage != 0) {
      $('#load-more').css('display', 'inline-block');
    }

    var filterchunk = 0;

    var cat = 0;
    //cat = $('.list-of-cards').attr('data-cat');

    var elements = $('.grid').children();
    var maxPage = chunks.length;
    $('.grid').masonry('remove', elements);

    /*
     * Get data for ONLINE/OFLINE filter attributes
     * returns: Array string
     */
    var isOnline = jQuery('.filter-controll .local-buttons input:checked');
    var dataFiltersOnline = {};
    $(isOnline).each(function() {
      dataFiltersOnline.isOnline = $(this).attr('data-filter');
    });

    /*
     * Get data for SHORT BY filter attributes
     * returns: Array string
     */
    var sortBy = jQuery('.filter-controll .sort-buttons input:checked');
    var dataFiltersShortBy = {};
    $(sortBy).each(function() {
      dataFiltersShortBy.sortBy = $(this).attr('data-filter');
    });

    /*
     * Get data for TRANSACTIONS filter attributes
     * returns: Array string
     */
    var Transactions = jQuery(
      '.filter-controll .transaction-buttons input:checked'
    );
    var dataTransactions = {};
    var dataTransactionInner = {};
    var i = 0;
    $(Transactions).each(function() {
      var vhat = $(this).attr('name');
      dataTransactionInner[i] = $(this).attr('data-filter');
      i = i + 1;
    });
    dataTransactions.transactions = dataTransactionInner;

    var numerOfTransactions = Transactions.length;

    /*
     * Get data for OPEN filter attributes
     * returns: Array string
     */
    var isOpen = jQuery('.filter-controll .open .toggles-mob input:checked');
    var dataFiltersOpen = {};
    if (isOpen.length != 0) {
      $(isOpen).each(function() {
        dataFiltersOpen.isOpen = $(this).attr('data-filter');
      });
    } else {
      dataFiltersOpen.isOpen = 'all';
    }

    /*
     * Get data for CATEGORIES filter attributes
     * returns: Array string
     */
    var categories = jQuery(
      '.filter-controll .categories .category-buttons input:checked'
    );
    //console.log(categories);
    var dataCategories = {};
    var dataCategoriesInner = {};
    var i = 0;
    $(categories).each(function() {
      var vhat = $(this).attr('name');
      dataCategoriesInner[i] = $(this).attr('data-filter');
      i = i + 1;
    });
    dataCategories.cat = dataCategoriesInner;

    /*
     * Place all filter parameter in an Array
     * returns: Array string
     */
    var allFilterData = [];
    allFilterData.push(dataFiltersOnline);
    allFilterData.push(dataFiltersShortBy);
    allFilterData.push(dataTransactions);
    allFilterData.push(dataCategories);
    allFilterData.push(dataFiltersOpen);

    $.ajax({
      type: 'POST',
      url: window.smartakartan.ajaxurl,
      dataType: 'HTML',
      data: {
        action: 'filter_all',
        filters: allFilterData,
        cat: cat,
        user_location: {
          lat: window.smartakartan.user.lat,
          long: window.smartakartan.user.lng
        },
        searchIDs: searchIDs
      },
      success: function(response) {
        var $items = $(response);
        $('.grid').prepend($items).masonry('prepended', $items);
        window.chunk++;

        var chunksIds = [];
        for (let index = 0; index < chunks.length; index++) {
          chunks[index].map(function(id) {
            chunksIds.push(id);
          });
        }
        
        var postsOnMap = [];
        var count = 0;
        for (let index = 0; index < chunksIds.length; index++) {
          if (chunksIds[index] in singlePosts) {
            postsOnMap[count] = [];
            postsOnMap[count][0] = singlePosts[chunksIds[index]][0].postid;
            postsOnMap[count][1] = singlePosts[chunksIds[index]];
            count++;
          }
        }

        window.renderMap(postsOnMap);

        $('#filter-popup').removeClass('active');
      },
      error: function(errorThrown) {
        //     console.log(errorThrown);
      }
    }).done(function() {
      //	console.log(window.singlePosts);
      window.afterLocationFound(window.singlePosts);
      $('#numberOfResults').html($('#nmbOfResults').html());
      $('#filter-feedback').html(
        dataFiltersOnline.isOnline +
          ', ' +
          dataFiltersShortBy.sortBy +
          ', number of tr: ' +
          numerOfTransactions
      );
      $('.filter-overlay').removeClass('active');

      window.lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy"
      });
      //var singlePosts = document.querySelectorAll('.test-posts');
    });
  });
});

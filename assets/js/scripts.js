window.lazyLoadInstance = new LazyLoad({
  elements_selector: ".lazy"
});

$(document).ready(function() {
  //nav menu filter
  $('label.cat-menu-label').on('click', function() {
    $(this).toggleClass('active');
  });

  $('#collection-menu div.scroll-y').scrollLeft(100);

  $('label.ghost-checkbox-label').on('click', function() {
    $('label.ghost-checkbox-label').toggleClass('checked');
  });

  // share-on-social popup trigger
  $('#share-on-social').on('click', function() {
    $('div.share-on-social-container').toggleClass('show');
  });

  $('#share-close').on('click', function() {
    $('div.share-on-social-container').removeClass('show');
  });

  //transactions dropdown
  $('#transaction-dropdown-title').on('click', function() {
    $('#transaction-buttons').toggleClass('show');
  });

  $('#transactions-filter-wrapper').on('mouseenter', function() {
    $('#transaction-buttons').addClass('show');
  });

  $('#transactions-filter-wrapper').on('mouseleave', function() {
    $('#transaction-buttons').removeClass('show');
  });

  //*** Sticky map
  $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    var footerTop = $('footer.main-footer').offset().top;
    var mapHeight = $('div.sticky-map').height();

    if (footerTop - scroll < mapHeight + 100) {
      $('div.map-section').addClass('bottom-map');
    } else if (scroll >= 30) {
      $('div.map-section').removeClass('bottom-map');
      $('div.map-section').addClass('sticky-map');
    } else {
      $('div.map-section').removeClass('sticky-map');
    }
  });

  //***

  $('div#expand-desktop').click(function() {
    if ($('div.map-section').hasClass('col-md-4')) {
      $('div.map-section')
        .addClass('col-md-9')
        .removeClass('col-md-4');
      $('div.content-section')
        .addClass('col-md-3')
        .removeClass('col-md-8');
      $('div#collapseFilter').addClass('show');
      $('div.sk-hero-container').css('display', 'none');
      $('div.calender-list-holder').css('display', 'none');
      $('div.sorting').css('display', 'none');
      $('div#toggleMap').css('display', 'none');
      $('div.collection-slider').css('display', 'none');
      $('span.block-title').css('display', 'none');
      $('i.compress').css('display', 'block');
      $('i.expand').css('display', 'none');
      $('div#category-nav-desktop').css('display', 'none');
      $('div#list-of-cards').css('display', 'none');
      $('button#load-more').css('opacity', '0');
      $('.filter-menu .desktop-filter-holder .desktop-filter').css(
        'flex-direction',
        'column'
      );
      $('.main-content').css('height', '750px');
      $('.the-map').css('max-height', '700px');
      $('#mapid2')
        .css('max-height', '700px')
        .css('height', '700px');
      $('.bottom-map').css('bottom', 'auto');
      $('.bottom-map').css('bottom', 'auto');
      $('.open-cbx-expanded').css('display', 'block');
      $('.open').css('display', 'none');
      //bottom-map
    } else {
      $('div.map-section')
        .addClass('col-md-4')
        .removeClass('col-md-9');
      $('div.content-section')
        .addClass('col-md-8')
        .removeClass('col-md-3');
      $('div#collapseFilter').removeClass('show');
      $('div.sk-hero-container').css('display', 'flex');
      $('div.calender-list-holder').css('display', 'block');
      $('div.sorting').css('display', 'flex');
      $('div#toggleMap').css('display', 'flex');
      $('div.collection-slider').css('display', 'block');
      $('span.block-title').css('display', 'initial');
      $('i.compress').css('display', 'none');
      $('i.expand').css('display', 'block');
      $('div#category-nav-desktop').css('display', 'block');
      $('div#list-of-cards').css('display', 'flex');
      $('button#load-more').css('opacity', '1');
      $('.filter-menu .desktop-filter-holder .desktop-filter').css(
        'flex-direction',
        'row'
      );
      $('.main-content').css('height', '100%');
      $('.the-map').css('max-height', '450px');
      $('#mapid2')
        .css('max-height', '450px')
        .css('height', '70vh');
      $('.bottom-map').css('bottom', '490px');
      $('.open-cbx-expanded').css('display', 'none');
      $('.open').css('display', 'flex');
    }
  });

  $('div#expand-mobile').click(function() {
    $('div.map-container').addClass('map-expanded');
    $('div#mapid2').addClass('map-expanded-inner');
    $('div#mini-mobile').addClass('show-close-mobile');
  });

  $('div#mini-mobile').click(function() {
    $('div.map-container').removeClass('map-expanded');
    $('div#mapid2').removeClass('map-expanded-inner');
    $('div#mini-mobile').removeClass('show-close-mobile');
  });

  $('div#mini-mobile').click(function() {
    $('div.map-container').removeClass('map-expanded');
    $('div#mapid2').removeClass('map-expanded-inner');
    $('div#mini-mobile').removeClass('show-close-mobile');
  });

  /*--FAQ--*/
  //#faq-container
  if ($('div#faq-container')[0]) {
    $('div#faq-container h3').click(function() {
      var display = $(this)
        .next()
        .css('display');
      if (display === 'none') {
        $(this)
          .nextUntil('h3')
          .css('display', 'block');
      } else {
        $(this)
          .nextUntil('h3')
          .css('display', 'none');
      }
    });
  }

  /*---switcher modifications---*/
  //add option to lang-switcher
  var langSelect = $('select#lang_choice_1')[0];
  var opt = document.createElement('option');
  opt.innerHTML = 'Help us translate';
  opt.value = 'Help us translate';
  langSelect.appendChild(opt);

  var getUrl = window.location;

  var baseUrl =
    getUrl.protocol +
    '//' +
    getUrl.host +
    '/' +
    getUrl.pathname.split('/')[1] +
    '/help-us-translate';

  //redirect to translated page
  langSelect.addEventListener('change', function(e) {
    if (e.currentTarget.value === 'Help us translate') {
      window.location.href = baseUrl;
    }
  });


  $('#filter-more').css('display', 'none');

  $('#to-list').click(function() {
    $('#list-of-cards').addClass('show');
    $('#the-map').removeClass('show');
  });

  $('#footer-menu-categories').on('click', function() {
    $('#the-map').removeClass('show');
    $('#main-content').addClass('active');
  });

  $('.filter-icons #toggleMap').on('click', function() {
    $('#map-holder-index').toggleClass('show');
    $(this).toggleClass('map-toggle');
  });

  // Get the navbar
  var filterMenu = document.getElementById('the-filter');
  //var filterMenu = $("#the-filter");

  // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
  function scrollIt() {
    if (window.pageYOffset >= sticky) {
      filterMenu.classList.add('sticky');
      $('.grid').css('margin-bottom', '30px');
    } else {
      filterMenu.classList.remove('sticky');
    }
  }

  // When the user scrolls the page, execute myFunction
  if (filterMenu) {
    // Get the offset position of the navbar
    var sticky = filterMenu.offsetTop;

    window.onscroll = function() {
      scrollIt();
    };
  }
});

var position = $(window).scrollTop();
$(window).scroll(function() {
  var scroll = $(window).scrollTop();

  if (scroll > position && scroll > 55) {
    $('#main-navigation').fadeOut('fast');
    $('.events-list header').css('top', '0');
    $('#the-filter').css('opacity', 1);
  } else {
    $('#main-navigation').fadeIn('fast');
    $('.events-list header').css('top', '46px');
    $('#the-filter').css('opacity', 0);
  }
  position = scroll;
});

jQuery(document).ready(function(){

  //var closeOut = document.querySelector('#feature-more-menu-drop');
  var moreCloseOut = jQuery('#feature-more-menu-drop');
  //var moreModule = document.querySelector('#feature-more-menu');
  var moreModule = jQuery('#feature-more-menu');
  //var moreTrigger = document.querySelector('div.navbar-more');
  var moreTrigger = jQuery('div.navbar-more');
  var searchModule = jQuery('#feature-search');

  moreTrigger.on('click', function(e){

    if (moreCloseOut.hasClass('active')) {
      moreCloseOut.removeClass('active');
      moreModule.removeClass('active');

    }else{
      moreCloseOut.addClass('active');
      moreModule.addClass('active');
      searchModule.removeClass('active');
    }

  })

  moreCloseOut.on('click', function(e){
    if(e.target.id === 'feature-more-menu-drop'){
      moreModule.removeClass('active');

      moreCloseOut.removeClass('active');
    }
  })
})

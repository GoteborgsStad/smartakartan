$(document).ready(function () {

  if ($('.grid').length > 0) {
    /*----fix----*/
    var images = document.querySelectorAll('.grid img');
    var count = 0;

    function loaded() {
      count++;
      if(count == images.length){
        $('.grid').masonry({
          itemSelector: '.grid-item',
          columnWidth: '.grid-sizer',
          percentPosition: true,
          gutter: 10
        });
      }
    };
        for (var i = 0; i < images.length; i++) {
          if (images[i].complete) {
        		loaded()
        	}else {
        		images[i].addEventListener('load', loaded)
        		images[i].addEventListener('error', function() {
        		    loaded()
        			})
        	}
      }
    /*---endfix---*/
  }

  if ($('.grid > article').length < 12) {
    $('#load-more').hide();
  }

  if ($('html')[0].lang == 'sv-SE') {
    setTimeout(function() {
      var wpufLogin = $('#wpuf-login-form');
      if (wpufLogin[0]) {
        $('#loginform p:nth-of-type(1)>label')[0].innerText =
          'Användarnamn eller e-post';
        $('#loginform p:nth-of-type(2)>label')[0].innerText = 'Lösenord';
        $('#loginform p:nth-of-type(3)>label')[0].innerText = 'Kom ihåg mig';
        $('#loginform p:nth-of-type(4) input#wp-submit')[0].value = 'Logga in';

        $('div.login a:nth-of-type(1)')[0].innerText = 'Registrera dig';
        $('div.login a:nth-of-type(2)')[0].innerText = 'Glömt lösenord';
      }
    }, 300);
  }

  setTimeout(function() {
    $(
      '#category-nav-desktop div#transactions-filter-wrapper div#transaction-buttons label'
    ).click(function() {
      $(this).toggleClass('active-transaction');
    });
  }, 300);

  if(typeof instaUser != 'undefined' && instaUser){
    // Instagram feed
     var feed = document.querySelector('#instafeed');
     axios.get('https://www.instagram.com/' + instaUser).then(result => {
         var test = result.data;
         var counter = 0;
         var regex1 = /},{"src":/g;
         var regex2 =/,"config_width":640/g;
         var split = test.split(regex1);
         var urls = [];

         split.map(function(url){
             if(url.match(regex2)){
                 urls.push(url.split(regex2)[0]);
             }
         })

         urls.map(function(img){

           var image = document.createElement("img");
           var source = img.replace(/"/g, '');
           image.src = source;

           if (counter <=3 ) {
             feed.appendChild(image);
           }
              counter++;
         })
     });
  }
});

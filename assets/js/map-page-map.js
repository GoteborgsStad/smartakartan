if (jQuery('body.page-template-the_map').length) {
    if (!Object.entries) {
        Object.entries = function( obj ){
          var ownProps = Object.keys( obj ),
              i = ownProps.length,
              resArray = new Array(i); // preallocate the Array
          while (i--)
            resArray[i] = [ownProps[i], obj[ownProps[i]]];

          return resArray;
        };
      }

      jQuery( document ).ready(function() {
        var latLong;
        var marker;
        var singlePostsArray = Object.entries(array);
        var markers = {};
        var current;

        const body = document.getElementsByTagName('body')[0];
        body.style.overflow = 'hidden';

          // Initialize the Map
          window.mymap = L.map('mapid2', {
            gestureHandling: true,
            gestureHandlingOptions: {
              text: {
                touch: "use two fingers to move the map",
                scroll: "use ctrl + scroll to zoom the map",
                scrollMac: "use \u2318 + scroll to zoom the map"
              }
            }
          }).setView([smartakartan.map.base_lat, smartakartan.map.base_long], 12);

          //map tiles
          L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
              maxZoom: 18,
              attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/" aria-label="Provider">OpenStreetMap</a> contributors, ' +
                  '<a href="https://creativecommons.org/licenses/by-sa/2.0/" aria-label="Licenses">CC-BY-SA</a>, ',
              id: 'mapbox.streets'
          }).addTo(mymap);

        var layers;

        var renderMap = function(array){

          layers = Object.entries(mymap._layers);

          layers.map(function(layer){
            if(layer[1] && layer[1].options && layer[1].options.icon && layer[1].options.icon.options.iconUrl && layer[1].options.icon.options.iconUrl != 'marker-icon.png'){
              mymap.removeLayer(layer[1]);
            }
          })

          array.map(function(post){

            var location;

            if(post[1][0].multiple){
              multiple = post[1][0].multiple.split('&&');
              multiple.map(function(loc){

                axios.get('https://nominatim.openstreetmap.org/search?q=' + loc + '&format=json').then(function(result){

                  if (result.data[0]) {
                    var long = result.data[0].lon;
                    var lat = result.data[0].lat;
                  }

                  if(post[1][0].icon){
                    url = post[1][0].icon;
                  }else{
                    var svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 258.8 321.4" style="enable-background:new 0 0 258.8 321.4;" xml:space="preserve"><g id="Layer_2"><path class="st1" fill="red" d="M84.3,259.4l36.2,60.7c0,0,6.5,2.9,12.2,0s33.8-60.7,33.8-60.7h65.6c0,0,26.1-2,26.5-25.3c0.4-23.2,0-211.4,0-211.4S253.7,0,233.3,0S26.4,0,26.4,0S1.2,2.4,0.4,20s0,218.3,0,218.3s2,19.5,17.9,20.4S84.3,259.4,84.3,259.4z"/></g><g id="Layer_3"><path class="st2" fill="#FFFFFF" d="M127,43.2c-17.1,0.9-60.7,13.4-58.6,62.7s61.4,112,61.4,112s60.4-73.7,59.6-114.9 C188.5,61.9,149.4,41.9,127,43.2z M129,126.2c-11.9,0-21.6-9.7-21.6-21.6S117,83,129,83s21.6,9.7,21.6,21.6S140.9,126.2,129,126.2z"/></g></svg>'
                    var url = encodeURI("data:image/svg+xml," + svgIcon).replace('#','%23');
                  }

                  var myIcon = L.icon({
                      iconUrl: url,
                      iconSize: [36, 36],
                      popupAnchor: [0, -10],
                  });

                  var popupContent = '<a href="' + post[1][0].link + '" class="custom-title" aria-label="Link to post">' + '<div class="custom-inner"><span class="custom_title">' + post[1][0].title + '</span><br><span class="custom_cat">' + post[1][0].sub_cat_name + '</span><br/><span class="custom_excerpt">' + post[1][0].excerpt + '</span><div class="img-cont" style="background-image: url(' + post[1][0].img + ');"></div></div></a>';

                  var popupOptions =
                  { 'className' : 'custom', 'id' : post[1][0].postid }

                  marker = L.marker([lat, long], {icon: myIcon} ).addTo(mymap).bindPopup(popupContent,popupOptions);
                  marker.on('mouseover', function(e){
                    this.openPopup();
                  });
                  marker.on('click', function(e){
                    this.openPopup();
                  });

                  markers[post[1][0].postid] = marker;

                });

              });


            }else if(post[1][0].coordinates){
              location = post[1][0].coordinates;
            }else{
              location = post[1][0].street + ',+' + post[1][0].city;
            }

      if(post[1][0].lon){

                      var long = post[1][0].lon;
                      var lat = post[1][0].lat;

              if(post[1][0].icon){
                url = post[1][0].icon;
              }else{
                var svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 258.8 321.4" style="enable-background:new 0 0 258.8 321.4;" xml:space="preserve"><g id="Layer_2"><path class="st1" fill="red" d="M84.3,259.4l36.2,60.7c0,0,6.5,2.9,12.2,0s33.8-60.7,33.8-60.7h65.6c0,0,26.1-2,26.5-25.3c0.4-23.2,0-211.4,0-211.4S253.7,0,233.3,0S26.4,0,26.4,0S1.2,2.4,0.4,20s0,218.3,0,218.3s2,19.5,17.9,20.4S84.3,259.4,84.3,259.4z"/></g><g id="Layer_3"><path class="st2" fill="#FFFFFF" d="M127,43.2c-17.1,0.9-60.7,13.4-58.6,62.7s61.4,112,61.4,112s60.4-73.7,59.6-114.9 C188.5,61.9,149.4,41.9,127,43.2z M129,126.2c-11.9,0-21.6-9.7-21.6-21.6S117,83,129,83s21.6,9.7,21.6,21.6S140.9,126.2,129,126.2z"/></g></svg>'
                var url = encodeURI("data:image/svg+xml," + svgIcon).replace('#','%23');
              }

              var myIcon = L.icon({
                  iconUrl: url,
                  iconSize: [36, 36],
                  popupAnchor: [0, -10],
              });

              var popupContent = '<a href="' + post[1][0].link + '" class="custom-title" aria-label="Link to post">' + '<div class="custom-inner"><span class="custom_title">' + post[1][0].title + '</span><br><span class="custom_cat">' + post[1][0].sub_cat_name + '</span><br/><span class="custom_excerpt">' + post[1][0].excerpt + '</span><div class="img-cont" style="background-image: url(' + post[1][0].img + ');"></div></div></a>';

              var popupOptions =
              { 'className' : 'custom', 'id' : post[1][0].postid }

              marker = L.marker([lat, long], {icon: myIcon} ).addTo(mymap).bindPopup(popupContent,popupOptions);
              marker.on('mouseover', function(e){
                this.openPopup();
              });
              marker.on('click', function(e){
                this.openPopup();
              });

              markers[post[1][0].postid] = marker;

            }
          })
        };

        renderMap(singlePostsArray);

        var query = {'open': false, 'cats': []};
        const showOpen = document.querySelector('input#checkboxOpen');
        const filterCategory = document.querySelectorAll('label.cat-tag input');
        for (var i = 0; i < filterCategory.length; i++) {
              query.cats.push(filterCategory[i].value);
            };

        var filterMap = function(query){

          if(query.open){
            var array1 = singlePostsArray.filter(function(post){
              return post[1][0].open && post[1][0].open == 'open';
            })
           }else{
             var array1 = singlePostsArray;
           };
          if(query.cats.length > 0 && array1.length > 0){
            var array2 = array1.filter(function(post){
              return (new RegExp(query.cats.join("|")).test(post[1][0].cat_id));
            })
           }else{
             var array2 = [];
            };

            renderMap(array2);
        }

        document.querySelector('#center-on-me').addEventListener('click', function(){
          return mymap.setView({lon: current.lng, lat: current.lat} ,16);
        })

        showOpen.addEventListener('change', function(e){
          if(e.currentTarget.checked){
            query.open = true;
          }else{
            query.open = false;
          }
          filterMap(query);
        });

        for (var i = 0; i < filterCategory.length; i++) {
          filterCategory[i].addEventListener('change', function(e){
            if(e.currentTarget.checked){
              query.cats.push(e.currentTarget.value);
            }else{
              var index = query.cats.indexOf(e.currentTarget.value);
                if (index > -1) {
                  query.cats.splice(index, 1);
                }
              }
            filterMap(query);
          })
        };

              //track user location
              mymap.on('locationfound', function(e){
                  current = e.latlng;

                  var meIcon = L.icon({
                    iconUrl: home + '/assets/images/marker_home.png',
                    iconSize:     [38, 38],
                    popupAnchor:  [0, 0]
                  });

                  var marker = L.marker([current.lat, current.lng], { icon: meIcon }).addTo(mymap).bindPopup('<h6>'  +  here + '</h6>');
                  mymap.setView({lon: current.lng, lat: current.lat} ,12);
                  var icon = { fillColor: 'blue', fillOpacity: 1, radius: 15 };
          });

          mymap.locate();
      })
}


//add event map: || jQuery('body.single-calender_post_type').length
if (jQuery('body.single-post').length) {
  if (!Object.entries) {
    Object.entries = function(obj) {
      var ownProps = Object.keys(obj),
        i = ownProps.length,
        resArray = new Array(i); // preallocate the Array
      while (i--) resArray[i] = [ownProps[i], obj[ownProps[i]]];

      return resArray;
    };
  }

  //var singlePost = document.querySelectorAll('.test-posts');
  var single = window.singleArray;
  var marker;

  var mapContainer = document.querySelector('#mapid2');

  //set initial map
  if(mapContainer){


  var mymap = L.map('mapid2', {
    gestureHandling: true,
    gestureHandlingOptions: {
      text: {
        touch: "use two fingers to move the map",
        scroll: "use ctrl + scroll to zoom the map",
        scrollMac: "use \u2318 + scroll to zoom the map"
      }
    }
   }).setView(
    [smartakartan.map.base_lat, smartakartan.map.base_long], 10
  );

  //map tiles
  L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution:
      'Map data &copy; <a href="https://www.openstreetmap.org/" aria-label="Provider">OpenStreetMap</a> contributors, ' +
      '<a href="https://creativecommons.org/licenses/by-sa/2.0/" aria-label="Licenses">CC-BY-SA</a>, ',
    id: 'mapbox.streets'
  }).addTo(mymap);

  //track user location
  mymap.on('locationfound', function(e) {
    var current = e.latlng;
    // render my location on the map

    var meIcon = L.icon({
      iconUrl: home + '/assets/images/marker_home.png',
      iconSize:     [38, 38],
      popupAnchor:  [0, 0]
    });

    var marker = L.marker([current.lat, current.lng], { icon: meIcon })
      .addTo(mymap)
      .bindPopup('<h6>' + here + '</h6>')
      .on('click', centerMarker);
    var icon = { fillColor: 'blue', fillOpacity: 1, radius: 15 };
  }); //location found

  mymap.locate();

  ///Set default location on single post
  if (single.length > 0) {
    single.map(function(post) {
      var query = false;

      if (post.multiple) {
        multiple = post.multiple.split('&&');
        multiple.map(function(loc) {
          axios
            .get(
              'https://nominatim.openstreetmap.org/search?q=' +
                loc +
                '&format=json'
            )
            .then(function(result) {
              var long = result.data[0].lon;
              var lat = result.data[0].lat;
              //place markers

              if (post.icon) {
                url = post.icon;
              } else {
                var svgIcon =
                  '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 258.8 321.4" style="enable-background:new 0 0 258.8 321.4;" xml:space="preserve"><g id="Layer_2"><path class="st1" fill="red" d="M84.3,259.4l36.2,60.7c0,0,6.5,2.9,12.2,0s33.8-60.7,33.8-60.7h65.6c0,0,26.1-2,26.5-25.3c0.4-23.2,0-211.4,0-211.4S253.7,0,233.3,0S26.4,0,26.4,0S1.2,2.4,0.4,20s0,218.3,0,218.3s2,19.5,17.9,20.4S84.3,259.4,84.3,259.4z"/></g><g id="Layer_3"><path class="st2" fill="#FFFFFF" d="M127,43.2c-17.1,0.9-60.7,13.4-58.6,62.7s61.4,112,61.4,112s60.4-73.7,59.6-114.9 C188.5,61.9,149.4,41.9,127,43.2z M129,126.2c-11.9,0-21.6-9.7-21.6-21.6S117,83,129,83s21.6,9.7,21.6,21.6S140.9,126.2,129,126.2z"/></g></svg>';
                var url = encodeURI('data:image/svg+xml,' + svgIcon).replace(
                  '#',
                  '%23'
                );
              }

              var myIcon = L.icon({
                iconUrl: url,
                iconSize: [36, 36]
              });

              marker = L.marker([lat, long], { icon: myIcon }).addTo(mymap);
              mymap.setView(new L.LatLng(lat, long), 12);
            });
        });
      } else if (post.coordinates) {
        query = post.coordinates;
      } else {
        query = post.street + ',+' + post.city;
      }

      if (query) {
        var long = post.lon;
        var lat = post.lat;
        var url;
        //place markers

        if (post.icon) {
          url = post.icon;
        } else {
          var svgIcon =
            '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 258.8 321.4" style="enable-background:new 0 0 258.8 321.4;" xml:space="preserve"><g id="Layer_2"><path class="st1" fill="red" d="M84.3,259.4l36.2,60.7c0,0,6.5,2.9,12.2,0s33.8-60.7,33.8-60.7h65.6c0,0,26.1-2,26.5-25.3c0.4-23.2,0-211.4,0-211.4S253.7,0,233.3,0S26.4,0,26.4,0S1.2,2.4,0.4,20s0,218.3,0,218.3s2,19.5,17.9,20.4S84.3,259.4,84.3,259.4z"/></g><g id="Layer_3"><path class="st2" fill="#FFFFFF" d="M127,43.2c-17.1,0.9-60.7,13.4-58.6,62.7s61.4,112,61.4,112s60.4-73.7,59.6-114.9 C188.5,61.9,149.4,41.9,127,43.2z M129,126.2c-11.9,0-21.6-9.7-21.6-21.6S117,83,129,83s21.6,9.7,21.6,21.6S140.9,126.2,129,126.2z"/></g></svg>';
          var url = encodeURI('data:image/svg+xml,' + svgIcon).replace(
            '#',
            '%23'
          );
        }

        var myIcon = L.icon({
          iconUrl: url,
          iconSize: [36, 36]
        });

        marker = L.marker([lat, long], { icon: myIcon }).addTo(mymap);
        mymap.setView(new L.LatLng(lat, long), 12);
        //});
      }
    });
  }

  //center map on marker click
  function centerMarker(e) {
    mymap.setView(e.target.getLatLng(), 12);
  }
}

}

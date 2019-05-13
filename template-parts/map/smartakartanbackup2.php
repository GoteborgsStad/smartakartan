<?php $postArray = array(); ?>
<?php $allArray = array(); ?>

<?php
/*
*	Get all cards
*
*/
 $allPostsArray = array();
 $allEventsArray = array();

 if(empty($search_results)){

	// 1. get ALL POSTS with address to show on map

	$postArgs = array(
		'numberposts' => -1,
		'post_type' => 'post',
		'lang' => 'sv',
	);
	$allPosts = get_posts($postArgs);

	foreach ($allPosts as $key => $value) {
			$id = $value->ID;

			$street_address = get_field('street_address', $id);
			$city = get_field('city', $id);

			if(strlen($street_address) != 0 || strlen($city) != 0 ){
				$allPostsArray[$id] = array();
				$object = new stdClass();
				$object->title = get_the_title($id);
				$object->postid = $id;
				$object->street = get_field('street_address', $id);
				$object->city = get_field('city', $id);
				$object->link = get_the_permalink($id);
				$object->excerpt = get_field('underrubrik', $id);

				array_push($allPostsArray[$id], $object);
				 //array_push($allPostsArray, $object);
			}
	}

	// 2. get ALL EVENTS with address to show on map

	$eventsArgs = array(
		'numberposts' => -1,
		'post_type' => 'calender_post_type',
		'lang' => 'sv',
	);
	$allEvents = get_posts($eventsArgs);

	foreach ($allEvents as $key => $value) {
			$id = $value->ID;

			$street_address = get_field('street_address', $id);
			$city = get_field('city', $id);
			$eventDate = get_field('startdate_t', $id);
			$now = date('Ymd');

			if ($eventDate - $now >= 0) {
				if(strlen($street_address) != 0 || strlen($city) != 0 ){
					$allEventsArray[$id] = array();
					$object = new stdClass();
					$object->evTitle = get_the_title($id);
					$object->postid = $id;
					$object->street = get_field('street_address', $id);
					$object->city = get_field('city', $id);
					$object->evLink = get_the_permalink($id);
					$object->start = get_field('startdate_t', $id);
					$object->startTime = get_field('start_time', $id);
					$object->end = get_field('enddate', $id);
					//$object->excerpt = get_field('underrubrik', $id);

					array_push($allEventsArray[$id], $object);
					 //array_push($allPostsArray, $object);
				}
			}

	}

 }else{
 		foreach ($search_results as $key => $value) {
			$id = $value;

			$street_address = get_field('street_address', $id);
			$city = get_field('city', $id);


			if(strlen($street_address) != 0 || strlen($city) != 0 ){
				$allPostsArray[$id] = array();
				$object = new stdClass();
				$object->title = get_the_title($id);
				$object->postid = $id;
				$object->street = get_field('street_address', $id);
				$object->city = get_field('city', $id);
				$object->link = get_the_permalink($id);
				$object->excerpt = get_field('underrubrik', $id);

				array_push($allPostsArray[$id], $object);
				 //array_push($allPostsArray, $object);
			}
	}}?>

<?php	$categories = get_terms(
	array(
		'taxonomy' 		=> 'category',
		'hide_empty' => false,
		'parent'  			=> 0,
		'exclude' 			=> array(1, 227)
	));
?>

<!-- show the controll panel on the map
- Get the categories  -->

<div class="map-container">
	<div class="container-fluid map-data">
		<div class="row">
			<div class="col-12">
				<h4>Categories</h4>

			</div>
			<!-- List categories -->
			<div class="col-12 map-categories">
				<!--- set up marker groups (categories) --->
				<div class="map-cat" data-slug="all">
					<div class="circle"></div>
					<span class="category-name" data-slug="all">all</span>
				</div>

				<?php foreach ($categories as $key => $value): ?>

					<div class="map-cat" data-slug="<?php echo $value->slug; ?>">
						<div class="circle"></div>
						<span class="category-name" ><?php echo $value->name; ?></span>
					</div>

					<?php $args = array(
							'post_type' 				=> 'post',
							'posts_per_page' => -1,
							'order' 							=> 'DESC',
							'tax_query'	=> array(
				        			array (
				            		'taxonomy' 	=> 'category',
				            		'field' 				=> 'slug',
				            		'terms'	 			=> $value->slug,
				        				)), ); ?>

						<?php $postArray[$value->slug] = array(); ?>
						<?php  $query = new WP_Query( $args );?>

							<?php while ( $query->have_posts() ) : $query->the_post(); ?>

								<?php if(get_field('street_address') && get_field('city')){
									$object = new stdClass();
									$object->title = get_the_title();
									$object->street = get_field('street_address');
									$object->city = get_field('city');
									$object->link = get_the_permalink();
									$object->excerpt = get_the_excerpt();
                  			$object->image = get_the_post_thumbnail_url();
									$object->cat = $value->slug;
			                  $object->monday = get_field('monday');
			                  $object->tuesday = get_field('tuesday');
			                  $object->wednesday = get_field('wednesday');
			                  $object->thursday = get_field('thursday');
			                  $object->friday = get_field('friday');
			                  $object->saturday = get_field('saturday');
			                  $object->sunday = get_field('sunday');
									array_push($postArray[$value->slug], $object);
									array_push($allArray, $object);
								} ?>

							<?php endwhile; ?>
						<?php wp_reset_query(); ?>
				<?php endforeach ?>
			</div><!-- List categories -->
      <br>
      <div class="search-wrap">
        <div class="search-wrap-inner">
          <input type="text" id="search-map" placeholder="Search map...">
          <ul id="search-result"></ul>
        </div>
      </div>
      <br>
		</div>
	</div>


	<!-- Show the map -->
	<div class="map-wrapper">
		<!-- map container -->
		<div id="mapid2" class="leaflet-map" style=""></div>
		<a href="<?php echo get_bloginfo('url') ?>/lagg-till-verksamhet-guest/">
			<!-- add item to map -->
			<div class="add-post"></div>
		</a>
	</div>
</div>

<div class="custom-popup">
		<div class="close-out">
			<span class="close"></span>
		</div>
	<div class="popup-text">
		<h3><span id="title"></span> - <span id="category"></span></h3>
		<b id="open-now"></b>
		<p id="description"><p>
		<a id="link"><?php pll_e( 'läs mer');?></a>
	</div>
	<div id="popup-image"></div>
</div>


<script>
jQuery( document ).ready(function() {

	// Initialize the Map
	window.mymap = L.map('mapid2', { gestureHandling: true}  ).setView([57.7030712, 11.9590075], 12);

	//map tiles
	L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ',
		id: 'mapbox.streets'
	}).addTo(mymap);

	//map.gestureHandling.enable();
	// window.yess = function yes(){
		/*
		* 		Get the cards (initiatives) and Place them on the map
		*
		*
		*/

		window.singlePosts = <?php echo json_encode($allPostsArray)?>;
		var singlePostsArray = Object.entries(singlePosts);
    var myIcon = L.icon({
        iconUrl: ' <?php bloginfo('template_url'); ?>/dist/images/marker_01.png',
        iconSize: [38, 38],
        popupAnchor: [0, -6],
    });

    singlePostsArray.map(function(post){
      axios.get('https://nominatim.openstreetmap.org/search?q=' + post[1][0].street + ',+' + post[1][0].city + '&format=json').then(result => {
				var long = result.data[0].lon;
				var lat = result.data[0].lat;
				//place markers
				marker = L.marker([lat, long], {icon: myIcon} ).addTo(mymap).bindPopup('<h6>' + post[1][0].title + '</h6><p>' + post[1][0].excerpt + '</p><p><a href="' + post[1][0].link + '">read more</a></p>').on('click', centerMarker);
				//mymap.setView({lon: long, lat: lat} ,12);
			});
    })
    /*
		for (var i in singlePosts) {

			var address = singlePosts[i][0].street;
			var city = singlePosts[i][0].city;
			var title = singlePosts[i][0].title;
			var excerpt = singlePosts[i][0].excerpt;
			var link = singlePosts[i][0].link;
			var icon = { fillColor: 'yellow', fillOpacity: 1, radius: 10 };
			var myIcon = L.icon({
			    iconUrl: ' <?php bloginfo('template_url'); ?>/dist/images/marker_01.png',
			    iconSize: [38, 38],
			    popupAnchor: [0, -6],
			});
      console.dir(title);

			//get coordinates
			axios.get('https://nominatim.openstreetmap.org/search?q=' + address + ',+' + city + '&format=json').then(result => {
				var long = result.data[0].lon;
				var lat = result.data[0].lat;
        console.log('title:', title, i);
				//place markers
				marker = L.marker([lat, long], {icon: myIcon} ).addTo(mymap).bindPopup('<h6>' + title + '</h6><p>' + excerpt + '</p><p><a href="' + link + '">read more</a></p>').on('click', centerMarker);
				//mymap.setView({lon: long, lat: lat} ,12);
			});

		}
    */

		/*
		* 		Get the Events and Place them on the map
		*
		*
		*/

		singleEvents = <?php echo json_encode($allEventsArray)?>;

				var singleEventsArray = Object.entries(singleEvents);
			var my_events_Icon = L.icon({
			    iconUrl: ' <?php bloginfo('template_url'); ?>/dist/images/icon-event.svg',
			    iconSize: [38, 38],
			    popupAnchor: [0, -6],
			});

    singleEventsArray.map(function(event){
      axios.get('https://nominatim.openstreetmap.org/search?q=' + event[1][0].street + ',+' + event[1][0].city + '&format=json').then(result => {
				var long = result.data[0].lon;
				var lat = result.data[0].lat;
				//place markers
				marker = L.marker([lat, long], {icon: my_events_Icon} ).addTo(mymap).bindPopup('<h6>' + event[1][0].evTitle + '</h6><p>' + 'text here' + '</p><p><a href="' + event[1][0].evLink + '">read more</a></p>').on('click', centerMarker);
				//mymap.setView({lon: long, lat: lat} ,12);
			});
    })

		//console.log(singleEvents);
		// for (var i in singleEvents) {
		// 	var address = singleEvents[i][0].street;
		// 	var city = singleEvents[i][0].city;

		// 	var evTitle = singleEvents[i][0].evTitle;
		// 	//var excerpt = singleEvents[i][0].excerpt;
		// 	//console.log(evTitle);

		// 	var evLink = singleEvents[i][0].evLink;
		// 	var icon = { fillColor: 'yellow', fillOpacity: 1, radius: 10 };
		// 	var my_events_Icon = L.icon({
		// 	    iconUrl: ' <?php bloginfo('template_url'); ?>/dist/images/icon-event.svg',
		// 	    iconSize: [38, 38],
		// 	    popupAnchor: [0, -6],
		// 	});

		// 	//get coordinates
		// 	axios.get('https://nominatim.openstreetmap.org/search?q=' + address + ',+' + city + '&format=json').then(result => {
		// 		var long = result.data[0].lon;
		// 		var lat = result.data[0].lat;

		// 		//place markers
		// 		marker = L.marker([lat, long], {icon: my_events_Icon} ).addTo(mymap).bindPopup('<h6>' + evTitle + '</h6><p>' + address + '</p><p><a href="' + evLink + '">read more</a></p>').on('click', centerMarker);
		// 		//mymap.setView({lon: long, lat: lat} ,12);
		// 	});
		// }




		var posts = <?php echo json_encode($postArray)?>;
		var allPosts = <?php echo json_encode($allArray)?>;
    var customPopup = document.querySelector('.custom-popup');
  	var closePopup = document.querySelector('.close-out');
  	var home = <?php echo json_encode(get_template_directory_uri())?>;
  	var latLong;
  	var marker;

		//track user location
		mymap.on('locationfound', function(e){

			var current = e.latlng;
			window.SmartaKartan = {}; // global Object container; don't use var
			SmartaKartan.value = current;

			// render my location on the map
			var marker = L.marker([current.lat, current.lng]).addTo(mymap).bindPopup('<h6>This is me</h6>').on('click', centerMarker);
			mymap.setView({lon: current.lng, lat: current.lat} ,12);
			var icon = { fillColor: 'blue', fillOpacity: 1, radius: 15 };
			afterLocationFound(singlePosts);
	});


		//function writeDistanceOnCard(current){
			window.writeDistanceOnCard = function(current){
			// console.log('writeDistanceOnCard');
			// console.log(singlePosts);
			// console.log('distance-123');
			Object.entries(window.singlePosts).map(function(post){

			axios.get('https://nominatim.openstreetmap.org/search?q=' + post[1][0].street + ',+' + post[1][0].city + '&format=json').then(result => {

				var shortByDistance = Math.round(current.distanceTo([result.data[0].lat, result.data[0].lon]) );
				//console.log(result.data[0].display_name);
				var locationsting = result.data[0].display_name;
				var match = locationsting.split(', ');
			//	console.log(locationsting);

				//console.log(shortByDistance);
				if(current.distanceTo([result.data[0].lat, result.data[0].lon]) < 1000)
					{
						var distance = Math.round(current.distanceTo([result.data[0].lat, result.data[0].lon])) + ' m';
					}else{
						var distance = current.distanceTo([result.data[0].lat, result.data[0].lon]) / 1000;
						distance = Math.round( distance * 10 ) / 10 + ' km';
					}
					//console.log(distance);

					 var selector = post[1][0].postid;
					 //console.log(selector);
					 var selected = '#post-'+selector;
					 //console.log(selected);
					 //var article = jQuery("article#post-"+selector+".distance");
					 //jQuery('article#post-'+selector+' .distance').html('');
					 //jQuery('article#post-'+selector+' .distance').html(distance);
					 //var dist = jQuery(".distance");
					 //jQuery('#List-of-cards').find('article#post-'+selector+' .distance').addClass('bla');
					 var article = jQuery('.grid').find(selected);
					//console.log(article);

					 //jQuery(article).find('.distance').append( "<p>Test</p>" );

					 //jQuery(article).find('.distance').html('');
					 jQuery(article).find('.distance').addClass('s'+selector);
					 jQuery(article).find('.s'+selector).html(distance);

					 if (jQuery(article).find('.area-online')) {
					 	 jQuery(article).find('.area-online').html(match[2]);
					 }

					 jQuery(selected).attr('data-distance', shortByDistance);
				});
			})

			/*
			* Get Distance on cards?
			*
			*/

			// takes the ids of the all card
			var cardsWithDistance = jQuery('.test-posts');
			//console.log(cardsWithDistance);

			window.dataDistance =[];
			var j = 0;

			jQuery(cardsWithDistance).each(function(){


			var distanceString = jQuery(this).attr('data-distance');
			var distance = parseInt(distanceString);

			dataDistance[j] = new Object();
			dataDistance[j]['distance'] = distance;
			dataDistance[j]['id'] =jQuery(this).attr('data-postid');


				//console.log($(this).attr('data-distance'));
			// dataDistance[j] = $(this).attr('data-distance');
			// dataDistance[j] = $(this).attr('data-postid');
			j++;
		})

			console.log(dataDistance);



		}

	window.afterLocationFound = function(data){
		//console.log(data+'this');
		var currentLocation = SmartaKartan.value;
		//console.log(currentLocation);
		window.writeDistanceOnCard(currentLocation);
	};

	mymap.locate();

	//drop markers on map
  function dropMarkers(e, o){
		var layers = Object.entries(mymap._layers);
		if(e === 'result'){
			var array = [o];
			layers.map(function(layer){
				if(layer[1] && layer[1].options && layer[1].options.icon){
					mymap.removeLayer(layer[1]); }
			})
		}else if(e === 'all' || e.currentTarget.dataset.slug === 'all'){
			var array = allPosts;
			layers.map(function(layer){
				if(layer[1] && layer[1].options && layer[1].options.icon){
					mymap.removeLayer(layer[1]);
				}
			})
		}else{
			var slug = e.currentTarget.dataset.slug;
			var array = posts[slug];
			layers.map(function(layer){
				if(layer[1] && layer[1].options && layer[1].options.icon){
					mymap.removeLayer(layer[1]); }
			})
		}

		array.map(function(post){
			axios.get('https://nominatim.openstreetmap.org/search?q=' + post.street + ',+' + post.city + '&format=json').then(result => {
				//icons for categories
				var catIcon;
				if(e === 'result'){
					latLong = { 'lat': result.data[0].lat,
											'lng': result.data[0].lon };
									}

					switch (post.cat) {
						case 'kunskap':
						catIcon = L.icon({
								iconUrl: home + '/assets/images/knowledge.svg',
								iconSize: [30, 30],
						});
							break;
						case 'mat':
						catIcon = L.icon({
								iconUrl: home + '/assets/images/food.svg',
								iconSize: [30, 30],
						});
							break;
						case 'moten':
						catIcon = L.icon({
								iconUrl: home + '/assets/images/meeting.svg',
								iconSize: [30, 30],
						});
							break;
						case 'saker':
						catIcon = L.icon({
								iconUrl: home + '/assets/images/things.svg',
								iconSize: [30, 30],
						});
							break;
						case 'transport':
						catIcon = L.icon({
								iconUrl: home + '/assets/images/transport.svg',
								iconSize: [30, 30],
						});
							break;
						case 'yta':
						catIcon = L.icon({
								iconUrl: home + '/assets/images/space.svg',
								iconSize: [30, 30],
						});
            default:
            catIcon = L.icon({
      			    iconUrl: ' <?php bloginfo('template_url'); ?>/dist/images/marker_01.png',
      			    iconSize: [38, 38],
      			    popupAnchor: [0, -6],
      			});

						}

						var long = result.data[0].lon;
						var lat = result.data[0].lat;
						//place markers

						marker = L.marker([lat, long], {icon: catIcon} ).addTo(mymap).on('click', function(e){

							let title = document.querySelector('#title');
							let link = document.querySelector('#link');
							let image = document.querySelector('#popup-image');
							let open = document.querySelector('#open-now');
							let description = document.querySelector('#description');
							let cat = document.querySelector('#category');
							let background;

							if(post.image){
								background = 'url(' + post.image + ')';
							}else{
								background = 'url()';
							}

              var monday = post.monday.split('-');
              var tuesday = post.monday.split('-');
              var wednesday = post.monday.split('-');
              var thursday = post.monday.split('-');
              var friday = post.monday.split('-');
              var saturday = post.monday.split('-');
              var sunday = post.monday.split('-');

							var d = new Date();
    					var n = d.getDay();
    					var now = d.getHours() + "." + d.getMinutes();
    					var weekdays = [
								["Sunday", sunday[0], sunday[1]],
        				["Monday", monday[0], monday[1]],
        				["Tuesday", tuesday[0], tuesday[1]],
        				["Wednesday", wednesday[0], wednesday[1]],
        				["Thursday", thursday[0], thursday[1]],
        				["Friday", friday[0], friday[1]],
        				["Saturday", saturday[0], saturday[1]]
    						];
    					var day = weekdays[n];

    					if (now > day[1] && now < day[2]) {
        				open.innerText = 'Open';
								open.style.color = 'green';
    					}else {
								open.innerText = 'Closed';
        				open.style.color = 'red';
    					}
							title.innerText = post.title;
							cat.innerText = post.cat;
							description.innerText = post.excerpt;
							image.style.background = background;
							link.href = post.link;
							customPopup.style.height = '250px';
							document.querySelector('.add-post').style.bottom = '200px';
							centerMarker(e);
						});

						if(e === 'result'){
							centerMarker('result', latLong);
						}
					});
				})

			}

		//center map on marker click
		function centerMarker(e) {
			//mymap.setView(e.target.getLatLng(),11);
		}

		var categories = document.querySelectorAll('.map-cat');
		//add listener for categories
		for (var i = 0; i < categories.length; i++) {
			categories[i].addEventListener('click', dropMarkers)
		}

    closePopup.addEventListener('click', function(){
    	customPopup.style.height = '0px';
    	document.querySelector('.add-post').style.bottom = '40px';
    })

    var searchField = document.querySelector('#search-map');
    var searchResult = [];
    var searchMatch = '';
    var resultUl = document.querySelector('#search-result');

    searchField.addEventListener('keyup', function(e){
    	if(e.target.value.length > 2){
    		var query = e.target.value;
    			allPosts.map(function(post){
    				let title = post.title;
    				if(title.includes(query) && !searchMatch.includes(title)){
    					searchMatch = searchMatch + post.title + '%';
    				}else if(!title.includes(query) && searchMatch.includes(title)){
    					searchMatch = searchMatch.replace(title, '');
    				}
    			});
    	}else{
    		searchMatch = '';
    	}
    	let tempArray = searchMatch.split('%');
    	searchResult = tempArray.filter(function(temp){
    		return temp.length;
    	});

    	while (resultUl.firstChild) {
        resultUl.removeChild(resultUl.firstChild);
    		}

    	searchResult.map(function(result){
    		var li = document.createElement('li');
    		li.innerText = result;
    		li.addEventListener('click', function(e){
    			var currenTitle = e.currentTarget.innerText;
    			allPosts.map(function(post){
    				if(post.title === currenTitle){
    					dropMarkers('result', post);
    					while (resultUl.firstChild) {
    				    resultUl.removeChild(resultUl.firstChild);
    						}
    					searchField.value = '';
    				}
    			})

    		})
    		resultUl.appendChild(li);
    	})

    });


}) // doc ready
</script>

<style media="screen">

	div.map-wrapper{
		position: relative;
	}

	div.add-post{
		position: absolute;
		border-radius: 50%;
		background-color: #64c153;
		width: 40px;
		height: 40px;
		right: 40px;
		bottom: 40px;
		z-index: 999999;
		cursor: pointer;
		border: 3px solid white;
	}

  div.cat-div{
  	display: inline-block;
  	margin-top: 15px;
  }

  div.icon{
  	width: 30px;
    height: 30px;
    margin-left: auto;
    margin-right: auto;
  }

  div.cat-div:nth-of-type(1) > div.icon{
  	background-image: url('../wp-content/themes/smartakartan/assets/images/knowledge.svg');
  }
  div.cat-div:nth-of-type(2) > div.icon{
  	background-image: url('../wp-content/themes/smartakartan/assets/images/food.svg');
  }
  div.cat-div:nth-of-type(3) > div.icon{
  	background-image: url('../wp-content/themes/smartakartan/assets/images/meeting.svg');
  }
  div.cat-div:nth-of-type(4) > div.icon{
  	background-image: url('../wp-content/themes/smartakartan/assets/images/things.svg');
  }
  div.cat-div:nth-of-type(5) > div.icon{
  	background-image: url('../wp-content/themes/smartakartan/assets/images/transport.svg');
  }
  div.cat-div:nth-of-type(6) > div.icon{
  	background-image: url('../wp-content/themes/smartakartan/assets/images/space.svg');
  }

  .search-wrap{
  	position: relative;
  	width: 100%;
  	height: 30px;
  	display: flex;
  	justify-content: center;
  }

  .search-wrap-inner{
  	width: 50%;
    position: absolute;
  }

  input#search-map{
  	max-width: none;
    width: 100%;
  }

  ul#search-result{
  	list-style: none;
  	background: rgba(255, 255, 255, .8);
  	padding-left: 0;
  }

  ul#search-result li{
  	padding: 10px;
  	border-bottom: 1px solid grey;
  }



  div.map-nav{
  	position: fixed;
  	top: -140px;
  	left: 0;
  	width: 100%;
  	max-height: 500px;
  	height: auto;
  	padding-top: 55px;
  	z-index: 1000;
  	text-align: center;
  	background-color: white;
  	transition: .5s;
  }

  div#map-navbar{
  	position: fixed;
  	top: 300px;
  	display: inline-block;
  	width: 100%;
  	text-align: center;
  	z-index: 1000;
  }

  div.close-out{
    width: 30px;
    height: 30px;
  	position: absolute;
  	top: 30px;
  	right: 30px;
  }

    span.close{
      display: inline-block;
      height: 30px;
      width: 30px;
    }

    span.close::before{
      content: '';
      position: absolute;
      width: 30px;
      height: 1px;
      right: 0px;
      top: 0px;
      background: black;
      transition: .2s;
      transform: rotate(-45deg);
    }

    span.close::after{
      content: '';
      position: absolute;
      width: 30px;
      height: 1px;
  		right: 0px;
      top: 0px;
      background: black;
      transition: .2s;
      transform: rotate(45deg);
    }


  p.category {
  	display: inline;
  	font-size: 12px;
  	text-align: center;
  }

  div.custom-popup{
  	position: fixed;
  	bottom: 0;
  	left: 0;
  	z-index: 1000;
  	height: 0px;
  	transition: .5s;
  	overflow: scroll;
  	/*padding: 10px 0 50px 20px;*/
  	background-color: white;
  	width: 100%;
  }

  div.popup-text{
  	display: inline-block;
  	width: 60%;
  }

  div#popup-image{
  	display: inline-block;
  	width: 35%;
  	height: 80px;
  }
  	div.map-wrapper{
  		position: relative;
  	}

  	div.add-post{
  		position: absolute;
  		border-radius: 50%;
  		background-color: #64c153;
  		width: 40px;
  		height: 40px;
  		right: 40px;
  		bottom: 40px;
  		z-index: 999999;
  		cursor: pointer;
  		border: 3px solid white;
  		transition: .5s;
  	}
</style>

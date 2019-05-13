<?php $postArray = array(); ?>
<?php $allArray = array(); ?>

<?php
/*
*	Get all cards
*
*/
 $allPostsArray = array();


 if(empty($search_results)){

	// 1. get all post with address to show on map

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
	}
 }

 ?>

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
							'tax_query' 				=>
								array(
				        			array (
				            		'taxonomy' 	=> 'category',
				            		'field' 				=> 'slug',
				            		'terms'	 			=> $value->slug,
				        				)
			    					),
							); ?>

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
									$object->cat = $value->slug;
									array_push($postArray[$value->slug], $object);
									array_push($allArray, $object);
								} ?>

							<?php endwhile; ?>

						<?php wp_reset_query(); ?>
								<!------->
				<?php endforeach ?>

			</div><!-- List categories -->

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
		* 		Get the cards and Place them on the map
		*
		*
		*/

		window.singlePosts = <?php echo json_encode($allPostsArray)?>;
		//console.log(singlePosts);

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

			//get coordinates
			axios.get('https://nominatim.openstreetmap.org/search?q=' + address + ',+' + city + '&format=json').then(result => {
				var long = result.data[0].lon;
				var lat = result.data[0].lat;

				//place markers
				marker = L.marker([lat, long], {icon: myIcon} ).addTo(mymap).bindPopup('<h6>' + title + '</h6><p>' + excerpt + '</p><p><a href="' + link + '">read more</a></p>').on('click', centerMarker);
				//mymap.setView({lon: long, lat: lat} ,12);
			});
		}


		var posts = <?php echo json_encode($postArray)?>;
		var allPosts = <?php echo json_encode($allArray)?>;

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





					 //console.log('please');
					 // console.log(please);
					 // jQuery(please).html('ja');

					 jQuery(selected).attr('data-distance', shortByDistance);
				});
			})



		}


	window.afterLocationFound = function(data){
		//console.log(data+'this');
		var currentLocation = SmartaKartan.value;
		//console.log(currentLocation);
		window.writeDistanceOnCard(currentLocation);
	};






	mymap.locate();

	//drop markers on map
	function dropMarkers(e){
		var slug = e.currentTarget.dataset.slug;
		var layers = Object.entries(mymap._layers);

		//get post item data for map render on hover
	//	if(slug === 'post'){

		//var address = e.currentTarget.dataset.address;
		//var city = e.currentTarget.dataset.city;

		// if(address !='not-set' || city != 'not-set'){

		// 	var title = e.currentTarget.dataset.title;

		// 	var excerpt = e.currentTarget.dataset.excerpt;
		// 	var link = e.currentTarget.dataset.link;
		// 	var icon = { fillColor: 'yellow', fillOpacity: 1, radius: 10 };

		// 	var myIcon = L.icon({
		// 	    iconUrl: ' <?php bloginfo('template_url'); ?>/dist/images/marker_01.png',
		// 	    iconSize: [38, 38],
		// 	    //iconAnchor: [22, 94],
		// 	    popupAnchor: [0, -6],
		// 	    //shadowUrl: '/smartakartan/dist/images/marker_01.png',
		// 	    // shadowSize: [68, 95],
		// 	    // shadowAnchor: [22, 94]
		// 	});


		// 	if (marker != undefined) {
		// 		if(marker.options.fillColor === 'yellow'){
		// 			mymap.removeLayer(marker);
		// 		}
		// 	};

		// 	//get coordinates
		// 	axios.get('https://nominatim.openstreetmap.org/search?q=' + address + ',+' + city + '&format=json').then(result => {
		// 		var long = result.data[0].lon;
		// 		var lat = result.data[0].lat;

		// 		//place markers
		// 		marker = L.marker([lat, long], {icon: myIcon} ).addTo(mymap).bindPopup('<h6>' + title + '</h6><p>' + excerpt + '</p><p><a href="' + link + '">read more</a></p>').on('click', centerMarker);
		// 		//mymap.setView({lon: long, lat: lat} ,12);
		// 	});

		// }	// endif - address and city data found
//	} // if slug == post
//	else{
		//categories
		if(slug === 'all'){
			//for all categories
			var array = allPosts;

			layers.map(function(layer){
				if(layer[1] && layer[1].options && layer[1].options.fillColor){
					mymap.removeLayer(layer[1]);
				}
			})

		}else{

			//for single category
			var singleCategory = posts[slug];
			layers.map(function(layer){
				if(layer[1] && layer[1].options && layer[1].options.fillColor){
					mymap.removeLayer(layer[1]);
				}
			})
		}

		singleCategory.map(function(post){
			axios.get('https://nominatim.openstreetmap.org/search?q=' + post.street + ',+' + post.city + '&format=json').then(result => {
				//color scheme for categories
					switch (post.cat) {
						case 'kunskap':
							icon = { fillColor: 'red', fillOpacity: 1, radius: 10 };
							break;
						case 'mat':
							icon = { fillColor: 'green', fillOpacity: 1, radius: 10 };
							break;
						case 'moten':
							icon = { fillColor: 'blue', fillOpacity: 1, radius: 10 };
							break;
						case 'saker':
							icon = { fillColor: 'orange', fillOpacity: 1, radius: 10 };
							break;
						case 'transport':
							icon = { fillColor: 'purple', fillOpacity: 1, radius: 10 };
							break;
						case 'yta':
							icon = { fillColor: 'pink', fillOpacity: 1, radius: 10 };
						}

						var long = result.data[0].lon;
						var lat = result.data[0].lat;
						//place markers
						marker = L.circleMarker([lat, long], icon ).addTo(mymap).bindPopup('<h6>' + post.title + '</h6><h6>'+post.street +'</h6><p>' + post.excerpt + '</p><p><a href="' + post.link + '">read more</a></p>').on('click', centerMarker);
			}); //axios
		}) // single Categoryes
//		} //else
	}


		//drop markers On Page load
		// function dropMarkersNow(ini){

		// 	var slug = jQuery(ini).attr('data-slug');

		// 	 var layers = Object.entries(mymap._layers);

		// 	//get post item data for map render on hover
		// 	if(slug === 'post'){

		// 		var address = jQuery(ini).attr('data-address');
		// 	 	var city = jQuery(ini).attr('data-city');

		// 		if(address !='not-set' || city != 'not-set'){

		// 		 	var title = jQuery(ini).attr('data-title');
		// 		 	var excerpt = jQuery(ini).attr('data-excerpt');
		// 		 	var link = jQuery(ini).attr('data-link');
		// 			var icon = { fillColor: 'yellow', fillOpacity: 1, radius: 10 };
		// 			var myIcon = L.icon({
		// 			    iconUrl: ' <?php // bloginfo('template_url'); ?>/dist/images/marker_01.png',
		// 			    iconSize: [38, 38],
		// 			    popupAnchor: [0, -6],
		// 	 		});

		// 			if (marker != undefined) {
		// 				if(marker.options.fillColor === 'yellow'){
		// 					mymap.removeLayer(marker);
		// 				}
		// 			};

		// 			//get coordinates
		// 			axios.get('https://nominatim.openstreetmap.org/search?q=' + address + ',+' + city + '&format=json').then(result => {

		// 				var long = result.data[0].lon;
		// 				var lat = result.data[0].lat;

		// 				//place markers
		// 				marker = L.marker([lat, long], {icon: myIcon} ).addTo(mymap).bindPopup('<h6>' + title + '</h6><p>' + excerpt + '</p><p><a href="' + link + '">read more</a></p>').on('click', centerMarker);
		// 				//mymap.setView({lon: long, lat: lat} ,12);
		// 			});

		// 		}	// endif - address and city data found
		// 	 }
		// } //INSTANT


		//center map on marker click
		function centerMarker(e) {
			//mymap.setView(e.target.getLatLng(),11);
		}


		var categories = document.querySelectorAll('.map-cat');

		//add listener for categories
		for (var i = 0; i < categories.length; i++) {
			categories[i].addEventListener('click', dropMarkers)
		}

		//add listener for post
		// for (var i = 0; i < singlePosts.length; i++) {
		// 	singlePosts[i].addEventListener('mouseover', dropMarkers)
		// }

		// Drop markers on Page load
		// var initiativ = jQuery('.test-posts');
		// 	for (var i = 0; i < initiativ.length; i++) {
		// 		dropMarkersNow(initiativ[i]);
		// 	}


	//} // func yes



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
</style>

<?php get_header(); ?>

<?php	$categories = get_terms(
		array(
			'taxonomy' => 'category',
			'hide_empty' => false,
			 'parent'   => 0,
			 'exclude' => array(1, 227)
		));
?>

<?php $postArray = array(); ?>
<?php $allArray = array(); ?>

<div class="container-fluid">

	<div class="row">

		<div class="col-6">
			<!---set up marker groups--->
			<p class="category" data-slug="all"><?php pll_e( 'alla');?> </p>

			testing

			<?php foreach ($categories as $key => $value): ?>

					<p class="category" data-slug="<?php echo $value->slug; ?>"><?php echo $value->name; ?></p>

						<?php $args = array(
								'post_type' => 'post',
								'posts_per_page' => -1,
								'order' => 'DESC',
								'tax_query' => array(
			        			array (
			            		'taxonomy' => 'category',
			            		'field' => 'slug',
			            		'terms' => $value->slug,
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
											array_push($allArray, $object); }?>

								<?php endwhile; ?>
							<?php wp_reset_query(); ?>
							<!------->

			<?php endforeach ?>

		</div>

		<div class="col-6">

			<?php $args = array(
					'post_type' => 'post',
					'posts_per_page' => -1,
					'order' => 'DESC',
					); ?>

				<?php  $query = new WP_Query( $args );?>

					<?php while ( $query->have_posts() ) : $query->the_post(); ?>

						<?php if(get_field('street_address') && get_field('city')){ ?>
							<p class="test-posts" data-address="<?php echo get_field('street_address'); ?>" data-city="<?php echo get_field('city'); ?>" data-title="<?php the_title(); ?>" data-link="<?php the_permalink(); ?>" data-excerpt="<?php the_excerpt(); ?>" data-slug="post"><?php the_title(); ?></p>
						<?php }?>

					<?php endwhile; ?>

				<?php wp_reset_query(); ?>

		</div>
	</div>
</div>

<div class="map-wrapper">
	<div id="mapid2" style="width: 100%; height: 450px;"></div>
	<a href="http://localhost:8888/smartakartan/user-submit/"><div class="add-post"></div></a>
</div>

<script>

	var categories = document.querySelectorAll('.category');
	var singlePosts = document.querySelectorAll('.test-posts');
	var posts = <?php echo json_encode($postArray)?>;
	var allPosts = <?php echo json_encode($allArray)?>;
	var marker;


	//set initial map
	var mymap = L.map('mapid2').setView([57.7030712, 11.9590075], 12);
	//map tiles
	L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ',
		id: 'mapbox.streets'
	}).addTo(mymap);

	//track user location
	mymap.on('locationfound', function(e){
		//do something if we need
		console.log(e.latlng);
	});

	mymap.locate();

	//drop markers on map
	function dropMarkers(e){
		var slug = e.currentTarget.dataset.slug;
		var layers = Object.entries(mymap._layers);

		//for post item
		if(slug === 'post'){
			var address = e.currentTarget.dataset.address;
			var city = e.currentTarget.dataset.city;
	    	var title = e.currentTarget.dataset.title;
			var excerpt = e.currentTarget.dataset.excerpt;
			var link = e.currentTarget.dataset.link;
			var icon = { fillColor: 'yellow', fillOpacity: 1, radius: 200 };

		if (marker != undefined) {
					if(marker.options.fillColor === 'yellow'){
						mymap.removeLayer(marker);
					}
        };

		//get coordinates
		axios.get('https://nominatim.openstreetmap.org/search?q=' + address + ',+' + city + '&format=json').then(result => {
			var long = result.data[0].lon;
			var lat = result.data[0].lat;
			//place markers
			marker = L.circle([lat, long], icon ).addTo(mymap).bindPopup('<h6>' + title + '</h6><p>' + excerpt + '</p><p><a href="' + link + '">read more</a></p>').on('click', centerMarker);
			mymap.setView({lon: long, lat: lat} ,12);
		});
	}else{
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
			var array = posts[slug];

			layers.map(function(layer){
				if(layer[1] && layer[1].options && layer[1].options.fillColor){
					mymap.removeLayer(layer[1]);
				}
			})
		}

		array.map(function(post){
			axios.get('https://nominatim.openstreetmap.org/search?q=' + post.street + ',+' + post.city + '&format=json').then(result => {
				//color scheme for categories
					switch (post.cat) {
						case 'kunskap':
							icon = { fillColor: 'red', fillOpacity: 1, radius: 200 };
							break;
						case 'mat':
							icon = { fillColor: 'green', fillOpacity: 1, radius: 200 };
							break;
						case 'moten':
							icon = { fillColor: 'blue', fillOpacity: 1, radius: 200 };
							break;
						case 'saker':
							icon = { fillColor: 'orange', fillOpacity: 1, radius: 200 };
							break;
						case 'transport':
							icon = { fillColor: 'purple', fillOpacity: 1, radius: 200 };
							break;
						case 'yta':
							icon = { fillColor: 'pink', fillOpacity: 1, radius: 200 };
						}

						var long = result.data[0].lon;
						var lat = result.data[0].lat;
						//place markers
						marker = L.circle([lat, long], icon ).addTo(mymap).bindPopup('<h6>' + post.title + '</h6><p>' + post.excerpt + '</p><p><a href="' + post.link + '">read more</a></p>').on('click', centerMarker);
			});
		})
	}
}

//center map on marker click
function centerMarker(e) {
	mymap.setView(e.target.getLatLng(),12);
}

//add listener for categories
for (var i = 0; i < categories.length; i++) {
	categories[i].addEventListener('click', dropMarkers)
}
//add listener for post
for (var i = 0; i < singlePosts.length; i++) {
	singlePosts[i].addEventListener('click', dropMarkers)
}

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

<?php get_footer(); ?>

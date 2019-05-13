
<?php get_header(); ?>
<?php
/*
*	Get all cards
*
*/
	
				//var_dump($wp_query->posts); 


 $allPostsArray = array(); ?>

<?php
// 1. get all post with address to show on map

$allPosts = $wp_query->posts;


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



 ?>

<div class="map-container">
		<!-- Show the map -->
	<div class="map-wrapper">

		<!-- map container -->
		<div id="mapid2" class="leaflet-map" style=""></div>



	</div>
</div>
<script type="text/javascript">
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

		singlePosts = <?php echo json_encode($allPostsArray)?>;
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
		
				//track user location
		mymap.on('locationfound', function(e){

			console.log('location found');

			var current = e.latlng;
			
			

			// render my location on the map
			var marker = L.marker([current.lat, current.lng]).addTo(mymap).bindPopup('<h6>This is me</h6>').on('click', centerMarker);

			mymap.setView({lon: current.lng, lat: current.lat} ,12);

			var icon = { fillColor: 'blue', fillOpacity: 1, radius: 15 };

			Object.entries(window.singlePosts).map(function(post){

			axios.get('https://nominatim.openstreetmap.org/search?q=' + post[1][0].street + ',+' + post[1][0].city + '&format=json').then(result => {

				var shortByDistance = Math.round(current.distanceTo([result.data[0].lat, result.data[0].lon]) );

				var locationsting = result.data[0].display_name;
				var match = locationsting.split(', ');



				if(current.distanceTo([result.data[0].lat, result.data[0].lon]) < 1000)
					{
						var distance = Math.round(current.distanceTo([result.data[0].lat, result.data[0].lon])) + ' m';
					}else{
						var distance = current.distanceTo([result.data[0].lat, result.data[0].lon]) / 1000;
						distance = Math.round( distance * 10 ) / 10 + ' km';
					}


					 var selector = post[1][0].postid;

					 var selected = '#post-'+selector;

					 var article = jQuery('.grid').find(selected);

					 jQuery(article).find('.distance').addClass('s'+selector);
					 jQuery(article).find('.s'+selector).html(distance);

					 if (jQuery(article).find('.area-online')) {
					 	 jQuery(article).find('.area-online').html(match[2]);
					 }


					 jQuery(selected).attr('data-distance', shortByDistance);
				});
			})		








	});









	mymap.locate();

		

		
	}) // document ready
</script>




	<div class="container-fluid search-results">

		<div class="row">

			<div class="col-12">

				<h2><?php pll_e( 'Sökresultat för');?> "<?php echo esc_html( get_search_query( false ) ); ?>"</h2>
			</div>

		</div>
	
		<?php $postsArray = array(); ?>
		<?php if ( have_posts() ) : ?>
			
			<div class="row ">		
				
			<div class="col-12">
				
				<h3>Collections</h3>
				
			</div>
			
	        <?php while ( have_posts() ) : the_post(); ?>
	        	
	        		<?php $the_id = get_the_ID(); ?>
	        		
	        		<?php if (get_field('collection_of_posts')): ?>
	        									
	        		<?php $img = get_the_post_thumbnail_url($the_id,'medium'); ?>

						<div class="col-md-3">

							<div class="card card-shop">
								
								<div class="card-image card-img-top" style="background-image: url('<?php echo get_the_post_thumbnail_url($the_id); ?>'); height: 200px">
									<span class="card-distance distance"></span>
								</div>
								
							  <div class="card-body">
							  	
							   <h5 class="card-title"><br><?php echo get_the_title($the_id); ?></h5>
							   
								<div class="entry-content">
									
									<p><?php the_field('underrubrik', $the_id); ?></p>
									
							 		<div class="buttons">
											<a href="<?php the_permalink(); ?>">läs mer -></a>
									</div>
									
								</div><!-- .entry-content -->
								
							 </div><!--  .card-body -->
		
							</div>	
							
						</div>
						
	        		<?php	endif;  ?>
	        			
	        <?php endwhile; ?>


			 	<!-- print initiativer -->

				<div class="col-12">
					<h3>Initiativer (<?php global $wp_query; echo $wp_query->found_posts; ?>)</h3>
				</div>

	        <?php while ( have_posts() ) : the_post(); ?>
	        	
	        		<?php $the_id = get_the_ID(); ?>
	        		<?php $type =  get_post_type($the_id ); ?>
	        		
	        		<?php if (!get_field('collection_of_posts') && $type == 'post'): ?>
	        									
	        		<?php $img = get_the_post_thumbnail_url($the_id,'full'); ?>

						<div class="col-md-3">

							<div class="card card-shop">
								
								<div class="card-image card-img-top" style="background-image: url('<?php echo get_the_post_thumbnail_url($the_id); ?>'); height: 200px">
									<span class="card-distance distance"></span>
								</div>
								
							  <div class="card-body">
							   <h5 class="card-title"><br><?php echo get_the_title($the_id); ?></h5>
								<div class="entry-content">
									<p><?php the_field('underrubrik', $the_id); ?></p>
							 		<div class="buttons">
											<a href="<?php the_permalink(); ?>">läs mer -></a>
									</div>
								</div><!-- .entry-content -->
							 </div><!--  .card-body -->
		
							</div>	
							
						</div>
						
	        		<?php	endif;  ?>
	        			
	        <?php endwhile; ?>

			</div>        
        
    <?php endif; ?>

	</div>

<?php get_footer(); ?>

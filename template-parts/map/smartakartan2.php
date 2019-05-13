<?php $postArray = array(); ?>
<?php $allArray = array(); ?>
<?php $homeUrl = get_home_url() ?>
<?php

$base_lat = 57.7030712;
$base_long = 11.9590075;

if(get_field('base_lat', 'options')){
  $base_lat = get_field('base_lat', 'options');
}
if(get_field('base_long', 'options')){
  $base_long = get_field('base_long', 'options');
}
?>

<?php
/*
*	Get all cards
*
*/

 $allPostsArray = array();

 if(is_category()){

   if ( have_posts() ) {
	    while ( have_posts() ) {
		      the_post();
          $id = get_the_ID();
    			$street_address = get_field('street_address');
    			$city = get_field('city');

    			if(strlen($street_address) != 0 || strlen($city) != 0 ){
    				$allPostsArray[$id] = array();
            $object = new stdClass();
            $object->postid = $id;
    				$object->title = get_the_title();
            $object->excerpt = get_field('underrubrik');
    				$object->link = get_the_permalink();
            $object->img = get_the_post_thumbnail_url();
            $object->street = get_field('street_address');
    				$object->city = get_field('city');
            $object->coordinates = get_field('coordinates');
            $object->multiple = $multiple;
            //$object->open = $status;

            $taxonomies = get_the_terms( $id, 'top_taxonomy' );
            if($taxonomies[0]){
              $object->trans = $taxonomies[0]->slug;
            };

            $category = get_the_category($id);
            $object->cat_name = $category[0]->name;
            $object->sub_cat_id = $category[0]->term_id;
            $object->sub_cat_name = $category[0]->name;

            if($category[0]->parent == 0){
              $background = get_field('category_background_color', 'category_'.$category[0]->term_id);
              $icon = get_field('category_icon', 'category_'.$category[0]->term_id);
              $object->cat_id = $category[0]->term_id;
              $object->cat_slug = $category[0]->slug;

            }else{
              $background = get_field('category_background_color', 'category_'.$category[0]->parent);
              $icon = get_field('category_icon', 'category_'.$category[0]->term_id);
              $parent = get_term( $category[0]->parent, 'category' );

              $object->cat_id = $parent->term_id;
              $object->cat_slug = $parent->slug;
              $object->cat_name = $parent->name;
            }
            $object->color = $background;
            $object->icon = $icon;

            $object->lon = get_field('post_lon', $id);
            $object->lat = get_field('post_lat', $id);
            $object->display_name = get_field('post_display_name', $id);

    				array_push($allPostsArray[$id], $object);
    			}
	       }
       }

 }elseif(empty($search_results)){

	// 1. get ALL POSTS with address to show on map
$currentLanguage = pll_current_language();

	$postArgs = array(
		'numberposts' => -1,
		'post_type' => 'post',
		'lang' => $currentLanguage,
	);
	$allPosts = get_posts($postArgs);

	foreach ($allPosts as $key => $value) {
			$id = $value->ID;
      $cat_args = array(
        'orderby' => 'name',
        'order' => 'ASC',
        'fields' => 'all',
        'parent' => 0,
        'hide_empty' => true,
      );
			$street_address = get_field('street_address', $id);
      $multiple = get_field('multiple', $id);
			$city = get_field('city', $id);
      $coordinates = get_field('coordinates', $id);

			if(
        strlen($multiple) > 0 || (strlen($street_address) > 0 &&
        strlen($city) > 0 ) || strlen($coordinates) > 0
      ){
				$allPostsArray[$id] = array();

        $time = (date('H') + 1);
        $day = date("l");
        $field = strtolower($day);
        $value = get_field($field, $id);


        if(empty($value)){
          $status = 'no info';
        }elseif($value == 'closed'){
          $status = 'closed';
        }else{
          $hours = explode('-', $value);
          if($hours[0] < $time && $hours[1] > $time){
            $status = 'open';
          }else{
            $status = 'closed';
          }
        }

				$object = new stdClass();
        $object->postid = $id;
				$object->title = get_the_title($id);
        $object->excerpt = get_field('underrubrik', $id);
				$object->link = get_the_permalink($id);
        $object->img = get_the_post_thumbnail_url( $id );
        $object->street = get_field('street_address', $id);
				$object->city = get_field('city', $id);
        $object->coordinates = get_field('coordinates', $id);
        $object->multiple = $multiple;
        $object->open = $status;
        if(get_field('allways_open', $id)){
          $object->open = 'open';
        }

        $taxonomies = get_the_terms( $id, 'top_taxonomy' );
        if($taxonomies[0]){
          $object->trans = $taxonomies[0]->slug;
        };

        $category = get_the_category($id);
        $object->cat_name = $category[0]->name;
        $object->sub_cat_id = $category[0]->term_id;
        $object->sub_cat_name = $category[0]->name;

        if($category[0]->parent == 0){
          $background = get_field('category_background_color', 'category_'.$category[0]->term_id);
          $icon = get_field('category_icon', 'category_'.$category[0]->term_id);
          $object->cat_id = $category[0]->term_id;
          $object->cat_slug = $category[0]->slug;

        }else{
          $background = get_field('category_background_color', 'category_'.$category[0]->parent);
          $icon = get_field('category_icon', 'category_'.$category[0]->term_id);
          $parent = get_term( $category[0]->parent, 'category' );

          $object->cat_id = $parent->term_id;
          $object->cat_slug = $parent->slug;
          $object->cat_name = $parent->name;
        }
        $object->color = $background;
        $object->icon = $icon;
        $object->lon = get_field('post_lon', $id);
        $object->lat = get_field('post_lat', $id);
        $object->display_name = get_field('post_display_name', $id);

				array_push($allPostsArray[$id], $object);
			}
	}

	// 2. get ALL EVENTS with address to show on map

	$eventsArgs = array(
		'numberposts' => -1,
		'post_type' => 'calender_post_type',
		'lang' => $currentLanguage,
	);
	$allEvents = get_posts($eventsArgs);

	foreach ($allEvents as $key => $value) {
			$id = $value->ID;

			$street_address = get_field('street_address', $id);
			$city = get_field('city', $id);
      $coordinates = get_field('coordinates', $id);
			$eventDate = get_field('startdate_t', $id);
			$now = date('Ymd');

			if ($eventDate - $now >= 0) {
				if(strlen($street_address) != 0 || strlen($city) != 0 ){
					$allPostsArray[$id] = array();
					$object = new stdClass();
					$object->evTitle = get_the_title($id);
          $object->title = get_the_title($id);
					$object->postid = $id;
					$object->street = get_field('street_address', $id);
					$object->city = get_field('city', $id);
					$object->evLink = get_the_permalink($id);
          $object->link = get_the_permalink($id);
					$object->start = get_field('startdate_t', $id);
					$object->startTime = get_field('start_time', $id);
					$object->end = get_field('enddate', $id);
          $object->cat_id = 'event';
          $object->cat_name = 'Event';
          $object->sub_cat_name = 'Event';
          $object->img = get_the_post_thumbnail_url( $id );

          $object->lon = get_field('post_lon', $id);
          $object->lat = get_field('post_lat', $id);
          $object->display_name = get_field('post_display_name', $id);

          $object->icon = get_field('event_icon', 'options');

					array_push($allPostsArray[$id], $object);
				}
			}
	}

 }else{
 		foreach ($search_results as $key => $value) {
			$id = $value;
			$street_address = get_field('street_address', $id);
			$city = get_field('city', $id);
      $multiple = get_field('multiple', $id);

			if(strlen($street_address) != 0 || strlen($city) != 0 ){

        $time = (date('H') + 1);
        $day = date("l");
        $field = strtolower($day);
        $value = get_field($field, $id);

        if(empty($value)){
          $status = 'no info';
        }elseif($value == 'closed'){
          $status = 'closed';
        }else{
          $hours = explode('-', $value);
          if($hours[0] < $time && $hours[1] > $time){
            $status = 'open';
          }else{
            $status = 'closed';
          }
        }

				$allPostsArray[$id] = array();
        $object = new stdClass();
        $object->postid = $id;
				$object->title = get_the_title($id);
        $object->excerpt = get_field('underrubrik', $id);
				$object->link = get_the_permalink($id);
        $object->img = get_the_post_thumbnail_url( $id );
        $object->street = get_field('street_address', $id);
				$object->city = get_field('city', $id);
        $object->coordinates = get_field('coordinates', $id);
        $object->multiple = $multiple;
        $object->open = $status;

        $taxonomies = get_the_terms( $id, 'top_taxonomy' );
        if($taxonomies[0]){
          $object->trans = $taxonomies[0]->slug;
        };

        $category = get_the_category($id);
        $object->cat_name = $category[0]->name;
        $object->sub_cat_id = $category[0]->term_id;
        $object->sub_cat_name = $category[0]->name;

        if($category[0]->parent == 0){
          $background = get_field('category_background_color', 'category_'.$category[0]->term_id);
          $icon = get_field('category_icon', 'category_'.$category[0]->term_id);
          $object->cat_id = $category[0]->term_id;
          $object->cat_slug = $category[0]->slug;

        }else{
          $background = get_field('category_background_color', 'category_'.$category[0]->parent);
          $icon = get_field('category_icon', 'category_'.$category[0]->term_id);
          $parent = get_term( $category[0]->parent, 'category' );

          $object->cat_id = $parent->term_id;
          $object->cat_slug = $parent->slug;
          $object->cat_name = $parent->name;
        }
        $object->color = $background;
        $object->icon = $icon;

        $object->lon = get_field('post_lon', $id);
        $object->lat = get_field('post_lat', $id);
        $object->display_name = get_field('post_display_name', $id);

				array_push($allPostsArray[$id], $object);
			}
	}}

  ?>

<div class="map-container">
	<!-- Show the map -->
	<div class="map-wrapper">
    <div id="mini-mobile">X</div>
		<!-- map container -->
		<div id="mapid2" class="leaflet-map" style=""></div>
    <div id="center-on-me" class="">
      <img src="<?php echo get_template_directory_uri();?>/assets/images/locate.svg" alt="locate on me icon">
    </div>
    <div id="expand-mobile" class="">
    	<i class="fa fa-expand"></i>
    </div>
    <div id="expand-desktop" class="">
    	 	<i class="fa fa-expand expand"></i>
        <i class="fa fa-compress compress" style="display: none;"></i>
    </div>
		<a href="<?php echo get_bloginfo('url') ?>/lagg-till-verksamhet-guest/" aria-label="Add initiative">
			<div class="add-post ">
				<i class="fa fa-plus"></i>
			</div>
		</a>
	</div>
  <div id="popup-wrapper">
  </div>
</div>

<script>
window.singlePosts = <?php echo json_encode($allPostsArray)?>;
</script>

<style>
    img.selected-icon{
      z-index: 200 !important;
    }
</style>

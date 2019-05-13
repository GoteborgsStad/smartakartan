<?php

class postHandler{

	var $numberOfResults;

	/**
	 *
	 * countAll()
	 *	 Counts All Post types
	 *
	 * @return int
	 */


	public function countAll(){

		$allPosts = $this->getAllPostsID();
		$numberOfAllPosts = count($allPosts);
		$numbOfPostOnLoad = 20;
		$numberOfChunks = $numberOfAllPosts / $numbOfPostOnLoad;
		return $numberOfChunks;

	}


	/**
	 *
	 * isOpen()
	 *	 Checks if Initiatives are open
	 * If open, writes meta data: "is_open_now" true/false for posts
	 *
	 * @return viod
	 */


	public function isOpen(){

      $onlinePosts = get_posts(array(
         'fields'                     => 'ids',
         'post_type'              => 'post',
         'posts_per_page'   => -1,
         'post_status'          => 'publish'
      ));

       $hour_now = date("H");
       $day = date("l");
       $today = strtolower($day);
       $field_to_check = $today;

       foreach($onlinePosts as $nr => $id){

          $is_open_today = get_field($field_to_check, $id);

          if(!get_field('allways_open', $id)){

		          if (!empty($is_open_today )) {

		           if ($is_open_today != 'closed' AND strlen($is_open_today) < 6){

		              list($from, $to) = explode('-', $is_open_today);
		                  if( ($from <= $hour_now) && ($hour_now <= $to) ){
		                     //update_field('is_open_now', 1, $id);
		                     update_post_meta( $id, 'is_open_now', 1 );
		                  }
		              }

                  if($is_open_today === 'closed' ){
                  	update_post_meta( $id, 'is_open_now', 0 );
                     //update_field('is_open_now', 0, $id);
                  }
		          }else{
		             update_post_meta( $id, 'is_open_now', 0 );
		          }

          }




        } //foreach

	}








	/**
	 *
	 * getAll
	 *
	 *
	 *
	 * @return array - chunks of integers of post IDs
	 */

	public function getAll(){
		$allPosts = $this->getAllPostsID();

		$allCollections = $this->getAllCollectionsID();
		$allStories = $this->getAllStoriesID();

		$allItems = array_merge($allPosts, $allCollections, $allStories);

		$items_by_date = array();

		foreach ($allItems as $key => $value) {
			$date = get_the_date('Ymd', $value);
			$items_by_date[$date] = $value;
		}

		krsort($items_by_date);



		//shuffle($allItems);
		$numbOfPostOnLoad = 20;
        $chunks = array_chunk($items_by_date, $numbOfPostOnLoad, true);
		return $chunks;
	}

	/**
	 *
	 * getStories
	 *
	 *
	 *
	 * @return array - chunks of integers of post_type: stories IDs
	 */

	public function getStories(){

		$allStories = $this->getAllStoriesID();
		$numbOfPostOnLoad = 1;
        $chunks = array_chunk($allStories, $numbOfPostOnLoad);
		return $allStories;
	}

	/**
	 *
	 * getBlogs
	 *
	 *
	 *
	 * @return array - chunks of integers of post_type: stories IDs
	 */

	public function getBlogs(){

		$allBlogs = $this->getAllBlogID();
		//$numbOfPostOnLoad = 1;
        //$chunks = array_chunk($allBlogs, $numbOfPostOnLoad);
		return $allBlogs;
	}


	/**
	 *
	 * getEvents()
	 *	 Get the Events datum
	 *
	 * @return int
	 */


	public function getEvents(){

		 $cal = get_posts( array(
			'post_type' => 'calender_post_type',
			'meta_key'   => 'startdate_t',
			'orderby'    => 'meta_value_num',
			'post_status' => 'publish',
			'order' => 'ASC',
			'posts_per_page'=>-1,
    		'numberposts'=>-1
		 ));


		 $events_list = array();
		 $i = 0;
		 foreach ($cal as $key => $value){

			 $event_id = $value->ID;
			 $event_name = get_the_title($event_id);
			 $the_day = get_field('startdate_t', $event_id );
			 $month = date("m", strtotime($the_day));
			 $day = date("d", strtotime($the_day));
			 $details = array();
			 $details['id'] = $event_id;
			 $details['m'] = $month;
			 $details['d'] = $day;
			 $details['name'] = $event_name ;
			  $events_list[$the_day][$i]  = $details;
			 $i++;

		 }

		 $data = [];

		foreach ($events_list as $key => $value) {
			$datums = [];
		 	$date = date("M", strtotime($key));
		 	if (!isset($data[$date])) {
		 		$data[$date] = [];
		 	}
		 	foreach ($value as $day) {
		 		$datum = $day['d'];
		 		if (in_array($datum, $datums)) {
		 			continue;
		 		}
		 		$theday = intval($day['d']);
		 		$theday = sprintf("%02d", $theday);
		 		array_push($data[$date], $theday);
		 		$datums[] = $datum;
		 		//$data[$date][] = [$day['d'] => $day['id']];
		 	}
		}

		 return $data;

	}



	/**
	 *
	 * getCollections
	 *
	 *
	 *
	 * @return array - chunks of integers of post_type: stories IDs
	 */

	// public function getCollections(){

	// 	$allStories = $this->getAllCollectionsID();
	// 	$numbOfPostOnLoad = 1;
 //        $chunks = array_chunk($allStories, $numbOfPostOnLoad);
	// 	return $chunks;
	// }


	/**
	 *
	 * getByCategory
	 *
	 *
 	 * @param int $categoryID
	 *
	 * @return array - chunks of integers of post_type: stories IDs
	 */

	public function getByCategory($categoryID){
		$allItems = $this->getPostsIDsByCategory($categoryID);
		$numbOfPostOnLoad = 10;
        $chunks = array_chunk($allItems, $numbOfPostOnLoad);
		return $chunks;
	}

	/**
	 *
	 * getByTransaction
	 *
	 *
 	 * @param int $categoryID
	 *
	 * @return array - chunks of integers of post_type: stories IDs
	 */

	public function getByTransaction($transactionID){
		$allItems = $this->getPostsIDsByTransaction($transactionID);
		$numbOfPostOnLoad = 10;
        $chunks = array_chunk($allItems, $numbOfPostOnLoad);
		return $chunks;
	}

	/**
	 *
	 * getFilteredByMultipleCat
	 *
	 *
 	 * @param int $categoryID
 	 * @param array of int $additionalCatIDs
	 *
	 * @return array $shortedItems - chunks of integers of post_type: stories IDs
	 */

	 public function getFilteredByMultipleCat($categoryID, $additionalCatIDs = array()){


	 	if ($additionalCatIDs[0] == 0) {
	  	$args = array(
			'post_type' => 'post',
			'fields'          => 'ids',
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => array( $categoryID ),
				),
			),
		);
	 	}else{
		 	$args = array(
				'post_type' => 'post',
				'fields'          => 'ids',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'category',
						'field'    => 'term_id',
						'terms'    => array( $categoryID ),
					),
					array(
						'taxonomy' => 'category',
						'field'    => 'term_id',
						'terms'    =>  $additionalCatIDs,// array(438, 446)
						'operator' => 'AND',
					),
				),
			);
	 	}


		$allPosts = new WP_Query( $args );

	 	$shortedItems = array();

		foreach ($allPosts->posts as $key => $value) {
			$title = get_the_title($value);
			$data = array($value, $title);
			array_push($shortedItems, $data);
		}

			// $numbOfPostOnLoad =6;
   //      	$shortedItems = array_chunk($shortedItems, $numbOfPostOnLoad);

		return $shortedItems;

	 }

	/**
	 *
	 * getFiltered
	 *
	 *
 	 * @param array $filters
	 *
	 * @return array $sortedItems - chunks of integers of post_type: stories IDs
	 */

	 public function getFiltered($allTypes = 'no', $filters = array(), $cat = 0, $search_results = array()){
	 	//$isOffline = null;
	 	//$offline_meta = '';
	 	$args_to_send = array();
	 	$isOpen = null;
	 	$open_meta = '';
	 	$order = 'DESC';
	 	$orderby = 'post_date';
	 	$tax = array();
	 	$meta_query = array();
	 	$post_in = array();
	 	$meta_key = '';

	 	if(!empty($search_results)){
	 		$post_in = $search_results;
	 	}


		$this->isOpen();


	 	if (count($filters[2]['transactions']) >= 1) {
	 		$multipleTransactions = array();
	 			foreach ($filters[2]['transactions'] as $key => $value) {
	 				array_push($multipleTransactions, $value);
	 			}
	 					 	$tax_transactions = array(
								'taxonomy' => 'top_taxonomy',
								'field'    => 'slug',
								'terms'    => $multipleTransactions,
								'operator' => 'IN'
		        );

	 		}

	 	if (count($filters[3]['cat']) >= 1) {
	 		$multipleCat = array();
	 			foreach ($filters[3]['cat'] as $key => $value) {
	 				array_push($multipleCat, $value);
	 			}
			 	$taxCat = array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => $multipleCat,
					'operator' => 'IN'
  		  		 );

	 		}

// Short By  FILTERS

	 	if ($filters[1]['sortBy'] == 'random') {
	 		$orderby = 'rand';
	 	} elseif ($filters[1]['sortBy'] == 'newest') {
	 		$orderby = 'post_date';
	 	} elseif ($filters[1]['sortBy'] == 'distance') {
			global $wpdb;

			$lat  = !empty($_POST['user_location']['lat']) ? $_POST['user_location']['lat'] : 0;
			$long = !empty($_POST['user_location']['long']) ? $_POST['user_location']['long'] : 0;

			$query = $wpdb->prepare(
			"SELECT DISTINCT    
			  initiative_latitude.post_id,
			  initiative_latitude.meta_key,
			  initiative_latitude.meta_value as initiativeLat,
			  initiative_longitude.meta_value as initiativeLong,
			  ((ACOS(SIN(%s * PI() / 180) * SIN(initiative_latitude.meta_value * PI() / 180) + COS(%s * PI() / 180) * COS(initiative_latitude.meta_value * PI() / 180) * COS((%s - initiative_longitude.meta_value) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS distance
			FROM 
			  wp_postmeta AS initiative_latitude
			  LEFT JOIN wp_postmeta as initiative_longitude ON initiative_latitude.post_id = initiative_longitude.post_id
			WHERE initiative_latitude.meta_key = 'post_lat' AND initiative_longitude.meta_key = 'post_lon'
			ORDER BY distance ASC;
			", $lat, $lat, $long);

			$posts = $wpdb->get_results($query, OBJECT);

			if (!empty($posts)) {
			  $postsWithCoordinates    = [];
			  $postsWithoutCoordinates = [];

			  foreach ($posts as $post) {
					if (empty($post->distance)) {
						$postsWithoutCoordinates[] = $post->post_id;
					} else {
						$postsWithCoordinates[] = $post->post_id;
					}
			  }

			  $postOrder = array_merge($postsWithCoordinates, $postsWithoutCoordinates);
			}

			$orderby = 'post__in';
			$post_in = $postOrder;
		}

		// IS OPEN --  FILTERS
	 	$meta_query_isOpen = array();
	 	if ($filters[4]['isOpen'] == 'open' ) {
		 	$meta_query_isOpen = array(
		            'key'          => 'is_open_now',
		            'value'        => 1,
		            'compare'      => '='
		        );
	 	}

	 	$meta_query = array(
	 		'relation' => 'AND',
	 		$meta_query_distance,
	 		$meta_query_isOpen
	 	);
		// ONLINE FILTERS

	 	// if($filters[0]['isOnline'] == 'online'){
	 	// 	$isOffline = 0;
	 	// }
	 	// if($filters[0]['isOnline'] == 'offline'){
	 	// 	$isOffline = 1;
	 	// }

	 	// om online offline är i fylld

	 	// if ($filters[0]['isOnline'] != 'on-and-off') {
		 // 	$meta_query[] =
			//         array(
			//             'key'          => 'offline',
			//              'value'        => $isOffline,
			//              'compare'      => '='
			//         );

	 	// }

	//var_dump($meta_query);

	if ($allTypes == 'yes') {
		$allPosts = $this->getAllPostsID();

		//$allCollections = $this->getAllCollectionsID();
		//$allStories = $this->getAllStoriesID();
		$allStories = $this->getStories();
		$blogs = $this->getBlogs();
		$allItems = array_merge($allPosts, $allStories, $blogs);  //$allCollections
		shuffle($allItems);
	}elseif ($allTypes == 'no') {

		$tax_query = array(
			'relation' => 'AND',
			$tax_transactions,
			$taxCat
		);

		$args_to_send = array(
			'fields'         => 'ids',
			'post_type'      => 'post',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'meta_query'     => $meta_query,
			'post__in'       => $post_in,
			'orderby'        => $orderby,
			'order'          => $order,
			'cat'            => $cat,
			'tax_query'      => $tax_query,
		);

	 	$allItems  = get_posts($args_to_send);
	}

		//return $allItems;

	 	$numberOfResults = count($allItems);
	 	$this->numberOfResults = $numberOfResults;

		$numbOfPostOnLoad = 12;
    $sortedItems = array_chunk($allItems, $numbOfPostOnLoad);

	 	//return array('results'=>$sortedItems, 'count' => $numberOfResults);
	 	return $sortedItems;
	  //return $blogs;

	 	//return $args_to_send;

	 }

	/**
	 *
	 * getAzShorted
	 *
	 * Sort post by Abc order
	 *
 	 * @param int $categoryID
	 *
	 * @return array $sortedItems - chunks of integers of post_type: stories IDs
	 */

	public function getAzShorted($categoryID = null){

		if (!$categoryID) {
			$allPosts = $this->getAllPostsID();
			$allCollections = $this->getAllCollectionsID();
			$allStories = $this->getAllStoriesID();
			$allItems = array_merge($allPosts, $allCollections, $allStories);
		}else{
			$allItems = $this->getPostsIDsByCategory($categoryID);
		}

		$sortedItems = array();
		$abc = array();
		foreach ($allItems as $key => $value) {
			$title = get_the_title($value);
			$data = array($value, $title);
			array_push($sortedItems, $data);
		}

		function azsort($a, $b) {
			  if ($a[1] == $b[1]) {
			    return 0;
			  }
			  return ($a[1] < $b[1]) ? -1 : 1;
		}

		usort($sortedItems, "azsort");

		$numbOfPostOnLoad = 5;
        $sortedItems = array_chunk($sortedItems, $numbOfPostOnLoad);

		return $sortedItems;
	}

	/**
	 *
	 * getPostsIDsByCategory
	 *
	 *
	 *
 	 * @param int $categoryID
	 *
	 * @return array $allPosts - chunks of integers of post_type: stories IDs
	 */

	public function getPostsIDsByCategory($categoryID){

				$allPosts = get_posts(array(
					'fields'          => 'ids',
				    'post_type' => 'post',
				    'posts_per_page'  => -1,
				  	'post_status' => 'publish',
				  	'taxonomy' => 'category',
				  	'category' => $categoryID,
				));

		return $allPosts;
	}

	/**
	 *
	 * getPostsIDsByTransaction
	 *
	 *
	 *
 	 * @param int $taxonomyID
	 *
	 * @return array $allPosts - chunks of integers of post_type: stories IDs
	 */

	public function getPostsIDsByTransaction($taxonomyID){

				$allPosts = get_posts(array(
					'fields'          => 'ids',
				    'post_type' => 'post',
				    'posts_per_page'  => -1,
				  	'post_status' => 'publish',
				  	'tax_query' => array(
						array(
							'taxonomy' => 'top_taxonomy',
							'field'    => 'ids',
							'terms'    => $taxonomyID,
						),
					)
				));

		return $allPosts;
	}

	/**
	 *
	 * getAllPostsID
	 *
	 *
	 *
 	 * @param int $categoryID
	 *
	 * @return array int $allPosts
	 */

	public function getAllPostsID(){

		$allPosts = get_posts(array(
					'fields'          => 'ids',
				    'post_type' => 'post',
				    'posts_per_page'  => -1,
				  	'post_status' => 'publish',
				  'orderby' => 'date',
				  'order' => 'DESC'
		));

		return $allPosts;
	}

	/**
	 *
	 * getAllCollectionsID
	 *
	 *
	 *
 	 *
	 *
	 * @return array int $allCollections
	 */
	public function getAllCollectionsID(){

		$allCollections = get_posts(array(
					'fields'          => 'ids',
				    'post_type' => 'page',
				    'posts_per_page'  => -1,
				  	'post_status' => 'publish',
				  	'meta_key' => '_wp_page_template',
        			'meta_value' => 'collection.php'
	        ));
		return $allCollections;
	}

	/**
	 *
	 * getAllStoriesID
	 *
	 * @return array int $allStories
	 */
	public function getAllStoriesID(){

		//$collections = $this->getAllCollectionsID();

		$allStories = get_posts(array(
						'fields'          => 'ids',
					    'post_type' => 'story',
					    'posts_per_page'  => -1,
					  	'post_status' => 'publish',
		        ));
			return $allStories;
	}

	/**
	 *
	 * getAllStoriesID
	 *
	 * @return array int $allStories
	 */
	public function getAllBlogID(){

		//$collections = $this->getAllCollectionsID();

		$allBlogs = get_posts(array(
						'fields'          => 'ids',
					    'post_type' => 'blogg',
					    'posts_per_page'  => -1,
					  	'post_status' => 'publish',
		        ));
			return $allBlogs;
	}


}


 ?>

<?php 
 
//first taxonomy
function register_new_taxonomy(){

	$labels = array(
		'name' => pll__('cpt-Transaktionstyper'),
		'singular_name'	=> pll__('Transaktionstyp')
	);

	$args = array(
		'hierarchical'			=> true,
		'labels'				=> $labels,
		'show_ui'				=> true,
		'show_admin_column'		=> true,
		'update_count_callback'	=> '_update_post_term_count',
		'query_var' 			=> true,
		'rewrite'				=> array('slug' => 'transaction')
	);

	register_taxonomy('top_taxonomy' , 'post', $args);
}

//first taxonomy
function register_event_taxonomy(){

	$labels = array(
		'name'	=> pll__('Eventcategories'),
		'singular_name'	=> pll__('Event category')
	);

	$args = array(
		'hierarchical'			=> true,
		'labels'				=> $labels,
		'show_ui'				=> true,
		'show_admin_column'		=> true,
		'update_count_callback'	=> '_update_post_term_count',
		'query_var' 			=> true,
		'rewrite'				=> array('slug' => 'eventcat')
	);

	register_taxonomy('event_cat' , 'calender_post_type', $args);
}



add_action( 'init', 'register_new_taxonomy' );
add_action( 'init', 'register_event_taxonomy' );

//second taxonomy
// function register_new_taxonomy_location(){

// 	$labels = array(
// 		'name'	=> 'Platser',
// 		'singular_name'	=> 'Plats'
// 	);

// 	$args = array(
// 		'hierarchical'			=> true,
// 		'labels'				=> $labels,
// 		'show_ui'				=> true,
// 		'show_admin_column'		=> true,
// 		'update_count_callback'	=> '_update_post_term_count',
// 		'query_var' 			=> true,
// 		'rewrite'				=> array('slug' => 'plats')
// 	);

// 	register_taxonomy('location_taxonomy' , 'post', $args);
// }
// add_action( 'init', 'register_new_taxonomy_location' );

//second taxonomy
// function register_new_taxonomy_blog(){

// 	$labels = array(
// 		'name'	=> 'Blog types',
// 		'singular_name'	=> 'Blog type'
// 	);

// 	$args = array(
// 		'hierarchical'			=> true,
// 		'labels'				=> $labels,
// 		'show_ui'				=> true,
// 		'show_admin_column'		=> true,
// 		'update_count_callback'	=> '_update_post_term_count',
// 		'query_var' 			=> true,
// 		'rewrite'				=> array('slug' => 'blog_type')
// 	);

// 	register_taxonomy('blog_taxonomy' , 'blogg', $args);
// }
// add_action( 'init', 'register_new_taxonomy_blog' );

<?php


add_action( 'init', 'cp_change_post_object' );
// Rename Posts to News
function cp_change_post_object() {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
        $labels->name = pll__('Verksamheter');
        $labels->singular_name = pll__('Verksamhet');
        $labels->add_new = pll__('Lägg till verksamhet');
        $labels->add_new_item = pll__('Lägg till verksamhet');
        $labels->edit_item = pll__('Redigera verksamhet');
        $labels->new_item = pll__('Verksamheter');
        $labels->view_item = pll__('Visa verksamhet');
        $labels->search_items = pll__('Sök verksamhet');
        $labels->not_found = pll__('Inga poster hittades');
        $labels->not_found_in_trash = pll__('Inga poster hittades i papperskorgen');
        $labels->all_items = pll__('Alla verksamheter');
        $labels->menu_name = pll__('Verksamheter');
        $labels->name_admin_bar = pll__('Verksamheter');
}


function create_posttype() {
	register_post_type( 'calender_post_type',
			array(
			'labels' => array(
				'name' => pll__('Event'),
				'singular_name' => pll__('Event')
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'event'),
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'show_in_nav_menus'   => true,
      'show_in_rest'  => true
		)
	);

	register_post_type( 'blogg',
			array(
			'labels' => array(
				'name' => pll__('Blog'),
				'singular_name' => pll__('Blog')
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'news'),
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'show_in_nav_menus'   => true
		)
	);
	register_post_type( 'story',
			array(
			'labels' => array(
				'name' => pll__( 'Stories' ),
				'singular_name' => pll__( 'Story' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'story'),
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'show_in_nav_menus'   => true
		)
	);
}
add_action( 'init', 'create_posttype' );

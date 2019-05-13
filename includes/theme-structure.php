<?php

function sk_page_setup(){


  $blogg_page_title = 'Blogg';
  $blogg_page_content = 'Sätt template Blogs...';
  $blogg_page_check = get_page_by_title($blogg_page_title);
  $blogg_page = array(
    'post_type' => 'page',
    'post_title' => $blogg_page_title,
    'post_content' => $blogg_page_content,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' => 'blogg',
    'meta_input' => [
        '_wp_page_template' => 'blogs.php'
    ]
  );

  if ($blogg_page_check === NULL) {
    $blogg_page_id = wp_insert_post($blogg_page);
  };

  $translate_page_title = 'Help us translate';
  $translate_page_content = 'Help us translate...';
  $translate_page_check = get_page_by_title($translate_page_title);
  $translate_page = array(
    'post_type' => 'page',
    'post_title' => $translate_page_title,
    'post_content' => $translate_page_content,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' => 'help-us-translate',
  );

  if ($translate_page_check === NULL) {
    $translate_page_id = wp_insert_post($translate_page);
  };

  $stories_page_title = 'Historier';
  $stories_page_content = 'sätt template Stories';
  $stories_page_check = get_page_by_title($stories_page_title);
  $stories_page = array(
    'post_type' => 'page',
    'post_title' => $stories_page_title,
    'post_content' => $stories_page_content,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' => 'historier',
    'meta_input' => [
        '_wp_page_template' => 'stories.php'
    ]
  );
  if ($stories_page_check === NULL) {
    $stories_page_id = wp_insert_post($stories_page);
  };

  $kollektioner_page_title = 'Höjdpunkter';
  $kollektioner_page_content = 'sätt template Collections';
  $kollektioner_page_check = get_page_by_title($kollektioner_page_title);
  $kollektioner_page = array(
    'post_type' => 'page',
    'post_title' => $kollektioner_page_title,
    'post_content' => $kollektioner_page_content,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' => 'kollektioner',
    'meta_input' => [
        '_wp_page_template' => 'collections.php'
    ]
  );
  if ($kollektioner_page_check === NULL) {
    $kollektioner_page_id = wp_insert_post($kollektioner_page);
  };

  $calender_page_title = 'Kalender';
  $calender_page_content = 'sätt template Calender';
  $calender_page_check = get_page_by_title($calender_page_title);
  $calender_page = array(
    'post_type' => 'page',
    'post_title' => $calender_page_title,
    'post_content' => $calender_page_content,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' => 'kalender',
    'meta_input' => [
        '_wp_page_template' => 'calender.php'
    ]
  );
  if ($calender_page_check === NULL) {
    $calender_page_id = wp_insert_post($calender_page);
  };

  $themap_page_title = 'Karta';
  $themap_page_content = 'sätt template Themap';
  $themap_page_check = get_page_by_title($themap_page_title);
  $themap_page = array(
    'post_type' => 'page',
    'post_title' => $themap_page_title,
    'post_content' => $themap_page_content,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' => 'karta',
    'meta_input' => [
        '_wp_page_template' => 'the_map.php'
    ]
  );
  if ($themap_page_check === NULL) {
    $themap_page_id = wp_insert_post($themap_page);
  };


  $om_oss_page_title = 'Om oss';
  $om_oss_page_content = 'Om oss ...';
  $om_oss_page_check = get_page_by_title($om_oss_page_title);
  $om_oss_page = array(
    'post_type' => 'page',
    'post_title' => $om_oss_page_title,
    'post_content' => $om_oss_page_content,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' => 'om_oss',
  );
  if ($om_oss_page_check === NULL) {
    $om_oss_page_id = wp_insert_post($om_oss_page);
  };

  $start_page_title = 'Start';
  $start_page_content = 'Välkommen till Smarta Kartan ...';
  $start_page_check = get_page_by_title($start_page_title);
  $start_page = array(
    'post_type' => 'page',
    'post_title' => $start_page_title,
    'post_content' => $start_page_content,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' => 'start',
  );
  if ($start_page_check === NULL) {
    $start_page_id = wp_insert_post($start_page);
  };
}

add_action('after_switch_theme', 'sk_page_setup');

//MENUES

//Primary menu
$menuname1 = 'Primary menu';
$sk_menulocation1 = 'primary Svenska';
// Does the menu exist already?
$menu_exists1 = wp_get_nav_menu_object( $menuname1 );
if( !$menu_exists1){
    $menu_id = wp_create_nav_menu($menuname1);
    // Set up default links and add them to the menu.
    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Kalender'),
        'menu-item-url' => home_url( '/kalender/' ),
        'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Karta'),
        'menu-item-url' => home_url( '/karta/' ),
        'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Historier'),
        'menu-item-url' => home_url( '/historier/' ),
        'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Blogg'),
        'menu-item-url' => home_url( '/blogg/' ),
        'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Om oss'),
        'menu-item-url' => home_url( '/om-oss/' ),
        'menu-item-status' => 'publish'));

    if( !has_nav_menu( $sk_menulocation1 ) ){
        $locations = get_theme_mod('nav_menu_locations');
        $locations[$sk_bpmenulocation1] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }
  }

  //Delta Menu
  $menuname2 = 'Mode Delta Menu';
  $sk_menulocation2 = 'More Delta Menu Svenska';
  // Does the menu exist already?
  $menu_exists2 = wp_get_nav_menu_object( $menuname2 );
  if( !$menu_exists2){
      $menu_id = wp_create_nav_menu($menuname2);
      // Set up default links and add them to the menu.
      wp_update_nav_menu_item($menu_id, 0, array(
          'menu-item-title' =>  __('Lägg till Event'),
          'menu-item-url' => home_url( '/lagg_till_event/' ),
          'menu-item-status' => 'publish'));

      wp_update_nav_menu_item($menu_id, 0, array(
          'menu-item-title' =>  __('Lägg till verkssamhet'),
          'menu-item-url' => home_url( '/lagg_till_verksamhet/' ),
          'menu-item-status' => 'publish'));

      if( !has_nav_menu( $sk_menulocation2 ) ){
          $locations = get_theme_mod('nav_menu_locations');
          $locations[$sk_bpmenulocation2] = $menu_id;
          set_theme_mod( 'nav_menu_locations', $locations );
      }
    }

    //Login Menu
    $menuname3 = 'Login';
    $sk_menulocation3 = 'More Delta Menu Svenska';
    // Does the menu exist already?
    $menu_exists3 = wp_get_nav_menu_object( $menuname3 );
    if( !$menu_exists3){
        $menu_id = wp_create_nav_menu($menuname3);

        if( !has_nav_menu( $sk_menulocation3 ) ){
            $locations = get_theme_mod('nav_menu_locations');
            $locations[$sk_bpmenulocation3] = $menu_id;
            set_theme_mod( 'nav_menu_locations', $locations );
        }
      }

      //Footer Menu
      $menuname4 = 'Footer meny';
      $sk_menulocation4 = 'Footer Menu Svenska';
      // Does the menu exist already?
      $menu_exists4 = wp_get_nav_menu_object( $menuname4 );
      if( !$menu_exists4){
          $menu_id = wp_create_nav_menu($menuname4);

          if( !has_nav_menu( $sk_menulocation4 ) ){
              $locations = get_theme_mod('nav_menu_locations');
              $locations[$sk_bpmenulocation4] = $menu_id;
              set_theme_mod( 'nav_menu_locations', $locations );
          }
        }

?>

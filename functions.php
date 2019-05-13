<?php

/*
show_admin_bar( false );
add_filter('show_admin_bar', '__return_false');
*/

function admin_bar(){
  if(is_user_logged_in()){
    add_filter( 'show_admin_bar', '__return_true' , 1000 );
  }
}

add_action('init', 'admin_bar' );

/**
 * Includes
 */

require_once( get_template_directory() . '/includes/post_types.php');
require_once( get_template_directory() . '/includes/taxonomies.php');
//require_once( get_template_directory() . '/includes/option_page.php');
require_once( get_template_directory() . '/includes/postHandler.php');
require_once( get_template_directory() . '/includes/is_open.php');
require_once( get_template_directory() . '/includes/ajax-load-more.php');
require_once( get_template_directory() . '/includes/filter-ajax.php');
require_once( get_template_directory() . '/includes/calendar-ajax.php');
require_once( get_template_directory() . '/includes/filter-az-ajax.php');
require_once( get_template_directory() . '/includes/advanced_custom_fields.php');
require_once( get_template_directory() . '/includes/dependencies_management.php');
require_once( get_template_directory() . '/includes/theme-structure.php');

// Plugins modification (actions & filters)
require_once( get_template_directory() . '/includes/plugins/wp-user-frontend/filters.php');

/**
 * Insert Calender Item Featured Imgae
 */

function Generate_Featured_Image( $image_url, $post_id  ){
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);
    $filename = basename($image_url);
    if(wp_mkdir_p($upload_dir['path']))     $file = $upload_dir['path'] . '/' . $filename;
    else                                    $file = $upload_dir['basedir'] . '/' . $filename;
    file_put_contents($file, $image_data);

    $wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
    $res2= set_post_thumbnail( $post_id, $attach_id );
}


/**
 * Enqueue styles
 */
function smartakartan_scipts() {
  wp_enqueue_style('smartakartan-common-styles', get_template_directory_uri().'/dist/all.css', array(), '1.0.0');
  wp_enqueue_style('extended', get_template_directory_uri().'/assets/css/extended.css', array(), '1.0.0');

  // wp_deregister_script('jquery');
  // wp_enqueue_script('smartakartan-common-scripts', get_template_directory_uri().'/dist/index.js', array(), '1.0.0', true);
}

add_action( 'wp_enqueue_scripts', 'smartakartan_scipts' );

/**
 * Enable support for Post Thumbnails on posts and pages
 *
 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
*/
add_theme_support( 'post-thumbnails' );


/**
 * Register widget
*/


register_sidebar(array(
    'name'=>'widget_01',
    'id' =>'widget_01',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => ''
));

/**
 * Enable ACF pro - options page
*/

if( function_exists('acf_add_options_page') ) {

  // Main Theme Settings Page
    //acf_add_options_page();

  $parent = acf_add_options_page( array(
    'page_title' => 'Theme General Settings',
    'menu_title' => 'Theme Settings',
    'redirect'   => 'Theme Settings',
  ) );


  // Global Options
  // Same options on all languages. e.g., social profiles links


  acf_add_options_sub_page( array(
    'page_title' => 'Global Options',
    'menu_title' => __('Global Options', 'text-domain'),
    'menu_slug'  => "acf-options",
    'parent'     => $parent['menu_slug']
  ) );

  //
  // Language Specific Options
  // Translatable options specific languages. e.g., social profiles links
  //


if( function_exists('pll_languages_list') ) {
  $languages = pll_languages_list();

  //$languages = array( 'sv', 'en' );

  foreach ( $languages as $lang ) {
    acf_add_options_sub_page( array(
      'page_title' => 'Options (' . strtoupper( $lang ) . ')',
      'menu_title' => __('Options (' . strtoupper( $lang ) . ')', 'text-domain'),
      'menu_slug'  => "options-${lang}",
      'post_id'    => $lang,
      'parent'     => $parent['menu_slug']
    ) );
  }
}

}



/**
 * Register navigation menu
*/


	//register_nav_menus( array(
	//	'primary'  => __( 'Header bottom menu', '_tk' ),
     //   'account' =>__( 'Account menu', '_tk' ),
        //'category_nav' =>__( 'Account menu', '_tk' )
//	) );


  function register_my_menus() {
    register_nav_menus(
      array(
        'more-menu' => __( 'More Menu' ),
        'more-delta-menu' => __( 'More Delta Menu' ),
        'add-initiative' => __('Add Initiative'),
        'footer-menu' => __('Footer Menu'),
        'primary-menu'=>__('primary'),
        'account-menu'=>__('account'),
      )
    );
  }
  add_action( 'init', 'register_my_menus' );

/**
 * Fix Search Meter plugin bug
*/

add_action( 'init', 'switch_search_meter_priority' );
function switch_search_meter_priority() {
    remove_filter( 'the_posts', 'tguy_sm_save_search', 20 );
    add_filter( 'the_posts', 'tguy_sm_save_search', 100 );
}

/**
 * Restrict post view to users if user has no cap: 'edit_others_posts'
 */

function posts_for_current_author($query) {
    global $pagenow;

    if( 'edit.php' != $pagenow || !$query->is_admin )
        return $query;

    if( !current_user_can( 'edit_others_posts' ) ) {
        global $user_ID;
        $query->set('author', $user_ID );
    }
    return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');

/**
 * Load translations for smartakartan
 */

function wpdocs_theme_setup(){
    load_theme_textdomain('smartakartan', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'wpdocs_theme_setup');

//PL String Translations
//category-navigation-mobile

if( function_exists('pll_register_string') ) {

pll_register_string( 'smartakartan', 'Undersök dina Kategorier' );
pll_register_string( 'smartakartan', 'Utforska de olika ...' );
pll_register_string( 'smartakartan', 'Transaktionstyper' );
pll_register_string( 'smartakartan', 'Kategorier' );
pll_register_string( 'smartakartan', 'Allt inom' );
pll_register_string( 'smartakartan', 'Upptäck mera' );
pll_register_string( 'smartakartan', 'Visa Fler' );

pll_register_string( 'smartakartan', 'Sökresultat för' );
pll_register_string( 'smartakartan',  'Vi har inga event på gång just nu'  );



pll_register_string( 'smartakartan', 'alla' );
pll_register_string( 'smartakartan', 'Visar' );
pll_register_string( 'smartakartan', 'ingen träff' );
pll_register_string( 'smartakartan', 'filtrera' );
pll_register_string( 'smartakartan', 'Go to' );
pll_register_string( 'smartakartan', 'Initiativ Local' );
pll_register_string( 'smartakartan', 'filters' );
pll_register_string( 'smartakartan', 'Sortera På' );
pll_register_string( 'smartakartan', 'online' );
pll_register_string( 'smartakartan', 'offine' );
pll_register_string( 'smartakartan', 'Nyaste' );
pll_register_string( 'smartakartan', 'Slumpvis' );
pll_register_string( 'smartakartan', 'Närmast mig' );
pll_register_string( 'smartakartan', 'avsånd' );
pll_register_string( 'smartakartan', 'Måste välja minst 1 tr type' );
pll_register_string( 'smartakartan', 'visa resultaten' );
pll_register_string( 'smartakartan', 'visa alla' );
pll_register_string( 'smartakartan', 'Föreslå en ändring' );
pll_register_string( 'smartakartan', 'förbättra denna texten' );
pll_register_string( 'smartakartan', 'Driver du denna verksamhet? Du kan få behörighet.' );
pll_register_string( 'smartakartan', 'Öppettider' );
pll_register_string( 'smartakartan', 'Detailer' );
pll_register_string( 'smartakartan', 'Flera Evenemang' );
pll_register_string( 'smartakartan', 'Flera kollektioner för dig' );

pll_register_string( 'smartakartan', 'Kalender' );
pll_register_string( 'smartakartan', 'på' );
pll_register_string( 'smartakartan', 'Kollektion' );
pll_register_string( 'smartakartan', 'Mina sidor' );
pll_register_string( 'smartakartan', 'Utbyten' );
pll_register_string( 'smartakartan', 'Utforska allt på smarta kartan' );
pll_register_string( 'smartakartan', 'Detaljer' );
pll_register_string( 'smartakartan', 'Dela, låna, byta, ge/få eller hyr!' );
pll_register_string( 'smartakartan', 'Dela verksamhet' );
pll_register_string( 'smartakartan', 'Sociala medier' );
pll_register_string( 'smartakartan', 'Dela på facebook' );
pll_register_string( 'smartakartan', 'Dela på twitter' );
pll_register_string( 'smartakartan', 'Ring för att bekräfta öppetider' );
pll_register_string( 'smartakartan', 'Senast uppdaterad:' );


pll_register_string( 'smartakartan', 'Telefon' );
pll_register_string( 'smartakartan', 'Hemsida' );
pll_register_string( 'smartakartan', 'Mejl' );
pll_register_string( 'smartakartan', 'Vägbeskrivning' );
pll_register_string( 'smartakartan', 'Höjdpunkter' );
pll_register_string( 'smartakartan', 'Datum' );
pll_register_string( 'smartakartan', 'Adress' );
pll_register_string( 'smartakartan', 'Digital Verksamhet' );
pll_register_string( 'smartakartan', 'Förmodligen Öppet' );
pll_register_string( 'smartakartan', 'Öppet nu' );
pll_register_string( 'smartakartan', 'Förmodligen Stängt' );
pll_register_string( 'smartakartan', 'Du har kommit vilse...' );
pll_register_string( 'smartakartan', 'Ändra info' );



pll_register_string( 'smartakartan', 'Måndag' );
pll_register_string( 'smartakartan', 'Tisdag' );
pll_register_string( 'smartakartan', 'Onsdag' );
pll_register_string( 'smartakartan', 'Torsdag' );
pll_register_string( 'smartakartan', 'Fredag' );
pll_register_string( 'smartakartan', 'Lördag' );
pll_register_string( 'smartakartan', 'Söndag' );

pll_register_string( 'smartakartan', 'till eventet' );
pll_register_string( 'smartakartan', 'Delta' );
pll_register_string( 'smartakartan', 'inga poster, tyvärr' );
pll_register_string( 'smartakartan', 'populära sökningar' );
pll_register_string( 'smartakartan', 'Logga ut' );
pll_register_string( 'smartakartan', 'you are here' );

pll_register_string( 'smartakartan', 'Alltid öppet' );
pll_register_string( 'smartakartan', 'Förmodligen öppet' );
pll_register_string( 'smartakartan', 'Förmodligen Stängt' );

pll_register_string( 'smartakartan', 'Jan' );
pll_register_string( 'smartakartan', 'Feb' );
pll_register_string( 'smartakartan', 'Mar' );
pll_register_string( 'smartakartan', 'Apr' );
pll_register_string( 'smartakartan', 'May' );
pll_register_string( 'smartakartan', 'Jun' );
pll_register_string( 'smartakartan', 'Jul' );
pll_register_string( 'smartakartan', 'Aug' );
pll_register_string( 'smartakartan', 'Sep' );
pll_register_string( 'smartakartan', 'Oct' );
pll_register_string( 'smartakartan', 'Nov' );
pll_register_string( 'smartakartan', 'Dec' );

pll_register_string( 'smartakartan', 'Längd' );
pll_register_string( 'smartakartan', 'Tid' );

pll_register_string( 'smartakartan', 'Thank you for posting on our site. We have sent you an confirmation email. Please check your inbox!' );

};


/**
 * Social media share buttons
 */
function smartakartan_share_buttons() {
    $url = urlencode(get_the_permalink());
    $title = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
    $media = urlencode(get_the_post_thumbnail_url(get_the_ID(), 'full'));

    include( locate_template('/template-parts/content/content-social.php', false, false) );
}

function save_opening_hours_now( $post_ID ) {
  if( function_exists('get_field') ) {
  if (get_field('allways_open', $post_ID) == 1) {
    update_post_meta( $post_ID, 'is_open_now', 1 );
  }
 }
}
function save_opening_hours_now_2( $post_ID ) {
  if( function_exists('get_field') ) {
  if (get_field('allways_open', $post_ID) == 1) {
    update_post_meta( $post_ID, 'is_open_now', 1 );
  }
 }
}
// Allways, non-stop open -> trigger is open checkbox
add_action( 'save_post', 'save_opening_hours_now', 13, 2 );
add_action( 'post_updated', 'save_opening_hours_now_2', 13, 2 );



function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


function save_post_coords($post_id) {

  if( function_exists('get_field') ) {

  $type = get_post_type( $post_id );
  $template = get_page_template_slug( $post_id );

  if($template == 'collection.php'){
    add_post_meta($post_id, 'create_supergroup', 1, true);
  }

  $street_address = get_field('street_address', $post_id);
  $multiple = get_field('multiple', $post_id);
  $city = get_field('city', $post_id);
  $coordinates = get_field('coordinates', $post_id);
  $query = false;

  if(get_field('coordinates', $post_id)){
    $query = get_field('coordinates', $post_id);
  }elseif(get_field('street_address', $post_id) && get_field('city', $post_id)){
    $query = get_field('street_address', $post_id).','.get_field('city', $post_id);
  }

  if($query){
    $url = 'https://nominatim.openstreetmap.org/search?q=' . $query . '&format=json';
    $request = wp_remote_get($url);
    $array = json_decode($request["body"]);

    update_post_meta($post_id, 'post_lat', $array[0]->lat);
    update_post_meta($post_id, 'post_lon', $array[0]->lon);
    update_post_meta($post_id, 'post_display_name', $array[0]->display_name);
  }

  }
}
add_action( 'save_post', 'save_post_coords' );
add_action( 'post_updated', 'save_post_coords' );


function my_update_posts() {

    $args = array(
        'post_type' => 'post',
        'numberposts' => -1
    );
    $myposts = get_posts($args);
    foreach ($myposts as $mypost){
        $mypost->post_title = $mypost->post_title.'';
        wp_update_post( $mypost );
    }
}

//add_action( 'wp_loaded', 'my_update_posts' );

function load_backend_validator() {
        wp_enqueue_script( 'backend', get_template_directory_uri() . '/assets/js/backend.js', array() );
}
add_action( 'admin_enqueue_scripts', 'load_backend_validator' );

add_filter('style_loader_tag', function ($tag, $handle, $href, $media) {
  return $tag;
  $skipdefer = [];

  if (!in_array($handle, $skipdefer)) {
      $tag = str_replace(
          "media='". $media ."'",
          "media='none' onload='if(media != \"". $media ."\") media=\"". $media ."\"'",
          $tag
      );
  }

  return $tag;
}, 9999, 4);

add_filter('w3tc_minify_processed', function ($buf) {
  return $buf;
  $buf = str_replace(' media="all" ', " media='none' onload='if (media != \"all\") media=\"all\"' ", $buf);

  return $buf;
});

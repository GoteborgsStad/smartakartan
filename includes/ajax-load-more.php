<?php

add_action('wp_ajax_load_more', 'loadMore');
add_action('wp_ajax_nopriv_load_more', 'loadMore');

function loadMore() {
  
  //   if (isset($_POST['filter']) ) {
  //      $shorted = $_POST['shorted'];
      
  //     foreach ($shorted as $index => $postdata) {
  //           $post = get_post($postdata[0]);
            
  //            if ($post->post_type== 'post') {
  //                include(locate_template('template-parts/content/content-shop.php')); 
  //           }
            
  //           elseif ($post->post_type== 'page') {
  //               include(locate_template('template-parts/content/content-collection.php')); 
  //           }
  //           elseif ($post->post_type == 'blogg') {
  //               include(locate_template('template-parts/content/content-story.php')); 
  //           }
  //           wp_reset_postdata();
  //     } //foreach
  //     die();
  // } else
  if (isset($_POST['chunk'])) {
        
    $chunk = $_POST['chunk'];
      // var_dump($chunk );
     
      foreach ($chunk as $index => $postid) {
        
            $post = get_post(intval($postid));
           
             if ($post->post_type == 'post') {
                 include(locate_template('template-parts/content/content-shop.php')); 
            }
            
            elseif ($post->post_type == 'story') {
              include(locate_template('template-parts/content/content-story.php'));
            }
           elseif ($post->post_type == 'blogg') {
               include(locate_template('template-parts/content/content-blog.php'));
            }
            
      } 
        
        //wp_send_json_success($response);

        die();
        
 
    } // if
    wp_send_json_error('Error');
}

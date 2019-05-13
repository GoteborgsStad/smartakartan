<?php

add_action('wp_ajax_az_filter', 'az_filter');
add_action('wp_ajax_nopriv_az_filter', 'az_filter');

function az_filter() {
  
      // if subcat sent
  
       if (isset($_POST['subs'])) {
        
        $additionalCatIDs = $_POST['subs'];
        
        $mainCategory_id = $_POST['mainCatID'];
        
        $additionalCatIDs = array_map(function($subCatID){
          return intval($subCatID);
        },$additionalCatIDs);
        
       // var_dump($additionalCatIDs);
  
        $postHandler = new postHandler(); 
        
          $filtered = $postHandler->getFilteredByMultipleCat($mainCategory_id, $additionalCatIDs);
    
          if (!$filtered) {
            echo 'Ingen resultat';
          }
          foreach ($filtered as $index => $postdata) {
            $post = get_post($postdata[0]);
            include(locate_template('template-parts/content/content-shop.php')); 
          } //foreach 
     
        die();
        
      }

  // if shorted
  
    elseif (isset($_POST['shorted'])) {

    $shorted = $_POST['shorted'];
      
      foreach ($shorted as $index => $postdata) {
            $post = get_post($postdata[0]);
            
             if ($post->post_type== 'post') {
                 include(locate_template('template-parts/content/content-shop.php')); 
            }
            
            elseif ($post->post_type== 'page') {
              //echo "collection";
                include(locate_template('template-parts/content/content-collection.php')); 
            }
            elseif ($post->post_type == 'blogg') {
                include(locate_template('template-parts/content/content-story.php')); 
            }
            wp_reset_postdata();
      } //foreach



        die();
        
 
    } // if
    wp_send_json_error('Error');
}

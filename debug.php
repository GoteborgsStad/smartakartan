<?php
/**
 * Template Name: debug
 *
 *
 * @package
 */
?>


<?php get_header(); ?>

<h1>debug</h1>
<?php 
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


$is_open_today = get_field($field_to_check, 2850);

          echo "1";
          if(!get_field('allways_open', 2850)){
          	echo "2";
		          if (!empty($is_open_today )) {
			echo "3";
			
			
			echo $is_open_today;
			
			
			           if ($is_open_today != 'closed' AND strlen($is_open_today) < 6 ){
								echo "4";
			              list($from, $to) = explode('-', $is_open_today);
			                  if( ($from <= $hour_now) && ($hour_now <= $to) ){
			                     echo "ja";
			                     //update_post_meta( $id, 'is_open_now', 1 );
			                  }
			              }
			              
	                  if($is_open_today === 'closed' ){
	                  	update_post_meta( $id, 'is_open_now', 0 );
	                    
	                  }
	                  
	                  
		          }else{
		           
		             update_post_meta( $id, 'is_open_now', 0 );
		          }          
          
          }
 ?>
















<?php get_footer(); ?>

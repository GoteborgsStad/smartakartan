<?php $lang = pll_current_language(); ?>
<?php $options_page_id = get_option('page_on_front'); ?>
<?php $args = array(
			'post_type' => 'calender_post_type',
			'meta_key'   => 'startdate_t',
			'orderby'    => 'meta_value_num',
			'post_status' => 'publish',
			'order' => 'ASC',
			'posts_per_page'=>4, 
    		'numberposts'=>4,
    		'lang' => $lang,
	     'meta_query' => array( // WordPress has all the results, now, return only the events after today's date
	        array(
	            'key' => 'startdate_t', // Check the start date field
	            'value' => date("Ymd"), // Set today's date (note the similar format)
	            'compare' => '>=', // Return the ones greater than or equal to today's date
	            'type' => 'DATE' // Let WordPress know we're working with date
	        )
	    )
); ?>

<?php $event = get_posts($args); ?>
<?php  
    if (!$event):
      echo '<span class="no-results-text">';
      pll_e( 'Vi har inga event på gång just nu' );
      echo '</span>'; ?>
      <?php else: ?>
      	
			<?php foreach ($event as $key => $value): ?>
				
				<?php $link = get_permalink($value->ID); ?>

			 	<?php  include(locate_template('/template-parts/collection/event-button.php')); ?>

			<?php endforeach; ?>        	
			
  <?php endif; ?>
    


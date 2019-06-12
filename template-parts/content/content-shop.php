<?php
/**
 * @package
 */
?>
<?php
$lat = get_post_meta($post->ID, 'post_lat', true);
$lon = get_post_meta($post->ID, 'post_lon', true);

if (!empty($lat) && !empty($lon)) {
	$coordinates = $lat.', '.$lon;
} else {
	$coordinates = get_field('coordinates', $post->ID);
}
?>
<?php $multiple = get_field('multiple', $post->ID); ?>
<?php if (get_field('street_address', $post->ID)) {
	$street_address = get_field('street_address', $post->ID);
} else {$street_address = 'not-set';}  ?>
<?php if (get_field('city', $post->ID)) {
	$city = get_field('city', $post->ID);
} else {$city = 'not-set';}  ?>


<article id="post-<?php echo $post->ID; ?>"  data-postid="<?php echo $post->ID; ?>" class="test-posts grid-item " data-coordinates="<?php echo $coordinates ?>" data-multiple="<?php echo $multiple ?>" data-address="<?php echo $street_address ?>" data-city="<?php echo $city; ?>" data-slug="post" data-title="<?php echo get_the_title($post->ID); ?>" data-excerpt="<?php the_field('underrubrik', $post->ID); ?>"  data-link="<?php echo get_permalink($post->ID); ?>" data-distance=" " > <!-- grid-item--width2 -->



		<div class="card card-shop">

		<?php $background_img = get_the_post_thumbnail_url($post->ID, 'medium'); ?>

		<?php if (!$background_img): ?>
			<?php $background_img = get_template_directory_uri().'/dist/images/placeholder-img.png'; ?>
		<?php endif ?>
			<a href="<?php echo get_permalink($post->ID); ?>"  aria-label="Link to post">
			<div class="card-image card-img-top lazy" data-bg="url('<?php echo $background_img; ?>')">
				<div class="distance-bar"><img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-gps.png"><span class="card-distance distance "></span></div><!-- s<?php //echo $post->ID ?> -->
				<div class="open-info">
						<!-- Check if Initiative is open -->
                  <?php $hour_now = date("H"); ?>
                  <?php $day = date("l"); ?>
                  <?php $today = strtolower($day); ?>
                  <?php $field_to_check = $today; ?>
                  <?php $is_open_today = get_field($field_to_check, $post->ID); ?>
                  <?php if ($is_open_today != 'closed' AND !empty($is_open_today) AND !strlen($is_open_today) > 5 ): ?>
                      <?php list($from, $to) = explode('-', $is_open_today); ?>
                          <!-- Feedback if Open or Closed -->
                       <?php if( ($from <= $is_open_today) && ($is_open_today <= $to) ): ?>
                      <!--     <div class="is-open card-info card-open sk-tooltip">  -->
                          		<span class="card-open"><?php pll_e( 'Öppet');?></span>
             <!--              </div> -->
                       <?php endif ?>
                        <?php elseif(empty($is_open_today)): ?>
            <!--               <div class="is-can-be-closed card-info card-open sk-tooltip">  -->
                          		<!--<span class="card-open">stängt ?</span>-->
           <!--                </div>  -->
                      	<?php else: ?>
               <!--           <div class="is-closed card-info card-open sk-tooltip">  -->
                         		<!--<span class="card-open"><?php pll_e( 'Stängt');?></span>-->
                    <!--      </div>  -->
                  <?php endif ?>
		<!-- 			<span class="card-open">öppet</span> -->
				</div>
			</div>
			</a>

			<div class="card-body">
				<a href="<?php echo get_permalink($post->ID); ?>" aria-label="Link to post">
				<h5 class="card-title"><?php echo get_the_title($post->ID); ?></h5>
			</a>

							<!-- Print the first category on card -->
				<!--
				<?php $cat = get_the_category($post->ID); ?>
				<?php if ($cat): ?>
					<?php $cat_link = get_category_link( $cat[0]->term_id ); ?>
					<?php $term = get_term($cat[0]->term_id); ?>
					<?php $term_parent = get_term($term->parent, 'category')?>
					<?php $bg_color = get_field('category_background_color', $term_parent); ?>
					<?php else: ?>
						<?php $bg_color = '#999' ?>
				<?php endif ?>
			-->


				<?php
	// SHOW YOAST PRIMARY CATEGORY, OR FIRST CATEGORY
	$cat = get_the_category($post->ID);
	if ($cat){
		if ( class_exists('WPSEO_Primary_Term') )
		{
			$wpseo_primary_term = new WPSEO_Primary_Term( 'category', $post->ID );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			$term = get_term( $wpseo_primary_term );
			if (is_wp_error($term)) { ?>
				<?php $cat_name = $cat[0]->name; ?>
				<?php $cat_link = get_category_link( $cat[0]->term_id ); ?>
				<?php $term = get_term($cat[0]->term_id); ?>
				<?php $term_parent = get_term($term->parent, 'category')?>
				<?php $bg_color = get_field('category_background_color', $term_parent); ?>
		<?php	} else { ?>
			<?php $cat_name = $term->name; ?>
			<?php $cat_link = get_category_link( $term->term_id ); ?>
			<?php $bg_color = get_field('category_background_color', $term); ?>
			<?php
			}
		} else { ?>
			<?php $cat_name = $cat[0]->name; ?>
			<?php $cat_link = get_category_link( $cat[0]->term_id ); ?>
			<?php $term = get_term($cat[0]->term_id); ?>
			<?php $term_parent = get_term($term->parent, 'category')?>
			<?php $bg_color = get_field('category_background_color', $term_parent); ?>
	<?php	}}
else{
	$bg_color = '#999';
}
	?>

				<div class="info-field" style="background-color: <?php echo $bg_color; ?>">
					<a href="<?php echo $cat_link ?>" aria-label="Category">
					<h6 class="card-info">
							<?php if ( ! empty( $cat ) ) {
		    						echo esc_html( $cat_name );
							} ?>
					</h6>
				</a>

				</div>
				<a href="<?php echo get_permalink($post->ID); ?>" aria-label="details">
				<div class="entry-content">
					<?php if(get_field('offline', $post->ID) == 0): ?>

						<?php if(get_field('multiple', $post->ID)){
							echo '<p style="text-align: center; color: #a3a3a3; margin-bottom: 10px; height: 30px;">' . get_field('area', $post->ID) . '</p>';
						}elseif(get_field('area', $post->ID)){
							echo '<p style="text-align: center; color: #a3a3a3; margin-bottom: 10px; height: 30px;">' . get_field('area', $post->ID) . '</p>';
						}else{
							echo '<p class="area-online"> ... </p>';
						}?>


					<?php else: ?>

						<p class="area-offline"><?php pll_e( 'Digital Verksamhet');?></p>

				<?php endif ?>

					<p class="fontFamilyAlt subtitle"><?php the_field('underrubrik', $post->ID); ?></p>

<!-- <span><br>-<?php // if(get_field('offline', $post->ID) == 1){echo "OFFLINE";}else{echo "ONLINE";} ?></span> -->

			<!-- 	<div class="buttons">
					<?php //pll_e( 'läs mer');?> <span>&#10230;</span>
				</div> -->

			</div><!-- .entry-content -->
		</a>

		 </div><!--  .card-body -->

		</div> <!-- card -->



</article><!-- #post-## -->

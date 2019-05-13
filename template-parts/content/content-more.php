<!-- more -->



<?php
if(is_single()){

	$args = array(
		'posts_per_page'   => 5,
		'offset'           => 0,
		'category'         => get_the_category()[0]->term_id,
		'category_name'    => '',
		'orderby'          => 'date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => array(get_the_id()),
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'author'	   => '',
		'author_name'	   => '',
		'post_status'      => 'publish',
		'suppress_filters' => true,
		'fields'           => '',
	);
}else{
	$args = array(
		'posts_per_page'   => 5,
		'offset'           => 0,
		'category'         => '',
		'category_name'    => '',
		'orderby'          => 'date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'author'	   => '',
		'author_name'	   => '',
		'post_status'      => 'publish',
		'suppress_filters' => true,
		'fields'           => '',
	);
}



$posts_array = get_posts( $args ); ?>

<div class="featured-holder more-of-this-holder">

	<div class="featured scroll-y more-of-this">

		<?php foreach ($posts_array as $key => $value) {

			$ID = $value->ID;
			$thepost = get_post( $ID ); ?>

			<article id="post-<?php echo $ID; ?>" class="">
			<!-- Print the first category on card -->

			<?php $cat = get_the_category($ID); ?>
			<?php if (! empty($cat) ) {
				 $term = get_term($cat[0]->term_id);
				 $term_id = $term->term_id;
				// var_dump($term_id);

				 $main_cat = get_term( $term->parent, 'category');

				// var_dump($main_cat);
				 $bg_color = get_field('category_background_color', $main_cat);
				 //var_dump($bg_color);
			} ?>

					<a href="<?php echo get_the_permalink($ID); ?>" aria-label="Link to post">

						<div class="card card-shop">

							<?php if(get_the_post_thumbnail_url($ID)): ?>
								<?php $card_bg_image_url = get_the_post_thumbnail_url($ID, 'medium'); ?>
							<?php else: ?>
								<?php $card_bg_image_url = get_template_directory_uri().'/dist/images/placeholder-img.png'; ?>
							<?php endif; ?>


							<div class="card-image card-img-top" style="background-image: url('<?php echo $card_bg_image_url; ?>')">

							</div>

						  <div class="card-body">
						  	<?php if ( ! empty( $cat ) ): ?>
			  					<div class="info-field" style="background-color: <?php echo $bg_color; ?>">
									<h6 class="card-info">

						    					<?php echo esc_html( $cat[0]->name );    ?>

									</h6>
							</div>
							<?php endif ?>

						    <h5 class="card-title"><?php echo get_the_title($value->ID); ?></h5>

							<div class="entry-content">

								<p><?php the_field('underrubrik', $value->ID); ?></p>

						 		<div class="buttons">

						 			<?php
										// global $post;
										// foreach(get_the_tags($post->ID) as $tag)
										// {
										 //   echo '<a href=" ' . get_tag_link($tag->term_id) . ' " class="button">' . $tag->name . '</a>';
										// } ?>

								</div>

							</div><!-- .entry-content -->

						  </div><!--  .card-body -->

						</div> <!-- card -->

					</a>

				</article><!-- #post-## -->

		<?php } ?>

	</div>

</div>

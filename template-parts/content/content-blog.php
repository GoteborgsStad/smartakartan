<?php
/**
 * @package 
 */
?>


	<article id="post-<?php echo $post->ID; ?>" class="grid-item ">  <!-- grid-item--width2 -->
		
		<a href="<?php the_permalink(); ?>" aria-label="Link to post">
			
			<div class="card card-blog" >
				
				<div class="card-image card-img-top" style="background-image: url('<?php echo get_the_post_thumbnail_url($post->ID); ?>')">
					
					<?php  ?>
					<div class="overlay" style="background-color: <?php the_field('overlay_background_color', $post->ID); ?>">
						<h3 class="card-blog-title"><?php echo get_the_title($post->ID); ?></h3>
						<h6 class="post-date"><?php echo get_the_date( 'M d, Y', $post->ID); ?></h6>
					</div>
				</div>

			 		<div class="buttons">
			 			
			 			<?php
							 if (get_the_tags($post->ID)) {
						 		foreach(get_the_tags($post->ID) as $tag)
								 {
								   echo '<a href=" ' . get_tag_link($tag->term_id) . ' " class="button" aria-label="tag">' . $tag->name . '</a>';
								  }
							 }
						?>

					</div>
					
			</div> <!-- card -->
			
		</a>
		
	</article><!-- #post-## -->
	








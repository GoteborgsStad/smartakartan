<?php
/**
 * @package
 */
?>


	<article id="post-<?php echo $post->ID; ?>" class="grid-item ">  <!-- grid-item--width2 -->

		<a href="<?php the_permalink($post->ID); ?>" aria-label="Link to post">

			<div class="card card-story" >

				<div class="card-image card-img-top lazy" data-bg="url('<?php echo get_the_post_thumbnail_url($post->ID); ?>')">

					<?php  ?>
					<div class="overlay">
						<h3 class="card-story-title"><?php echo get_the_title($post->ID); ?></h3>
						<h6 class="post-date"><?php pll_e( 'Läs berättelse');?><span>&#8594;</span></h6>
					</div>
				</div>

			 		<div class="buttons">

			 			<?php
							 if (get_the_tags($post->ID)) {
						 		foreach(get_the_tags($post->ID) as $tag)
								 {
								   echo '<a href=" ' . get_tag_link($tag->term_id) . ' " class="button" aria-label="Post tag">' . $tag->name . '</a>';
								  }
							 }
						?>

					</div>

			</div> <!-- card -->

		</a>

	</article><!-- #post-## -->

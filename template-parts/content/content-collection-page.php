<?php
/**
 * The template used for displaying the specific collection page
 * with the corresponding cards inside
 *
 * @package
 */
?>

<article id="post-<?php the_ID(); ?>" class="content-card-list-page single-collections-template">

	<header>

		<div class="page-thumbnail" style="background-image: url('<?php echo get_the_post_thumbnail_url($post->ID, 'medium'); ?>')">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="sk-overlay" style="background-color: <?php the_field('overlay_color', $post->ID); ?>"></div>
		</div>

	</header><!-- .entry-header -->

	<div class="main-content container-fluid">

		<div class="row">
			<div class="col-12 page-description">
				<?php the_content(); ?>
			</div>


			<?php $collections = get_field('collection_of_posts'); ?>
			<?php if($collections): ?>

			<?php foreach ($collections as $key => $url):  ?>

				<div class="col-md-4">
					<?php $itemID = url_to_postid($url);  ?>
					<?php $thepost = get_post( $itemID ); ?>

					<div id="post-<?php echo $itemID; ?>" class="page-card-item">

						<a href="<?php the_permalink($itemID); ?>" aria-label="Link to post">

							<div class="card card-shop">

								<div class="card-image card-img-top" style="background-image: url('<?php echo get_the_post_thumbnail_url($itemID); ?>')">

								</div>

							  <div class="card-body">

							    <h5 class="card-title"><?php echo get_the_title($itemID); ?></h5>

								<div class="card-content">

									<?php if(get_field('street_address', $itemID)){
											echo '<p>' . get_field('street_address', $itemID)  . ', ' . get_field('city', $itemID) . '</p>';
									} ?>

									<p><?php the_field('underrubrik', $itemID); ?></p>

							 		<div class="buttons">

							 			<?php
											// global $post;
											// foreach($tagsOfCollection as $tags)
											//  {
										 //  echo '<a href=" ' . get_tag_link($tags->term_id) . ' " class="button">' . $tags->name . '</a>';
										 // }
										 ?>

									</div>
								</div><!-- .entry-content -->
							  </div><!--  .card-body -->
							</div> <!-- card -->
						</a>
					</div><!-- #post-## -->
				</div>


			<?php endforeach; ?>
			<?php else: ?>

	<div class="col-12">
			<h3><?php pll_e( 'inga poster, tyvärr');?></h3>
	</div>

			<?php endif; ?>
		</div> <!-- row -->


		<h4><?php pll_e( 'Flera höjdpunkter för dig');?> </h4>

		<!-- More Collections -->



					<!-- Collection Slider -->

					<?php get_template_part('/template-parts/collection/collection-slider'); ?>




	</div><!-- .main-content -->

<!-- 	OLD SLIDER -->
<!-- 		<div id="collection-menu" class="scroll-menu mt-2 mb-2">
			<div class="buttons scroll-y">
				<?php //include(locate_template('/template-parts/collection/get-collection-buttons.php')); ?>
			</div>
		</div>	 -->


</article><!-- #post-## -->

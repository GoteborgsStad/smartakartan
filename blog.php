<?php
/**
 * Template Name: Blog
 *
 *
 * @package
 */
?>


<?php get_header(); ?>

<?php $postHandler = new postHandler(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<div class="container-fluid main-content">
		<div class="row">
			<div class="col-12 col-md-8">
				<div id="list-of-cards" class="container-fluid list-of-cards show">

					<?php $chunks = $postHandler->getStories(); ?>

					<?php the_title(); ?>
					<?php the_content(); ?>

					<script type="text/javascript">
						var chunks = <?php echo json_encode($chunks); ?>;
					</script>

					<div class="grid">

						<div id="grid-sizer" class="grid-sizer"></div>

						<?php foreach ($chunks[0] as $key => $value): ?>

						<?php $post = get_post($value); ?>

						<?php	if ($post->post_type == 'blogg'):

								include(locate_template('template-parts/content/content-story.php'));

							endif; ?>

						<?php endforeach ?>


						<div id="before"></div>

					</div> <!-- grid -->

					<div class="grid-item grid-item--width2 text-center">
							<button id="load-more"><?php pll_e( 'Visa Fler');?></button>
							<button id="filter-more"><?php pll_e( 'Visa Fler');?></button>
					</div>

				</div> <!-- #list-of-cards-->
			</div>   <!-- col-12 col-md-8 -->

			<div class="col-12 col-md-4">

				<div class="col-12 map-holder">

					<div id=" " class="the-map desktop show">

						<?php // include(locate_template('/template-parts/content-map.php')); ?>

						<?php include(locate_template('/template-parts/map/smartakartan.php')); ?>

					</div>

				</div>

			</div>	 <!-- col-12 col-md-4 -->

		</div> <!-- row -->

	</div> <!-- .container-fluid -->

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>

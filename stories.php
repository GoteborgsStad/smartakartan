<?php
/**
 * Template Name: Stories
 *
 *
 * @package
 */
?>

<?php get_header(); ?>

<?php $postHandler = new postHandler(); ?>
<?php $options_page_id = get_option('page_on_front'); ?>
	<?php while ( have_posts() ) : the_post(); ?>

<div class="content-card-list-page stories-template main-content ">
	
	<div id="list-of-cards" class="container-fluid list-of-cards show ">
	
			<div class="row">
				<div class="col-12">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</div>
				<div class="col-12 page-description">
					<?php the_content(); ?>				
				</div>			
			</div>	

		<div class="row">

				<div class="col-12 col-md-12">
					<?php $stories = $postHandler->getStories(); ?>

					<script type="text/javascript">
						//var chunks = <?php echo json_encode($chunks); ?>;
					</script>

			<!-- 		<div class="grid" style="min-height: 100vh"> -->
						
		<!-- 				<div id="grid-sizer" class="grid-sizer"></div> -->
						
						
						<div class="mot">
							<?php foreach ($stories as $key => $value): ?>
							
							<?php $post = get_post($value); ?>

							<?php	if ($post->post_type == 'story'): ?>

						<div class="sin">
							<?php	include(locate_template('template-parts/content/content-story.php')); ?>							
						</div>



							<?php endif; ?>

						<?php endforeach ?>						
						</div>

						
						<div id="before"></div>
								
					<!-- </div>  --><!-- grid -->
					
					<!-- <div class="grid-item grid-item--width2 text-center"> -->

						<!-- 	<button id="load-more" class="btn btn-load-more mtb-3" style="background-color: <?php //the_field('site_main_color_5', $options_page_id ) ?>"><?php //pll_e( 'Visa Fler');?></button> -->

		<!-- 			</div> -->
					
				</div>  <!-- col-12 col-md-8 -->
				


			<div class="col-12 col-md-4">

				<div class="col-12 map-holder">
					
					<div id=" " class="the-map desktop show">

						<?php // include(locate_template('/template-parts/content-map.php')); ?>

						<?php include(locate_template('/template-parts/map/smartakartan.php')); ?>

					</div>

				</div>

			</div>	 <!-- col-12 col-md-4 -->

		</div> <!-- row -->

	</div> <!-- main-content -->

</div>  <!-- content-card-list-page -->
	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>

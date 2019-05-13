<?php
/**
 * Template Name: Blogs
 *
 *
 * @package
 */
?>


<?php get_header(); ?>

<?php $postHandler = new postHandler(); ?>
<?php $options_page_id = get_option('page_on_front'); ?>

<?php while ( have_posts() ) : the_post(); ?>

<div class="content-card-list-page blog-template main-content">
	
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
					<?php $blogs = $postHandler->getBlogs(); ?>
	
					<script type="text/javascript">
						//var chunks = <?php echo json_encode($chunks); ?>;
					</script>
					
					
						<div class="mot">
							<?php foreach ($blogs as $key => $value): ?>
							
							<?php $post = get_post($value); ?>

								<div class="sin">
									<?php	include(locate_template('template-parts/content/content-blog.php')); ?>							
								</div>

						<?php endforeach ?>	
						</div>

					<!-- <div class="grid" style="min-height: 100vh"> -->
						
						<!-- <div id="grid-sizer" class="grid-sizer"></div> -->
						
		<!-- 				<?php //foreach ($blogs as $key => $value): ?>
							
							<?php $post = get_post($value); ?>
					
							<?php
								//include(locate_template('template-parts/content/content-blog.php'));
							?>

						<?php// endforeach ?> -->
						
						<div id="before"></div>

					<!-- </div> --> <!-- grid -->
<!-- 					
					<div class="grid-item grid-item--width2 text-center">

							<button id="load-more" class="btn btn-load-more mtb-3" style="background-color: <?php //the_field('site_main_color_5', $options_page_id ) ?>"><?php //pll_e( 'Visa Fler');?></button>

					</div> -->
					
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

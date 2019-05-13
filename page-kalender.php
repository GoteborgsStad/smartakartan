<?php
/**
 * Template Name: Kalender
 *
 *
 * @package 
 */
?>


<?php get_header(); ?>

	<div class="container-fluid">
		
		<div class="row">
				
			<div class="col-12">
				
				<?php while ( have_posts() ) : the_post(); ?>

					<?php include(locate_template('template-parts/content/content-page.php'));  ?>

				<?php endwhile; // end of the loop. ?>		
				
			</div>
			
		</div>
		
	</div>

<?php get_footer(); ?>

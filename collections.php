<?php
/**
 * Template Name: Collections
 * Template to show all the collections
 *
 * @package
 */
?>


<?php get_header(); ?>

<?php $postHandler = new postHandler(); ?>

	<?php while ( have_posts() ) : the_post(); ?>


 		
	<div class="container collections-template">
	<div class="col-md-8 col-centered">		
			
		<div class=" collections-content">
				<div class="row">
					<div class="col-12">
						<h1 class="page-title"><?php the_title(); ?></h1>
					</div>
					<div class="col-12 page-description">
						<?php the_content(); ?>
					</div>			
				</div>	
		</div>

			<div class="row collections-list">
			
				<?php $supergroups = get_pages(array('meta_key' => 'create_supergroup')); ?>

				<?php foreach ($supergroups as $key => $value): ?>
					
					<?php $link = get_permalink($value->ID); ?>
					<?php $bg_image = get_the_post_thumbnail_url( $value->ID ); ?>

					<div class="col-6 p-1">
						 <?php  include(locate_template('/template-parts/collection/collection-button.php')); ?>
					</div>

				<?php endforeach; ?> 						

			</div> <!-- row -->
	
	</div> 
	</div> <!-- .container-fluid -->

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>

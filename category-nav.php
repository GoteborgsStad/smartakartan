<?php
/**
 * Template Name: Category-nav
 *
 *
 * @package 
 */
?>

<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		 <div id="categories-mobile" >
		    <?php  include(locate_template('/template-parts/nav/category-navigation-mobile.php')); ?>
		</div>

	<?php endwhile; // end of the loop. ?>		

<?php get_footer(); ?>

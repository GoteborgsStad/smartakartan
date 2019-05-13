<?php
/**
 * Template Name: Collection
 *
 *
 * @package 
 */
?>


<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php include(locate_template('template-parts/content/content-collection-page.php'));  ?>

	<?php endwhile; // end of the loop. ?>		

<?php get_footer(); ?>

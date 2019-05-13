<?php
/**
 * Template Name: Calender
 *
 *
 * @package
 */
?>

<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php include(locate_template('template-parts/content/content-calender-page.php'));  ?>

	<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>

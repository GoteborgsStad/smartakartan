<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package
 */
?>


<?php get_header(); ?>

	<div class="container main-content single-page-template">

		<div class="row">

			<div class="col-md-8 col-centered">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php include(locate_template('template-parts/content/content-page.php'));  ?>

				<?php endwhile; // end of the loop. ?>

			</div>

		</div>

	</div>

<?php get_footer(); ?>

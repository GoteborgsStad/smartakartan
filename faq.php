<?php
/**
 * Template Name: FAQ
 *
 *
 * @package
 */
?>

<?php get_header(); ?>

	<div class="container-fluid">

		<div class="row">

			<div class="col-12">
				<h1><?php the_title();?></h1>
				<div id="faq-container">
					<?php the_content();?>
				</div>

			</div>

		</div>

	</div>

<?php get_footer(); ?>

<?php
/**
 * Template Name: themap
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

	<div class="container-fluid fullscreen-map-holder">
		<div class="full-map_filter">
			<div class="full-map_filter-inner">

			<?php   $categories = get_terms(
							array(
								'taxonomy' => 'category',
								'hide_empty' => false,
								'exclude' => array( 1 ),
								'parent'   => 0,
							)); ?>

				<?php foreach ($categories as $cat ): ?>

					<?php $color = get_field('category_background_color', 'category_'.$cat->term_id);?>
					<?php if ($cat->name == "Okategoriserade") {
						$color = '#999';
					}  ?>
					<label class="cat-tag">
						<input checked type="checkbox" class="filter-box" value="<?php echo $cat->term_id ?>">
						
						<span style="background-color: <?php echo $color ?>;"><?php echo $cat->name ?></span>
					</label>

				<?php endforeach ?>

				</div>
		</div>

		<div class="row">

			<div class="col-12">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php the_content(); ?>
<div id="fullscreen-map" class="active">
					<?php include(locate_template('template-parts/map/smartakartan.php'));?>
</div>


				<?php endwhile; // end of the loop. ?>

			</div>

		</div>

	</div>
<div class="the-map-template-footer">
	<?php get_footer(); ?>
</div>

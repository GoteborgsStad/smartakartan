<?php
/**
 * Template Name: Sub Category nav
 *
 *
 * @package
 */
?>

<?php get_header(); ?>


	<?php while ( have_posts() ) : the_post(); ?>
	<?php $term_id = $_GET["id"]; ?>
	<?php $main_cat =  get_term_by('id', $term_id, 'category') ?>
	<?php $linkToMainCat = get_category_link($main_cat->term_id); ?>
	<?php $bg_color = get_field('category_background_color', $main_cat); ?>

	   <div class="sub-categories category-<?php echo $main_cat->slug; ?>">

						<div class="sub-category-header" style="background-color: <?php echo $bg_color; ?>">
							<h3><?php echo $main_cat->name; ?></h3>
							<h6><?php echo $main_cat->description; ?></h6>
						</div>

						<?php $taxonomy_name = 'category';
						$term_children = get_term_children( $term_id, $taxonomy_name ); ?>

						<div id="sub-categori-all-<?php echo $main_cat->name ?>" class="sub-category-holder">
								<a href="<?php echo $linkToMainCat; ?>" class="sub-category-link" ><strong><?php  pll_e( 'Allt inom:' );?> <?php  echo $main_cat->name; ?></strong></a>
							</div>
						<?php foreach ($term_children as $key => $value): ?>

							<?php $term = get_term($value); ?>
							<?php $termId = $term->term_id; ?>

							<?php $category = get_category($termId); ?>
							<?php $count = $category->category_count; ?>


							<?php $linkToCat = get_category_link($termId); ?>

					   	<?php if ($count != 0): ?>
							<div id="sub-categori-<?php echo$term->slug ?>" class="sub-category-holder">

								<a href="<?php echo $linkToCat; ?>" class="sub-category-link" ><?php  echo $term->name; ?>
									<span class="item-count"><?php echo $count; ?></span>
								</a>

							</div>
						<?php endif; ?>


					<?php endforeach; ?>

					  </div>

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>

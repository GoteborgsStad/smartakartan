<?php $lang = pll_current_language(); ?>

<?php $supergroups = get_pages(array('meta_key' => 'create_supergroup', 'lang' => $lang)); ?>

<?php foreach ($supergroups as $key => $value): ?>
	
	<?php $link = get_permalink($value->ID); ?>
	<?php $bg_image = get_the_post_thumbnail_url( $value->ID, 'medium' ); ?>
	
 	<?php  include(locate_template('/template-parts/collection/collection-button.php')); ?>

<?php endforeach; ?> 

<a href="<?php echo get_page_link(pll_get_post(2383)); ?>" class="btn btn-sk btn-collection mb-1" style="background-color: <?php the_field('site_main_color_4', 'option'); ?>;" aria-label="Go to page">
			<span class="collection-title"><?php pll_e('visa alla'); ?></span>
</a>
<?php wp_reset_postdata(); ?>
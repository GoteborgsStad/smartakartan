<a href="<?php echo $link; ?> " class="btn btn-sk btn-collection mb-1" style="background-image: url( <?php echo $bg_image; ?> );" aria-label="Collection">
<!-- 	<div class="sk-overlay" style="background-color: <?php the_field('overlay_color', $value->ID); ?>"> -->
	<?php if (get_field('short_name', $value->ID)): ?>
		<span class="collection-title"><?php the_field('short_name', $value->ID); ?></span>
		<?php else: ?>
			<span class="collection-title"><?php echo $value->post_title; ?></span>
	<?php endif ?>			
	<div class="description">

		<h6 class="collection-description">
			<?php //the_field('text_for_startpage_card', $value->ID);  ?>
		</h6>					


	</div>

<!-- 	</div> -->
</a>
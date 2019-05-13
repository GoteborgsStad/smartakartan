<div id="scroll-menu" class="secondary-menu mt-2 mb-2">
	<div class="buttons scroll-y">
		<?php $supergroups = get_pages(array('meta_key' => 'create_supergroup')); ?>
		
		<?php foreach ($supergroups as $key => $value): ?>
			<?php $link = get_permalink($value->ID); ?>
			
			<a href="<?php echo $link; ?> " class="button">
				<?php if (get_field('short_name', $value->ID)): ?>
					<?php the_field('short_name', $value->ID); ?>
					<?php else: ?>
						<?php echo $value->post_title; ?>
				<?php endif ?>
				
			</a>

		<?php endforeach; ?> 

	</div>
<!-- 	<div class="map-switcher">
		<button id="to-list">list</button>
		<button id="to-map">map</button>
	</div> -->
</div>
<div id="secondary-menu" class="scroll-menu sub-cat-filter mt-2 mb-2">
	
	<span class="sub-filter-desktop"><?php pll_e( 'filtrera');?>: </span>
	
		<div id="category-buttons" class="buttons scroll-y" data-maincategory="<?php echo $category_id ?>">
		
		<?php $postHandler = new postHandler(); ?>
		
		<?php $shorted = $postHandler->getAzShorted($category_id); ?>

		<script type="text/javascript">
			 var shorted = <?php echo json_encode($shorted); ?>;
		</script>
			
		<?php 
			$args = array('child_of' => $category_id);
			$subCategories = get_categories( $args ); 
		?>

		<?php foreach($subCategories as $sub => $value ): ?>

			<div class="ck-button">
			   <label>
			      <input id="sub-cat-id-<?php echo $value->term_id; ?>" class="sub-check" type="checkbox" data-subcategory="<?php echo $value->term_id; ?>" ><span><?php echo $value->name; ?></span>
			   </label>
			</div>
			
		<?php endforeach; ?>
		
		<!-- <a id="filter-az" href="#" class="button">A-Z</a> -->
		
	</div>

</div>
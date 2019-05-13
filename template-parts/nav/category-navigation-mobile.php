<div id="category-nav-mobile" class="">

	<h3><?php pll_e( 'Undersök dina Kategorier' );?></h3>
	<p><?php pll_e( 'Utforska de olika ...' );?></p>

	

	<!-- get and print the main categories -->
	<nav id="category-nav" class="category-nav">

	<?php

	$categories = get_terms(
		array(
			'taxonomy' => 'category',
			'hide_empty' => false,
			 'parent'   => 0,
			 'exclude' => array(1, 227)
		)
	); ?>

		<h4><?php pll_e( 'Kategorier' );?></h4>
		
		<div class="row categories-row ptb-2">

			<?php foreach ($categories as $maincategori => $mcv): ?>

					<?php $term_id = $mcv->term_id; ?>
					
					<?php $sub_categories = get_categories(
				    array( 'parent' => $term_id )
					); ?>
					<?php $count_items_in_subcat = 0; ?>
					
					<?php foreach ($sub_categories as $key => $value): ?>

						<?php $s_category = get_category($value->term_id); ?>
						<?php $count = $s_category->category_count; ?>
						<?php $count_items_in_subcat += $count ; ?>
						
					<?php endforeach ?>
					<?php $term = get_term($mcv->term_id); ?>
				
					<?php $bg_color = get_field('category_background_color', $term); ?>
					
					<?php $linkToMainCat = get_category_link($term_id); ?>

				


			
					<?php if ($count_items_in_subcat != 0 ): ?>
						<div class="col-6 category-button-holder">
						<a class="btn btn-sk btn-cat mtb-1" href="<?php echo bloginfo('url')?>/sub-category-nav?id=<?php echo $term_id; ?>" data-category="<?php echo $term_id; ?>" style="background-color: <?php echo $bg_color; ?>; border-color:<?php echo $bg_color; ?> " aria-label="Categories">
							<span class="categori-name">
								<?php echo $mcv->name; ?>
								<span class="item-count"><?php echo $count_items_in_subcat; ?></span>
							</span>
							
						</a>
						</div>
					<?php endif ?>
			


				

			<?php endforeach ?>
			
		</div>

		<!-- END get and print the main categories -->

		<!-- get and print transactions  -->	
			<h4><?php pll_e( 'Transaktionstyper' );?></h4>
			
			<?php
			$transactions = get_terms(
				array(
					'taxonomy' => 'top_taxonomy',
					'hide_empty' => false,
					 'parent'   => 0,
				)
			); ?>

		<?php $trans = get_taxonomy('top_taxonomy'); ?>

		  <div class="d-flex transaktions-list mtb-2">

			<?php foreach ($transactions as $key => $value): ?>
			
				<?php $term_link = get_term_link( $value->slug, 'top_taxonomy' ); ?>
				
				<div class="transaktion">
					<a class="" href="<?php echo $term_link; ?>" aria-label="transactions">
						<img alt="placeholder-image" src="https://via.placeholder.com/50">
						<span class="trans-name"><?php echo $value->name; ?></span>
					</a>
				</div>

			<?php endforeach ?>

		  </div>

		<!-- 	END :: print transactions  -->

		<!-- Print event slider -->
		
		<div class="mtb-2">
			<?php get_template_part('/template-parts/collection/collection-slider'); ?>			
		</div>


		<h4><?php pll_e( 'Evenemang' );?></h4>

		
		<?php get_template_part('/template-parts/collection/event-slider'); ?>


	</nav>
</div>

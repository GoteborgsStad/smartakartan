
			<?php
		$transactions = get_terms(
		array(
			'taxonomy' => 'top_taxonomy',
			'hide_empty' => false,
			 'parent'   => 0,
		)
	); ?>
	<?php $trans = get_taxonomy('top_taxonomy'); ?>
	<?php $count_posts = wp_count_posts();
		$published_posts = $count_posts->publish; ?>
	<?php $options_page_id = get_option('page_on_front'); ?>

		<div class="filter-header">

			<span><?php pll_e( 'Filter' );?></span>

			<span id="reset" class="reset" style="color: <?php the_field('site_main_color_1', 'option' ) ?>"><?php pll_e( 'Återställ' );?></span>

		</div>

		<div class="filter-body">

<!-- 			<div class="localisation filter-section">

				<h6 class="filter-title"><?php // pll_e( 'Initiativ Local');?></h6>

				<div class="local-buttons filter-buttons">

					<div class="ck-button">
					   <label>
					      <input id="online" class="sub-check" name="isOffline" type="radio" data-filter="online" ><span><?php  //pll_e( 'online');?></span>
					   </label>
					</div>

					<div class="ck-button">
					   <label>
					      <input id="offline" class="sub-check" name="isOffline" type="radio" data-filter="offline" ><span><?php // pll_e( 'offline');?></span>
					   </label>
					</div>

					<div class="ck-button">
					   <label>
					      <input id="on-and-off" class="sub-check" name="isOffline" type="radio" checked  data-filter="on-and-off" ><span><?php // pll_e( 'online');?> & <?php // pll_e( 'offline');?></span>
					   </label>
					</div>

				</div>

			</div> -->
			<!-- open now filter -->
			<div class="open filter-section">
				<h6 class="filter-title"><?php pll_e( 'Öppet nu');?></h6>

					<div class="toggles-mob">
					  <input type="checkbox" data-filter="open" name="checkbox1" id="checkbox1" class="ios-toggle"/>
					  <label for="checkbox1" class="checkbox-label" data-off="" data-on=""></label>


					</div>


	<!-- 			<div class="open-buttons filter-buttons">
					<div class="ck-button">
					   <label>
					      <input id="open" class="sub-check" name="open"   type="checkbox" data-filter="open" ><span><?php //pll_e( 'Öppet');?></span>
					   </label>
					</div>
				</div> -->
			</div>


			<div class="sorting filter-section">

				<h6 class="filter-title"><?php pll_e( 'Sortera');?></h6>

					<div class="sort-buttons filter-buttons">

						<div class="ck-button">
						   <label>
						      <input id="srandom" class="sub-check" name="sortBy" checked  type="radio" data-filter="random" ><div class="sub-check-drop"></div><span><?php pll_e( 'Slumpvis');?></span>
						   </label>

						</div>

						<div class="ck-button">
						   <label class="label-newses">
						      <input id="newest" class="sub-check" name="sortBy"  type="radio"  data-filter="newest" ><div class="sub-check-drop"></div><span><?php pll_e( 'Nyaste');?></span>
						   </label>
						</div>

						<div class="ck-button">
						   <label class="label-distance">
						      <input id="distance" class="sub-check" name="sortBy" type="radio" data-filter="distance"><div class="sub-check-drop"></div><span><?php pll_e( 'Närmast mig');?></span>
						   </label>
						</div>

					</div>

			</div>



			<!-- here -->

	<?php

	$categories = get_terms(
		array(
			'taxonomy' => 'category',
			'hide_empty' => false,
			 'parent'   => 0,
			 'exclude' => array(1, 227)
		)
	); ?>

<div class="categories filter-section">

		<h6 class="filter-title"><?php pll_e( 'Kategorier' );?></h6>
		<div class="categories-row  category-buttons filter-section">

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

						<div class="ck-button-holder category-button-holder">


							<div class="ck-button btn btn-sk btn-cat mb-1 color-button" style="position: relative">
							   <label>
							      <input id="category-<?php echo $mcv->slug; ?>" name="<?php echo $mcv->slug; ?>" class="sub-check" type="checkbox"  data-filter="<?php echo $mcv->slug; ?>">
										<div class="sub-check-drop" style="background-color: <?php echo $bg_color ?>"></div>
										<span class="inner-label"><?php echo $mcv->name; ?></span>
							   </label>
							</div>
								<span class="checkbox-label"><?php //echo $mcv->name; ?></span>
						</div>





<!-- 						<div class="col-6 category-button-holder">

							<div class="btn btn-sk btn-cat mtb-1" href="" data-category="<?php echo $term_id; ?>" style="background-color: <?php echo $bg_color; ?>; border-color:<?php echo $bg_color; ?> ">
								<span class="categori-name">
									<?php echo $mcv->name; ?>
									<span class="item-count"><?php echo $count_items_in_subcat; ?></span>
								</span>

							</div>
						</div> -->
					<?php endif ?>





			<?php endforeach ?>

		</div>
</div> <!-- categories filter section -->
			<!-- to here -->



			<div class="transactions filter-section">

				<div class="transaction-info">

					<div class="tansaction-text">
						<h6 class="filter-title"><?php pll_e( 'Utbyten');?></h6>
						<!-- <span><?php // pll_e( 'Måste välja minst 1 tr type');?></span> -->
					</div>

					<div class="indicator">
						<div class="button">
							<button id="numberOfResults" class="btn"><?php //echo $published_posts;?></button>
						</div>
					</div>

				</div>

				<?php //include(locate_template('/template-parts/filter-az.php')); ?>

				<div class="transaction-buttons filter-buttons filter-section">

					<?php foreach ($transactions as $key => $value): ?>

						<div class="ck-button">
						   <label>
						      <input id="transaction-<?php echo $value->slug; ?>" name="<?php echo $value->slug; ?>" class="sub-check" type="checkbox"  data-filter="<?php echo $value->slug; ?>" checked ><div class="sub-check-drop"></div>
									<span><?php echo $value->name; ?></span>
						   </label>
						</div>

					<?php endforeach ?>

				</div>

			</div>

			<button id="show-filter-resuls" class="btn show-filter-resuls mtb-1" style="background-color: <?php the_field('site_main_color_5', 'option' ) ?>; color: <?php the_field('site_main_color_6', 'option') ?>"><?php pll_e( 'visa resultaten');?></button>

		</div>

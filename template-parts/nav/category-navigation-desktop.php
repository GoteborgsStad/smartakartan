<div id="category-nav-desktop">

	<nav id="" class="navbar navbar-expand-lg category-nav">

		<?php
		$categories = get_terms(
			array(
				'taxonomy' => 'category',
				'hide_empty' => true,
				 'parent'   => 0,
				 'exclude' => array(1, 227)
			)
		); ?>

	<div class="categories-dropdowns">
		<?php foreach ($categories as $key => $value): ?>

			<div class="dropdown show">

				<?php $term_id = $value->term_id; ?>
				<?php $linkToMainCat = get_category_link($term_id); ?>

				<a aria-label="Label">
					<label class="cat-menu-label" for="category-<?php echo $value->slug; ?>">
						<?php echo $value->name; ?>
					</label>
				</a>

				<a class="btn dropdown-toggle" href="<?php echo $linkToMainCat  ?>" role="button"  aria-label="Go to categories" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

				</a>

			  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

					<?php $taxonomy_name = 'category';
					$term_children = get_term_children( $term_id, $taxonomy_name ); ?>

					<?php foreach ($term_children as $key => $value): ?>

						<?php $term = get_term($value); ?>
						<?php $termId = $term->term_id; ?>
						<?php $countTerm = $term->count; ?>

						<?php $linkToCat = get_category_link($termId); ?>
							<?php if($countTerm != 0): ?>
						   	<a class="dropdown-item" href="<?php echo $linkToCat  ?>"  aria-label="Go to categories"><?php echo $term->name; ?></a>
						   <?php endif; ?>

					<?php endforeach; ?>
				</div>



			  </div>

		<?php endforeach; ?>

		<?php
	$transactions = get_terms(
	array(
		'taxonomy' => 'top_taxonomy',
		'hide_empty' => false,
		 'parent'   => 0,
	)
); ?>
<div id="transactions-filter-wrapper" class="transactions filter-section">
	<div class="transaction-info dropdown-toggle">
		<div class="tansaction-text">
			<h6 id="transaction-dropdown-title" class="filter-title"><?php pll_e( 'Utbyten');?></h6>
		</div>
	</div>
	<div id="transaction-buttons" class="transaction-buttons filter-buttons dropdown-menu">
		<?php foreach ($transactions as $key => $value): ?>

			<div class="check-container">

					 <label for="transaction-<?php echo $value->slug; ?>">
						 <?php echo $value->name; ?>
						 <!--
							<input id="transaction-<?php echo $value->slug; ?>" name="<?php echo $value->slug; ?>" class="sub-check" type="checkbox"  data-filter="<?php echo $value->slug; ?>"  ><div><div></div></div>
							<span class="inner-label">
								<?php echo $value->name; ?>
							</span>
						-->
					 </label>

			</div>

		<?php endforeach ?>
	</div>
</div>



	</div>
	<div class="open filter-section hd">

	<!--	<h6 class="filter-title"><?php pll_e( 'Öppet nu');?></h6> -->
			<!--
			<input type="checkbox" data-filter="open" name="checkbox2" id="checkbox2" class="ios-toggle"/>
		-->
			<label for="checkbox2" class="ghost-checkbox-label">
				<span class="open-title"><?php pll_e( 'Öppet nu');?></span>
				<div>
					<div>
					</div>
				</div>
			</label>


	</div>

		<!-- list transactions -->
		<?php
			$transactions = get_terms(
			array(
				'taxonomy' => 'top_taxonomy',
				'hide_empty' => false,
				 'parent'   => 0,
			)
		); ?>

	      <?php wp_nav_menu(
        array(
          'theme_location' 	=> 'more-delta-menu',
          'menu_class' 		=> 'more-delta',
          'container_class' => 'more-container'
        )
      ); ?>

	</nav>

</div>
<div id="category-nav-desktop-spacer" class="only-desktop"></div>

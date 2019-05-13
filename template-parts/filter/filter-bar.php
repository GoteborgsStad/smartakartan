
<div class="filter-nav d-flex justify-content-between filter-controll ptb-2">

		<!-- filter info feedback field -->
		<div class="d-flex flex-column">
			<span class="filter-feedback"><?php  pll_e( 'Visar' );?></span>
			<span id="filter-feedback" class="filter-feedback"><?php pll_e( 'online');?>& <?php pll_e( 'offline');?>, <?php pll_e( 'Nyaste');?>, 5 <?php pll_e( 'Transaktionstyper');?></span>
		</div>

		<!-- get filter buttons -->
		<div class="filter-icons">

			<!-- open now filter -->
			<div class="open filter-section hd">
				<!--
				<h6 class="filter-title"><?php pll_e( 'Öppet nu');?></h6>
					-->
				<div class="toggles-hd">
				  <input type="checkbox" data-filter="open" name="checkbox2" id="checkbox2" class="ios-toggle"/>
				  <label for="checkbox2" class="checkbox-label" data-off="" data-on=""></label>
				</div>


<!-- 				<div class="open-buttons filter-buttons">
					<div class="ck-button">
					   <label>
					      <input id="open" class="sub-check" name="open"   type="checkbox" data-filter="open" ><span><?php //pll_e( 'Öppet nu');?></span>
					   </label>
					</div>
				</div> -->
			</div>


			<h6 class="filter-title"><?php pll_e('Filter'); ?></h6>
			<div id="filters" class="hamburger filter-icon"  data-toggle="collapse" data-target="#collapseFilter" style="background-image: url('<?php echo get_template_directory_uri(); ?>/dist/images/iconFilter.svg')">

			</div>
			<div id="toggleMap" class="hamburger list-icon" style="background-image: url('<?php echo get_template_directory_uri(); ?>/dist/images/icon-list.png')">
			</div>




			<!-- Sorterings filter -->
			<div class="sorting filter-section">
				<h6 class="filter-title"><?php pll_e( 'Sortera På');?></h6>
					<div class="sort-buttons filter-buttons">
						<select id="shortBySelect" data-filter="">
							<option value="random"><span><?php pll_e( 'Slumpvis');?></span></option>
							<option value="newest"><span><?php pll_e( 'Nyaste');?></span></option>
							<option value="distance"><span><?php pll_e( 'Närmast mig');?></span></option>
						</select>
					</div>
			</div>
<!-- 			<div class="localisation filter-section">
				<div class="local-buttons filter-buttons">
					<select id="shortByOnline">
						<option value="online"><span><?php // pll_e( 'online');?></span></option>
						<option value="offline"><span><?php // pll_e( 'offline');?></span></option>
						<option value="on-and-off"><span><?php // pll_e( 'online');?></span></option>
					</select>
				</div>
			</div>			 -->
		</div> <!-- filter icons -->



</div>
<div class="desktop-filter-holder">
	<div id="collapseFilter" class="collapse">
		<div class="desktop-filter">
					<?php
				$categories = get_terms(
				array(
					'taxonomy' => 'category',
					'hide_empty' => false,
					'exclude' => array( 1 ),
					 'parent'   => 0,
				)
			); ?>
			<div class="categories filter-section categories-wrapper">
				<div class="category-info">
					<div class="category-text">
						<h6 class="filter-title"><?php pll_e( 'Kategorier');?></h6>
					</div>
				</div>


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

							<div class="ck-button btn btn-sk btn-cat mb-1" >
							   <label>
							      <input id="category-<?php echo $mcv->slug; ?>" name="<?php echo $mcv->slug; ?>" class="sub-check" type="checkbox"  data-filter="<?php echo $mcv->slug; ?>"  >   <span  class="inner-label" style="background-color: <?php echo $bg_color ?>"><?php echo $mcv->name; ?></span>
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



<!-- 				<div class="category-buttons filter-buttons ">
					<?php foreach ($categories as $key => $value): ?>
						<?php $term = get_term($value->term_id); ?>
						<?php $bg_color = get_field('category_background_color', $term); ?>
						<div class="ck-button-holder">

							<div class="ck-button">
							   <label style="background-color: <?php echo $bg_color ?>">
							      <input id="category-<?php echo $value->slug; ?>" name="<?php echo $value->slug; ?>" class="sub-check" type="checkbox"  data-filter="<?php echo $value->slug; ?>"  >   <span  class="inner-label" >label</span>
							   </label>

							</div>
								<span class="checkbox-label"><?php echo $value->name; ?></span>
						</div>


					<?php endforeach ?>
				</div> -->
			</div>


					<?php
				$transactions = get_terms(
				array(
					'taxonomy' => 'top_taxonomy',
					'hide_empty' => false,
					 'parent'   => 0,
				)
			); ?>

			<div id="transactions-filter-wrapper" class="transactions filter-section">
				<div class="transaction-info">
					<div class="tansaction-text">
						<h6 class="filter-title"><?php pll_e( 'Utbyten');?></h6>
					</div>
				</div>
				<div id="transaction-buttons" class="transaction-buttons filter-buttons ">
					<?php foreach ($transactions as $key => $value): ?>

						<div class="check-container">

								 <label>
										<input id="transaction-<?php echo $value->slug; ?>" name="<?php echo $value->slug; ?>" class="sub-check" type="checkbox"  data-filter="<?php echo $value->slug; ?>"  ><div><div></div></div>
										<span class="inner-label">
											<?php echo $value->name; ?>
										</span>
								 </label>

						</div>

					<?php endforeach ?>
				</div>
			</div>

			<div class="open-cbx-expanded" style="display: none;">
				<h6 class="filter-title"><?php pll_e( 'Öppet nu');?></h6>

				<div class="toggles-hd">
				  <input type="checkbox" data-filter="open" name="checkbox3" id="checkbox3" class="ios-toggle"/>
				  <label for="checkbox3" class="checkbox-label" data-off="" data-on=""></label>
				</div>
			</div>



<!-- 			<div class="filter-controll-buttons">
				<div class="btn btn-reset"><?php // pll_e( 'Återställ');?></div>
				<div class="btn btn-show-result"><?php // pll_e( 'visa resultaten');?></div>
			</div>			 -->
		</div>


		</div>	 <!-- collapseFilter -->
</div>

<?php get_header(); ?>

<div id="main-content" class="active containter-fluid startpage main-content" style="background-color: <?php the_field('site_main_color_1', 'option'); ?>">

		<div class="row">
			<!-- Get the map -->
			<div class="col-md-4 map-section order-1 order-md-2">
			<!--	<img id="map-splash" src="<?php // echo get_template_directory_uri(); ?>/assets/images/map_splash.png"> -->

					<div id="map-holder-index" class="map-holder show">
							<div id=" " class="the-map desktop show">
								<?php include(locate_template('template-parts/map/smartakartan2.php'));?>
						</div>
					</div>

					<?php // include(locate_template('/template-parts/collection/get-event-buttons.php')); ?>
					<?php include(locate_template('template-parts/content/content-calender.php')); ?>
			</div>


			<div class="col-md-8 container-fluid content-section order-2 order-md-1">



				<div class="only-desktop">
					<!-- Jumbotron DESKTOP -->
					<?php include(locate_template('template-parts/content/content-jumbotron.php'));  ?>
				</div>

				<div id="the-filter" class=" filter-menu" style="background-color: <?php the_field('site_main_color_1', 'option' ) ?>" >
					<div class="">

						<!-- Filter bar -->
						<?php get_template_part('/template-parts/filter/filter-bar'); ?>

					</div>
				</div>



				<div id="list-of-cards" class="container-fluid list-of-cards show">
					<!--<span class="block-title"><?php  pll_e( 'Utforska allt på smarta kartan' );?></span>-->
					<div class="front-divider"></div>

						<?php
						$filterargs = array(
							array(
								'isOnline' => 'on-and-off'
							),
							array(
								'sortBy' => 'random'
							),

							array(
								'transactions' => array()
							),

							array(
								'cat' => array()
							),

							array(
								'isOpen' =>  'all'
							)
						);

						$postHandler = new postHandler();
						$chunks = $postHandler->getFiltered('yes', $filterargs);
						?>


						<script type="text/javascript">
							var chunks = <?php echo json_encode($chunks); ?>;
						</script>

					<div class="grid">

						<div id="grid-sizer" class="grid-sizer"></div>


						<?php foreach ($chunks[0] as $key => $value): ?>

							<?php $post = get_post($value);

							if ($post->post_type == 'post'): ?>

	  						<?php include(locate_template('template-parts/content/content-shop.php'));?>

							<?php

							// elseif ($post->post_type  == 'page'):

							// 	include(locate_template('template-parts/content/content-collection.php'));

							// elseif ($post->post_type == 'blogg'):



							elseif ($post->post_type == 'story'):


								include(locate_template('template-parts/content/content-story.php'));


							elseif ($post->post_type == 'blogg'):

								//include(locate_template('template-parts/content/content-blog.php'));

							endif; ?>

						<?php endforeach ?>

						<div id="before"></div>

					</div> <!-- grid -->

				</div> <!-- #list-of-cards-->

					<div class="load-more-holder"> <!-- grid-item grid-item--width2 text-center -->

							<button id="load-more" class="btn btn-load-more mtb-3" style="background-color: <?php the_field('site_main_color_5',  'option' ) ?>; color: <?php the_field('site_main_color_6',  'option' ) ?>"><?php pll_e( 'Visa Fler');?></button>

						<!-- 	<button id="filter-more"><?php // pll_e( 'Visa Fler');?></button> -->

					</div>

				<div class="only-mobile">
					<!-- Event Slider -->
					<?php get_template_part('/template-parts/collection/event-slider'); ?>

				</div>


				<!-- Collection Slider DESKTOP-->
				<div class="row only-desktop">
					<div class="col-12">
						<div class="collection-slider">
							<?php get_template_part('/template-parts/collection/collection-slider'); ?>
						</div>
					</div>
				</div>

				<!-- Collection Slider  MOBILE -->
				<div class="row only-mobile">
					<div class="col-12  pl-0">

						<div class="collection-slider mt-2">
							<?php get_template_part('/template-parts/collection/collection-slider'); ?>
						</div>
					</div>
				</div>


			</div>  <!-- col-md-8 -->

	</div>  <!-- row -->

</div> <!-- main-content -->

<?php get_footer(); ?>

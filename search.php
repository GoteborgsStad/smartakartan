<?php get_header(); ?>

<!-- Get the map -->

<!-- <?php $options_page_id = get_option('page_on_front'); ?> -->
<?php $search_results = array(); ?>
<?php  if ( have_posts() ):?>
	<?php while ( have_posts() ) : the_post(); ?>
			<?php $the_id = get_the_ID($post); ?>
			<?php array_push($search_results, $the_id); ?>
		<?php endwhile ?>
<?php endif ?>

<script type="text/javascript">
		searchResults = <?php echo json_encode($search_results)?>;
</script>

<div id="search-template" class="container-fluid active main-content search-template">

	<div class="row">
		<div class="col-md-4 map-section order-1 order-md-2">
				<div id="map-holder-index" class="map-holder show">
						<div id=" " class="the-map desktop show">
							<!-- Get the map -->
							<?php include(locate_template('template-parts/map/smartakartan2.php'));?>
					</div>
				</div>
				<?php // include(locate_template('/template-parts/collection/get-event-buttons.php')); ?>
				<?php //include(locate_template('template-parts/content/content-calender.php'));  ?>
		</div>

		<div class="col-md-8 container-fluid content-section order-2 order-md-1">

		 	<div class="jumbotron sk-hero-container " style="background-color: <?php the_field('site_main_color_2', 'option') ?>">
		 		<span class="search-text"><?php pll_e('Sökresultat för'); ?>: </span><span class="search-term"><?php echo $wp_query->query['s']; ?></span>

			</div>

				<div id="the-filter" class=" filter-menu" style="background-color: <?php the_field('site_main_color_1', 'option' ) ?>" >
					<div class="test">

						<!-- Filter bar -->
						<?php get_template_part('/template-parts/filter/filter-bar'); ?>

					</div>
				</div>

				<?php if(count($search_results) == 0){
					echo '';
				}else{ ?>
					<div id="list-of-cards" class="container-fluid list-of-cards show">

							<?php $filterargs = array(
									array(
										'isOnline' =>  'on-and-off'
									),
									array(
										'sortBy' =>  'random'
									),
								array(
									'transactions' => array('byta', 'dela', 'gefa', 'hyra', 'lana')
								),
									array(
										'cat' => array('kunskap', 'mat', 'moten', 'saker', 'transport', 'yta')
									),
									array(
										'isOpen' =>  'all'
									)
							); ?>

							<?php $filterargs = array(); ?>

							<?php $postHandler = new postHandler(); ?>
							<?php $chunks = $postHandler->getFiltered('no', $filterargs, $cat = 0, $search_results); ?>


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
									elseif ($post->post_type  == 'page'):

										include(locate_template('template-parts/content/content-collection.php'));

									elseif ($post->post_type == 'blogg'):

										include(locate_template('template-parts/content/content-story.php'));

									endif; ?>

								<?php endforeach ?>

								<div id="before"></div>

							</div> <!-- grid -->

							<div class="grid-item grid-item--width2 text-center">

									<button id="load-more" class="btn btn-load-more"><?php pll_e( 'Visa Fler');?></button>

								<!-- 	<button id="filter-more"><?php // pll_e( 'Visa Fler');?></button> -->

							</div>

						</div> <!-- #list-of-cards-->
			<?php	}?>


		</div>  <!-- col-md-8 -->

	</div>  <!-- row -->

</div> <!-- main-content -->

<?php get_footer(); ?>

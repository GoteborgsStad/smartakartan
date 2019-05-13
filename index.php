<?php get_header(); ?>

<!-- Get the map -->

<div id="main-content" class="active containter-fluid startpage main-content">
	
		<div class="row">
			
			<div class="col-md-4 map-section order-1 order-md-2"">
					<div id="map-holder-index" class="map-holder show">
							<div id=" " class="the-map desktop show">
								<!-- Get the map -->
								<?php include(locate_template('template-parts/map/smartakartan.php'));?>
						</div> 
					</div>
					<?php // include(locate_template('/template-parts/collection/get-event-buttons.php')); ?>
					<?php include(locate_template('template-parts/content/content-calender.php'));  ?>
			</div>	
			
			
			<div class="col-md-8 container-fluid content-section order-2 order-md-1">
				
				<!-- Collection Slider  MOBILE -->
				<div class="row only-mobile">
					<div class="col-12">
						
						<div class="collection-slider">
							
							<?php get_template_part('/template-parts/collection/collection-slider'); ?>
						</div>						
					</div>
				</div>
				
				<div class="only-desktop">
		
					<?php include(locate_template('template-parts/content/content-jumbotron.php'));  ?>
				</div>
				
				<div id="the-filter" class=" filter-menu">
					<div class="">

						<!-- Filter bar -->
						<?php get_template_part('/template-parts/filter/filter-bar'); ?>

					</div>
				</div>	

				<!-- Collection Slider DESKTOP-->
				<div class="row only-desktop">
					<div class="col-12">
						<div class="collection-slider">
							<?php get_template_part('/template-parts/collection/collection-slider'); ?>
						</div>						
					</div>
				</div>

				<div id="list-of-cards" class="container-fluid list-of-cards show">
					<span class="block-title"><?php  pll_e( 'Utforska allt på smarta kartan' );?></span>
					
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
						
						<?php $postHandler = new postHandler(); ?>
						<?php $chunks = $postHandler->getFiltered('no', $filterargs); ?>



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

				<div class="only-mobile">
					<!-- Event Slider -->
					<?php get_template_part('/template-parts/collection/event-slider'); ?>
					
				</div>		
			
			</div>  <!-- col-md-8 -->
			
	</div>  <!-- row -->

</div> <!-- main-content -->

<?php get_footer(); ?>
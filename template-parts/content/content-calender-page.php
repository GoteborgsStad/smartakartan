<?php
/**
 * The template used for displaying the event list
 *
 * @package
 */
?>

<?php $cal = get_posts( array(
	'post_type' => 'calender_post_type',
	'meta_key'   => 'startdate_t',
	'orderby'    => 'meta_value_num',
	'post_status' => 'publish',
	'order' => 'ASC',
	'posts_per_page'=>-1,
	'numberposts'=>-1,
	'meta_query' => array( // WordPress has all the results, now, return only the events after today's date
	  array(
	      'key' => 'startdate_t', // Check the start date field
	      'value' => date("Ymd"), // Set today's date (note the similar format)
	      'compare' => '>=', // Return the ones greater than or equal to today's date
	      'type' => 'DATE' // Let WordPress know we're working with date
	  )
	)
 )); ?>
 <?php $options_page_id = get_option('page_on_front'); ?>

<?php $events_list = array(); ?>
<?php $i = 0; ?>
<?php foreach ($cal as $key => $value): ?>

	<?php $event_id = $value->ID; ?>
	<?php $event_name = get_the_title($event_id); ?>
	<?php $the_day = get_field('startdate_t', $event_id ); ?>

	<?php $start_hour = get_field('start_time', $event_id );  ?>
	<?php //var_dump($the_day); ?>
	<?php $month = date("m", strtotime($the_day)); ?>

	<?php $day = date("d", strtotime($the_day)); ?>

	<?php //var_dump($day); ?>

	<?php $details = array(); ?>
	<?php $details['id'] = $event_id; ?>
	<?php $details['m'] = $month; ?>
	<?php $details['d'] = $day; ?>
	<?php $details['name'] = $event_name ; ?>
	<?php $details['time'] = $start_hour ; ?>
	<?php  $events_list[$the_day][$i]  = $details; ?>
	<?php $i++; ?>

<?php endforeach ?>
<!-- <h1>events list</h1> -->



<div class="container-fluid events-list">
	<div class="row">
		<div class="col-12">
				<header style="">
					<h1 class="calender-title"><?php the_title(); ?></h1>
						<?php the_content(); ?>
						<div class="event-filter">
							<span><?php pll_e('Go to'); ?><br></span>

							<?php
								$data = array();

								foreach ($events_list as $key => $value) {
									$datums = [];
								 	$date = date("M", strtotime($key));

								 	if (!isset($data[$date])) {
								 		$data[$date] = [];
								 	}
								 	foreach ($value as $day) {
								 		$datum = $day['d'];

								 		if (in_array($datum, $datums)) {
								 			continue;
								 		}
								 		$theday = intval($day['d']);
								 		$theday = sprintf("%02d", $theday);
								 		array_push($data[$date], $theday);
								 		$datums[] = $datum;
								 	}
								}
							?>
							<select id="month">
								<?php foreach ($data as $key => $value): ?>
									<option value="<?php echo $key; ?>">
										<?php pll_e( $key ); ?>
									</option>
								<?php endforeach ?>
							</select>

							<select id="day">
								<?php
									// Get the first day in array
									$first_date = reset($data);
									$first_day = $first_date[0];
								 ?>
								<option value=""><?php echo $first_day; ?></option>

							</select>
						</div>

				</header><!-- .entry-header -->
		</div>
	</div>
	<div class="row the-content-row">
		<div class="col-md-8 no-padding">
			<article id="post-<?php the_ID(); ?>" class="content-calender-page">



				<div class="entry-content">

					<?php foreach ($events_list as $key => $date): ?>

						<section id="<?php echo $details['id'];  ?>" class="event-day">
							<?php $forID = date("dM", strtotime($key)); ?>

							<div id="<?php echo $forID; ?>" class="date make-me-sticky">
								<span>
									<?php echo date("d", strtotime($key)); ?>
									<?php pll_e( date("M", strtotime($key)) ); ?>
								</span>
							</div>

							<div class="event-item-holder">
								<?php foreach ($date as $key2 => $details): ?>

									<a href="<?php the_permalink($details['id']); ?>" aria-label="Event">

										<div class="event-item" style="background-color: <?php the_field('calendar_item_background_color', 'option' ) ?>">
											<?php $event_thumb = get_the_post_thumbnail_url($details['id']);  ?>
											<?php $bg_style = ''; ?>
											<?php if (!$event_thumb) {
												$event_thumb = get_template_directory_uri().'/dist/images/smarta-kartan-logo-white.png';
												$bg_style = 'background-size: contain';
											} ?>

											<div class="event-thumb" style="background-image: url('<?php echo $event_thumb; ?>'); <?php echo $bg_style; ?>">

											</div>

											<div class="event-details">
												<h5><?php echo get_the_title($details['id']);  ?></h5>
												<?php $date = get_field('startdate_t', $details['id'] ); ?>
												<h6>
													<?php pll_e( date("M", strtotime($date)) ); ?>
													<?php echo date("d", strtotime($date)); ?><?php if (get_field('start_time', $details['id'] )): ?><?php echo ', '; ?><?php the_field('start_time', $details['id'] ); ?>
												<?php endif ?>
												</h6>

												<?php if (get_field('street_address', $details['id'] )): ?>
													<h6><?php the_field('street_address', $details['id'] ); ?></h6>
													<h6><?php the_field('city', $details['id'] ); ?></h6>
												<?php endif ?>

											</div>

										</div>

									</a>

								<?php endforeach ?>
							</div>


						</section>

					<?php endforeach ?>


				</div><!-- .entry-content -->

			</article><!-- #post-## -->

		</div> <!-- col-md-8 -->

      <div class="col-12 col-md-4 only-desktop side-panel">

          <!-- get sidebar -->
          <?php include(locate_template('/template-parts/sidebar.php'));?>

      </div>   <!-- col-12 col-md-4 -->

	</div>

</div>

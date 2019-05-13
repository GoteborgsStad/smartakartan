<a href="<?php echo $link; ?> " class="btn-sk btn-event btn" style="background-color: <?php the_field('calendar_item_background_color', 'option' ) ?>" aria-label="Event">
	<?php $options_page_id = get_option('page_on_front'); ?>
	<div class="event-date">
		<?php $eventID =  $value->ID ?>
		<?php $date = get_field('startdate_t', $eventID); ?>
		<div class="month"><?php pll_e( date("M", strtotime($date)) ); ?></div>
		<div class="day"><span><?php  echo date("d", strtotime($date)); ?></span></div>
	</div>

	<div class="event-details" style="color: <?php the_field('calendar_item_text_color', 'option' ) ?>">
		<h4 class=""><?php echo $value->post_title; ?></h4>
		<h6 class=""><?php the_field('location',$eventID); ?></h6>
		<!--<h6 class="">read more <i class="fa fa-angle-right"></i></h6>-->
	</div>

</a>

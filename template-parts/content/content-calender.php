<?php
/**
 * @package
 * Template for calender sidebar
 */
?>

<div class="calender-list-holder">
	<?php $options_page_id = get_option('page_on_front'); ?>
	<div class="col-12 calender-list-header">
		<div class="calender-title">
			<h1><?php pll_e( 'Kalender');?></h1>
		</div>
		<div class="calender-current-datum">
			<h4><?php echo date("d"); ?> / <?php pll_e( date("M")); ?></h4>
		</div>
	</div>

	<div class="calender-list-body">

	<?php  include(locate_template('/template-parts/collection/get-event-buttons.php')); ?>

	</div> <!-- .calender-list-body -->
	<a href="<?php echo get_site_url(); ?>/kalender" aria-label="Calendar">
		<div class="calendar-more">
		<h4 class="calendar-more-text"><?php pll_e( 'Visa Fler');?></h4><span class="see-more-arrow"><i class="fa fa-arrow-right"></i></span>
	</div>
	</a>
</div><!--  .calender-list-holder -->

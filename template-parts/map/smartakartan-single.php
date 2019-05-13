<?php $postArray = array(); ?>
<?php $allArray = array(); ?>
<?php $postType = get_post_type() ;?>
<?php $category = get_the_category();?>
<?php $icon_term = $category[0]->term_id; ?>
<?php $icon = get_field('category_icon', 'category_'.$icon_term); ?>

<?php //Get Single Post data if on Single post ?>
<?php $singleArray = array(); ?>
<?php if( ($postType == 'post' || $postType == 'calender_post_type' ) && get_field('street_address') && get_field('city')):?>


<?php $multiple = get_field('multiple'); ?>
<?php $coordinates = get_field('coordinates'); ?>

	<?php
	$object = new stdClass();
	$object->title = get_the_title();
	$object->street = get_field('street_address');
	$object->city = get_field('city');
	$object->link = get_the_permalink();
	$object->excerpt = get_the_excerpt();
	$object->icon = $icon;

	$object->lon = get_field('post_lon');
	$object->lat = get_field('post_lat');
	$object->display_name = get_field('post_display_name');

	if($multiple){
		$object->multiple = $multiple;
	}
	if($coordinates){
		$object->coordinates = $coordinates;
	}

	array_push($singleArray, $object); ?>

	<p class="test-posts" data-address="<?php echo get_field('street_address'); ?>" data-city="<?php echo get_field('city'); ?>" data-title="<?php the_title(); ?>" data-link="<?php the_permalink(); ?>" data-excerpt="<?php the_excerpt(); ?>" data-slug="post" style="display: none"><?php the_title(); ?>
	<span class="distance"></span></p>

<?php endif ?>

<!-- Show the map -->
<div class="map-wrapper">
	<div id="mapid2" style="width: 100%; height: 450px;"></div>
</div>


<?php if(get_field('instagram_feed')): ?>
	<?php $insagram_user_name = get_field('instagram_feed') ?>
	<?php else: ?>
		<?php $insagram_user_name = ''; ?>
<?php endif; ?>

<script>
	window.singleArray = <?php echo json_encode($singleArray)?>;
</script>

<style media="screen">
	div.map-wrapper{
		position: relative;
	}

	div.add-post{
		position: absolute;
		border-radius: 50%;
		background-color: #64c153;
		width: 40px;
		height: 40px;
		right: 40px;
		bottom: 40px;
		z-index: 999999;
		cursor: pointer;
		border: 3px solid white;
	}
</style>

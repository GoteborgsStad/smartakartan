<?php $lang = pll_current_language(); ?>
<?php $supergroups = get_pages(array('meta_key' => 'create_supergroup', 'lang' => $lang)); ?>
<?php $allgroups = get_pages(array(
	'meta_key' => 'create_supergroup',
	'lang' => $lang)); ?>

<?php if($supergroups): ?>
	<div class="block-header">
		<span class="block-title"><?php  pll_e( 'Dela, låna, byta, ge/få eller hyr!' );?></span>

	</div>

	<div id="collection-menu" class="scroll-menu ">
		<!--<div id="scroll-left" class="scroll-left">left</div> -->
		<div class="buttons scroll-y">
			<!-- 		get collections -->
			<?php include(locate_template('/template-parts/collection/get-collection-buttons.php')); ?>
			<p class="bullets">...</p>
		</div>
<!-- <div id="scroll-right" class="scroll-right">right</div> -->
	</div>
<?php endif; ?>

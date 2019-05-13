<?php $jumbotron = get_field('jumbotron', 'option'); ?>
 <div class="jumbotron sk-hero-container" style="background-color: <?php echo $jumbotron['jumbotron_background_color'];?>; color: <?php echo $jumbotron['jumbotron_text_color'];?>">

 	<?php get_the_content($options_page_id ); ?>
 	<?php 
	 	$content_post = get_post($options_page_id);
		$content = $content_post->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
 	 ?>
	<?php echo $content; ?>

</div> 






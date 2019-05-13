<?php
/**
 * The Template for displaying all single posts.
 *
 * @package 
 */
?>

<?php get_header(); ?>

<div class="">
	<?php get_template_part( 'template-parts/content/content', 'single-event' ); ?>
</div>

<div class="only-desktop">
	<?php //get_template_part( 'template-parts/content/content', 'single-desktop' ); ?>	
</div>


<?php get_footer(); ?>

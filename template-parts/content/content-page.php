<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-post-id="<?php the_ID(); ?>">

	<header>
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<div class="entry-content-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>

		<?php the_content(); ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', '_tk' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->


</article><!-- #post-## -->

<div class="frame-drop">
	<div class="close-out">Validera och stäng kartfönster</div>
	<iframe src="https://nominatim.openstreetmap.org/search.php"></iframe>
</div>

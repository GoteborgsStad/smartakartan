
<?php /* Template Name: Form Layout */ ?>

<?php get_header(); ?>
<div id="main-content" class="active">
<section class="form-template">

	<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php $img = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
				<?php $color = get_field('accent_color');?>

			<div class="form-header" style="background-image: url('<?php echo $img ?>'); position: relative;" >
				<div class="form-gradient" style="background: linear-gradient(transparent, <?php echo $color ?>); ">
					<h2><?php the_title(); ?></h2>
				</div>
			</div>

			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<?php the_content(); ?>
					</div>
				</div>
			</div>

			<style>
			.wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]{
				background-color: <?php echo $color ?>!important; }
			</style>


			<?php endwhile; ?>
	<?php endif; ?>

</section>


<?php get_footer(); ?>

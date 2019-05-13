
<?php get_header(); ?>

<div class="container-fluid archive-wrapper">
  <div class="row">
    <div class="col-lg-6 offset-lg-3">
      <h1>#<?php single_term_title();?></h1>
      <br>
      <br>
      <?php
      if ( have_posts() ) {
      	while ( have_posts() ) {
      		the_post();?>

          <div class="row archive-item">
            <a href="<?php the_permalink(); ?>">
              <h2><?php the_title(); ?></h2>
              <img src="<?php the_post_thumbnail_url(); ?>" alt="post thumnail">
              <p><?php the_excerpt(); ?></p>
            </a>
          </div>
      	<?php }
      }else{?>

        <div class="row archive-item">
            <h2><?php pll_e( 'ingen träff');?></h2>
        </div>

        <?php
      }
      ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>

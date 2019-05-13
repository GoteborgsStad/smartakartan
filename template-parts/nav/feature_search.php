<div id="feature-search" class="container-fluid">

  <div class="search-field">
    <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
<!--     <form method="get" action="<?php  echo esc_url( home_url( '/' ) ); ?>" class="search-form"> -->
      <select class="search-select d-none d-md-inline-block">
        <option value=""><?php pll_e( 'alla' );?></option>
        <?php
          $search_categories = get_categories( array(
          'orderby' => 'name',
          'order'   => 'ASC',
          'hide_empty'       => 1,
          ) );
        ?>

        <?php  foreach( $search_categories as $category ): ?>
          <?php $par = get_category_parents($category->term_id); ?>
          <option value="<?php echo $category->term_id; ?>"><?php echo $par ?></option>
        <?php endforeach;  ?>

      </select>

      <input class="cat-filter" type="hidden" name="cat" id="cat" value="" />
<!--       <input type="text" placeholder="                Search" size="16" name="s" value="" class="search-input-field" /> -->
      <!--<input type="submit" value="Go" />-->
     </form>

      <div id="close-out" class="close">X</div>

  </div>

  <div class="d-block d-md-none">
    <?php //get_search_form(); ?>
  </div>

  <?php
  $args = array(
      'post_type' => 'page',
      'posts_per_page' => 5,
      'meta_key' => '_wp_page_template',
      'meta_value' => 'collection.php'
      ); ?>

  <div class="row">

    <div class="col-md-8  search-collections">

       <h4><?php pll_e( 'Höjdpunkter');?></h4>

      <div class="row">


        <?php  $collections = new WP_Query( $args );?>

          <?php while ( $collections->have_posts() ) : $collections->the_post(); ?>

            <?php $img = get_the_post_thumbnail_url(get_the_ID(),'medium'); ?>
            <?php $short = get_field('short_name'); ?>

            <a href="<?php the_permalink();?>" class="col-6 col-md-6"  aria-label="Search in collections">
              <div class="search-collection" style="background-image: url('<?php echo $img ?>')">
                <span><?php echo $short; ?></span>
              </div>
           </a>

          <?php endwhile; ?>

        <?php wp_reset_query(); ?>

          <a href="<?php echo get_site_url().'/kollektioner/'; ?>" class="col-6 col-md-6" aria-label="See more">
            <div class="search-collection see-more col-6">
                <?php pll_e( 'Visa Fler');?>
            </div>
          </a>

      </div>
    </div>

    <div class="col-md-4">
       <div class="popular-searches">
        <h4><?php pll_e( 'populära sökningar');?></h4>
        <?php
            if (function_exists('sm_list_popular_searches')) {
            sm_list_popular_searches();
            }
         ?>
      </div>
    </div>
  </div>

</div> <!-- #feature-search -->

<script type="text/javascript">
  window.addEventListener('load', function(){
    var searchSelect = document.querySelector('select.search-select');
    var filter = document.querySelector('input.cat-filter');
    var closeOut = jQuery('#close-out');
    //var searchModule = document.querySelector('#feature-search');
    var searchModule = jQuery('#feature-search');
   // var trigger = document.querySelector('.footer-search');
    var trigger = jQuery('.footer-search');
    var moreModule = jQuery('#feature-more-menu');

    var trigger2 = jQuery('.header-search');
    //var trigger = document.querySelector('input.form-control');

    trigger.on('click', function(e){
      e.preventDefault();
      searchModule.toggleClass('active');
      moreModule.removeClass('active');
    })

    trigger2.on('click', function(e){
       e.preventDefault();
      searchModule.toggleClass('active');
      moreModule.removeClass('active');
    })

    closeOut.on('click', function(e){
      e.preventDefault();
      searchModule.removeClass('active');
    })

    searchSelect.addEventListener('change', function(e){
      filter.value = e.currentTarget.value;
    });

  })

</script>

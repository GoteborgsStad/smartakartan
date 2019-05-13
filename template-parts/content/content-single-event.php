<?php
/**
 * @package
 * Single Event
 */
?>
<?php while ( have_posts() ) : the_post(); ?>

     <div class="container-fluid content-single content-single-event">
         <div class="row">

           <div class="only-mobile">
                  <?php $event_thumb = get_the_post_thumbnail_url();  ?>
                    <?php if (!$event_thumb) {
                        $event_thumb = get_template_directory_uri().'/dist/images/smarta-kartan-logo.png';
                        } ?>
                        <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="post thumbnail">
                  <!-- <div class="post-cover-image" style="background-image: url(  <?php // echo $event_thumb ?> )">
                 </div> -->
           </div>

              <div class="col-md-8">

              <div class="only-desktop">
                <?php $event_thumb = get_the_post_thumbnail_url();  ?>
                <?php if (!$event_thumb) {
                    $event_thumb = get_template_directory_uri().'/dist/images/smarta-kartan-logo.png';
                    } ?>
                <div class="post-cover-image" style="background-image: url(  <?php  echo $event_thumb ?> )">
                </div>
              </div>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <header>

                          <div class="event-header ">

                             <div class="event-date">
                                 <?php $date = get_field('startdate_t'); ?>
                                    <div class="month">
                                      <?php pll_e( date("M", strtotime($date)) ); ?>
                                    </div>
                                    <div class="day">
                                      <span>
                                        <?php  echo date("d", strtotime($date)); ?>
                                      </span>
                                    </div>
                            </div>

                            <div class="event-description">
                                 <h1 class="page-title"><?php the_title(); ?></h1>
                                <?php the_content(); ?>
                            </div>

                          </div>

                          <hr>

                        <div class="event-data">

                          <h4><?php pll_e( 'Datum');?></h4>
                          <div class="event--the-date">
                            <?php echo date("Y", strtotime($date)); ?>
                            <?php pll_e( date("M", strtotime($date)) ); ?>
                            <?php echo date("d", strtotime($date)); ?>
                            <?php if(get_field('enddate')){
                              $enddate = get_field('enddate');
                              echo ' - ' . date("Y M d", strtotime($enddate));
                            }?>
                          </div>

                          <?php if(get_field('start_time')){ ?>
                            <h4><?php pll_e( 'Tid' ) ?></h4>
                            <div>
                              <?php the_field('start_time'); ?>
                            </div>
                          <?php }; ?>


                            <?php if(get_field('duration')){ ?>
                              <h4><?php pll_e( 'Längd' ) ?></h4>
                              <div>
                                <?php the_field('duration'); ?>
                              </div>

                            <?php };?>

                          <div class="event-location">
                            <br>
                            <h4><?php pll_e( 'Adress');?></h4>
                            <div class="event-place">
                              <?php the_field('location') ?>
                            </div>
                          </div>
                          <div class="event-address">
                            <?php the_field('street_address'); ?>,
                            <?php the_field('city'); ?>
                          </div><br>
                          <h4><?php pll_e( 'Kontakt');?></h4>
                          <?php the_field('avsandare'); ?><br>
                          <?php the_field('tel'); ?>
                          <br>
                          <?php if(get_field('organizer')){ ?>

                            <div class="event-external-link">
                                <a style="background-color: <?php the_field('calendar_item_background_color', 'option' ) ?>" class="event-link" href="<?php the_field('organizer'); ?>" target="_blank" aria-label="Event link"><?php pll_e( 'till organisatören');?></a>
                            </div>

                          <?php }; ?>

                          <?php if(get_field('event_link_url')){ ?>

                            <div class="event-external-link">
                                <a style="background-color: <?php the_field('calendar_item_background_color', 'option' ) ?>" class="event-link" href="<?php the_field('event_link_url'); ?>" target="_blank" aria-label="Event link"><?php pll_e( 'till eventet');?></a>
                            </div>

                          <?php }; ?>

                        </div>

                    </header><!-- .entry-header -->

                    <hr>

                    <div class="entry-content">
                      <!--
                        <h4><?php pll_e( 'Detailer');?></h4>
                        <?php echo get_the_content(); ?>
                      -->
                    </div><!-- .entry-content -->

                </article><!-- #post-## -->

                </div> <!-- col md 8 -->

                <div class="col-md-4">
                            <div class="map-holder show">
                            </div>
                    <div class="the-map">

                        <?php include(locate_template('/template-parts/map/smartakartan-single.php')); ?>
                    </div>
                </div>  <!-- col-md- -->

        </div>  <!-- row -->

    </div> <!-- .container-fluid -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 alike-shops">
                <h5><?php pll_e( 'Flera Evenemang');?></h5>
                <?php get_template_part('/template-parts/collection/event-slider'); ?>
            </div>
        </div>
    </div>

<?php endwhile;  ?>

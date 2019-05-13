<?php
/**
 * @package
 */
?>

<?php while ( have_posts() ) : the_post(); ?>

    <div class="content-single single-initiative">
      <div class="container-fluid ">

        <div class="row">
          <?php $ID = get_the_ID(); ?>
          <?php if(get_the_post_thumbnail_url($ID )): ?>
            <?php $card_bg_image_url = get_the_post_thumbnail_url($ID ); ?>
          <?php else: ?>
            <?php $card_bg_image_url = get_template_directory_uri().'/dist/images/placeholder-img.png'; ?>
          <?php endif; ?>

          <div class=" post-cover-image only-mobile" style="background-image: url(  <?php  echo $card_bg_image_url; ?>  )">
          </div>

          <!-- details -->
          <div class="col-12 details">

           <div class="category-name">
            <?php $the_category = get_the_category(); ?>
            <?php if (!empty($the_category)): ?>
               <?php $category_parent = $the_category[0]->category_parent; ?>

               <?php if ($category_parent != 0): ?>
               <?php $the_parent_category = get_the_category_by_ID($category_parent ); ?>
                  <?php if($the_category[0]->term_id != 1 ): ?>

              <span>
                <a href="<?php  echo get_term_link($category_parent); ?>" aria-label="Category parent"><?php echo $the_parent_category; ?></a> / <a href="<?php echo get_term_link($the_category[0]->term_id); ?>" aria-label="Category"><?php echo $the_category[0]->name; ?></a>
              </span>
              <?php endif; ?>
            <?php endif; ?>


            </div>
               <?php endif; ?>

            <div id="dist" class="distance"></div>
          </div>

          <div class="col-12 article-title">
            <h1 class="page-title"><?php the_title(); ?></h1>
            <h5><?php the_field('underrubrik'); ?></h5>
          </div>

          <div class="col-12 only-mobile share-on-social-mobile">
            <!-- link-buttons -->
            <?php include(locate_template('/template-parts/components/share.php')); ?>
            <div class="share-on-social-container" style="background-color: <?php the_field('site_main_color_4', 'option'); ?>">
              <span id="share-close">x</span>
              <!-- Social share template:  -->
             <span class="share-text"><?php pll_e( 'Dela verksamhet');?></span>
             <span class="share-text-sociala-medier"><?php pll_e( 'Sociala medier');?></span>
            <?php smartakartan_share_buttons(); ?>
            </div>

          </div>

          <div class="col-md-7">
            <!-- Thumbnail image -->
            <div class=" post-cover-image only-desktop" style="background-image: url(  <?php  echo get_the_post_thumbnail_url(); ?>  )">
            </div>

            <div class="only-desktop">

              <!-- .entry-content -->
             <div class="entry-content">
                <?php the_content(); ?>
              </div>

             <p><strong><?php pll_e( 'Senast uppdaterad:');?></strong> <?php the_modified_date('d-m-Y'); ?></p>

                <!-- clame -->
              <div class="col-md-5 changes only-mobile" >
                   <?php include(locate_template('/template-parts/components/initiativ-buttons.php')); ?>
                </div>

                <!--  tags r-->
              <div class="buttons scroll-y only-desktop">
                 <?php include(locate_template('/template-parts/components/initiative-tags.php')); ?>
               </div>

              <article id="post-<?php the_ID(); ?>">
               </article><!-- #post-## -->

             </div>

           </div>

          <div class="col-md-5">
            <!--  initiative map -->
            <div class="map-holder show">
              <?php include(locate_template('/template-parts/components/initiative-map.php')); ?>

              <div class="desktop_address_wrapper">
                <?php if(get_field('street_address', $itemID)){
                    echo '<p>' . get_field('street_address', $itemID)  . '<br>' . get_field('city', $itemID) . '</p>'; } ?>
              </div>

              <div class="only-desktop">
                <!-- Opening hours -->
                <?php include(locate_template('/template-parts/components/opening-hours.php')); ?>
              </div>

              <div class="only-desktop">
                <div class="col-12  share-on-social-mobile">
                  <!-- link-buttons -->
                  <?php include(locate_template('/template-parts/components/share.php')); ?>
                  <div class="share-on-social-container" style="background-color: <?php the_field('site_main_color_4', 'option'); ?>">
                    <span id="share-close">x</span>
                      <!-- Social share template:  -->
                    <span class="share-text"><?php pll_e( 'Dela verksamhet');?></span>
                    <span class="share-text-sociala-medier"><?php pll_e( 'Sociala medier');?></span>
                    <?php smartakartan_share_buttons(); ?>
                  </div>

                </div>
              </div>

              <div class="only-mobile">
               <?php if(get_field('street_address')): ?>
                 <div class="address-navigation">
                     <div class="address-single">
                        <?php the_field('street_address') ?>,<br>
                        <?php the_field('city') ?>
                     </div>

                     <div class="addres-direction direction">
                         <a href="https://www.google.com/maps/dir//<?php the_field('street_address') ?>,<?php the_field('city') ?>" target="_blank"><?php pll_e( 'Vägbeskrivning');?>
                         </a>
                     </div>
                 </div>
               <?php endif ?>
             </div>

             <div class="changes only-desktop" >
               <?php include(locate_template('/template-parts/components/initiativ-buttons.php')); ?>
             </div>
            </div>
          </div>

         <div class="col-12 only-mobile">

           <!-- Opening hours -->
           <?php include(locate_template('/template-parts/components/opening-hours.php')); ?>

           <!-- .entry-content -->
           <div class="entry-content">
             <span class="block-title"><?php pll_e( 'Detaljer');?></span>
              <?php the_content() ; ?>

              <?php if ( get_field('e-mail') ): ?>
                 <a class="content_mail" href="mailto::<?php the_field('e-mail') ?>" aria-label="e-mail"><span><?php pll_e('Mejl'); ?></span></a>
               <?php endif; ?>
               <?php if ( get_field('facebook') ): ?>
               <?php $url_fb = get_field('facebook');
               //$url_fb = addhttp($url_fb); ?>
                  <a class="content_facebook" href="<?php echo $url_fb ?>" aria-label="Facebook"><span>Facebook</span></a>
              <?php endif; ?>
            </div>
 
         </div>

         <div class="col-md-7 only-moblie">
           <!-- clame -->
          <div class="col-md-5 changes only-mobile" >
             <?php include(locate_template('/template-parts/components/initiativ-buttons.php')); ?>
          </div>

          <!--  tags  e-->
          <div class="buttons scroll-y only-mobile">
           <?php include(locate_template('/template-parts/components/initiative-tags.php')); ?>
          </div>
         </div>

         <div class="col-md-7 only-mobile">

           <!-- instagram -->
           <?php //include(locate_template('/template-parts/components/instagram-images.php')); ?>

           <article id="post-<?php the_ID(); ?>"></article><!-- #post-## -->

         </div> <!-- col-12-->

        </div> <!-- row -->
     </div> <!-- containter fluid -->
   </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-7">
                   <!-- instagram -->
              <?php include(locate_template('/template-parts/components/instagram-images.php')); ?>
        </div>
      </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 alike-shops">
	            <?php $currentlang = get_bloginfo('language');
				          if($currentlang=="sv-SE"): ?>
					             <h5>Liknande Initiativ</h5>
	                    <?php elseif($currentlang=="en-GB"): ?>
                	       <h5>Similar Initiatives</h5>
                  <?php endif; ?>

                <?php include(locate_template('/template-parts/content/content-more.php')); ?>
            </div>
        </div>
    </div>

<?php endwhile;  ?>

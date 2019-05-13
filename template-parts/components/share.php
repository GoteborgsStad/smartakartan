<div class="share">

      <?php if ( get_field('website') ): ?>
        <?php $url_website = get_field('website');
       ?>
          <a href="<?php echo $url_website; ?>" target="_blank" aria-label="Facebook">
              <div class="fb">
                  <img src="<?php echo get_template_directory_uri(); ?>/dist/images/icon-web.png" alt="icon-web">
                  <h6><?php pll_e( 'Hemsida');?></h6>
              </div>
          </a>
        <?php endif; ?>

        <?php if ( get_field('instagram_feed') ): ?>
        <?php $insta = get_field('instagram_feed');
       ?>
          <a href="https://www.instagram.com/<?php echo $insta; ?>" target="_blank" aria-label="Instagram">
              <div class="fb">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-instagram.png" alt="icon-instagram">
                  <h6><?php pll_e( 'Instagram');?></h6>
              </div>
          </a>
        <?php endif; ?>

        <?php if ( get_field('facebook') ): ?>
        <?php $facebook = get_field('facebook');
       ?>
          <a href="<?php echo $facebook; ?>" target="_blank"  aria-label="Facebook">
              <div class="fb">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-facebook.png" alt="icon-facebook">
                  <h6><?php pll_e( 'Facebook');?></h6>
              </div>
          </a>
        <?php endif; ?>

        <?php
        if ( get_field('e-mail') ){
          $email = get_field('e-mail');
        }elseif( get_field('e_mail' )){
          $email = get_field('e_mail');
        }?>

       <?php if($email){ ?>
         <a href="mailto:<?php echo $email; ?>" aria-label="E-mail">
             <div class="fb">
                 <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-e-post.png" alt="icon-e-mail">
                 <h6><?php pll_e( 'E-post');?></h6>
             </div>
         </a>
       <?php } ?>



        <?php
            if (get_field('tel')): ?>
              <a href="tel::<?php the_field('tel') ?>" aria-label="Telephone">
                <div id="direction" class="fb direction" >
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-tel.png" alt="icon-telephone">
                    <h6><?php pll_e( 'Telefon');?></h6>
                </div>
            </a>
       <?php endif; ?>

        <div id="share-on-social" class="fb share-on-social" >
            <i class="fa fa-share fa-2x"></i>
            <h6><?php pll_e( 'Dela verksamhet');?></h6>
        </div>
 </div>

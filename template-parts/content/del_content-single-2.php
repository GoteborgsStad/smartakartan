<?php
/**
 * @package
 */
?>

<?php while ( have_posts() ) : the_post(); ?>

    <div class="container-fluid content-single">
         <div class="row">
              <div class="col-md-8 "">
                  
                <!--   jumbotron -->
                <div class="post-cover-image" style="background-image: url(  <?php  echo get_the_post_thumbnail_url(); ?>  )">
                    <?php ?>
                </div>    

                <!-- details -->
                <div class="details">
                    
                    <div class="category-name">
                        <?php the_category( ); ?>
                    </div>
                    <div id="dist" class="distance">
                        
                    </div>
                </div> 
                
                <div class="col-md-12 reset-bootstrap-padding">
                <article id="post-<?php the_ID(); ?>" >
                    
                    <header>
                        
                        <h1 class="page-title"><?php the_title(); ?></h1>
                        <h5><?php the_field('underrubrik'); ?></h5>
                        <div class="share"> 
                            
                        <?php if ( get_field('facebook') ): ?>
                          <?php $url_fb = get_field('facebook'); 
                           //$url_fb = addhttp($url_fb); ?> 
                            <a href="<?php the_field('facebook') ?>" target="_blank" aria-label="Facebook">
                                <div class="fb">
                                    <img src="<?php echo get_template_directory_uri(); ?>/dist/images/icon-facebook.png" alt="icon-facebook">
                                    <h6>Facebook</h6>
                                </div>
                            </a>                           
                        <? endif; ?>
                        <?php if ( get_field('website') ): ?>
                            <?php $url_website = get_field('website'); 
                           ?>
                                <a href="<?php echo $url_website; ?>" target="_blank" aria-label="Website">
                                    <div class="fb">
                                        <img src="<?php echo get_template_directory_uri(); ?>/dist/images/icon-web.png" alt="icon-web">
                                        <h6><?php pll_e( 'Hemsida');?></h6>
                                    </div>
                                </a>
                            <? endif; ?>
                            <?php if ( get_field('e-mail') ): ?>
                                <a href="mailto::<?php the_field('e-mail') ?>" aria-label="E-mail">
                                    <div class="fb">
                                        <img src="<?php echo get_template_directory_uri(); ?>/dist/images/icon-e-post.png" alt="icon-e-mail">
                                        <h6><?php pll_e( 'Mejl');?></h6>
                                    </div>
                                </a>
                            <? endif; ?>
                            <?php 
                                if (get_field('tel')): ?>
                                  <a href="tel::<?php the_field('e-mail') ?>" aria-label="Telephone">
                                    <div id="direction" class="fb direction" >
                                        <img src="<?php echo get_template_directory_uri(); ?>/dist/images/icon-tel.png" alt="icon-telephone">
                                        <h6><?php pll_e( 'Telefon');?></h6>
                                    </div>
                                </a>
                           <?php endif ?>
                        </div>

                    </header><!-- .entry-header -->
                    
                 </article><!-- #post-## -->                    
                </div>
                
                </div>  <!-- col-md-8 -->
                
                <div class="col-md-4 map-holder show">
                    <?php 
                    if (get_field('offline') != 1): ?>
                     <div class="the-map">
                        <?php include(locate_template('/template-parts/map/smartakartan-single.php')); ?>
                    </div>
                    <?php endif ?>

                </div>  <!-- col-md- -->
                
                <?php if(get_field('street_address')): ?>
                <div class="col-md-4">
                    <div class="address-navigation">
                        <div class="address-single">
                           <?php the_field('street_address') ?>,<br>
                           <?php the_field('city') ?>                            
                        </div>
                        <div class="addres-direction direction">
                            <?php pll_e( 'Vägbeskrivning');?>
                        </div>
                    </div>

                </div>
                <?php endif ?>
                
                <div class="col-md-4">
                     <div class="changes only-desktop" >
                     <?php 
                     if ( is_user_logged_in() ): ?>
                         
                         <a href="<?php echo bloginfo('url'); ?>/edit-post/?pid=<?php the_ID();?>" class="btn" aria-label="Change text"><button class="btn sk-button-01"><?php pll_e( 'förbättra denna texten');?></button></a>  
                         
                    <?php else: ?>
                        
                        <a href="<?php echo bloginfo('url'); ?>/foresla-andring-initiativ/?pid=<?php the_ID();?>" class="btn" aria-label="change initiative"><button class="btn sk-button-01"><?php pll_e( 'förbättra denna texten');?></button></a>
                        
                    <?php endif ?>
  
                        <a class="" href="<?php echo bloginfo('url'); ?>/claim-initiativ-form/?initiativ_name=<?php  the_title(); ?>&initiativid=<?php the_ID(); ?>" aria-label="Claim initiative"><button class="btn sk-button-02">"<?php pll_e( 'Claim this initiative');?>"</button></a>
                    
                    </div>                        
                </div>
                
            </div>  <!-- row -->
            
            <div class="row">
         
               <div class="col-md-8">  
                     
                    <div class="opening-hours" data-toggle="collapse" data-target="#collapseHours">
                        <img src="https://via.placeholder.com/30" alt="placeholder-image"> <?php pll_e( 'Öppettider');?> 
                        
                    <!--     <?php// echo "Today is " . date("l H") . "<br>"; ?> -->
                        <?php $hour_now = date("H"); ?>
                        <?php $day = date("l"); ?>
                        <?php $today = strtolower($day); ?>
                        <?php $field_to_check = $today; ?>
                        
                        <!-- 10-17 -->
                        <?php $is_open_today = get_field($field_to_check); ?>
                        

                        <!-- get 10 and 17 -->
                        <?php if ($is_open_today != 'closed' AND !empty($is_open_today) ): ?>
                        
                            <?php list($from, $to) = explode('-', $is_open_today); ?>
                            
                                <!-- Check if it is open today -->
                                <?php if( ($from <= $is_open_today) && ($is_open_today <= $to) ): ?>
                                
                                   <span class="is-open">- <?php pll_e( 'Öppet');?></span> 

                                   
                                <?php endif ?>           
                            
                              <?php elseif(empty($is_open_today)): ?>
                                
                                <span class="is-closed">- no info</span> 
                            
                            <?php else: ?>
                                
                               <span class="is-closed">- <?php pll_e( 'Stängt');?></span>             
                                    
                        <?php endif ?>
                        

                        <div class="collapse" id="collapseHours">
                          <div class="hours">
                                  
                               <span><?php pll_e( 'Måndag:');?> <?php if( !empty(the_field('monday')) ): ?><?php the_field('monday'); ?><?php else: ?>- no info <?php endif ?></span>
                               <span><?php pll_e( 'Tisdag:');?> <?php if( !empty(the_field('tuesday')) ): ?><?php the_field('tuesday'); ?><?php else: ?>- no info <?php endif ?></span>
                               <span><?php pll_e( 'Onsdag');?> <?php if( !empty(the_field('wednesday')) ): ?><?php the_field('wednesday'); ?><?php else: ?>- no info <?php endif ?></span>
                               <span><?php pll_e( 'Torsdag');?> <?php if( !empty(the_field('thursday')) ): ?><?php the_field('thursday'); ?><?php else: ?>- no info <?php endif ?></span>
                               <span> <?php pll_e( 'Fredag');?> <?php if( !empty(the_field('friday')) ): ?><?php the_field('friday'); ?><?php else: ?>- no info <?php endif ?></span>
                               <span><?php pll_e( 'Lördag');?> <?php if( !empty(the_field('saturday')) ): ?><?php the_field('saturday'); ?><?php else: ?>- no info <?php endif ?></span>
                               <span><?php pll_e( 'Söndag');?> <?php if( !empty(the_field('sunday')) ): ?><?php the_field('sunday'); ?><?php else: ?>- no info <?php endif ?></span>
                          </div>
                        </div>
                    </div>                         

                    <div class="entry-content">
                        <?php the_content() ; ?>
                    </div><!-- .entry-content -->
                    
                      <?php $insagram_user_name = get_field('instagram_feed'); ?>
                      
                      <?php  
                        $insta_start  = '@';
                        $pos = strpos($insagram_user_name, $insta_start);
                      ?>
                      
                      <?php if ($pos === 0) {
                        $insagram_user_name = ltrim($insagram_user_name, '@');
                      } ?>
               
                     <?php if(strlen($insagram_user_name)>2): ?>
                    <div class="instagram-images">
                        <h4>Instagram</h4>
                        <div id="instafeed" class="instafeed"></div>
                     
                        <script type="text/javascript">
                            
                           // Instagram test
                            var user = '<?php echo $insagram_user_name; ?>';
                            
                            var feed = document.querySelector('#instafeed');
                            //var counter = 0;
                            axios.get('https://www.instagram.com/' + user).then(result => {
                                var test = result.data;
                                var counter = 0;
                                var regex1 = /},{"src":/g;
                                var regex2 =/,"config_width":640/g;
                                var split = test.split(regex1);

                                var urls = [];

                                split.map(function(url){
                                    if(url.match(regex2)){
                                        urls.push(url.split(regex2)[0]);
                                    }
                                })
                                
                                urls.map(function(img){
                                
                                    var image = document.createElement("img");

                                    var source = img.replace(/"/g, '');
                                    image.src = source;
                                    
                                   
                                    if (counter <=3 ) {
                                    
                                    feed.appendChild(image);  
                                }                                    
                                     counter++;
                                })
                            });
                            
                          </script>
                          
                   </div>
                    <?php endif?>
                            
                  <div class="buttons">
                      
                    <?php $the_tags = get_the_tags(); ?>
                    
                   <?php if ($the_tags): ?>
                        <?php foreach ($the_tags as $key => $value): ?>
                           <a href="<?php echo get_tag_link($value->term_id); ?>" class="button" aria-label="Post tag">#<?php echo $value->name; ?> </a>
                        <?php endforeach ?>
                   <?php endif ?>
                    

                </div>
         
                <div class="changes only-mobile" >
                     <?php 
                     if ( is_user_logged_in() ): ?>
                         
                         <a href="<?php echo bloginfo('url'); ?>/edit-post/?pid=<?php the_ID();?>" class="btn" aria-label="Edit post"><button class="btn sk-button-01"><?php pll_e( 'förbättra denna texten');?></button></a>  
                    <?php else: ?>
                        
                        <a href="<?php echo bloginfo('url'); ?>/foresla-andring-initiativ/?pid=<?php the_ID();?>" class="btn"><button class="btn sk-button-01" aria-label="Change initiative"><?php pll_e( 'förbättra denna texten');?></button></a>
                        
                    <?php endif ?>
  
                    <a class="" href="<?php echo bloginfo('url'); ?>/claim-initiativ-form/?initiativ_name=<?php  the_title(); ?>&initiativid=<?php the_ID(); ?>"  aria-label="Claim initiative"><button class="btn sk-button-02">"<?php pll_e( 'Claim this initiative');?>"</button></a>
                    
                </div>                                
                
                  <!-- Social share template:  -->
                  <?php smartakartan_share_buttons(); ?>
                            
            </div>  <!-- col-md- -->

        </div>  <!-- row -->

    </div> <!-- .container-fluid -->


    <div class="container-fluid">
      
        <div class="row">
            <div class="col-12 alike-shops">
                
                <h5>Liknande Iinitiativ</h5>

                <?php include(locate_template('/template-parts/content/content-more.php')); ?>

            </div>
        </div>
    </div>

<?php endwhile;  ?>

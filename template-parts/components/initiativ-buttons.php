                     <?php 
                     if ( is_user_logged_in() ): ?>
                         <a href="<?php echo bloginfo('url'); ?>/edit-post/?pid=<?php the_ID();?>" class="btn" aria-label="Edit post"><button class="btn sk-button-01"><?php pll_e( 'Ändra info');?></button></a>  
                    <?php else: ?>
                        <a href="<?php echo bloginfo('url'); ?>/foresla-andring-initiativ/?pid=<?php the_ID();?>" class="btn" aria-label="Change initiative"><button class="btn sk-button-01"><?php pll_e( 'Föreslå en ändring');?></button></a>
                    <?php endif ?>
                    <a class="clame-initiative" href="<?php echo bloginfo('url'); ?>/claim-initiativ-form/?initiativ_name=<?php  the_title(); ?>&initiativid=<?php the_ID(); ?>" aria-label="Claim initiative"><?php pll_e( 'Driver du denna verksamhet? Du kan få behörighet.');?></a>
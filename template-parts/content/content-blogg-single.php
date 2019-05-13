<?php
/**
 * @package 
 */
?>

<?php while ( have_posts() ) : the_post(); ?>
            
<div class="single-story">
    
    <div class="single-story-image card-img-top" style="background-image: url('<?php echo get_the_post_thumbnail_url($post->ID); ?>')">
        <h3 class="card-story-title"><?php echo get_the_title($post->ID); ?></h3>
    </div>

        <div class="container-fluid content-single single-blogg">
            
            <div class="row">
                
                    <div class="col-12">
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            
                            <header>
                      
                                <h5><?php the_field('underrubrik'); ?></h5>
                                
                            </header><!-- .entry-header -->
                            
                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div><!-- .entry-content -->
                            
                            <h4><?php pll_e( 'Kollektion');?></h4>
                            
                            <div id="collection-menu" class="scroll-menu mt-2 mb-2">
                                <div class="buttons scroll-y">
                                    <?php include(locate_template('/template-parts/collection/get-collection-buttons.php')); ?>
                                </div>
                            </div>
                            
                        </article><!-- #post-## --> 
                        
                    </div> <!-- col -->

            </div>  <!-- row -->
            
        </div> <!-- .container-fluid -->        

</div>

    
<?php endwhile;  ?> 
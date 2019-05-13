<?php
/**
 * @package
 */
?>

<?php while ( have_posts() ) : the_post(); ?>

    <div class="container-fluid content-single">

        <div class="row">
            <div class="col-12">
                
                 <header>

                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <h5><?php the_field('underrubrik'); ?></h5>

                </header><!-- .entry-header -->
                
             </div>
        </div>

        <div class="row">

            <div class="col-12 col-md-8">

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php the_content(); ?>

                    <div class="buttons">
                        
                        <?php $the_tags = get_the_tags(); ?>
                      
                       <?php foreach ($the_tags as $key => $value): ?>
                           
                           <a href="" class="button" aria-label="Tag">#<?php echo $value->name ?> </a>
                           
                       <?php endforeach ?>

                    </div>

                </article><!-- #post-## -->

            </div> <!-- col -->
                
            <div class="col-md-4">
                
                  <div class="the-map">
                        <?php include(locate_template('/template-parts/map/smartakartan.php')); ?>
                    </div>
                    
            </div>

        </div>  <!-- row -->

    </div> <!-- .container-fluid -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 alike-shops">
                <h5><?php pll_e( 'Liknande Iinitiativ');?></h5>

                <?php include(locate_template('/template-parts/content/content-more.php')); ?>

            </div>
        </div>
    </div>


<?php endwhile;  ?>

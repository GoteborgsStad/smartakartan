<?php
/**
 * The template for displaying transaction type
 *
 *
 * @package
 */
?>

<?php get_header(); ?>
<?php $category = get_queried_object();?>
<?php $category_id =$category->term_id;  ?>
<?php  include(locate_template('/template-parts/nav/category-navigation-desktop.php'));  ?>


    <div id="wrapper" class="container-fluid list-of-cards transactions" data-cat="<?php echo $category_id; ?>">

        <div class="row">

            <div class="col-12 col-md-8">

                 <h1>
                     <?php single_cat_title(); ?>
                </h1>

                <?php echo category_description( $category_id ); ?>

                <div class="row">
                    <div class="col">

                        <?php get_template_part('/template-parts/filter/filters'); ?>

                    </div>
                </div>
                    <?php $postHandler = new postHandler(); ?>
                    <?php $chunks = $postHandler->getByTransaction($category_id); ?>

                    <?php //var_dump($chunks); ?>
                    
                <script type="text/javascript">

                    var chunks = <?php echo json_encode($chunks); ?>;

                </script>
                    
                <div id="result-message"></div>
                <div class="grid">
                    <div id="grid-sizer" class="grid-sizer"></div>
 <!--      
                        <?php // while ( have_posts() ) : the_post(); ?>

                            <?php // include(locate_template('template-parts/content-shop.php'));?>

                        <?php // endwhile;  ?>       -->

                    <div id="grid-sizer" class="grid-sizer"></div>
                    
                    <?php foreach ($chunks[0] as $key => $value): ?>

                         <?php $post = get_post($value);?>
                        <?php //$categoryLayoutClass = 'grid-item--width2'; ?>
                        <?php include(locate_template('template-parts/content/content-shop.php'));?>

                    <?php endforeach ?>

                </div>
                <div class="grid-item grid-item--width2 text-center">

                        <button id="load-more"><?php pll_e( 'Visa Fler');?></button>
                        <button id="filter-more"><?php pll_e( 'Visa Fler');?></button>

                </div>
            </div>
            <div class="col-12 col-md-4 only-desktop">

                <!-- get sidebar -->
                <?php include(locate_template('/template-parts/sidebar.php'));?>
             
            </div>   <!-- col-12 col-md-4 -->

        </div>

    </div>

<?php get_footer(); ?>

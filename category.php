<?php
/**
 * The template for displaying category
 *
 *
 * @package
 */
?>

<?php get_header(); ?>
<?php $category = get_queried_object();?>
<?php $category_id =$category->term_id;  ?>
<?php $child = get_term($category_id); ?>
<?php $parentCatId = $child->parent; ?>
<?php $main_cat =  get_term_by('id', $parentCatId, 'category') ?>
<?php $options_page_id = get_option('page_on_front'); ?>

<?php $bg_color = get_field('category_background_color', $main_cat); ?>
<?php  include(locate_template('/template-parts/nav/category-navigation-desktop.php'));  ?>

    <div class="container-fluid list-of-cards category-template" data-cat="<?php echo $category_id; ?>">

         <div class="sub-category-header only-mobile" style="background-color: <?php echo $bg_color; ?>">
            <h3><?php single_cat_title(); ?></h3>
            <h6><?php echo category_description( $category_id ); ?> </h6>
        </div>

       <div class="row only-desktop">
            <div class="col-12 col-md-8">
                <h3><?php single_cat_title(); ?></h3>
                <h6><?php echo category_description( $category_id ); ?> </h6>
            </div>
       </div>

        <div class="row">

            <div class="col-12 col-md-8">

                    <div class="only-mobile">
                <div id="the-filter" class=" filter-menu" style="background-color: <?php the_field('site_main_color_1', 'option'); ?>" >
                    <div class="">

                        <!-- Filter bar -->
                        <?php get_template_part('/template-parts/filter/filter-bar'); ?>

                    </div>
                </div>
                        <?php //get_template_part('/template-parts/filter/filters'); ?>
                    </div>

                    <div class="only-desktop">
                        <?php  include(locate_template('template-parts/category-filter-menu.php')); ?>
                    </div>

                    <?php $postHandler = new postHandler(); ?>
                    <?php $chunks = $postHandler->getByCategory($category_id); ?>

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
                        <button class="btn btn-load-more mtb-3" id="load-more"><?php pll_e( 'Visa Fler');?></button>
                        <button class="btn btn-load-more mtb-3" id="filter-more"><?php pll_e( 'Visa Fler');?></button>
                </div>

            </div>

            <div class="col-12 col-md-4 only-desktop">
              <?php include(locate_template('/template-parts/map/smartakartan2.php')); ?>
                <!-- get sidebar -->
                <?php // include(locate_template('/template-parts/sidebar.php'));?>
            </div>   <!-- col-12 col-md-4 -->

        </div>
    </div>

<?php get_footer(); ?>

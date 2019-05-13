<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Open+Sans|Palanquin|Palanquin+Dark:400,500,600,700|Sura:400,700&amp;subset=latin-ext" as="font">
    <script defer src="https://cdn.jsdelivr.net/npm/intersection-observer@0.5.1/intersection-observer.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@11.0.6/dist/lazyload.min.js"></script>

    <title><?php wp_title(''); ?><?php if(wp_title('', false)){echo ' - '; } ?><?php bloginfo('name'); ?></title>
	<?php wp_head(); ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">

    <script>
        window.smartakartan = <?php echo json_encode([
            'siteurl' => get_site_url(),
            'ajaxurl' => get_site_url(null, 'wp-admin/admin-ajax.php'),
            'map' => [
                'base_lat'  => get_field('base_lat', 'options') ? : '57.7030712',
                'base_long' => get_field('base_long', 'options') ? : '11.9590075',
            ]
        ]);
        ?>;
    </script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-86794605-1"></script>
	<script>
	 window.dataLayer = window.dataLayer || [];
	 function gtag(){dataLayer.push(arguments);}
	 gtag('js', new Date());

	 gtag('config', 'UA-86794605-1');
	</script>



	<script>
		var home = <?php echo json_encode(get_template_directory_uri())?>;
		var lang = <?php echo json_encode(pll_current_language()); ?>;
        var here = "<?php pll_e('you are here'); ?>";
	</script>
</head>

<body <?php echo body_class(); ?>>

<?php $options_page_id = get_option('page_on_front'); ?>
<div class="site-wrap " style="background-color: <?php the_field('site_main_color_1', 'option' ) ?>" >

    <?php include(locate_template('/template-parts/nav/feature_search.php')); ?>

    <?php include(locate_template('/template-parts/nav/main-navigation.php')); ?>

    <?php
    if (is_front_page()) {
        include(locate_template('/template-parts/nav/category-navigation-desktop.php'));
    }
    ?>

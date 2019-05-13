<?php $options_page_id = get_option('page_on_front'); ?>

<nav id="main-navigation" class="navbar navbar-expand-md" style="background-color: <?php the_field('site_main_color_5', 'option' ) ?>; color: <?php the_field('site_main_color_9', 'option' )?>">

	 <div class="navbar-more">

	    <div class="hamburger">
	    	<i class="fa fa-bars fa-2x"></i>
	    </div>
	 </div>

	 <div class="search only-desktop">

	 	<div class="header-search">
		 	<?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
	 	 	<!--<input type="text" name="no-name">	-->
	 	</div>

	 </div>

	 <div class="logo">
		<?php
		    $currentlang = get_bloginfo('language');
		    if ($currentlang=="sv-SE") {
			    $home_url = get_option("siteurl");
		    }
		    elseif ($currentlang=="en-GB") {
			    $home_url = get_option("siteurl") .'/en/';
		    }
		?>

	 	<a href="<?php echo $home_url; ?>" class="brand"  aria-label="Logo">

			<?php if(get_field('site_logo', 'option' )){  ?>
	 			<img alt="site-logo" src="<?php the_field('site_logo', 'option' ) ?>">
			<?php }else{ ?>
				<img alt="site-logo" src="<?php echo get_template_directory_uri() ?>/dist/images/smarta-kartan-logo-white.png">
			<?php } ?>

  	    <div class="bloginfo">
		    <!-- Smarta Kartan -->
		    <span style="color: <?php the_field('site_main_color_7', 'option' )  ?>"><?php echo bloginfo(); ?> </span>
	    </div>
	 	</a>
	 </div>

  <!-- The WordPress Menu goes here -->
	<?php wp_nav_menu(
		array(
			'menu'          				=> 'primary menu',
			'theme_location' 	=> 'primary',
			'depth'             			=> 2,
			'container'         		=> 'div',
			'container_class'   => 'collapse navbar-collapse',
			'container_id' 			=> 'navbarSupportedContent',
			'menu_class' 			=> 'nav',
			'menu_id'						=> 'main-menu'
		)
	); ?>

	 <div class="lang-menu">
	 		<?php pll_the_languages(array('dropdown'=>1, 'display_names_as'=>'slug'));  ?>
			<div class="lang-icon" style="background-image: url('<?php echo get_template_directory_uri(); ?>/dist/images/lang.png')">
			</div>
	 </div>

</nav>

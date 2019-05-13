	<?php $options_page_id = get_option('page_on_front'); ?>
	<footer class="main-footer" style="background-color:<?php the_field('site_main_color_4', 'option'); ?>!important">

		<?php include(locate_template('/template-parts/nav/feature_more.php')); ?>

		<div class="container-fluid  mb-3 " >
			<div class="row ptb-1" >
				<div class="col-12 ptb-2 newsletter-holder">
					<div class="newsletter-title" style="color: <?php the_field('footer_header_color', pll_current_language('slug')) ?>"><?php the_field('newsletter', pll_current_language('slug')); ?></div>
				</div>
			</div>

		</div>

		<div class="footer-content container-fluid">
			<div class="row">
				<div class="col-md-4">
					<?php the_field('footer_text', pll_current_language('slug')); ?>
				</div>
				<div class="col-md-4">
					<?php the_field('footer_text2', pll_current_language('slug')); ?>
				</div>
				<div class="col-md-4">
					<?php the_field('footer_text3', pll_current_language('slug')); ?>
				</div>
			</div>
			<div class="contact-icons ptb-5">
					<a target="_blank" class="footer-contact-fb" title="facebook link logo" href="<?php the_field('facebook_link', pll_current_language('slug')); ?>">
						<img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-facebook.png">
					</a>
					<a class="footer-contact-mail"  title="e-mail link logo" href="mailto:<?php the_field('e-mail', pll_current_language('slug') ); ?>">
						<img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-e-post.png">
					</a>
					<a class="footer-contact-tel" title="telephone link logo" href="tel:<?php the_field('telephone', pll_current_language('slug') ); ?>">
						<img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-tel.png">
					</a>
			</div>
			<div class="footer-logo mtb-3">
				<span class=""><?php the_field('footer-logo', pll_current_language('slug') ); ?></span>
			</div>
		</div>



		<div class="footer-share">
			<?php smartakartan_share_buttons(); ?>
		</div>
		<div id="footer-menu" class="footer-menu" style="background-color:<?php the_field('site_main_color_8', 'option'); ?>">

		<?php
			wp_nav_menu( array(
			    'menu'           => 'Footer meny',
			    'theme_location' => 'footer-menu',
			    'fallback_cb'    => false,
			    'container_class' => 'footer-menu-container'
			) );
		 ?>
		</div>


		<div class="mobile-filter-holder">
				<div class="filter-overlay"></div>

				<div id="filter-popup" class="filter-controll">
					<?php include(locate_template('/template-parts/filter/filters.php')); ?>
				</div>
		</div>

	</footer>
</div> <!-- site-wrap -->
	
	<script defer type='text/javascript' src='<?= get_template_directory_uri().'/dist/index.js'; ?>'></script>
	<?php wp_footer(); ?>

	</body>
</html>

<nav id="account-navigation" class="navbar navbar-expand-lg navbar-light bg-light">
	
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


  <!-- The WordPress Menu goes here -->
	<?php wp_nav_menu(
		array(
			'theme_location' 	=> 'account',
			'depth'             => 2,
			'container'         => 'div',
			'container_class'   => 'collapse navbar-collapse',
			'container_id' => 'navbarSupportedContent',
			'menu_class' 		=> 'nav',
			'menu_id'			=> 'account-menu'
		)
	); ?>

</nav>
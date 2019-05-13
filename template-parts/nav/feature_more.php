<div id="feature-more-menu-drop" class="">

  <div id="feature-more-menu" class="">

    <div class="more-inner">

      <!-- The WordPress Menu goes here -->
      <?php wp_nav_menu(
        array(
          'theme_location' 	=> 'more-menu',
          'menu_class' 		=> 'more-menu'
        )); ?>

      <p><?php pll_e( 'Delta' );?></p>

      <?php wp_nav_menu(
        array(
          'theme_location' 	=> 'more-delta-menu',
          'menu_class' 		=> 'more-delta'
        )
      ); ?>


<p><?php pll_e( 'Mina sidor' );?></p>

      <?php
    if ( is_user_logged_in() ) {
      ?>
      <a href="<?php echo wp_logout_url(); ?>"><?php pll_e( 'Logga ut' ); ?></a>
    <?php
  wp_nav_menu(
    array(
      'theme_location'   => 'account',
      'depth'             => 2,
      'container'         => 'div',
      'container_class'   => 'account',
      'container_id' => 'navbarSupportedContent',
      'menu_class'     => 'account-menu',
     // 'menu_id'      => 'account-menu'
    )
  );
    }else{
      if (pll_current_language()  == 'sv') {
        wp_nav_menu(
            array(
              'menu'   => 'login',
              'depth'             => 2,
              'container'         => 'div',
              'container_class'   => 'login',
              'container_id' => 'navbarSupportedContent',
              'menu_class'     => 'account',
              'menu_id'      => 'login-menu'
            )
          );
      }else{
        wp_nav_menu(
            array(
              'menu'   => 'login-en',
              'depth'             => 2,
              'container'         => 'div',
              'container_class'   => 'login',
              'container_id' => 'navbarSupportedContent',
              'menu_class'     => 'account',
              'menu_id'      => 'login-menu'
            )
          );
      }
    }
   ?>

    </div>
  </div>
</div>

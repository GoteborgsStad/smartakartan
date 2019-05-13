<?php
require_once( get_template_directory() . '/vendor/class-tgm-plugin-activation.php');

add_filter('tgmpa_plugin_action_links', function($plugin, $slug, $item, $context) {
	if($slug === 'advanced-custom-fields-pro') {
		$plugin['install'] = '<a href="https://www.advancedcustomfields.com/pro/">Manual Install</a>';
	}
	return $plugin;
}, 10, 4);


add_filter('tgmpa_admin_menu_args', function($data) {
	// Uggly hack to prevent the plugin from trying to install a dependency that has to be installed manually due to
	// it being a plugin you need to pay for and download manually
	if($data['function'][1] === 'install_plugins_page') {
		if(isset($_POST['plugin']) && in_array('advanced-custom-fields-pro', $_POST['plugin'])) {
			$position = array_search('advanced-custom-fields-pro', $_POST['plugin']);
			array_splice($_POST['plugin'], $position, 1);
		}
	}
	return $data;
});

function smartakartan_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// // This is an example of how to include a plugin bundled with a theme.
		// array(
		// 	'name'               => 'TGM Example Plugin', // The plugin name.
		// 	'slug'               => 'tgm-example-plugin', // The plugin slug (typically the folder name).
		// 	'source'             => get_template_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source.
		// 	'required'           => true, // If false, the plugin is only 'recommended' instead of required.
		// 	'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
		// 	'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
		// 	'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		// 	'external_url'       => '', // If set, overrides default API URL and points to an external URL.
		// 	'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		// ),
		// 
		// // This is an example of how to include a plugin from an arbitrary external source in your theme.
		// array(
		// 	'name'         => 'TGM New Media Plugin', // The plugin name.
		// 	'slug'         => 'tgm-new-media-plugin', // The plugin slug (typically the folder name).
		// 	'source'       => 'https://s3.amazonaws.com/tgm/tgm-new-media-plugin.zip', // The plugin source.
		// 	'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		// 	'external_url' => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // If set, overrides default API URL and points to an external URL.
		// ),
		// 
		// // This is an example of how to include a plugin from a GitHub repository in your theme.
		// // This presumes that the plugin code is based in the root of the GitHub repository
		// // and not in a subdirectory ('/src') of the repository.
		// array(
		// 	'name'      => 'Adminbar Link Comments to Pending',
		// 	'slug'      => 'adminbar-link-comments-to-pending',
		// 	'source'    => 'https://github.com/jrfnl/WP-adminbar-comments-to-pending/archive/master.zip',
		// ),

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Advanced Custom Fields PRO',
			'slug'      => 'advanced-custom-fields-pro',
			'required'  => true,
			'external_url' => 'https://www.advancedcustomfields.com/pro/', // If set, overrides default API URL and points to an external URL.
			'source' => 'Manual download'
		),

		array(
			'name'      => 'ACF to REST API',
			'slug'      => 'acf-to-rest-api',
			'required'  => true,
		),

		array(
			'name'      => 'Ajax Search Lite',
			'slug'      => 'ajax-search-lite',
			'required'  => true,
		),

		array(
			'name'      => 'Search Meter',
			'slug'      => 'search-meter',
			'required'  => true,
		),

		array(
			'name'      => 'Menu Icons',
			'slug'      => 'menu-icons',
			'required'  => true,
		),

		array(
			'name'      => 'Relevanssi',
			'slug'      => 'relevanssi',
			'required'  => true,
		),

		array(
			'name'      => 'WP User Frontend',
			'slug'      => 'wp-user-frontend',
			'required'  => true,
		),

		array(
			'name'      => 'Polylang',
			'slug'      => 'polylang',
			'required'  => true,
		),

		// // This is an example of the use of 'is_callable' functionality. A user could - for instance -
		// // have WPSEO installed *or* WPSEO Premium. The slug would in that last case be different, i.e.
		// // 'wordpress-seo-premium'.
		// // By setting 'is_callable' to either a function from that plugin or a class method
		// // `array( 'class', 'method' )` similar to how you hook in to actions and filters, TGMPA can still
		// // recognize the plugin as being installed.
		// array(
		// 	'name'        => 'WordPress SEO by Yoast',
		// 	'slug'        => 'wordpress-seo',
		// 	'is_callable' => 'wpseo_init',
		// ),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'smartakartan',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'smartakartan' ),
			'menu_title'                      => __( 'Install Plugins', 'smartakartan' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'smartakartan' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'smartakartan' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'smartakartan' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'smartakartan'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'smartakartan'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'smartakartan'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'smartakartan'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'smartakartan'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'smartakartan'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'smartakartan'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'smartakartan'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'smartakartan'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'smartakartan' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'smartakartan' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'smartakartan' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'smartakartan' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'smartakartan' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'smartakartan' ),
			'dismiss'                         => __( 'Dismiss this notice', 'smartakartan' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'smartakartan' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'smartakartan' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'smartakartan_register_required_plugins' );
<?php 

 // add the admin options page

add_action('admin_menu', 'smartakartan_admin_add_page');
function smartakartan_admin_add_page() {
add_options_page('Custom Plugin Page', 'Theme Options', 'manage_options', 'site', 'site_options_page');
}


// display the admin options page
function site_options_page() {
?>
<div>
<h2>Theme Options</h2>
<form action="options.php" method="post">
<?php settings_fields('site_options'); ?>
<?php do_settings_sections('site'); ?>
 
<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>
 
<?php
}
 
 
 // add the admin settings and such
add_action('admin_init', 'plugin_admin_init');
function plugin_admin_init(){
register_setting( 'site_options', 'site_options', 'site_options_validate' );
add_settings_section('site_main', 'Main Settings', 'site_section_text', 'site');
add_settings_field('site_description_header', 'Site Text Input', 'site_setting_string', 'site', 'site_main');
//add_settings_field('site_description_text', 'Site Text Input', 'site_setting_string', 'site', 'site_main');
}

function site_section_text() {
echo '<p>Site Settigns</p>';
}

function site_setting_string() {
$options = get_option('site_options');
echo "<input id='site_description_header' name='site_options[description_header]' size='40' type='text' value='{$options['description_header']}' /><br>";
echo "<textarea id='site_description_text' name='site_options[description_text]' rows='10' cols='70' >{$options['description_text']}</textarea>";
}


// validate our options
function site_options_validate($input) {
$options = get_option('site_options');
$options['description_header'] = trim($input['description_header']);
	if(!preg_match('/^[a-z0-9]/i', $options['description_header'])) {
	$options['description_header'] = '';
	}
$options['description_text'] = trim($input['description_text']);
	if(!preg_match('/^[a-z0-9]/i', $options['description_text'])) {
	$options['description_text'] = '';
	}
return $options;
}



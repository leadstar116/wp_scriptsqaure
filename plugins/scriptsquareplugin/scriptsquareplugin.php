<?php
/*
Plugin Name:  ScriptSquarePlugin
Description:  Custom plugin for ScriptSquare site.
Plugin URI:   https://profiles.wordpress.org/leadstar116/
Author:       Leadstar116
Version:      1.0
Text Domain:  scriptsquareplugin
Domain Path:  /languages
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
*/


// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

define( 'REALTEO_SS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// if admin area
if ( is_admin() ) {

	// include dependencies
	require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';

}

// include plugin dependencies: admin and public
require_once plugin_dir_path( __FILE__ ) . 'includes/class-scriptsquare-templates.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/core-functions.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/custom-post-type.php';

// default plugin options
function scriptsquareplugin_options_default() {

	return array(
		'api_url'     => 'https://api.paramountrx.com/qa/',
		'api_key'     => 'fIlGvd7DPhahCBPT9HjLz8KhfXdraHWD9bJ6y4W1',
	);

}

// drug data options
function scriptsquareplugin_options_drugs() {

	return array();

}

function scriptsquareplugin_activate( $network_wide ) {
    //replace this with your dependent plugin
    $category_ext = 'listeo-core/listeo-core.php';

    $category_error = false;

	if(!is_plugin_active($category_ext)) {
		$category_error = true;
	}

    if ( $category_error ) {
        echo '<h3>Please enable listeo-core plugin</h3>';

        //Adding @ before will prevent XDebug output
        @trigger_error(__('Please enable listeo-core plugin before activating.', 'ap'), E_USER_ERROR);
    }
}

register_activation_hook(__FILE__, 'scriptsquareplugin_activate');
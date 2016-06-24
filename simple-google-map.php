<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://clarknikdelpowell.com
 * @since             3.0.0
 * @package           Simple_Google_Map
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Google Map
 * Plugin URI:        http://clarknikdelpowell.com/wordpress/simple-google-map
 * Description:       Embed a google map using shortcode or as a widget.
 * Version:           3.2
 * Author:            Taylor Gorman, Glenn Welser
 * Author URI:        http://clarknikdelpowell.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       simple-google-map
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-simple-google-map-activator.php
 */
function activate_simple_google_map() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-google-map-activator.php';
	Simple_Google_Map_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-simple-google-map-deactivator.php
 */
function deactivate_simple_google_map() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-google-map-deactivator.php';
	Simple_Google_Map_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_simple_google_map' );
register_deactivation_hook( __FILE__, 'deactivate_simple_google_map' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-simple-google-map.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    3.0.0
 */
function run_simple_google_map() {

	$plugin = new Simple_Google_Map();
	$plugin->run();

}
run_simple_google_map();

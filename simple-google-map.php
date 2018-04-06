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
 * Version:           5.0
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

function sgm_render( $atts ) {

	$sgm_options = get_option( 'SGMoptions' ); // get options defined in admin page
	$sgm_options = wp_parse_args( $sgm_options, Simple_Google_Map::$default_options );

	$lat           = isset( $atts['lat'] ) ? $atts['lat'] : '0';
	$lng           = isset( $atts['lng'] ) ? $atts['lng'] : '0';
	$zoom          = isset( $atts['zoom'] ) ? $atts['zoom'] : $sgm_options['zoom'];
	$type          = isset( $atts['type'] ) ? strtoupper( $atts['type'] ) : $sgm_options['type'];
	$content       = isset( $atts['content'] ) ? $atts['content'] : $sgm_options['content'];
	$directions_to = isset( $atts['directionsto'] ) ? $atts['directionsto'] : '';
	$auto_open     = isset( $atts['autoopen'] ) ? $atts['autoopen'] : false;
	$icon          = isset( $atts['icon'] ) ? esc_url( $atts['icon'], array(
		'http',
		'https',
	) ) : $sgm_options['icon'];

	$content = Simple_Google_Map::strip_last_chars( htmlspecialchars_decode( $content ), array(
		'<br>',
		'<br/>',
		'<br />',
	) );

	$directions_form = '';
	if ( $directions_to ) {
		$directions_form = '<form method="get" action="//maps.google.com/maps"><input type="hidden" name="daddr" value="' . $directions_to . '" /><input type="text" class="text" name="saddr" /><input type="submit" class="submit" value="Directions" /></form>';
	}

	$marker = "var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			title: '',";

	if ( $icon ) {
		$icon   = "var image = {
				url: '$icon',
			};";
		$marker .= "\n" . 'icon: image,' . "\n";
	}

	$marker .= '});';

	$infowindow_arr     = array( $content, $directions_form );
	$infowindow_content = implode( '<br>', array_filter( $infowindow_arr ) );

	$infowindow_open = $auto_open ? 'infowindow.open(map,marker);' . "\n" : '';

	$map = '<script type="text/javascript">';
	$map .= "function makeMap() {
				var latlng = new google.maps.LatLng($lat, $lng);
				var myOptions = {
					zoom: $zoom,
					center: latlng,
					mapTypeControl: true,
					mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
					navigationControl: true,
					navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
					mapTypeId: google.maps.MapTypeId.$type
				};
				var map = new google.maps.Map(document.getElementById('SGM'), myOptions);
				var contentstring = '<div class=\"infoWindow\">$infowindow_content</div>';
				var infowindow = new google.maps.InfoWindow({
					content: contentstring
				});
				$icon
				$marker
				google.maps.event.addListener(marker, 'click', function() {
				  infowindow.open(map,marker);
				});
				$infowindow_open
			};
			window.onload = makeMap;";
	$map .= '</script>';
	$map .= '<div id="SGM"></div>';

	return $map;
}

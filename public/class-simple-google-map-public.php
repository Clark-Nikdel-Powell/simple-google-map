<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://clarknikdelpowell.com
 * @since      3.0.0
 *
 * @package    Simple_Google_Map
 * @subpackage Simple_Google_Map/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Simple_Google_Map
 * @subpackage Simple_Google_Map/public
 * @author     Taylor Gorman <taylor@clarknikdelpowell.com>, Glenn Welser <glenn@clarknikdelpowell.com>
 */
class Simple_Google_Map_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The path of this plugin.
	 *
	 * @since    3.0.0
	 * @access   protected
	 * @var      string $plugin_path The string path of this plugin.
	 */
	protected $plugin_path;

	/**
	 * The version of this plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    3.0.0
	 *
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Enqueue scripts
	 *
	 * @since 3.1.0
	 */
	public function enqueue_scripts() {

		global $post;
		if ( has_shortcode( $post->post_content, 'SGM' ) || is_active_widget( false, false, 'simple-google-map-widget', true ) ) {
			wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js' );
		}

	}

	/**
	 * Output CSS into header
	 *
	 * @since    3.0.0
	 */
	public function output_css() {

		$sgm_options = get_option( 'SGMoptions' );
		if ( isset( $sgm_options['nostyle'] ) ) {
			return;
		}

		echo "<!-- styles for Simple Google Map -->\n<style type='text/css'>\n";
		echo get_option( 'SGMcss' );
		echo "\n</style>\n<!-- end styles for Simple Google Map -->\n";

	}

	/**
	 * Output CSS into header
	 *
	 * @since    3.0.0
	 */
	public function map( $atts ) {

		$sgm_options = get_option( 'SGMoptions' ); // get options defined in admin page

		$lat           = isset( $atts['lat'] ) ? $atts['lat'] : '0';
		$lng           = isset( $atts['lng'] ) ? $atts['lng'] : '0';
		$zoom          = isset( $atts['zoom'] ) ? $atts['zoom'] : $sgm_options['zoom'];
		$type          = isset( $atts['type'] ) ? strtoupper( $atts['type'] ) : $sgm_options['type'];
		$content       = isset( $atts['content'] ) ? $atts['content'] : $sgm_options['content'];
		$directions_to = isset( $atts['directionsto'] ) ? $atts['directionsto'] : '';

		$content         = htmlspecialchars_decode( $content );
		$directions_form = '';
		if ( $directions_to ) {
			$directions_form = '<form method="get" action="//maps.google.com/maps"><input type="hidden" name="daddr" value="' . $directions_to . '" /><input type="text" class="text" name="saddr" /><input type="submit" class="submit" value="Directions" /></form>';
		}

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/simple-google-map-public-display.php';
	}
}

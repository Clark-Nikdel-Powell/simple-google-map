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
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The path of this plugin.
	 *
	 * @since    3.0.0
	 * @access   protected
	 * @var      string    $plugin_path    The string path of this plugin.
	 */
	protected $plugin_path;

	/**
	 * The version of this plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    3.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Output CSS into header
	 * 
	 * @since    3.0.0
	 */
	public function output_css() {

		$SGMoptions = get_option( 'SGMoptions' );
		if ( isset($SGMoptions['nostyle']) ) return;

		echo "<!-- styles for Simple Google Map -->\n<style type='text/css'>\n";
		echo get_option('SGMcss');
		echo "\n</style>\n<!-- end styles for Simple Google Map -->\n";

	}

	/**
	 * Output CSS into header
	 * 
	 * @since    3.0.0
	 */
	public function map( $atts ) {

		$SGMoptions = get_option('SGMoptions'); // get options defined in admin page

		$lat = isset($atts['lat']) ? $atts['lat'] : '0';
		$lng = isset($atts['lng']) ? $atts['lng'] : '0';
		$zoom = isset($atts['zoom']) ? $atts['zoom'] : $SGMoptions['zoom'];
		$type = isset($atts['type']) ? strtoupper($atts['type']) : $SGMoptions['type'];
		$content = isset($atts['content']) ? $atts['content'] : $SGMoptions['content'];
		$directionsto = isset($atts['directionsto']) ? $atts['directionsto'] : '';

		require_once plugin_dir_path( dirname(__FILE__) ).'public/partials/simple-google-map-public-display.php';

	}

}

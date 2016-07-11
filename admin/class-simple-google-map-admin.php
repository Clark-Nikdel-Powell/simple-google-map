<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://clarknikdelpowell.com
 * @since      3.0.0
 *
 * @package    Simple_Google_Map
 * @subpackage Simple_Google_Map/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Simple_Google_Map
 * @subpackage Simple_Google_Map/admin
 * @author     Taylor Gorman <taylor@clarknikdelpowell.com>, Glenn Welser <glenn@clarknikdelpowell.com>
 */
class Simple_Google_Map_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * The deafult options for this plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      string $default_options The current default options of this plugin.
	 */
	private $default_options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    3.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name     = $plugin_name;
		$this->version         = $version;
		$this->default_options = array(
			'zoom'         => '12',
			'type'         => 'ROADMAP',
			'icon'         => '',
			'directionsto' => '',
			'content'      => '',
		);

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    3.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-google-map-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    3.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-google-map-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function plugin_menu() {

		add_options_page( 'Simple Google Map', 'Simple Google Map', 'activate_plugins', 'simple-google-map', array(
			$this,
			'plugin_options',
		) );

	}

	public function register_widgets() {

		register_widget( 'Simple_Google_Map_Widget' );

	}

	public function plugin_options() {

		if ( isset( $_POST['submit'] ) ) {

			$new_options['zoom']    = is_numeric( $_POST['zoom'] ) ? sanitize_text_field( $_POST['zoom'] ) : '';
			$new_options['type']    = strtoupper( sanitize_text_field( $_POST['type'] ) );
			$new_options['icon']    = esc_url_raw( $_POST['icon'], array( 'http', 'https' ) );
			$new_options['content'] = $_POST['content'];
			if ( isset( $_POST['editCSS'] ) ) {
				$new_options['editCSS'] = $_POST['editCSS'];
			}
			if ( isset( $_POST['nostyle'] ) ) {
				$new_options['nostyle'] = $_POST['nostyle'];
			}

			$sgm_options = wp_parse_args( array_filter( $new_options ), $this->default_options );

			update_option( 'SGMoptions', $sgm_options );

			$sgm_css = $_POST['css'];
			update_option( 'SGMcss', $sgm_css );

			$message = '<div id="message" class="updated"><p>Simple Google Map settings updated.</p></div>';
		} else {
			$sgm_options = get_option( 'SGMoptions' );
			$sgm_options = wp_parse_args( array_filter( $sgm_options ), $this->default_options );

			$sgm_css     = get_option( 'SGMcss' );
		}

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/simple-google-map-admin-display.php';
	}
}

<?php

/**
 * Fired during plugin activation
 *
 * @link       http://clarknikdelpowell.com
 * @since      3.0.0
 *
 * @package    Simple_Google_Map
 * @subpackage Simple_Google_Map/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      3.0.0
 * @package    Simple_Google_Map
 * @subpackage Simple_Google_Map/includes
 * @author     Taylor Gorman <taylor@clarknikdelpowell.com>, Glenn Welser <glenn@clarknikdelpowell.com>
 */
class Simple_Google_Map_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    3.0.0
	 */
	public static function activate() {

		$sgm_defaults = array(
			'zoom'         => '12',
			'type'         => 'ROADMAP',
			'directionsto' => '',
			'content'      => '',
		);
		update_option( 'SGMoptions', $sgm_defaults );

		$sgm_css = '#SGM {width:100%; height:300px;}#SGM .infoWindow {line-height:13px; font-size:10px;}#SGM input {margin:4px 4px 0 0; font-size:10px;}#SGM input.text {border:solid 1px #ccc; background-color:#fff; padding:2px;}';
		update_option( 'SGMcss', $sgm_css );
	}
}

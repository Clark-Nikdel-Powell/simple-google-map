<?php
/**
 * Map widget
 *
 * @since      3.0.0
 * @package    Simple_Google_Map
 * @subpackage Simple_Google_Map/widget
 * @author     Taylor Gorman <taylor@clarknikdelpowell.com>, Glenn Welser <glenn@clarknikdelpowell.com>
 */
class Simple_Google_Map_Widget extends WP_Widget {

	/**
	 * Constructor for the widget
	 *
	 * @since 3.0.0
	 */
	public function __construct() {

		parent::__construct(
			'simple-google-map-widget',
			'Simple Google Map',
			array('description' => 'Add a google map to your blog or site')
		);

	}

	/**
	 * Admin form in the widget area
	 *
	 * @since    3.0.0
	 */
	public function form( $instance ) {

		global $wpdb;
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$lat = isset($instance['lat']) ? esc_attr($instance['lat']) : '';
		$lng = isset($instance['lng']) ? esc_attr($instance['lng']) : '';
		$zoom = isset($instance['zoom']) ? esc_attr($instance['zoom']) : '';
		$type = isset($instance['type']) ? esc_attr($instance['type']) : '';
		$directionsto = isset($instance['directionsto']) ? esc_attr($instance['directionsto']) : '';
		$content = isset($instance['content']) ? esc_attr($instance['content']) : '';

		?>
			<p>
			<label for="<?php print $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php print $this->get_field_id('title'); ?>" name="<?php print $this->get_field_name('title'); ?>" type="text" value="<?php print $title; ?>" />
			</p>
			<p>
			<label for="<?php print $this->get_field_id('lat'); ?>"><?php _e('Latitude:'); ?></label>
			<input class="widefat" id="<?php print $this->get_field_id('lat'); ?>" name="<?php print $this->get_field_name('lat'); ?>" type="text" value="<?php print $lat; ?>" />
			</p>
			<p>
			<label for="<?php print $this->get_field_id('lng'); ?>"><?php _e('Longitude:'); ?></label>
			<input class="widefat" id="<?php print $this->get_field_id('lng'); ?>" name="<?php print $this->get_field_name('lng'); ?>" type="text" value="<?php print $lng; ?>" />
			</p>
			<p>
			<label for="<?php print $this->get_field_id('zoom'); ?>"><?php _e('Zoom Level: <small>(1-19)</small>'); ?></label>
			<input class="widefat" id="<?php print $this->get_field_id('zoom'); ?>" name="<?php print $this->get_field_name('zoom'); ?>" type="text" value="<?php print $zoom; ?>" />
			</p>
			<p>
			<label for="<?php print $this->get_field_id('type'); ?>"><?php _e('Map Type:<br /><small>(ROADMAP, SATELLITE, HYBRID, TERRAIN)</small>'); ?></label>
			<input class="widefat" id="<?php print $this->get_field_id('type'); ?>" name="<?php print $this->get_field_name('type'); ?>" type="text" value="<?php print $type; ?>" />
			</p>
			<p>
			<label for="<?php print $this->get_field_id('directionsto'); ?>"><?php _e('Address for directions:'); ?></label>
			<input class="widefat" id="<?php print $this->get_field_id('directionsto'); ?>" name="<?php print $this->get_field_name('directionsto'); ?>" type="text" value="<?php print $directionsto; ?>" />
			</p>
			<p>
			<label for="<?php print $this->get_field_id('content'); ?>"><?php _e('Info Bubble Content:'); ?></label>
			<textarea rows="7" class="widefat" id="<?php print $this->get_field_id('content'); ?>" name="<?php print $this->get_field_name('content'); ?>"><?php print $content; ?></textarea>
			</p>
		<?php

	}

	/**
	 * Update function for the widget
	 *
	 * @since    3.0.0
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
        $instance['title'] = esc_attr($new_instance['title']);
        $instance['lat'] = esc_attr($new_instance['lat']);
    	$instance['lng'] = esc_attr($new_instance['lng']);
    	$instance['zoom'] = esc_attr($new_instance['zoom']);
    	$instance['type'] = esc_attr($new_instance['type']);
    	$instance['directionsto'] = esc_attr($new_instance['directionsto']);
    	$instance['content'] = esc_attr($new_instance['content']);
        return $instance;

	}

	/**
	 * Outputs the widget with the selected settings
	 *
	 * @since    3.0.0
	 */
	public function widget( $args, $instance ) {

		extract( $instance );

		$SGMoptions = get_option('SGMoptions'); // get options defined in admin page

		if (!$lat) {$lat = '0';}
		if (!$lng) {$lng = '0';}
		if (!$zoom) {$zoom = $SGMoptions['zoom'];} // 1-19
		if (!$type) {$type = $SGMoptions['type'];} // ROADMAP, SATELLITE, HYBRID, TERRAIN
		if (!$content) {$content = $SGMoptions['content'];}

		$content = htmlspecialchars_decode($content);
		$directionsForm = '';
		if ($directionsto) { $directionsForm = "<form method=\"get\" action=\"//maps.google.com/maps\"><input type=\"hidden\" name=\"daddr\" value=\"".$directionsto."\" /><input type=\"text\" class=\"text\" name=\"saddr\" /><input type=\"submit\" class=\"submit\" value=\"Directions\" /></form>"; }

		extract( $args );
		print $before_widget;
		if ($instance['title']) { print $before_title.$instance['title'].$after_title; }

		require_once plugin_dir_path( dirname(__FILE__) ).'public/partials/simple-google-map-public-display.php';
		
		print $after_widget;

	}

}
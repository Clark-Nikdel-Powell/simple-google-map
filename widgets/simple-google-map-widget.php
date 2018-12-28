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
			array(
				'description' => 'Add a google map to your blog or site',
			)
		);

	}

	/**
	 * Admin form in the widget area
	 *
	 * @since    3.0.0
	 */
	public function form( $instance ) {

		$title        = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$lat          = isset( $instance['lat'] ) ? esc_attr( $instance['lat'] ) : '';
		$lng          = isset( $instance['lng'] ) ? esc_attr( $instance['lng'] ) : '';
		$zoom         = isset( $instance['zoom'] ) ? esc_attr( $instance['zoom'] ) : '';
		$type         = isset( $instance['type'] ) ? esc_attr( $instance['type'] ) : '';
		$directionsto = isset( $instance['directionsto'] ) ? esc_attr( $instance['directionsto'] ) : '';
		$content      = isset( $instance['content'] ) ? esc_attr( $instance['content'] ) : '';
		$icon         = isset( $instance['icon'] ) ? esc_url( $instance['icon'] ) : '';

		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ) ?>"><?php _e( 'Title:' ) ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ) ?>"
                   name="<?php echo $this->get_field_name( 'title' ) ?>" type="text" value="<?php echo $title ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'lat' ) ?>"><?php _e( 'Latitude:' ) ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'lat' ) ?>"
                   name="<?php echo $this->get_field_name( 'lat' ) ?>" type="text" value="<?php echo $lat ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'lng' ) ?>"><?php _e( 'Longitude:' ) ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'lng' ) ?>"
                   name="<?php echo $this->get_field_name( 'lng' ) ?>" type="text" value="<?php echo $lng ?>"/>
        </p>
        <p>
            <label
                    for="<?php echo $this->get_field_id( 'zoom' ) ?>"><?php _e( 'Zoom Level: <small>(1-19)</small>' ) ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'zoom' ) ?>"
                   name="<?php echo $this->get_field_name( 'zoom' ) ?>" type="text" value="<?php echo $zoom ?>"/>
        </p>
        <p>
            <label
                    for="<?php echo $this->get_field_id( 'type' ) ?>"><?php _e( 'Map Type:<br /><small>(ROADMAP, SATELLITE, HYBRID, TERRAIN)</small>' ) ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'type' ) ?>"
                   name="<?php echo $this->get_field_name( 'type' ) ?>" type="text" value="<?php echo $type ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'icon' ) ?>"><?php _e( 'Icon:' ) ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'icon' ) ?>"
                   name="<?php echo $this->get_field_name( 'icon' ) ?>" type="text" value="<?php echo $icon ?>"/>
        </p>
        <p>
            <label
                    for="<?php echo $this->get_field_id( 'directionsto' ) ?>"><?php _e( 'Address for directions:' ) ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'directionsto' ) ?>"
                   name="<?php echo $this->get_field_name( 'directionsto' ) ?>" type="text"
                   value="<?php echo $directionsto ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'content' ) ?>"><?php _e( 'Info Bubble Content:' ) ?></label>
            <textarea rows="7" class="widefat" id="<?php echo $this->get_field_id( 'content' ) ?>"
                      name="<?php echo $this->get_field_name( 'content' ) ?>"><?php echo $content ?></textarea>
        </p>
        <p>
            <label>
                <input name="<?php echo $this->get_field_name( 'autoopen' ) ?>" type="checkbox"
					<?php checked( $instance['autoopen'], 'on' ) ?>>
				<?php _e( 'Auto-open Info Bubble' ) ?>
            </label>
        </p>
		<?php

	}

	/**
	 * Update function for the widget
	 *
	 * @since    3.0.0
	 */
	public function update( $new_instance, $old_instance ) {

		$instance                 = $old_instance;
		$instance['title']        = esc_attr( $new_instance['title'] );
		$instance['lat']          = esc_attr( $new_instance['lat'] );
		$instance['lng']          = esc_attr( $new_instance['lng'] );
		$instance['zoom']         = esc_attr( $new_instance['zoom'] );
		$instance['type']         = esc_attr( $new_instance['type'] );
		$instance['directionsto'] = esc_attr( $new_instance['directionsto'] );
		$instance['content']      = esc_attr( $new_instance['content'] );
		$instance['icon']         = esc_attr( $new_instance['icon'] );
		$instance['autoopen']     = esc_attr( $new_instance['autoopen'] );

		return $instance;

	}

	/**
	 * Outputs the widget with the selected settings
	 *
	 * @since    3.0.0
	 */
	public function widget( $args, $instance ) {

		extract( $instance );

		$sgm_options = get_option( 'SGMoptions' ); // get options defined in admin page
		$sgm_options = wp_parse_args( $sgm_options, Simple_Google_Map::$default_options );

		if ( ! $lat ) {
			$lat = '0';
		}
		if ( ! $lng ) {
			$lng = '0';
		}
		if ( ! $zoom ) {
			$zoom = $sgm_options['zoom'];
		} // 1-19
		if ( ! $type ) {
			$type = $sgm_options['type'];
		} // ROADMAP, SATELLITE, HYBRID, TERRAIN
		if ( ! $icon ) {
			$icon = $sgm_options['icon'];
		}
		if ( ! $content ) {
			$content = $sgm_options['content'];
		}
		if ( ! $directionsto ) {
			$directions_to = '';
		} else {
			$directions_to = $directionsto;
		}
		if ( ! $autoopen ) {
			$auto_open = false;
		} else {
			$auto_open = $autoopen;
		}

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
		$infowindow_content = str_replace( "\r", "", $infowindow_content );
		$infowindow_content = str_replace( "\n", "", $infowindow_content );

		$infowindow_open = $auto_open ? 'infowindow.open(map,marker);' . "\n" : '';

		extract( $args );
		echo $before_widget;
		if ( $instance['title'] ) {
			echo $before_title . $instance['title'] . $after_title;
		}

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
			}
			window.onload = makeMap;";
		$map .= '</script>';
		$map .= '<div id="SGM"></div>';

		echo $map;

		echo $after_widget;
	}
}

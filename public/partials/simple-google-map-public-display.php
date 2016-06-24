<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://clarknikdelpowell.com
 * @since      3.0.0
 *
 * @package    Simple_Google_Map
 * @subpackage Simple_Google_Map/public/partials
 */
?>

<script type='text/javascript'>
	function makeMap() {
		var latlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>);
		
		var myOptions = {
			zoom: <?php echo $zoom; ?>,
			center: latlng,
			mapTypeControl: true,
			mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
			navigationControl: true,
			navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
			mapTypeId: google.maps.MapTypeId.<?php echo $type; ?>
		};
		var map = new google.maps.Map(document.getElementById('SGM'), myOptions);
		
		var contentstring = '<div class=\"infoWindow\"><?php echo $content . $directions_to . $directions_form; ?></div>';
		var infowindow = new google.maps.InfoWindow({
			content: contentstring
		});
		
		var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			title: ''
		});
		
		google.maps.event.addListener(marker, 'click', function() {
		  infowindow.open(map,marker);
		});
	}
	window.onload = makeMap;
</script>

<div id='SGM'></div>

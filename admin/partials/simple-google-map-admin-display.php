<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://clarknikdelpowell.com
 * @since      3.0.0
 *
 * @package    Simple_Google_Map
 * @subpackage Simple_Google_Map/admin/partials
 */

$messageValue = isset($message) ? $message : '';
$zoomValue = isset($SGMoptions['zoom']) ? $SGMoptions['zoom'] : '';
$typeValue = isset($SGMoptions['type']) ? $SGMoptions['type'] : '';
$contentValue = isset($SGMoptions['content']) ? $SGMoptions['content'] : '';
$editcssValue = isset($SGMoptions['editCSS']) ? 'checked="checked"' : '';
$nostyleValue = isset($SGMoptions['nostyle']) ? 'checked="checked"' : '';
?>

<div class="wrap">

	<h2>Simple Google Map</h2>
	<?php echo $messageValue; ?>

	<p>Here you can set the default options for every Simple Google Map on your pages/posts/sidebars. You can override these settings for any one Simple Google Map by simply adding the proper options to the shortcode/widget of that map. Leave them undefined or blank and these settings will apply.</p>
	<p>If you need help getting the latitude and longitude of your location try <a href="http://stevemorse.org/jcal/latlon.php" target="_blank">this site</a>.</p>

	<form action="" method="post">

	<table class="form-table">
	
		<tr valign="top">
		<th><label for="zoom">Zoom Level</label></th>
		<td>
		<input name="zoom" type="text" value="<?php echo $zoomValue; ?>" /><br />
		<span class="description">integer from 1 to 19</span>
		</td>
		</tr>
		
		<tr valign="top">
		<th><label for="type">Map Type</label></th>
		<td>
		<input type="text" name="type" value="<?php echo $typeValue; ?>" /><br />
		<span class="description">ROADMAP, SATELLITE, HYBRID, or TERRAIN</span>
		</td>
		</tr>
		
		<tr valign="top">
		<th><label for="content">Info Bubble Content</label></th>
		<td><textarea name="content" /><?php echo $contentValue; ?></textarea></td>
		</tr>
		
		<tr>
		<th scope="row" colspan="2" class="th-full">
		<label for="editCSS"><input type="checkbox" name="editCSS" id="editCSS" <?php echo $editcssValue; ?>/> I want to edit the Simple Google Map CSS</label>
		<textarea name="css" id="SGMcss" rows="6"><?php echo $SGMcss ?></textarea>
		</th>
		</tr>
		
		<tr>
		<th scope="row" colspan="2" class="th-full">
		<label for="nostyle"><input type="checkbox" name="nostyle" <?php echo $nostyleValue; ?> id="nostyle"/> Remove the Simple Google Map CSS, I will style it in the theme's stylesheet.</label>
		</th>
		</tr>
		
	</table><!-- form-table -->
	
	<p class="submit"><input type="submit" class="button-primary" name="submit" value="Save Changes" /></p>
	
	</form>

</div><!-- wrap -->

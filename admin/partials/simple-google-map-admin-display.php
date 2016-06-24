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

$message_value = isset( $message ) ? $message : '';
$zoom_value    = isset( $sgm_options['zoom'] ) ? $sgm_options['zoom'] : '';
$type_value    = isset( $sgm_options['type'] ) ? $sgm_options['type'] : '';
$content_value = isset( $sgm_options['content'] ) ? $sgm_options['content'] : '';
$editcss_value = isset( $sgm_options['editCSS'] ) ? 'checked="checked"' : '';
$nostyle_value = isset( $sgm_options['nostyle'] ) ? 'checked="checked"' : '';
?>

<div class="wrap">

	<h2>Simple Google Map</h2>
	<?php echo $message_value; ?>

	<p>Here you can set the default options for every Simple Google Map on your pages/posts/sidebars. You can override
		these settings for any one Simple Google Map by simply adding the proper options to the shortcode/widget of that
		map. Leave them undefined or blank and these settings will apply.</p>
	<p>If you need help getting the latitude and longitude of your location try <a
			href="http://stevemorse.org/jcal/latlon.php" target="_blank">this site</a>.</p>

	<form action="" method="post">

		<table class="form-table">

			<tr valign="top">
				<th><label for="zoom">Zoom Level</label></th>
				<td>
					<input name="zoom" type="text" value="<?php echo $zoom_value ?>"/><br/>
					<span class="description">integer from 1 to 19</span>
				</td>
			</tr>

			<tr valign="top">
				<th><label for="type">Map Type</label></th>
				<td>
					<input type="text" name="type" value="<?php echo $type_value ?>"/><br/>
					<span class="description">ROADMAP, SATELLITE, HYBRID, or TERRAIN</span>
				</td>
			</tr>

			<tr valign="top">
				<th><label for="content">Info Bubble Content</label></th>
				<td><textarea name="content"><?php echo $content_value ?></textarea></td>
			</tr>

			<tr>
				<th scope="row" colspan="2" class="th-full">
					<label for="editCSS"><input type="checkbox" name="editCSS"
							id="editCSS" <?php echo $editcss_value ?>/> I want to edit the Simple Google Map CSS</label>
					<textarea name="css" id="SGMcss" rows="6"><?php echo $sgm_css ?></textarea>
				</th>
			</tr>

			<tr>
				<th scope="row" colspan="2" class="th-full">
					<label for="nostyle"><input type="checkbox" name="nostyle" <?php echo $nostyle_value ?>
							id="nostyle"/> Remove the Simple Google Map CSS, I will style it in the theme's stylesheet.</label>
				</th>
			</tr>

		</table><!-- form-table -->

		<p class="submit"><input type="submit" class="button-primary" name="submit" value="Save Changes"/></p>

	</form>

</div><!-- wrap -->

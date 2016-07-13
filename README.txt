=== Plugin Name ===
Contributors: taylor_cnp, gwelser
Donate link: http://clarknikdelpowell.com/pay
Tags: google, google map, google maps, simple google map, no api key
Requires at least: 3.2
Tested up to: 4.5.3
Stable tag: 4.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin will embed a google map using shortcode or as a widget.

== Description ==

With this plugin you can insert a google map into your posts, pages, or wigitized sidebar *without an API key*.  Google recently released version 3 of their Maps API. They made it smaller and faster, but with less features.

**If your site was not using the Google Maps API key as of June 22, 2016, Google now requires the use of an API key. [More information in this Google Developers post](http://googlegeodevelopers.blogspot.com.au/2016/06/building-for-scale-updates-to-google.html). You can get a Google Maps Javascript API Key from the [Google Developers API Console](https://console.developers.google.com).**

**FEATURES**

* Insert into posts or pages using only shortcode
* Insert into your sidebar as a widget.
* Set default options = less necessary shortcode and widget options.
* Modify the default CSS or turn it off completely and style the map yourself.
* Add a form for getting directions by simply adding your destination address.
* Add a custom map marker image.
* It's simple!

**ADDITIONAL NOTES**

* There can only be one map one a page. A widget map counts as one.
* The size of the info window (speech bubble) is dictated by the size of the map, thus the size of the containing div, div#SGM
* If you wish to use html in the content value in shortcode, be sure and type it in visual mode (not HTML mode). The pointy brackets will be special html characters in HTML mode and are converted back into pointy brackets by the plugin.
* Custom map marker image must be properly sized. Simple Google Map will *not* resize the image for you.

For an example and more visit [the plugin's homepage](http://clarknikdelpowell.com/wordpress/simple-google-map/ "Simple Google Map by Clark Nikdel Powell").

== Installation ==

1. Upload `simple-google-map.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Insert the shortcode into your posts or pages or add the widget to your sidebar.

The shortcode name is SGM and here are the options..

* lat [decimal] – the latitude of the marker and the center of the map.
* lng [decimal] – the longitude of the marker and the center of the map.
* zoom [int] – the zoom level (1-19).
* type [string] – the starting map type. possible values are only ROADMAP, SATELLITE, HYBRID, or TERRAIN and must be in uppercase
* directionsto [string] – the destination address for getting directions. obviously you want this to be the address of your latitude longitude coordinates.
* content [string] – what goes inside the infoWindow (speech bubble) that appears when the marker is clicked.
* icon [string] - url of an image to use a the map marker. must be a properly formatted URL with scheme. note the image must be properly sized.

== Changelog ==

= 4.0 =
* Add support for Google Maps API Key

= 3.3 =
* Add custom map marker image with `icon` attribute
* Add default custom map marker image via plugin settings page
* Remove direction to address from info window.

= 3.2.1 =
* Revert arrays to long syntax for compatibility with PHP 5.3.
* Move strip_last_chars function to base class.

= 3.2 =
* Code cleanup per [WordPress Coding Standards](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards).
* Return rendered shortcode instead of echoing.
* Convert arrays to short syntax.

= 3.1 =
* Add directions form to info bubble when directionsto is provided.
* Enqueue Google Maps script the proper way with conditional loading.

= 3.0 =
* Refactored to use [WordPress Plugin Boilerplate](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate).
* Removed protocol from Google Maps js call so as not to cause errors on pages secured via SSL.

= 2.0 =
* Added option to specify default map type (roadmap, satellite, etc).
* Created widget capability.
* Added default CSS styling. Now you don't have to be a programmer to use the plugin!
* Added settings page in admin to manage global default options, edit styles, or turn off styles.
* Made directions form optional.
* Escaped necessary characters from info window content.
* Fixed a bug on windows hosting that caused php code to show up at the top of the admin pages (changed all <? to <?php).
* Changed submit button from "Get directions" to "Directions" to save space.

= 1.0 =
* Initial release

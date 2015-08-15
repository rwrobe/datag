<?php
/*
Plugin Name: Da Tag
Version: 1.0
Description: Da Tag allows you to highlight any tag for a given post and make it available for your theme!
Author: Rob Ward
Plugin URI: https://github.com/rwrobe/datag
Text Domain: datag
Domain Path: /languages
*/

/** @package datag */

/** @var $url string    The path to the plugin, for use in our class */
$thispluginurl = WP_PLUGIN_URL . '/' . dirname( plugin_basename( __FILE__ ) ) . '/';

/** Require the DT class */
require_once( 'class/dt.class.php' );
/** Add in the template tags */
require_once( 'inc/template-tags.php' );

/** @var $dt object Instantiation of our class */
$dt = new wardrobe\Da_Tag( $thispluginurl );

/** If for some reason you'd like to see the admin notice again, well, here you go. */
register_deactivation_hook( __FILE__, array( 'wardrobe\Da_Tag', 'prodigal_admin_notices' ) );

?>
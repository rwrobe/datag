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

if ( ! defined( 'DT_BASE_FILE' ) )
	define( 'DT_BASE_FILE', __FILE__ );
if ( ! defined( 'DT_BASE_DIR' ) )
	define( 'DT_BASE_DIR',  WP_PLUGIN_URL . '/' . dirname( plugin_basename( DT_BASE_FILE ) ) );
if ( ! defined( 'DT_PLUGIN_URL' ) )
	define( 'DT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
if ( ! defined( 'DT_PLUGIN_PATH' ) )
	define( 'DT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );


/** Require the DT class */
require_once( 'class/dt.class.php' );
/** Add in the template tags */
require_once( 'inc/template-tags.php' );

/** If for some reason you'd like to see the admin notice again, well, here you go. */
register_deactivation_hook( __FILE__, array( 'wardrobe\Da_Tag', 'prodigal_admin_notices' ) );

?>
<?php
/**
 * Plugin Name: Core Functionality
 * Plugin URI: https://github.com/billerickson/Core-Functionality
 * Description: This contains all your site's core functionality so that it is theme independent.
 * Version: 1.0
 * Author: Ryan Urban (based on Bill Erickson's plugin)
 * Author URI: http://fringewebdevelopment.com
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

// Plugin Directory 
define( 'JIGSAW_DIR', dirname( __FILE__ ) );

add_action( 'after_setup_theme', 'jigsaw_plugin_setup' );
function jigsaw_plugin_setup() {

	// General
	//include_once( JIGSAW_DIR . '/lib/functions/general.php' );

	// Admin Area
	//include_once( JIGSAW_DIR . '/lib/functions/admin-area.php' );

	// Admin Helper
	//include_once( JIGSAW_DIR . '/lib/functions/admin-helper.php' );

	// Admin Columns
	//include_once( JIGSAW_DIR . '/lib/functions/admin-columns.php' );
 
	// Post Types
	//include_once( JIGSAW_DIR . '/lib/functions/post-types.php' );

	// Taxonomies 
	//include_once( JIGSAW_DIR . '/lib/functions/taxonomies.php' );

	// Metaboxes
	//include_once( JIGSAW_DIR . '/lib/functions/metaboxes.php' );

	// Post Content
	//include_once( JIGSAW_DIR . '/lib/functions/post-content.php' );

	// Post Creation
	//include_once( JIGSAW_DIR . '/lib/functions/post-creation.php' );

	// Custom Comments
	//include_once( JIGSAW_DIR . '/lib/functions/custom-comments.php' );

	// Custom Scripts
	//include_once( JIGSAW_DIR . '/lib/functions/custom-scripts.php' );

}
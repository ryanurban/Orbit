<?php
/**
 * Custom Scripts
 *
 * This file contains the custom scripts and properly enqueues and registers them for WordPress
 *
 * @package      Core Functionality
 * @since 		 1.0
 * @author       Ryan Urban <ryan@fringewebdevelopment.com>
 * @copyright    Copyright (c) Ryan Urban
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Add our custom scripts to the footer
 *
 * @author Ryan Urban
 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 */
 
add_action('wp_enqueue_scripts', 'orbit_scripts');
function orbit_scripts() {
    // jQuery
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', ORBIT_TEMPLATEPATH . '/js/libs/jquery-1.7.2.min.js', array(), null, true);
    wp_enqueue_script( 'jquery' );
    
    // Plugins
    wp_register_script('orbit_plugins', ORBIT_TEMPLATEPATH . '/js/plugins.js', array('jquery'), null, true);
    wp_enqueue_script('orbit_plugins');
   
    // Helper
    wp_register_script('orbit_helper', ORBIT_TEMPLATEPATH . '/js/helper.js', array('jquery'), null, true);
    wp_enqueue_script('orbit_helper');
   
    // Script
    wp_register_script('orbit_script', ORBIT_TEMPLATEPATH . '/js/script.js', array('jquery'), null, true);
    wp_enqueue_script('orbit_script');
	
}
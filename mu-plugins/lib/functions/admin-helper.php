<?php
/**
  * Admin Helper
  *
  * This file contains functions to offer customized help for the theme
  *
  * @package      Core Functionality
  * @since 		  1.0
  * @author       Ryan Urban <ryan@fringewebdevelopment.com>
  * @copyright    Copyright (c) Ryan Urban
  * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
  */
 
/**
  * Edit the login page logo
  *
  * @link http://codex.wordpress.org/Plugin_API/Action_Reference/login_head
  */

add_action('login_head', 'orbit_custom_login_logo');
function orbit_custom_login_logo() {
  	echo '<style type="text/css">h1 a { background: url(/wp-content/themes/orbit/images/your_logo.png) 50% 50% no-repeat !important; }</style>';
}


/**
  * Also update the URL for the new login logo
  *
  * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/login_headerurl
  */

add_filter( 'login_headerurl', 'orbit_custom_logo_url' );
function orbit_custom_logo_url( $url ) {
    return get_bloginfo( 'siteurl' );
}


/**
  * Theme welcome & intro
  *
  * Create a custom "Welcome" widget for our users to see upon logging in and provide contact
  * and support information as well (This is where I typically include a link to the Site Guide
  * I create for my clients).
  *
  * @link http://codex.wordpress.org/Dashboard_Widgets_API
  */

function orbit_dashboard_widget_function() {
  	echo '<h2>Welcome</h2>';
  	echo '<p>This WordPress theme was built by Ryan Urban @ Fringe Development. If you run into any issues with this site, please contact me:</p>';
  	echo '<ul><li><a href="http://fringewebdevelopment.com/" target="_blank">Fringe Development</a></li><li><a href="mailto:ryan@fringewebdevelopment.com">ryan@fringewebdevelopment.com</a></li></ul>';
	
  	echo '<h2>Helpful Links</h2>';
  	echo '<p>Here are a couple of links to services your site is using that may be of interest at some point.';
  	echo '<ul><li>Site analytics: <a href="http://google.com/analytics" target="_blank">Google Analytics</a></li><li>RSS feed for the news: <a href="http://feedburner.com/" target="_blank">Feedburner</a></li></ul>';
	
  	echo '<h2>Site &amp; Content Guide</h2>';
  	echo 'Here is a link to your site and content guide that includes various important tidbits about maintaining your new site, as well as various tips and specific instructions on how to maintain and create content and keep the site looking great going forward.</p>';
  	echo '<p><a href="http://Your-URL-Here/wp-content/themes/orbit/docs/Site_&_Content_Guide.pdf" target="_blank">Site &amp; Content Guide</a></p>';
} 
  
add_action('wp_dashboard_setup', 'orbit_add_dashboard_widgets' );
function orbit_add_dashboard_widgets() {
  	wp_add_dashboard_widget('orbit_dashboard_widget', 'Welcome & Support', 'orbit_dashboard_widget_function');
}


/**
  * Edit the footer text
  *
  * Add a custom footer to our WordPress admin area–just for fun
  */

add_filter('admin_footer_text', 'orbit_remove_footer_admin');
function orbit_remove_footer_admin () {
      echo 'Thank you for working with <a href="http://fringewebdevelopment.com/">Fringe Development</a> & creating with <a href="http://wordpress.org/">WordPress</a>';
}
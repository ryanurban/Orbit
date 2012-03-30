<?php
/**
 * General
 *
 * This file contains any general functions
 *
 * @package      Core Functionality
 * @since 		 1.0
 * @author       Ryan Urban <ryan@fringewebdevelopment.com>
 * @copyright    Copyright (c) Ryan Urban
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
 
/**
 * Don't update plugin
 *
 * This prevents you being prompted to update if there's a public plugin
 * with the same name.
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 *
 * @param array $r, request arguments
 * @param string $url, request url
 * @return array request arguments
 */
 
function orbit_hidden_plugin_12345( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/plugins/update-check' ) )
		return $r; // Not a plugin update request. Bail immediately.
	$plugins = unserialize( $r['body']['plugins'] );
	unset( $plugins->plugins[ plugin_basename( __FILE__ ) ] );
	unset( $plugins->active[ array_search( plugin_basename( __FILE__ ), $plugins->active ) ] );
	$r['body']['plugins'] = serialize( $plugins );
	return $r;
}
add_filter( 'http_request_args', 'orbit_hidden_plugin_12345', 5, 2 );


/**
 * Don't update theme
 *
 * If there is a theme in the repo with the same name, 
 * this prevents WP from prompting an update.
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 */

function be_dont_update_theme( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
		return $r; // Not a theme update request. Bail immediately.
	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );
	$r['body']['themes'] = serialize( $themes );
	return $r;
}
add_filter( 'http_request_args', 'be_dont_update_theme', 5, 2 );


/**
 * Get post meta shorthand
 *
 * This is to save us some key strokes when using our Metabox data
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/twentyten-crm/
 */

function get_custom_field($field) {
	global $post;
	$value = get_post_meta($post->ID, $field, true);
	if ($value) return esc_attr( $value );
	else return false;
}


/**
 * Remove junk from our WordPress head & login errors
 *
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
add_filter('login_errors',create_function('$a', "return null;"));


/**
 * Turn a dynamic page title into an absolute URL
 *
 * This function allows you to keep the page titles, which serve as the navigation, dynamic for
 * client editing in the admin area, and then returns them as an absolute URL in the front-end.
 *
 * @author Ryan Urban
 */
 
function orbit_dynamic_url($page_id){
		$page_info = get_post( $page_id );
		$slug_title = $page_info->post_name;
		
		echo site_url().'/'.$slug_title;
}

// If page has a parent, get that slug as well
function orbit_dynamic_longurl($page_id){
		$page_info = get_post( $page_id ); 
		$title_parent = get_post($page_info->post_parent);
		$slug_parent = $title_parent->post_name;
		$slug_title = $page_info->post_name;
		
		if( $slug_parent ) :
			echo site_url().'/'.$slug_parent.'/'.$slug_title;
		else :
			echo site_url().'/'.$slug_title;
		endif;
}


/**
 * Add menu support
 * @link http://codex.wordpress.org/Navigation_Menus
 */
// add_theme_support( 'menus' );

/**
 * Add default posts and comments RSS feed links to <head>
 * @link http://codex.wordpress.org/Function_Reference/add_theme_support
 */
// add_theme_support( 'automatic-feed-links' );
<?php
/**
 * Custom WordPress installation file
 *
 * This file customizes the initial setup of WordPress to suit my typical development needs
 *
 * Inspired by:
 *   http://frn.gd/HgPnxP (WordPress Stack Exchange Entry)
 *	 http://frn.gd/HbIZpC (WordPress Basic Settings Plugin)
 *	 http://frn.gd/GVnGLt (Automating WordPress Customization)
 *
 * @package WordPress
 * @subpackage Jigsaw
 * @since Jigsaw 1.0
 *
 * @author		Ryan Urban <ryan@fringewebdevelopment.com>
 * @copyright	Copyright (c) Ryan Urban & Fringe Development
 */
 
// You can find this actual function at 'wp-admin/includes/upgrade.php'
// It sets up all the default content after our WordPress install
// I've simply commented out what I don't want included for my install, so everything is here
function wp_install_defaults($user_id) {
	global $wpdb, $wp_rewrite, $current_site, $table_prefix;
	
	// Let's customize our default WordPress options
	// @link http://codex.wordpress.org/Option_Reference
	
	// My preferred permalink structure
	update_option( 'permalink_structure', '/%category%/%postname%' );
	// Changed from 'posts' to 'page'
	update_option( 'show_on_front', 'page' );
	// Make our home page be the front page
	update_option( 'page_on_front', 1 );
	// Turned this on so you can create content from apps
	update_option( 'enable_app', 1 );
	update_option( 'enable_xmlrpc', 1 );
	
	
	// Make our theme the default one
	switch_theme('Jigsaw', 'Jigsaw');
	
	
	// Remove Hello Dolly and Akismet plugins
	require_once(ABSPATH . 'wp-admin/includes/plugin.php');
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	if (file_exists(WP_PLUGIN_DIR . '/hello.php') || file_exists(WP_PLUGIN_DIR . 'akismet/akismet.php'))
	delete_plugins(array('hello.php', 'akismet/akismet.php'));
	
	
	// Default category (we rename it from 'Uncategorized' to 'General')
	$cat_name = __('General');
	// translators: Default category slug
	$cat_slug = sanitize_title(_x('General', 'Default category slug'));

	if ( global_terms_enabled() ) {
		$cat_id = $wpdb->get_var( $wpdb->prepare( "SELECT cat_ID FROM {$wpdb->sitecategories} WHERE category_nicename = %s", $cat_slug ) );
		if ( $cat_id == null ) {
			$wpdb->insert( $wpdb->sitecategories, array('cat_ID' => 0, 'cat_name' => $cat_name, 'category_nicename' => $cat_slug, 'last_updated' => current_time('mysql', true)) );
			$cat_id = $wpdb->insert_id;
		}
		update_option('default_category', $cat_id);
	} else {
		$cat_id = 1;
	}

	$wpdb->insert( $wpdb->terms, array('term_id' => $cat_id, 'name' => $cat_name, 'slug' => $cat_slug, 'term_group' => 0) );
	$wpdb->insert( $wpdb->term_taxonomy, array('term_id' => $cat_id, 'taxonomy' => 'category', 'description' => '', 'parent' => 0, 'count' => 1));
	$cat_tt_id = $wpdb->insert_id;

	// Default link category (commented out)
	/*
	$cat_name = __('Blogroll');
	// translators: Default link category slug
	$cat_slug = sanitize_title(_x('Blogroll', 'Default link category slug'));

	if ( global_terms_enabled() ) {
		$blogroll_id = $wpdb->get_var( $wpdb->prepare( "SELECT cat_ID FROM {$wpdb->sitecategories} WHERE category_nicename = %s", $cat_slug ) );
		if ( $blogroll_id == null ) {
			$wpdb->insert( $wpdb->sitecategories, array('cat_ID' => 0, 'cat_name' => $cat_name, 'category_nicename' => $cat_slug, 'last_updated' => current_time('mysql', true)) );
			$blogroll_id = $wpdb->insert_id;
		}
		update_option('default_link_category', $blogroll_id);
	} else {
		$blogroll_id = 2;
	}

	$wpdb->insert( $wpdb->terms, array('term_id' => $blogroll_id, 'name' => $cat_name, 'slug' => $cat_slug, 'term_group' => 0) );
	$wpdb->insert( $wpdb->term_taxonomy, array('term_id' => $blogroll_id, 'taxonomy' => 'link_category', 'description' => '', 'parent' => 0, 'count' => 7));
	$blogroll_tt_id = $wpdb->insert_id;

	// Now drop in some default links
	$default_links = array();
	$default_links[] = array(	'link_url' => 'http://codex.wordpress.org/',
								'link_name' => 'Documentation',
								'link_rss' => '',
								'link_notes' => '');

	$default_links[] = array(	'link_url' => 'http://wordpress.org/news/',
								'link_name' => 'WordPress Blog',
								'link_rss' => 'http://wordpress.org/news/feed/',
								'link_notes' => '');

	$default_links[] = array(	'link_url' => 'http://wordpress.org/extend/ideas/',
								'link_name' => 'Suggest Ideas',
								'link_rss' => '',
								'link_notes' =>'');

	$default_links[] = array(	'link_url' => 'http://wordpress.org/support/',
								'link_name' => 'Support Forum',
								'link_rss' => '',
								'link_notes' =>'');

	$default_links[] = array(	'link_url' => 'http://wordpress.org/extend/plugins/',
								'link_name' => 'Plugins',
								'link_rss' => '',
								'link_notes' =>'');

	$default_links[] = array(	'link_url' => 'http://wordpress.org/extend/themes/',
								'link_name' => 'Themes',
								'link_rss' => '',
								'link_notes' =>'');

	$default_links[] = array(	'link_url' => 'http://planet.wordpress.org/',
								'link_name' => 'WordPress Planet',
								'link_rss' => '',
								'link_notes' =>'');

	foreach ( $default_links as $link ) {
		$wpdb->insert( $wpdb->links, $link);
		$wpdb->insert( $wpdb->term_relationships, array('term_taxonomy_id' => $blogroll_tt_id, 'object_id' => $wpdb->insert_id) );
	}
	*/

	// First post (commented out)
	/*
	$now = date('Y-m-d H:i:s');
	$now_gmt = gmdate('Y-m-d H:i:s');
	$first_post_guid = get_option('home') . '/?p=1';

	if ( is_multisite() ) {
		$first_post = get_site_option( 'first_post' );

		if ( empty($first_post) )
			$first_post = stripslashes( __( 'Welcome to <a href="SITE_URL">SITE_NAME</a>. This is your first post. Edit or delete it, then start blogging!' ) );

		$first_post = str_replace( "SITE_URL", esc_url( network_home_url() ), $first_post );
		$first_post = str_replace( "SITE_NAME", $current_site->site_name, $first_post );
	} else {
		$first_post = __('Welcome to WordPress. This is your first post. Edit or delete it, then start blogging!');
	}

	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => $first_post,
								'post_excerpt' => '',
								'post_title' => __('Hello world!'),
								// translators: Default post slug
								'post_name' => sanitize_title( _x('hello-world', 'Default post slug') ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $first_post_guid,
								'comment_count' => 1,
								'to_ping' => '',
								'pinged' => '',
								'post_content_filtered' => ''
								));
	$wpdb->insert( $wpdb->term_relationships, array('term_taxonomy_id' => $cat_tt_id, 'object_id' => 1) );
	*/

	// Default comment (commented out)
	/*
	$first_comment_author = __('Mr WordPress');
	$first_comment_url = 'http://wordpress.org/';
	$first_comment = __('Hi, this is a comment.<br />To delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.');
	if ( is_multisite() ) {
		$first_comment_author = get_site_option( 'first_comment_author', $first_comment_author );
		$first_comment_url = get_site_option( 'first_comment_url', network_home_url() );
		$first_comment = get_site_option( 'first_comment', $first_comment );
	}
	$wpdb->insert( $wpdb->comments, array(
								'comment_post_ID' => 1,
								'comment_author' => $first_comment_author,
								'comment_author_email' => '',
								'comment_author_url' => $first_comment_url,
								'comment_date' => $now,
								'comment_date_gmt' => $now_gmt,
								'comment_content' => $first_comment
								));
	*/

	// First Page (edited the text and create our Home page)
	$first_page = sprintf( __( "This is our home page. Congratulations!" ), admin_url() );
	if ( is_multisite() )
		$first_page = get_site_option( 'first_page', $first_page );
	$first_post_guid = get_option('home') . '/?page_id=1';
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => $first_page,
								'post_excerpt' => '',
								'post_title' => __( 'Home' ),
								// translators: Default page slug
								'post_name' => __( 'home' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $first_post_guid,
								'post_type' => 'page',
								'to_ping' => '',
								'pinged' => '',
								'post_content_filtered' => ''
								));
	$wpdb->insert( $wpdb->postmeta, array( 'post_id' => 1, 'meta_key' => '_wp_page_template', 'meta_value' => 'default' ) );

	// Set up default widgets for default theme.
	update_option( 'widget_search', array ( 2 => array ( 'title' => '' ), '_multiwidget' => 1 ) );
	update_option( 'widget_recent-posts', array ( 2 => array ( 'title' => '', 'number' => 5 ), '_multiwidget' => 1 ) );
	update_option( 'widget_recent-comments', array ( 2 => array ( 'title' => '', 'number' => 5 ), '_multiwidget' => 1 ) );
	update_option( 'widget_archives', array ( 2 => array ( 'title' => '', 'count' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
	update_option( 'widget_categories', array ( 2 => array ( 'title' => '', 'count' => 0, 'hierarchical' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
	update_option( 'widget_meta', array ( 2 => array ( 'title' => '' ), '_multiwidget' => 1 ) );
	update_option( 'sidebars_widgets', array ( 'wp_inactive_widgets' => array ( ), 'sidebar-1' => array ( 0 => 'search-2', 1 => 'recent-posts-2', 2 => 'recent-comments-2', 3 => 'archives-2', 4 => 'categories-2', 5 => 'meta-2', ), 'sidebar-2' => array ( ), 'sidebar-3' => array ( ), 'sidebar-4' => array ( ), 'sidebar-5' => array ( ), 'array_version' => 3 ) );

	if ( ! is_multisite() )
		update_user_meta( $user_id, 'show_welcome_panel', 1 );
	elseif ( ! is_super_admin( $user_id ) && ! metadata_exists( 'user', $user_id, 'show_welcome_panel' ) )
		update_user_meta( $user_id, 'show_welcome_panel', 2 );

	if ( is_multisite() ) {
		// Flush rules to pick up the new page.
		$wp_rewrite->init();
		$wp_rewrite->flush_rules();

		$user = new WP_User($user_id);
		$wpdb->update( $wpdb->options, array('option_value' => $user->user_email), array('option_name' => 'admin_email') );

		// Remove all perms except for the login user.
		$wpdb->query( $wpdb->prepare("DELETE FROM $wpdb->usermeta WHERE user_id != %d AND meta_key = %s", $user_id, $table_prefix.'user_level') );
		$wpdb->query( $wpdb->prepare("DELETE FROM $wpdb->usermeta WHERE user_id != %d AND meta_key = %s", $user_id, $table_prefix.'capabilities') );

		// Delete any caps that snuck into the previously active blog. (Hardcoded to blog 1 for now.) TODO: Get previous_blog_id.
		if ( !is_super_admin( $user_id ) && $user_id != 1 )
			$wpdb->query( $wpdb->prepare("DELETE FROM $wpdb->usermeta WHERE user_id = %d AND meta_key = %s", $user_id, $wpdb->base_prefix.'1_capabilities') );
	}
}

?>
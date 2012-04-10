<?php
/**
 * Admin Area
 *
 * This file contains functions to customize the WordPress admin area & back-end
 *
 * @package      Core Functionality
 * @since 		 1.0
 * @author       Ryan Urban <ryan@fringewebdevelopment.com>
 * @copyright    Copyright (c) Ryan Urban
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
 
 
/**
 * Remove menu items
 *
 * Remove unused menu items by adding them to the array
 * See the commented list of menu items for reference
 *
 * @link http://codex.wordpress.org/Function_Reference/remove_menu_page
 * @link http://wp.tutsplus.com/tutorials/creative-coding/customizing-your-wordpress-admin/
 */

add_action('admin_menu', 'orbit_remove_menus');
function orbit_remove_menus () {
	// remove_menu_page('edit.php'); // Posts
	// remove_menu_page('upload.php'); // Media
	// remove_menu_page('link-manager.php'); // Links
	// remove_menu_page('edit-comments.php'); // Comments
	// remove_menu_page('edit.php?post_type=page'); // Pages
	// remove_menu_page('plugins.php'); // Plugins
	// remove_menu_page('themes.php'); // Appearance
	// remove_menu_page('users.php'); // Users
	// remove_menu_page('tools.php'); // Tools
	// remove_menu_page('options-general.php'); // Settings
}


/**
 * Customize menu order
 *
 * @param array $menu_ord. Current order
 * @return array $menu_ord. New order
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/custom_menu_order
 * @link http://wp.tutsplus.com/tutorials/creative-coding/customizing-your-wordpress-admin/
 */

function orbit_custom_menu_order( $menu_ord ) {
	if ( !$menu_ord ) return true;
	return array(
		'index.php', // this represents the dashboard link
		'edit.php?post_type=page', //the page tab
		'edit.php', //the posts tab
		'edit-comments.php', // the comments tab
		'upload.php', // the media manager
    );
}
add_filter( 'custom_menu_order', 'orbit_custom_menu_order' );
add_filter( 'menu_order', 'orbit_custom_menu_order' );


/**
 * Add Custom Post Types to the Dashboard
 */

add_action( 'right_now_content_table_end' , 'orbit_right_now_content_table_end' );
function orbit_right_now_content_table_end() {
  $args = array(
    'public' => true ,
    '_builtin' => false
  );
  $output = 'object';
  $operator = 'and';

  $post_types = get_post_types( $args , $output , $operator );

  foreach( $post_types as $post_type ) {
    $num_posts = wp_count_posts( $post_type->name );
    $num = number_format_i18n( $num_posts->publish );
    $text = _n( $post_type->labels->singular_name, $post_type->labels->name , intval( $num_posts->publish ) );
    if ( current_user_can( 'edit_posts' ) ) {
      $num = "<a href='edit.php?post_type=$post_type->name'>$num</a>";
      $text = "<a href='edit.php?post_type=$post_type->name'>$text</a>";
    }
    echo '<tr><td class="first b b-' . $post_type->name . '">' . $num . '</td>';
    echo '<td class="t ' . $post_type->name . '">' . $text . '</td></tr>';
  }
}


/**
 * Remove Dashboard Widgets
 *
 * @link http://codex.wordpress.org/Dashboard_Widgets_API
 */

add_action('wp_dashboard_setup', 'orbit_remove_dashboard_widgets' );
function orbit_remove_dashboard_widgets() {	
	// Main Column Widgets
		// remove_meta_box( 'dashboard_browser_nag', 'dashboard', 'normal' );
		// remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );	
	// Side Column Widgets
		// remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		// remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
}
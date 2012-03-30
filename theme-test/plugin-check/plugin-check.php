<?php
/*
Plugin Name: Plugin-Check
Plugin URI: http://pross.org.uk/plugins
Description: Plugin-Check BETA
Author: Pross
Author URI: http://pross.org.uk
Version: 0.1
*/


function plugincheck_load_styles() {
	wp_enqueue_style('style', WP_PLUGIN_URL . '/theme-check/style.css', null, null, 'screen');
}

add_action( 'admin_menu', 'plugincheck_add_page' );
function plugincheck_add_page() {
	$page = add_plugins_page( 'Plugin Check', 'Plugin Check', 'manage_options', 'plugincheck', 'plugincheck_do_page' );
	add_action('admin_print_styles-' . $page, 'plugincheck_load_styles');
}

function plugincheck_add_headers( $extra_headers ) {
	$extra_headers = array( 'License', 'License URI', 'Template Version' );
	return $extra_headers;
}

function plugincheck_do_page() {
	if ( !current_user_can( 'manage_options' ) )  {
	wp_die( __( 'You do not have sufficient permissions to access this page.', 'themecheck' ) );
	}

	add_filter( 'extra_theme_headers', 'tc_add_headers' );

	include 'checkbase.php';
	include 'main.php';

	echo '<div id="theme-check" class="wrap">';
	echo '<div id="icon-themes" class="icon32"><br /></div><h2>Plugin-Check</h2>';
	echo '<div class="theme-check">';
		tc_form();
	if ( !isset( $_POST[ 'plugincheck' ] ) )  {
		tc_intro();

	}

	if ( isset( $_POST[ 'plugincheck' ] ) ) {
		if ( isset( $_POST[ 'trac' ] ) ) define( 'TC_TRAC', true );
		plugin_check_main(  );
	}
	echo '</div> <!-- .theme-check-->';
	echo '</div>';
}

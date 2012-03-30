<?php
/**
 * Learn how to set up a solid functions.php file
 * @link http://justintadlock.com/archives/2010/12/30/wordpress-theme-function-files
 */

add_action( 'after_setup_theme', 'orbit_theme_setup' );
function orbit_theme_setup() {

	// Adds theme styles to the visual editor with editor-style.css
 	add_editor_style();

}

?>
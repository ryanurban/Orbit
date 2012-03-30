<?php
/**
 * Post Creation
 *
 * This file contains functions to customize the WP TinyMCE Editor & default text in fields
 *
 * @package      Core Functionality
 * @since 		 1.0
 * @author       Ryan Urban <ryan@fringewebdevelopment.com>
 * @copyright    Copyright (c) Ryan Urban
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

 /**
 * TinyMCE customizations
 *
 * I use this function to customize (aka make my themes FAR less breakable on custom projects) 
 * the options available in the visual editor
 *
 * @link http://codex.wordpress.org/TinyMCE
 */
 
function jigsaw_formatTinyMCE($arg) {
	global $current_screen;
 	switch ($current_screen->post_type) {
		// Default options for editor, simply change / add a case for 'page', 'post', or 'CPT'
		// and remove any of the following options to remove them from the editor
		case 'page':
			$arg['theme_advanced_blockformats'] = 'p,address,pre,h1,h2,h3,h4,h5,h6';
			$arg['theme_advanced_buttons1']='formatselect,forecolor,|,bold,italic,underline,|,bullist,numlist,blockquote,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,|,wp_fullscreen,wp_adv';
			$arg['theme_advanced_buttons2']='pastetext,pasteword,removeformat,|,charmap,|,outdent,indent,|,undo,redo';
		break;
	}
	return $arg;
}
add_filter('tiny_mce_before_init', 'jigsaw_formatTinyMCE' );


/**
 * Remove "Add Media" from certain post types
 *
 * Once again, another I'll add to make my custom themes less breakable (let's face it if it's there)
 * you know it'll be messed with :)
 */
 
add_action('admin_head', 'jigsaw_removemediabuttons');
function jigsaw_removemediabuttons() {
	global $post;
	if($post->post_type == 'cpt-here')	{
		remove_action( 'media_buttons', 'media_buttons' );
	}
}


/**
 * Change default post title text
 *
 * @author Andrew Norcross
 * @link http://www.billerickson.net/twentyten-crm/
 */

add_action( 'gettext', 'jigsaw_change_title_text' );
function jigsaw_change_title_text( $translation ) {
	global $post;
	if( isset( $post ) ) {
		switch( $post->post_type ){
			case 'cpt-here' :
				if( $translation == 'Enter title here' ) return 'Enter the new title here';
			break;
		}
	}
	return $translation;
}


/**
 * Change post editor text
 */

add_filter( 'default_content', 'jigsaw_editor_content' );
function jigsaw_editor_content( $content ) {
    global $post_type;
    switch( $post_type ) {
        case 'cpt-here':
            $content = 'Enter the new content here';
        break;
        default:
            $content = '';
        break;
    }
    return $content;
}


/**
 * Removes default link from uploaded 
 * 
 * One final tweak to remove those annoying default links inserted by WordPress for added media
 *
 * It's important to note that if you do want to link a document, you'll need to make sure you
 * click on the "File URL" button
 */
update_option('image_default_link_type', 'none');
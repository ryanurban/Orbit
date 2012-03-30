<?php
/**
 * Post Types
 *
 * This file registers any custom post types
 *
 * @package      Core Functionality
 * @since 		 1.0
 * @author       Ryan Urban <ryan@fringewebdevelopment.com>
 * @copyright    Copyright (c) Ryan Urban
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Create Custom Post Type
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

add_action( 'init', 'jigsaw_cpt_init' );
function jigsaw_cpt_init() {
  
  // Book CPT  
  $labels = array(
    'name' => _x('Books', 'post type general name'),
    'singular_name' => _x('Book', 'post type singular name'),
    'add_new' => _x('Add New', 'book'),
    'add_new_item' => __('Add New Book'),
    'edit_item' => __('Edit Book'),
    'new_item' => __('New Book'),
    'all_items' => __('All Books'),
    'view_item' => __('View Book'),
    'search_items' => __('Search Books'),
    'not_found' =>  __('No books found'),
    'not_found_in_trash' => __('No books found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Books'

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  ); 
  // Register_post_type( 'book', $args );
}

// Display contextual help for CPT
add_action( 'contextual_help', 'jigsaw_cpt_help_text', 10, 3 );
function jigsaw_cpt_help_text( $contextual_help, $screen_id, $screen ) { 
  // $contextual_help .= var_dump( $screen ); // use this to help determine $screen->id
  if ( 'book' == $screen->id ) {
    $contextual_help =
      '<p>' . __('Things to remember when adding or editing a book:') . '</p>' .
      '<ul>' .
      '<li>' . __('Specify the correct genre such as Mystery, or Historic.') . '</li>' .
      '<li>' . __('Specify the correct writer of the book.  Remember that the Author module refers to you, the author of this book review.') . '</li>' .
      '</ul>' .
      '<p>' . __('If you want to schedule the book review to be published in the future:') . '</p>' .
      '<ul>' .
      '<li>' . __('Under the Publish module, click on the Edit link next to Publish.') . '</li>' .
      '<li>' . __('Change the date to the date to actual publish this article, then click on Ok.') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For more information:') . '</strong></p>' .
      '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>' ;
  } elseif ( 'edit-book' == $screen->id ) {
    $contextual_help = 
      '<p>' . __('This is the help screen displaying the table of books blah blah blah.') . '</p>' ;
  }
  return $contextual_help;
}
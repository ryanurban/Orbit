<?php
/**
  * Admin Columns
  *
  * This file contains functions to customize the admin Post columns
  * Create custom columns that are sortable for custom post types
  *
  * @link 		  http://justintadlock.com/archives/2011/06/27/custom-columns-for-custom-post-types
  *
  * @package      Core Functionality
  * @since 		  1.0
  * @author       Ryan Urban <ryan@fringewebdevelopment.com>
  * @copyright    Copyright (c) Ryan Urban
  * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
  */
 

/**
  * Create Custom Columns (exaxmple for showing the Title, Excerpt & Date for a CPT)
  */

add_filter( 'manage_edit-excpt1_columns', 'orbit_edit_excpt1_columns' ) ;
function orbit_edit_excpt1_columns( $columns ) {
	$columns = array(
  		'cb' => '<input type="checkbox" />',
  		'title' => __( 'Example Title' ),
  		'caption' => __( 'Example Excerpt' ),
  		'date' => __( 'Date' )
  	);

  	return $columns;
}

add_action( 'manage_excpt1_posts_custom_column', 'orbit_manage_excpt1_columns', 10, 2 );
function orbit_manage_excpt1_columns( $column, $post_id ) {
  	global $post;
	switch( $column ) {
		case 'caption' :
		
		// Get the excerpt
  		$excerpt = get_the_excerpt();

  		// If no caption is found, output a default message
  		if ( empty( $excerpt ) )
  		echo __( 'No caption' );

  		// If there is a caption, show it
  		else
  		the_excerpt();

  		break;
			
  		// Just break out of the switch statement for everything else
  		default :
  			break;
  	}
}


/**
  * Create Custom Columns (example for showing the Title, Taxonomy & Date for a CPT)
  */
  
add_filter( 'manage_edit-excpt2_columns', 'orbit_edit_excpt2_columns' ) ;
function orbit_edit_excpt2_columns( $columns ) {
	$columns = array(
  		'cb' => '<input type="checkbox" />',
  		'title' => __( 'Example Title' ),
  		'type' => __( 'Type' ),
  		'date' => __( 'Date' )
  	);

  	return $columns;
}

add_action( 'manage_excpt2_posts_custom_column', 'orbit_manage_excpt2_columns', 10, 2 );
function orbit_manage_excpt2_columns( $column, $post_id ) {
  	global $post;
	switch( $column ) {
		
		// If displaying the 'type' column
  		case 'type' :

			// Get the types for the post
  			$terms = get_the_terms( $post_id, 'excpt2-type' );

  			// If terms were found
  			if ( !empty( $terms ) ) {

  				$out = array();

  				// Loop through each term, linking to the 'edit posts' page for the specific term
  				foreach ( $terms as $term ) {
  					$out[] = sprintf( '<a href="%s">%s</a>',
  						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'excpt2' => $term->slug ), 'edit.php' ) ),
  						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'excpt2', 'display' ) )
  					);
  				}

  				// Join the terms, separating them with a comma
  				echo join( ', ', $out );
  			}

  			// If no terms were found, output a default message
  			else {
  				_e( 'No excpt2 type' );
  			}
			
  			break;
			
  		// Just break out of the switch statement for everything else
  		default :
  			break;
  	}
}

add_filter( 'manage_edit-excpt2_sortable_columns', 'orbit_excpt2_sortable_columns' );
function orbit_excpt2_sortable_columns( $columns ) {
	$columns['type'] = 'type';
  	return $columns;
}

// Only run our customization on the 'edit.php' page in the admin
add_action( 'load-edit.php', 'orbit_edit_excpt2_load' );
function orbit_edit_excpt2_load() {
  	add_filter( 'request', 'orbit_sort_excpt2' );
}

// Sorts the excpt2 types
function orbit_sort_excpt2( $vars ) {

  	// Check if we're viewing the 'excpt2' post type
  	if ( isset( $vars['post_type'] ) && 'media' == $vars['post_type'] ) {

  		// Check if 'orderby' is set to 'type'
  		if ( isset( $vars['orderby'] ) && 'excpt2-type' == $vars['orderby'] ) {

  			// Merge the query vars with our custom variables
  			$vars = array_merge(
  				$vars,
  				array(
  					'meta_key' => 'type',
  					'orderby' => 'meta_value'
  				)
  			);
  		}
  	}

  	return $vars;
} 
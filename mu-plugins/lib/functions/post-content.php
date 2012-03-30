<?php
/**
 * Post Content
 *
 * This file contains various functions to customize post content
 *
 * @package      Core Functionality
 * @since 		 1.0
 * @author       Ryan Urban <ryan@fringewebdevelopment.com>
 * @copyright    Copyright (c) Ryan Urban
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
 
/**
 * Add Post Thumbnail support
 * @link http://codex.wordpress.org/Post_Thumbnails
 */
// add_theme_support( 'post-thumbnails', array( 'type-here' ) ); 

/**
 * Add support for a variety of post formats
 * @link http://codex.wordpress.org/Post_Formats
 */
// add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );


/**
 * Sets the post excerpt length to 40 words
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_length
 */
 
function orbit_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'orbit_excerpt_length', 999 );


/**
 * Returns a "Continue Reading" link for excerpts
 */
 
function orbit_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) . '</a>';
}


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and 
 * orbit_continue_reading_link()
 */
 
function orbit_auto_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'orbit_auto_excerpt_more' );


/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */
 
function orbit_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= orbit_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'orbit_custom_excerpt_more' );


/**
 * Display navigation to next/previous pages when applicable
 */

if ( ! function_exists( 'orbit_content_nav' ) ) :
function orbit_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<ul>
			<li><?php next_posts_link( __( '<span>&larr;</span> Older Posts', 'orbit' ) ); ?></li>
			<li><?php previous_posts_link( __( 'Newer Posts <span>&rarr;</span>', 'orbit' ) ); ?></li>
			</ul>
		</nav><!-- end archive-nav -->		
	<?php endif;
}
endif;
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


if ( ! function_exists( 'orbit_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function orbit_posted_on() {
	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a> by <a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a>', 'orbit' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'orbit' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;


/**
 * Returns true if a blog has more than 1 category
 */
function orbit_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so orbit_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so orbit_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in orbit_categorized_blog
 */
function orbit_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'orbit_category_transient_flusher' );
add_action( 'save_post', 'orbit_category_transient_flusher' );


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
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading &rarr;', 'orbit' ) . '</a>';
}


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and 
 * orbit_continue_reading_link()
 */
 
function orbit_auto_excerpt_more( $more ) {
	return '&hellip;' . orbit_continue_reading_link();
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


if ( ! function_exists( 'orbit_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 */
function orbit_content_nav( $nav_id ) {
	global $wp_query;

	?>
	<nav id="<?php echo $nav_id; ?>">
		<ul>
		<?php if ( is_single() ) : // navigation links for single posts ?>
		
			<li><?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'orbit' ) . '%title' ); ?></li>
			<li><?php next_post_link( '%link', '%title' . _x( '&rarr;', 'Next post link', 'orbit' ) . '' ); ?></li>

		<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

			<?php if ( get_next_posts_link() ) : ?>
				<li><?php next_posts_link( __( '&larr; Older posts', 'orbit' ) ); ?></li>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
				<li><?php previous_posts_link( __( 'Newer posts &rarr;', 'orbit' ) ); ?></li>
			<?php endif; ?>

		<?php endif; ?>
		</ul>
	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // orbit_content_nav
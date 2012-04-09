<?php
/**
 * Comments -  The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to orbit_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Orbit
 * @since Orbit 1.0
 */
?>

	<?php if ( post_password_required() ) : ?>
		
		<?php _e( 'This post is password protected. Enter the password to view any comments.', 'orbit' ); ?>

	<?php return; endif; ?>

	<?php if ( have_comments() ) : ?>
		
		<?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'orbit' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		
			<?php _e( 'Comment navigation', 'orbit' ); ?>
			<?php previous_comments_link( __( '&larr; Older Comments', 'orbit' ) ); ?>
			<?php next_comments_link( __( 'Newer Comments &rarr;', 'orbit' ) ); ?>
		
		<?php endif; // check for comment navigation ?>

		<ol>
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use orbit_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define orbit_comment() and that will be used instead.
				 * See orbit_comment() in orbit/functions.php for more.
				 */
				wp_list_comments( array( 'callback' => 'orbit_comment' ) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		
			<?php _e( 'Comment navigation', 'orbit' ); ?>
			<?php previous_comments_link( __( '&larr; Older Comments', 'orbit' ) ); ?>
			<?php next_comments_link( __( 'Newer Comments &rarr;', 'orbit' ) ); ?>
		
		<?php endif; // check for comment navigation ?>

	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		
		<?php _e( 'Comments are closed.', 'orbit' ); ?>
	
	<?php endif; ?>

	<?php comment_form(); ?>
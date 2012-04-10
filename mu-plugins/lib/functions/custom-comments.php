<?php
/**
  * Custom Comments
  *
  * This file contains functions for customizing the Wordpress comments
  *
  * @package      Core Functionality
  * @since 		  1.0
  * @author       Ryan Urban <ryan@fringewebdevelopment.com>
  * @copyright    Copyright (c) Ryan Urban
  * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
  */
 
if ( ! function_exists( 'orbit_comment' ) ) :
/**
 * Template for comments and pingbacks.
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function orbit_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li>
		<?php _e( 'Pingback:', 'orbit' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'orbit' ), '', '' ); ?>
	<?php
			break;
		default :
	?>
	<li>
		<?php
			$avatar_size = 68;
			if ( '0' != $comment->comment_parent )
			$avatar_size = 39;

			echo get_avatar( $comment, $avatar_size );

			// translators: 1: comment author, 2: date and time
			printf( __( '%1$s on %2$s said:', 'orbit' ),
				sprintf( '%s', get_comment_author_link() ),
				sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
				esc_url( get_comment_link( $comment->comment_ID ) ),
				get_comment_time( 'c' ),
				// translators: 1: date, 2: time
				sprintf( __( '%1$s at %2$s', 'orbit' ), get_comment_date(), get_comment_time() )
				)
			);
		?>

		<?php edit_comment_link( __( 'Edit', 'orbit' ), '', '' ); ?>
				
		<?php if ( $comment->comment_approved == '0' ) : ?>
		
			<?php _e( 'Your comment is awaiting moderation.', 'orbit' ); ?>
					
		<?php endif; ?>

		<?php comment_text(); ?>

		<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply &darr;', 'orbit' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	
		<?php
			break;
	endswitch;
}
endif; // ends check for orbit_comment()
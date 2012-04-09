<?php
/**
 * The template for displaying posts in the Aside Post Format on index and archive pages.
 *
 * @package WordPress
 * @subpackage Orbit
 * @since Orbit 1.0
 */
?>

	<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'orbit' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				
	<?php _e( 'Aside', 'orbit' ); ?>

	<?php if ( comments_open() && ! post_password_required() ) : ?>
			
		<?php comments_popup_link( '' . __( 'Reply', 'orbit' ) . '', _x( '1', 'comments number', 'orbit' ), _x( '%', 'comments number', 'orbit' ) ); ?>
		
	<?php endif; ?>
	
	<?php the_content(); ?>
	
	<?php orbit_posted_on(); ?>
	
	<?php if ( comments_open() ) : ?>
			
		<?php comments_popup_link( '' . __( 'Leave a reply', 'orbit' ) . '', __( '1 Reply', 'orbit' ), __( '% Replies', 'orbit' ) ); ?>
		
	<?php endif; ?>
	
	<?php edit_post_link( __( 'Edit', 'orbit' ), '', '' ); ?>
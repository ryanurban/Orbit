<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Orbit
 * @since Orbit 1.0
 */
?>

	<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'orbit' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>

	<?php if ( 'post' == get_post_type() ) : ?>
	
		<?php orbit_posted_on(); ?>
		
	<?php endif; ?>

	<?php if ( comments_open() && ! post_password_required() ) : ?>

		<?php comments_popup_link( '' . __( 'Reply', 'orbit' ) . '', _x( '1', 'comments number', 'orbit' ), _x( '%', 'comments number', 'orbit' ) ); ?>
		
	<?php endif; ?>

		<?php the_content(); ?>
		
	<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
	
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'orbit' ) );
			if ( $categories_list ):
		?>
			
		<?php printf( __( 'Posted in %2$s', 'orbit' ), '', $categories_list ); ?>
		
	<?php endif; // End if categories ?>
	
		<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'orbit' ) );
			if ( $tags_list ): ?>
			
			<?php printf( __( 'Tagged %2$s', 'orbit' ), '', $tags_list ); ?>
			
			<?php endif; // End if $tags_list ?>
			<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( comments_open() ) : ?>
		
		<?php comments_popup_link( '' . __( 'Leave a reply', 'orbit' ) . '', __( '1 Reply', 'orbit' ), __( '% Replies', 'orbit' ) ); ?>
			
		<?php endif; // End if comments_open() ?>

	<?php edit_post_link( __( 'Edit', 'orbit' ), '', '' ); ?>
<?php
/**
 * Archive - The template for displaying Archive pages.
 *
 * @package WordPress
 * @subpackage Orbit
 * @since Orbit 1.0
 */
get_header(); ?>

	<?php if ( have_posts() ) : ?>
	
		<?php if ( is_day() ) : ?>
			<?php printf( __( 'Daily Archives: %s', 'orbit' ), '' . get_the_date() . '' ); ?>
		
		<?php elseif ( is_month() ) : ?>
			<?php printf( __( 'Monthly Archives: %s', 'orbit' ), '' . get_the_date( _x( 'F Y', 'monthly archives date format', 'orbit' ) ) . '' ); ?>
						
		<?php elseif ( is_year() ) : ?>
			<?php printf( __( 'Yearly Archives: %s', 'orbit' ), '' . get_the_date( _x( 'Y', 'yearly archives date format', 'orbit' ) ) . '' ); ?>
		
		<?php else : ?>
			<?php _e( 'Blog Archives', 'orbit' ); ?>
		
		<?php endif; ?>

			<?php orbit_content_nav( 'nav-above' ); ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php
				/* Include the Post-Format-specific template for the content. */
				get_template_part( 'content', get_post_format() );
			?>

		<?php endwhile; ?>

			<?php orbit_content_nav( 'nav-below' ); ?>

		<?php else : ?>
			
			<?php _e( 'Apologies, but no results were found for the requested archive.', 'orbit' ); ?>
			
			<?php get_search_form(); ?>

	<?php endif; ?>

<?php get_footer(); ?>
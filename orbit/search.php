<?php
/**
 * Search - The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Orbit
 * @since Orbit 1.0
 */
get_header(); ?>

	<?php if ( have_posts() ) : ?>

			<?php printf( __( 'Search Results for: %s', 'orbit' ), '' . get_search_query() . '' ); ?>

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
		
			<?php _e( 'Sorry, but nothing matched your search criteria.', 'orbit' ); ?>
						
			<?php get_search_form(); ?>

	<?php endif; ?>

<?php get_footer(); ?>
<?php
/**
 * Index - The main template file.
 *
 * @package WordPress
 * @subpackage Orbit
 * @since Orbit 1.0
 */
get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<?php orbit_content_nav( 'nav-above' ); ?>

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', get_post_format() ); ?>

	<?php endwhile; ?>

		<?php orbit_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<?php _e( 'Apologies, but no results were found for the requested archive.', 'orbit' ); ?>
						
		<?php get_search_form(); ?>

	<?php endif; ?>

<?php get_footer(); ?>
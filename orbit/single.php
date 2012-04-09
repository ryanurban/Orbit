<?php
/**
 * Single - The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Orbit
 * @since Orbit 1.0
 */
get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
				
		<?php orbit_content_nav( 'nav-above' ); ?>

		<?php get_template_part( 'content', 'single' ); ?>

		<?php orbit_content_nav( 'nav-below' ); ?>

		<?php comments_template( '', true ); ?>

	<?php endwhile; ?>

<?php get_footer(); ?>
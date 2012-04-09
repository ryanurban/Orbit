<?php
/**
 * Tag - The template used to display Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Orbit
 * @since Orbit 1.0
 */
get_header(); ?>

	<?php if ( have_posts() ) : ?>

			<?php printf( __( 'Tag Archives: %s', 'orbit' ), '' . single_tag_title( '', false ) . '' ); ?>

			<?php
				$tag_description = tag_description();
				if ( ! empty( $tag_description ) )
					echo apply_filters( 'tag_archive_meta', '' . $tag_description . '' );
			?>
				
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
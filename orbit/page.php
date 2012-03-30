<?php
/**
 * Page - Used as the main, default page template for this theme
 *
 * @package WordPress
 * @subpackage Jigsaw
 * @since Jigsaw 1.0
 */

get_header(); ?>
	
	<?php while ( have_posts() ) : the_post(); // The Loop ?>

		<?php get_template_part( 'content', 'page' ); ?>

	<?php endwhile; // End Loop ?>
	
<?php get_footer(); ?>
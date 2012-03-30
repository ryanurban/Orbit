<?php
/**
 * 404 Page - Used as the 404 page for this theme
 *
 * @package WordPress
 * @subpackage Jigsaw
 * @since Jigsaw 1.0
 */

get_header(); ?>

	<h2>There is the issue of the 404...</h2>
	<p>We can&#8217;t seem to find the page you were looking for.</p>
	<p><a href="<?php echo home_url(); ?>">Head back to the home page</a></p>

<?php get_footer(); ?>
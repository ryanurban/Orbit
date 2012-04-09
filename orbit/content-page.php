<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Orbit
 * @since Orbit 1.0
 */
?>
	<?php the_title(); ?>	
	<?php the_content(); ?>
	
	<?php edit_post_link( __( 'Edit', 'orbit' ), '', '' ); ?>

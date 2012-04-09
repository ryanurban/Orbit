<?php
/**
 * Search Form - The template for displaying search forms.
 *
 * @package WordPress
 * @subpackage Orbit
 * @since Orbit 1.0
 */
?>
	
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="search"><?php _e( 'Search', 'orbit' ); ?></label>
		<input type="text" name="search" placeholder="<?php esc_attr_e( 'Search', 'orbit' ); ?>" />
		<input type="submit" name="submit" value="<?php esc_attr_e( 'Search', 'orbit' ); ?>" />
	</form>
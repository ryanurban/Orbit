<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Orbit
 * @since Orbit 1.0
 */
?>
	<?php the_title(); ?>	
	
	<?php if ( 'post' == get_post_type() ) : ?>
			<?php orbit_posted_on(); ?>	
	<?php endif; ?>
		
	<?php the_content(); ?>

	<?php
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'orbit' ) );

		/* translators: used between list items, there is a space after the comma */
		$tag_list = get_the_tag_list( '', __( ', ', 'orbit' ) );
		
		if ( ! orbit_categorized_blog() ) {
			// This blog only has 1 category so we just need to worry about tags in the meta text
			if ( '' != $tag_list ) {
				$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'orbit' );
			} else {
				$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'orbit' );
			}

		} else {
			// But this blog has loads of categories so we should probably display them here
			if ( '' != $tag_list ) {
				$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'orbit' );
			} else {
				$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'orbit' );
			}

		} // end check for categories on this blog

		printf(
			$meta_text,
			$category_list,
			$tag_list,
			get_permalink(),
			the_title_attribute( 'echo=0' )
		);
	?>
	
	<?php edit_post_link( __( 'Edit', 'orbit' ), '', '' ); ?>
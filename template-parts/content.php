<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

?>

	<article <?php post_class( 'post-container' ); ?>>

		<div class="entry-content">
			<?php
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. */
							esc_html__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', '_s' ),
							[
								'span' => [
									'class' => [],
								],
							]
						),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					)
				);

				wp_link_pages(
					[
						'before' => '<div class="page-links">' . esc_attr__( 'Pages:', '_s' ),
						'after'  => '</div>',
					]
				);
				?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php _s_entry_footer(); ?>
		</footer><!-- .entry-footer -->

	</article><!-- #post-## -->

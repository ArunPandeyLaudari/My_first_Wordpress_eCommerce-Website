<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ecommerce_online_store
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mag-post-single">
		<div class="mag-post-detail">
			<div class="mag-post-category">
				<?php ecommerce_online_store_categories_single_list(); ?>
			</div>
			<header class="entry-header">
				<?php

				if ( 'post' === get_post_type() ) :
					?>
					<div class="mag-post-meta">
						<?php
						ecommerce_online_store_posted_by_single();
						ecommerce_online_store_posted_on_single();
						ecommerce_online_store_posted_comments_single();
						ecommerce_online_store_posted_time_single();
						?>
					</div>
				<?php endif; ?>
			</header><!-- .entry-header -->
		</div>
		<?php ecommerce_online_store_post_thumbnail(); ?>
		<?php if ( !get_theme_mod( 'ecommerce_online_store_single_post_hide_post_content', false ) ) { ?>
			<div class="entry-content">
				<?php
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ecommerce-online-store' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ecommerce-online-store' ),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->
		<?php } ?>
	</div>

	<footer class="entry-footer">
		<?php ecommerce_online_store_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
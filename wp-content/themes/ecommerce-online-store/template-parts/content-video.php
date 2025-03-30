<?php

/**
 * Template part for displaying Video Format
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ecommerce_online_store
 */

?>
<?php $ecommerce_online_store_readmore = get_theme_mod( 'ecommerce_online_store_readmore_button_text','Read More');?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mag-post-single">
        <?php
			// Get the post ID
			$ecommerce_online_store_post_id = get_the_ID();

			// Check if there are videos embedded in the post content
			$ecommerce_online_store_post = get_post($ecommerce_online_store_post_id);
			$ecommerce_online_store_content = do_shortcode(apply_filters('the_content', $ecommerce_online_store_post->post_content));
			$ecommerce_online_store_embeds = get_media_embedded_in_content($ecommerce_online_store_content);

			if (!empty($ecommerce_online_store_embeds)) {
			    // Loop through embedded media and display videos
			    foreach ($ecommerce_online_store_embeds as $ecommerce_online_store_embed) {
			        // Check if the embed code contains a video tag or specific video providers like YouTube or Vimeo
			        if (strpos($ecommerce_online_store_embed, 'video') !== false || strpos($ecommerce_online_store_embed, 'youtube') !== false || strpos($ecommerce_online_store_embed, 'vimeo') !== false || strpos($ecommerce_online_store_embed, 'dailymotion') !== false || strpos($ecommerce_online_store_embed, 'vine') !== false || strpos($ecommerce_online_store_embed, 'wordPress.tv') !== false || strpos($ecommerce_online_store_embed, 'hulu') !== false) {
			            ?>
			            <div class="custom-embedded-video">
			                <div class="video-container">
			                    <?php echo $ecommerce_online_store_embed; ?>
			                </div>
			                <div class="video-comments">
			                    <?php
			                    // Add your comments section here
			                    comments_template(); // This will include the default WordPress comments template
			                    ?>
			                </div>
			            </div>
			            <?php
			        }
			    }
			}
	    ?>
		<div class="mag-post-detail">
			<div class="mag-post-category">
				<?php ecommerce_online_store_categories_list(); ?>
			</div>
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title mag-post-title">', '</h1>' );
			else :
				if ( get_theme_mod( 'ecommerce_online_store_post_hide_post_heading', true ) ) { 
					the_title( '<h2 class="entry-title mag-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			    }
			endif;
			?>
			<div class="mag-post-meta">
				<?php
				ecommerce_online_store_posted_by();
				ecommerce_online_store_posted_on();
				ecommerce_online_store_posted_comments();
				ecommerce_online_store_posted_time();
				?>
			</div>
			<?php if ( get_theme_mod( 'ecommerce_online_store_post_hide_post_content', true ) ) { ?>
				<div class="mag-post-excerpt">
					<?php the_excerpt(); ?>
				</div>
		    <?php } ?>
			<?php if ( get_theme_mod( 'ecommerce_online_store_post_readmore_button', true ) === true ) : ?>
				<div class="mag-post-read-more">
					<a href="<?php the_permalink(); ?>" class="read-more-button">
						<?php if ( ! empty( $ecommerce_online_store_readmore ) ) { ?> <?php echo esc_html( $ecommerce_online_store_readmore ); ?> <?php } ?>
						<i class="<?php echo esc_attr( get_theme_mod( 'ecommerce_online_store_readmore_btn_icon', 'fas fa-chevron-right' ) ); ?>"></i>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
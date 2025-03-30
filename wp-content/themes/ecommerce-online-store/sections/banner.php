<?php
if ( ! get_theme_mod( 'ecommerce_online_store_enable_banner_section', true ) ) {
	return;
}

$ecommerce_online_store_slider_content_ids  = array();
$ecommerce_online_store_slider_content_type = get_theme_mod( 'ecommerce_online_store_banner_slider_content_type', 'post' );

for ( $i = 1; $i <= 3; $i++ ) {
	$ecommerce_online_store_slider_content_ids[] = get_theme_mod( 'ecommerce_online_store_banner_slider_content_' . $ecommerce_online_store_slider_content_type . '_' . $i );
}
$ecommerce_online_store_banner_slider_args = array(
	'post_type'           => $ecommerce_online_store_slider_content_type,
	'post__in'            => array_filter( $ecommerce_online_store_slider_content_ids ),
	'orderby'             => 'post__in',
	'posts_per_page'      => absint( 3 ),
	'ignore_sticky_posts' => true,
);
$ecommerce_online_store_banner_slider_args = apply_filters( 'ecommerce_online_store_banner_section_args', $ecommerce_online_store_banner_slider_args );

ecommerce_online_store_render_banner_section( $ecommerce_online_store_banner_slider_args );

/**
 * Render Banner Section.
 */
function ecommerce_online_store_render_banner_section( $ecommerce_online_store_banner_slider_args ) {     ?>

	<section id="ecommerce_online_store_banner_section" class="banner-section banner-style-1">
    <?php
    if ( is_customize_preview() ) :
        ecommerce_online_store_section_link( 'ecommerce_online_store_banner_section' );
    endif;
    ?>
    <div class="banner-section-wrapper">
        <?php
        $ecommerce_online_store_query = new WP_Query( $ecommerce_online_store_banner_slider_args );
        if ( $ecommerce_online_store_query->have_posts() ) :
            ?>
            <div class="asterthemes-banner-wrapper banner-slider ecommerce-online-store-carousel-navigation" data-slick='{"autoplay": false }'>
                <?php
                $i = 1;
                while ( $ecommerce_online_store_query->have_posts() ) :
                    $ecommerce_online_store_query->the_post();
                    $ecommerce_online_store_button_label = get_theme_mod( 'ecommerce_online_store_banner_button_label_' . $i);
                    $ecommerce_online_store_button_link  = get_theme_mod( 'ecommerce_online_store_banner_button_link_' . $i);
                    $ecommerce_online_store_button_link  = ! empty( $ecommerce_online_store_button_link ) ? $ecommerce_online_store_button_link : get_the_permalink();

                    $ecommerce_online_store_second_button_label = get_theme_mod( 'ecommerce_online_store_banner_second_button_label_' . $i, '' );
                    $ecommerce_online_store_second_button_link  = get_theme_mod( 'ecommerce_online_store_banner_second_button_link_' . $i, '' );
                    $ecommerce_online_store_second_button_link  = ! empty( $ecommerce_online_store_second_button_link ) ? $ecommerce_online_store_second_button_link : get_the_permalink();
                    ?>
                    <div class="banner-single-outer">
                        <div class="banner-single">
                            <div class="banner-img">
                                <?php the_post_thumbnail( 'full' ); ?>
                            </div>
                            <div class="banner-caption">
                                <div class="asterthemes-wrapper">
                                    <div class="banner-catption-wrapper">
                                        <h1 class="banner-caption-title">
                                            <?php the_title(); ?>
                                        </h1>
                                        <div class="mag-post-excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        <div class="slider-btn-banner">
                                        <?php if ( ! empty( $ecommerce_online_store_button_label ) ) { ?>
                                            <div class="banner-slider-btn">
                                                <a href="<?php echo esc_url( $ecommerce_online_store_button_link ); ?>" class="asterthemes-button"><?php echo esc_html( $ecommerce_online_store_button_label ); ?></a>
                                            </div>
                                        <?php } ?>
                                        <?php if ( ! empty( $ecommerce_online_store_second_button_label ) ) { ?>
                                            <div class="banner-slider-second-btn">
                                                <a href="<?php echo esc_url( $ecommerce_online_store_second_button_link ); ?>" class="asterthemes-button"><?php echo esc_html( $ecommerce_online_store_second_button_label ); ?></a>
                                            </div>
                                        <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
            <?php
        endif;
        ?>
    </div>
</section>
	<?php
}
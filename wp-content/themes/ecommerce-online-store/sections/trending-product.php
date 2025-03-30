<?php

if ( ! get_theme_mod( 'ecommerce_online_store_enable_service_section', true ) ) {
    return;
}

$ecommerce_online_store_args = '';

ecommerce_online_store_render_service_section( $ecommerce_online_store_args );

/**
 * Render Service Section.
 */
function ecommerce_online_store_render_service_section( $ecommerce_online_store_args ) { ?>
    <section id="ecommerce_online_store_trending_section" class="asterthemes-frontpage-section trending-section trending-style-1">
        <?php
        if ( is_customize_preview() ) :
            ecommerce_online_store_section_link( 'ecommerce_online_store_service_section' );
        endif; ?>

        <div class="asterthemes-wrapper">
            <div class="row">
                <?php 
                $ecommerce_online_store_trending_product_heading = get_theme_mod( 'ecommerce_online_store_trending_product_heading' );
                $ecommerce_online_store_new_arrival_heading = get_theme_mod( 'ecommerce_online_store_new_arrival_heading' );
                ?>

                <div class="col-lg-8 col-md-7">
                    <div class="trending-product">
                        <?php if ( ! empty( $ecommerce_online_store_trending_product_heading ) ) { ?>
                            <div class="header-contact-inner">
                                <h3><?php echo esc_html( $ecommerce_online_store_trending_product_heading ); ?></h3>
                            </div>
                        <?php } ?>

                        <div class="row">
                            <?php
                            if ( class_exists( 'WooCommerce' ) ) {
                                $ecommerce_online_store_trending_category = get_theme_mod( 'ecommerce_online_store_trending_product_category', 'Hot Deals' );
                                $ecommerce_online_store_args = array(
                                    'post_type' => 'product',
                                    'posts_per_page' => 100,
                                    'product_cat' => $ecommerce_online_store_trending_category,
                                    'order' => 'ASC'
                                );

                                $ecommerce_online_store_loop = new WP_Query( $ecommerce_online_store_args );
                                while ( $ecommerce_online_store_loop->have_posts() ) : $ecommerce_online_store_loop->the_post(); global $product; ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="tab-product">
                                            <figure class="product-image">
                                                <?php
                                                if ( has_post_thumbnail() ) {
                                                    echo get_the_post_thumbnail( get_the_ID(), 'shop_catalog' );
                                                    woocommerce_show_product_sale_flash( $product );
                                                } else {
                                                    echo '<img src="' . esc_url( wc_placeholder_img_src() ) . '" />';
                                                }
                                                ?>
                                                <div class="box-content intro-button">
                                                    <?php if ( $product->is_type( 'simple' ) ) { woocommerce_template_loop_add_to_cart(); } ?>
                                                </div>
                                            </figure>
                                            <?php if ( $product->is_type( 'simple' ) ) { woocommerce_template_loop_rating(); } ?>
                                            <h5 class="product-text"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h5>
                                            <h6 class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></h6>
                                        </div>
                                    </div>
                                <?php endwhile; wp_reset_postdata(); 
                            } ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-5">
                    <div class="new-arrival">
                        <?php if ( ! empty( $ecommerce_online_store_new_arrival_heading ) ) { ?>
                            <div class="header-contact-inner">
                                <h3><?php echo esc_html( $ecommerce_online_store_new_arrival_heading ); ?></h3>
                            </div>
                        <?php } ?>

                        <?php
                        if ( class_exists( 'WooCommerce' ) ) {
                            $ecommerce_online_store_new_arrival_category = get_theme_mod( 'ecommerce_online_store_new_arrival_category', 'New Arrival' );
                            $ecommerce_online_store_args = array(
                                'post_type' => 'product',
                                'posts_per_page' => 100,
                                'product_cat' => $ecommerce_online_store_new_arrival_category,
                                'order' => 'ASC'
                            );

                            $ecommerce_online_store_loop = new WP_Query( $ecommerce_online_store_args );
                            if ($ecommerce_online_store_loop->have_posts()) { ?>
                                <div class="product-box">
                                    <?php while ( $ecommerce_online_store_loop->have_posts() ) : $ecommerce_online_store_loop->the_post(); global $product; ?>
                                        <div class="tab-product tab-box">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 align-self-center">
                                                    <figure class="product-image">
                                                        <?php
                                                        if ( has_post_thumbnail() ) {
                                                            echo get_the_post_thumbnail( get_the_ID(), 'shop_catalog' );
                                                            woocommerce_show_product_sale_flash( $product );
                                                        } else {
                                                            echo '<img src="' . esc_url( wc_placeholder_img_src() ) . '" />';
                                                        }
                                                        ?>
                                                    </figure>
                                                </div>
                                                <div class="col-lg-8 col-md-8 align-self-center">
                                                    <?php if ( $product->is_type( 'simple' ) ) { woocommerce_template_loop_rating(); } ?>
                                                    <h5 class="product-text"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h5>
                                                    <h6 class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php }
                            wp_reset_postdata();
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
}
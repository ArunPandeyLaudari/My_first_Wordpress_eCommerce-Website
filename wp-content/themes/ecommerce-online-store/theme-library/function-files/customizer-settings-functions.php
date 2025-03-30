<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ecommerce_online_store
 */

function ecommerce_online_store_customize_css() {
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_html( get_theme_mod( 'primary_color', '#5c8dff' ) ); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'ecommerce_online_store_customize_css' );

function ecommerce_online_store_customize_sec_css() {
    ?>
    <style type="text/css">
        :root {
            --secondary-color: <?php echo esc_html( get_theme_mod( 'secondary_color', '#a2d5f2' ) ); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'ecommerce_online_store_customize_sec_css' );


function add_custom_script_in_footer() {
    if ( get_theme_mod( 'ecommerce_online_store_enable_sticky_header', false ) ) {
        ?>
        <script>
            jQuery(document).ready(function($) {
                $(window).on('scroll', function() {
                    var scroll = $(window).scrollTop();
                    if (scroll > 0) {
                        $('.bottom-header-part-wrapper.hello').addClass('is-sticky');
                    } else {
                        $('.bottom-header-part-wrapper.hello').removeClass('is-sticky');
                    }
                });
            });
        </script>
        <?php
    }
}
add_action( 'wp_footer', 'add_custom_script_in_footer' );

function ecommerce_online_store_enqueue_selected_fonts() {
    $ecommerce_online_store_fonts_url = ecommerce_online_store_get_fonts_url();
    if (!empty($ecommerce_online_store_fonts_url)) {
        wp_enqueue_style('ecommerce-online-store-google-fonts', $ecommerce_online_store_fonts_url, array(), null);
    }
}
add_action('wp_enqueue_scripts', 'ecommerce_online_store_enqueue_selected_fonts');

function ecommerce_online_store_layout_customizer_css() {
    $ecommerce_online_store_margin = get_theme_mod('ecommerce_online_store_layout_width_margin', 50);
    ?>
    <style type="text/css">
        body.site-boxed--layout #page  {
            margin: 0 <?php echo esc_attr($ecommerce_online_store_margin); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'ecommerce_online_store_layout_customizer_css');

function ecommerce_online_store_blog_layout_customizer_css() {
    // Retrieve the blog layout option
    $ecommerce_online_store_blog_layout_option = get_theme_mod('ecommerce_online_store_blog_layout_option_setting', 'Left');

    // Initialize custom CSS variable
    $ecommerce_online_store_custom_css = '';

    // Generate custom CSS based on the layout option
    if ($ecommerce_online_store_blog_layout_option === 'Default') {
        $ecommerce_online_store_custom_css .= '.mag-post-detail { text-align: center; }';
    } elseif ($ecommerce_online_store_blog_layout_option === 'Left') {
        $ecommerce_online_store_custom_css .= '.mag-post-detail { text-align: left; }';
    } elseif ($ecommerce_online_store_blog_layout_option === 'Right') {
        $ecommerce_online_store_custom_css .= '.mag-post-detail { text-align: right; }';
    }

    // Output the combined CSS
    ?>
    <style type="text/css">
        <?php echo wp_kses($ecommerce_online_store_custom_css, array( 'style' => array(), 'text-align' => array() )); ?>
    </style>
    <?php
}
add_action('wp_head', 'ecommerce_online_store_blog_layout_customizer_css');

function ecommerce_online_store_sidebar_width_customizer_css() {
    $ecommerce_online_store_sidebar_width = get_theme_mod('ecommerce_online_store_sidebar_width', '30');
    ?>
    <style type="text/css">
        .right-sidebar .asterthemes-wrapper .asterthemes-page {
            grid-template-columns: auto <?php echo esc_attr($ecommerce_online_store_sidebar_width); ?>%;
        }
        .left-sidebar .asterthemes-wrapper .asterthemes-page {
            grid-template-columns: <?php echo esc_attr($ecommerce_online_store_sidebar_width); ?>% auto;
        }
    </style>
    <?php
}
add_action('wp_head', 'ecommerce_online_store_sidebar_width_customizer_css');

if ( ! function_exists( 'ecommerce_online_store_get_page_title' ) ) {
    function ecommerce_online_store_get_page_title() {
        $ecommerce_online_store_title = '';

        if (is_404()) {
            $ecommerce_online_store_title = esc_html__('Page Not Found', 'ecommerce-online-store');
        } elseif (is_search()) {
            $ecommerce_online_store_title = esc_html__('Search Results for: ', 'ecommerce-online-store') . esc_html(get_search_query());
        } elseif (is_home() && !is_front_page()) {
            $ecommerce_online_store_title = esc_html__('Blogs', 'ecommerce-online-store');
        } elseif (function_exists('is_shop') && is_shop()) {
            $ecommerce_online_store_title = esc_html__('Shop', 'ecommerce-online-store');
        } elseif (is_page()) {
            $ecommerce_online_store_title = get_the_title();
        } elseif (is_single()) {
            $ecommerce_online_store_title = get_the_title();
        } elseif (is_archive()) {
            $ecommerce_online_store_title = get_the_archive_title();
        } else {
            $ecommerce_online_store_title = get_the_archive_title();
        }

        return apply_filters('ecommerce_online_store_page_title', $ecommerce_online_store_title);
    }
}

if ( ! function_exists( 'ecommerce_online_store_has_page_header' ) ) {
    function ecommerce_online_store_has_page_header() {
        // Default to true (display header)
        $ecommerce_online_store_return = true;

        // Custom conditions for disabling the header
        if ('hide-all-devices' === get_theme_mod('ecommerce_online_store_page_header_visibility', 'all-devices')) {
            $ecommerce_online_store_return = false;
        }

        // Apply filters and return
        return apply_filters('ecommerce_online_store_display_page_header', $ecommerce_online_store_return);
    }
}

if ( ! function_exists( 'ecommerce_online_store_page_header_style' ) ) {
    function ecommerce_online_store_page_header_style() {
        $ecommerce_online_store_style = get_theme_mod('ecommerce_online_store_page_header_style', 'default');
        return apply_filters('ecommerce_online_store_page_header_style', $ecommerce_online_store_style);
    }
}

function ecommerce_online_store_page_title_customizer_css() {
    $ecommerce_online_store_layout_option = get_theme_mod('ecommerce_online_store_page_header_layout', 'left');
    ?>
    <style type="text/css">
        .asterthemes-wrapper.page-header-inner {
            <?php if ($ecommerce_online_store_layout_option === 'flex') : ?>
                display: flex;
                justify-content: space-between;
                align-items: center;
            <?php else : ?>
                text-align: <?php echo esc_attr($ecommerce_online_store_layout_option); ?>;
            <?php endif; ?>
        }
    </style>
    <?php
}
add_action('wp_head', 'ecommerce_online_store_page_title_customizer_css');

function ecommerce_online_store_pagetitle_height_css() {
    $ecommerce_online_store_height = get_theme_mod('ecommerce_online_store_pagetitle_height', 50);
    ?>
    <style type="text/css">
        header.page-header {
            padding: <?php echo esc_attr($ecommerce_online_store_height); ?>px 0;
        }
    </style>
    <?php
}
add_action('wp_head', 'ecommerce_online_store_pagetitle_height_css');

function ecommerce_online_store_site_logo_width() {
    $ecommerce_online_store_site_logo_width = get_theme_mod('ecommerce_online_store_site_logo_width', 200);
    ?>
    <style type="text/css">
        .site-logo img {
            max-width: <?php echo esc_attr($ecommerce_online_store_site_logo_width); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'ecommerce_online_store_site_logo_width');

function ecommerce_online_store_menu_font_size_css() {
    $ecommerce_online_store_menu_font_size = get_theme_mod('ecommerce_online_store_menu_font_size', 15);
    ?>
    <style type="text/css">
        .main-navigation a {
            font-size: <?php echo esc_attr($ecommerce_online_store_menu_font_size); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'ecommerce_online_store_menu_font_size_css');

function ecommerce_online_store_sidebar_widget_font_size_css() {
    $ecommerce_online_store_sidebar_widget_font_size = get_theme_mod('ecommerce_online_store_sidebar_widget_font_size', 24);
    ?>
    <style type="text/css">
        h2.wp-block-heading,aside#secondary .widgettitle,aside#secondary .widget-title {
            font-size: <?php echo esc_attr($ecommerce_online_store_sidebar_widget_font_size); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'ecommerce_online_store_sidebar_widget_font_size_css');

// Featured Image Dimension
function ecommerce_online_store_custom_featured_image_css() {
    $ecommerce_online_store_dimension = get_theme_mod('ecommerce_online_store_blog_post_featured_image_dimension', 'default');
    $ecommerce_online_store_width = get_theme_mod('ecommerce_online_store_blog_post_featured_image_custom_width', '');
    $ecommerce_online_store_height = get_theme_mod('ecommerce_online_store_blog_post_featured_image_custom_height', '');
    
    if ($ecommerce_online_store_dimension === 'custom' && $ecommerce_online_store_width && $ecommerce_online_store_height) {
        $ecommerce_online_store_custom_css = "body:not(.single-post) .mag-post-single .mag-post-img img { width: {$ecommerce_online_store_width}px !important; height: {$ecommerce_online_store_height}px !important; }";
        wp_add_inline_style('ecommerce-online-store-style', $ecommerce_online_store_custom_css);
    }
}
add_action('wp_enqueue_scripts', 'ecommerce_online_store_custom_featured_image_css');

// Woocommerce Related Products Settings
function ecommerce_online_store_related_product_css() {
    $ecommerce_online_store_related_product_show_hide = get_theme_mod('ecommerce_online_store_related_product_show_hide', true);

    if ( $ecommerce_online_store_related_product_show_hide != true) {
        ?>
        <style type="text/css">
            .related.products {
                display: none;
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'ecommerce_online_store_related_product_css');

// Woocommerce Product Sale Position 
function ecommerce_online_store_product_sale_position_customizer_css() {
    $ecommerce_online_store_layout_option = get_theme_mod('ecommerce_online_store_product_sale_position', 'left');
    ?>
    <style type="text/css">
        .woocommerce ul.products li.product .onsale {
            <?php if ($ecommerce_online_store_layout_option === 'left') : ?>
                right: auto;
                left: 0px;
            <?php else : ?>
                left: auto;
                right: 0px;
            <?php endif; ?>
        }
    </style>
    <?php
}
add_action('wp_head', 'ecommerce_online_store_product_sale_position_customizer_css');  

//Copyright Alignment
function ecommerce_online_store_footer_copyright_alignment_css() {
    $ecommerce_online_store_footer_bottom_align = get_theme_mod( 'ecommerce_online_store_footer_bottom_align', 'center' );   
    ?>
    <style type="text/css">
        .site-footer .site-footer-bottom .site-footer-bottom-wrapper {
            justify-content: <?php echo esc_attr( $ecommerce_online_store_footer_bottom_align ); ?> 
        }

        /* Mobile Specific */
        @media screen and (max-width: 575px) {
            .site-footer .site-footer-bottom .site-footer-bottom-wrapper {
                justify-content: center;
                text-align:center;
            }
        }
    </style>
    <?php
}
add_action( 'wp_head', 'ecommerce_online_store_footer_copyright_alignment_css' );
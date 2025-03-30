<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package ecommerce_online_store
 */

function ecommerce_online_store_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'ecommerce_online_store_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1360,
		'height'                 => 110,
		'flex-width'         	=> true,
        'flex-height'        	=> true,
		'wp-head-callback'       => 'ecommerce_online_store_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'ecommerce_online_store_custom_header_setup' );

if ( ! function_exists( 'ecommerce_online_store_header_style' ) ) :

add_action( 'wp_enqueue_scripts', 'ecommerce_online_store_header_style' );
function ecommerce_online_store_header_style() {
	if ( get_header_image() ) :
	$ecommerce_online_store_custom_css = "
        header.site-header .header-main-wrapper .bottom-header-outer-wrapper .bottom-header-part{
			background-image:url('".esc_url(get_header_image())."') !important;
			background-position: center;
			background-size: cover !important;
		}";
	   	wp_add_inline_style( 'ecommerce-online-store-style', $ecommerce_online_store_custom_css );
	endif;
}
endif;
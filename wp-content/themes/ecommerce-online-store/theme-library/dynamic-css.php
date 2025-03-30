<?php

/**
 * Dynamic CSS
 */
function ecommerce_online_store_dynamic_css() {
	$ecommerce_online_store_primary_color = get_theme_mod( 'primary_color', '#5c8dff' );

	$ecommerce_online_store_site_title_font       = get_theme_mod( 'ecommerce_online_store_site_title_font', 'Raleway' );
	$ecommerce_online_store_site_description_font = get_theme_mod( 'ecommerce_online_store_site_description_font', 'Raleway' );
	$ecommerce_online_store_header_font           = get_theme_mod( 'ecommerce_online_store_header_font', 'Playfair Display' );
	$ecommerce_online_store_content_font             = get_theme_mod( 'ecommerce_online_store_content_font', 'Jost' );

	// Enqueue Google Fonts
	$ecommerce_online_store_fonts_url = ecommerce_online_store_get_fonts_url();
	if ( ! empty( $ecommerce_online_store_fonts_url ) ) {
		wp_enqueue_style( 'ecommerce-online-store-google-fonts', esc_url( $ecommerce_online_store_fonts_url ), array(), null );
	}

	$ecommerce_online_store_custom_css  = '';
	$ecommerce_online_store_custom_css .= '
    /* Color */
    :root {
        --primary-color: ' . esc_attr( $ecommerce_online_store_primary_color ) . ';
        --header-text-color: ' . esc_attr( '#' . get_header_textcolor() ) . ';
    }
    ';

	$ecommerce_online_store_custom_css .= '
    /* Typography */
    :root {
        --font-heading: "' . esc_attr( $ecommerce_online_store_header_font ) . '", serif;
        --font-main: -apple-system, BlinkMacSystemFont, "' . esc_attr( $ecommerce_online_store_content_font ) . '", "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
    }

    body,
	button, input, select, optgroup, textarea, p {
        font-family: "' . esc_attr( $ecommerce_online_store_content_font ) . '", serif;
	}

	.site-identity p.site-title, h1.site-title a, h1.site-title, p.site-title a, .site-branding h1.site-title a {
        font-family: "' . esc_attr( $ecommerce_online_store_site_title_font ) . '", serif;
	}
    
	p.site-description {
        font-family: "' . esc_attr( $ecommerce_online_store_site_description_font ) . '", serif !important;
	}
    ';

	wp_add_inline_style( 'ecommerce-online-store-style', $ecommerce_online_store_custom_css );
}
add_action( 'wp_enqueue_scripts', 'ecommerce_online_store_dynamic_css', 99 );
<?php
function ecommerce_online_store_get_all_google_fonts() {
    $ecommerce_online_store_webfonts_json = get_template_directory() . '/theme-library/google-webfonts.json';
    if ( ! file_exists( $ecommerce_online_store_webfonts_json ) ) {
        return array();
    }

    $ecommerce_online_store_fonts_json_data = file_get_contents( $ecommerce_online_store_webfonts_json );
    if ( false === $ecommerce_online_store_fonts_json_data ) {
        return array();
    }

    $ecommerce_online_store_all_fonts = json_decode( $ecommerce_online_store_fonts_json_data, true );
    if ( json_last_error() !== JSON_ERROR_NONE ) {
        return array();
    }

    $ecommerce_online_store_google_fonts = array();
    foreach ( $ecommerce_online_store_all_fonts as $ecommerce_online_store_font ) {
        $ecommerce_online_store_google_fonts[ $ecommerce_online_store_font['family'] ] = array(
            'family'   => $ecommerce_online_store_font['family'],
            'variants' => $ecommerce_online_store_font['variants'],
        );
    }
    return $ecommerce_online_store_google_fonts;
}


function ecommerce_online_store_get_all_google_font_families() {
    $ecommerce_online_store_google_fonts  = ecommerce_online_store_get_all_google_fonts();
    $ecommerce_online_store_font_families = array();
    foreach ( $ecommerce_online_store_google_fonts as $ecommerce_online_store_font ) {
        $ecommerce_online_store_font_families[ $ecommerce_online_store_font['family'] ] = $ecommerce_online_store_font['family'];
    }
    return $ecommerce_online_store_font_families;
}

function ecommerce_online_store_get_fonts_url() {
    $ecommerce_online_store_fonts_url = '';
    $ecommerce_online_store_fonts     = array();

    $ecommerce_online_store_all_fonts = ecommerce_online_store_get_all_google_fonts();

    if ( ! empty( get_theme_mod( 'ecommerce_online_store_site_title_font', 'Raleway' ) ) ) {
        $ecommerce_online_store_fonts[] = get_theme_mod( 'ecommerce_online_store_site_title_font', 'Raleway' );
    }

    if ( ! empty( get_theme_mod( 'ecommerce_online_store_site_description_font', 'Raleway' ) ) ) {
        $ecommerce_online_store_fonts[] = get_theme_mod( 'ecommerce_online_store_site_description_font', 'Raleway' );
    }

    if ( ! empty( get_theme_mod( 'ecommerce_online_store_header_font', 'Epilogue' ) ) ) {
        $ecommerce_online_store_fonts[] = get_theme_mod( 'ecommerce_online_store_header_font', 'Epilogue' );
    }

    if ( ! empty( get_theme_mod( 'ecommerce_online_store_content_font', 'Raleway' ) ) ) {
        $ecommerce_online_store_fonts[] = get_theme_mod( 'ecommerce_online_store_content_font', 'Raleway' );
    }

    $ecommerce_online_store_fonts = array_unique( $ecommerce_online_store_fonts );

    foreach ( $ecommerce_online_store_fonts as $ecommerce_online_store_font ) {
        $ecommerce_online_store_variants      = $ecommerce_online_store_all_fonts[ $ecommerce_online_store_font ]['variants'];
        $ecommerce_online_store_font_family[] = $ecommerce_online_store_font . ':' . implode( ',', $ecommerce_online_store_variants );
    }

    $ecommerce_online_store_query_args = array(
        'family' => urlencode( implode( '|', $ecommerce_online_store_font_family ) ),
    );

    if ( ! empty( $ecommerce_online_store_font_family ) ) {
        $ecommerce_online_store_fonts_url = add_query_arg( $ecommerce_online_store_query_args, 'https://fonts.googleapis.com/css' );
    }

    return $ecommerce_online_store_fonts_url;
}
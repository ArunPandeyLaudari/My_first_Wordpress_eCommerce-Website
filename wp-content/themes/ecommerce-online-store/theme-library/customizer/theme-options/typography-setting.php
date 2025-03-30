<?php

/**
 * Typography Settings
 *
 * @package ecommerce_online_store
 */

// Typography Settings
$wp_customize->add_section(
    'ecommerce_online_store_typography_setting',
    array(
        'panel' => 'ecommerce_online_store_theme_options',
        'title' => esc_html__( 'Typography Settings', 'ecommerce-online-store' ),
    )
);

$wp_customize->add_setting(
    'ecommerce_online_store_site_title_font',
    array(
        'default'           => 'Raleway',
        'sanitize_callback' => 'ecommerce_online_store_sanitize_google_fonts',
    )
);

$wp_customize->add_control(
    'ecommerce_online_store_site_title_font',
    array(
        'label'    => esc_html__( 'Site Title Font Family', 'ecommerce-online-store' ),
        'section'  => 'ecommerce_online_store_typography_setting',
        'settings' => 'ecommerce_online_store_site_title_font',
        'type'     => 'select',
        'choices'  => ecommerce_online_store_get_all_google_font_families(),
    )
);

// Typography - Site Description Font.
$wp_customize->add_setting(
	'ecommerce_online_store_site_description_font',
	array(
		'default'           => 'Raleway',
		'sanitize_callback' => 'ecommerce_online_store_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'ecommerce_online_store_site_description_font',
	array(
		'label'    => esc_html__( 'Site Description Font Family', 'ecommerce-online-store' ),
		'section'  => 'ecommerce_online_store_typography_setting',
		'settings' => 'ecommerce_online_store_site_description_font',
		'type'     => 'select',
		'choices'  => ecommerce_online_store_get_all_google_font_families(),
	)
);

// Typography - Header Font.
$wp_customize->add_setting(
	'ecommerce_online_store_header_font',
	array(
		'default'           => 'Playfair Display',
		'sanitize_callback' => 'ecommerce_online_store_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'ecommerce_online_store_header_font',
	array(
		'label'    => esc_html__( 'Heading Font Family', 'ecommerce-online-store' ),
		'section'  => 'ecommerce_online_store_typography_setting',
		'settings' => 'ecommerce_online_store_header_font',
		'type'     => 'select',
		'choices'  => ecommerce_online_store_get_all_google_font_families(),
	)
);

// Typography - Body Font.
$wp_customize->add_setting(
	'ecommerce_online_store_content_font',
	array(
		'default'           => 'Jost',
		'sanitize_callback' => 'ecommerce_online_store_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'ecommerce_online_store_content_font',
	array(
		'label'    => esc_html__( 'Content Font Family', 'ecommerce-online-store' ),
		'section'  => 'ecommerce_online_store_typography_setting',
		'settings' => 'ecommerce_online_store_content_font',
		'type'     => 'select',
		'choices'  => ecommerce_online_store_get_all_google_font_families(),
	)
);
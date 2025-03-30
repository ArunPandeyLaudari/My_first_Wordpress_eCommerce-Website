<?php

/**
 * Pige Title Options
 *
 * @package ecommerce_online_store
 */

$wp_customize->add_section(
	'ecommerce_online_store_page_title_options',
	array(
		'panel' => 'ecommerce_online_store_theme_options',
		'title' => esc_html__( 'Page Title', 'ecommerce-online-store' ),
	)
);

$wp_customize->add_setting(
    'ecommerce_online_store_page_header_visibility',
    array(
        'default'           => 'all-devices',
        'sanitize_callback' => 'ecommerce_online_store_sanitize_select',
    )
);

$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'ecommerce_online_store_page_header_visibility',
        array(
            'label'    => esc_html__( 'Page Header Visibility', 'ecommerce-online-store' ),
            'type'     => 'select',
            'section'  => 'ecommerce_online_store_page_title_options',
            'settings' => 'ecommerce_online_store_page_header_visibility',
            'priority' => 10,
            'choices'  => array(
                'all-devices'        => esc_html__( 'Show on all devices', 'ecommerce-online-store' ),
                'hide-tablet'        => esc_html__( 'Hide on Tablet', 'ecommerce-online-store' ),
                'hide-mobile'        => esc_html__( 'Hide on Mobile', 'ecommerce-online-store' ),
                'hide-tablet-mobile' => esc_html__( 'Hide on Tablet & Mobile', 'ecommerce-online-store' ),
                'hide-all-devices'   => esc_html__( 'Hide on all devices', 'ecommerce-online-store' ),
            ),
        )
    )
);


$wp_customize->add_setting( 'ecommerce_online_store_page_title_background_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Ecommerce_Online_Store_Separator_Custom_Control( $wp_customize, 'ecommerce_online_store_page_title_background_separator', array(
	'label' => __( 'Page Title BG Image & Color Setting', 'ecommerce-online-store' ),
	'section' => 'ecommerce_online_store_page_title_options',
	'settings' => 'ecommerce_online_store_page_title_background_separator',
)));


$wp_customize->add_setting(
	'ecommerce_online_store_page_header_style',
	array(
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
		'default'           => False,
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_page_header_style',
		array(
			'label'   => esc_html__('Page Title Background Image', 'ecommerce-online-store'),
			'section' => 'ecommerce_online_store_page_title_options',
		)
	)
);

$wp_customize->add_setting( 'ecommerce_online_store_page_header_background_image', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ecommerce_online_store_page_header_background_image', array(
    'label'    => __( 'Background Image', 'ecommerce-online-store' ),
	'description' => __('Choose either a background image or a color. If a background image is selected, the background color will not be visible.', 'ecommerce-online-store'),
    'section'  => 'ecommerce_online_store_page_title_options',
    'settings' => 'ecommerce_online_store_page_header_background_image',
	'active_callback' => 'ecommerce_online_store_is_pagetitle_bcakground_image_enabled',
)));


$wp_customize->add_setting('ecommerce_online_store_page_header_image_height', array(
	'default'           => 200,
	'sanitize_callback' => 'ecommerce_online_store_sanitize_range_value',
));

$wp_customize->add_control(new Ecommerce_Online_Store_Customize_Range_Control($wp_customize, 'ecommerce_online_store_page_header_image_height', array(
		'label'       => __('Image Height', 'ecommerce-online-store'),
		'section'     => 'ecommerce_online_store_page_title_options',
		'settings'    => 'ecommerce_online_store_page_header_image_height',
		'active_callback' => 'ecommerce_online_store_is_pagetitle_bcakground_image_enabled',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 1000,
			'step' => 5,
		),
)));


$wp_customize->add_setting('ecommerce_online_store_page_title_background_color_setting', array(
    'default' => '#f5f5f5',
    'sanitize_callback' => 'sanitize_hex_color',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ecommerce_online_store_page_title_background_color_setting', array(
    'label' => __('Page Title Background Color', 'ecommerce-online-store'),
    'section' => 'ecommerce_online_store_page_title_options',
)));

$wp_customize->add_setting('ecommerce_online_store_pagetitle_height', array(
    'default'           => 50,
    'sanitize_callback' => 'ecommerce_online_store_sanitize_range_value',
));

$wp_customize->add_control(new Ecommerce_Online_Store_Customize_Range_Control($wp_customize, 'ecommerce_online_store_pagetitle_height', array(
    'label'       => __('Set Height', 'ecommerce-online-store'),
    'description' => __('This setting controls the page title height when no background image is set. If a background image is set, this setting will not apply.', 'ecommerce-online-store'),
    'section'     => 'ecommerce_online_store_page_title_options',
    'settings'    => 'ecommerce_online_store_pagetitle_height',
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 300,
        'step' => 5,
    ),
)));

$wp_customize->add_setting( 'ecommerce_online_store_page_title_style_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Ecommerce_Online_Store_Separator_Custom_Control( $wp_customize, 'ecommerce_online_store_page_title_style_separator', array(
	'label' => __( 'Page Title Styling Setting', 'ecommerce-online-store' ),
	'section' => 'ecommerce_online_store_page_title_options',
	'settings' => 'ecommerce_online_store_page_title_style_separator',
)));


$wp_customize->add_setting( 'ecommerce_online_store_page_header_heading_tag', array(
	'default'   => 'h1',
	'sanitize_callback' => 'ecommerce_online_store_sanitize_select',
) );

$wp_customize->add_control( 'ecommerce_online_store_page_header_heading_tag', array(
	'label'   => __( 'Page Title Heading Tag', 'ecommerce-online-store' ),
	'section' => 'ecommerce_online_store_page_title_options',
	'type'    => 'select',
	'choices' => array(
		'h1' => __( 'H1', 'ecommerce-online-store' ),
		'h2' => __( 'H2', 'ecommerce-online-store' ),
		'h3' => __( 'H3', 'ecommerce-online-store' ),
		'h4' => __( 'H4', 'ecommerce-online-store' ),
		'h5' => __( 'H5', 'ecommerce-online-store' ),
		'h6' => __( 'H6', 'ecommerce-online-store' ),
		'p' => __( 'p', 'ecommerce-online-store' ),
		'a' => __( 'a', 'ecommerce-online-store' ),
		'div' => __( 'div', 'ecommerce-online-store' ),
		'span' => __( 'span', 'ecommerce-online-store' ),
	),
) );



$wp_customize->add_setting('ecommerce_online_store_page_header_layout', array(
	'default' => 'left',
	'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('ecommerce_online_store_page_header_layout', array(
	'label' => __('Style', 'ecommerce-online-store'),
	'section' => 'ecommerce_online_store_page_title_options',
	'description' => __('"Flex Layout Style" wont work below 600px (mobile media)', 'ecommerce-online-store'),
	'settings' => 'ecommerce_online_store_page_header_layout',
	'type' => 'radio',
	'choices' => array(
		'left' => __('Classic', 'ecommerce-online-store'),
		'right' => __('Aligned Right', 'ecommerce-online-store'),
		'center' => __('Centered Focus', 'ecommerce-online-store'),
		'flex' => __('Flex Layout', 'ecommerce-online-store'),
	),
));

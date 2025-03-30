<?php

/**
 * Banner Section
 *
 * @package ecommerce_online_store
 */

$wp_customize->add_section(
	'ecommerce_online_store_banner_section',
	array(
		'panel'    => 'ecommerce_online_store_front_page_options',
		'title'    => esc_html__( 'Banner Section', 'ecommerce-online-store' ),
		'priority' => 10,
	)
);

// Banner Section - Enable Section.
$wp_customize->add_setting(
	'ecommerce_online_store_enable_banner_section',
	array(
		'default'           => true,
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_enable_banner_section',
		array(
			'label'    => esc_html__( 'Enable Banner Section', 'ecommerce-online-store' ),
			'section'  => 'ecommerce_online_store_banner_section',
			'settings' => 'ecommerce_online_store_enable_banner_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'ecommerce_online_store_enable_banner_section',
		array(
			'selector' => '#ecommerce_online_store_banner_section .section-link',
			'settings' => 'ecommerce_online_store_enable_banner_section',
		)
	);
}

// Banner Section - Banner Slider Content Type.
$wp_customize->add_setting(
	'ecommerce_online_store_banner_slider_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'ecommerce_online_store_sanitize_select',
	)
);

$wp_customize->add_control(
	'ecommerce_online_store_banner_slider_content_type',
	array(
		'label'           => esc_html__( 'Select Banner Slider Content Type', 'ecommerce-online-store' ),
		'section'         => 'ecommerce_online_store_banner_section',
		'settings'        => 'ecommerce_online_store_banner_slider_content_type',
		'type'            => 'select',
		'active_callback' => 'ecommerce_online_store_is_banner_slider_section_enabled',
		'choices'         => array(
			'page' => esc_html__( 'Page', 'ecommerce-online-store' ),
			'post' => esc_html__( 'Post', 'ecommerce-online-store' ),
		),
	)
);

for ( $ecommerce_online_store_i = 1; $ecommerce_online_store_i <= 3; $ecommerce_online_store_i++ ) {

	// Banner Section - Select Banner Post.
	$wp_customize->add_setting(
		'ecommerce_online_store_banner_slider_content_post_' . $ecommerce_online_store_i,
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'ecommerce_online_store_banner_slider_content_post_' . $ecommerce_online_store_i,
		array(
			/* Translators: %d is the banner post number */
			'label'           => sprintf( esc_html__( 'Select Post %d', 'ecommerce-online-store' ), $ecommerce_online_store_i ),
			'section'         => 'ecommerce_online_store_banner_section',
			'settings'        => 'ecommerce_online_store_banner_slider_content_post_' . $ecommerce_online_store_i,
			'active_callback' => 'ecommerce_online_store_is_banner_slider_section_and_content_type_post_enabled',
			'type'            => 'select',
			'choices'         => ecommerce_online_store_get_post_choices(),
		)
	);

	// Banner Section - Select Banner Page.
	$wp_customize->add_setting(
		'ecommerce_online_store_banner_slider_content_page_' . $ecommerce_online_store_i,
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'ecommerce_online_store_banner_slider_content_page_' . $ecommerce_online_store_i,
		array(
			/* Translators: %d is the banner page number */
			'label'           => sprintf( esc_html__( 'Select Page %d', 'ecommerce-online-store' ), $ecommerce_online_store_i ),
			'section'         => 'ecommerce_online_store_banner_section',
			'settings'        => 'ecommerce_online_store_banner_slider_content_page_' . $ecommerce_online_store_i,
			'active_callback' => 'ecommerce_online_store_is_banner_slider_section_and_content_type_page_enabled',
			'type'            => 'select',
			'choices'         => ecommerce_online_store_get_page_choices(),
		)
	);

	// Banner Section - Button Label.
	$wp_customize->add_setting(
		'ecommerce_online_store_banner_button_label_' . $ecommerce_online_store_i,
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'ecommerce_online_store_banner_button_label_' . $ecommerce_online_store_i,
		array(
			/* Translators: %d is the button label number */
			'label'           => sprintf( esc_html__( 'Button Label %d', 'ecommerce-online-store' ), $ecommerce_online_store_i ),
			'section'         => 'ecommerce_online_store_banner_section',
			'settings'        => 'ecommerce_online_store_banner_button_label_' . $ecommerce_online_store_i,
			'type'            => 'text',
			'active_callback' => 'ecommerce_online_store_is_banner_slider_section_enabled',
		)
	);

	// Banner Section - Button Link.
	$wp_customize->add_setting(
		'ecommerce_online_store_banner_button_link_' . $ecommerce_online_store_i,
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'ecommerce_online_store_banner_button_link_' . $ecommerce_online_store_i,
		array(
			/* Translators: %d is the button link number */
			'label'           => sprintf( esc_html__( 'Button Link %d', 'ecommerce-online-store' ), $ecommerce_online_store_i ),
			'section'         => 'ecommerce_online_store_banner_section',
			'settings'        => 'ecommerce_online_store_banner_button_link_' . $ecommerce_online_store_i,
			'type'            => 'url',
			'active_callback' => 'ecommerce_online_store_is_banner_slider_section_enabled',
		)
	);
	$wp_customize->add_setting( 'ecommerce_online_store_banner_second_button_label_' . $ecommerce_online_store_i, array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'ecommerce_online_store_banner_second_button_label_' . $ecommerce_online_store_i, array(
        /* Translators: %d is the second button label number */
        'label'    => sprintf( esc_html__( 'Second Button Label %d', 'ecommerce-online-store' ), $ecommerce_online_store_i ),
        'section'  => 'ecommerce_online_store_banner_section',
        'type'     => 'text',
		'active_callback' => 'ecommerce_online_store_is_banner_slider_section_enabled',
    ) );

    $wp_customize->add_setting( 'ecommerce_online_store_banner_second_button_link_' . $ecommerce_online_store_i, array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'ecommerce_online_store_banner_second_button_link_' . $ecommerce_online_store_i, array(
        /* Translators: %d is the second button link number */
        'label'    => sprintf( esc_html__( 'Second Button Link %d', 'ecommerce-online-store' ), $ecommerce_online_store_i ),
        'section'  => 'ecommerce_online_store_banner_section',
        'type'     => 'url',
		'active_callback' => 'ecommerce_online_store_is_banner_slider_section_enabled',
    ) );
}
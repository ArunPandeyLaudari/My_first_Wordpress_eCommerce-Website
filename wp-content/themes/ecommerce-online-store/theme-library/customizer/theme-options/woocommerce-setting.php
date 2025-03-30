<?php

/**
 * WooCommerce Settings
 *
 * @package ecommerce_online_store
 */

$wp_customize->add_section(
	'ecommerce_online_store_woocommerce_settings',
	array(
		'panel' => 'ecommerce_online_store_theme_options',
		'title' => esc_html__( 'WooCommerce Settings', 'ecommerce-online-store' ),
	)
);

//WooCommerce - Products per page.
$wp_customize->add_setting( 'ecommerce_online_store_products_per_page', array(
    'default'           => 9,
    'sanitize_callback' => 'absint',
));

$wp_customize->add_control( 'ecommerce_online_store_products_per_page', array(
    'type'        => 'number',
    'section'     => 'ecommerce_online_store_woocommerce_settings',
    'label'       => __( 'Products Per Page', 'ecommerce-online-store' ),
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 50,
        'step' => 1,
    ),
));

//WooCommerce - Products per row.
$wp_customize->add_setting( 'ecommerce_online_store_products_per_row', array(
    'default'           => '3',
    'sanitize_callback' => 'ecommerce_online_store_sanitize_choices',
) );

$wp_customize->add_control( 'ecommerce_online_store_products_per_row', array(
    'label'    => __( 'Products Per Row', 'ecommerce-online-store' ),
    'section'  => 'ecommerce_online_store_woocommerce_settings',
    'settings' => 'ecommerce_online_store_products_per_row',
    'type'     => 'select',
    'choices'  => array(
        '2' => '2',
		'3' => '3',
		'4' => '4',
    ),
) );

//WooCommerce - Show / Hide Related Product.
$wp_customize->add_setting(
	'ecommerce_online_store_related_product_show_hide',
	array(
		'default'           => true,
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_related_product_show_hide',
		array(
			'label'   => esc_html__( 'Show / Hide Related product', 'ecommerce-online-store' ),
			'section' => 'ecommerce_online_store_woocommerce_settings',
		)
	)
);

// WooCommerce - Product Sale Position.
$wp_customize->add_setting(
	'ecommerce_online_store_product_sale_position', 
	array(
		'default' => 'left',
		'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control(
	'ecommerce_online_store_product_sale_position', 
	array(
		'label' => __('Product Sale Position', 'ecommerce-online-store'),
		'section' => 'ecommerce_online_store_woocommerce_settings',
		'settings' => 'ecommerce_online_store_product_sale_position',
		'type' => 'radio',
		'choices' => 
	array(
		'left' => __('Left', 'ecommerce-online-store'),
		'right' => __('Right', 'ecommerce-online-store'),
	),
));
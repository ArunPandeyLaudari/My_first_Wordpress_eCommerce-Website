<?php

/**
 * Header Options
 *
 * @package ecommerce_online_store
 */

 // ---------------------------------------- GENERAL OPTIONBS ----------------------------------------------------


// ---------------------------------------- PRELOADER ----------------------------------------------------

$wp_customize->add_section(
	'ecommerce_online_store_general_options',
	array(
		'panel' => 'ecommerce_online_store_theme_options',
		'title' => esc_html__( 'General Options', 'ecommerce-online-store' ),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'ecommerce_online_store_preloader_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Ecommerce_Online_Store_Separator_Custom_Control( $wp_customize, 'ecommerce_online_store_preloader_separator', array(
	'label' => __( 'Enable / Disable Site Preloader Section', 'ecommerce-online-store' ),
	'section' => 'ecommerce_online_store_general_options',
	'settings' => 'ecommerce_online_store_preloader_separator',
) ) );

// General Options - Enable Preloader.
$wp_customize->add_setting(
	'ecommerce_online_store_enable_preloader',
	array(
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
		'default'           => false,
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_enable_preloader',
		array(
			'label'   => esc_html__( 'Enable Preloader', 'ecommerce-online-store' ),
			'section' => 'ecommerce_online_store_general_options',
		)
	)
);

// Preloader Style Setting
$wp_customize->add_setting(
	'ecommerce_online_store_preloader_style',
	array(
		'default'           => 'style1',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'ecommerce_online_store_preloader_style',
	array(
		'type'     => 'select',
		'label'    => esc_html__('Select Preloader Styles', 'ecommerce-online-store'),
		'active_callback' => 'ecommerce_online_store_is_preloader_style',
		'section'  => 'ecommerce_online_store_general_options',
		'choices'  => array(
			'style1' => esc_html__('Style 1', 'ecommerce-online-store'),
			'style2' => esc_html__('Style 2', 'ecommerce-online-store'),
			'style3' => esc_html__('Style 3', 'ecommerce-online-store'),
		),
	)
);

// ---------------------------------------- PAGINATION ----------------------------------------------------


// Add Separator Custom Control
$wp_customize->add_setting( 'ecommerce_online_store_pagination_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Ecommerce_Online_Store_Separator_Custom_Control( $wp_customize, 'ecommerce_online_store_pagination_separator', array(
	'label' => __( 'Enable / Disable Pagination Section', 'ecommerce-online-store' ),
	'section' => 'ecommerce_online_store_general_options',
	'settings' => 'ecommerce_online_store_pagination_separator',
) ) );

// Pagination - Enable Pagination.
$wp_customize->add_setting(
	'ecommerce_online_store_enable_pagination',
	array(
		'default'           => true,
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_enable_pagination',
		array(
			'label'    => esc_html__( 'Enable Pagination', 'ecommerce-online-store' ),
			'section'  => 'ecommerce_online_store_general_options',
			'settings' => 'ecommerce_online_store_enable_pagination',
			'type'     => 'checkbox',
		)
	)
);

// Pagination - Pagination Type.
$wp_customize->add_setting(
	'ecommerce_online_store_pagination_type',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'ecommerce_online_store_sanitize_select',
	)
);

$wp_customize->add_control(
	'ecommerce_online_store_pagination_type',
	array(
		'label'           => esc_html__( 'Pagination Type', 'ecommerce-online-store' ),
		'section'         => 'ecommerce_online_store_general_options',
		'settings'        => 'ecommerce_online_store_pagination_type',
		'active_callback' => 'ecommerce_online_store_is_pagination_enabled',
		'type'            => 'select',
		'choices'         => array(
			'default' => __( 'Default (Older/Newer)', 'ecommerce-online-store' ),
			'numeric' => __( 'Numeric', 'ecommerce-online-store' ),
		),
	)
);

// ---------------------------------------- BREADCRUMB ----------------------------------------------------


// Add Separator Custom Control
$wp_customize->add_setting( 'ecommerce_online_store_breadcrumb_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Ecommerce_Online_Store_Separator_Custom_Control( $wp_customize, 'ecommerce_online_store_breadcrumb_separators', array(
	'label' => __( 'Enable / Disable Breadcrumb Section', 'ecommerce-online-store' ),
	'section' => 'ecommerce_online_store_general_options',
	'settings' => 'ecommerce_online_store_breadcrumb_separators',
)));

// Breadcrumb - Enable Breadcrumb.
$wp_customize->add_setting(
	'ecommerce_online_store_enable_breadcrumb',
	array(
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_enable_breadcrumb',
		array(
			'label'   => esc_html__( 'Enable Breadcrumb', 'ecommerce-online-store' ),
			'section' => 'ecommerce_online_store_general_options',
		)
	)
);

// Breadcrumb - Separator.
$wp_customize->add_setting(
	'ecommerce_online_store_breadcrumb_separator',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '/',
	)
);

$wp_customize->add_control(
	'ecommerce_online_store_breadcrumb_separator',
	array(
		'label'           => esc_html__( 'Separator', 'ecommerce-online-store' ),
		'active_callback' => 'ecommerce_online_store_is_breadcrumb_enabled',
		'section'         => 'ecommerce_online_store_general_options',
	)
);



// ---------------------------------------- Website layout ----------------------------------------------------


// Add Separator Custom Control
$wp_customize->add_setting( 'ecommerce_online_store_layuout_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Ecommerce_Online_Store_Separator_Custom_Control( $wp_customize, 'ecommerce_online_store_layuout_separator', array(
	'label' => __( 'Website Layout Setting', 'ecommerce-online-store' ),
	'section' => 'ecommerce_online_store_general_options',
	'settings' => 'ecommerce_online_store_layuout_separator',
)));


$wp_customize->add_setting(
	'ecommerce_online_store_website_layout',
	array(
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
		'default'           => false,
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_website_layout',
		array(
			'label'   => esc_html__('Boxed Layout', 'ecommerce-online-store'),
			'section' => 'ecommerce_online_store_general_options',
		)
	)
);


$wp_customize->add_setting('ecommerce_online_store_layout_width_margin', array(
	'default'           => 50,
	'sanitize_callback' => 'ecommerce_online_store_sanitize_range_value',
));

$wp_customize->add_control(new Ecommerce_Online_Store_Customize_Range_Control($wp_customize, 'ecommerce_online_store_layout_width_margin', array(
		'label'       => __('Set Width', 'ecommerce-online-store'),
		'description' => __('Adjust the width around the website layout by moving the slider. Use this setting to customize the appearance of your site to fit your design preferences.', 'ecommerce-online-store'),
		'section'     => 'ecommerce_online_store_general_options',
		'settings'    => 'ecommerce_online_store_layout_width_margin',
		'active_callback' => 'ecommerce_online_store_is_layout_enabled',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 130,
			'step' => 1,
		),
)));




// ---------------------------------------- HEADER OPTIONS ----------------------------------------------------	


$wp_customize->add_section(
	'ecommerce_online_store_header_options',
	array(
		'panel' => 'ecommerce_online_store_theme_options',
		'title' => esc_html__( 'Header Options', 'ecommerce-online-store' ),
	)
);

// Add setting for sticky header
$wp_customize->add_setting(
	'ecommerce_online_store_enable_sticky_header',
	array(
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
		'default'           => false,
	)
);

// Add control for sticky header setting
$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_enable_sticky_header',
		array(
			'label'   => esc_html__( 'Enable Sticky Header', 'ecommerce-online-store' ),
			'section' => 'ecommerce_online_store_header_options',
		)
	)
);

// Header Options - Enable Topbar.
$wp_customize->add_setting(
	'ecommerce_online_store_enable_topbar',
	array(
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
		'default'           => false,
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_enable_topbar',
		array(
			'label'   => esc_html__( 'Enable Topbar', 'ecommerce-online-store' ),
			'section' => 'ecommerce_online_store_header_options',
		)
	)
);

// Header Options - Contact Number.
$wp_customize->add_setting(
	'ecommerce_online_store_discount_topbar_text',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'ecommerce_online_store_discount_topbar_text',
	array(
		'label'           => esc_html__( 'Topbar Discount Text', 'ecommerce-online-store' ),
		'section'         => 'ecommerce_online_store_header_options',
		'type'            => 'text',
		'active_callback' => 'ecommerce_online_store_is_topbar_enabled',
	)
);

// Header Options - Enable Search.
$wp_customize->add_setting(
	'ecommerce_online_store_enable_search',
	array(
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_enable_search',
		array(
			'label'   => esc_html__( 'Enable Search', 'ecommerce-online-store' ),
			'section' => 'ecommerce_online_store_header_options',
			'active_callback' => 'ecommerce_online_store_is_topbar_enabled',
		)
	)
);

// icon // 
$wp_customize->add_setting(
	'ecommerce_online_store_logout_icon',
	array(
        'default' => 'fas fa-sign-out-alt',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
		
	)
);	

$wp_customize->add_control(new Ecommerce_Online_Store_Change_Icon_Control($wp_customize, 
	'ecommerce_online_store_logout_icon',
	array(
	    'label'   		=> __('Logout  Icon','ecommerce-online-store'),
	    'section' 		=> 'ecommerce_online_store_header_options',
		'iconset' => 'fa',
	))  
);


// icon // 
$wp_customize->add_setting(
	'ecommerce_online_store_shopping_cart_icon',
	array(
        'default' => 'fas fa-shopping-basket',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
		
	)
);	

$wp_customize->add_control(new Ecommerce_Online_Store_Change_Icon_Control($wp_customize, 
	'ecommerce_online_store_shopping_cart_icon',
	array(
	    'label'   		=> __('Shopping Cart Icon','ecommerce-online-store'),
	    'section' 		=> 'ecommerce_online_store_header_options',
		'iconset' => 'fa',
	))  
);

// Add Separator Custom Control
$wp_customize->add_setting( 'ecommerce_online_store_menu_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Ecommerce_Online_Store_Separator_Custom_Control( $wp_customize, 'ecommerce_online_store_menu_separator', array(
	'label' => __( 'Menu Settings', 'ecommerce-online-store' ),
	'section' => 'ecommerce_online_store_header_options',
	'settings' => 'ecommerce_online_store_menu_separator',
)));

$wp_customize->add_setting( 'ecommerce_online_store_menu_font_size', array(
    'default'           => 15,
    'sanitize_callback' => 'absint',
) );

// Add control for site title size
$wp_customize->add_control( 'ecommerce_online_store_menu_font_size', array(
    'type'        => 'number',
    'section'     => 'ecommerce_online_store_header_options',
    'label'       => __( 'Menu Font Size ', 'ecommerce-online-store' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
));

$wp_customize->add_setting( 'menu_text_transform', array(
    'default'           => 'none', // Default value for text transform
    'sanitize_callback' => 'sanitize_text_field',
) );

// Add control for menu text transform
$wp_customize->add_control( 'menu_text_transform', array(
    'type'     => 'select',
    'section'  => 'ecommerce_online_store_header_options', // Adjust the section as needed
    'label'    => __( 'Menu Text Transform', 'ecommerce-online-store' ),
    'choices'  => array(
        'none'       => __( 'None', 'ecommerce-online-store' ),
        'capitalize' => __( 'Capitalize', 'ecommerce-online-store' ),
        'uppercase'  => __( 'Uppercase', 'ecommerce-online-store' ),
        'lowercase'  => __( 'Lowercase', 'ecommerce-online-store' ),
    ),
) );

// Menu Text Color 
$wp_customize->add_setting(
	'ecommerce_online_store_menu_text_color', 
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, 
		'ecommerce_online_store_menu_text_color', 
		array(
			'label' => __('Menu Color', 'ecommerce-online-store'),
			'section' => 'ecommerce_online_store_header_options',
		)
	)
);

// Sub Menu Text Color 
$wp_customize->add_setting(
	'ecommerce_online_store_sub_menu_text_color', 
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, 
		'ecommerce_online_store_sub_menu_text_color', 
		array(
			'label' => __('Sub Menu Color', 'ecommerce-online-store'),
			'section' => 'ecommerce_online_store_header_options',
		)
	)
);

// ----------------------------------------SITE IDENTITY----------------------------------------------------


// Site Logo - Enable Setting.
$wp_customize->add_setting(
	'ecommerce_online_store_enable_site_logo',
	array(
		'default'           => true, // Default is to display the logo.
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch', // Sanitize using a custom switch function.
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_enable_site_logo',
		array(
			'label'    => esc_html__( 'Enable Site Logo', 'ecommerce-online-store' ),
			'section'  => 'title_tagline', // Section to add this control.
			'settings' => 'ecommerce_online_store_enable_site_logo',
		)
	)
);

// Site Title - Enable Setting.
$wp_customize->add_setting(
	'ecommerce_online_store_enable_site_title_setting',
	array(
		'default'           => false,
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_enable_site_title_setting',
		array(
			'label'    => esc_html__( 'Enable Site Title', 'ecommerce-online-store' ),
			'section'  => 'title_tagline',
			'settings' => 'ecommerce_online_store_enable_site_title_setting',
		)
	)
);

// Tagline - Enable Setting.
$wp_customize->add_setting(
	'ecommerce_online_store_enable_tagline_setting',
	array(
		'default'           => false,
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_enable_tagline_setting',
		array(
			'label'    => esc_html__( 'Enable Tagline', 'ecommerce-online-store' ),
			'section'  => 'title_tagline',
			'settings' => 'ecommerce_online_store_enable_tagline_setting',
		)
	)
);

$wp_customize->add_setting( 'ecommerce_online_store_site_title_size', array(
    'default'           => 40, // Default font size in pixels
    'sanitize_callback' => 'absint', // Sanitize the input as a positive integer
) );

// Add control for site title size
$wp_customize->add_control( 'ecommerce_online_store_site_title_size', array(
    'type'        => 'number',
    'section'     => 'title_tagline', // You can change this section to your preferred section
    'label'       => __( 'Site Title Font Size ', 'ecommerce-online-store' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
) );

$wp_customize->add_setting('ecommerce_online_store_site_logo_width', array(
    'default'           => 200,
    'sanitize_callback' => 'ecommerce_online_store_sanitize_range_value',
));

$wp_customize->add_control(new Ecommerce_Online_Store_Customize_Range_Control($wp_customize, 'ecommerce_online_store_site_logo_width', array(
    'label'       => __('Adjust Site Logo Width', 'ecommerce-online-store'),
    'description' => __('This setting controls the Width of Site Logo', 'ecommerce-online-store'),
    'section'     => 'title_tagline',
    'settings'    => 'ecommerce_online_store_site_logo_width',
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 400,
        'step' => 5,
    ),
)));
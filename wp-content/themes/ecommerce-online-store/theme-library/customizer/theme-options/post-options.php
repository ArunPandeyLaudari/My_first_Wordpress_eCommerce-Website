<?php

/**
 * Post Options
 *
 * @package ecommerce_online_store
 */

$wp_customize->add_section(
	'ecommerce_online_store_post_options',
	array(
		'title' => esc_html__( 'Post Options', 'ecommerce-online-store' ),
		'panel' => 'ecommerce_online_store_theme_options',
	)
);

// Post Options - Show / Hide Feature Image.
$wp_customize->add_setting(
	'ecommerce_online_store_post_hide_feature_image',
	array(
		'default'           => true,
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_post_hide_feature_image',
		array(
			'label'   => esc_html__( 'Show / Hide Featured Image', 'ecommerce-online-store' ),
			'section' => 'ecommerce_online_store_post_options',
		)
	)
);

// Post Options - Show / Hide Post Heading.
$wp_customize->add_setting(
	'ecommerce_online_store_post_hide_post_heading',
	array(
		'default'           => true,
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_post_hide_post_heading',
		array(
			'label'   => esc_html__( 'Show / Hide Post Heading', 'ecommerce-online-store' ),
			'section' => 'ecommerce_online_store_post_options',
		)
	)
);

// Post Options - Show / Hide Post Content.
$wp_customize->add_setting(
	'ecommerce_online_store_post_hide_post_content',
	array(
		'default'           => true,
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_post_hide_post_content',
		array(
			'label'   => esc_html__( 'Show / Hide Post Content', 'ecommerce-online-store' ),
			'section' => 'ecommerce_online_store_post_options',
		)
	)
);

// Post Options - Show / Hide Date.
$wp_customize->add_setting(
	'ecommerce_online_store_post_hide_date',
	array(
		'default'           => true,
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_post_hide_date',
		array(
			'label'   => esc_html__( 'Show / Hide Date', 'ecommerce-online-store' ),
			'section' => 'ecommerce_online_store_post_options',
		)
	)
);

// Post Options - Show / Hide Author.
$wp_customize->add_setting(
	'ecommerce_online_store_post_hide_author',
	array(
		'default'           => true,
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_post_hide_author',
		array(
			'label'   => esc_html__( 'Show / Hide Author', 'ecommerce-online-store' ),
			'section' => 'ecommerce_online_store_post_options',
		)
	)
);

// Post Options - Show / Hide Comments.
$wp_customize->add_setting(
	'ecommerce_online_store_post_hide_comments',
	array(
		'default'           => true,
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_post_hide_comments',
		array(
			'label'   => esc_html__( 'Show / Hide Comments', 'ecommerce-online-store' ),
			'section' => 'ecommerce_online_store_post_options',
		)
	)
);

// Post Options - Show / Hide Time.
$wp_customize->add_setting(
	'ecommerce_online_store_post_hide_time',
	array(
		'default'           => true,
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_post_hide_time',
		array(
			'label'   => esc_html__( 'Show / Hide Time', 'ecommerce-online-store' ),
			'section' => 'ecommerce_online_store_post_options',
		)
	)
);

// Post Options - Show / Hide Category.
$wp_customize->add_setting(
	'ecommerce_online_store_post_hide_category',
	array(
		'default'           => true,
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_post_hide_category',
		array(
			'label'   => esc_html__( 'Show / Hide Category', 'ecommerce-online-store' ),
			'section' => 'ecommerce_online_store_post_options',
		)
	)
);


// ---------------------------------------- Post layout ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'ecommerce_online_store_archive_layuout_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Ecommerce_Online_Store_Separator_Custom_Control( $wp_customize, 'ecommerce_online_store_archive_layuout_separator', array(
	'label' => __( 'Archive/Blogs Layout Setting', 'ecommerce-online-store' ),
	'section' => 'ecommerce_online_store_post_options',
	'settings' => 'ecommerce_online_store_archive_layuout_separator',
)));

// Archive Layout - Column Layout.
$wp_customize->add_setting(
	'ecommerce_online_store_archive_column_layout',
	array(
		'default'           => 'column-1',
		'sanitize_callback' => 'ecommerce_online_store_sanitize_select',
	)
);

$wp_customize->add_control(
	'ecommerce_online_store_archive_column_layout',
	array(
		'label'   => esc_html__( 'Select Posts Layout', 'ecommerce-online-store' ),
		'section' => 'ecommerce_online_store_post_options',
		'type'    => 'select',
		'choices' => array(
			'column-1' => __( 'Column 1', 'ecommerce-online-store' ),
			'column-2' => __( 'Column 2', 'ecommerce-online-store' ),
			'column-3' => __( 'Column 3', 'ecommerce-online-store' ),
		),
	)
);

$wp_customize->add_setting('ecommerce_online_store_blog_layout_option_setting',array(
	'default' => 'Left',
	'sanitize_callback' => 'ecommerce_online_store_sanitize_choices'
  ));
  $wp_customize->add_control(new Ecommerce_Online_Store_Image_Radio_Control($wp_customize, 'ecommerce_online_store_blog_layout_option_setting', array(
	'type' => 'select',
	'label' => __('Blog Content Alignment','ecommerce-online-store'),
	'section' => 'ecommerce_online_store_post_options',
	'choices' => array(
		'Left' => esc_url(get_template_directory_uri()).'/resource/img/layout-2.png',
		'Default' => esc_url(get_template_directory_uri()).'/resource/img/layout-1.png',
		'Right' => esc_url(get_template_directory_uri()).'/resource/img/layout-3.png',
))));


// ---------------------------------------- Read More ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'ecommerce_online_store_readmore_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Ecommerce_Online_Store_Separator_Custom_Control( $wp_customize, 'ecommerce_online_store_readmore_separators', array(
	'label' => __( 'Read More Button Settings', 'ecommerce-online-store' ),
	'section' => 'ecommerce_online_store_post_options',
	'settings' => 'ecommerce_online_store_readmore_separators',
)));


// Post Options - Show / Hide Read More Button.
$wp_customize->add_setting(
	'ecommerce_online_store_post_readmore_button',
	array(
		'default'           => true,
		'sanitize_callback' => 'ecommerce_online_store_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Online_Store_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_online_store_post_readmore_button',
		array(
			'label'   => esc_html__( 'Show / Hide Read More Button', 'ecommerce-online-store' ),
			'section' => 'ecommerce_online_store_post_options',
		)
	)
);

$wp_customize->add_setting(
    'ecommerce_online_store_readmore_btn_icon',
    array(
        'default' => 'fas fa-chevron-right', // Set default icon here
        'sanitize_callback' => 'sanitize_text_field',
        'capability' => 'edit_theme_options',
    )
);

$wp_customize->add_control(new Ecommerce_Online_Store_Change_Icon_Control(
    $wp_customize, 
    'ecommerce_online_store_readmore_btn_icon',
    array(
        'label'    => __('Read More Icon','ecommerce-online-store'),
        'section'  => 'ecommerce_online_store_post_options',
        'iconset'  => 'fa',
    )
));

$wp_customize->add_setting(
	'ecommerce_online_store_readmore_button_text',
	array(
		'default'           => 'Read More',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'ecommerce_online_store_readmore_button_text',
	array(
		'label'           => esc_html__( 'Read More Button Text', 'ecommerce-online-store' ),
		'section'         => 'ecommerce_online_store_post_options',
		'settings'        => 'ecommerce_online_store_readmore_button_text',
		'type'            => 'text',
	)
);


// Featured Image Dimension
$wp_customize->add_setting(
	'ecommerce_online_store_blog_post_featured_image_dimension',
	array(
		'default' => 'default',
		'sanitize_callback' => 'ecommerce_online_store_sanitize_choices'
	)
);

$wp_customize->add_control(
	'ecommerce_online_store_blog_post_featured_image_dimension', 
	array(
		'type' => 'select',
		'label' => __('Featured Image Dimension','ecommerce-online-store'),
		'section' => 'ecommerce_online_store_post_options',
		'choices' => array(
			'default' => __('Default','ecommerce-online-store'),
			'custom' => __('Custom Image Size','ecommerce-online-store'),
		),
		'description' => __('Note: If you select "Custom Image Size", you can set a custom width and height up to 950px.', 'ecommerce-online-store')
	)
);
 
// Featured Image Custom Width
$wp_customize->add_setting(
	'ecommerce_online_store_blog_post_featured_image_custom_width',
	array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'ecommerce_online_store_blog_post_featured_image_custom_width',
	array(
		'label'	=> __('Featured Image Custom Width','ecommerce-online-store'),
		'section'=> 'ecommerce_online_store_post_options',
		'type'=> 'text',
		'input_attrs' => array(
			'placeholder' => __( '300', 'ecommerce-online-store' ),
		),
		'active_callback' => 'ecommerce_online_store_blog_post_featured_image_dimension'
	)
);

// Featured Image Custom Height
$wp_customize->add_setting(
	'ecommerce_online_store_blog_post_featured_image_custom_height',
	array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'ecommerce_online_store_blog_post_featured_image_custom_height',
	array(
		'label'	=> __('Featured Image Custom Height','ecommerce-online-store'),
		'section'=> 'ecommerce_online_store_post_options',
		'type'=> 'text',
		'input_attrs' => array(
			'placeholder' => __( '300', 'ecommerce-online-store' ),
		),
		'active_callback' => 'ecommerce_online_store_blog_post_featured_image_dimension'
	)
);
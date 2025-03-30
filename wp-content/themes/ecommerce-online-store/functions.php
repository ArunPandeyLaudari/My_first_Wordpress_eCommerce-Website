<?php
/**
 * Ecommerce Online Store functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ecommerce_online_store
 */

$ecommerce_online_store_theme_data = wp_get_theme();
if( ! defined( 'ECOMMERCE_ONLINE_STORE_THEME_VERSION' ) ) define ( 'ECOMMERCE_ONLINE_STORE_THEME_VERSION', $ecommerce_online_store_theme_data->get( 'Version' ) );
if( ! defined( 'ECOMMERCE_ONLINE_STORE_THEME_NAME' ) ) define( 'ECOMMERCE_ONLINE_STORE_THEME_NAME', $ecommerce_online_store_theme_data->get( 'Name' ) );
if( ! defined( 'ECOMMERCE_ONLINE_STORE_THEME_TEXTDOMAIN' ) ) define( 'ECOMMERCE_ONLINE_STORE_THEME_TEXTDOMAIN', $ecommerce_online_store_theme_data->get( 'TextDomain' ) );

if ( ! defined( 'ECOMMERCE_ONLINE_STORE_VERSION' ) ) {
	define( 'ECOMMERCE_ONLINE_STORE_VERSION', '1.0.0' );
}

if ( ! function_exists( 'ecommerce_online_store_setup' ) ) :
	
	function ecommerce_online_store_setup() {
		
		load_theme_textdomain( 'ecommerce-online-store', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		
		add_theme_support( 'title-tag' );

		add_theme_support( 'woocommerce' );

		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'ecommerce-online-store' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'woocommerce',
			)
		);

		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio', 
		) );

		add_theme_support(
			'custom-background',
			apply_filters(
				'ecommerce_online_store_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support( 'align-wide' );

		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'ecommerce_online_store_setup' );

function ecommerce_online_store_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ecommerce_online_store_content_width', 640 );
}
add_action( 'after_setup_theme', 'ecommerce_online_store_content_width', 0 );

function ecommerce_online_store_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ecommerce-online-store' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ecommerce-online-store' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	$ecommerce_online_store_footer_widget_column = get_theme_mod('ecommerce_online_store_footer_widget_column','4');
	for ($i=1; $i<=$ecommerce_online_store_footer_widget_column; $i++) {
		register_sidebar( array(
			'name' => __( 'Footer  ', 'ecommerce-online-store' )  . $i,
			'id' => 'ecommerce-online-store-footer-widget-' . $i,
			'description' => __( 'The Footer Widget Area', 'ecommerce-online-store' )  . $i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h4 class="widget-title">',
			'after_title' => '</h4></div>',
		) );
	}
}
add_action( 'widgets_init', 'ecommerce_online_store_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ecommerce_online_store_scripts() {
	// Append .min if SCRIPT_DEBUG is false.
	$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Slick style.
	wp_enqueue_style( 'ecommerce-online-store-slick-style', get_template_directory_uri() . '/resource/css/slick' . $min . '.css', array(), '1.8.1' );

	// Bootstrap style.
	wp_enqueue_style( 'ecommerce-online-store-bootstrap-style', get_template_directory_uri() . '/resource/css/bootstrap.css', array(), '5.15.4' );

	// Fontawesome style.
	wp_enqueue_style( 'ecommerce-online-store-fontawesome-style', get_template_directory_uri() . '/resource/css/fontawesome' . $min . '.css', array(), '5.15.4' );

	// Main style.
	wp_enqueue_style( 'ecommerce-online-store-style', get_template_directory_uri() . '/style.css', array(), ECOMMERCE_ONLINE_STORE_VERSION );

    // RTL style.
	wp_style_add_data('ecommerce-online-store-style', 'rtl', 'replace');

	// Navigation script.
	wp_enqueue_script( 'ecommerce-online-store-navigation-script', get_template_directory_uri() . '/resource/js/navigation' . $min . '.js', array(), ECOMMERCE_ONLINE_STORE_VERSION, true );

	// Slick script.
	wp_enqueue_script( 'ecommerce-online-store-slick-script', get_template_directory_uri() . '/resource/js/slick' . $min . '.js', array( 'jquery' ), '1.8.1', true );

	// Custom script.
	wp_enqueue_script( 'ecommerce-online-store-custom-script', get_template_directory_uri() . '/resource/js/custom' . $min . '.js', array( 'jquery' ), ECOMMERCE_ONLINE_STORE_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Include the file.
	require_once get_theme_file_path( 'theme-library/function-files/wptt-webfont-loader.php' );

	// Load the webfont.
	wp_enqueue_style(
		'jost',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' ),
		array(),
		'1.0'
	);
}
add_action( 'wp_enqueue_scripts', 'ecommerce_online_store_scripts' );

//Change number of products per page 
add_filter( 'loop_shop_per_page', 'ecommerce_online_store_products_per_page' );
function ecommerce_online_store_products_per_page( $cols ) {
  	return  get_theme_mod( 'ecommerce_online_store_products_per_page',9);
}

// Change number or products per row 
add_filter('loop_shop_columns', 'ecommerce_online_store_loop_columns');
	if (!function_exists('ecommerce_online_store_loop_columns')) {
	function ecommerce_online_store_loop_columns() {
		return get_theme_mod( 'ecommerce_online_store_products_per_row', 3 );
	}
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/theme-library/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/theme-library/function-files/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/theme-library/function-files/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/theme-library/customizer.php';

/**
 * Google Fonts
 */
require get_template_directory() . '/theme-library/function-files/google-fonts.php';

/**
 * Dynamic CSS
 */
require get_template_directory() . '/theme-library/dynamic-css.php';

/**
 * Breadcrumb
 */
require get_template_directory() . '/theme-library/function-files/class-breadcrumb-trail.php';

/**
 * Getting Started
*/
require get_template_directory() . '/theme-library/getting-started/getting-started.php';

/**
 * Demo Import
*/
require get_parent_theme_file_path( '/theme-wizard/config.php' );

/**
 * Customizer Settings Functions
*/
require get_template_directory() . '/theme-library/function-files/customizer-settings-functions.php';

// Enqueue Customizer live preview script
function ecommerce_online_store_customizer_live_preview() {
    wp_enqueue_script(
        'ecommerce-online-store-customizer',
        get_template_directory_uri() . '/js/customizer.js',
        array('jquery', 'customize-preview'),
        '',
        true
    );
}
add_action('customize_preview_init', 'ecommerce_online_store_customizer_live_preview');

add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );

// Featured Image Dimension
function ecommerce_online_store_blog_post_featured_image_dimension(){
	if(get_theme_mod('ecommerce_online_store_blog_post_featured_image_dimension') == 'custom' ) {
		return true;
	}
	return false;
}

add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );
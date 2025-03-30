<?php
/**
 * Settings for theme wizard
 *
 * @package Whizzie
 * @author Aster Themes
 * @since 1.0.0
 */

/**
 * Define constants
 **/
if ( ! defined( 'WHIZZIE_DIR' ) ) {
	define( 'WHIZZIE_DIR', dirname( __FILE__ ) );
}
// Load the Whizzie class and other dependencies
require trailingslashit( WHIZZIE_DIR ) . 'whizzie.php';
// Gets the theme object
$current_theme = wp_get_theme();
$theme_title = $current_theme->get( 'Name' );


/**
 * Make changes below
 **/

// Change the title and slug of your wizard page
$config['page_slug'] 	= 'ecommerce-online-store';
$config['page_title']	= 'Theme Setup Wizard';

// You can remove elements here as required
// Don't rename the IDs - nothing will break but your changes won't get carried through
$config['steps'] = array(
	'intro' => array(
		'id'			=> 'intro', // ID for section - don't rename
		'title'			=> __( 'Welcome to ', 'ecommerce-online-store' ) . $theme_title, // Section title
		'icon'			=> 'dashboard', // Uses Dashicons
		'button_text'	=> __( 'Start Now', 'ecommerce-online-store' ), // Button text
		'can_skip'		=> false // Show a skip button?
	),
	'plugins' => array(
		'id'			=> 'plugins',
		'title'			=> __( 'Plugins', 'ecommerce-online-store' ),
		'icon'			=> 'admin-plugins',
		'button_text'	=> __( 'Install Plugins', 'ecommerce-online-store' ),
		'can_skip'		=> false
	),
	'widgets' => array(
		'id'			=> 'widgets',
		'title'			=> __( 'Demo Importer', 'ecommerce-online-store' ),
		'icon'			=> 'welcome-widgets-menus',
		'button_text'	=> __( 'Import Demo', 'ecommerce-online-store' ),
		'can_skip'		=> false
	),
	'done' => array(
		'id'			=> 'done',
		'title'			=> __( 'All Done', 'ecommerce-online-store' ),
		'icon'			=> 'yes',
	)
);

/**
 * This kicks off the wizard
 **/
if( class_exists( 'Whizzie' ) ) {
	$Whizzie = new Whizzie( $config );
}
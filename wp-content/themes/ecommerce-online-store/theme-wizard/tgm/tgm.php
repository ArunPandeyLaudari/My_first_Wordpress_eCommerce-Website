<?php
require get_template_directory() . '/theme-wizard/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function ecommerce_online_store_register_recommended_plugins_set() {
	$plugins = array(
		array(
			'name'             => __( 'WooCommerce', 'ecommerce-online-store' ),
			'slug'             => 'woocommerce',
			'source'           => '',
			'required'         => true,
			'force_activation' => false,
		),
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'ecommerce_online_store_register_recommended_plugins_set' );
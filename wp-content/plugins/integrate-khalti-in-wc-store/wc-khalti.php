<?php

/**
 * Plugin Name: Integrate Khalti in WC Store
 * Plugin URI: https://khalti.com/payment-gateway/
 * Description: Integrate Khalti in WooCommerce is a plugin that enables payment via Khalti Wallet in WooCommerce shop in Nepal.
 * Version: 1.1.2
 * Requires at least: 5.0
 * Requires PHP: 5.6
 * Author: Khalti
 * Author URI: https://khalti.com/
 * Text Domain: woocommerce-khalti
 * Domain Path: /languages
 *
 * WC requires at least: 4.5.0
 * WC tested up to: 9.1.4
 */

defined('ABSPATH') || exit;

add_action(
    'before_woocommerce_init',
    function () {
        if (class_exists(\Automattic\WooCommerce\Utilities\FeaturesUtil::class)) {
            \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility(
                'custom_order_tables',
                __FILE__,
                true
            );
        }
    }
);

// Define WC_KHALTI_PLUGIN_FILE.
if (!defined('WC_KHALTI_PLUGIN_FILE')) {
    define('WC_KHALTI_PLUGIN_FILE', __FILE__);
}

// Include the main WooCommerce Khalti class.
if (!class_exists('WooCommerce_Khalti')) {
    include_once dirname(__FILE__) . '/includes/class-woocommerce-khalti.php';
    include_once dirname(__FILE__) . '/includes/class-woocommerce-khalti-data.php';
}

// Initialize the plugin.
add_action('plugins_loaded', array('WooCommerce_Khalti', 'get_instance'));
add_action('plugins_loaded', array('WooCommerce_Khalti_Data', 'get_instance'));

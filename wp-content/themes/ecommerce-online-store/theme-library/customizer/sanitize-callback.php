<?php

function ecommerce_online_store_sanitize_select( $ecommerce_online_store_input, $ecommerce_online_store_setting ) {
	$ecommerce_online_store_input = sanitize_key( $ecommerce_online_store_input );
	$ecommerce_online_store_choices = $ecommerce_online_store_setting->manager->get_control( $ecommerce_online_store_setting->id )->choices;
	return ( array_key_exists( $ecommerce_online_store_input, $ecommerce_online_store_choices ) ? $ecommerce_online_store_input : $ecommerce_online_store_setting->default );
}

function ecommerce_online_store_sanitize_switch( $ecommerce_online_store_input ) {
	if ( true === $ecommerce_online_store_input ) {
		return true;
	} else {
		return false;
	}
}

function ecommerce_online_store_sanitize_google_fonts( $ecommerce_online_store_input, $ecommerce_online_store_setting ) {
	$ecommerce_online_store_choices = $ecommerce_online_store_setting->manager->get_control( $ecommerce_online_store_setting->id )->choices;
	return ( array_key_exists( $ecommerce_online_store_input, $ecommerce_online_store_choices ) ? $ecommerce_online_store_input : $ecommerce_online_store_setting->default );
}
/**
 * Sanitize HTML input.
 *
 * @param string $ecommerce_online_store_input HTML input to sanitize.
 * @return string Sanitized HTML.
 */
function ecommerce_online_store_sanitize_html( $ecommerce_online_store_input ) {
    return wp_kses_post( $ecommerce_online_store_input );
}

/**
 * Sanitize URL input.
 *
 * @param string $ecommerce_online_store_input URL input to sanitize.
 * @return string Sanitized URL.
 */
function ecommerce_online_store_sanitize_url( $ecommerce_online_store_input ) {
    return esc_url_raw( $ecommerce_online_store_input );
}

// Sanitize Scroll Top Position
function ecommerce_online_store_sanitize_scroll_top_position( $ecommerce_online_store_input ) {
    $ecommerce_online_store_valid_positions = array( 'bottom-right', 'bottom-left', 'bottom-center' );
    if ( in_array( $ecommerce_online_store_input, $ecommerce_online_store_valid_positions ) ) {
        return $ecommerce_online_store_input;
    } else {
        return 'bottom-right'; // Default to bottom-right if invalid value
    }
}

function ecommerce_online_store_sanitize_choices( $ecommerce_online_store_input, $ecommerce_online_store_setting ) {
	global $wp_customize; 
	$ecommerce_online_store_control = $wp_customize->get_control( $ecommerce_online_store_setting->id ); 
	if ( array_key_exists( $ecommerce_online_store_input, $ecommerce_online_store_control->choices ) ) {
		return $ecommerce_online_store_input;
	} else {
		return $ecommerce_online_store_setting->default;
	}
}

function ecommerce_online_store_sanitize_range_value( $ecommerce_online_store_number, $ecommerce_online_store_setting ) {

	// Ensure input is an absolute integer.
	$ecommerce_online_store_number = absint( $ecommerce_online_store_number );

	// Get the input attributes associated with the setting.
	$ecommerce_online_store_atts = $ecommerce_online_store_setting->manager->get_control( $ecommerce_online_store_setting->id )->input_attrs;

	// Get minimum number in the range.
	$ecommerce_online_store_min = ( isset( $ecommerce_online_store_atts['min'] ) ? $ecommerce_online_store_atts['min'] : $ecommerce_online_store_number );

	// Get maximum number in the range.
	$ecommerce_online_store_max = ( isset( $ecommerce_online_store_atts['max'] ) ? $ecommerce_online_store_atts['max'] : $ecommerce_online_store_number );

	// Get step.
	$ecommerce_online_store_step = ( isset( $ecommerce_online_store_atts['step'] ) ? $ecommerce_online_store_atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default.
	return ( $ecommerce_online_store_min <= $ecommerce_online_store_number && $ecommerce_online_store_number <= $ecommerce_online_store_max && is_int( $ecommerce_online_store_number / $ecommerce_online_store_step ) ? $ecommerce_online_store_number : $ecommerce_online_store_setting->default );
}
<?php

/**
 * Render homepage sections.
 */
function ecommerce_online_store_homepage_sections() {
	$ecommerce_online_store_homepage_sections = array_keys( ecommerce_online_store_get_homepage_sections() );

	foreach ( $ecommerce_online_store_homepage_sections as $ecommerce_online_store_section ) {
		require get_template_directory() . '/sections/' . $ecommerce_online_store_section . '.php';
	}
}
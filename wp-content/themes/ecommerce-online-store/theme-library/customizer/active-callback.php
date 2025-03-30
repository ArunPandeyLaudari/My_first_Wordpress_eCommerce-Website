<?php

/**
 * Active Callbacks
 *
 * @package ecommerce_online_store
 */

// Theme Options.
function ecommerce_online_store_is_pagination_enabled( $ecommerce_online_store_control ) {
	return ( $ecommerce_online_store_control->manager->get_setting( 'ecommerce_online_store_enable_pagination' )->value() );
}
function ecommerce_online_store_is_breadcrumb_enabled( $ecommerce_online_store_control ) {
	return ( $ecommerce_online_store_control->manager->get_setting( 'ecommerce_online_store_enable_breadcrumb' )->value() );
}
function ecommerce_online_store_is_layout_enabled( $ecommerce_online_store_control ) {
	return ( $ecommerce_online_store_control->manager->get_setting( 'ecommerce_online_store_website_layout' )->value() );
}
function ecommerce_online_store_is_pagetitle_bcakground_image_enabled( $ecommerce_online_store_control ) {
	return ( $ecommerce_online_store_control->manager->get_setting( 'ecommerce_online_store_page_header_style' )->value() );
}
function ecommerce_online_store_is_preloader_style( $ecommerce_online_store_control ) {
	return ( $ecommerce_online_store_control->manager->get_setting( 'ecommerce_online_store_enable_preloader' )->value() );
}

// Header Options.
function ecommerce_online_store_is_topbar_enabled( $ecommerce_online_store_control ) {
	return ( $ecommerce_online_store_control->manager->get_Setting( 'ecommerce_online_store_enable_topbar' )->value() );
}

// Banner Slider Section.
function ecommerce_online_store_is_banner_slider_section_enabled( $ecommerce_online_store_control ) {
	return ( $ecommerce_online_store_control->manager->get_setting( 'ecommerce_online_store_enable_banner_section' )->value() );
}
function ecommerce_online_store_is_banner_slider_section_and_content_type_post_enabled( $ecommerce_online_store_control ) {
	$content_type = $ecommerce_online_store_control->manager->get_setting( 'ecommerce_online_store_banner_slider_content_type' )->value();
	return ( ecommerce_online_store_is_banner_slider_section_enabled( $ecommerce_online_store_control ) && ( 'post' === $content_type ) );
}
function ecommerce_online_store_is_banner_slider_section_and_content_type_page_enabled( $ecommerce_online_store_control ) {
	$content_type = $ecommerce_online_store_control->manager->get_setting( 'ecommerce_online_store_banner_slider_content_type' )->value();
	return ( ecommerce_online_store_is_banner_slider_section_enabled( $ecommerce_online_store_control ) && ( 'page' === $content_type ) );
}

// Service section.
function ecommerce_online_store_is_service_section_enabled( $ecommerce_online_store_control ) {
	return ( $ecommerce_online_store_control->manager->get_setting( 'ecommerce_online_store_enable_service_section' )->value() );
}
function ecommerce_online_store_is_service_section_and_content_type_post_enabled( $ecommerce_online_store_control ) {
	$content_type = $ecommerce_online_store_control->manager->get_setting( 'ecommerce_online_store_service_content_type' )->value();
	return ( ecommerce_online_store_is_service_section_enabled( $ecommerce_online_store_control ) && ( 'post' === $content_type ) );
}
function ecommerce_online_store_is_service_section_and_content_type_page_enabled( $ecommerce_online_store_control ) {
	$content_type = $ecommerce_online_store_control->manager->get_setting( 'ecommerce_online_store_service_content_type' )->value();
	return ( ecommerce_online_store_is_service_section_enabled( $ecommerce_online_store_control ) && ( 'page' === $content_type ) );
}
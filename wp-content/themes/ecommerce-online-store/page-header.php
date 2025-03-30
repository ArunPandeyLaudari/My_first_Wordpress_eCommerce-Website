<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! ecommerce_online_store_has_page_header() ) {
    return;
}

$ecommerce_online_store_classes = array( 'page-header' );
$ecommerce_online_store_style = ecommerce_online_store_page_header_style();

if ( $ecommerce_online_store_style ) {
    $ecommerce_online_store_classes[] = $ecommerce_online_store_style . '-page-header';
}

$ecommerce_online_store_visibility = get_theme_mod( 'ecommerce_online_store_page_header_visibility', 'all-devices' );

if ( 'hide-all-devices' === $ecommerce_online_store_visibility ) {
    // Don't show the header at all
    return;
}

if ( 'hide-tablet' === $ecommerce_online_store_visibility ) {
    $ecommerce_online_store_classes[] = 'hide-on-tablet';
} elseif ( 'hide-mobile' === $ecommerce_online_store_visibility ) {
    $ecommerce_online_store_classes[] = 'hide-on-mobile';
} elseif ( 'hide-tablet-mobile' === $ecommerce_online_store_visibility ) {
    $ecommerce_online_store_classes[] = 'hide-on-tablet-mobile';
}

$ecommerce_online_store_PAGE_TITLE_background_color = get_theme_mod('ecommerce_online_store_page_title_background_color_setting', '');

// Get the toggle switch value
$ecommerce_online_store_background_image_enabled = get_theme_mod('ecommerce_online_store_page_header_style', true);

// Add background image to the header if enabled
$ecommerce_online_store_background_image = get_theme_mod( 'ecommerce_online_store_page_header_background_image', '' );
$ecommerce_online_store_background_height = get_theme_mod( 'ecommerce_online_store_page_header_image_height', '200' );
$ecommerce_online_store_inline_style = '';

if ( $ecommerce_online_store_background_image_enabled && ! empty( $ecommerce_online_store_background_image ) ) {
    $ecommerce_online_store_inline_style .= 'background-image: url(' . esc_url( $ecommerce_online_store_background_image ) . '); ';
    $ecommerce_online_store_inline_style .= 'height: ' . esc_attr( $ecommerce_online_store_background_height ) . 'px; ';
    $ecommerce_online_store_inline_style .= 'background-size: cover; ';
    $ecommerce_online_store_inline_style .= 'background-position: center center; ';

    // Add the unique class if the background image is set
    $ecommerce_online_store_classes[] = 'has-background-image';
}

$ecommerce_online_store_classes = implode( ' ', $ecommerce_online_store_classes );
$ecommerce_online_store_heading = get_theme_mod( 'ecommerce_online_store_page_header_heading_tag', 'h1' );
$ecommerce_online_store_heading = apply_filters( 'ecommerce_online_store_page_header_heading', $ecommerce_online_store_heading );

?>

<?php do_action( 'ecommerce_online_store_before_page_header' ); ?>

<header class="<?php echo esc_attr( $ecommerce_online_store_classes ); ?>" style="<?php echo esc_attr( $ecommerce_online_store_inline_style ); ?> background-color: <?php echo esc_attr($ecommerce_online_store_PAGE_TITLE_background_color); ?>;">

    <?php do_action( 'ecommerce_online_store_before_page_header_inner' ); ?>

    <div class="asterthemes-wrapper page-header-inner">

        <?php if ( ecommerce_online_store_has_page_header() ) : ?>

            <<?php echo esc_attr( $ecommerce_online_store_heading ); ?> class="page-header-title">
                <?php echo wp_kses_post( ecommerce_online_store_get_page_title() ); ?>
            </<?php echo esc_attr( $ecommerce_online_store_heading ); ?>>

        <?php endif; ?>

        <?php if ( function_exists( 'ecommerce_online_store_breadcrumb' ) ) : ?>
            <?php ecommerce_online_store_breadcrumb(); ?>
        <?php endif; ?>

    </div><!-- .page-header-inner -->

    <?php do_action( 'ecommerce_online_store_after_page_header_inner' ); ?>

</header><!-- .page-header -->

<?php do_action( 'ecommerce_online_store_after_page_header' ); ?>
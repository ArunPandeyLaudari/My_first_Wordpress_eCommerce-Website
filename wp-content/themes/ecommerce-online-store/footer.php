<?php
/**
 * The template for displaying the footer
 * 
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ecommerce_online_store
 */

// Get the footer background color/image settings from customizer
$ecommerce_online_store_footer_background_color = get_theme_mod('ecommerce_online_store_footer_background_color_setting'); // Default to white if not set
$ecommerce_online_store_footer_background_image = get_theme_mod('footer_background_image_setting');

if (!is_front_page() || is_home()) {
    ?>
    </div>
    </div>
</div>
<?php } ?>

<footer id="colophon" class="site-footer" style="background-color: <?php echo esc_attr($ecommerce_online_store_footer_background_color); ?>; <?php echo ($ecommerce_online_store_footer_background_image) ? 'background-image: url(' . esc_url($ecommerce_online_store_footer_background_image) . ');' : ''; ?>">
    <div class="site-footer-top">
        <div class="asterthemes-wrapper">
            <div class="footer-widgets-wrapper">

                <?php
                // Footer Widget
                do_action('ecommerce_online_store_footer_widget');
                ?>

            </div>
        </div>
    </div>
    <div class="site-footer-bottom">
        <div class="asterthemes-wrapper">
            <div class="site-footer-bottom-wrapper">
                <div class="site-info">
                    <?php
                    do_action('ecommerce_online_store_footer_copyright');
                    ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php
$ecommerce_online_store_is_scroll_top_active = get_theme_mod( 'ecommerce_online_store_scroll_top', true );
if ( $ecommerce_online_store_is_scroll_top_active ) :
    $ecommerce_online_store_scroll_shape = get_theme_mod( 'ecommerce_online_store_scroll_top_shape', 'box' );
    $ecommerce_online_store_scroll_position = get_theme_mod( 'ecommerce_online_store_scroll_top_position', 'bottom-right' );
    ?>
    <style>
        #scroll-to-top {
            position: fixed;
            <?php
            switch ( $ecommerce_online_store_scroll_position ) {
                case 'bottom-left':
                    echo 'bottom: 25px; left: 20px;';
                    break;
                case 'bottom-center':
                    echo 'bottom: 25px; left: 50%; transform: translateX(-50%);';
                    break;
                default: // 'bottom-right'
                    echo 'bottom: 25px; right: 90px;';
            }
            ?>
        }
    </style>
    <a href="#" id="scroll-to-top" class="ecommerce-online-store-scroll-to-top <?php echo esc_attr($ecommerce_online_store_scroll_shape); ?>"><i class="<?php echo esc_attr( get_theme_mod( 'ecommerce_online_store_scroll_btn_icon', 'fas fa-chevron-up' ) ); ?>"></i></a>
<?php
endif;
?>
</div>

<?php wp_footer(); ?>

</body>

</html>
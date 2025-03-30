<?php
/**
 * Getting Started Page.
 *
 * @package ecommerce_online_store
 */

if( ! function_exists( 'ecommerce_online_store_getting_started_menu' ) ) :
/**
 * Adding Getting Started Page in admin menu
 */
function ecommerce_online_store_getting_started_menu(){	
	add_theme_page(
		__( 'Getting Started', 'ecommerce-online-store' ),
		__( 'Getting Started', 'ecommerce-online-store' ),
		'manage_options',
		'ecommerce-online-store-getting-started',
		'ecommerce_online_store_getting_started_page'
	);
}
endif;
add_action( 'admin_menu', 'ecommerce_online_store_getting_started_menu' );

if( ! function_exists( 'ecommerce_online_store_getting_started_admin_scripts' ) ) :
/**
 * Load Getting Started styles in the admin
 */
function ecommerce_online_store_getting_started_admin_scripts( $hook ){
	// Load styles only on our page
	if( 'appearance_page_ecommerce-online-store-getting-started' != $hook ) return;

    wp_enqueue_style( 'ecommerce-online-store-getting-started', get_template_directory_uri() . '/resource/css/getting-started.css', false, ECOMMERCE_ONLINE_STORE_THEME_VERSION );

    wp_enqueue_script( 'ecommerce-online-store-getting-started', get_template_directory_uri() . '/resource/js/getting-started.js', array( 'jquery' ), ECOMMERCE_ONLINE_STORE_THEME_VERSION, true );
}
endif;
add_action( 'admin_enqueue_scripts', 'ecommerce_online_store_getting_started_admin_scripts' );

if( ! function_exists( 'ecommerce_online_store_getting_started_page' ) ) :
/**
 * Callback function for admin page.
*/
function ecommerce_online_store_getting_started_page(){ 
	$ecommerce_online_store_theme = wp_get_theme();?>
	<div class="wrap getting-started">
		<div class="intro-wrap">
			<div class="intro cointaner">
				<div class="intro-content">
					<h3><?php echo esc_html( 'Welcome to', 'ecommerce-online-store' );?> <span class="theme-name"><?php echo esc_html( ECOMMERCE_ONLINE_STORE_THEME_NAME ); ?></span></h3>
					<p class="about-text">
						<?php
						// Remove last sentence of description.
						$ecommerce_online_store_description = explode( '. ', $ecommerce_online_store_theme->get( 'Description' ) );

						$ecommerce_online_store_description = implode( '. ', $ecommerce_online_store_description );

						echo esc_html( $ecommerce_online_store_description . '' );
					?></p>
					<div class="btns-getstart">
						<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"target="_blank" class="button button-primary"><?php esc_html_e( 'Customize', 'ecommerce-online-store' ); ?></a>
						<a class="button button-primary" href="<?php echo esc_url( 'https://wordpress.org/support/theme/ecommerce-online-store/reviews/#new-post' ); ?>" title="<?php esc_attr_e( 'Visit the Review', 'ecommerce-online-store' ); ?>" target="_blank">
							<?php esc_html_e( 'Review', 'ecommerce-online-store' ); ?>
						</a>
						<a class="button button-primary" href="<?php echo esc_url( 'https://wordpress.org/support/theme/ecommerce-online-store' ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'ecommerce-online-store' ); ?>" target="_blank">
							<?php esc_html_e( 'Contact Supoort', 'ecommerce-online-store' ); ?>
						</a>
					</div>
					<div class="btns-wizard">
						<a class="wizard" href="<?php echo esc_url( admin_url( 'themes.php?page=ecommerceonlinestore-wizard' ) ); ?>"target="_blank" class="button button-primary"><?php esc_html_e( 'One Click Demo Setup', 'ecommerce-online-store' ); ?></a>
					</div>
				</div>
				<div class="intro-img">
					<img src="<?php echo esc_url(get_template_directory_uri()) .'/screenshot.png'; ?>" />
				</div>
				
			</div>
		</div>

		<div class="cointaner panels">
			<ul class="inline-list">
				<li class="current">
                    <a id="help" href="javascript:void(0);">
                        <?php esc_html_e( 'Getting Started', 'ecommerce-online-store' ); ?>
                    </a>
                </li>
				<li>
                    <a id="free-pro-panel" href="javascript:void(0);">
                        <?php esc_html_e( 'Free Vs Pro', 'ecommerce-online-store' ); ?>
                    </a>
                </li>
			</ul>
			<div id="panel" class="panel">
				<?php require get_template_directory() . '/theme-library/getting-started/tabs/help-panel.php'; ?>
				<?php require get_template_directory() . '/theme-library/getting-started/tabs/free-vs-pro-panel.php'; ?>
				<?php require get_template_directory() . '/theme-library/getting-started/tabs/link-panel.php'; ?>
			</div>
		</div>
	</div>
	<?php
}
endif;
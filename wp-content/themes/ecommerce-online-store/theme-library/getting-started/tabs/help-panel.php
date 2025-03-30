<?php
/**
 * Help Panel.
 *
 * @package ecommerce_online_store
 */
?>

<div id="help-panel" class="panel-left visible">

    <div id="#help-panel" class="steps">  
        <h4>
            <?php esc_html_e( 'Quick Setup for Home Page', 'ecommerce-online-store' ); ?>
            <a href="<?php echo esc_url( 'https://demo.asterthemes.com/docs/ecommerce-online-store-free' ); ?>" class="button button-primary" style="margin-left: 5px; margin-right: 10px;" target="_blank"><?php esc_html_e( 'Free Documentation', 'ecommerce-online-store' ); ?></a>
        </h4>
        <hr class="quick-set">
        <p><?php esc_html_e( '1) Go to the dashboard. navigate to pages, add a new one, and label it "home" or whatever else you like.The page has now been created.', 'ecommerce-online-store' ); ?></p>
        <p><?php esc_html_e( '2) Go back to the dashboard and then select Settings.', 'ecommerce-online-store' ); ?></p>
        <p><?php esc_html_e( '3) Then Go to readings in the setting.', 'ecommerce-online-store' ); ?></p>
        <p><?php esc_html_e( '4) There are 2 options your latest post or static page.', 'ecommerce-online-store' ); ?></p>
        <p><?php esc_html_e( '5) Select static page and select from the dropdown you wish to use as your home page, save changes.', 'ecommerce-online-store' ); ?></p>
        <p><?php esc_html_e( '6) You can set the home page in this manner.', 'ecommerce-online-store' ); ?></p>
        <hr>
        <h4><?php esc_html_e( 'Setup Banner Section', 'ecommerce-online-store' ); ?></h4>
        <hr class="quick-set">
         <p><?php esc_html_e( '1) Go to Appereance > then Go to Customizer.', 'ecommerce-online-store' ); ?></p>
         <p><?php esc_html_e( '2) In Customizer > Go to Front Page Options > Go to Banner Section.', 'ecommerce-online-store' ); ?></p>
         <p><?php esc_html_e( '3) For Setup Banner Section you have to create post in dashboard first.', 'ecommerce-online-store' ); ?></p>
         <p><?php esc_html_e( '4) In Banner Section > Enable the Toggle button > and fill the following details.', 'ecommerce-online-store' ); ?></p>
         <p><?php esc_html_e( '5) In this way you can set Banner Section.', 'ecommerce-online-store' ); ?></p>
         <hr>
        <h4><?php esc_html_e( 'Setup Trending Product Section', 'ecommerce-online-store' ); ?></h4>
        <hr class="quick-set">
         <p><?php esc_html_e( '1) Go to dashboard > Go to plugin > add woocommerce plugin.', 'ecommerce-online-store' ); ?></p>
         <p><?php esc_html_e( '2) After installing plugin make products in it and give them particular category.', 'ecommerce-online-store' ); ?></p>
         <p><?php esc_html_e( '3) In Customizer > Go to Front Page Options > Go to Trending Product Section.', 'ecommerce-online-store' ); ?></p>
         <p><?php esc_html_e( '4) In Trending Product Section > Enable the Toggle button and give heading and select category which you want. ', 'ecommerce-online-store' ); ?></p>
         <p><?php esc_html_e( '5) In this way you can set Trending Product Section.', 'ecommerce-online-store' ); ?></p>
    </div>
    <hr>

    <div class="custom-setting">
        <h4><?php esc_html_e( 'Quick Customizer Settings', 'ecommerce-online-store' ); ?></h4>
        <span><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'ecommerce-online-store' ); ?></a></span>
    </div>
    <hr>
   <div class="setting-box">
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-admin-site-alt3"></span>
            </div>
            <h5><?php esc_html_e( 'Site Logo', 'ecommerce-online-store' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=custom_logo' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'ecommerce-online-store' ); ?></a>
            
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-color-picker"></span>
            </div>
            <h5><?php esc_html_e( 'Color', 'ecommerce-online-store' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=primary_color' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'ecommerce-online-store' ); ?></a>
            
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-screenoptions"></span>
            </div>
            <h5><?php esc_html_e( 'Theme Options', 'ecommerce-online-store' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=ecommerce_online_store_theme_options' ) ); ?>"target="_blank" class=""><?php esc_html_e( 'Customize', 'ecommerce-online-store' ); ?></a>
            
        </div>
    </div>
    <div class="setting-box">
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-format-image"></span>
            </div>
            <h5><?php esc_html_e( 'Header Image ', 'ecommerce-online-store' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=header_image' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'ecommerce-online-store' ); ?></a>
            
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-align-full-width"></span>
            </div>
            <h5><?php esc_html_e( 'Footer Options ', 'ecommerce-online-store' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=ecommerce_online_store_footer_copyright_text' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'ecommerce-online-store' ); ?></a>
            
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-admin-page"></span>
            </div>
            <h5><?php esc_html_e( 'Front Page Options', 'ecommerce-online-store' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=ecommerce_online_store_front_page_options' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'ecommerce-online-store' ); ?></a>
            
        </div>
    </div>
</div>
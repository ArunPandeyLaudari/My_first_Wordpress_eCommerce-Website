<?php
/**
 * Wizard
 *
 * @package Whizzie
 * @author Aster Themes
 * @since 1.0.0
 */

class Whizzie {

	protected $version = '1.1.0';
	protected $theme_name = '';
	protected $theme_title = '';
	protected $page_slug = '';
	protected $page_title = '';
	protected $config_steps = array();
	public $plugin_path;
	public $parent_slug;
	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	 */
	protected $plugin_url = '';

	/**
	 * TGMPA instance storage
	 *
	 * @var object
	 */
	protected $tgmpa_instance;

	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */
	protected $tgmpa_menu_slug = 'tgmpa-install-plugins';

	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */
	protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';

	/*** Constructor ***
	* @param $config	Our config parameters
	*/
	public function __construct( $config ) {
		$this->set_vars( $config );
		$this->init();
	}

	/**
	* Set some settings
	* @since 1.0.0
	* @param $config	Our config parameters
	*/

	public function set_vars( $config ) {
		// require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/class-tgm-plugin-activation.php';
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/tgm.php';

		if( isset( $config['page_slug'] ) ) {
			$this->page_slug = esc_attr( $config['page_slug'] );
		}
		if( isset( $config['page_title'] ) ) {
			$this->page_title = esc_attr( $config['page_title'] );
		}
		if( isset( $config['steps'] ) ) {
			$this->config_steps = $config['steps'];
		}

		$this->plugin_path = trailingslashit( dirname( __FILE__ ) );
		$relative_url = str_replace( get_template_directory(), '', $this->plugin_path );
		$this->plugin_url = trailingslashit( get_template_directory_uri() . $relative_url );
		$current_theme = wp_get_theme();
		$this->theme_title = $current_theme->get( 'Name' );
		$this->theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $current_theme->get( 'Name' ) ) );
		$this->page_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_page_slug', $this->theme_name . '-wizard' );
		$this->parent_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_parent_slug', '' );
	}

	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */
	public function init() {
		if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_setup_plugins', array( $this, 'setup_plugins' ) );
		add_action( 'wp_ajax_setup_widgets', array( $this, 'setup_widgets' ) );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'theme-wizard-style', get_template_directory_uri() . '/theme-wizard/assets/css/theme-wizard-style.css');
		wp_register_script( 'theme-wizard-script', get_template_directory_uri() . '/theme-wizard/assets/js/theme-wizard-script.js', array( 'jquery' ), );

		wp_localize_script(
			'theme-wizard-script',
			'ecommerce_online_store_whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'verify_text'	=> esc_html( 'verifying', 'ecommerce-online-store' )
			)
		);
		wp_enqueue_script( 'theme-wizard-script' );
	}

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}

	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2*/
	public function get_tgmpa_instance() {
		$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}

	/**
	 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function set_tgmpa_url() {
		$this->tgmpa_menu_slug = ( property_exists( $this->tgmpa_instance, 'menu' ) ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
		$this->tgmpa_menu_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug );
		$tgmpa_parent_slug = ( property_exists( $this->tgmpa_instance, 'parent_slug' ) && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->tgmpa_url = apply_filters( $this->theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug );
	}

	/***        Make a modal screen for the wizard        ***/
	
	public function menu_page() {
		add_theme_page( esc_html( $this->page_title ), esc_html( $this->page_title ), 'manage_options', $this->page_slug, array( $this, 'ecommerce_online_store_setup_wizard' ) );
	}

	/***        Make an interface for the wizard        ***/

	public function wizard_page() {
		tgmpa_load_bulk_installer();
		// install plugins with TGM.
		if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
			die( 'Failed to find TGM' );
		}
		$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );

		// copied from TGM
		$method = ''; // Leave blank so WP_Filesystem can populate it as necessary.
		$fields = array_keys( $_POST ); // Extra fields to pass to WP_Filesystem.
		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
			return true; // Stop the normal page form from displaying, credential request form will be shown.
		}
		// Now we have some credentials, setup WP_Filesystem.
		if ( ! WP_Filesystem( $creds ) ) {
			// Our credentials were no good, ask the user for them again.
			request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );
			return true;
		}
		/* If we arrive here, we have the filesystem */ ?>
		<div class="main-wrap">
			<?php
			echo '<div class="card whizzie-wrap">';
				// The wizard is a list with only one item visible at a time
				$steps = $this->get_steps();
				echo '<ul class="whizzie-menu">';
				foreach( $steps as $step ) {
					$class = 'step step-' . esc_attr( $step['id'] );
					echo '<li data-step="' . esc_attr( $step['id'] ) . '" class="' . esc_attr( $class ) . '">';
						printf( '<h2>%s</h2>', esc_html( $step['title'] ) );
						// $content is split into summary and detail
						$content = call_user_func( array( $this, $step['view'] ) );
						if( isset( $content['summary'] ) ) {
							printf(
								'<div class="summary">%s</div>',
								wp_kses_post( $content['summary'] )
							);
						}
						if( isset( $content['detail'] ) ) {
							// Add a link to see more detail
							printf( '<p><a href="#" class="more-info">%s</a></p>', __( 'More Info', 'ecommerce-online-store' ) );
							printf(
								'<div class="detail">%s</div>',
								$content['detail'] // Need to escape this
							);
						}
						// The next button
						if( isset( $step['button_text'] ) && $step['button_text'] ) {
							printf(
								'<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
								esc_attr( $step['callback'] ),
								esc_attr( $step['id'] ),
								esc_html( $step['button_text'] )
							);
						}
					echo '</li>';
				}
				echo '</ul>';
				?>
				<div class="step-loading"><span class="spinner"></span></div>
			</div><!-- .whizzie-wrap -->

		</div><!-- .wrap -->
	<?php }



	public function activation_page() {
		?>
		<div class="main-wrap">
			<h3><?php esc_html_e('Theme Setup Wizard','ecommerce-online-store'); ?></h3>
		</div>
		<?php
	}

	public function ecommerce_online_store_setup_wizard(){

			$display_string = '';

			$body = [
				'site_url'					 => site_url(),
				'theme_text_domain'	 => wp_get_theme()->get( 'TextDomain' )
			];

			$body = wp_json_encode( $body );
			$options = [
				'body'        => $body,
				'sslverify' 	=> false,
				'headers'     => [
					'Content-Type' => 'application/json',
				]
			];

			//custom function about theme customizer
			$return = add_query_arg( array()) ;
			$theme = wp_get_theme( 'ecommerce-online-store' );

			?>
				<div class="wrapper-info get-stared-page-wrap">
					<div class="tab-sec theme-option-tab">
						<div id="demo_offer" class="tabcontent">
							<?php $this->wizard_page(); ?>
						</div>
					</div>
				</div>
			<?php
	}
	

	/**
	* Set options for the steps
	* Incorporate any options set by the theme dev
	* Return the array for the steps
	* @return Array
	*/
	public function get_steps() {
		$dev_steps = $this->config_steps;
		$steps = array(
			'intro' => array(
				'id'			=> 'intro',
				'title'			=> __( 'Welcome to ', 'ecommerce-online-store' ) . $this->theme_title,
				'icon'			=> 'dashboard',
				'view'			=> 'get_step_intro', // Callback for content
				'callback'		=> 'do_next_step', // Callback for JS
				'button_text'	=> __( 'Start Now', 'ecommerce-online-store' ),
				'can_skip'		=> false // Show a skip button?
			),
			'plugins' => array(
				'id'			=> 'plugins',
				'title'			=> __( 'Plugins', 'ecommerce-online-store' ),
				'icon'			=> 'admin-plugins',
				'view'			=> 'get_step_plugins',
				'callback'		=> 'install_plugins',
				'button_text'	=> __( 'Install Plugins', 'ecommerce-online-store' ),
				'can_skip'		=> true
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Demo Importer', 'ecommerce-online-store' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'install_widgets',
				'button_text'	=> __( 'Import Demo', 'ecommerce-online-store' ),
				'can_skip'		=> true
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'All Done', 'ecommerce-online-store' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> ''
			)
		);

		// Iterate through each step and replace with dev config values
		if( $dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from config.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $dev_steps as $dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $dev_step['id'] ) ) {
					$id = $dev_step['id'];
					if( isset( $steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $dev_step[$element] ) ) {
								$steps[$id][$element] = $dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $steps;
	}

	/*** Display the content for the intro step ***/
	public function get_step_intro() { ?>
		<div class="summary">
			<p style="text-align: center;"><?php esc_html_e( 'Thank you for choosing our theme! We are excited to help you get started with your new website.', 'ecommerce-online-store' ); ?></p>
			<p style="text-align: center;"><?php esc_html_e( 'To ensure you make the most of our theme, we recommend following the setup steps outlined here. This process will help you configure the theme to best suit your needs and preferences. Click on the "Start Now" button to begin the setup.', 'ecommerce-online-store' ); ?></p>
		</div>
	<?php }
	
	

	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */
	public function get_step_plugins() {
		$plugins = $this->get_plugins();
		$content = array(); ?>
			<div class="summary">
				<p>
					<?php esc_html_e('Additional plugins always make your website exceptional. Install these plugins by clicking the install button. You may also deactivate them from the dashboard.','ecommerce-online-store') ?>
				</p>
			</div>
		<?php // The detail element is initially hidden from the user
		$content['detail'] = '<ul class="whizzie-do-plugins">';
		// Add each plugin into a list
		foreach( $plugins['all'] as $slug=>$plugin ) {
			$content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html( $plugin['name'] ) . '<span>';
			$keys = array();
			if ( isset( $plugins['install'][ $slug ] ) ) {
			    $keys[] = 'Installation';
			}
			if ( isset( $plugins['update'][ $slug ] ) ) {
			    $keys[] = 'Update';
			}
			if ( isset( $plugins['activate'][ $slug ] ) ) {
			    $keys[] = 'Activation';
			}
			$content['detail'] .= implode( ' and ', $keys ) . ' required';
			$content['detail'] .= '</span></li>';
		}
		$content['detail'] .= '</ul>';

		return $content;
	}

	/*** Display the content for the widgets step ***/
	public function get_step_widgets() { ?>
		<div class="summary">
			<p><?php esc_html_e('To get started, use the button below to import demo content and add widgets to your site. After installation, you can manage settings and customize your site using the Customizer. Enjoy your new theme!', 'ecommerce-online-store'); ?></p>
		</div>
	<?php }

	/***        Print the content for the final step        ***/

	public function get_step_done() { ?>
		<div id="aster-demo-setup-guid">
			<div class="aster-setup-menu">
				<h3><?php esc_html_e('Setup Navigation Menu','ecommerce-online-store'); ?></h3>
				<p><?php esc_html_e('Follow the following Steps to Setup Menu','ecommerce-online-store'); ?></p>
				<h4><?php esc_html_e('A) Create Pages','ecommerce-online-store'); ?></h4>
				<ol>
					<li><?php esc_html_e('Go to Dashboard >> Pages >> Add New','ecommerce-online-store'); ?></li>
					<li><?php esc_html_e('Enter Page Details And Save Changes','ecommerce-online-store'); ?></li>
				</ol>
				<h4><?php esc_html_e('B) Add Pages To Menu','ecommerce-online-store'); ?></h4>
				<ol>
					<li><?php esc_html_e('Go to Dashboard >> Appearance >> Menu','ecommerce-online-store'); ?></li>
					<li><?php esc_html_e('Click On The Create Menu Option','ecommerce-online-store'); ?></li>
					<li><?php esc_html_e('Select The Pages And Click On The Add to Menu Button','ecommerce-online-store'); ?></li>
					<li><?php esc_html_e('Select Primary Menu From The Menu Setting','ecommerce-online-store'); ?></li>
					<li><?php esc_html_e('Click On The Save Menu Button','ecommerce-online-store'); ?></li>
				</ol>
			</div>
			<div class="aster-setup-widget">
				<h3><?php esc_html_e('Setup Footer Widgets','ecommerce-online-store'); ?></h3>
				<p><?php esc_html_e('Follow the following Steps to Setup Footer Widgets','ecommerce-online-store'); ?></p>
				<ol>
					<li><?php esc_html_e('Go to Dashboard >> Appearance >> Widgets','ecommerce-online-store'); ?></li>
					<li><?php esc_html_e('Drag And Add The Widgets In The Footer Columns','ecommerce-online-store'); ?></li>
				</ol>
			</div>
			<div style="display:flex; justify-content: center; margin-top: 20px; gap:20px">
				<div class="aster-setup-finish">
					<a target="_blank" href="<?php echo esc_url(home_url()); ?>" class="button button-primary">Visit Site</a>
				</div>
				<div class="aster-setup-finish">
					<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>" class="button button-primary">Customize Your Demo</a>
				</div>
				<div class="aster-setup-finish">
					<a target="_blank" href="<?php echo esc_url( admin_url('themes.php?page=ecommerce-online-store-getting-started') ); ?>" class="button button-primary">Getting Started</a>
				</div>
			</div>
		</div>
	<?php }

	/***       Get the plugins registered with TGMPA       ***/
	public function get_plugins() {
		$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		$plugins = array(
			'all' 		=> array(),
			'install'	=> array(),
			'update'	=> array(),
			'activate'	=> array()
		);
		foreach( $instance->plugins as $slug=>$plugin ) {
			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if( $instance->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}


	public function setup_plugins() {
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();

		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin','ecommerce-online-store' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin','ecommerce-online-store' ),
				);
				break;
			}
		}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin','ecommerce-online-store' ),
				);
				break;
			}
		}
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success','ecommerce-online-store' ) ) );
		}
		exit;
	}

	/***------------------------------------------------- Imports the Demo Content* @since 1.1.0 ----------------------------------------------****/


	//                      ------------- MENUS -----------------                    //

	public function ecommerce_online_store_customizer_primary_menu(){

		// ------- Create Primary Menu --------
		$ecommerce_online_store_menuname = $ecommerce_online_store_themename . 'Primary Menu';
		$ecommerce_online_store_bpmenulocation = 'primary';
		$ecommerce_online_store_menu_exists = wp_get_nav_menu_object( $ecommerce_online_store_menuname );

		if( !$ecommerce_online_store_menu_exists){
			$ecommerce_online_store_menu_id = wp_create_nav_menu($ecommerce_online_store_menuname);
			$ecommerce_online_store_parent_item = 
			wp_update_nav_menu_item($ecommerce_online_store_menu_id, 0, array(
				'menu-item-title' =>  __('Home','ecommerce-online-store'),
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url( '/' ),
				'menu-item-status' => 'publish'));

			wp_update_nav_menu_item($ecommerce_online_store_menu_id, 0, array(
				'menu-item-title' =>  __('Fashion','ecommerce-online-store'),
				'menu-item-classes' => 'fashion',
				'menu-item-url' => get_permalink(get_page_by_title('Fashion')),
				'menu-item-status' => 'publish'));

			wp_update_nav_menu_item($ecommerce_online_store_menu_id, 0, array(
				'menu-item-title' =>  __('Appliances','ecommerce-online-store'),
				'menu-item-classes' => 'appliances',
				'menu-item-url' => get_permalink(get_page_by_title('Appliances')),
				'menu-item-status' => 'publish'));

			wp_update_nav_menu_item($ecommerce_online_store_menu_id, 0, array(
				'menu-item-title' =>  __('Grocery','ecommerce-online-store'),
				'menu-item-classes' => 'grocery',
				'menu-item-url' => get_permalink(get_page_by_title('Grocery')),
				'menu-item-status' => 'publish'));
			
			wp_update_nav_menu_item($ecommerce_online_store_menu_id, 0, array(
				'menu-item-title' =>  __('Blogs','ecommerce-online-store'),
				'menu-item-classes' => 'blog',
				'menu-item-url' => get_permalink(get_page_by_title('Blogs')),
				'menu-item-status' => 'publish'));

			if( !has_nav_menu( $ecommerce_online_store_bpmenulocation ) ){
				$locations = get_theme_mod('nav_menu_locations');
				$locations[$ecommerce_online_store_bpmenulocation] = $ecommerce_online_store_menu_id;
				set_theme_mod( 'nav_menu_locations', $locations );
			}
		}
	}


	public function setup_widgets() {

		// Create a front page and assigned the template
		$ecommerce_online_store_home_title = 'Home';
		$ecommerce_online_store_home_check = get_page_by_title($ecommerce_online_store_home_title);
		$ecommerce_online_store_home = array(
			'post_type' => 'page',
			'post_title' => $ecommerce_online_store_home_title,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'home'
		);
		$ecommerce_online_store_home_id = wp_insert_post($ecommerce_online_store_home);

		//Set the static front page
		$ecommerce_online_store_home = get_page_by_title( 'Home' );
		update_option( 'page_on_front', $ecommerce_online_store_home->ID );
		update_option( 'show_on_front', 'page' );


		// Create a posts page and assigned the template
		$ecommerce_online_store_blog_title = 'Blogs';
		$ecommerce_online_store_blog = get_page_by_title($ecommerce_online_store_blog_title);

		if (!$ecommerce_online_store_blog) {
			$ecommerce_online_store_blog = array(
				'post_type' => 'page',
				'post_title' => $ecommerce_online_store_blog_title,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_name' => 'blog'
			);
			$ecommerce_online_store_blog_id = wp_insert_post($ecommerce_online_store_blog);

			if (is_wp_error($ecommerce_online_store_blog_id)) {
				// Handle error
			}
		} else {
			$ecommerce_online_store_blog_id = $ecommerce_online_store_blog->ID;
		}
		// Set the posts page
		update_option('page_for_posts', $ecommerce_online_store_blog_id);

		
		// Create a Fashion and assigned the template
		$ecommerce_online_store_fashion_title = 'Fashion';
		$ecommerce_online_store_fashion_check = get_page_by_title($ecommerce_online_store_fashion_title);
		$ecommerce_online_store_fashion = array(
			'post_type' => 'page',
			'post_title' => $ecommerce_online_store_fashion_title,
			'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'blog'
		);
		$ecommerce_online_store_fashion_id = wp_insert_post($ecommerce_online_store_fashion);

		
		// Create a Appliances and assigned the template
		$ecommerce_online_store_appliances_title = 'Appliances';
		$ecommerce_online_store_appliances_check = get_page_by_title($ecommerce_online_store_appliances_title);
		$ecommerce_online_store_appliances = array(
			'post_type' => 'page',
			'post_title' => $ecommerce_online_store_appliances_title,
			'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'blog'
		);
		$ecommerce_online_store_appliances_id = wp_insert_post($ecommerce_online_store_appliances);

		
		// Create a Grocery and assigned the template
		$ecommerce_online_store_grocery_title = 'Grocery';
		$ecommerce_online_store_grocery_check = get_page_by_title($ecommerce_online_store_grocery_title);
		$ecommerce_online_store_grocery = array(
			'post_type' => 'page',
			'post_title' => $ecommerce_online_store_grocery_title,
			'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'blog'
		);
		$ecommerce_online_store_grocery_id = wp_insert_post($ecommerce_online_store_grocery);



		/*----------------------------------------- Header Button --------------------------------------------------*/

		set_theme_mod( 'ecommerce_online_store_discount_topbar_text','Exciting News! We have just launched our newest product line featuring a range of sustainable and eco-friendly options for conscious shoppers.');
		

		/*----------------------------------------- Product --------------------------------------------------*/

			set_theme_mod( 'ecommerce_online_store_trending_product_heading', 'Deal Of The Day');
			set_theme_mod( 'ecommerce_online_store_new_arrival_heading', 'New Arrival');

			$ecommerce_online_store_product_category= array(
			'New Arrival' => array(
							'Arrival Product 01',
							'Arrival Product 02',
							'Arrival Product 03',
							'Arrival Product 04',
							),
			'Hot Deals' => array(
							'Hot Deals Product 01',
							'Hot Deals Product 02',
							'Hot Deals Product 03',
							),
			);

			$k = 1;
			foreach ( $ecommerce_online_store_product_category as $ecommerce_online_store_product_cats => $ecommerce_online_store_products_name ) {

				// Insert porduct cats Start
				$content = 'This is sample product category';
				$parent_category	=	wp_insert_term(
				$ecommerce_online_store_product_cats, // the term
				'product_cat', // the taxonomy
				array(
					'description'=> $content,
					'slug' => str_replace( ' ', '-', $ecommerce_online_store_product_cats)
				)
				);

				// Insert porduct Cats END
				$ecommerce_online_store_image_url = get_template_directory_uri().'/resource/img/product-category/'.str_replace( ' ', '-',strtolower($ecommerce_online_store_product_cats)).'.png';

				$ecommerce_online_store_image_name= 'img'.$k.'.png';
				$ecommerce_online_store_upload_dir       = wp_upload_dir();
				// Set upload folder
				$ecommerce_online_store_image_data= file_get_contents($ecommerce_online_store_image_url);
				// Get image data
				$ecommerce_online_store_unique_file_name = wp_unique_filename( $ecommerce_online_store_upload_dir['path'], $ecommerce_online_store_image_name );
				// Generate unique name
				$ecommerce_online_store_filename= basename( $ecommerce_online_store_unique_file_name );
				// Create image file name

				// Check folder permission and define file location
				if( wp_mkdir_p( $ecommerce_online_store_upload_dir['path'] ) ) {
				$file = $ecommerce_online_store_upload_dir['path'] . '/' . $ecommerce_online_store_filename;
				} else {
				$file = $ecommerce_online_store_upload_dir['basedir'] . '/' . $ecommerce_online_store_filename;
				}

				if ( ! function_exists( 'WP_Filesystem' ) ) {
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
				}
				
				WP_Filesystem();
				global $wp_filesystem;
				
				if ( ! $wp_filesystem->put_contents( $file, $ecommerce_online_store_image_data, FS_CHMOD_FILE ) ) {
					wp_die( 'Error saving file!' );
				}
				

				// Check image file type
				$wp_filetype = wp_check_filetype( $ecommerce_online_store_filename, null );

				// Set attachment data
				$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title'     => sanitize_file_name( $ecommerce_online_store_filename ),
				'post_content'   => '',
				'post_type'     => 'product',
				'post_status'    => 'inherit'
				);

				// Create the attachment
				$attach_id = wp_insert_attachment( $attachment, $file, $post_id );

				// Include image.php
				require_once(ABSPATH . 'wp-admin/includes/image.php');

				// Define attachment metadata
				$attach_data = wp_generate_attachment_metadata( $attach_id, $file );

				// Assign metadata to attachment
				wp_update_attachment_metadata( $attach_id, $attach_data );

				update_woocommerce_term_meta( $parent_category['term_id'], 'thumbnail_id', $attach_id );

				// -------------- create subcategory START ---------------
				$ecommerce_online_store_review_text = array(
						'Nice product',
						'Good Quality Product',
					);
				// -------------- create subcategory END -----------------

				// create Product START
				$image_gallery = array();
				foreach ( $ecommerce_online_store_products_name as $key => $ecommerce_online_store_product_title ) {
					
					$content = 'Lorem Ipsum has been the industrys standard dummy text ever since the 1500 when an unknown printer took a galley of type and scrambled it to make a type specimen book when an unknown printer took a galley of type and scrambled it to make a type specimen book.';
					// Create post object
					$my_post = array(
						'post_title'    => wp_strip_all_tags( $ecommerce_online_store_product_title ),
						'post_content'  => $content,
						'post_status'   => 'publish',
						'post_type'     => 'product',
						'post_category' => [$parent_category['term_id']]
					);
					// Insert the post into the database
					$post_id    = wp_insert_post($my_post);
					wp_set_object_terms( $post_id, str_replace( ' ', '-', $ecommerce_online_store_product_cats), 'product_cat', true );

					// Set product prices
					update_post_meta($post_id, '_regular_price', '599.99'); // Set regular price
					update_post_meta($post_id, '_sale_price', '499.99'); // Set sale price
					update_post_meta($post_id, '_price', '499.99'); // Set current price (sale price is applied)

					// -------------- rating START -------------------------
					for ( $c=0; $c <= 4; $c++ ) {
						$ecommerce_online_store_comment_id = wp_insert_comment( array(
							'comment_post_ID'      => $post_id,
							'comment_author'       => get_the_author_meta( 'display_name' ),
							'comment_author_email' => get_the_author_meta( 'user_email' ),
							'comment_content'      => $ecommerce_online_store_review_text[$c],
							'comment_parent'       => 0,
							'user_id'              => get_current_user_id(), // <== Important
							'comment_date'         => date('Y-m-d H:i:s'),
							'comment_approved'     => 1,
						) );
						update_comment_meta( $ecommerce_online_store_comment_id, 'rating', 3 );
					}
					// ------------- rating END -------------------------

					// Now replace meta w/ new updated value array
					$ecommerce_online_store_image_url = get_template_directory_uri().'/resource/img/product/'.$ecommerce_online_store_product_cats.'/' . str_replace(' ', '-', strtolower($ecommerce_online_store_product_title)).'.png';
					$ecommerce_online_store_image_name  = $ecommerce_online_store_product_title.'.png';
					$ecommerce_online_store_upload_dir = wp_upload_dir();
					// Set upload folder
					$ecommerce_online_store_image_data = file_get_contents(esc_url($ecommerce_online_store_image_url));
					// Get image data
					$ecommerce_online_store_unique_file_name = wp_unique_filename($ecommerce_online_store_upload_dir['path'], $ecommerce_online_store_image_name);
					// Generate unique name
					$ecommerce_online_store_filename = basename($ecommerce_online_store_unique_file_name);
					// Create image file name
					// Check folder permission and define file location
					if (wp_mkdir_p($ecommerce_online_store_upload_dir['path'])) {
						$file = $ecommerce_online_store_upload_dir['path'].'/'.$ecommerce_online_store_filename;
					}
					// Create the image  file on the server
					if ( ! function_exists( 'WP_Filesystem' ) ) {
						require_once( ABSPATH . 'wp-admin/includes/file.php' );
					}
					
					WP_Filesystem();
					global $wp_filesystem;
					
					if ( ! $wp_filesystem->put_contents( $file, $ecommerce_online_store_image_data, FS_CHMOD_FILE ) ) {
						wp_die( 'Error saving file!' );
					}
					

					// Check image file type
					$wp_filetype = wp_check_filetype($ecommerce_online_store_filename, null);
					// Set attachment data
					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title'     => sanitize_file_name($ecommerce_online_store_filename),
						'post_type'      => 'product',
						'post_status'    => 'inherit',
					);
					// Create the attachment
					$attach_id = wp_insert_attachment($attachment, $file, $post_id);
					// Include image.php
					require_once (ABSPATH.'wp-admin/includes/image.php');
					// Define attachment metadata
					$attach_data = wp_generate_attachment_metadata($attach_id, $file);
					// Assign metadata to attachment
					wp_update_attachment_metadata($attach_id, $attach_data);

					// $wp_get_attachment_url = wp_get_attachment_url( $attach_id );
					if ( count( $image_gallery ) < 3 ) {
						array_push( $image_gallery, $attach_id );
					}
					// And finally assign featured image to post
					set_post_thumbnail($post_id, $attach_id);
				}
				// Create product END
				wp_update_post($post_id);
				$k++;
			}
			
			
		// ------------------------------------------ Blogs for Sections --------------------------------------
			
			wp_delete_post(1);

			// Loop to create posts
			for ($i = 1; $i <= 3; $i++) {

				$title = array(
					'LET’S Elevate Your Shopping Experience with Exclusive Deals!',
					'Shop Smart, Shop Easy – Your One-Stop Online Store!',
					'Trending Now: Must-Have Products at Unbeatable Prices!'
				);				

				$content = 'Exciting News! We have just launched our newest product line featuring a range of sustainable and eco-friendly options for conscious shoppers.';

				// Create post object
				$my_post = array(
					'post_title'    => wp_strip_all_tags( $title[$i-1] ),
					'post_content'  => $content,
					'post_status'   => 'publish',
					'post_type'     => 'post',
				);

				// Insert the post into the database
				$post_id = wp_insert_post($my_post);

				// Set dynamic image name
				$ecommerce_online_store_image_name = 'slider' . $i . '.png';
				$ecommerce_online_store_image_url  = get_template_directory_uri() . '/resource/img/' . $ecommerce_online_store_image_name;

				$ecommerce_online_store_upload_dir = wp_upload_dir();
				$ecommerce_online_store_image_data = file_get_contents($ecommerce_online_store_image_url);
				$ecommerce_online_store_unique_file_name = wp_unique_filename($ecommerce_online_store_upload_dir['path'], $ecommerce_online_store_image_name);
				$filename = basename($ecommerce_online_store_unique_file_name);

				if (wp_mkdir_p($ecommerce_online_store_upload_dir['path'])) {
					$file = $ecommerce_online_store_upload_dir['path'] . '/' . $filename;
				} else {
					$file = $ecommerce_online_store_upload_dir['basedir'] . '/' . $filename;
				}

				if ( ! function_exists( 'WP_Filesystem' ) ) {
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
				}
				
				WP_Filesystem();
				global $wp_filesystem;
				
				if ( ! $wp_filesystem->put_contents( $file, $ecommerce_online_store_image_data, FS_CHMOD_FILE ) ) {
					wp_die( 'Error saving file!' );
				}

				$wp_filetype = wp_check_filetype($ecommerce_online_store_filename, null);
				$attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title'     => sanitize_file_name($ecommerce_online_store_filename),
					'post_content'   => '',
					'post_status'    => 'inherit'
				);

				$ecommerce_online_store_attach_id = wp_insert_attachment($attachment, $file, $post_id);

				require_once(ABSPATH . 'wp-admin/includes/image.php');

				$ecommerce_online_store_attach_data = wp_generate_attachment_metadata($ecommerce_online_store_attach_id, $file);
				wp_update_attachment_metadata($ecommerce_online_store_attach_id, $ecommerce_online_store_attach_data);
				set_post_thumbnail($post_id, $ecommerce_online_store_attach_id);
			}


		// ---------------------------------------- Slider --------------------------------------------------- //

			for($i=1; $i<=3; $i++) {
				set_theme_mod('ecommerce_online_store_banner_button_label_'.$i,'Shop now');
				set_theme_mod('ecommerce_online_store_banner_button_link_'.$i,'#');
				set_theme_mod('ecommerce_online_store_banner_second_button_label_'.$i,'View Collection');
				set_theme_mod('ecommerce_online_store_banner_second_button_link_'.$i,'#');
			}
			set_theme_mod('ecommerce_online_store_enable_topbar',true);
			

		// ---------------------------------------- Footer section --------------------------------------------------- //	
		
			set_theme_mod('ecommerce_online_store_footer_background_color_setting','#000000');
			

		// ---------------------------------------- Related post_tag --------------------------------------------------- //	
		
			set_theme_mod('ecommerce_online_store_post_related_post_label','Related Posts');
			set_theme_mod('ecommerce_online_store_related_posts_count','3');


		$this->ecommerce_online_store_customizer_primary_menu();
	}
}
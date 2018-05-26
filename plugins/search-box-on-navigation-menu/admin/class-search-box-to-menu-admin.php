<?php

/**
 * The Search box on Navigation Menu Admin defines all functionality for the dashboard
 * of the plugin.
 *
 * This class defines the meta box used to display the post meta data and registers
 * the style sheet responsible for styling the content of the meta box.
 *
 * @package ASTM
 * @since    1.0.0

 Original Copyright Vinod Dalvi (Add Search To Menu). Copyright 2017 Codetic.
 */
class Search_On_Menu_Admin {

	/**
	 * Global plugin option.
	 */
	public $options;

	/**
	 * A reference to the version of the plugin that is passed to this class from the caller.
	 *
	 * @access private
	 * @var    string    $version    The current version of the plugin.
	 */
	private $version;


	/**
	 * are we network activated?
	 */
	private $networkactive;

	/**
	 * Initializes this class and stores the current version of this plugin.
	 *
	 * @param    string    $version    The current version of this plugin.
	 */
	public function __construct( $version ) {
		$this->version = $version;
		$this->options = get_option( 'search_box_to_menu' );
		$this->networkactive = ( is_multisite() && array_key_exists( plugin_basename( __FILE__ ), (array) get_site_option( 'active_sitewide_plugins' ) ) );
	}

	/**
	 * PHP 4 Compatible Constructor
	 *
	 */
	function Search_On_Menu_Admin() {
		$this->__construct();
	}

	/**
	 * Loads plugin javascript and stylesheet files in the admin area
	 *
	 */
	function search_box_to_menu_load_admin_assets(){

		wp_register_script( 'add-search-to-menu-scripts', plugins_url( '/js/search-box-to-menu-admin.js', __FILE__ ), array( 'jquery' ), '1.0', true  );

		wp_localize_script( 'add-search-to-menu-scripts', 'search_box_to_menu', array(
			'ajax_url' => admin_url( 'admin-ajax.php' )
		) );

		// Enqueued script with localized data.
		wp_enqueue_script( 'add-search-to-menu-scripts' );
	}

	/**
	 * Add a link to the settings page to the plugins list
	 *
	 * @param array  $links array of links for the plugins, adapted when the current plugin is found.
	 * @param string $file  the filename for the current plugin, which the filter loops through.
	 *
	 * @return array $links
	 */
	function search_box_to_menu_settings_link( $links, $file ) {

		if ( false !== strpos( $file, 'search-box-to-menu' ) ) {
			$mylinks = array(
				'<a href="https://wordpress.org/support/plugin/search-box-on-navigation-menu">' . esc_html__( 'Get Support', 'search-box-to-menu' ) . '</a>',
				'<a href="options-general.php?page=search_box_to_menu">' . esc_html__( 'Settings', 'search-box-to-menu' ) . '</a>'
			);
			$links = array_merge( $mylinks, $links );
		}
		return $links;
	}


	/* Registers menu item */
	function search_box_to_menu_admin_menu_setup(){
		add_submenu_page( 'options-general.php', __( 'Search box on Navigation Menu Settings', 'search-box-to-menu' ), __( 'Search box on Navigation Menu', 'search-box-to-menu' ), 'manage_options', 'search_box_to_menu', array( $this, 'search_box_to_menu_admin_page_screen' ) );
	}

	/* Displays plugin admin page content */
	function search_box_to_menu_admin_page_screen() { ?>
		<div class="wrap">
			<form id="search_box_to_menu_options" action="options.php" method="post">
				<?php
					settings_fields( 'search_box_to_menu' );
					do_settings_sections( 'search_box_to_menu' );
					submit_button( 'Save Options', 'primary', 'search_box_to_menu_options_submit' );
				?>
				<div id="after-submit">
					<p>
						<?php esc_html_e( 'Like Search box on Navigation Menu?', 'search-box-to-menu' ); ?> <a href="https://wordpress.org/support/plugin/search-box-on-navigation-menu/reviews/?filter=5#new-post" target="_blank"><?php esc_html_e( 'Give us a rating', 'search-box-to-menu' ); ?></a>
					</p>
					<p>
						<?php esc_html_e( 'Need Help or Have Suggestions?', 'search-box-to-menu' ); ?> <?php esc_html_e( 'contact us on', 'search-box-to-menu' ); ?> <a href="https://wordpress.org/support/plugin/search-box-on-navigation-menu" target="_blank"><?php esc_html_e( 'Plugin support forum', 'search-box-to-menu' ); ?></a> <?php esc_html_e( 'or', 'search-box-to-menu' ); ?> <a href="https://www.codetic.net/contact-us/" target="_blank"><?php esc_html_e( 'Contact us page', 'search-box-to-menu' ); ?></a>
					</p>
				</div>
			 </form>
		</div>
		<?php
	}

	/* Registers settings */
	function search_box_to_menu_settings_init(){

		add_settings_section( 'search_box_to_menu_section', __( 'Search box on Navigation Menu Settings', 'search-box-to-menu' ),  array( $this, 'search_box_to_menu_section_desc'),
		 'search_box_to_menu' );

		add_settings_field( 'search_box_to_menu_locations', __( 'Searchbox on Navigation Menu : ', 'search-box-to-menu' ),  array( $this, 'search_box_to_menu_locations' ), 'search_box_to_menu', 'search_box_to_menu_section' );
		add_settings_field( 'search_box_to_menu_classes', __( 'Search Menu Classes : ', 'search-box-to-menu' ),  array( $this, 'search_box_to_menu_classes' ), 'search_box_to_menu', 'search_box_to_menu_section' );

		register_setting( 'search_box_to_menu', 'search_box_to_menu' );

	}

	/* Displays plugin description text */
	function search_box_to_menu_section_desc(){
		echo '<p>' . esc_html__( 'Configure the Search box on Navigation Menu plugin settings here.', 'search-box-to-menu' ) . '</p>';
	}

	/* choose locations field output */
	function search_box_to_menu_locations() {

		$options = $this->options;
		$html = '';
		$menus = get_registered_nav_menus();

		if ( ! empty( $menus ) ){

			if ( empty( $options ) ){
				$location = array_keys( $menus );
				$options['search_box_to_menu_locations'][ $location[0] ] = $location[0];

				update_option( 'search_box_to_menu', $options );
			}

			if ( isset( $options['search_box_to_menu_locations']['initial'] ) ){
				unset( $options['search_box_to_menu_locations']['initial'] );
				$location = array_keys( $menus );
				$options['search_box_to_menu_locations'][ $location[0] ] = $location[0];
				update_option( 'search_box_to_menu', $options );
			}

			foreach ( $menus as $location => $description ) {

				$check_value = isset( $options['search_box_to_menu_locations'][$location] ) ? $options['search_box_to_menu_locations'][ $location ] : 0;
				$html .= '<input type="checkbox" id="search_box_to_menu_locations' . esc_attr( $location ) . '" name="search_box_to_menu[search_box_to_menu_locations][' . esc_attr( $location ) . ']" value="' . esc_attr( $location ) . '" ' . checked( $location, $check_value, false ) . '/>';
				$html .= '<label for="search_box_to_menu_locations' . esc_attr( $location ) . '"> ' . esc_html( $description ) . '</label><br />';
			}
		} else {
			$html = __( 'No navigation menu registered on your site.', 'search-box-to-menu' );
		}
		echo $html;

	}

	/* classes field output */
	function search_box_to_menu_classes() {

		$options = $this->options;
		$options['search_box_to_menu_classes'] = isset( $options['search_box_to_menu_classes'] ) ? $options['search_box_to_menu_classes'] : 'search-menu';
		$html = '<input type="text" id="search_box_to_menu_classes" name="search_box_to_menu[search_box_to_menu_classes]" value="' . esc_attr( $options['search_box_to_menu_classes'] ) . '" size="50" />';
		echo $html;
	}

}
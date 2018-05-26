<?php

/**
 * The Search Box on Navigation Menu is the core plugin class responsible for including and
 * instantiating all of the code that composes the plugin
 *
 * @package ASTM
 */

/**
 * The Search Box on Navigation Menu is the core plugin responsible for including and
 * instantiating all of the code that composes the plugin.
 *
 * The Search Box on Navigation Menu includes an instance to the Search Box on Navigation Menu
 * Loader which is responsible for coordinating the hooks that exist within the
 * plugin.
 *
 * It also maintains a reference to the plugin name which can be used in
 * internationalization, and a reference to the current version of the plugin
 * so that we can easily update the version in a single place to provide
 * cache busting functionality when including scripts and styles.
 *
 * @since    1.0.0

 Original Copyright Vinod Dalvi (Add Search To Menu). Copyright 2017 Codetic.
 */

class Search_On_Menu {


	/**
	 * Global plugin option.
	 */
	 public $options;

	/**
	 * A reference to the loader class that coordinates the hooks and callbacks
	 * throughout the plugin.
	 *
	 * @access protected
	 * @var    Search_On_Menu_Loader   $loader    Manages hooks between the WordPress hooks and the callback functions.
	 */
	protected $loader;

	/**
	 * Represents the name of hte plugin that can be used throughout the plugin
	 * for internationalization and other purposes.
	 *
	 * @access protected
	 * @var    string   $plugin_name    The single, hyphenated string used to identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * Maintains the current version of the plugin so that we can use it throughout
	 * the plugin.
	 *
	 * @access protected
	 * @var    string   $version    The current version of the plugin.
	 */
	protected $version;


	/**
	 * Instantiates the plugin by setting up the core properties and loading
	 * all necessary dependencies and defining the hooks.
	 *
	 * The constructor will define both the plugin name and the verison
	 * attributes, but will also use internal functions to import all the
	 * plugin dependencies, and will leverage the Search_On_Menu for
	 * registering the hooks and the callback functions used throughout the
	 * plugin.
	 */
	public function __construct() {

		$this->plugin_name = 'add-search-to-menu';
		$this->version = '1.0.0';
		$this->options = get_option( 'search_box_to_menu' );

		$this->load_dependencies();

		if ( is_admin() ) {
			$this->define_admin_hooks();
		} else {
			$this->define_public_hooks();
		}
	}


	/**
	 * PHP 4 Compatible Constructor
	 *
	 */
	function Search_On_Menu() {
		$this->__construct();
	}


	/**
	 * Imports the Search Box on Navigation Menu administration classes, and the Search Box on Navigation Menu Loader.
	 *
	 * The Search Box on Navigation Menu Manager administration class defines all unique functionality for
	 * introducing custom functionality into the WordPress dashboard.
	 *
	 * The Search Box on Navigation Menu Loader is the class that will coordinate the hooks and callbacks
	 * from WordPress and the plugin. This function instantiates and sets the reference to the
	 * $loader class property.
	 *
	 * @access    private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-search-box-to-menu-loader.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-search-box-to-menu-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the front end of site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-search-box-to-menu-public.php';

		$this->loader = new Search_On_Menu_Loader();

	}

	/**
	 * Defines the hooks and callback functions that are used for setting up the plugin stylesheets
	 * and the plugin's admin options.
	 *
	 * This function relies on the Search Box on Navigation Menu Admin class and the Search Box on Navigation Menu
	 * Loader class property.
	 *
	 * @access    private
	 */
	private function define_admin_hooks() {

		$admin = new Search_On_Menu_Admin( $this->get_version() );
		$options = $this->options;
		$this->loader->add_action( 'plugin_action_links', $admin, 'search_box_to_menu_settings_link', 10, 2 );
		$this->loader->add_action( 'admin_menu', $admin, 'search_box_to_menu_admin_menu_setup' ); //menu setup
		$this->loader->add_action( 'admin_init', $admin, 'search_box_to_menu_settings_init' );
	}

	/**
	 * Defines the hooks and callback functions that are used for executing plugin functionality
	 * in the front end of site.
	 *
	 * This function relies on the Search Box on Navigation Menu Admin class and the Search Box on Navigation Menu
	 * Loader class property.
	 *
	 * @access    private
	 */
	private function define_public_hooks() {

		$public = new Search_On_Menu_Public( $this->get_version() );
		$this->loader->add_filter( 'wp_nav_menu_items', $public, 'search_box_to_menu_items', 99, 2 );
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}


	/**
	 * Sets this class into motion.
	 *
	 * Executes the plugin by calling the run method of the loader class which will
	 * register all of the hooks and callback functions used throughout the plugin
	 * with WordPress.
	 */
	public function run() {
		$this->loader->run();
	}


	/**
	 * Returns the current version of the plugin to the caller.
	 *
	 * @return    string    $this->version    The current version of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
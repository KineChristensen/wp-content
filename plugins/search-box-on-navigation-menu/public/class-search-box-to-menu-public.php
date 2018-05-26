<?php

/**
 * The Search Box on Navigation Menu Public defines all functionality of plugin
 * for the site front
 *
 * This class defines the meta box used to display the post meta data and registers
 * the style sheet responsible for styling the content of the meta box.
 *
 * @package ASTM
 * @since    1.0.0
 */
class Search_On_Menu_Public {

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
	 * Initializes this class and stores the current version of this plugin.
	 *
	 * @param    string    $version    The current version of this plugin.
	 */
	public function __construct( $version ) {
		$this->version = $version;
		$this->options = get_option( 'search_box_to_menu' );
	}

	/**
	 * PHP 4 Compatible Constructor
	 *
	 */
	function Search_On_Menu_Public() {
		$this->__construct();
	}

	/* Adds search in the navigation bar in the front end of site */
	function search_box_to_menu_items( $items, $args ){

		$options = $this->options;

		if ( isset( $options['search_box_to_menu_locations'] ) ) {

			if ( isset( $options['search_box_to_menu_locations']['initial'] ) ) {
				unset( $options['search_box_to_menu_locations']['initial'] );
				$options['search_box_to_menu_locations'][$args->theme_location] = $args->theme_location;
				update_option( 'search_box_to_menu', $options );
			}

			if ( isset( $options['search_box_to_menu_locations'][$args->theme_location] ) ) {

				$search_class = isset( $options['search_box_to_menu_classes'] ) ? $options['search_box_to_menu_classes'].' search-menu ' : 'search-menu ';
				$search_class .= isset( $options['search_box_to_menu_style'] ) ? $options['search_box_to_menu_style'] : 'default';
				$title = isset( $options['search_box_to_menu_title'] ) ? $options['search_box_to_menu_title'] : '';
				$items .= '<li class="' . esc_attr( $search_class ) . '"><a title="' . esc_attr( $title ) . '" href="#">';
				$items .= '</a>' . get_search_form( false ) . '</li>';

				$items .= '</li>';
			}
		}
		return $items;
	}

}
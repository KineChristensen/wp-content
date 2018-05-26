<?php

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @link       https://www.codetic.net/
 * @since      1.0.0
 * @package    ASTM
 * @subpackage ASTM/includes
 * @author     Codetic
 
 Original Copyright Vinod Dalvi (Add Search To Menu). Copyright 2017 Codetic.
 */
class Search_On_Menu_Activator {

	/**
	 * Short Description.
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		$options = get_option( 'search_box_to_menu' );

		if ( ! isset( $options['search_box_to_menu_locations'] ) ) {
			$options['search_box_to_menu_locations']['initial'] = 'initial';
			update_option( 'search_box_to_menu', $options );
		}
	}

}
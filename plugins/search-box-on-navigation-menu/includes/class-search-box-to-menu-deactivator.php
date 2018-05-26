<?php

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @link       https://www.codetic.net/
 * @since      1.0.0
 * @package    ASTM
 * @subpackage ASTM/includes
 * @author     Codetic

 Original Copyright Vinod Dalvi (Add Search To Menu). Copyright 2017 Codetic.
 */
class Search_On_Menu_Deactivator {

	/**
	 * Short Description.
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

		$options = get_option( 'search_box_to_menu' );

		if ( isset( $options['dismiss_admin_notices'] ) ) {
			unset( $options['dismiss_admin_notices'] );
			update_option( 'search_box_to_menu', $options );
		}
	}

}
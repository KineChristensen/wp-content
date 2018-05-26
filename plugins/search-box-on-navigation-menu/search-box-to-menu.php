<?php
/*
Plugin Name:       Search box on Navigation Menu
Plugin URI:        https://www.codetic.net
Description:       This plugin will add a search box on navigation menu which can be configured from the dashboard. 
Version:           2.1
Author:            Codetic
Author URI:        https://www.codetic.net
License:           GPL-2.0+
License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain:       search-box-to-menu

Search box on Navigation Menu plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Search box on Navigation Menu plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Search box on Navigation Menu plugin. If not, see https://www.gnu.org/licenses/gpl-2.0.html.

Original Copyright Vinod Dalvi (Add Search To Menu). Copyright 2017 Codetic.

*/

/**
 * The file responsible for starting the Search box on Navigation Menu plugin
 *
 * The Search Box on Navigation Menu is a plugin that can be used
 * to display search menu in the navigation bar. This particular file is responsible for
 * including the necessary dependencies and starting the plugin.
 *
 * @package ASTM
 */


/**
 * If this file is called directly, then abort execution.
 */
if ( ! defined( 'ABSPATH' ) ) {
	die;
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-search-box-to-menu-activator.php
 */
function activate_search_box_to_menu() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-search-box-to-menu-activator.php';
	Search_On_Menu_Activator::activate();
}


/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-search-box-to-menu-deactivator.php
 */
function deactivate_search_box_to_menu() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-search-box-to-menu-deactivator.php';
	Search_On_Menu_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_search_box_to_menu' );
register_deactivation_hook( __FILE__, 'deactivate_search_box_to_menu' );


/**
 * Include the core class responsible for loading all necessary components of the plugin.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-search-box-to-menu.php';

/**
 * Instantiates the Search Box on Navigation Menu class and then
 * calls its run method officially starting up the plugin.
 */
function run_search_box_to_menu() {
	$ewpd = new Search_On_Menu();
	$ewpd->run();
}

/**
 * Call the above function to begin execution of the plugin.
 */
run_search_box_to_menu();
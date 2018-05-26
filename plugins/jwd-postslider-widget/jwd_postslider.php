<?php
/**
 * Plugin Name: JWD PostSlider Widget
 * Plugin URI:  http://jordachewd.com/
 * Description: Displays posts from specific post type / taxonomy / term into a carousel widget. Full responsive and highly customisable.
 * Author: JordacheWD
 * Author URI: http://www.jordachewd.com/
 * Version: 1.8.1
 * Text Domain: jwdsp
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 *
 * JWD PostSlider Widget is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * You should have received a copy of the GNU General Public License
 * along with JWD PostSlider Widget. If not, see <http://www.gnu.org/licenses/>.
 *
 */
/********************************
 * Blocking direct access to this plugin PHP file 
 ********************************/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/********************************
 * Load Widget Components
 ********************************/
include_once( plugin_dir_path( __FILE__ ) . 'inc/jwdsp_hooks.php');
include_once( plugin_dir_path( __FILE__ ) . 'inc/jwdsp_admin_page.php'); 
include_once( plugin_dir_path( __FILE__ ) . 'inc/jwdsp_enqueue.php');
include_once( plugin_dir_path( __FILE__ ) . 'inc/jwdsp_ajax.php');
include_once( plugin_dir_path( __FILE__ ) . 'inc/jwdsp_widget.php');
include_once( plugin_dir_path( __FILE__ ) . 'inc/jwdsp_metabox.php');
include_once( plugin_dir_path( __FILE__ ) . 'inc/jwdsp_deprecated.php');
/********************************
 * Add "Settings" link in plugin's description
 ********************************/
if ( ! function_exists( 'jwdsp_add_action_links' ) ) {
	add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'jwdsp_add_action_links' );
	function jwdsp_add_action_links( $links ) {
	   $links[] = '<a href="'. esc_url( get_admin_url( null, 'admin.php?page=jwdsp_postslider_page' ) ) .'">'.__('Settings', 'jwdsp').'</a>';
	   $links[] = '<a href="'. esc_url( get_admin_url( null, 'widgets.php' ) ) .'">'.__('Widgets', 'jwdsp').'</a>';
	   return $links;
	}
}
/********************************
 * Get Plugin Data
 ********************************/
if ( ! function_exists( 'jwdsp_plugin_data' ) ) { 
	function jwdsp_plugin_data($return = '') {
		if ( is_admin() ) {
			$plugin_data = get_plugin_data( __FILE__ );
			switch ($return){
				case 'Name': return $plugin_data['Name']; break;
				case 'Author': return $plugin_data['Author']; break;
				case 'PluginURI': return $plugin_data['PluginURI']; break;
				default: return $plugin_data['Version'];
			}
		}
	}
}
/********************************
 * Get Plugin Translations
 ********************************/
if ( ! function_exists( 'jwdsp_plugin_languages' ) ) { 
	function jwdsp_plugin_languages() {
		load_plugin_textdomain( 'jwdsp', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
	add_action('init', 'jwdsp_plugin_languages');
}
<?php 
/*
Plugin Name: WP Filter Posts
Plugin URI: http://xyzscripts.com/wordpress-plugins/wp-filter-posts/
Description: This plugin allows you to create any number of post filters based on different categories, tags or authors. These filters can be rendered in different wordpress pages using shortcodes. It provides a user-friendly interface to generate the shortcodes. In addition to filtering based on  categories, tags and authors, it also provides option to sort the results based on published date or updated date. It also provides options to specify the display format of the posts which match the filter conditions. The is also support for pagination of results.  
Version:1.0 
Author: xyzscripts.com
Author URI: http://xyzscripts.com/
License: GPLv2 or later
*/
if (!defined( 'ABSPATH' ))
     exit;
 
if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}


//error_reporting(E_ALL);
define('XYZ_WPF_PLUGIN_FILE',__FILE__);


require_once( dirname( __FILE__ ) . '/admin/install.php' );
require_once( dirname( __FILE__ ) . '/admin/menu.php' );
require_once( dirname( __FILE__ ) . '/admin/destruction.php' );

//require_once( dirname( __FILE__ ) . '/admin/ajax-backlink.php' );

require( dirname( __FILE__ ) . '/ajax-handler.php' );
require_once( dirname( __FILE__ ) . '/xyz-functions.php' );
if(get_option('xyz_wpf_credit_link')=="wpf")
{
	add_action('wp_footer', 'xyz_wpf_credit');
}
function xyz_wpf_credit() {
	$content = '<div style="clear:both;width:100%;text-align:center; font-size:11px; "><a target="_blank" title="WP Filter Posts" href="#" >WP Filter Posts</a> Powered By : <a target="_blank" title="PHP Scripts & Wordpress Plugins" href="http://www.xyzscripts.com" >XYZScripts.com</a></div>';
	echo $content;
}

function xyz_wpf_admin_scripts()
{
	wp_register_style('xyz_wpf_style', plugins_url ('admin/style.css' , __FILE__ ));
	wp_enqueue_style('xyz_wpf_style');
	wp_register_script( 'xyz_wpf_script', plugins_url ('admin/notice.js' , __FILE__ ) );
	wp_enqueue_script( 'xyz_wpf_script' );
}
add_action("admin_enqueue_scripts","xyz_wpf_admin_scripts");
?>
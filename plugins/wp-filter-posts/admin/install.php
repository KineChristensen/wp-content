<?php 
if (!defined( 'ABSPATH' ))
     exit;
 
function xyz_wpf_network_install($networkwide) {
	global $wpdb;

	if (function_exists('is_multisite') && is_multisite()) {
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide) {
			$old_blog = $wpdb->blogid;
			// Get all blog ids
			$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				xyz_wpf_install();
			}
			switch_to_blog($old_blog);
			return;
		}
	}
	xyz_wpf_install();
}
function xyz_wpf_install()
{
	global $wpdb;

	if(get_option('xyz_wpf_credit_link')=="")
	{
		add_option("xyz_wpf_credit_link", '0');
	}
	add_option("xyz_wpf_credit_dismiss", '0');
	add_option('xyz_wpf_page_size', '20');
	
	$queryMapping ="CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."xyz_wp_posts_filter` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`xyz_wpf_name` text COLLATE utf8_unicode_ci NOT NULL,
			`xyz_wpf_categories` text COLLATE utf8_unicode_ci NOT NULL,
			`xyz_wpf_cat_post_from` int(11) NOT NULL COMMENT '0:Any,1:All',
			`xyz_wpf_tags` text COLLATE utf8_unicode_ci NOT NULL,
			`xyz_wpf_tag_post_from` int(11) NOT NULL COMMENT '0:Any,1:All',
			`xyz_wpf_authors` text COLLATE utf8_unicode_ci NOT NULL,
			`xyz_wpf_skip_posts` int(11) NOT NULL,
			`xyz_wpf_no_of_posts` int(11) NOT NULL,
			`xyz_wpf_pagination` int(11) NOT NULL COMMENT '0:Yes,1:No',
			`xyz_wpf_pagination_limit` int(11) NOT NULL,
			`xyz_wpf_sort` int(11) NOT NULL COMMENT '0:Publish Date,1:Update Date',
			`xyz_wpf_order` int(11) NOT NULL COMMENT '0:Asc,1:Desc',
			`xyz_wpf_msg_format` text COLLATE utf8_unicode_ci NOT NULL,
			`xyz_wpf_status` int(11) NOT NULL COMMENT '0:Inactive,1:Active',
			PRIMARY KEY (`id`)
	)  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1" ;
	
	$wpdb->query($queryMapping);
	
	$version=get_option('xyz_wpf_free_version');
	$currentversion=xyz_wpf_plugin_get_version();
	if($version=="")
	{
		add_option("xyz_wpf_free_version", $currentversion);
	}
	else
	{
		update_option('xyz_wpf_free_version', $currentversion);
	}
}

register_activation_hook(XYZ_WPF_PLUGIN_FILE,'xyz_wpf_network_install');
?>
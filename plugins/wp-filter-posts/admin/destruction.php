<?php 
if (!defined( 'ABSPATH' ))
     exit;

function xyz_wpf_network_destroy($networkwide) 
{
	global $wpdb;

	if (function_exists('is_multisite') && is_multisite()) 
	{
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide) 
		{
			$old_blog = $wpdb->blogid;
			// Get all blog ids
			$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach ($blogids as $blog_id) 
			{
				switch_to_blog($blog_id);
				xyz_wpf_destroy();
			}
			switch_to_blog($old_blog);
			return;
		}
	}
	xyz_wpf_destroy();
}

function xyz_wpf_destroy()
{
	global $wpdb;
	if(get_option('xyz_wpf_credit_link')=="wpf")
	{
		update_option("xyz_wpf_credit_link", '0');
	}
	delete_option('xyz_wpf_page_size');
	delete_option('xyz_wpf_credit_dismiss');
	$wpdb->query("DROP TABLE ".$wpdb->prefix."xyz_wp_posts_filter");
}
register_uninstall_hook(XYZ_WPF_PLUGIN_FILE,'xyz_wpf_network_destroy');
?>
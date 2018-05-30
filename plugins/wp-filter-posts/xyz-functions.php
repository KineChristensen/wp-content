<?php
if (!defined( 'ABSPATH' ))
     exit;
     
if (!function_exists("xyz_wpf_get_category_display")) 
{
	function xyz_wpf_get_category_display($pid,$i,$catid,$taxonomy)
	{
		global $wpdb;
		$cat_value="";
		$res=$wpdb->get_results($wpdb->prepare("SELECT name, ".$wpdb->prefix."terms.term_id ,".$wpdb->prefix."term_taxonomy.parent FROM ".$wpdb->prefix."term_taxonomy  JOIN ".$wpdb->prefix."terms ON ".$wpdb->prefix."term_taxonomy.term_id = ".$wpdb->prefix."terms.term_id
				WHERE ".$wpdb->prefix."term_taxonomy.taxonomy =  %s AND ".$wpdb->prefix."term_taxonomy.parent =%d",$taxonomy,$pid));
	
		foreach($res as $row)
		{
	
			$tot=$wpdb->get_col("SELECT COUNT(term_id) FROM ".$wpdb->prefix."term_taxonomy WHERE parent='".$row->term_id."'");
			if($catid!=$row->term_id)
				$cat_value=$cat_value.'<option id="'.$row->term_id.'" value="'.$row->term_id.'">';
			else 
				$cat_value=$cat_value.'<option id="'.$row->term_id.'" selected="" value="'.$row->term_id.'">';
	
			for($count=0;$count<$i;$count++)
			{
				$cat_value=$cat_value.'&nbsp;&raquo;';
			}
			$cat_value=$cat_value.$row->name.'</option>';
			if($tot!=0)
				$cat_value=$cat_value.xyz_wpf_get_category_display($row->term_id,$i+1,$catid,$taxonomy);
		}
	return $cat_value;

	}
}
if(!function_exists('xyz_wpf_links')){
	function xyz_wpf_links($links, $file) {
		$base = plugin_basename(XYZ_WPF_PLUGIN_FILE);
		if ($file == $base) {

			$links[] = '<a href="http://help.xyzscripts.com/docs/wp-filter-posts/faq/"  title="FAQ">FAQ</a>';
			$links[] = '<a href="http://help.xyzscripts.com/docs/wp-filter-posts/user-guide/"  title="Read Me">README</a>';
			$links[] = '<a href="http://xyzscripts.com/support/" class="xyz_support" title="Support"></a>';
			$links[] = '<a href="http://twitter.com/xyzscripts" class="xyz_twitt" title="Follow us on Twitter"></a>';
			$links[] = '<a href="https://www.facebook.com/xyzscripts" class="xyz_fbook" title="Like us on Facebook"></a>';
			$links[] = '<a href="https://plus.google.com/+Xyzscripts" class="xyz_gplus" title="+1 us on Google+"></a>';
			$links[] = '<a href="http://www.linkedin.com/company/xyzscripts" class="xyz_linkedin" title="Follow us on LinkedIn"></a>';
		}
		return $links;
	}
}
add_filter( 'plugin_row_meta','xyz_wpf_links',10,2);

if(!function_exists('xyz_wpf_plugin_get_version'))
{
	function xyz_wpf_plugin_get_version()
	{
		if ( ! function_exists( 'get_plugins' ) )
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$plugin_folder = get_plugins( '/' . plugin_basename( dirname( XYZ_WPF_PLUGIN_FILE ) ) );
		return $plugin_folder['wp-filter-posts.php']['Version'];
	}
}
?>
<?php 
if (!defined( 'ABSPATH' ))
     exit;
     
add_action('wp_ajax_filter_entry_delete', 'xyz_wpf_filter_entry_delete');
function xyz_wpf_filter_entry_delete()
{
	global $wpdb;
	check_ajax_referer( 'xyz-del-info','security' );
	$xyz_wpf_filterId=intval($_POST['id']);

	$msg="Filter deleted successfully.";
	$wpdb->query( $wpdb->prepare( 'DELETE FROM  '.$wpdb->prefix.'xyz_wp_posts_filter  WHERE id=%d',$xyz_wpf_filterId)) ;
	echo $msg;
	die;
}

add_action('wp_ajax_filter_entry_status', 'xyz_wpf_filter_entry_status');
function xyz_wpf_filter_entry_status()
{
	global $wpdb;
	check_ajax_referer( 'xyz-stat-info','security' );
	$xyz_wpf_filterId=intval($_POST['id']);
	$status_val=$wpdb->get_row($wpdb->prepare("SELECT `xyz_wpf_status` FROM ".$wpdb->prefix."xyz_wp_posts_filter WHERE `id`=%d",$xyz_wpf_filterId));
	$status=$status_val->xyz_wpf_status;
	if($status==1)
	{
		$status=0;$str="Inactive";$bg="#FFD6E7";
	}
	else
	{
		$status=1;$str="Active";$bg="#CCF5CC";
	}
	$wpdb->query( $wpdb->prepare( 'UPDATE '.$wpdb->prefix.'xyz_wp_posts_filter SET `xyz_wpf_status`=%d WHERE id=%d',$status,$xyz_wpf_filterId )) ;
	echo $str;
	die;
}



function xyz_wpf_ajax_backlink() 
{
    if(current_user_can('administrator')){ 
        check_ajax_referer( 'xyz-post-fltr','security' );
        global $wpdb;
        if(isset($_POST)){ 
            if(intval($_POST['enable'])==1){
                update_option('xyz_wpf_credit_link','wpf');
                 echo 1;
            }
        	if(intval($_POST['enable'])==-1){
            	update_option('xyz_wpf_credit_dismiss','dis');
            	echo -1;
        	}
        }
    }
    die;
}
add_action('wp_ajax_xyz_wpf_ajax_backlink', 'xyz_wpf_ajax_backlink');
?>
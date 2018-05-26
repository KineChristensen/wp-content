<?php defined('ABSPATH') or die("No script kiddies please!");
/**
 * Posted Data
 * */
// echo "<pre>";
// print_r($_POST);
// die();
global $wpdb;
$table_name = $wpdb->prefix . 'apmm_custom_theme';

foreach($_POST as $key=>$val)
{
    if($key=='general' || $key=='menu_bar' || $key=='top_menu' || $key=='megamenu_bar' || $key=='second_menu' || $key=='third_menu' || $key=='widgets' || $key=='top_section' || $key=='bottom_section' || $key=='flyout' 
    	|| $key=='mobile_settings' || $key=='search_bar')
    {
         $$key = $val;   
    }
    else
    {
        $$key = sanitize_text_field($val);              
    }             
}

if(isset($general)){$general = $general;}else{$general = array();}
if(isset($menu_bar)){$menu_bar = $menu_bar;}else{$menu_bar = array();}
if(isset($top_menu)){$top_menu = $top_menu;}else{$top_menu = array();}
if(isset($megamenu_bar)){$megamenu_bar = $megamenu_bar;}else{$megamenu_bar = array();}
// if(isset($second_menu)){$second_menu = $second_menu;}else{$second_menu = array();}
// if(isset($third_menu)){$third_menu = $third_menu;}else{$third_menu = array();}
if(isset($widgets)){$widgets = $widgets;}else{$widgets = array();}
if(isset($top_section)){$top_section = $top_section;}else{$top_section = array();}
if(isset($bottom_section)){$bottom_section = $bottom_section;}else{$bottom_section = array();}
if(isset($flyout)){$flyout = $flyout;}else{$flyout = array();}
if(isset($mobile_settings)){$mobile_settings = $mobile_settings;}else{$mobile_settings = array();}
if(isset($search_bar)){$search_bar = $search_bar;}else{$search_bar = array();}

      $all_parameters = array(
                      'general'           => $general,
                      'menu_bar'          => $menu_bar,
                      'top_menu'          => $top_menu,
                      'megamenu_bar'      => $megamenu_bar,
                      'widgets'           => $widgets,
                      'top_section'       => $top_section,
                      'bottom_section'    => $bottom_section,
                      'flyout'            => $flyout,
                      'mobile_settings'   => $mobile_settings,
                      'search_bar'        => $search_bar
                      );

      $theme_title    = sanitize_text_field($theme_title);
      $theme_slug     = sanitize_text_field($theme_title);
 

if(isset($_POST['themeid']) && $_POST['themeid'] == ''){
	  $added_date     = date( 'Y-m-d H:m:s' );
      $modified_date  =  date( 'Y-m-d H:m:s' );
      $insert_data = $wpdb->insert($table_name, array(
                              'title'          => $theme_title,
                              'slug'           => $theme_slug,
                              'theme_settings' => serialize($all_parameters),
                              'created'        => $added_date,
                              'modified'       => $modified_date               
                  ),
                  array(
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s'
                ));

      $results = $wpdb->query( $insert_data );
      $_SESSION['apmm_success'] = __('Custom Theme Created Successfully.',APMM_PRO_TD);
 }else{
$modified_date = date( 'Y-m-d H:i:s:u' );

$update_data = $wpdb->update( 
	$table_name, 
	array(
              'title'          => $theme_title,
              'slug'           => $theme_slug,
              'theme_settings' => serialize($all_parameters),
              'created'        => $added_date,
              'modified'       => $modified_date    
        ),
    array('theme_id'=>$_POST['themeid']), 
	array(
        '%s',
        '%s',
        '%s',
        '%s',
        '%s'
    ),
    array('%d')
);
 $results = $wpdb->query( $update_data );
 $_SESSION['apmm_success'] = __('Custom Theme Updated Successfully.',APMM_PRO_TD);
 }
 wp_redirect(admin_url('admin.php?page=wpmm-theme-pro-settings'));
 exit();
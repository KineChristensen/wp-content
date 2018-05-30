<?php 
if (!defined( 'ABSPATH' ))
     exit;
     
add_action( 'admin_menu', 'xyz_wpf_menu' );

function xyz_wpf_menu()
{
	add_menu_page('XYZ Post Filter', 'WP Filter Posts', 'manage_options', 'xyz-wpf-filter-manage', 'xyz_wpf_manage_filter');

	// Add a submenu to the Dashboard:
	add_submenu_page('xyz-wpf-filter-manage', 'XYZ WP Filter Posts - Manage Filter', 'WP Filter Posts', 'manage_options', 'xyz-wpf-filter-manage', 'xyz_wpf_manage_filter');
	add_submenu_page('xyz-wpf-filter-manage', 'XYZ WP Filter Posts - Add New', 'Add New Filter', 'manage_options', 'xyz-wpf-filter-add-new' ,'xyz_wpf_add_new');
	add_submenu_page('xyz-wpf-filter-manage', 'XYZ WP Filter Posts - Settings', 'Settings', 'manage_options', 'xyz-wpf-settings' ,'xyz_wpf_settings');

}

function xyz_wpf_manage_filter()
{
	$formflag = 0;
	$_POST = stripslashes_deep($_POST);

	$_GET = stripslashes_deep($_GET);
	require( dirname( __FILE__ ) . '/header.php' );
	if(isset($_GET['action']) && $_GET['action']=='edit-filter' )
	{
		require( dirname( __FILE__ ) . '/edit-filter.php' );
		$formflag=1;
	}
	if($formflag==0)
	{
		require( dirname( __FILE__ ) . '/manage_wpf.php' );
	}
	require( dirname( __FILE__ ) . '/footer.php' );
}

function xyz_wpf_add_new()
{
	$_POST = stripslashes_deep($_POST);
	$_GET = stripslashes_deep($_GET);
	require( dirname( __FILE__ ) . '/header.php' );
	require( dirname( __FILE__ ) . '/add_new.php' );
	require( dirname( __FILE__ ) . '/footer.php' );
}

function xyz_wpf_settings()
{
	$_POST = stripslashes_deep($_POST);
	$_GET = stripslashes_deep($_GET);
	require( dirname( __FILE__ ) . '/header.php' );
	require( dirname( __FILE__ ) . '/settings.php' );
	require( dirname( __FILE__ ) . '/footer.php' );
}

		require( dirname( __FILE__ ) . '/shortcode.php' );
add_shortcode( 'xyz_wpf_shortcode' , 'xyz_wpf_shortcode' );


?>

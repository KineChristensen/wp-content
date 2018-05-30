<?php

///////////////////////////////

add_action('admin_menu', 'register_searchy_submenu_page');
function register_searchy_submenu_page() {
  add_submenu_page( 'options-general.php','Searchy Settings', 'Searchy', 'edit_theme_options', 'searchy-settings', 'searchy_settings_page_init' );
    add_action( 'admin_init', 'searchy_update_sy_custom_fields_list' );
  }

// if( !function_exists("searchy_update_sy_custom_fields_list") ) {
function searchy_update_sy_custom_fields_list() {
  register_setting( 'extra-post-info-settings', 'sy_custom_fields_list' );
  register_setting( 'extra-post-info-settings', 'sy_custom_fields_sorting' );
  register_setting( 'extra-post-info-settings', 'sy_active_frontend_pages' );
  
}
// }
function searchy_settings_page_init() {
  if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }
 ?>
 
  <div class="wrap" id="searchy_config_wrap">
    <h1>Searchy Plugin Options</h1>
    <style>
      #searchy_config_wrap   textarea  {  min-height: 200px; width: 250px;}
    </style>
    
   <form method="post" action="options.php" style="float: left;width: 70%">
    <?php settings_fields( 'extra-post-info-settings' ); ?>
    <?php do_settings_sections( 'extra-post-info-settings' ); ?>
    <h2>Search Filter Configuration: Filter & Sort by Custom Fields </h2>
    <table class="form-table">
      <tr valign="top">
        <th scope="row">Custom Fields in the Filter:
        <br><small>Enter custom field slug, One per line please.
        Elements will match if they do have a Custom field value equal to 1.</small></th>
        <td>
           <textarea name="sy_custom_fields_list"><?php  echo get_option( 'sy_custom_fields_list' ); ?></textarea>
        </td>
        
      </tr>
      
       <tr valign="top">
        <th scope="row">  Custom Fields in the Sorting Bar:
        <br><small> Enter custom field slug, One per line please.
        When sorting by custom field, Elements will be shown  only if they do have a value set for the custom field. Numeric Values Only accepted.
        </small></th>
        <td>
           <textarea name="sy_custom_fields_sorting"><?php  echo get_option( 'sy_custom_fields_sorting' ); ?></textarea>
        </td>
        
      </tr>
       
           <tr valign="top">
        <th scope="row">  Include Scripts & Widget only in Selected Pages
        <br><small> Enter page slug, One per line please.
        </small></th>
        <td>
           <textarea name="sy_active_frontend_pages"><?php  echo get_option( 'sy_active_frontend_pages' ); ?></textarea>
        </td>
        
      </tr>
    </table>
    <?php submit_button(); ?>
  </form>
  <div style="clear: both"></div>
  <hr>
    <h2>Setup Instructions</h2>
    
    <h3>Basic Example</h3>
    <p>Create a Wordpress Page. Put these shortcodes in the content:</p>
    <p>
    [searchy_filter]<br>
    [searchy_results]
    </p>
    <p>  These two shortcodes will be translated into the Search Filter and the Search Results block.</p>
  
  </div> 
<?php 
}
 

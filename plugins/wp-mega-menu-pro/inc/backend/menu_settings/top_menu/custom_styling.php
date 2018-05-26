<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<div class="wpmm_mega_settings">
  <div class="settings_content">
      <div class="settings_title"><h4><?php _e('Custom Styling Settings',APMM_PRO_TD);?></h4></div>
      <p class="description"><?php _e("Note: Set below custom styling for each menu items.This values setup will override the styling setup of available theme as well as custom theme.", APMM_PRO_TD); ?></p>
  	   <table class="widefat">
  	      <tr>
			<td class="wpmm_meta_table"><label for="enable_custom_styling"><?php _e("Enable All Custom Styling", APMM_PRO_TD) ?></label></td>
			  <td> 
			     <div class="wpmm-section">
				       <div class="wpmm-switch">
				          <input type='checkbox' class='wpmm_menu_settingss' id="enable_custom_styling" 
				          name='wpmm_settings[custom_styling][enable_custom_styling]' 
				          value='true' <?php echo checked($wpmmenu_item_meta['custom_styling']['enable_custom_styling'],'true', false ); ?>/>
				          <label for="enable_custom_styling"></label>
	                    </div>
                  </div>
                   <p class="description"><?php _e("Enable this button first in order to apply below styling.If not enable the below styling wont be applied.", APMM_PRO_TD); ?></p>
			  </td>
			</tr>	
			<tr>
			<td class="wpmm_meta_table"><label for="enable_menu_bg_color"><?php _e("Background Color", APMM_PRO_TD) ?></label></td>
			  <td> 
			     <div class="wpmm-section">
			       <div class="left-section-styling">
				       <div class="wpmm-switch">
				          <input type='checkbox' class='wpmm_menu_settingss' id="enable_menu_bg_color" 
				          name='wpmm_settings[custom_styling][enable_menu_bg_color]' 
				          value='true' <?php echo checked($wpmmenu_item_meta['custom_styling']['enable_menu_bg_color'],'true', false ); ?>/>
				          <label for="enable_menu_bg_color"></label>
	                    </div>
                    </div>
                    <div class="rt-section-styling">
			          <input type='text' id="menu_background_color" 
			          name='wpmm_settings[custom_styling][menu_background_color]' 
			value="<?php echo (isset($wpmmenu_item_meta['custom_styling']['menu_background_color']) && $wpmmenu_item_meta['custom_styling']['menu_background_color'] != '')?$wpmmenu_item_meta['custom_styling']['menu_background_color']:'';?>" class="apmm-color-picker"/>
			          </div>
                  </div>
                   <p class="description"><?php _e("Enable and Set Background color for this menu item.", APMM_PRO_TD); ?></p>
			  </td>
			</tr>	
			<tr>
			<td class="wpmm_meta_table"><label for="enable_menu_bg_hover_color"><?php _e("Background Hover Color", APMM_PRO_TD) ?></label></td>
			  <td> 
			     <div class="wpmm-section">
			       <div class="left-section-styling">
				       <div class="wpmm-switch">
				          <input type='checkbox' class='wpmm_menu_settingss' id="enable_menu_bg_hover_color" 
				          name='wpmm_settings[custom_styling][enable_menu_bg_hover_color]' 
				          value='true' <?php echo checked($wpmmenu_item_meta['custom_styling']['enable_menu_bg_hover_color'],'true', false ); ?>/>
				          <label for="enable_menu_bg_hover_color"></label>
	                    </div>
                    </div>
                    <div class="rt-section-styling">
			          <input type='text' id="menu_bg_hover_color" 
			          name='wpmm_settings[custom_styling][menu_bg_hover_color]' 
			         value="<?php echo (isset($wpmmenu_item_meta['custom_styling']['menu_bg_hover_color']) && $wpmmenu_item_meta['custom_styling']['menu_bg_hover_color'] != '')?$wpmmenu_item_meta['custom_styling']['menu_bg_hover_color']:'';?>" class="apmm-color-picker"/>
			          </div>
                  </div>
                   <p class="description"><?php _e("Enable and Set Background color for this menu item.", APMM_PRO_TD); ?></p>
			  </td>
			</tr>	
			<tr>
			<td class="wpmm_meta_table"><label for="enable_menu_font_color"><?php _e("Menu Font Color", APMM_PRO_TD) ?></label></td>
			  <td> 
			       <div class="wpmm-section">
			       <div class="left-section-styling">
				       <div class="wpmm-switch">
				          <input type='checkbox' class='wpmm_menu_settingss' id="enable_menu_font_color" 
				          name='wpmm_settings[custom_styling][enable_menu_font_color]' 
				          value='true' <?php echo checked($wpmmenu_item_meta['custom_styling']['enable_menu_font_color'],'true', false ); ?>/>
				          <label for="enable_menu_font_color"></label>
	                    </div>
                    </div>
                    <div class="rt-section-styling">
			          <input type='text' id="menu_font_color" 
			          name='wpmm_settings[custom_styling][menu_font_color]' value='<?php echo (isset($wpmmenu_item_meta['custom_styling']['menu_font_color']) && $wpmmenu_item_meta['custom_styling']['menu_font_color'] != '')?$wpmmenu_item_meta['custom_styling']['menu_font_color']:'';?>' class="apmm-color-picker"/>
			          </div>
                  </div>
                     <p class="description"><?php _e("Enable and Set font color for this menu item.", APMM_PRO_TD); ?></p>
			  </td>
			</tr>
		 <tr>
			<td class="wpmm_meta_table"><label for="enable_menu_font_hover_color"><?php _e("Menu Font Hover Color", APMM_PRO_TD) ?></label></td>
			  <td> 
			       <div class="wpmm-section">
			       <div class="left-section-styling">
				       <div class="wpmm-switch">
				          <input type='checkbox' class='wpmm_menu_settingss' id="enable_menu_font_hover_color" 
				          name='wpmm_settings[custom_styling][enable_menu_font_hover_color]' 
				          value='true' <?php echo checked($wpmmenu_item_meta['custom_styling']['enable_menu_font_hover_color'],'true', false ); ?>/>
				          <label for="enable_menu_font_hover_color"></label>
	                    </div>
                    </div>
                    <div class="rt-section-styling">
			          <input type='text' id="menu_font_hover_color" 
			          name='wpmm_settings[custom_styling][menu_font_hover_color]' value='<?php echo (isset($wpmmenu_item_meta['custom_styling']['menu_font_hover_color']) && $wpmmenu_item_meta['custom_styling']['menu_font_hover_color'] != '')?$wpmmenu_item_meta['custom_styling']['menu_font_hover_color']:'';?>' class="apmm-color-picker"/>
			          </div>
                  </div>
                     <p class="description"><?php _e("Enable and Set font hover color for this menu item.", APMM_PRO_TD); ?></p>
			  </td>
			</tr>
			 <tr>
			<td class="wpmm_meta_table"><label for="enable_submenu_megamenu_width"><?php _e("Sub Menu/Mega Menu Width", APMM_PRO_TD) ?></label></td>
			  <td> 
			       <div class="wpmm-section">
			       <div class="left-section-styling">
				       <div class="wpmm-switch">
				          <input type='checkbox' class='wpmm_menu_settingss' id="enable_submenu_megamenu_width" 
				          name='wpmm_settings[custom_styling][enable_submenu_megamenu_width]' 
				          value='true' <?php echo checked($wpmmenu_item_meta['custom_styling']['enable_submenu_megamenu_width'],'true', false ); ?>/>
				          <label for="enable_submenu_megamenu_width"></label>
	                    </div>
                    </div>
                    <div class="rt-section-styling">
			          <input type='text' id="submenu_megamenu_width" placeholder="800px or 60%" name='wpmm_settings[custom_styling][submenu_megamenu_width]' value='<?php echo (isset($wpmmenu_item_meta['custom_styling']['submenu_megamenu_width']) && $wpmmenu_item_meta['custom_styling']['submenu_megamenu_width'] != '')?$wpmmenu_item_meta['custom_styling']['submenu_megamenu_width']:'';?>'/>
			          </div>
                  </div>
                     <p class="description"><?php _e("Enable this option first and then set width in px or % for 
                     each menu item sub menu. Note: add px or % after number as per your requirement as shown on placeholder.", APMM_PRO_TD); ?></p>
			  </td>
			</tr>
		
		<tr>
			<td class="wpmm_meta_table"><label for="enable_submenu_bg_color"><?php _e("Sub Menu Background Color", APMM_PRO_TD) ?></label></td>
			  <td> 
			       <div class="wpmm-section">
			       <div class="left-section-styling">
				       <div class="wpmm-switch">
				          <input type='checkbox' class='wpmm_menu_settingss' id="enable_submenu_bg_color" 
				          name='wpmm_settings[custom_styling][enable_submenu_bg_color]' 
				          value='true' <?php echo checked($wpmmenu_item_meta['custom_styling']['enable_submenu_bg_color'],'true', false ); ?>/>
				          <label for="enable_submenu_bg_color"></label>
	                    </div>
                    </div>
                    <div class="rt-section-styling">
			          <input type='text' class="apmm-color-picker" id="submenu_bg_color" 
			          name='wpmm_settings[custom_styling][submenu_bg_color]' value='<?php echo (isset($wpmmenu_item_meta['custom_styling']['submenu_bg_color']) && $wpmmenu_item_meta['custom_styling']['submenu_bg_color'] != '')?$wpmmenu_item_meta['custom_styling']['submenu_bg_color']:'';?>'/>
			         </div>
                  </div>
                     <p class="description"><?php _e("Enable and Set Sub menu background color for each menu item.", APMM_PRO_TD); ?></p>
			  </td>
			</tr>
        <tr>
			<td class="wpmm_meta_table"><label for="enable_sub_heading_font_color"><?php _e("Sub Menu Header Font Color", APMM_PRO_TD) ?></label></td>
			  <td> 
			       <div class="wpmm-section">
			       <div class="left-section-styling">
				       <div class="wpmm-switch">
				          <input type='checkbox' class='wpmm_menu_settingss' id="enable_sub_heading_font_color" 
				          name='wpmm_settings[custom_styling][enable_sub_heading_font_color]' 
				          value='true' <?php echo checked($wpmmenu_item_meta['custom_styling']['enable_sub_heading_font_color'],'true', false ); ?>/>
				          <label for="enable_sub_heading_font_color"></label>
	                    </div>
                    </div>
                    <div class="rt-section-styling">
			          <input type='text' class="apmm-color-picker" id="sub_heading_font_color" 
			          name='wpmm_settings[custom_styling][sub_heading_font_color]' value='<?php echo (isset($wpmmenu_item_meta['custom_styling']['sub_heading_font_color']) && $wpmmenu_item_meta['custom_styling']['sub_heading_font_color'] != '')?$wpmmenu_item_meta['custom_styling']['sub_heading_font_color']:'';?>'/>
			         </div>
                  </div>
                     <p class="description"><?php _e("Enable and Set Sub menu widget header font color for each menu item.", APMM_PRO_TD); ?></p>
			  </td>
			</tr>

			  <tr>
			<td class="wpmm_meta_table"><label for="enable_sub_cfont_color"><?php _e("Sub Menu Content Color", APMM_PRO_TD) ?></label></td>
			  <td> 
			       <div class="wpmm-section">
			       <div class="left-section-styling">
				       <div class="wpmm-switch">
				          <input type='checkbox' class='wpmm_menu_settingss' id="enable_sub_cfont_color" 
				          name='wpmm_settings[custom_styling][enable_sub_cfont_color]' 
				          value='true' <?php echo checked($wpmmenu_item_meta['custom_styling']['enable_sub_cfont_color'],'true', false ); ?>/>
				          <label for="enable_sub_cfont_color"></label>
	                    </div>
                    </div>
                    <div class="rt-section-styling">
			          <input type='text' class="apmm-color-picker" id="submenu_cfont_color" 
			          name='wpmm_settings[custom_styling][submenu_cfont_color]' value='<?php echo (isset($wpmmenu_item_meta['custom_styling']['submenu_cfont_color']) && $wpmmenu_item_meta['custom_styling']['submenu_cfont_color'] != '')?$wpmmenu_item_meta['custom_styling']['submenu_cfont_color']:'';?>'/>
			         </div>
                  </div>
                     <p class="description"><?php _e("Enable and Set Sub menu Widget content font color for each menu item.", APMM_PRO_TD); ?></p>
			  </td>
			</tr>

			<tr>
			<td class="wpmm_meta_table"><label for="enable_menu_icon_color"><?php _e("Menu Icon Color", APMM_PRO_TD) ?></label></td>
			  <td> 
			       <div class="wpmm-section">
			       <div class="left-section-styling">
				       <div class="wpmm-switch">
				          <input type='checkbox' class='wpmm_menu_settingss' id="enable_menu_icon_color" 
				          name='wpmm_settings[custom_styling][enable_menu_icon_color]' 
				          value='true' <?php echo checked($wpmmenu_item_meta['custom_styling']['enable_menu_icon_color'],'true', false ); ?>/>
				          <label for="enable_menu_icon_color"></label>
	                    </div>
                    </div>
                    <div class="rt-section-styling">
			          <input type='text' id="menu_icon_color" 
			          name='wpmm_settings[custom_styling][menu_icon_color]' class="apmm-color-picker" value='<?php echo (isset($wpmmenu_item_meta['custom_styling']['menu_icon_color']) && $wpmmenu_item_meta['custom_styling']['menu_icon_color'] != '')?$wpmmenu_item_meta['custom_styling']['menu_icon_color']:'';?>'/>
			         </div>
                  </div>
                     <p class="description"><?php _e("Enable and Set color for available icons choosed such as for font awesome, genericons and dashicons.", APMM_PRO_TD); ?></p>
			  </td>
			</tr>

			<tr>
			<td class="wpmm_meta_table"><label for="enable_menu_icon_hover_color"><?php _e("Menu Icon Hover Color", APMM_PRO_TD) ?></label></td>
			  <td> 
			       <div class="wpmm-section">
			       <div class="left-section-styling">
				       <div class="wpmm-switch">
				          <input type='checkbox' class='wpmm_menu_settingss' id="enable_menu_icon_hover_color" 
				          name='wpmm_settings[custom_styling][enable_menu_icon_hover_color]' 
				          value='true' <?php echo checked($wpmmenu_item_meta['custom_styling']['enable_menu_icon_hover_color'],'true', false ); ?>/>
				          <label for="enable_menu_icon_hover_color"></label>
	                    </div>
                    </div>
                    <div class="rt-section-styling">
			          <input type='text' id="menu_icon_hover_color" 
			          name='wpmm_settings[custom_styling][menu_icon_hover_color]' class="apmm-color-picker" value='<?php echo (isset($wpmmenu_item_meta['custom_styling']['menu_icon_hover_color']) && $wpmmenu_item_meta['custom_styling']['menu_icon_hover_color'] != '')?$wpmmenu_item_meta['custom_styling']['menu_icon_hover_color']:'';?>'/>
			         </div>
                  </div>
                     <p class="description"><?php _e("Enable and Set hover color for available icons choosed such as for font awesome, genericons and dashicons.", APMM_PRO_TD); ?></p>
			  </td>
			</tr>


			</table>
  </div>


  <div class="settings_title"><h4><?php _e('Roles & Restriction Settings',APMM_PRO_TD);?></h4></div>
   <div class="wpmm_mega_settings">
   <p class="description"><?php _e('Choose roles or restriction from below to hide this menu item according to this settings.',APMM_PRO_TD);?></p>
   <div class="clear"></div>
<table class="widefat">
			<tr>
				<td class="wpmm_meta_table">
				    <?php _e("Menu Item Restriction", APMM_PRO_TD); ?>
				</td>
				<td>
				    <select name='wpmm_settings[restriction_roles][display_mode]' class="wpmm_display_mode">
				        <option value='show_to_all'<?php echo selected( $wpmmenu_item_meta['restriction_roles']['display_mode'], 'show_to_all', false );?>><?php _e("Show To All", APMM_PRO_TD); ?></option>
				        <option value='logged_in_users'<?php echo selected( $wpmmenu_item_meta['restriction_roles']['display_mode'], 'logged_in_users', false );?>><?php _e("Hide to Logged In Users", APMM_PRO_TD); ?></option>
				        <option value='logged_out_users' <?php echo selected( $wpmmenu_item_meta['restriction_roles']['display_mode'], 'logged_out_users', false );?>><?php _e("Hide to All Logged Out Users", APMM_PRO_TD); ?></option>
				        <option value='all_users' <?php echo selected( $wpmmenu_item_meta['restriction_roles']['display_mode'], 'all_users', false );?>><?php _e("All Users Except Administrator", APMM_PRO_TD); ?></option>
				        <option value='by_role' <?php echo selected( $wpmmenu_item_meta['restriction_roles']['display_mode'], 'by_role', false );?>><?php _e("By Role", APMM_PRO_TD); ?></option>
				    <select>
				    <p class="description"><?php _e('Choose restriction options from above select options to hide this menu item.',APMM_PRO_TD);?></p>
				 
				</td>

			</tr>
			<tr class="wpmm-by-role">
				<td class="wpmm_meta_table">
				    <?php _e("Choose User Roles", APMM_PRO_TD); ?>
				</td>
				<td>
				<?php global $wp_roles; 
				// echo "<pre>";
				// print_r($wpmmenu_item_meta['restriction_roles']['roles_type']);
				// echo "</pre>";
				?>

					<?php foreach ( $wp_roles->roles as $key=>$value ):
					$checked = isset($wpmmenu_item_meta['restriction_roles']['roles_type']) && in_array($key, $wpmmenu_item_meta['restriction_roles']['roles_type']) ? " checked" : "";
					 ?>
						<label for="roles_<?php echo $key; ?>">
					<input type="checkbox" id="roles_<?php echo $key; ?>" name="wpmm_settings[restriction_roles][roles_type][]"
					 value="<?php echo $key; ?>" <?php echo $checked;?>/><?php echo $value['name']; ?>
                     </label>
					 <br/><br/>
					
					<?php endforeach; ?>
				 
				</td>

			</tr>

       </table>
  </div>



</div>
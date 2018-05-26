 <?php defined('ABSPATH') or die("No script kiddies please!"); ?>
 <div class="settings_title"><h4><?php _e('Extra Settings',APMM_PRO_TD);?></h4></div>
  <div class="wpmm_mega_settings wpmm-extra">
       <table class="widefat">
	       <tr>
				<td class="wpmm_meta_table"><label for="enable_search_form"><?php _e("Choose Content Type", APMM_PRO_TD) ?></label></td>
				  <td> 
				  <select name="wpmm_settings[custom_extra_settings][content_type]" id="wpmm_content_type">
				  	<option value="none" <?php echo selected( $wpmmenu_item_meta['custom_extra_settings']['content_type'], 'none', false );?>>Default</option>
				  	<option value="description_field" <?php echo selected( $wpmmenu_item_meta['custom_extra_settings']['content_type'], 'description_field', false );?>><?php _e('Simple Description Field',APMM_PRO_TD);?></option>
				  	<option value="shortcodes" <?php echo selected( $wpmmenu_item_meta['custom_extra_settings']['content_type'], 'shortcodes', false );?>><?php _e('Shortcodes',APMM_PRO_TD);?></option>
				  </select>
				  <p class="description"><?php _e('Note: Choose content type to display for this submenu.',APMM_PRO_TD);?></p>
				  </td>
				</tr>


			<tr class="toggle_description">
			  <td class="wpmm_meta_table"><label><?php _e("Custom Content", APMM_PRO_TD) ?></label></td>
			  <td> 
			     <textarea name='wpmm_settings[custom_extra_settings][content_description]' cols="40" rows="2" placeholder="<?php _e('Fill Simple Description here.',APMM_PRO_TD);?>"><?php echo (isset( $wpmmenu_item_meta['custom_extra_settings']['content_description']) && $wpmmenu_item_meta['custom_extra_settings']['content_description'] != '')?$wpmmenu_item_meta['custom_extra_settings']['content_description']:'';?>
			     </textarea>
			  </td>
			</tr>

			<tr class="toggle_shortcodes">
				<td class="wpmm_meta_table"><label><?php _e("Custom Shortcode", APMM_PRO_TD) ?></label></td>
				<td>
				<textarea name='wpmm_settings[custom_extra_settings][shortcodes]' cols="40" rows="2" placeholder="<?php _e('Place Shortcode here.',APMM_PRO_TD);?>"><?php echo (isset( $wpmmenu_item_meta['custom_extra_settings']['shortcodes']) && $wpmmenu_item_meta['custom_extra_settings']['shortcodes'] != '')?$wpmmenu_item_meta['custom_extra_settings']['shortcodes']:'';?>
			     </textarea>
			   </td>
			</tr>

			</table>
  </div>
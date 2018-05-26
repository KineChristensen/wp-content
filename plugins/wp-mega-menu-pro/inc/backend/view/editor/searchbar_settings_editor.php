<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php
if(isset($_GET['action']) && $_GET['action'] == 'edit_theme'){
if(isset($_GET['theme_id'])){
    if(isset($theme_settings['search_bar'])){
			$search_font_size     		   = (isset($theme_settings['search_bar']['font_size'])?$theme_settings['search_bar']['font_size']:'');
			$search_width          		   = (isset($theme_settings['search_bar']['width'])?$theme_settings['search_bar']['width']:'');
			$search_text_color     		   = (isset($theme_settings['search_bar']['text_color'])?$theme_settings['search_bar']['text_color']:'');
			$search_bg_color               = (isset($theme_settings['search_bar']['bg_color'])?$theme_settings['search_bar']['bg_color']:'');
			$search_text_placholder_color  = (isset($theme_settings['search_bar']['text_placholder_color'])?$theme_settings['search_bar']['text_placholder_color']:'');
			$search_icon_color 			   = (isset($theme_settings['search_bar']['icon_color'])?$theme_settings['search_bar']['icon_color']:'');
	        $search_button_bg_color        = (isset($theme_settings['search_bar']['search_button_bg_color'])?$theme_settings['search_bar']['search_button_bg_color']:'');
	        $search_button_bg_hovercolor   = (isset($theme_settings['search_bar']['search_button_bg_hovercolor'])?$theme_settings['search_bar']['search_button_bg_hovercolor']:'');
	        $search_button_font_color      = (isset($theme_settings['search_bar']['search_button_font_color'])?$theme_settings['search_bar']['search_button_font_color']:'');
	        $search_button_font_hovercolor = (isset($theme_settings['search_bar']['search_button_font_hovercolor'])?$theme_settings['search_bar']['search_button_font_hovercolor']:'');
	        $font_popup_family             = (isset($theme_settings['search_bar']['font_popup_family'])?$theme_settings['search_bar']['font_popup_family']:'');
	        $search_transform              =(isset($theme_settings['search_bar']['transform'])?$theme_settings['search_bar']['transform']:'');
	}
  }
}

?>
              <!----------------Search Bar settings  -------------------------->
		        <div class="apmm-slideToggle" id="searchbar_settings"  style="cursor:pointer;">
		          <div class="title_toggle"><?php _e('Search Bar Settings',APMM_PRO_TD);?></div>
		        </div>
		        <div class="apmm-Togglebox apmm-slideTogglebox_searchbar_settings" style="display: none;">

					<table cellspacing="0" class="widefat apmm_create_seciton">
						<tbody>
						    <tr>
								<td>
									<label><?php _e('Font Size',APMM_PRO_TD);?></label>
								</td>
								<td>
									<input type="text" placeholder="E.g., 12px" name="apmm_theme[search_bar][font_size]" value="<?php echo isset( $search_font_size ) ? esc_attr($search_font_size) : ''; ?>" />
								</td>
							</tr>
						    <tr>
						  		<td>
									<label><?php _e('Width',APMM_PRO_TD);?></label>
								</td>
								<td>
									<input type="text" value="<?php echo isset( $search_width ) ? esc_attr($search_width) : ''; ?>" placeholder="E.g., 50%" 
									class="apmm_search_width" name="apmm_theme[search_bar][width]" />
								</td>
								                         
							</tr>
							<tr>
								<td>
									<label><?php _e('Text Font Color',APMM_PRO_TD);?></label>
								</td>
								<td>
									<input type="text" name="apmm_theme[search_bar][text_color]" 
								     class="apmega-menu_bar_padding apmm-color-picker" value="<?php echo isset( $search_text_color ) ? esc_attr($search_text_color) : ''; ?>">
							 
								</td>
							</tr>
							<tr>
								<td>
									<label><?php _e('Background Color',APMM_PRO_TD);?></label>
								</td>
								<td>
									<input type="text" name="apmm_theme[search_bar][bg_color]" 
								     class="apmega-menu_bar_padding apmm-color-picker" value="<?php echo isset( $search_bg_color ) ? esc_attr($search_bg_color) : ''; ?>">
							 
								</td>
							</tr>
							<tr>
								<td>
									<label><?php _e('Text Placeholder Color',APMM_PRO_TD);?></label>
								</td>
								<td>
									<input type="text" name="apmm_theme[search_bar][text_placholder_color]" 
								     class="apmega-menu_bar_padding apmm-color-picker" value="<?php echo isset( $search_text_placholder_color ) ? esc_attr($search_text_placholder_color) : ''; ?>" />
							 
								</td>
							</tr>
							<tr>
								<td>
									<label><?php _e('Icon Color',APMM_PRO_TD);?></label>
								</td>
								<td>
									<input type="text" name="apmm_theme[search_bar][icon_color]" 
								     class="apmega-menu_bar_padding apmm-color-picker" value="<?php echo isset( $search_icon_color) ? esc_attr($search_icon_color) : ''; ?>" />
							 
								</td>
							</tr>
                           
							<tr>
								<td>
									<label><?php _e('Button Background Color',APMM_PRO_TD);?></label>
									<p class="description"><?php _e('Set Background color for popup search button.',APMM_PRO_TD);?></p>
								</td>
								<td>
									<input type="text" name="apmm_theme[search_bar][search_button_bg_color]" 
								     class="apmega-menu_bar_padding apmm-color-picker" value="<?php echo isset(  $search_button_bg_color) ? esc_attr( $search_button_bg_color) : ''; ?>" />
							 
								</td>
							</tr>
                           <tr>
                           	<tr>
								<td>
									<label><?php _e('Button Background Hover Color',APMM_PRO_TD);?></label>
									<p class="description"><?php _e('Set Background hover color for popup search button.',APMM_PRO_TD);?></p>
								</td>
								<td>
									<input type="text" name="apmm_theme[search_bar][search_button_bg_hovercolor]" 
								     class="apmega-menu_bar_padding apmm-color-picker" value="<?php echo isset(  $search_button_bg_hovercolor) ? esc_attr( $search_button_bg_hovercolor) : ''; ?>" />
							 
								</td>
							</tr>
							<tr>
								<td>
									<label><?php _e('Button Font Color',APMM_PRO_TD);?></label>
									<p class="description"><?php _e('Set Font color for popup search button.',APMM_PRO_TD);?></p>
								</td>
								<td>
									<input type="text" name="apmm_theme[search_bar][search_button_font_color]" 
								     class="apmega-menu_bar_padding apmm-color-picker" value="<?php echo isset( $search_button_font_color ) ? esc_attr($search_button_font_color) : ''; ?>">
							 
								</td>
							</tr>
							<tr>
								<td>
									<label><?php _e('Button Font Hover Color',APMM_PRO_TD);?></label>
									<p class="description"><?php _e('Set Font hover color for popup search button.',APMM_PRO_TD);?></p>
								</td>
								<td>
									<input type="text" name="apmm_theme[search_bar][search_button_font_hovercolor]" 
								     class="apmega-menu_bar_padding apmm-color-picker" value="<?php echo isset( $search_button_font_hovercolor ) ? esc_attr($search_button_font_hovercolor) : ''; ?>">
							 
								</td>
							</tr>
                           <tr>
								<td>
									<label><?php _e('Font Family',APMM_PRO_TD);?></label>
								</td>
								<td>
							      <select name="apmm_theme[search_bar][font_popup_family]" class="apmm_font_family">
									  <?php  $apmm_fonts = get_option('apmm_font_family');
									   if(isset($apmm_fonts) && !empty($apmm_fonts)){
									  	foreach ($apmm_fonts as $value) {
									  		?>
									  <option value="<?php echo $value;?>" <?php if(isset($font_popup_family)) if($value == $font_popup_family) echo "selected";?>><?php echo $value;?></option>
									   <?php } 
									   }?>
									</select>
							</td>
							</tr>
							 <tr>
								<td>
									<label><?php _e('Transform',APMM_PRO_TD);?></label>
								</td>
								<td>
							    <select name="apmm_theme[search_bar][transform]" 
										class="apmm_transform">
										   <option value="normal" <?php echo (isset($search_transform) && $search_transform == 'normal')?'selected="selected"':'';?>><?php _e('Normal',APMM_PRO_TD);?></option>
										   <option value="capitalize" <?php echo (isset($search_transform) && $search_transform == 'capitalize')?'selected="selected"':'';?>><?php _e('Capitalize',APMM_PRO_TD);?></option>
										   <option value="uppercase" <?php echo (isset($search_transform) && $search_transform == 'uppercase')?'selected="selected"':'';?>><?php _e('Uppercase',APMM_PRO_TD);?></option>
										   <option value="lowercase" <?php echo (isset($search_transform) && $search_transform == 'lowercase')?'selected="selected"':'';?>><?php _e('Lowercase',APMM_PRO_TD);?></option>
								</select>
							</td>
							</tr>
							
							
							
					
						</tbody>
						</table>
		             </div>
                <!----------------Search Bar settings  End-------------------------->
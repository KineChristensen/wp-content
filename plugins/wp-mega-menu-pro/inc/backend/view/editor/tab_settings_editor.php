<?php defined('ABSPATH') or die("No script kiddies please!");
if(isset($_GET['action']) && $_GET['action'] == 'edit_theme'){
if(isset($_GET['theme_id'])){
    if(isset($theme_settings['horizontal_tabbed'])){
			$htab_bgcolor = (isset($theme_settings['horizontal_tabbed']['bgcolor'])?$theme_settings['horizontal_tabbed']['bgcolor']:'');
			$htab_active_color = (isset($theme_settings['horizontal_tabbed']['bg_active_color'])?$theme_settings['horizontal_tabbed']['bg_active_color']:'');
			$htab_fontcolor = (isset($theme_settings['horizontal_tabbed']['font_color'])?$theme_settings['horizontal_tabbed']['font_color']:'');
			$htab_fonthcolor = (isset($theme_settings['horizontal_tabbed']['font_hcolor'])?$theme_settings['horizontal_tabbed']['font_hcolor']:'');
			$htab_content_bgcolor = (isset($theme_settings['horizontal_tabbed']['content_bgcolor'])?$theme_settings['horizontal_tabbed']['content_bgcolor']:'');
			$htab_content_fcolor = (isset($theme_settings['horizontal_tabbed']['content_fcolor'])?$theme_settings['horizontal_tabbed']['content_fcolor']:'');
             //vertical
			$vtab_bgcolor = (isset($theme_settings['vertical_tabbed']['bgcolor'])?$theme_settings['vertical_tabbed']['bgcolor']:'');
			$vtab_bghcolor = (isset($theme_settings['vertical_tabbed']['bghcolor'])?$theme_settings['vertical_tabbed']['bghcolor']:'');
			$vtab_activebgcolor = (isset($theme_settings['vertical_tabbed']['bg_active_color'])?$theme_settings['vertical_tabbed']['bg_active_color']:'');
			$font_color = (isset($theme_settings['vertical_tabbed']['font_color'])?$theme_settings['vertical_tabbed']['font_color']:'');
			$font_hover_color = (isset($theme_settings['vertical_tabbed']['font_hover_color'])?$theme_settings['vertical_tabbed']['font_hover_color']:'');
			$tab_width = (isset($theme_settings['horizontal_tabbed']['tab_width'])?$theme_settings['horizontal_tabbed']['tab_width']:'');
			$tab_layout = (isset($theme_settings['horizontal_tabbed']['tab_layout']) && $theme_settings['horizontal_tabbed']['tab_layout'] != '')?$theme_settings['horizontal_tabbed']['tab_layout']:'skew_layout';

	}
  }
}
?>
<div class="apmm-slideToggle" id="tab_toggle_settings"  style="cursor:pointer;">
<div class="title_toggle"><?php _e('Tabbed Settings',APMM_PRO_TD);?></div>
</div>
<div class="apmm-Togglebox apmm-slideTogglebox_tab_toggle_settings" style="display: none;">
<table cellspacing="0" class="widefat apmm_create_seciton">
<tbody>
	 <tr>
		<td>
			<label><?php _e('Content Background Color',APMM_PRO_TD);?></label>
		</td>
		<td>
			<input type="text" name="apmm_theme[horizontal_tabbed][content_bgcolor]" class="apmm-color-picker" value="<?php echo isset( $htab_content_bgcolor ) ? esc_attr($htab_content_bgcolor) : ''; ?>" />
		</td>
	</tr>
	 <tr>
		<td>
			<label><?php _e('Content Background Color',APMM_PRO_TD);?></label>
		</td>
		<td>
			<input type="text" name="apmm_theme[horizontal_tabbed][content_fcolor]" class="apmm-color-picker" value="<?php echo isset( $htab_content_fcolor ) ? esc_attr($htab_content_fcolor) : ''; ?>" />
		</td>
	</tr>
</tbody>
</table>

<h5 class="tabbed-label-design">Horizontal Tabbed Design</h5>
<table cellspacing="0" class="widefat apmm_create_seciton">
<tbody>
    <tr>
		<td>
			<label><?php _e('Background Label Color',APMM_PRO_TD);?></label>
		</td>
		<td>
			<input type="text" name="apmm_theme[horizontal_tabbed][bgcolor]" data-alpha="true" class="apmm-color-picker" value="<?php echo isset( $htab_bgcolor ) ? esc_attr($htab_bgcolor) : ''; ?>" />
		</td>
	 </tr>
	 <tr>
		<td>
			<label><?php _e('Background Active/Hover Color',APMM_PRO_TD);?></label>
		</td>
		<td>
			<input type="text" name="apmm_theme[horizontal_tabbed][bg_active_color]" data-alpha="true" class="apmm-color-picker" value="<?php echo isset( $htab_active_color ) ? esc_attr($htab_active_color) : ''; ?>" />
		</td>
	</tr>
	 <tr>
		<td>
			<label><?php _e('Font Color',APMM_PRO_TD);?></label>
		</td>
		<td>
			<input type="text" name="apmm_theme[horizontal_tabbed][font_color]" class="apmm-color-picker" value="<?php echo isset( $htab_fontcolor ) ? esc_attr($htab_fontcolor) : ''; ?>" />
		</td>
	</tr>
	 <tr>
		<td>
			<label><?php _e('Font Hover Color',APMM_PRO_TD);?></label>
		</td>
		<td>
			<input type="text" name="apmm_theme[horizontal_tabbed][font_hcolor]" class="apmm-color-picker" value="<?php echo isset( $htab_fonthcolor ) ? esc_attr($htab_fonthcolor) : ''; ?>" />
		</td>
	</tr>
	<tr>
		<td>
			<label><?php _e('Tab Label Width',APMM_PRO_TD);?></label>
		</td>
		<td>
			<input type="number" name="apmm_theme[horizontal_tabbed][tab_width]" value="<?php echo isset( $tab_width ) ? esc_attr($tab_width) : ''; ?>" />
		  <em>in px</em>
		</td>
	</tr>
		 <tr>
		<td>
			<label><?php _e('Tab Layout Style',APMM_PRO_TD);?></label>
		</td>
		<td>
			<select name="apmm_theme[horizontal_tabbed][tab_layout]">
				<option value="skew_layout" <?php if($tab_layout == "skew_layout") echo "selected='selected'";?>>Skew Layout</option>
				<option value="flat_layout" <?php if($tab_layout == "flat_layout") echo "selected='selected'";?>>Flat Layout</option>
			</select>
		</td>
	</tr>
</tbody>
</table>
<h5 class="tabbed-label-design">Vertical Tabbed Design</h5>
<table cellspacing="0" class="widefat apmm_create_seciton">
<tbody>
    <tr>
		<td>
			<label><?php _e('Background Label Color',APMM_PRO_TD);?></label>
		</td>
		<td>
			<input type="text" class="apmm-color-picker" data-alpha="true" name="apmm_theme[vertical_tabbed][bgcolor]" value="<?php echo isset( $vtab_bgcolor ) ? esc_attr($vtab_bgcolor) : ''; ?>" />
		</td>
	</tr>
	 <tr>
		<td>
			<label><?php _e('Background Active Color',APMM_PRO_TD);?></label>
		</td>
		<td>
			<input type="text" class="apmm-color-picker" data-alpha="true" name="apmm_theme[vertical_tabbed][bghcolor]" value="<?php echo isset( $vtab_bghcolor ) ? esc_attr($vtab_bghcolor) : ''; ?>" />
		</td>
	</tr>
	 <tr>
		<td>
			<label><?php _e('Active Border Color',APMM_PRO_TD);?></label>
		</td>
		<td>
			<input type="text" class="apmm-color-picker" data-alpha="true" name="apmm_theme[vertical_tabbed][bg_active_color]" value="<?php echo isset( $vtab_activebgcolor ) ? esc_attr($vtab_activebgcolor) : ''; ?>" />
		</td>
	</tr>

	 <tr>
		<td>
			<label><?php _e('Font Color',APMM_PRO_TD);?></label>
		</td>
		<td>
			<input type="text" class="apmm-color-picker" name="apmm_theme[vertical_tabbed][font_color]" value="<?php echo isset( $font_color ) ? esc_attr($font_color) : ''; ?>" />
		</td>
	</tr>
	 <tr>
		<td>
			<label><?php _e('Font Hover Color',APMM_PRO_TD);?></label>
		</td>
		<td>
			<input type="text" class="apmm-color-picker" name="apmm_theme[vertical_tabbed][font_hover_color]" value="<?php echo isset( $font_hover_color ) ? esc_attr($font_hover_color) : ''; ?>" />
		</td>
	</tr>
</tbody>
</table>

</div>
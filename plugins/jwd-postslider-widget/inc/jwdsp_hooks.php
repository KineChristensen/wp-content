<?php
/********************************
 * JWD Show Posts Slider :: Functions & Hooks
 ********************************/
/********************************
 * Blocking direct access to this file 
 ********************************/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/********************************
 * Post Type Selector Hook
 ********************************/
if ( ! function_exists( 'jwdsp_posttype_selector' ) ) { 
	function jwdsp_posttype_selector($args){
		/* Security Check */
		if(!is_admin()){ return; }
		/* Ok, Now we can go on. */
		if( isset($args['id']) && !empty($args['id'])){ $id = $args['id']; } else { $id = '';}
		if( isset($args['name']) && !empty($args['name'])){ $name = $args['name']; } else { $name = '';}
		if( isset($args['label']) && !empty($args['label'])){ $label = $args['label']; } else { $label = __('Post Type','jwdsp');}
		if( isset($args['selected']) && !empty($args['selected'])){ $selected = $args['selected']; } else { $selected = '';}
		if( isset($args['class']) && !empty($args['class'])){ $class = 'class="'.$args['class'].'"'; } else { $class = '';}
		if( isset($args['style']) && !empty($args['style'])){ $style = 'style="'.$args['style'].'"'; } else { $style = '';}
		if( isset($args['output_type']) && !empty($args['output_type'])){ $output_type = $args['output_type']; } else { $output_type = 'names';}
		if( isset($args['allowed_posts']) && !empty($args['allowed_posts'])){ $accepted = $args['allowed_posts']; } else { $accepted = array('post');}
		if( isset($args['description']) && !empty($args['description'])){ $description = $args['description']; } else { $description = '';}
		$all_post_types = get_post_types( array( 'public' => true ), $output_type );
		$output = '<div class="jwdsp_tab-row">';
		$output .= '<label for="'.$id.'"> '.$label.' </label><br />';
		$output .= '<select id="'.$id.'" name="'.$name.'" '.$class.' '.$style.'>';
		foreach ($all_post_types as $post_type) { 
			if( !empty($selected) && $post_type == $selected ) { $current = 'selected="selected"'; } else { $current = '';}
			if( $post_type == 'post'){ $post_type_name = $post_type .' (default)'; } else { $post_type_name = $post_type; }
			if( in_array( $post_type, $accepted )){ $output .= '<option '.$current.' value="'. $post_type .'">'. $post_type_name . '</option>'; }
		} 
		$output .= '</select>';
		if($description){	$output .='<br /><small>'.$description.'</small>';}
		$output .= '</div>' ;
		return $output;
	}
}
/********************************
 * Taxonomy Selector Hook
 ********************************/
if ( ! function_exists( 'jwdsp_taxonomy_selector' ) ) { 
	function jwdsp_taxonomy_selector($args){
		/* Security Check */
		if(!is_admin()){ return; }
		/* Ok, Now we can go on. */
		if( isset($args['id']) && !empty($args['id'])){ $id = $args['id']; } else { $id = '';}
		if( isset($args['name']) && !empty($args['name'])){ $name = $args['name']; } else { $name = '';}
		if( isset($args['post_type']) && !empty($args['post_type'])){ $post_type = $args['post_type']; } else { $post_type = 'post';}
		if( isset($args['label']) && !empty($args['label'])){ $label = $args['label']; } else { $label = __('Taxonomy','jwdsp');}
		if( isset($args['selected']) && !empty($args['selected'])){ $selected = $args['selected']; } else { $selected = '';}
		if( isset($args['class']) && !empty($args['class'])){ $class = 'class="'.$args['class'].'"'; } else { $class = '';}
		if( isset($args['style']) && !empty($args['style'])){ $style = 'style="'.$args['style'].'"'; } else { $style = '';}
		if( isset($args['output_type']) && !empty($args['output_type'])){ $output_type = $args['output_type']; } else { $output_type = 'objects';}
		if( isset($args['exclude']) && !empty($args['exclude'])){ $exclude = $args['exclude']; } else { $exclude = '';}
		$taxonomies = get_object_taxonomies( $post_type, $output_type );
		$output = '<div class="jwdsp_tab-row">';
		$output .= '<label for="'.$id.'"> '.$label.' <span class="jwdsp_loader jwdsp_loader-tax"></span></label><br />';
		$output .= '<select id="'.$id.'" name="'.$name.'" '.$class.' '.$style.'>' . jwdsp_getTaxsList($taxonomies, $selected ) . '</select>';
		$output .= '</div>' ;
		return $output;
	}
}
/********************************
 * Terms Selector Hook
 ********************************/
if ( ! function_exists( 'jwdsp_term_selector' ) ) { 
	function jwdsp_term_selector($args){
		/* Security Check */
		if(!is_admin()){ return; }
		/* Ok, Now we can go on. */
		if( isset($args['id']) && !empty($args['id'])){ $id = $args['id']; } else { $id = '';}
		if( isset($args['label']) && !empty($args['label'])){ $label = $args['label']; } else { $label = __('Term','jwdsp');}
		if( isset($args['name']) && !empty($args['name'])){ $name = $args['name']; } else { $name = '';}
		if( isset($args['class']) && !empty($args['class'])){ $class = 'class="'.$args['class'].'"'; } else { $class = '';}
		if( isset($args['style']) && !empty($args['style'])){ $style = 'style="'.$args['style'].'"'; } else { $style = '';}
		if( isset($args['taxonomy']) && !empty($args['taxonomy'])){ $taxonomy = $args['taxonomy']; } else { $taxonomy = '';}
		if( isset($args['selected']) && !empty($args['selected'])){ $selected = $args['selected']; } else { $selected = '';}
		$output = '<div class="jwdsp_tab-row">';
		$output .= '<label for="'.$id.'"> '.$label.' <span class="jwdsp_loader jwdsp_loader-term"></span></label><br />';
		$output .= '<select id="'.$id.'" name="'.$name.'" '.$class.' '.$style.'>' . jwdsp_getTermsList($taxonomy, $selected) . '</select>';
		$output .= '</div>' ;
		return $output;
	}
}
/********************************
 * Order by Date Selector Hook
 ********************************/
if ( ! function_exists( 'jwdsp_date_order_field' ) ) { 
	function jwdsp_date_order_field($args){
		/* Security Check */
		if(!is_admin()){ return; }
		/* Ok, Now we can go on. */
		$DESC_current = $ASC_current = '';
		if( isset($args['id']) && !empty($args['id'])){ $id = $args['id']; } else { $id = '';}
		if( isset($args['label']) && !empty($args['label'])){ $label = $args['label']; } else { $label = __('Order by date:','jwdsp');}
		if( isset($args['name']) && !empty($args['name'])){ $name = $args['name']; } else { $name = '';}
		if( isset($args['class']) && !empty($args['class'])){ $class = 'class="'.$args['class'].'"'; } else { $class = '';}
		if( isset($args['style']) && !empty($args['style'])){ $style = 'style="'.$args['style'].'"'; } else { $style = '';}
		if( isset($args['selected']) && !empty($args['selected'])){ $selected = $args['selected']; } else { $selected = '';}
		if( !empty($selected) && 'DESC' == $selected ) { $DESC_current = 'selected="selected"'; } else { $ASC_current = 'selected="selected"';}
		$output = '<div class="jwdsp_tab-row"><label for="'.$id.'"> '.$label.' </label> ';
		$output .= '<select id="'.$id.'" name="'.$name.'" '.$class.' '.$style.'>';
		$output .= '<option '.$DESC_current.' value="DESC">'.__('Descending','jwdsp').'</option>';	
		$output .= '<option '.$ASC_current.' value="ASC">'.__('Ascending','jwdsp').'</option>';	
		$output .= '</select></div>' ;
		return $output;
	}
}
/********************************
 * Text Field Hook
 ********************************/
if ( ! function_exists( 'jwdsp_text_field' ) ) { 
	function jwdsp_text_field($args){
		/* Security Check */
		if(!is_admin()){ return; }
		/* Ok, Now we can go on. */
		if( isset($args['id']) && !empty($args['id'])){ $id = $args['id']; } else { $id = '';}
		if( isset($args['label']) && !empty($args['label'])){ $label = $args['label']; } else { $label = __('Label name here','jwdsp');}
		if( isset($args['name']) && !empty($args['name'])){ $name = $args['name']; } else { $name = '';}
		if( isset($args['type']) && !empty($args['type'])){ $type = $args['type']; } else { $type = 'text';}
		if( isset($args['class']) && !empty($args['class'])){ $class = 'class="widefat '.$args['class'].'"'; } else { $class = 'class="widefat"';}
		if( isset($args['style']) && !empty($args['style'])){ $style = 'style="'.$args['style'].'"'; } else { $style = '';}
		if( isset($args['label_style']) && !empty($args['label_style'])){ $label_style = 'style="'.$args['label_style'].'"'; } else { $label_style = '';}
		if( isset($args['value']) && !empty($args['value'])){ $value = $args['value']; } else { $value = '';}
		if( isset($args['description']) && !empty($args['description'])){ $description = $args['description']; } else { $description = '';}
		if( isset($args['disabled']) && !empty($args['disabled']) && $args['disabled'] == 'yes'){ $disabled = 'disabled'; } else { $disabled = '';}

		if( isset($args['unit']) && !empty($args['unit'])){ $unit = $args['unit']; } else { $unit = '';}
		if( isset($args['placeholder']) && !empty($args['placeholder'])){ $placeholder = 'placeholder="'.$args['placeholder'].'"'; } else { $placeholder = ''; }
		if( isset($args['loader']) && $args['loader'] == true){ $loader = '<span class="jwdsp_loader jwdsp_loader-tax"></span>'; } else { $loader = '';}
		$output = '<div class="jwdsp_tab-row">';
		switch($type){
			case 'slider':
				$output .= '<label '.$label_style.' for="'.$id.'"> '.$label.' </label>';
				$output .= '<div class="jwdsp_slider-bg" data-jwdsp_unit="'.$unit.'" '.$style.'><div class="jwdsp_slider-handle ui-slider-handle"></div></div>';
				$output .= '<input id="'.$id.'" name="'.$name.'" '.$class.' value="'.$value.'" '.$disabled.' type="text" '.$placeholder.' />';
			break;
			default:
				$output .= '<label '.$label_style.' for="'.$id.'"> ' . $label . $loader . ' </label>';
				$output .= '<input id="'.$id.'" name="'.$name.'" '.$class.' '.$style.' value="'.$value.'" '.$disabled.' type="'.$type.'" '.$placeholder.' /> ';
		}
		if(!empty($description)){ $output .= '<br /><small>'.$description.'</small>'; }
		$output .= '</div>' ;
		return $output;
	}
}
/********************************
 * Radio Button Hook
 ********************************/
if ( ! function_exists( 'jwdsp_radio_button' ) ) { 
	function jwdsp_radio_button($args){
		/* Security Check */
		if(!is_admin()){ return; }
		/* Ok, Now we can go on. */
		if( isset($args['id']) && !empty($args['id'])){ $id = $args['id']; } else { $id = '';}
		if( isset($args['label']) && !empty($args['label'])){ $label = $args['label']; } else { $label = __('Option name here','jwdsp'); }
		if( isset($args['name']) && !empty($args['name'])){ $name = $args['name']; } else { $name = '';}
		if( isset($args['value']) && !empty($args['value'])){ $value = $args['value']; } else { $value = '';}
		if( isset($args['checked']) && !empty($args['checked'])){ $checked = $args['checked']; } else { $checked = '';}
		if( isset($args['style']) && !empty($args['style'])){ $style = 'style="' . $args['style'] . '"'; } else { $style = '';}
		if( !empty($checked) && $value == $checked ) { $current = 'checked="checked"'; } else { $current = '';}
		$output = '<input '.$current.' id="'.$id.'-'.$value.'" name="'.$name.'" value="'.$value.'" type="radio" />';
		$output .= '<label for="'.$id.'-'.$value.'"> '.$label.' </label>';
		return $output;
	}
}
/********************************
 * Checkbox Button Hook
 /********************************/
if ( ! function_exists( 'jwdsp_checkbox_button' ) ) { 
	function jwdsp_checkbox_button($args){
		/* Security Check */
		if(!is_admin()){ return; }
		/* Ok, Now we can go on. */
		if( isset($args['id']) && !empty($args['id'])){ $id = $args['id']; } else { $id = '';}
		if( isset($args['label']) && !empty($args['label'])){ $label = $args['label']; } else { $label = __('Option name here','jwdsp'); }
		if( isset($args['name']) && !empty($args['name'])){ $name = $args['name']; } else { $name = '';}
		if( isset($args['style']) && !empty($args['style'])){ $style = 'style="' . $args['style'] . '"'; } else { $style = '';}
		if( isset($args['checked']) && !empty($args['checked'])){ $checked = $args['checked']; } else { $checked = '';}
		if( !empty($checked) && 'true' == $checked ) { $current = 'checked="checked"'; } else { $current = '';}
		$output = '<div class="jwdsp_switch-field" '.$style.'>';
		$output .= '<input '.$current.' id="'.$id.'" name="'.$name.'" value="true" type="checkbox" />';
		$output .= '<label for="'.$id.'" class="jwdsp_checkbox">'.$label.'</label>';
		$output .= '</div>' ;
		return $output;
	}
}
/********************************
 * Get See More Link Hook
 ********************************/
if ( ! function_exists( 'jwdsp_get_seemore_link' ) ) { 
	function jwdsp_get_seemore_link($args){
		if( isset($args['post_type']) && !empty($args['post_type'])){ $post_type = $args['post_type']; } else { $post_type = '';}
		if( isset($args['tax_term']) && !empty($args['tax_term'])){ $tax_term = $args['tax_term']; } else { $tax_term = '';}
		if( isset($args['taxonomy']) && !empty($args['taxonomy'])){ $taxonomy = $args['taxonomy']; } else { $taxonomy = '';}
		if( isset($args['custom_link']) && !empty($args['custom_link'])){ $custom_link = $args['custom_link']; } else { $custom_link = '';}
		$output = '';
		/* if there is a custom link registered */
		if($custom_link){
			$output .= esc_url($custom_link);
			return $output;
		}
		/* else return default link */
		if( $post_type != 'post'){ 
			if ($tax_term != '') { 
				$output .=  get_term_link( $tax_term, $taxonomy ); 
			} else { 
				$output .=  get_site_url().'/?taxonomy='.$taxonomy.'&post_type='.$post_type; 
			}
		} else {
			if ($tax_term != '') { 
				if($taxonomy == 'category'){ 
					$output .=  get_category_link( get_category_by_slug($tax_term)->term_id ); 
				} elseif( $taxonomy == 'post_tag'){ 
					$output .=  get_tag_link(get_term_by('slug', $tax_term, $taxonomy )->term_id);
				}
			} else { 
				$output .=  get_site_url().'/?taxonomy='.$taxonomy; 
			}
		}
		return $output;
	}
}
/********************************
 * Get Slider Script Hook
 ********************************/
if ( ! function_exists( 'jwdsp_slider_script' ) ) { 
	function jwdsp_slider_script($args){
		if( isset($args['slider_id']) && !empty($args['slider_id'])){ $slider_id = $args['slider_id']; } else { $slider_id = '';}
		if( isset($args['slider_controls']) && !empty($args['slider_controls'])){ $slider_controls = $args['slider_controls']; } else { $slider_controls = '';}
		if( isset($args['slider_pager']) && !empty($args['slider_pager'])){ $slider_pager = $args['slider_pager']; } else { $slider_pager = '';}
		if( isset($args['slider_loop']) && !empty($args['slider_loop'])){ $slider_loop = $args['slider_loop']; } else { $slider_loop = '';}
		$settings = get_option('jwdsp_general_settings');
		$output = '';
		if( $slider_id != ''){ 
			$output .= '<script type="text/javascript">';
			$output .= 'jQuery(document).ready(function(){';
				$output .= 'var swiper'. preg_replace("/[^0-9]/","",$slider_id).' = new Swiper(';
				$output .= '".swiper-'.$slider_id.'", {';
					if( $slider_pager != ''){ 	 $output .= 'pagination: { el: ".'.$slider_id.'-pagination", type: "'.$settings['pagination_type'].'", clickable: true }, '; }
					if( $slider_controls != ''){ $output .= 'navigation: { nextEl: ".'.$slider_id.'-next", prevEl: ".'.$slider_id.'-prev"},'; }
					if( $slider_loop != ''){  $output .= 'loop: true,'; }
					$output .= 'centeredSlides: true,';
					$output .= 'preventClicks: false,';
					if($settings['autoplay'] > 0){
						$output .= 'autoplay: { delay: '.$settings['autoplay'].', disableOnInteraction: false },';
					} else {
						$output .= 'autoplay: false,';
					}
					$output .= 'effect: "'.$settings['slide_effect'].'"';
					
/* 					if($settings['slide_effect'] == 'flip'){ 
						$output .= 'effect: "flip",';
						$output .= 'flipEffect: { rotate: 100, slideShadows: false }'; 
					} */
					
				$output .= '});';
			$output .= '});</script>';
		}
		return $output;
	}
}
/********************************
 * Get taxonomy name by post type Hook
 ********************************/
if ( ! function_exists( 'jwdsp_get_taxonomy_name' ) ) { 
	function jwdsp_get_taxonomy_name($post_type, $taxonomy_type){
		$output = '';
		$tag_taxonomy_format = array( 
			$post_type.'-tag', 
			$post_type.'_tag', 
			$post_type.'-tags', 
			$post_type.'_tags'	
		);
		$cat_taxonomy_format = array( 
			$post_type.'-cat', 
			$post_type.'_cat', 
			$post_type.'-cats',
			$post_type.'_cats',
			$post_type.'-category',
			$post_type.'_category',
			$post_type.'-categories',
			$post_type.'_categories',
		);
		if($post_type && $taxonomy_type){
			if ($taxonomy_type == 'category'){
				foreach($cat_taxonomy_format as $cat_tax_format){ if( taxonomy_exists($cat_tax_format) ){ $output .= $cat_tax_format; } }
			} elseif($taxonomy_type == 'post_tag'){
				foreach($tag_taxonomy_format as $tag_tax_format){ if( taxonomy_exists($tag_tax_format) ){ $output .= $tag_tax_format; } }
			}
		}
		return $output;
	}
}
/********************************
 * Get the Header of Admin Panel
 ********************************/
 if ( ! function_exists( 'jwdsp_get_panel_header' ) ) {
	function jwdsp_get_panel_header($message = '', $icon = ''){ 
		if (!$message || !is_admin()) { return; }
		$html = '<h2 class="jwdsp_panel-header">';
		if($icon){ $html .= '<span class="dashicons '.$icon.'"></span>'; }
		$html .= esc_html($message);
		$html .= '<a class="jwdsp_panel-header-logo" href="'.jwdsp_plugin_data('PluginURI') .'" target="blank"><img src="'.plugins_url('img/logo_fci.svg', dirname(__FILE__)).'" alt="JordacheWD" /></a>';
		$html .= '<span class="jwdsp_panel-header-version">v'. esc_attr( jwdsp_plugin_data('Version') ) . '&nbsp;' . __('Powered by', 'jwdsp') . '&nbsp;' .  jwdsp_plugin_data('Author') .'</span>';
		$html .= '</h2>';
		echo $html;
	}
}
/********************************
 * Get the Footer of Admin Panel 
  ********************************/
 if ( ! function_exists( 'jwdsp_get_panel_footer' ) ) {
	function jwdsp_get_panel_footer( $class = '' ){ 
		global $jwdsp_admin_page;
		$screen = get_current_screen();
		if( !$screen->id === 'widgets' || !$screen->id == $jwdsp_admin_page){ return; }
		$html = '<div class="jwdsp_rating '.$class.'">'; 
		$html .= '<a href="' . esc_url( 'https://wordpress.org/support/plugin/jwd-postslider-widget/reviews/' ) .'" target="blank" >';
		$html .= '<h4>' . __('If you like our plugin', 'jwdsp') . '</h4>';
		$html .= '<h1>' . __("Don't forget to Rate it", 'jwdsp') . '</h1>';
		$html .= '<div class="jwdsp_panel-footer-stars"><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></div>';
		$html .= '<h3>' . __('Thank you!', 'jwdsp') . '</h3>';
		$html .= '<h4>' . __('It helps us to become better for you!', 'jwdsp') .'</h4>';
		$html .= '</a></div>';
		return $html;
	}
}
/********************************
 * Custom CSS 
  ********************************/
if ( ! function_exists( 'jwdsp_get_custom_css' ) ) {
	function jwdsp_get_custom_css(){
		/* vars */
		$css = '';
		$settings = get_option('jwdsp_general_settings');
		/* Let's style */
		if($settings['show_icons'] == 'false'){	$css .= '.jwdsp_icon{ display:none!important;} '; }
		if($settings['title_color'] != ''){ $css .= '.jwdsp_widget-list-title a{color:'.$settings['title_color'].'!important;}';	}
		if($settings['title_hover'] != ''){	$css .= '.jwdsp_widget-list-title a:hover{color:'.$settings['title_hover'].'!important;}'; 	}
		if($settings['arrows_color'] != ''){ $css .= '.jwdsp_widget .swiper-button-prev:before, .jwdsp_widget .swiper-button-next:before{color:'.$settings['arrows_color'].'!important;}'; }
		if($settings['arrows_hover'] != ''){ $css .= '.jwdsp_widget .swiper-button-prev:hover:before, .jwdsp_widget .swiper-button-next:hover:before{color:'.$settings['arrows_hover'].'!important;}'; }
		if($settings['content_color'] != ''){ $css .= '.jwdsp_widget-list-excerpt{color:'.$settings['content_color'].'!important;}'; }
		if($settings['meta_color'] != ''){ 
			$css .= '.jwdsp_widget-list-meta{color:'.$settings['meta_color'].'!important;}';
			$css .= '.jwdsp_widget-list-meta a{color:'.$settings['meta_color'].'!important;}';
		}
		if($settings['meta_hover'] != ''){ $css .= '.jwdsp_widget-list-meta a:hover{color:'.$settings['meta_hover'].'!important;}'; }
		if($settings['button_text_color'] != ''){ $css .= '.jwdsp_widget-button{color:'.$settings['button_text_color'].'!important;}'; }
		if($settings['button_background'] != ''){ $css .= '.jwdsp_widget-button{background-color:'.$settings['button_background'].'!important;}'; }
		if($settings['button_text_hover'] != ''){ $css .= '.jwdsp_widget-button:hover{color:'.$settings['button_text_hover'].'!important;}'; }
		if($settings['button_background_hover'] != ''){ $css .= '.jwdsp_widget-button:hover{background-color:'.$settings['button_background_hover'].'!important;}'; }
		if($settings['pagination_color'] != ''){
			$css .= '.jwdsp_widget .swiper-pagination-progressbar-fill{background-color:'.$settings['pagination_color'].'!important;}';
			$css .= '.jwdsp_widget .swiper-pagination-bullet{background-color:'.$settings['pagination_color'].'!important;}';
		}
		if($settings['custom_css'] != ''){ $css .= $settings['custom_css']; }
		return $css;
	}
}
/********************************
 * Convert hexdec color string to rgb(a) string 
  ********************************/
 if ( ! function_exists( 'jwdsp_hex2rgba' ) ) {
	function jwdsp_hex2rgba($hexStr, $returnAsString = false, $seperator = ',') {
		$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); /* Gets a proper hex string */
		$rgbArray = array();
		if (strlen($hexStr) == 6) { /* If a proper hex code, convert using bitwise operation. No overhead... faster */
			$colorVal = hexdec($hexStr);
			$rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
			$rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
			$rgbArray['blue'] = 0xFF & $colorVal;
		} elseif (strlen($hexStr) == 3) { /* if shorthand notation, need some string manipulations */
			$rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
			$rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
			$rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
		} else {
			return false; /* Invalid hex color code */
		}
		return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; /* returns the rgb string or the associative array */
	}
}
/********************************
 * Update General Settings
 ********************************/
 if ( ! function_exists( 'jwdsp_sync_options' ) ) {
	 function jwdsp_sync_options($options = '', $action = '', $option = '', $old_val = '', $new_val = '' ){
		if(!is_admin() || empty($options)) { return; }
		/* Include new added options in the settings loop */
		$settings = array_merge( jwdsp_default_settings(), get_option($options));
		switch ($action){
			/* Always keep 'post' as default accepted post_type */
			case 'sync_posts':
				if ( !array_key_exists( 'post_types' , $settings)){
					$update = array_merge( array('post_types' => array('post')),  $settings);
					return update_option( $options,  $update );
				} else {
					$settings['post_types'] = array_unique( array_merge( array('post'), $settings['post_types']) );
					return update_option( $options, $settings );
				}
			break;
			/* Change option value if needed */
			case 'update_opt':
				if( isset($settings[$option]) && $settings[$option] == $old_val){ 	
					$settings[$option] = $new_val; 
					return update_option( $options, $settings );
				}
			break;
		}
	}
 }
/********************************
 * Get Taxonomies Hook
 ********************************/
 if ( ! function_exists( 'jwdsp_getTaxsList' ) ) { 
	function jwdsp_getTaxsList($objects = '', $WgSelected = '') {
		/* Security Check */
		if(!is_admin()){ return; }
		/* Ok, Now we can go on. */
		$output = '';
		if( ! empty( $objects ) && ! is_wp_error( $objects )){
			foreach($objects as $object => $tax){ 
				if( $object == $WgSelected ) { $selected = 'selected="selected"'; } else { $selected = '';}
				if( 'post_format' != $object){ $output .= '<option '.$selected.' value="'. $object .'">'. $tax->label . '</option>'; }
			}
		} else { $output .= '<option value="">'.__('No taxonomies found','jwdsp').'</option>'; }
		return $output;
	}
 }
/********************************
 * Get Terms Hook
 ********************************/
 if ( ! function_exists( 'jwdsp_getTermsList' ) ) { 
	function jwdsp_getTermsList($tax = '', $WgSelected = '') {
		/* Security Check */
		if(!is_admin()){ return; }
		/* Ok, Now we can go on. */
		$output = '';
		if( !empty($tax) ){
			$terms = get_terms( $tax , array( 'orderby' => 'name', 'order' => 'ASC' ));
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
				foreach ( $terms as $term ) {
					if( $term->slug == $WgSelected ) { $selected = 'selected="selected"'; } else { $selected = '';}
					$output .= '<option '.$selected.' value="'. $term->slug .'">'. $term->name . '</option>';
				}
			} else { $output .= '<option value="">'.__('No terms found','jwdsp').'</option>'; }
		} else { $output .= '<option value="">'.__('No terms found','jwdsp').'</option>'; }
		return $output;
	}
 }
/********************************
 * Get Widget Settings Hook
 ********************************/
if ( ! function_exists( 'jwdsp_getWgSettings' ) ) { 
	function jwdsp_getWgSettings($offset = '', $option = '') {
		/* Security Check */
		if(!is_admin() || !$offset || !$option){ return; }
		/* Ok, Now we can go on. */
		$Widget 	= new JWDSP_PostSlider();
		$Settings 	= $Widget->get_settings();
		return $Settings[$offset][$option];
	}
}
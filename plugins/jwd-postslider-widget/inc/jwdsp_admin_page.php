<?php
/********************************
 * JWD Show Posts Slider :: Plugin's Admin Section
 ********************************/
/********************************
 * Blocking direct access to this file 
 ********************************/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/********************************
 * Plugin's Admin Section
 ********************************/
if ( ! function_exists( 'jwdsp_admin_menus' ) && is_admin()) {
	add_action('admin_menu' , 'jwdsp_admin_menus');
	function jwdsp_admin_menus() {
		if(!is_admin()){ return; }
		global $jwdsp_admin_page;
		$jwdsp_admin_page = add_menu_page( __( 'JWD PostSlider', 'jwdsp' ), __( 'JWD PostSlider', 'jwdsp' ), 'manage_options', 'jwdsp_postslider_page', 'jwdsp_postslider_page', 'dashicons-slides', 999 ); 
	}
}
/********************************
 * Register Plugin Settings
 ********************************/
if ( ! function_exists( 'jwdsp_register_settings' ) ) {
	add_action('admin_init', 'jwdsp_register_settings' );
	function jwdsp_register_settings() {
		if(!is_admin()){ return; }
		if( null == get_option( 'jwdsp_general_settings', null )) { 
			add_option( 'jwdsp_general_settings', jwdsp_default_settings() , '', 'yes' ); 
		} else {
			jwdsp_sync_options('jwdsp_general_settings', 'sync_posts');
			/* Change option 'pagination_type' value name from 'progress' to 'progressbar' */
			jwdsp_sync_options('jwdsp_general_settings', 'update_opt', 'pagination_type', 'progress', 'progressbar');
		}
		add_settings_section( 'jwdsp_settings_section', __( 'General Settings', 'jwdsp' ), 'jwdsp_settings_reset', 'jwdsp_general_settings' );
		add_settings_field( 'jwdsp_settings_field', __( 'Settings Field', 'jwdsp' ), 'jwdsp_settings_callback', 'jwdsp_general_settings', 'jwdsp_settings_section', array( __( 'Add value here', 'jwdsp')));
		register_setting( 'jwdsp_general_settings', 'jwdsp_general_settings', 'jwdsp_settings_validate' );
	}
}
/********************************
 * Default Plugin Settings
 ********************************/
if ( ! function_exists( 'jwdsp_default_settings' ) ) {
	function jwdsp_default_settings() {
		if(!is_admin()){ return; }
		$defaults = array(
			'post_types' 				=> array('post'),
			'title_color'				=> '',
			'title_hover'				=> '',
			'title_position'			=> 'under',
			'title_background'			=> '#000000',
			'title_background_opacity'	=> '.7',
			'arrows_color'				=> '#666666',
			'arrows_hover'				=> '#000000',
			'content_color' 			=> '',
			'meta_color' 				=> '',
			'meta_hover' 				=> '',
			'button_text'				=> __('See More', 'jwdsp'),
			'button_text_color'			=> '#000000',
			'button_text_hover' 		=> '#e9e9e9',
			'button_background'			=> '#e9e9e9',
			'button_background_hover' 	=> '#000000',
			'button_size'				=> 'full',
			'button_position'			=> 'center',
			'pagination_color' 			=> '#000000',
			'pagination_type'			=> 'progressbar', 
			'show_icons' 				=> 'true', 
			'slide_effect'				=> 'slide', 
			'autoplay'					=> '3000',
			'custom_css'				=> ''
		);
		return $defaults; 
	}
}
/********************************
 * Reset Settings to Default
 ********************************/ 
if ( ! function_exists( 'jwdsp_settings_reset' ) ) {
	function jwdsp_settings_reset() {
		if(!is_admin()){ return; }
		if (isset($_POST['jwdsp_reset_settings'])){ $reset = $_POST['jwdsp_reset_settings']; } else {  $reset = ''; } 
		if($reset){
			check_admin_referer( 'jwdsp_reset_settings', 'jwdsp-reset-settings-nonce' );
			update_option('jwdsp_general_settings', jwdsp_default_settings());
			echo '<div class="updated settings-error notice is-dismissible"><p><strong>'.__( 'All Settings have been restored to default!', 'jwdsp' ).'</strong> </p></div>';
		}
	}
}
/********************************
 * Validate Plugin Settings
 ********************************/
if ( ! function_exists( 'jwdsp_settings_validate' ) ) {
	function jwdsp_settings_validate( $input ) {
		if(!is_admin()){ return; }
		$defaults = jwdsp_default_settings();
		$output = array();
		foreach( $input as $key => $val ) { 
			if( isset ( $input[$key] ) ) { 
				if ( ! is_array($input[$key]) ){
					/* Never empty button_text or title_background_opacity fields check */
					if( empty($input['button_text'])) { $input['button_text'] = $defaults['button_text']; }
					if( empty($input['title_background_opacity'])) { $input['title_background_opacity'] = $defaults['title_background_opacity']; }
					/* All good now */
					$output[$key] = stripslashes( wp_kses_post($input[$key]));
				} else {
					foreach ( $input[$key] as $i_key => $i_val){
						$output[$key][$i_key] = stripslashes( wp_kses_post( $input[$key][$i_key] ));
					}
				}
			} 
		} 
		if ( ! empty( $_POST ) && check_admin_referer( 'jwdsp_save_settings', 'jwdsp-save-settings-nonce' ) ) {
			return apply_filters( 'jwdsp_settings_validate', $output, $input );
		}
	} 
}
/********************************
 * Build settings fields
 ********************************/
if ( ! function_exists( 'jwdsp_settings_field' ) ) { 
	function jwdsp_settings_field( $type = '', $settings = '' , $option = '', $radio_args = array(), $unit = '' ) {
		if(!is_admin()){ return; }
		$jwdsp_general_settings = get_option('jwdsp_general_settings');
		$html = '';
		switch($type){
			case 'posts':
				$args    = array( 'public'   => true, '_builtin' => false );
				$avlpt 	 = array_merge( array('post'), get_post_types( $args, 'names', 'and' ));
				$options = $jwdsp_general_settings['post_types'];
				foreach ($avlpt as $posts => $post){
					if ( in_array( $post, $options ) ) { $checked = 'checked'; } else { $checked = ''; }
					if ( $post == 'post'){	
						$html .= '<input type="checkbox" name="jwdsp_general_settings[post_types][]" id="jwdsp_avlpt_'.$post.'" value="'.$post.'" '.$checked .' disabled />';
					} else { 
						$html .= '<input type="checkbox" name="jwdsp_general_settings[post_types][]" id="jwdsp_avlpt_'.$post.'" value="'.$post.'" '.$checked .' />';
					}
					$html .= '<label for="jwdsp_avlpt_'.$post.'" class="jwdsp_checkbox_list jwdsp_avlpt_'.$post.'">'.esc_attr($post).'</label>';
				}
			break;
			case 'css_editor':
				$custom_css = $jwdsp_general_settings['custom_css'];
				$css_editor = array(
					'textarea_name' => 'jwdsp_general_settings[custom_css]', 
					'textarea_rows' => '6',
					'editor_class'	=> 'jwdsp__css_editor',
					'media_buttons' => false,
					'tinymce'		=> false,
					'quicktags'		=> false
				);
				ob_start();
				wp_editor( $custom_css, 'jwdsp__css_editor', $css_editor );
				$html .= ob_get_clean();
			break;
			case 'radio':
				if(!$settings){ return $html .= '<p style="color:red">'.__( 'Error: No <code>$settings</code> parameter for <code>jwdsp_settings_field()</code> function!', 'jwdsp' ).'</p>'; }				
				if(!$option){ return $html .= '<p style="color:red">'.__( 'Error: No <code>$option</code> parameter for <code>jwdsp_settings_field()</code> function!', 'jwdsp' ).'</p>'; }
				$radio_settings = get_option($settings);
				if(!empty($radio_args)){
					foreach($radio_args as $radio){
					if(!is_array($radio)){ $html .= '<p style="color:red">' . __('ERROR: Parameter <b>'.$radio.' ($radio)</b> is not ARRAY!','jwdsp') . '</p>'; return $html; }
					$html .= '<input type="radio" name="'.$settings.'['.$option.']" id="jwdsp_gs_'.$option.'_'.$radio['value'].'" value="'.$radio['value'].'" '.checked( $radio_settings[$option], $radio['value'], false) .' />';
					$html .= '<label for="jwdsp_gs_'.$option.'_'.$radio['value'].'">'.esc_attr($radio['label']).'</label> &nbsp;';
					}
				}
			break;
			case 'text':
				if(!$option){ return $html .= '<p style="color:red">'.__( 'Error: No <code>$option</code> parameter for <code>jwdsp_settings_field()</code> function!', 'jwdsp' ).'</p>'; }
				$value = $jwdsp_general_settings[$option];
				$html .= '<input type="text" name="jwdsp_general_settings['.$option.']" id="jwdsp_gs_'.$option.'" value="'.$value.'" style="width:260px" />';
			break;
			case 'color':
				if(!$settings){ return $html .= '<p style="color:red">'.__( 'Error: No <code>$settings</code> parameter for <code>jwdsp_settings_field()</code> function!', 'jwdsp' ).'</p>'; }				
				if(!$option){ return $html .= '<p style="color:red">'.__( 'Error: No <code>$option</code> parameter for <code>jwdsp_settings_field()</code> function!', 'jwdsp' ).'</p>'; }
				$color_settings = get_option($settings);
 				$html .= '<div class="jwdsp_panel_color_piker">';
				$html .= '<input type="text" name="'.$settings.'['.$option.']" id="jwdsp_gs_'.$option.'" value="'.$color_settings[$option].'" class="jwdsp_color_picker" />';
				$html .= '</div>';
			break;
			case 'slider':
				if(!$settings){ return $html .= '<p style="color:red">'.__( 'Error: No <code>$settings</code> parameter for <code>jwdsp_settings_field()</code> function!', 'jwdsp' ).'</p>'; }				
				if(!$option){ return $html .= '<p style="color:red">'.__( 'Error: No <code>$option</code> parameter for <code>jwdsp_settings_field()</code> function!', 'jwdsp' ).'</p>'; }
				if($unit){ $data_unit = 'data-jwdsp_unit="'.$unit.'"'; } else { $data_unit = ''; }
				$opacity = get_option($settings);
				$html .= '<div class="jwdsp_slider-bg" '.$data_unit.'><div class="jwdsp_slider-handle ui-slider-handle"></div></div>';
				$html .= '<input class="jwdsp_slider-input" name="'.$settings.'['.$option.']" type="text" id="jwdsp_gs_'.$option.'" value="'.$opacity[$option].'" readonly />';
			break;
			default: $html .= '<p style="color:red">'.__( 'Error: No <code>$type</code> parameter for <code>jwdsp_settings_field()</code> function!', 'jwdsp' ).'</p>';
		}
		return $html;
	}
}
/********************************
 * Settings Callback
 ********************************/
if ( ! function_exists( 'jwdsp_settings_callback' ) ) {
	function jwdsp_settings_callback($args) {
		if(!is_admin()){ return; }
		$html 		= '';
		$settings 	= get_option('jwdsp_general_settings');
		foreach($settings as $options => $configs){
			$html .= '<div id='.$options.' class="jwdsp_panel-content-option">';
				$html .= '<h4 class="jwdsp_panel-content-title">'. __( ucfirst(str_replace('_', ' ', $options)), 'jwdsp') .'</h4>';
				$html .= '<div class="jwdsp_panel-content-box">';
				if ($options == 'post_types') {
					$html .= '<div class="jwdsp_switch-field">' . jwdsp_settings_field('posts') . '</div>';	
					$html .= '<p class="description">'.__( 'Choose post types to be used by the widget; Default: <code>post</code>.', 'jwdsp' ).'</p>';
				} elseif ($options == 'show_icons'){
					$show_icons_args = array( array('label' => __('Yes', 'jwdsp'), 'value' => 'true' ), array('label' => __('No', 'jwdsp'), 'value' => 'false' ) );
					$html .= '<div class="jwdsp_switch-field">' . jwdsp_settings_field('radio', 'jwdsp_general_settings', $options, $show_icons_args) . '</div>';
					$html .= '<p class="description">'.__( 'Whether to display icons for date, comments, categories and tags.', 'jwdsp' ).'</p>';
				} elseif ( $options == 'pagination_type'){
					$pagination_args = array( array('label' => __('Progress Bar', 'jwdsp'), 'value' => 'progressbar' ), array('label' => __('Bullets', 'jwdsp'), 'value' => 'bullets' ) ); 
					$html .= '<div class="jwdsp_switch-field">' . jwdsp_settings_field('radio', 'jwdsp_general_settings', $options, $pagination_args ) . '</div>';					
				} elseif ( $options == 'slide_effect'){
					$slide_args = array( array('label' => __('Slide', 'jwdsp'), 'value' => 'slide' ), array('label' => __('Flip', 'jwdsp'), 'value' => 'flip' ) ); 
					$html .= '<div class="jwdsp_switch-field">' . jwdsp_settings_field('radio', 'jwdsp_general_settings', $options, $slide_args ) . '</div>';	
				} elseif ( $options == 'button_text'){
					$html .= jwdsp_settings_field('text', 'jwdsp_general_settings', $options);
				} elseif ( $options == 'button_size'){
					$button_size_args = array( array('label' => __('Full', 'jwdsp'), 'value' => 'full' ), array('label' => __('Auto', 'jwdsp'), 'value' => 'auto' ) ); 
					$html .= '<div class="jwdsp_switch-field">' . jwdsp_settings_field('radio', 'jwdsp_general_settings', $options, $button_size_args ) . '</div>';	
				} elseif ( $options == 'button_position'){
					$btn_pos_args = array( array('label' => __('Left', 'jwdsp'), 'value' => 'left' ), array('label' => __('Center', 'jwdsp'), 'value' => 'center' ), array('label' => __('Right', 'jwdsp'), 'value' => 'right' )); 
					$html .= '<div class="jwdsp_switch-field">' . jwdsp_settings_field('radio', 'jwdsp_general_settings', $options, $btn_pos_args ) . '</div>';
					$html .= '<p class="description">' . sprintf( __('Only visible if <b>%1$s</b> is set to <b>%2$s</b>.', 'jwdsp'), __('Button size','jwdsp'), __('Auto','jwdsp')) .'</p>';
				} elseif ( $options == 'title_position'){
					$title_pos_args = array( array('label' => __('Under the image', 'jwdsp'), 'value' => 'under' ), array('label' => __('Over the image', 'jwdsp'), 'value' => 'over' ) ); 
					$html .= '<div class="jwdsp_switch-field">' . jwdsp_settings_field('radio', 'jwdsp_general_settings', $options, $title_pos_args ) . '</div>';
				} elseif ( $options == 'custom_css'){
					$html .= jwdsp_settings_field('css_editor');
					$html .= '<p style="color:red;font-size:85%">'.__('Do not include <code>&lt;style&gt;</code> tag!', 'jwdsp').'</p>';
					$html .= '<p style="font-size:85%">' . sprintf( __('Use the ID of targeted widget you want to customize. Go to %s to find the ID.', 'jwdsp'), '<a href="'. esc_url( get_admin_url(null, 'widgets.php' ) ) .'">'.__('Widgets', 'jwdsp').'</a>') . '</p>';
					$html .= '<p style="font-size:85%">'.__('Example','jwdsp'). ': <code>#jwdsp_postslider-1 .myClass{color:#f00;}</code></p>';
				} elseif ( $options == 'title_background'){
					$html .= jwdsp_settings_field('color', 'jwdsp_general_settings', $options);
					$html .= '<p class="description">' . sprintf( __('Only visible if <b>%1$s</b> is set to <b>%2$s</b>.', 'jwdsp'), __('Title position','jwdsp'), __('Over the image','jwdsp')) . '</p>';
				} elseif ( $options == 'title_background_opacity'){
					$html .= jwdsp_settings_field('slider', 'jwdsp_general_settings', $options, null, 'op');
					$html .= '<p class="description" style="margin-top:1.5em;">' . sprintf( __('Only visible if <b>%1$s</b> is set to <b>%2$s</b>.', 'jwdsp'), __('Title position','jwdsp'), __('Over the image','jwdsp')) . '</p>';
				} elseif ( $options == 'autoplay'){
					$html .= jwdsp_settings_field('slider', 'jwdsp_general_settings', $options, null, 'sec');
					$html .= '<p class="description" style="margin-top:1.5em;">' . __('Delay between transitions (seconds).', 'jwdsp') . '</p>';
				} else {
 					$html .= jwdsp_settings_field('color', 'jwdsp_general_settings', $options);
				}
			$html .= '</div></div>';
		}
		echo $html;
	} 
}
/********************************
 * The admin section page
 ********************************/
if ( ! function_exists( 'jwdsp_postslider_page' ) ) {
	function jwdsp_postslider_page() {
		if(!is_admin()){ return; } ?>
		<div class="jwdsp_panel-wrap wrap">
			<?php jwdsp_get_panel_header(jwdsp_plugin_data('Name')); settings_errors();?>
			<div class="jwdsp_panel-content">
				<form method="post" action="options.php">
			<?php 	settings_fields( 'jwdsp_general_settings' );  
					do_settings_sections( 'jwdsp_general_settings' );  
					wp_nonce_field( 'jwdsp_save_settings', 'jwdsp-save-settings-nonce' ); 
					submit_button( __('Save Settings', 'jwdsp' ), 'primary', 'jwdsp_save_settings'); 
			?>
				</form>
				<form method="post" class="jwdsp_panel-reset">
			<?php 	wp_nonce_field( 'jwdsp_reset_settings', 'jwdsp-reset-settings-nonce' ); 
					wp_nonce_field( 'jwdsp_save_settings', 'jwdsp-save-settings-nonce' ); 
					submit_button( __('Reset Settings', 'jwdsp' ), 'small', 'jwdsp_reset_settings', false, array( 'onclick' => __('return window.confirm("Are you sure you want to RESET ALL the settings to default?")', 'jwdsp' ))); 
			?>
				</form>
			</div>
			<?php echo jwdsp_get_panel_footer(); ?>
		</div>
		<p class="jwdsp_panel-copyright"><?php echo esc_attr( jwdsp_plugin_data('Name') ) . '&nbsp;' . __('is a product of', 'jwdsp') . '&nbsp;' . jwdsp_plugin_data('Author');?></p>
<?php 
	}
}
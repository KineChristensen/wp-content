<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<div class="settings_title"><h4><?php _e('Menu Replacement Settings',APMM_PRO_TD);?></h4></div>
  <div class="wpmm_mega_settings">
       <table class="widefat">
	       <tr>
	<td class="wpmm_meta_table"><label for="enable_search_form"><?php _e("Choose Replacement", APMM_PRO_TD) ?></label></td>
	  <td> 
	  <select name="wpmm_settings[mega_menu_settings][choose_menu_type]" id="wpmm_choose_menu_type">
	  	<option value="default" <?php echo selected( $wpmmenu_item_meta['mega_menu_settings']['choose_menu_type'], 'default', false );?>>Default</option>
	  	<option value="search_type" <?php echo selected( $wpmmenu_item_meta['mega_menu_settings']['choose_menu_type'], 'search_type', false );?>><?php _e('Search Type',APMM_PRO_TD);?></option>
	  	<option value="logo_image" <?php echo selected( $wpmmenu_item_meta['mega_menu_settings']['choose_menu_type'], 'logo_image', false );?>><?php _e('Logo Image',APMM_PRO_TD);?></option>
	  	<!-- <option value="html" <?php echo selected( $wpmmenu_item_meta['mega_menu_settings']['choose_menu_type'], 'shortcode', false );?>><?php _e('HTML/Shortcode',APMM_PRO_TD);?></option> -->
	  	<?php if(WPMM_Libary::is_woocommerce_activated()){ ?>
           <option value="woo_cart_total" <?php echo selected( $wpmmenu_item_meta['mega_menu_settings']['choose_menu_type'], 'woo_cart_total', false );?>><?php _e('Woocommerce Cart Total',APMM_PRO_TD);?></option>
           <!-- <option value="woo_wishlist" <?php echo selected( $wpmmenu_item_meta['mega_menu_settings']['choose_menu_type'], 'woo_wishlist', false );?>><?php _e('Woocommerce Wislist',APMM_PRO_TD);?></option> -->
	  	<?php }?>
	  	<option value="login_form" <?php echo selected( $wpmmenu_item_meta['mega_menu_settings']['choose_menu_type'], 'login_form', false );?>><?php _e('Login Form',APMM_PRO_TD);?></option>
	  	<option value="register_form" <?php echo selected( $wpmmenu_item_meta['mega_menu_settings']['choose_menu_type'], 'register_form', false );?>><?php _e('Register Form',APMM_PRO_TD);?></option>
	  </select>
	  <p class="description"><?php _e('Note: Choose replacement instead of default menu setup such as for search type, logo image display on menu bar.',APMM_PRO_TD);?></p>
	  </td>
	</tr>


			<tr class="toggle_search_form">
			<td class="wpmm_meta_table"><label><?php _e("Custom Content", APMM_PRO_TD) ?></label></td>
			  <td> 
			     <textarea name='wpmm_settings[mega_menu_settings][custom_content]' cols="40" rows="2" placeholder="<?php _e('Paste Shortcode here',APMM_PRO_TD);?>"><?php echo (isset( $wpmmenu_item_meta['mega_menu_settings']['custom_content']) && $wpmmenu_item_meta['mega_menu_settings']['custom_content'] != '')?$wpmmenu_item_meta['mega_menu_settings']['custom_content']:'';?></textarea>
				<p class="description"><?php _e('Use Shortcode for search menu as',APMM_PRO_TD);?></p>
				<p class="description"><?php _e('Inline Search Toggle Left: [wp_megamenu_search_form template_type=inline-search style=inline-toggle-left]',APMM_PRO_TD);?></p>
				<p class="description"><?php _e('Inline toggle to Right search form:  [wp_megamenu_search_form template_type=inline-search style=inline-toggle-right]',APMM_PRO_TD);?></p>
				<p class="description"><?php _e('Popup Search Form: [wp_megamenu_search_form template_type=popup-search-form]');?></p>
				<p class="description"><?php _e('Display Search form on MegaMenu On hover/click : [wp_megamenu_search_form template_type=megamenu-type-search]',APMM_PRO_TD);?></p>
			  </td>
			</tr>
            <!-- Logo Image display start -->
			<tr class="toggle_logo_image" id="logo_image">
			<td class="wpmm_meta_table"><label><?php _e("Choose Logo Image", APMM_PRO_TD) ?></label></td>
			  <td> 
			  <div class="wpmm-option-field">
			   <input type="hidden" class="wpmm-logo-url" name="wpmm_settings[mega_menu_settings][logo_image]" 
			    value="<?php echo (isset( $wpmmenu_item_meta['mega_menu_settings']['logo_image']) && $wpmmenu_item_meta['mega_menu_settings']['logo_image'] != '')?esc_url($wpmmenu_item_meta['mega_menu_settings']['logo_image']):'';?>" />
			     <input type="button" class="wpmm_logo_url_button button button-primary button-large" id="logo_image" name="wpmm_logo_url_button"  
			     value="Upload Logo Image" size="25"/> 
			<?php 
				$img_url =(isset( $wpmmenu_item_meta['mega_menu_settings']['logo_image']) && $wpmmenu_item_meta['mega_menu_settings']['logo_image'] != '')?esc_url($wpmmenu_item_meta['mega_menu_settings']['logo_image']):'';
				if($img_url == ''){
					$style = 'style="display:none;"';
				}else{
			    $style = '';
				}
			?>
			      <div class="wpmm-option-field wpmm-image-preview2" <?php echo $style;?>>
                         <a class="remove_logo_image" href="#">
						<i class="dashicons dashicons-trash"></i>
						</a>
                      <img style="width: 100%;" class="wpmm-logo-image" 
                      src="<?php echo (isset( $wpmmenu_item_meta['mega_menu_settings']['logo_image']) && $wpmmenu_item_meta['mega_menu_settings']['logo_image'] != '')?esc_url($wpmmenu_item_meta['mega_menu_settings']['logo_image']):'';?>" 
                      alt="">
                      </div>
			 </div>
			 </td>
			</tr>

			<tr class="toggle_logo_image">
				<td><label><?php _e("Custom Width/Height", APMM_PRO_TD) ?></label></td>
				<td>
			 	 <input type="number" placeholder="E.g., 40" class="wpmm-custom-width custom-logo-size" name="wpmm_settings[mega_menu_settings][custom_width]" 
			    value="<?php echo (isset( $wpmmenu_item_meta['mega_menu_settings']['custom_width']) && $wpmmenu_item_meta['mega_menu_settings']['custom_width'] != '')?esc_attr($wpmmenu_item_meta['mega_menu_settings']['custom_width']):'';?>" />
			    <label><?php _e("Width(px)", APMM_PRO_TD) ?></label>
			    <input type="number" placeholder="E.g., 40" class="wpmm-custom-height custom-logo-size" name="wpmm_settings[mega_menu_settings][custom_height]" 
			    value="<?php echo (isset( $wpmmenu_item_meta['mega_menu_settings']['custom_height']) && $wpmmenu_item_meta['mega_menu_settings']['custom_height'] != '')?esc_attr($wpmmenu_item_meta['mega_menu_settings']['custom_height']):'';?>" />
			     <label><?php _e("Height(px)", APMM_PRO_TD) ?></label>
			     <p class="description"><?php _e('Define logo image custom width/height in px.',APMM_PRO_TD);?></p>
			   </td>
			</tr>
			<!-- Logo Image display End -->

		<!-- 	<tr class="toggle_shortcode">
			<td class="wpmm_meta_table"><label><?php _e("Any HTML or Shortcode", APMM_PRO_TD) ?></label></td>
			  <td> 
			       <textarea name='wpmm_settings[mega_menu_settings][html_shortcodes]' cols="40" rows="2" 
			     placeholder="<?php _e('Paste Shortcode here',APMM_PRO_TD);?>"><?php echo (isset( $wpmmenu_item_meta['mega_menu_settings']['html_shortcodes']) && $wpmmenu_item_meta['mega_menu_settings']['html_shortcodes'] != '')?esc_attr($wpmmenu_item_meta['mega_menu_settings']['html_shortcodes']):'';?></textarea>
			  </td>
			</tr> -->

          <!-- woocommerce cart total display start -->
		<!-- 	<tr class="toggle_woo_cart_total">
			<td class="wpmm_meta_table"><label><?php _e("Woocommerce Cart Display", APMM_PRO_TD) ?></label></td>
			  <td> 
			       <select name="wpmm_settings[mega_menu_settings][choose_woo_cart_display]" id="choose_woo_cart_display">
				  	<option value="icon_only" <?php echo selected( $wpmmenu_item_meta['mega_menu_settings']['choose_woo_cart_display'], 'icon_only', false );?>><?php _e('Icon Only',APMM_PRO_TD);?></option>
				  	<option value="item_only" <?php echo selected( $wpmmenu_item_meta['mega_menu_settings']['choose_woo_cart_display'], 'item_only', false );?>><?php _e('Icon & Items Only',APMM_PRO_TD);?></option>
				  	<option value="price_only" <?php echo selected( $wpmmenu_item_meta['mega_menu_settings']['choose_woo_cart_display'], 'price_only', false );?>><?php _e('Icon & Price Only',APMM_PRO_TD);?></option> 	
				  	<option value="both_pi" <?php echo selected( $wpmmenu_item_meta['mega_menu_settings']['choose_woo_cart_display'], 'both_pi', false );?>><?php _e('Icon Both Price and Items',APMM_PRO_TD);?></option> 	
				  </select>
				  <p class="description"><?php _e('What would you like to display in the menu?',APMM_PRO_TD);?></p>
			  </td>
			</tr>
		   <tr class="toggle_woo_cart_total">
			<td class="wpmm_meta_table"><label><?php _e("Woocommerce Cart Display Layout", APMM_PRO_TD) ?></label></td>
			  <td> 
			     <input type="text" name="wpmm_settings[mega_menu_settings][cart_display_layout]" value="<?php echo (isset( $wpmmenu_item_meta['mega_menu_settings']['cart_display_layout']) && $wpmmenu_item_meta['mega_menu_settings']['cart_display_layout'] != '')?esc_attr($wpmmenu_item_meta['mega_menu_settings']['cart_display_layout']):'';?>" placeholder="#item_count items - #price"/>
			     <p class="description"><?php _e('Note: Fill the type of layout you want to display for woocommerce cart on menu and use #tag method such as 
                 #price to display price and #item_count to display total icon count. You can fill any layout as you wanted
                such as #price(#item_count) which is display as $32(2) display type where 32 is total price and total item count is 2.',APMM_PRO_TD);?></p>
			    
			  </td>
			</tr> -->
			<!--  <tr class="toggle_woo_cart_total">
			<td class="wpmm_meta_table"><label for="cart_contents">< ?php _e("Woocommerce Display Cart Contents", APMM_PRO_TD) ?></label></td>
			  <td> 
			    <div class="wpmm-switch">
			          <input type='checkbox' id="cart_contents" name='wpmm_settings[mega_menu_settings][cart_display_content]' value='true' <?php echo checked($wpmmenu_item_meta['mega_menu_settings']['cart_display_content'],'true', false ); ?>/>
			          <label for="cart_contents"></label>
                    </div>
                    <p class="description">< ?php _e("Note: Enable to display cart contents in menu fly-out.", APMM_PRO_TD); ?></p>
			    
			  </td>
			</tr> -->
			<!-- woocommerce cart total display end -->

			<!-- <tr class="toggle_woo_wishlist">
			<td class="wpmm_meta_table"><label><?php _e("Woocommerce Wishlist", APMM_PRO_TD) ?></label></td>
			  <td> 
			     <textarea name='wpmm_settings[mega_menu_settings][woo_wishlist]' cols="40" rows="2" 
			     placeholder="<?php _e('Paste Shortcode here',APMM_PRO_TD);?>"><?php echo (isset( $wpmmenu_item_meta['mega_menu_settings']['woo_wishlist']) && $wpmmenu_item_meta['mega_menu_settings']['woo_wishlist'] != '')?$wpmmenu_item_meta['mega_menu_settings']['woo_wishlist']:'';?></textarea>
			  </td>
			</tr> -->
				<tr class="toggle_login_form">
			<td class="wpmm_meta_table"><label><?php _e("Login Form Shortcode", APMM_PRO_TD) ?></label></td>
			  <td> 
			     <textarea name='wpmm_settings[mega_menu_settings][login_form_shortcode]' cols="40" rows="2" 
			     placeholder="<?php _e('Paste Shortcode here',APMM_PRO_TD);?>"><?php echo (isset( $wpmmenu_item_meta['mega_menu_settings']['login_form_shortcode']) && $wpmmenu_item_meta['mega_menu_settings']['login_form_shortcode'] != '')?$wpmmenu_item_meta['mega_menu_settings']['login_form_shortcode']:'';?></textarea>
			  <p class="description">
			     <?php _e('Use Shortcode for user login form on popup modal',APMM_PRO_TD);?></p>
				<p class="description">
				[wp_megamenu_login_form]
				</p>
			  </td>
			</tr>
				<tr class="toggle_register_form">
			<td class="wpmm_meta_table"><label><?php _e("Register Form Shortcode", APMM_PRO_TD) ?></label></td>
			  <td> 
			    <textarea name='wpmm_settings[mega_menu_settings][register_form_shortcode]' cols="40" rows="2" 
			     placeholder="<?php _e('Paste Shortcode here',APMM_PRO_TD);?>"><?php echo (isset( $wpmmenu_item_meta['mega_menu_settings']['register_form_shortcode']) && $wpmmenu_item_meta['mega_menu_settings']['register_form_shortcode'] != '')?$wpmmenu_item_meta['mega_menu_settings']['register_form_shortcode']:'';?></textarea>
			  <p class="description">
			     <?php _e('Use Shortcode for user register form on popup modal',APMM_PRO_TD);?></p>
				<p class="description">
				[wp_megamenu_register_form]
			  </td>
			</tr>
			<tr class="toggle_fpassword_form">
			<td class="wpmm_meta_table"><label><?php _e("Forgot Password Form Shortcode", APMM_PRO_TD) ?></label></td>
			  <td> 
			    sfasd
			  </td>
			</tr>

			</table>
  </div>
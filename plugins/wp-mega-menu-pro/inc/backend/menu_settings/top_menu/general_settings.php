<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<div class="wpmm_mega_settings">
  <div class="settings_content">
      <div class="settings_title"><h4><?php _e('Menu Item Settings',APMM_PRO_TD);?></h4></div>
  	   <table class="widefat">
			<tr>
			<td class="wpmm_meta_table"><label for="disable_menu_text"><?php _e("Hide Menu Text", APMM_PRO_TD) ?></label></td>
			  <td> 
			       <div class="wpmm-switch">
			          <input type='checkbox' class='wpmm_menu_settingss' id="disable_menu_text" name='wpmm_settings[general_settings][disable_text]' value='true' <?php echo checked($wpmmenu_item_meta['general_settings']['disable_text'],'true', false ); ?>/>
			          <label for="disable_menu_text"></label>
                    </div>
                     <p class="description"><?php _e("Note: Enable this option if you want to hide menu title and its height will also set to 0.", APMM_TD); ?></p>
			  </td>
			</tr>	
			<tr>
			<td class="wpmm_meta_table"><label for="disable_desc"><?php _e("Disable Description", APMM_PRO_TD) ?></label></td>
			  <td> 
			       <div class="wpmm-switch">
			          <input type='checkbox' class='wpmm_menu_settingss' id="disable_desc" name='wpmm_settings[general_settings][disable_desc]' value='true' <?php echo checked($wpmmenu_item_meta['general_settings']['disable_desc'],'true', false ); ?>/>
			          <label for="disable_desc"></label>
                    </div>
                       <p class="description"><?php _e("Enable this option in order to hide menu description.", APMM_PRO_TD); ?></p>
			  </td>
			</tr>	
			<tr>
			<td class="wpmm_meta_table"><label for="visible_hidden_text"><?php _e("Hide Menu Text With Visible Height", APMM_PRO_TD) ?></label></td>
			  <td> 
			       <div class="wpmm-switch">
			          <input type='checkbox' class='wpmm_menu_settingss' id="visible_hidden_text" name='wpmm_settings[general_settings][visible_hidden_menu]' value='true' <?php echo checked($wpmmenu_item_meta['general_settings']['visible_hidden_menu'],'true', false ); ?>/>
			          <label for="visible_hidden_text"></label>
                    </div>
                    
                      <p class="description"><?php _e("Note: Enable this option if you want to hide menu title but the respective height of this menu text will be displayed.", APMM_TD); ?></p>
			  
			  </td>
			</tr>
			<tr>
			<td class="wpmm_meta_table"><label for="active_menu_link"><?php _e("Active Menu Link", APMM_PRO_TD) ?></label></td>
				  <td> 
					  <div class="wpmm-switch">
					      <input type='checkbox' class='wpmm_active_links' id="active_menu_link"
					      name='wpmm_settings[general_settings][active_link]' value='true' <?php echo checked($wpmmenu_item_meta['general_settings']['active_link'],'true', false ); ?>/>
					      <label for="active_menu_link"></label>
		               </div>
                       <p class="description"><?php _e("Enable this option in order to active menu link.", APMM_PRO_TD); ?></p>

			  </td>
			</tr>
			<tr>
			<td class="wpmm_meta_table"><label for="hide_arrow"><?php _e("Hide Arrow", APMM_PRO_TD) ?></label></td>
			  <td> 
			   <div class="wpmm-switch">
			      <input type='checkbox' class='wpmm_menu_settingss' id="hide_arrow"
			      name='wpmm_settings[general_settings][hide_arrow]' value='true' <?php echo checked($wpmmenu_item_meta['general_settings']['hide_arrow'],'true', false ); ?>/>
			       <label for="hide_arrow"></label>
               </div>
                 <p class="description"><?php _e("Enable this option in order to hide this menu arrow.", APMM_PRO_TD); ?></p>
			  </td>
			</tr>
			<tr>
			<td class="wpmm_meta_table"><label for="hide_menu_onmobile"><?php _e("Hide Menu On Mobile", APMM_PRO_TD) ?></label></td>
			  <td> 
			  <div class="wpmm-switch">
			      <input type='checkbox' class='wpmm_menu_settingss' id="hide_menu_onmobile"
			      name='wpmm_settings[general_settings][hide_on_mobile]' value='true' <?php echo checked($wpmmenu_item_meta['general_settings']['hide_on_mobile'],'true', false ); ?>/>
			      <label for="hide_menu_onmobile"></label>
               </div>
                 <p class="description"><?php _e("Enable this option in order to hide this menu item on mobile version only.", APMM_PRO_TD); ?></p>

			  </td>
			</tr>
			<tr>
			<td class="wpmm_meta_table"><label for="hide_menu_ondesktop"><?php _e("Hide Menu On Desktop", APMM_PRO_TD) ?></label></td>
			  <td> 
			  <div class="wpmm-switch">
			      <input type='checkbox' class='wpmm_menu_settingss' id="hide_menu_ondesktop"
			      name='wpmm_settings[general_settings][hide_on_desktop]' value='true' <?php echo checked($wpmmenu_item_meta['general_settings']['hide_on_desktop'],'true', false ); ?>/>
			     <label for="hide_menu_ondesktop"></label>
               </div>
                 <p class="description"><?php _e("Enable this option in order to hide this menu item on desktop version only.", APMM_PRO_TD); ?></p>

			  </td>
			</tr>
		  <tr>
			<td class="wpmm_meta_table"><label for="menu_icon"><?php _e("Show Menu Icon", APMM_PRO_TD) ?></label></td>
			  <td> 
			  <div class="wpmm-switch">
			      <input type='checkbox' class='wpmm_menu_settingss' id="menu_icon"
			      name='wpmm_settings[general_settings][menu_icon]' value='enabled' <?php echo checked($wpmmenu_item_meta['general_settings']['menu_icon'],'enabled', disabled ); ?>/>
			   <label for="menu_icon"></label>
               </div>
                 <p class="description"><?php _e("Important Note: Enabling this option is compulsory if you want to display menu icon choosed from 'Icon Settings' for this specific menu item.", APMM_PRO_TD); ?></p>
			  </td>
			</tr>

			  <tr>
			<td class="wpmm_meta_table"><label for="active_single_menu"><?php _e("Active Single Menu", APMM_PRO_TD) ?></label></td>
			  <td> 
			  <div class="wpmm-switch">
			      <input type='checkbox' class='wpmm_menu_settingss' id="active_single_menu"
			      name='wpmm_settings[general_settings][active_single_menu]' value='enabled' <?php echo checked($wpmmenu_item_meta['general_settings']['active_single_menu'],'enabled', disabled ); ?>/>
			       <label for="active_single_menu"></label>
              </div>
			  <p class="description"><?php _e('Enable single menu if menu is custom single menu link. Useful for Any Custom Links such as social links (facebook, twitter)',APMM_PRO_TD);?></p>
			  </td>
			</tr>

            <tr>
			<td class="wpmm_meta_table">
			    <?php _e("Menu Item Alignment", APMM_PRO_TD); ?>
			</td>
			<td>
			    <select name='wpmm_settings[general_settings][menu_align]' class='wpmm_menu_align'>
			        <option value='left' <?php echo selected( $wpmmenu_item_meta['general_settings']['menu_align'], 'left', false );?>><?php _e("Left", APMM_PRO_TD); ?></option>
			        <option value='right' <?php echo selected( $wpmmenu_item_meta['general_settings']['menu_align'], 'right', false );?>><?php _e("Right", APMM_PRO_TD); ?></option>
			    <select>
			   <br/> <br/>
			  <p class="description"><?php _e('Right aligned items will appear in reverse order on the right hand side of the menu bar.
			  Specially required for search icon and other custom links with social icons.',APMM_PRO_TD);?></p>
			</td>
			</tr>
			
		 	 <tr>
			<td class="wpmm_meta_table">
			    <?php _e("Sub Menu Alignment", APMM_PRO_TD); ?>

			</td>
			<td>
			    <select name='wpmm_settings[general_settings][submenu_align]'>
			        <option value='left' <?php echo selected( $wpmmenu_item_meta['general_settings']['submenu_align'], 'left', false );?>><?php _e("Left", APMM_PRO_TD); ?></option>
			        <option value='right' <?php echo selected( $wpmmenu_item_meta['general_settings']['submenu_align'], 'right', false );?>><?php _e("Right", APMM_PRO_TD); ?></option>
			    <select>
			    <p class="description"><?php _e("Note: Choose individual flyout menu display position on hover/click for sub menu.", APMM_PRO_TD); ?></p>
			</td>
			</tr> 

			<tr>
				<td class="wpmm_meta_table">
				    <?php _e("Menu Label", APMM_PRO_TD); ?>
				</td>
				<td class='apmega-value'>
			       <?php $topmenulabel = (isset($wpmmenu_item_meta['general_settings']['top_menu_label']) && $wpmmenu_item_meta['general_settings']['top_menu_label'] != '')?esc_attr($wpmmenu_item_meta['general_settings']['top_menu_label']):'';?>
				   <input type="text" name="wpmm_settings[general_settings][top_menu_label]" value="<?php echo $topmenulabel;?>" placeholder="<?php _e('E.g., HOT!',APMM_PRO_TD);?>">
				   <p class="description"><?php _e("Fill menu label such as HOT!, NEW!, UPDATES! and so on.", APMM_PRO_TD); ?></p>
				</td>
			</tr>

		  <tr>
				<td class="wpmm_meta_table">
				    <?php _e("Menu Label Animation", APMM_PRO_TD); ?>
				</td>
				<td class='apmega-value'>
			       <?php $label_animation = (isset($wpmmenu_item_meta['general_settings']['label_animation']) && $wpmmenu_item_meta['general_settings']['label_animation'] != '')?esc_attr($wpmmenu_item_meta['general_settings']['label_animation']):'none';?>
				       <select name="wpmm_settings[general_settings][label_animation]" class="wpmm-selection">
                               <option value="none" <?php if($label_animation == "none") echo "selected='selected'";?>><?php _e('None',APMM_PRO_TD);?></option>
                               <option value="mybounce" <?php if($label_animation == "mybounce") echo "selected='selected'";?>><?php _e('Bounce',APMM_PRO_TD);?></option>
                               <option value="flash" <?php if($label_animation == "flash") echo "selected='selected'";?>><?php _e('Flash',APMM_PRO_TD);?></option>
                               <option value="shake" <?php if($label_animation == "shake") echo "selected='selected'";?>><?php _e('Shake',APMM_PRO_TD);?></option>
                               <option value="swing" <?php if($label_animation == "swing") echo "selected='selected'";?>><?php _e('Swing',APMM_PRO_TD);?></option>
                               <option value="tada" <?php if($label_animation == "tada") echo "selected='selected'";?>><?php _e('Tada',APMM_PRO_TD);?></option>
                               <option value="bounceIn" <?php if($label_animation == "bounceIn") echo "selected='selected'";?>><?php _e('BounceIn',APMM_PRO_TD);?></option>
                               <option value="flipInX" <?php if($label_animation == "flipInX") echo "selected='selected'";?> ><?php _e('FlipInX',APMM_PRO_TD);?></option>
                               <option value="flipInY" <?php if($label_animation == "flipInY") echo "selected='selected'";?> ><?php _e('FlipInY',APMM_PRO_TD);?></option>
                               <option value="slideInUp" <?php if($label_animation == "slideInUp") echo "selected='selected'";?>><?php _e('SlideInUp',APMM_PRO_TD);?></option>
                               <option value="slideInDown" <?php if($label_animation == "slideInDown") echo "selected='selected'";?>><?php _e('SlideInDown',APMM_PRO_TD);?></option>
                           </select>
                            <p class="description"><?php _e('Choose specific animation type for this menu label.Default is set as None which will disable animation.',APMM_PRO_TD);?></p>
				</td>
			</tr>

			<tr>
				<td class="wpmm_meta_table">
				    <?php _e("Animation Iteration Count", APMM_PRO_TD); ?>
				</td>
				<td class='apmega-value'>
			       <?php $animation_iteration_count = (isset($wpmmenu_item_meta['general_settings']['animation_iteration_count']) && $wpmmenu_item_meta['general_settings']['animation_iteration_count'] != '')?esc_attr($wpmmenu_item_meta['general_settings']['animation_iteration_count']):'';?>
				     <input type="text" value="<?php echo esc_attr($animation_iteration_count);?>" class="apmm_animation_iteration_count" 
                           placeholder="<?php _e('E.g., infinite,2,3,1,2.3',APMM_PRO_TD);?>" name="wpmm_settings[general_settings][animation_iteration_count]"/>
                    <p class="description"><?php _e('Fill the animation Iteration count in number such as 2,3. You can also use "infinite" word instead of number which let the
                            animation to repeat forever.',APMM_PRO_TD);?></p>
				</td>
			</tr>


				 <tr>
			<td class="wpmm_meta_table">
			   <?php _e("Menu Visibility on User Based", APMM_PRO_TD); ?>
			</td>
			<td>
			   <input type="radio" id="always_show" name="wpmm_settings[general_settings][show_menu_to_users]"
				<?php if (isset($wpmmenu_item_meta['general_settings']['show_menu_to_users']) && $wpmmenu_item_meta['general_settings']['show_menu_to_users']=="always") echo "checked";?>
				value="always"><label for="always_show"><?php _e('Always',APMM_PRO_TD);?></label><br/>
				<input type="radio" id="loggedinshow" name="wpmm_settings[general_settings][show_menu_to_users]"
				<?php if (isset($wpmmenu_item_meta['general_settings']['show_menu_to_users']) && $wpmmenu_item_meta['general_settings']['show_menu_to_users']=="onlyloggedin_users") echo "checked";?>
				value="onlyloggedin_users"><label for="loggedinshow"><?php _e('Show Only To Logged In Users',APMM_PRO_TD);?></label><br/>
				<input type="radio" id="loggedoutshow"  name="wpmm_settings[general_settings][show_menu_to_users]"
				<?php if (isset($wpmmenu_item_meta['general_settings']['show_menu_to_users']) && $wpmmenu_item_meta['general_settings']['show_menu_to_users']=="onlyloggedout_users") echo "checked";?>
				value="onlyloggedout_users"><label for="loggedoutshow"><?php _e('Show Only To Logged Out Users',APMM_PRO_TD);?></label><br/>
			    <p class="description"><?php _e("Choose any one to show this menu as per logged in users , logged out users or show always.", APMM_PRO_TD); ?></p>
			</td>
			</tr> 

			<tr class="hide_fortopmenu">
			<td class="wpmm_meta_table"><label for="activate_view_more_button"><?php _e("Activate View More Button", APMM_PRO_TD) ?></label></td>
			  <td> 
			       <div class="wpmm-switch">
			          <input type='checkbox' class='wpmm_menu_settingss' id="activate_view_more_button" 
			          name='wpmm_settings[general_settings][activate_view_more_btn]' value='true' <?php echo checked($wpmmenu_item_meta['general_settings']['activate_view_more_btn'],'true', false ); ?>/>
			          <label for="activate_view_more_button"></label>
                    </div>
                      <p class="description"><?php _e("In order to display or set view more or read more button to this menu ,
                      you need to activate view more button.", APMM_PRO_TD); ?></p>
			  </td>
			</tr>

			<tr class="show_for_tabbed">
			<td class="wpmm_meta_table"><label for="choose_trigger_effect"><?php _e("Choose Trigger Effect", APMM_PRO_TD) ?></label></td>
			  <td> 
			  <?php $choose_trigger_effect = (isset($wpmmenu_item_meta['general_settings']['choose_trigger_effect']) && $wpmmenu_item_meta['general_settings']['choose_trigger_effect'] == "onclick")?"onclick":"onhover"; ?>
			        <select name="wpmm_settings[general_settings][choose_trigger_effect]" class="wpmm-selection">
                               <option value="onhover" <?php if($choose_trigger_effect == "onhover") echo "selected='selected'";?>><?php _e('On Hover',APMM_PRO_TD);?></option>
                               <option value="onclick" <?php if($choose_trigger_effect == "onclick") echo "selected='selected'";?>><?php _e('On Click',APMM_PRO_TD);?></option>
                    </select>
                      <p class="description"><?php _e("Choose Tabbed Event as clicked or on hover effect.", APMM_PRO_TD); ?></p>
			  </td>
			</tr>

		  <tr class="show_for_tabbed">
				<td class="wpmm_meta_table">
				    <?php _e("Tabbed Content Animation", APMM_PRO_TD); ?>
				</td>
				<td class='apmega-value'>
			       <?php $tabbed_animation = (isset($wpmmenu_item_meta['general_settings']['tabbed_animation']) && $wpmmenu_item_meta['general_settings']['tabbed_animation'] != '')?esc_attr($wpmmenu_item_meta['general_settings']['tabbed_animation']):'none';?>
				       <select name="wpmm_settings[general_settings][tabbed_animation]" class="wpmm-selection">
                               <option value="none" <?php if($tabbed_animation == "none") echo "selected='selected'";?>><?php _e('None',APMM_PRO_TD);?></option>
                               <option value="mybounce" <?php if($tabbed_animation == "mybounce") echo "selected='selected'";?>><?php _e('Bounce',APMM_PRO_TD);?></option>
                               <option value="flash" <?php if($tabbed_animation == "flash") echo "selected='selected'";?>><?php _e('Flash',APMM_PRO_TD);?></option>
                               <option value="shake" <?php if($tabbed_animation == "shake") echo "selected='selected'";?>><?php _e('Shake',APMM_PRO_TD);?></option>
                               <option value="swing" <?php if($tabbed_animation == "swing") echo "selected='selected'";?>><?php _e('Swing',APMM_PRO_TD);?></option>
                               <option value="tada" <?php if($tabbed_animation == "tada") echo "selected='selected'";?>><?php _e('Tada',APMM_PRO_TD);?></option>
                               <option value="bounceIn" <?php if($tabbed_animation == "bounceIn") echo "selected='selected'";?>><?php _e('BounceIn',APMM_PRO_TD);?></option>
                               <option value="flipInX" <?php if($tabbed_animation == "flipInX") echo "selected='selected'";?> ><?php _e('FlipInX',APMM_PRO_TD);?></option>
                               <option value="flipInY" <?php if($tabbed_animation == "flipInY") echo "selected='selected'";?> ><?php _e('FlipInY',APMM_PRO_TD);?></option>
                               <option value="slideInUp" <?php if($tabbed_animation == "slideInUp") echo "selected='selected'";?>><?php _e('SlideInUp',APMM_PRO_TD);?></option>
                               <option value="slideInDown" <?php if($tabbed_animation == "slideInDown") echo "selected='selected'";?>><?php _e('SlideInDown',APMM_PRO_TD);?></option>
                               <option value="fadeInDown" <?php if($tabbed_animation == "fadeInDown") echo "selected='selected'";?>><?php _e('FadeInDown',APMM_PRO_TD);?></option>
                               <option value="fadeInUp" <?php if($tabbed_animation == "fadeInUp") echo "selected='selected'";?>><?php _e('FadeInUp',APMM_PRO_TD);?></option>
                           </select>
                            <p class="description"><?php _e('Choose specific animation type for this tabbed content.Default is set as FadeInDown. None will disable the animation.',APMM_PRO_TD);?></p>
				</td>
			</tr>
			
			</table>
  </div>

</div>
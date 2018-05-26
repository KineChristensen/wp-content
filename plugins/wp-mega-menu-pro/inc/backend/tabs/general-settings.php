<?php defined('ABSPATH') or die("No script kiddies please!");?>
<div class="apmega_left_content_wrapper general_settings">

     <div class="apmm-header1 wpmega-general"><?php _e("General Settings", APMM_PRO_TD); ?></div>
                <table>
                    <tr>
                        <td class='apmega-name'>
                            <?php _e("Event Behaviour", APMM_PRO_TD); ?>
                            <p class='description'>
                                <?php _e("Define what should happen when the event is set to 'click'. This also applies to mobiles.", APMM_PRO_TD); ?>
                            </p>
                        </td>
                        <td class='apmega-value'>
                            <select name='advanced_click' class="wpmm-selection">
                                <option value='click_submenu' <?php if($advanced_click == "click_submenu") echo "selected='selected'";?>><?php _e("Open Submenu on first click and close on second click.", APMM_PRO_TD); ?></option>
                                <option value='follow_link' <?php if($advanced_click == "follow_link") echo "selected='selected'";?>><?php _e("Open submenu on first click and follow link on second click.", APMM_PRO_TD); ?></option>
                            </select>
                            <p class='description'>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td class='apmega-name'>
                           <?php _e("Menu Label Animation Type", APMM_PRO_TD); ?>
                           <p class="description"><?php _e('Choose default animation type for menu label such as Hot!,New!.Default is set as None which will disable animation.',APMM_PRO_TD);?></p>
                        </td>
                        <td class='apmega-value'>
                           <select name="mlabel_animation_type" class="wpmm-selection">
                               <option value="none" <?php if($mlabel_animation_type == "none") echo "selected='selected'";?>><?php _e('None',APMM_PRO_TD);?></option>
                               <option value="mybounce" <?php if($mlabel_animation_type == "mybounce") echo "selected='selected'";?>><?php _e('Bounce',APMM_PRO_TD);?></option>
                               <option value="flash" <?php if($mlabel_animation_type == "flash") echo "selected='selected'";?>><?php _e('Flash',APMM_PRO_TD);?></option>
                               <option value="shake" <?php if($mlabel_animation_type == "shake") echo "selected='selected'";?>><?php _e('Shake',APMM_PRO_TD);?></option>
                               <option value="swing" <?php if($mlabel_animation_type == "swing") echo "selected='selected'";?>><?php _e('Swing',APMM_PRO_TD);?></option>
                               <option value="tada" <?php if($mlabel_animation_type == "tada") echo "selected='selected'";?>><?php _e('Tada',APMM_PRO_TD);?></option>
                               <option value="bounceIn" <?php if($mlabel_animation_type == "bounceIn") echo "selected='selected'";?>><?php _e('BounceIn',APMM_PRO_TD);?></option>
                               <option value="flipInX" <?php if($mlabel_animation_type == "flipInX") echo "selected='selected'";?> ><?php _e('FlipInX',APMM_PRO_TD);?></option>
                               <option value="flipInY" <?php if($mlabel_animation_type == "flipInY") echo "selected='selected'";?> ><?php _e('FlipInY',APMM_PRO_TD);?></option>
                               <option value="slideInUp" <?php if($mlabel_animation_type == "slideInUp") echo "selected='selected'";?>><?php _e('SlideInUp',APMM_PRO_TD);?></option>
                               <option value="slideInDown" <?php if($mlabel_animation_type == "slideInDown") echo "selected='selected'";?>><?php _e('SlideInDown',APMM_PRO_TD);?></option>
                           </select>
                        </td>
                    </tr>

                  <tr>
                        <td class='apmega-name'>
                           <?php _e("Animation Duration", APMM_PRO_TD); ?>
                           <p class="description"><?php _e('Choose the animation duration time in second. Default value set to 3s.',APMM_PRO_TD);?></p>
                        </td>
                        <td class='apmega-value'>
                          <input type="number" value="<?php echo esc_attr($animation_duration);?>" class="apmm_animation_duration" 
                           placeholder="1" name="animation_duration"/>
                        </td>
                    </tr>
                    <tr>
                        <td class='apmega-name'>
                           <?php _e("Animation Delay", APMM_PRO_TD); ?>
                           <p class="description"><?php _e('Choose the animation delay time in second.Default value set to 2s.',APMM_PRO_TD);?></p>
                        </td>
                        <td class='apmega-value'>
                          <input type="number" value="<?php echo esc_attr($animation_delay);?>" class="apmm_animation_delay" 
                           placeholder="1" name="animation_delay"/>
                        </td>
                    </tr>
                     <tr>
                        <td class='apmega-name'>
                           <?php _e("Animation Iteration Count", APMM_PRO_TD); ?>
                           <p class="description"><?php _e('Fill the animation Iteration count in number such as 2,3. You can also use "infinite" word instead of number which let the
                            animation to repeat forever.',APMM_PRO_TD);?></p>
                           <p class="description"><?php _e('The number of times the animation should repeat; this is 1 by default. Negative values are invalid. You may specify non-integer values to play part of an animation cycle (for example 0.5 will play half of the animation cycle).',APMM_PRO_TD);?></p>
                        </td>
                        <td class='apmega-value'>
                          <input type="text" value="<?php echo esc_attr($animation_iteration_count);?>" class="apmm_animation_iteration_count" 
                           placeholder="<?php _e('E.g., infinite,2,3,1,2.3',APMM_PRO_TD);?>" name="animation_iteration_count"/>
                        </td>
                    </tr>

                       <!-- woocommerce cart total display start -->
                    <tr>
                        <td class='apmega-name'>
                            <?php _e("Woocommerce Cart Display", APMM_PRO_TD) ?>
                            <p class='description'>
                                <?php _e("Choose Woocommerce Cart Display type for menu replaced as woocommerce cart for each menu items.", APMM_PRO_TD); ?>
                             <br/><?php _e('Set common settings for each menu for menu replacement settings.',APMM_PRO_TD);?>
                            </p>
                        </td>
                        <td class='apmega-value'>
                         <select name="choose_woo_cart_display" id="choose_woo_cart_display">
                          <option value="icon_only"  <?php if($choose_woo_cart_display == "icon_only") echo "selected='selected'";?>><?php _e('Icon Only',APMM_PRO_TD);?></option>
                          <option value="item_only"  <?php if($choose_woo_cart_display == "item_only") echo "selected='selected'";?>><?php _e('Icon & Items Only',APMM_PRO_TD);?></option>
                          <option value="price_only"  <?php if($choose_woo_cart_display == "price_only") echo "selected='selected'";?>><?php _e('Icon & Price Only',APMM_PRO_TD);?></option>   
                          <option value="both_pi"  <?php if($choose_woo_cart_display == "both_pi") echo "selected='selected'";?>><?php _e('Icon Both Price and Items',APMM_PRO_TD);?></option>   
                        </select>
                        </td>
                    </tr>
                     <tr>
                        <td class='apmega-name'>
                            <?php _e("Woocommerce Cart Display Layout", APMM_PRO_TD) ?>
                            <p class='description'>
                               <?php _e('Note: Fill the type of layout you want to display for woocommerce cart on menu and use #tag method such as 
                           #price to display price and #item_count to display total icon count. You can fill any layout as you wanted
                          such as #price(#item_count) which is display as $32(2) display type where 32 is total price and total item count is 2.',APMM_PRO_TD);?>
                            </p>
                        </td>
                        <td class='apmega-value'>
                        <input type="text" name="cart_display_pattern" 
                        value="<?php echo esc_attr($cart_display_pattern);?>" 
                        placeholder="#item_count items - #price"/>
                        </td>
                    </tr>

                       <tr>
                        <td class='apmega-name'>
                          <label for="enable_rtl"><?php _e("Enable RTL", APMM_PRO_TD); ?></label>
                            <p class='description'>
                                <?php _e("Enable or disable rtl for mega menu.", APMM_PRO_TD); ?>
                            </p>
                        </td>
                        <td class='apmega-value'>
                           <div class="wpmm-switch">
                             <input type="checkbox" name="enable_rtl" id="enable_rtl" value="1" <?php if($enable_rtl  == 1) echo "checked";?>/>
                             <label for="enable_rtl"></label>
                           </div>
                        </td>
                    </tr>
             
                </table>
    <div class="apmm-header1 wpmega-mob"><?php _e("Mobile Settings", APMM_PRO_TD); ?></div>
            <table>
                    <tr>
                        <td class='apmega-name'>
                          <label for="enable_wpmegamenu"><?php _e("Enable WP Mega Menu Pro on Mobile", APMM_PRO_TD); ?></label>
                            <p class='description'>
                                <?php _e("Enable or disable submenu on mobile version.", APMM_PRO_TD); ?>
                            </p>
                        </td>
                        <td class='apmega-value'>
                           <div class="wpmm-switch">
                             <input type="checkbox" name="enable_mobile" id="enable_wpmegamenu" value="1" <?php if($enable_mobile  == 1) echo "checked";?>/>
                             <label for="enable_wpmegamenu"></label>
                           </div>
                        </td>
                    </tr>
                      <tr>
                        <td class='apmega-name'>
                          <label for="disable_submenu_retractor"><?php _e("Disable Submenu Retractor", APMM_PRO_TD); ?></label>
                            <p class='description'>
                                <?php _e("Check to disable submenu retractor close button at last of menu after toggle open on mobile version.", APMM_PRO_TD); ?>
                            </p>
                        </td>
                        <td class='apmega-value'>
                         <div class="wpmm-switch">
                            <input type="checkbox" name="disable_submenu_retractor" id="disable_submenu_retractor" value="1" <?php if($disable_submenu_retractor  == 1) echo "checked";?>/>
                            <label for="disable_submenu_retractor"></label>
                           </div>
                        </td>
                    </tr>
                    <tr>
                        <td class='apmega-name'>
                            <?php _e("Toggle Behavior", APMM_PRO_TD); ?>
                           <p class='description'>
                                <?php _e("Standard toggle will open sub menus even if another menu is clicked and 
                                accordion toggle will close opened submenus automatically when another one is open.", APMM_PRO_TD); ?>
                            </p>
                        </td>
                        <td class='apmega-value'>
                            <select name='mobile_toggle_option' class="wpmm-selection">
                                <option value='toggle_standard' <?php if($mobile_toggle_option == "toggle_standard") echo "selected='selected'";?>><?php _e("Standard", APMM_PRO_TD); ?></option>
                                <option value='toggle_accordion' <?php if($mobile_toggle_option == "toggle_accordion") echo "selected='selected'";?>><?php _e("Accordion", APMM_PRO_TD); ?></option>
                            <select>
                          
                        </td>
                    </tr>
                      <tr>
                        <td class='apmega-name'>
                            <?php _e("Mobile Responsive Breakpoint", APMM_PRO_TD); ?>
                           <p class='description'>
                                <?php _e("Note: Set up responsive breakpoint for only pre available template. Default will always be 910px if left empty.
                                Also for custom template, you need to setup from its specific template edit page in Mobile Responsive Toggle Section.", APMM_PRO_TD); ?>
                            </p>
                        </td>
                        <td class='apmega-value'>
                          <input type="number" name="pre_responsive_bp" value="<?php echo $pre_responsive_bp;?>" placeholder="910">
                        </td>
                    </tr>

                    <tr>
                        <td class='apmega-name'>
                            <?php _e("Toggle Menu Close Icon", APMM_PRO_TD); ?>
                           <p class='description'>
                                <?php _e("Choose toggle close icon for responsive menubar.", APMM_PRO_TD); ?>
                            </p>
                        </td>
                        <td class='apmega-value'>
                            <!-- <div class="toggle_menu_icons"></div> -->
                           <div class="wp-mega-toggle"> 
                            <div class="toggle_menu_icons" id="close">
                              <span class="dash-closedmenu"><i class="<?php echo esc_attr($close_menu_icon);?>"></i></span>
                            </div>
                            <input type="hidden" name="close_menu_icon" id="close_menu_icon" value="<?php echo esc_attr($close_menu_icon);?>"/>
                            <div class="menulistsicons_close">
                            <ul>
                               <li class="wpmm-menuicon">
                                <span id="select2-chosen-66" class="select2-chosen">
                                <i class="dashicons dashicons-menu"></i>
                                </span></li>
                                 <li class="wpmm-menuicon"><span id="select2-chosen-66" class="select2-chosen">
                                <i class="dashicons dashicons-editor-justify"></i>
                                </span></li>
                                 <li class="wpmm-menuicon"><span id="select2-chosen-66" class="select2-chosen">
                                <i class="dashicons dashicons-no"></i>
                                </span></li>
                                 <li class="wpmm-menuicon"><span id="select2-chosen-66" class="select2-chosen">
                                <i class="dashicons dashicons-no-alt"></i>
                                </span></li>
                                 <li class="wpmm-menuicon"><span id="select2-chosen-66" class="select2-chosen">
                                <i class="dashicons dashicons-arrow-up"></i>
                                </span></li>
                                 <li class="wpmm-menuicon"><span id="select2-chosen-66" class="select2-chosen">
                                <i class="dashicons dashicons-arrow-up-alt"></i>
                                </span></li>
                                 <li class="wpmm-menuicon"><span id="select2-chosen-66" class="select2-chosen">
                                <i class="dashicons  dashicons-plus-alt"></i>
                                </span></li>
                                 <li class="wpmm-menuicon"><span id="select2-chosen-66" class="select2-chosen">
                                <i class="dashicons dashicons-arrow-down-alt2"></i>
                                </span></li>
                              </ul>
                            </div>
                         </div>
                          
                        </td>
                    </tr>


                         <tr>
                        <td class='apmega-name'>
                            <?php _e("Toggle Menu Open Icon", APMM_PRO_TD); ?>
                           <p class='description'>
                                <?php _e("Choose toggle open icon for responsive menubar.", APMM_PRO_TD); ?>
                            </p>
                        </td>
                        <td class='apmega-value'>
                           <div class="wp-mega-toggle"> 
                             <div class="toggle_menu_icons" id="open">
                              <span class="dash-openmenu"><i class="<?php echo esc_attr($open_menu_icon);?>"></i></span>
                            </div>
                            <input type="hidden" name="open_menu_icon" id="open_menu_icon" value="<?php echo esc_attr($open_menu_icon);?>"/>

                            <div class="menulistsicons_open">
                            <ul>
                                <li class="wpmm-menuicon">
                                <span id="select2-chosen-66" class="select2-chosen">
                                <i class="dashicons dashicons-menu"></i>
                                </span>
                                </li>
                                 <li class="wpmm-menuicon">
                                 <span id="select2-chosen-66" class="select2-chosen">
                                <i class="dashicons dashicons-editor-justify"></i>
                                </span></li>
                                  <li class="wpmm-menuicon">
                                  <span id="select2-chosen-66" class="select2-chosen">
                                <i class="dashicons dashicons-no"></i>
                                </span></li>
                                 <li class="wpmm-menuicon">
                                 <span id="select2-chosen-66" class="select2-chosen">
                                <i class="dashicons dashicons-no-alt"></i>
                                </span></li>
                                 <li class="wpmm-menuicon">
                                 <span id="select2-chosen-66" class="select2-chosen">
                                <i class="dashicons dashicons-arrow-up"></i>
                                </span></li>
                              <li class="wpmm-menuicon">
                                <span id="select2-chosen-66" class="select2-chosen">
                                <i class="dashicons dashicons-arrow-up-alt"></i>
                                </span></li>
                                 <li class="wpmm-menuicon">
                                 <span id="select2-chosen-66" class="select2-chosen">
                                <i class="dashicons  dashicons-plus-alt"></i>
                                </span></li>
                                 <li class="wpmm-menuicon">
                                 <span id="select2-chosen-66" class="select2-chosen">
                                <i class="dashicons dashicons-arrow-down-alt2"></i>
                                </span></li>
                                </ul>
                            </div>

                           </div>

                          
                        </td>
                    </tr>

                   
                </table>

</div>
 <table class="wpmm-settings-box">
                      <tr>
                      <td><label for="apmegamenu_enabled_<?php echo $location;?>"><?php _e("Enable", APMM_PRO_TD) ?></label></td>
                          <td> 
                           <div class="wpmm-switch">
                              <input type='checkbox' class='apmegamenu_enabled' 
                              name='apmegamenu_meta[<?php echo $location ?>][enabled]' id="apmegamenu_enabled_<?php echo $location;?>" value='1' <?php checked( isset( $menu_general_settings[$location]['enabled'] ) ); ?>/>
                             <label for="apmegamenu_enabled_<?php echo $location;?>"></label>
                           </div>
                          </td>
                       </tr>

                       <tr>
                        <td class='apmega-name'>
                            <?php _e("Orientation", APMM_PRO_TD); ?>
                        </td>
                        <td class='apmega-value'>
                            <select name='apmegamenu_meta[<?php echo $location ?>][orientation]' class="select_fields_wpmm wpmm-orientation">
                                <option value='horizontal' <?php selected( isset( $menu_general_settings[$location]['orientation'] ) && $menu_general_settings[$location]['orientation'] == 'horizontal'); ?>><?php _e("Horizontal", APMM_PRO_TD); ?></option>
                                <option value='vertical' <?php selected( isset( $menu_general_settings[$location]['orientation'] ) && $menu_general_settings[$location]['orientation'] == 'vertical'); ?>><?php _e("Vertical", APMM_PRO_TD); ?></option>
                            <select>
                          
                        </td>
                       </tr>

                        <tr class="wpmm_show_valigntype" style="display:none;">
                        <td class='apmega-name'>
                            <?php _e("Vertical Alignment Type", APMM_PRO_TD); ?>
                        </td>
                        <td class='apmega-value'>
                            <select name='apmegamenu_meta[<?php echo $location ?>][vertical_alignment_type]' class="select_fields_wpmm">
                                <option value='left' <?php selected( isset( $menu_general_settings[$location]['vertical_alignment_type'] ) && $menu_general_settings[$location]['vertical_alignment_type'] == 'left'); ?>><?php _e("Left", APMM_PRO_TD); ?></option>
                                <option value='right' <?php selected( isset( $menu_general_settings[$location]['vertical_alignment_type'] ) && $menu_general_settings[$location]['vertical_alignment_type'] == 'right'); ?>><?php _e("Right", APMM_PRO_TD); ?></option>
                            <select>
                          
                        </td>
                       </tr>

                       <tr>
                        <td class='apmega-name'>
                            <?php _e("Trigger Effect", APMM_PRO_TD); ?>
                         
                        </td>
                        <td class='apmega-value'>
                            <select name='apmegamenu_meta[<?php echo $location ?>][trigger_option]' class="select_fields_wpmm">
                                <option value='onhover' <?php selected( isset( $menu_general_settings[$location]['trigger_option'] ) && $menu_general_settings[$location]['trigger_option'] == 'onhover'); ?>><?php _e("Hover", APMM_PRO_TD); ?></option>
                                <!-- <option value='hover_indent' < ?php selected( isset( $menu_general_settings[$location]['trigger_option'] ) && $menu_general_settings[$location]['trigger_option'] == 'hover_indent'); ?>><?php _e("Hover Indent", APMM_PRO_TD); ?></option> -->
                                <option value='onclick' <?php selected( isset( $menu_general_settings[$location]['trigger_option'] ) && $menu_general_settings[$location]['trigger_option'] == 'onclick'); ?>><?php _e("Click", APMM_PRO_TD); ?></option>
                            <select>
                          
                        </td>
                       </tr>
                          <tr>
                        <td class='apmega-name'>
                            <?php _e("Transition", APMM_PRO_TD); ?>
                       
                        </td>
                        <td class='apmega-value'>
                            <select name='apmegamenu_meta[<?php echo $location ?>][effect_option]' class="select_fields_wpmm">
                               
                                <option value='fade' <?php selected( isset( $menu_general_settings[$location]['effect_option'] ) && $menu_general_settings[$location]['effect_option'] == 'fade'); ?>><?php _e("Fade", APMM_PRO_TD); ?></option>
                                <option value='slide' <?php selected( isset( $menu_general_settings[$location]['effect_option'] ) && $menu_general_settings[$location]['effect_option'] == 'slide'); ?>><?php _e("Slide", APMM_PRO_TD); ?></option>
                               
                            <select>
                          
                        </td>
                    </tr>
                <tr class="themetype">
                <td><?php _e("Choose Theme Type", APMM_PRO_TD); ?></td>
                 <?php        
                        $available_skin_themes = get_option('apmm_pro_register_skin');
                        // echo "<pre>";
                        // print_r($menu_general_settings[$location]['theme_type']);
                        ?>

        
                <td>
                   <select name="apmegamenu_meta[<?php echo $location;?>][theme_type]" class="wpmm_theme_type">
                      <option value="available_skins" <?php selected( isset( $menu_general_settings[$location]['theme_type'] ) && $menu_general_settings[$location]['theme_type'] == 'available_skins'); ?>><?php _e('Available Skins',APMM_PRO_TD);?></option>
                      <option value="custom_themes" <?php selected( isset( $menu_general_settings[$location]['theme_type'] ) && $menu_general_settings[$location]['theme_type'] == 'custom_themes'); ?>><?php _e('Custom Themes',APMM_PRO_TD);?></option>  
                    </select>
                </td>
                </tr>
                <tr class="wpmm_show_themes" style="display:none;">
                  <td><?php _e("Custom Theme", APMM_PRO_TD); ?></td>
                  <td>
                  <?php $ap_theme_object = new AP_Theme_Settings();
                              $themes = $ap_theme_object->get_custom_theme_data('');
                              ?>
                      <select name='apmegamenu_meta[<?php echo $location ?>][theme]'
                      class="select_fields_wpmm">
                          <?php
                              $selected_theme = isset( $menu_general_settings[$location]['theme'] ) ? $menu_general_settings[$location]['theme'] : 'default';

                              foreach ( $themes as $key => $theme ) {
                                $theme_id = $theme->theme_id;
                                $theme_title = $theme->title;
                               ?>
                               <option value='<?php echo $theme_id;?>' <?php echo selected( $selected_theme, $theme_id );?>><?php echo $theme_title;?></option>
                              <?php
                              }
                          ?>
                      </select>
                  </td>
                 </tr>
                 <tr class="wpmm_show_skins" style="display:none;">
                   <td><?php _e("Available Skin", APMM_PRO_TD); ?></td>
                   <td>
                  <select name="apmegamenu_meta[<?php echo $location;?>][available_skin]" 
                   class="select_fields_wpmm">
                        <?php if(isset($available_skin_themes) && !empty($available_skin_themes)){
                          $selected_skin = isset( $menu_general_settings[$location]['available_skin'] ) ? $menu_general_settings[$location]['available_skin'] : 'black-white';
                          foreach ($available_skin_themes as $key => $value) {?>
                           <option value="<?php echo $value['id'];?>" <?php echo selected( $selected_skin, $value['id'] );?>><?php _e($value['title'],APMM_PRO_TD);?></option>
                          <?php }
                        } ?>
                      </select>
                   </td>

                 </tr>

                   <tr>
                        <td class='apmega-name'>
                            <?php _e("Mobile Menu", APMM_PRO_TD); ?>

                        </td>
                        <td class='apmega-value'>
                        <?php $menus = get_registered_nav_menus(); ?>
                               <select name="apmegamenu_meta[<?php echo $location;?>][mobile_menu_location]" 
                   class="apmmpro-menu-locations-lists">
                                <?php  if ( count ( $menus ) ) {
                                   $selected_mobile_menu = isset( $menu_general_settings[$location]['mobile_menu_location'] ) ? $menu_general_settings[$location]['mobile_menu_location'] : '';
                                 foreach ( $menus as $location => $description ) { ?>
                                  <option value="<?php echo $location;?>" <?php echo selected( $selected_mobile_menu, $location );?>><?php _e($description,APMM_PRO_TD);?></option>
                                <?php }
                                } ?>
                              </select>

                         
                        </td>

                    </tr>

</table>
  <p class="description"><?php _e('Set Mobile Menu for this menu location.',APMM_PRO_TD);?></p>
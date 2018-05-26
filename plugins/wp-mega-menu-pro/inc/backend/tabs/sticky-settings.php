<?php defined('ABSPATH') or die("No script kiddies please!");?>
<div class="apmega_left_content_wrapper general_settings">

     <div class="apmm-header1 wpmega-sticky"><?php _e("Sticky Settings", APMM_PRO_TD); ?></div>
                <table>
                    <tr>
                        <td class='apmega-name'>
                            <label for="activestickymenu"><?php _e("Enable Sticky Menu", APMM_PRO_TD); ?></label>
                            <p class='description'>
                                <?php _e("Enable Sticky Menu for specific theme location.", APMM_PRO_TD); ?>
                            </p>
                        </td>
                         <td class='apmega-value'>
                          <div class="wpmm-switch">
                             <input type="checkbox" name="active_sticky_menu" id="activestickymenu" value="1" <?php if($activestickymenu == 1) echo "checked='checked'";?> />
                              <label for="activestickymenu"></label>
                           </div>
                        </td>
                    </tr>
                    <tr>
                        <td class='apmega-name'>
                            <?php _e("Choose Theme Location", APMM_PRO_TD); ?>
                            <p class='description'>
                                <?php _e("Here choose theme location on which you want sticky menu on page scroll.", APMM_PRO_TD); ?>
                            </p>
                        </td>
                        <?php  $menus = get_registered_nav_menus(); ?>

                        <td class='apmega-value'>
                            <select name='sticky_theme_location' class="wpmm-selection">
                                 <option value=""  <?php if($sticky_theme_location == ""){echo "selected='selected'";}?>><?php _e('--Select Theme Location--',APMM_PRO_TD);?></option>
                                 <?php  if ( count ( $menus ) ) {
                                     foreach ( $menus as $location => $description ) { 
                                        ?>
                                      <option value="<?php echo $location;?>" <?php if($sticky_theme_location ==  $location) echo "selected='selected'";?>><?php _e($description,APMM_PRO_TD);?></option>
                                    <?php }
                                    } ?>
                            <select>
                        </td>
                    </tr>

                    <tr>
                        <td class='apmega-name'>
                            <label for="sticky_on_mobile"><?php _e("Enable Sticky Menu On Mobile", APMM_PRO_TD); ?></label>
                            <p class='description'>
                                <?php _e("Enable Sticky Menu on Mobile.", APMM_PRO_TD); ?>
                            </p>
                        </td>
                         <td class='apmega-value'>
                          <div class="wpmm-switch">
                             <input type="checkbox" name="sticky_on_mobile" id="sticky_on_mobile" value="1" <?php if($sticky_on_mobile == 1) echo "checked='checked'";?> />
                              <label for="sticky_on_mobile"></label>
                           </div>
                        </td>
                    </tr>

                      <tr>
                        <td class='apmega-name'>
                            <label for="stickyopacity"><?php _e("Sticky Opacity", APMM_PRO_TD); ?></label>
                            <p class='description'>
                                <?php _e("Important Note: Assign Sticky Opacity to 1 to show menu on page scroll. 
                                If value is set to 0 then the menu will be hidden on page scroll.", APMM_PRO_TD); ?>
                            </p>
                        </td>
                         <td class='apmega-value'>
                             <input type="text" name="sticky_opacity" id="stickyopacity" value="<?php echo $sticky_opacity;?>" placeholder="1"/>
                           </div>
                        </td>
                    </tr>

                      <tr>
                        <td class='apmega-name'>
                            <label for="stickyzindex"><?php _e("Sticky Zindex", APMM_PRO_TD); ?></label>
                            <p class='description'>
                                <?php _e("Assign Sticky Zindex.Default value set to 999.", APMM_PRO_TD); ?>
                            </p>
                        </td>
                         <td class='apmega-value'>
                             <input type="text" name="sticky_zindex" id="stickyzindex" value="<?php echo $sticky_zindex;?>" placeholder="999"/>
                           </div>
                        </td>
                    </tr>
                              <tr>
                        <td class='apmega-name'>
                            <label for="sticky_offset"><?php _e("Sticky Offset", APMM_PRO_TD); ?></label>
                            <p class='description'>
                                <?php _e("Assign Sticky Offset.Default value set to 0px.", APMM_PRO_TD); ?>
                            </p>
                        </td>
                         <td class='apmega-value'>
                             <input type="text" name="sticky_offset" id="sticky_offset" placeholder="0px" value="<?php echo $sticky_offset;?>"/>
                           </div>
                        </td>
                    </tr>


                   
                </table>

</div>
<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<div class="main_top_section">
  <div class="wpmm_top_section">
      <div class="wpmm_selection_type">
      <label for='wpmmmm_enable_mega_menu'><?php _e("Sub menu display mode",APMM_PRO_TD);?></label>
        <select id='wpmm_enable_mega_menu' name="wpmm_settings[menu_type]" class="wpmm-selection" title="<?php _e('Choose Menu Type.',APMM_PRO_TD);?>">
           <option value='flyout' <?php echo selected( $wpmmenu_item_meta['menu_type'], 'flyout', false );?>><?php _e("Flyout Menu", APMM_PRO_TD);?></option>
           <option id='wpmegamenu' value="megamenu" <?php echo selected( $wpmmenu_item_meta['menu_type'], 'megamenu', false );?>><?php _e("Mega Menu",APMM_PRO_TD);?></option>
        </select>
      </div>
      <div class="wpmm_row_selection wpmm_grp_select">
      <label for='wpmmm_choose_group'><?php _e("Choose Group",APMM_PRO_TD);?></label>
      <select id='wpmmm_choose_group' name='wpmm_settings[group_type]' title="<?php _e('Choose Group Type.',APMM_PRO_TD);?>">
           <option value='single' <?php echo selected( $wpmmenu_item_meta['group_type'], 'single', false );?>><?php _e('Single Group',APMM_PRO_TD);?></option>
           <option value='multiple' <?php echo selected( $wpmmenu_item_meta['group_type'], 'multiple', false );?>><?php _e('Multiple Group',APMM_PRO_TD);?></option>
        </select>
      </div>
      <div class="main_widget">
      <div class="multiple_button" style="display:none;"><input class="button-primary add-mulitple-group" value="<?php _e('ADD GROUP',APMM_PRO_TD);?>" type="button">
      <input type="button" class="button button-primary wpmm-group-remover" value="<?php _e('REMOVE GROUP',APMM_PRO_TD); ?>" 
       data-confirm-message="<?php _e( 'Are you sure you want to delete this Group?', APMM_PRO_TD ); ?>"/>
      <div class="wpmm-add-widget-tool_by_grp"><i class="fa fa-plus" aria-hidden="true"></i><?php _e('Add Widgets',APMM_PRO_TD);?></div>
       </div>
      </div>
    </div>
</div>

<div class="clear" style="margin-bottom:10px;"></div>

<div class="wpmm_mega_settings wpmm_single_group_section">
  
   <div class="wpmm_top_section">
    <div class="wpmm_selection_type">
    </div>
    <div class="wpmm_row_selection">
      <label for='wpmm_choose_total_columns'><?php _e("Choose Columns",APMM_PRO_TD);?></label>
      <select id='wpmm_number_of_columns' name='wpmm_settings[panel_columns]' class="wpmm-selection" title="<?php _e('Choose Column for Single Group.',APMM_PRO_TD);?>">
           <option value='1' <?php echo selected( $wpmmenu_item_meta['panel_columns'], 1, false );?>>1 <?php _e('Columns',APMM_PRO_TD);?></option>
           <option value='2' <?php echo selected( $wpmmenu_item_meta['panel_columns'], 2, false );?>>2 <?php _e('Columns',APMM_PRO_TD);?></option>
           <option value='3' <?php echo selected( $wpmmenu_item_meta['panel_columns'], 3, false );?>>3 <?php _e('Columns',APMM_PRO_TD);?></option>
           <option value='4' <?php echo selected( $wpmmenu_item_meta['panel_columns'], 4, false );?>>4 <?php _e('Columns',APMM_PRO_TD);?></option>
           <option value='5' <?php echo selected( $wpmmenu_item_meta['panel_columns'], 5, false );?>>5 <?php _e('Columns',APMM_PRO_TD);?></option>
           <option value='6' <?php echo selected( $wpmmenu_item_meta['panel_columns'], 6, false );?>>6 <?php _e('Columns',APMM_PRO_TD);?></option>
           <option value='7' <?php echo selected( $wpmmenu_item_meta['panel_columns'], 7, false );?>>7 <?php _e('Columns',APMM_PRO_TD);?></option>
           <option value='8' <?php echo selected( $wpmmenu_item_meta['panel_columns'], 8, false );?>>8 <?php _e('Columns',APMM_PRO_TD);?></option>
        </select>
    </div>
     <div class="wpmm_middle_section">
    <label><h3><?php _e("Single Group Layout",APMM_PRO_TD);?></h3></label>
    </div>
    <div class="main_widget">
      <div class="wpmm-add-widget-tool"><i class="fa fa-plus" aria-hidden="true"></i><?php _e('Add Widgets',APMM_PRO_TD);?></div>
       


       <!-- widget section frame -->

      </div>
   </div>

<?php 
$grouptype = (isset($wpmmenu_item_meta['group_type']) && $wpmmenu_item_meta['group_type'] != '')?$wpmmenu_item_meta['group_type']:'single';
if(isset($wpmmenu_item_meta['menu_type'])){
 if($wpmmenu_item_meta['menu_type'] == "megamenu"){
  $class = "enabled_megamenu";
 }else{
  $class = "disabled";
 }
}else{
  $class = "disabled";
}
?>
  <div class="wpmm_add_components <?php echo $class;?>">
          <div id="wpmm_widgets_setup" class="wpmm_widgets_setup <?php echo $class;?>" data-columns="<?php echo (!isset($wpmmenu_item_meta['panel_columns']) && $wpmmenu_item_meta['panel_columns'] == '')?'6':$wpmmenu_item_meta['panel_columns'];?>">
           
         <?php 
           global $widget_object;
            //$widgets_items = new WPMM_Menu_Widget_Manager();
            $items = $widget_object->wpmm_get_widgets_and_menu_items_for_menu_id($menu_item_id, $menu_id , "single");
            

            if(isset($items)){
             
              foreach ($items as $item) { 
                 if($item['group_type'] != 'multiple' || $item['type'] == 'wpmm_menu_subitem' ){?>
                <div class="wpmm_widget_area"  id="<?php echo esc_attr( $item['id'] );?>" data-title="<?php echo esc_attr( $item['title'] );?>" 
                data-columns="<?php echo esc_attr( $item['columns'] );?>" 
                data-type="<?php echo esc_attr( $item['type'] );?>"
                 data-id="<?php echo esc_attr( $item['id'] );?>">
                <div class="widget_main_top_section">
                <div class="widget_title">
                <span class="wpmm-drag-handler"><i class="fa fa-arrows" aria-hidden="true"></i></span>
                <span class="wptitle"><?php echo esc_html( $item['title'] );?></div></span>
                <div class="widget_right_action">
                <a class="widget-option wpmm_widget-contract" title="<?php echo esc_attr( __("Contract",APMM_PRO_TD) );?>">
                <i class="fa fa-caret-left" aria-hidden="true"></i></a>
                <span class="widget-cols">
                <span class="wpmm_widget-num-cols"><?php echo esc_attr( $item['columns'] );?></span>
                <span class="wpmm_widget-of">/</span>
                <span class="wpmm_widget-total-cols"><?php echo (!isset($wpmmenu_item_meta['panel_columns']) && $wpmmenu_item_meta['panel_columns'] == '')?'6':$wpmmenu_item_meta['panel_columns'];?></span>
                </span>
                <a class="widget-option wpmm_widget-expand" title="<?php echo esc_attr( __("Expand", APMM_PRO_TD) );?>">
                <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                <a class="widget-option wpmm_widget-action" title="<?php echo esc_attr( __("Edit",APMM_PRO_TD) );?>">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                </div>
                </div>
                <div class="wpmm_widget_inner"></div>
                </div>
               
             <?php  }
           }
            }else{ ?>
                 <span class="message"><?php _e("No widgets found. Add a widget to this area using the ADD Widget Button (top right).",APMM_PRO_TD); ?></span>
            <?php }
             ?>

         </div>
  </div> 


</div>

<!-- add multiple group popup form starts here -->

<div id="wpmm-popup-wrap-<?php echo $menu_item_id;?>" class="wpmm-popup-wrap" style="display: none;">
    <div class="wpmm-overlay"></div>
    <div class="wpmm-add-form-wrap">
    <input type="hidden" id="popup_type" class="wpmm_popup_type" value="add"/>
    <input type="hidden" id="group_number" class="wpmm_group_in_number" value="1"/>
        <div class="wpmm-add-field-wrap">
            <label><?php _e( 'Group Title', APMM_PRO_TD ); ?></label>
            <div class="wpmm-field">
              <input type="text" class="wpmm-group-title" value="Group 1" placeholder="<?php _e( 'Group 1', APMM_PRO_TD ); ?>" readonly="readonly"/>
            </div> 
        </div>
        <div class="wpmm-add-field-wrap">
            <label><?php _e( 'Choose Column Number', APMM_PRO_TD ); ?></label>
            <div class="wpmm-field">
               <select id='wpmm_columns-num' name='wpmm_settings[mulitple][panel_columns]' class="wpmm-selection">
                 <option value='1'>1 <?php _e('Columns',APMM_PRO_TD);?></option>
                 <option value='2'>2 <?php _e('Columns',APMM_PRO_TD);?></option>
                 <option value='3'>3 <?php _e('Columns',APMM_PRO_TD);?></option>
                 <option value='4'>4 <?php _e('Columns',APMM_PRO_TD);?></option>
                 <option value='5'>5 <?php _e('Columns',APMM_PRO_TD);?></option>
                 <option value='6'>6 <?php _e('Columns',APMM_PRO_TD);?></option>
                 <option value='7'>7 <?php _e('Columns',APMM_PRO_TD);?></option>
                 <option value='8'>8 <?php _e('Columns',APMM_PRO_TD);?></option>
              </select>
            </div>
            <div class="wpmm-field-note"><?php _e( 'Please choose total column number for this group.', APMM_PRO_TD ); ?></div>
        </div>
        <div class="wpmm-add-field-wrap">
            <input type="button" class="wpmm-add-group-btn button-primary" value="<?php _e( 'Add Group', APMM_PRO_TD ); ?>"/>
            <span class="wpmm-ajax-loader" style="display: none"></span>
            <span class="wpmm-msg" style="display:none;"><?php _e( 'Group Created.Redirecting...' ); ?></span>
            <div class="wpmm-add-error wpmm-error" style="display: none;"></div>
        </div>
    </div>
</div>

<?php 

$menu_item_idd = (isset($menu_item_id) && $menu_item_id != '')?$menu_item_id:'';
$wpmm_widget_manager = new WPMM_Menu_Widget_Manager();
$grouplists = $wpmm_widget_manager->wpmm_get_group_details($menu_item_idd );


//  global $wpdb;
// $table_name    = $wpdb->prefix . "apmm_menugrouplists";
// $wpmm_groups   = $wpdb->get_row("SELECT * FROM $table_name where menuid = 1475");
// echo "<pre>";
// print_r($wpmm_groups);
// echo  $wpmm_groups->menuid;

//      $wpdb->query( 
//  $wpdb->prepare( 
//     "
//             DELETE FROM $table_name
//      WHERE menuid = %d",
//         $wpmm_groups['menuid']
//     )
// );
?>
<!-- multiple group layout starts here -->
<div class="wpmm_mega_settings_multiple" <?php if($grouptype == "multiple") echo ''; else echo 'style="display:none;"';?>>
        <div class="wpmm-grp-wrap">
            <ul class="wpmm-groups-lists">
              <?php if(isset($grouplists) && !empty($grouplists)){
                   $count = $grouplists->totalgroup;
                   $group_detailss = $grouplists->group_details;
                   $totalgroups = unserialize($group_detailss);
                   foreach ($totalgroups as $key => $value) {
                     $newgroup      = $value['group_no'];
                     $total_columns = $value['column'];
                      if($newgroup == 1){
                              $newclass = "wpmm-grp-active-trigger";
                          }else{
                              $newclass = '';
                          }
                    ?>

                     <li data-group-ref="<?php echo $newgroup;?>" data-columns="<?php echo $total_columns;?>" 
                      class="wpmm-group-trigger <?php echo $newclass;?>" data-group-name="Group <?php echo $newgroup;?>">
                      Group <?php echo $newgroup;?>
                      <br/><span class="wpmm-group-col">( Column <?php echo $total_columns;?>)</span>
                      <span title="<?php _e('Edit this Group',APMM_PRO_TD);?>" class="wpmm-group-column-editer"><i class="fa fa-pencil-square-o"></i></span>
                     </li> 
                     <?php
                  }
 
                }else{ ?>
                    <li data-group-ref="1" data-columns="2" data-group-name="Group 1"
                      class="wpmm-group-trigger wpmm-grp-active-trigger">
                      Group 1
                      <br/><span class="wpmm-group-col">( Column 2)</span>
                      <span title="<?php _e('Edit this Group',APMM_PRO_TD);?>" class="wpmm-group-column-editer"><i class="fa fa-pencil-square-o"></i></span>
                    </li> 

               <?php  } ?>
            </ul>     
            
        </div>
<?php 
     if($wpmmenu_item_meta['menu_type'] == "megamenu"){
                                        $classtype = "enabled_megamenu";
                                       }else{
                                        $classtype  = "disabled";
                                       }
?>
        <div class="wpmm-group-field-holder">

          <div class="wpmm_group_add_components <?php echo $class;?>">
          <?php if(isset($grouplists) && !empty($grouplists)){
                   $count = $grouplists->totalgroup;
                   $group_detailss = $grouplists->group_details;
                   $totalgroups = unserialize($group_detailss);
                   foreach ($totalgroups as $key => $value) {
                     $newgroup      = $value['group_no'];
                     $total_columns = $value['column'];
                       if($newgroup == 1){
                              $style = "";
                          }else{
                              $style = "style='display:none;'";
                          }
            global $widget_object;
            $items = $widget_object->wpmm_get_widgets_and_menu_items_for_menu_id($menu_item_id, $menu_id, "multiple");
          // WPMM_Libary::displayArr($items);

           ?>
            <div id="wpmm_widgets_setup_<?php echo $newgroup;?>" class="wpmm_widgets_setup <?php echo $classtype;?>" 
            data-group-ref="<?php echo $newgroup;?>" data-columns="<?php echo $total_columns;?>" <?php echo $style;?>> 
         <?php 
            if(isset($items)){
             foreach ($items as $item) { 
                if(isset($item['group_type']) && $item['group_type'] == 'multiple' && $item['group_number'] == $newgroup){
                  if(is_numeric($item['id'])){
                   $menu_items = WPMM_Libary::get_sub_menu_items($menu_item_id, $menu_id,$item['id']); //get all sub menu item
                   $menu_title = $menu_items[0]['title'];
                   $menu_type = $menu_items[0]['type'];
                }else{
                   $menu_title = $item['title'];
                   $menu_type = $item['type'] ;
                }
                   if(isset($item['type']) && $item['type'] == "wp_widget"){
                   $item_columns = (isset($item['columns']) && $item['columns'] != '')?esc_attr($item['columns']):$total_columns;
                }else{
                  //sub menu items
                   $mmcolumnsettings = get_post_meta( $item['id'], '_wpmegamenu', true);
                   $item_columns = (isset($mmcolumnsettings['wpmm_group_mega_menu_columns']) && $mmcolumnsettings['wpmm_group_mega_menu_columns'])?$mmcolumnsettings['wpmm_group_mega_menu_columns']:$mmcolumnsettings;
                   if(is_array( $item_columns )){
                     $item_total_columns = (isset($item['columns']) && $item['columns'] != '')?esc_attr($item['columns']):$total_columns;
                     $item_columns =  $item_total_columns;
                   }
                }
                 ?>
                <div class="wpmm_widget_areaa" data-title="<?php echo esc_attr( $menu_title );?>" 
                data-columns="<?php echo $item_columns;?>" 
                data-type="<?php echo esc_attr( $menu_type );?>"
                 data-id="<?php echo esc_attr( $item['id'] );?>" id="<?php echo esc_attr( $item['id'] );?>">
                <div class="widget_main_top_section">
                <div class="widget_title">
                <span><i class="fa fa-arrows" aria-hidden="true"></i></span>
                <span class="wptitle"><?php echo esc_attr( $menu_title );?></div></span>
                <div class="widget_right_action">
                <a class="widget-option wpmm_widget-contract" title="<?php echo esc_attr( __("Contract",APMM_PRO_TD) );?>">
                <i class="fa fa-caret-left" aria-hidden="true"></i></a>
                <span class="widget-cols">
                                <span class="wpmm_widget-num-cols"><?php echo $item_columns;?></span>
                <span class="wpmm_widget-of">/</span>
                <span class="wpmm_widget-total-cols"><?php echo (isset($total_columns) && $total_columns != '')?$total_columns:'1';?></span>
                </span>
                <a class="widget-option wpmm_widget-expand" title="<?php echo esc_attr( __("Expand", APMM_PRO_TD) );?>">
                <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                <a class="widget-option wpmm_widget-action" title="<?php echo esc_attr( __("Edit",APMM_PRO_TD) );?>">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                </div>
                </div>
                <div class="wpmm_widget_inner"></div>
                </div>
               
             <?php  }
              }
            }else{ ?>
                 <span class="message"><?php _e("No widgets found. Add a widget to this area using the ADD Widget Button (top right).",APMM_PRO_TD); ?></span>
            <?php }
             ?>

             </div>
              <?php
                  }
 
                }else{ ?>
  <div id="wpmm_widgets_setup_1" class="wpmm_widgets_setup enabled_megamenu" 
            data-group-ref="1" data-columns="2"> 
                <?php

             if(isset($items)){
             foreach ($items as $item) { 
              if(isset($item['group_type']) && $item['group_type'] == 'multiple' || $item['type'] == "wpmm_menu_subitem"){
             ?>
         
                    <div class="wpmm_widget_areaa" id="<?php echo esc_attr( $item['id'] );?>" data-title="<?php echo esc_attr( $item['title'] );?>" 
                      data-columns="<?php echo esc_attr( $item['columns'] );?>" 
                      data-type="<?php echo esc_attr( $item['type'] );?>"
                       data-id="<?php echo esc_attr( $item['id'] );?>" id="<?php echo esc_attr( $item['id'] );?>">
                      <div class="widget_main_top_section">
                      <div class="widget_title">
                      <span><i class="fa fa-arrows" aria-hidden="true"></i></span>
                      <span class="wptitle"><?php echo esc_html( $item['title'] );?></div></span>
                      <div class="widget_right_action">
                      <a class="widget-option wpmm_widget-contract" title="<?php echo esc_attr( __("Contract",APMM_PRO_TD) );?>">
                      <i class="fa fa-caret-left" aria-hidden="true"></i></a>
                      <span class="widget-cols">
                      <span class="wpmm_widget-num-cols"><?php echo esc_attr( $item['columns'] );?></span>
                      <span class="wpmm_widget-of">/</span>
                      <span class="wpmm_widget-total-cols"><?php echo (isset($total_columns) && $total_columns != '')?$total_columns:'2';?></span>
                      </span>
                      <a class="widget-option wpmm_widget-expand" title="<?php echo esc_attr( __("Expand", APMM_PRO_TD) );?>">
                      <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                      <a class="widget-option wpmm_widget-action" title="<?php echo esc_attr( __("Edit",APMM_PRO_TD) );?>">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                      </div>
                      </div>
                      <div class="wpmm_widget_inner"></div>
                      </div>
           
           <?php }
             
            }
             } ?>
          </div>
                <?php  } ?>
          </div>

           <?php      
              if(isset($grouplists) && !empty($grouplists)){
                   $count = $grouplists->totalgroup;
                 }else{
                   $count = 1;
                 }
                   ?>
          <input type="hidden" id="wpmm-group-num-<?php echo $menu_item_id;?>" class="wpmm-field-total-group"
            name="wpmm_settings[mulitple][total_group]" value="<?php echo $count;?>"/>

            <?php          
             // if ( $grouptype == 'multiple' ) {
              if(isset($grouplists) && !empty($grouplists)){// get details with menu id
                   $group_detailss = $grouplists->group_details;
                   $widget_details = $grouplists->widget_details;
                   $totalgroups = unserialize($group_detailss);
                   $widgetsdetails = unserialize($widget_details);
                  // echo "<pre>";
                  // print_r($widgetsdetails);
                  // echo "</pre>";

                   if(isset($totalgroups) && !empty($totalgroups)):
                   foreach ($totalgroups as $key => $value) {
                      # code...
                     $newgroup      = $value['group_no'];
                     $total_columns = $value['column'];?>
                      <input type="hidden" class="wpmm_field_groups" name="wpmm_settings[field_groups][group<?php echo $newgroup ; ?>_fields]" 
                     data-group-fields-ref='<?php echo esc_attr($newgroup ); ?>' data-group-column-ref='<?php echo esc_attr($total_columns);?>'/>
                     <?php
                     if(isset($widgetsdetails)){
                         foreach ($widgetsdetails as $key => $val) {
                             if ($val['group_no'] === $newgroup ) {
                                 $lists = $val['lists'];
                                /* added code to get newly added sub items id to group lists*/ 
                               if($newgroup  == "1"){
                                 $arr3 = array(); 
                                 if(isset($items)){
                                    foreach ($items as $k=>$v) {
                                        if (is_numeric($k)) {
                                            array_push($arr3,$v['id']);
                                        } 
                                    }  
                                 }
                                   $split1 = explode(',', $lists );
                                    foreach ($split1 as $key => $val) {
                                       if (is_numeric($val)) {
                                        if(!in_array($val, $arr3)) {
                                            unset($split1[$key]);
                                        }
                                      }
                                    }
                                    foreach ($arr3 as $key => $val) {
                                       if (is_numeric($val)) {
                                        if(!in_array($val, $split1)) {
                                          array_push($split1, $val);
                                        }
                                      }
                                    }
                                    $lists = implode(',', $split1);
                                  }
                               /* added code end*/ 
 
                             }
                       }
                     }else{
                      $lists = '';
                      } 
                   ?>
                    <input class="wpmm_groups_widgets_lists" name="wpmm_settings[widget_groups][group<?php echo $newgroup ; ?>]" 
                    data-group-widget-ref="<?php echo $newgroup ; ?>" type="hidden" value="<?php echo $lists;?>"> 
                      <?php 

                       }
                    endif;
                   }else{ ?>
<input type="hidden" class="wpmm_field_groups" name="wpmm_settings[field_groups][group1_fields]" 
data-group-fields-ref='1' data-group-column-ref='2'/>
<input class="wpmm_groups_widgets_lists" name="wpmm_settings[widget_groups][group1]" 
data-group-widget-ref="1" type="hidden" value=""> 

                  <?php } 
                  //}?>
                 
              
            
        </div>
  
</div>

<?php 
  $tmp = array();
   if(isset($items)){
     foreach ($items as $item) { 
      if($item['type'] == "wpmm_menu_subitem"){
         array_push($tmp, $item["id"]);
         
      }
    }
  }
  $tmp = implode(",", $tmp);

  ?>
  <input class="wpmm_widgetlists" type="hidden" value="<?php echo $tmp;?>"> 

<!-- ALL Wordpress Widgets Lists Frame -->
<div class="wpmm_widget_iframe" style="display:none;">
        <div class="wpmm_widgte_middle_content">
        <!-- left section widgets -->
          <div class="widget_left_section">
            <div class="widgetss_header"><?php _e('ALL WIDGETS',APMM_PRO_TD);?></div>
            <ul>
              <li><div class="wpmm_tabss active" id="wordpress_widgets"><?php _e('WORDPRESS WIDGETS',APMM_PRO_TD);?></div></li>
              <li><div class="wpmm_tabss" id="wpmm_widgets"><?php _e('WP MEGA MENU PRO WIDGETS',APMM_PRO_TD);?></div></li>
              <li><div class="wpmm_tabss" id="wpmm_woocommercewidgets"><?php _e('WOOCOMMERCE WIDGETS',APMM_PRO_TD);?></div></li> 
            </ul>
          </div>
        <!-- right section widgets -->
          <div class="widget_right_section">

             <div class="btn_close_me">
              <div class="title_widget_add"><i class="fa fa-wrench" aria-hidden="true"></i><?php _e('ADD WIDGET SETTINGS',APMM_PRO_TD);?></div>
               <span><i class="fa fa-close" aria-hidden="true"></i>CLOSE</span>
             </div>

             <div class="right_middle_widgets">
                <div class="tab-panes" id="tabs_wordpress_widgets" style="display:none;">
                 <ul><?php 
                  $wpmm_widget_manager = new WPMM_Menu_Widget_Manager();
                  $all_widgets = WPMM_Libary::wpmm_get_available_widgets();
                    foreach ($all_widgets as $key => $value) { ?>
                     <li class="wpmm_all_wp_widgets" data-value="<?php echo $value['value'];?>" data-text="<?php echo $value['name'];?>">
                       <div class="wpmm_widget-type-wrapper" style="height: 71px;">
                         <span class="wpmm_widget-icon dashicons dashicons-wordpress"></span>
                          <h3><?php echo $value['name'];?></h3>
                          <p class="widgets_description"><?php echo $value['description'];?></p>
                        </div>
                     </li>
                   <?php }
                  ?>
                 </ul>
                </div>
                <div class="tab-panes" id="tabs_wpmm_widgets" style="display:none;">
                   <ul>
                  <?php $wpmm_widget_manager = new WPMM_Menu_Widget_Manager();
                   $all_widgets =WPMM_Libary::wpmm_get_specific_widgets();
                    foreach ($all_widgets as $key => $value) { ?>
                     <li class="wpmm_all_wp_widgets" data-value="<?php echo $value['value'];?>" data-text="<?php echo $value['name'];?>">
                       <div class="wpmm_widget-type-wrapper" style="height: 89px;">
                         <span class="wpmm_widget-icon dashicons dashicons-wordpress"></span>
                          <h3><?php echo $value['name'];?></h3>
                          <p class="widgets_description"><?php echo $value['description'];?></p>
                        </div>
                     </li>
                   <?php }
                  ?>
                 </ul>
                </div>
                   <div class="tab-panes" id="tabs_wpmm_woocommercewidgets" style="display:none;">
                   <ul>
                  <?php $wpmm_widget_manager = new WPMM_Menu_Widget_Manager();
                   $all_widgets = WPMM_Libary::wpmm_get_woo_widgets();
                    foreach ($all_widgets as $key => $value) { ?>
                     <li class="wpmm_all_wp_widgets" data-value="<?php echo $value['value'];?>" data-text="<?php echo $value['name'];?>">
                       <div class="wpmm_widget-type-wrapper" style="height: 89px;">
                         <span class="wpmm_widget-icon dashicons dashicons-wordpress"></span>
                          <h3><?php echo $value['name'];?></h3>
                          <p class="widgets_description"><?php echo $value['description'];?></p>
                        </div>
                     </li>
                   <?php }
                  ?>
                 </ul>
                </div>

             </div>

          </div>
        </div>
        
      </div>
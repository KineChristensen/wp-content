<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * WP Mega Menu Display Menu Frontend
 * Class with all the necessary functions regarding displaying menu using Walker Class
 */
if ( !class_exists( 'WPMM_Walker_Class' ) ) {

  class WPMM_Walker_Class extends WPMM_Libary {
    var $group_counter = 0;
    var $order = 0;
    
     /**
     * Constructor 
     */
    public function __construct() {
    /*
      * Frontend WP Mega Menu Display
      */
      /* Frontend Display WPMegamenu with integration of Walker class Modification */
      add_filter( 'wp_nav_menu_args', array( $this, 'wpmm_navmenuargs' ), 999999 );

      /* Frontend Display WPMegamenu Widgets For specific menu location and hook on menu objects */
      add_filter( 'wp_nav_menu_objects', array( $this, 'wpmm_addwidgetsmegamenu' ), 9, 2 );
      
      /* Save setup array with _wpmegamenu post meta data into posts array for specific posts */
      add_filter( 'wpmegamenu_navmenu_before_setup', array( $this, 'wpmmsetupmenuitems' ), 3, 2 );
      add_filter( 'wpmm_navmenuafterobj', array( $this, 'wpmm_reordermenuitems' ), 5, 2 );

      /* Apply Neccessary Classes for li items of top level menu with depth check*/
      add_filter( 'wpmm_navmenuafterobj', array( $this, 'wpmm_setclassesmenuitems' ), 7, 2 );
      add_filter('widget_text', 'do_shortcode');

      /*
      * Responsive Hook Frontend WP Mega Menu Display
      */
      /* responsive toggle bar content display filter hook start */
      add_filter( 'wp_nav_menu', array( $this, 'wpmm_mobiletoggle' ), 10, 2 ); // display toggle bar on top of menu frontend
      add_filter('wpmegamenu_togglebar_content',array( $this, 'wpmm_responsive_display_togglebar_content'), 9, 5);

   
      
     }

    public function simple_filter_nav_menu_pages( $items, $args ) {

            $non_allowed_post_ids = array( 2000,2001 );
            $non_allowed_post_urls = array( 'url1', 'url2' );
            foreach ( $items as $key => $post ) {
                if ( in_array( absint( $post->object_id ), $non_allowed_post_ids ) ) {
                    unset( $items[ $key ] );
                    continue;
                }
                 if ( in_array( absint( $post->object_id ), $non_allowed_post_urls ) ) {
                    unset( $items[ $key ] );
                 }
            }
            return $items;
        }

          /**
     * Use the WP Mega Menu walker to output the menu
     * Resets all parameters used in the wp_nav_menu call
     * Wraps the menu in wp-mega-menu IDs and classes
     * Derived From: Max Mega Menu
     * https://www.maxmegamenu.com
     */
    public function wpmm_navmenuargs( $args ) {

        $settings = get_option( 'wpmegabox_settings' ); //get all plugin metabox data 
        // echo "<pre>";
        // print_r($settings);
        // exit();
        $current_theme_location = $args['theme_location']; // get current menu location i.e primary
        $locations = get_nav_menu_locations(); // get all menu location
        
        /*
        * Check if wp mega menu is enabled or not for specific menu location
        */
        if ( isset ( $settings[ $current_theme_location ]['enabled'] ) && $settings[ $current_theme_location ]['enabled'] == 1 ) {

            if ( ! isset( $locations[ $current_theme_location ] ) ) {
                return $args;
            }
          
            $menu_id = $locations[ $current_theme_location ];

            if ( ! $menu_id ) {
                return $args;
            }

            if ( ! $current_theme_location ) {
             return false;
              }

              if ( ! has_nav_menu( $current_theme_location ) ) {
                  return false;
              }


              $themes_style_manager = new AP_Theme_Settings();
              $retractor_default_text = __('CLOSE',APMM_PRO_TD);

              //$themes = $themes_style_manager->get_custom_theme_data(''); // get all custom themes
              if(isset($settings[ $current_theme_location ]['theme_type'] ) && $settings[ $current_theme_location ]['theme_type'] == "custom_themes" ){
                        $theme = $settings[ $current_theme_location ]['theme']; 
                        $menu_theme = $themes_style_manager->get_custom_theme_rowdata($theme);
                        $theme_title = 'wpmega-'.$menu_theme->slug;
                        $theme_settings = unserialize($menu_theme->theme_settings);
                       
                        $resposive_breakpoint_width = (isset($theme_settings['mobile_settings']['resposive_breakpoint_width']) && $theme_settings['mobile_settings']['resposive_breakpoint_width'] != '')?$theme_settings['mobile_settings']['resposive_breakpoint_width']:''; 
                        $responsive_submenus_retractor =  (isset($theme_settings['mobile_settings']['submenu_closebtn_position']) && $theme_settings['mobile_settings']['submenu_closebtn_position'] == 'top')?'wpmm-top-retractor':'wpmm-bottom-retractor'; 
                        $submenus_retractor_text =  (isset($theme_settings['mobile_settings']['submenus_retractor_text']) && $theme_settings['mobile_settings']['submenus_retractor_text'] != '')?$theme_settings['mobile_settings']['submenus_retractor_text']:$retractor_default_text; 
                       
                        $skin_type = "wpmm-custom-theme"; 
                        $skin_type1 = "wpmm-ctheme-wrapper"; 
                        $arrow_type = (isset($theme_settings['mobile_settings']['submenus_retractor_text']) && $theme_settings['mobile_settings']['submenus_retractor_text'] != '')?$theme_settings['mobile_settings']['submenus_retractor_text']:$retractor_default_text; 
                       
                  }else{
                        $theme = $settings[ $current_theme_location ]['available_skin'];
                        $menu_theme = isset( $theme ) ? 'wpmega-'.$theme : 'wpmega-black-white';

                        
                        $resposive_breakpoint_width = "680"; 
                        $responsive_submenus_retractor = "wpmm-bottom-retractor";
                        $submenus_retractor_text = $retractor_default_text;
                       
                        $skin_type = "wpmm-pre-available-skins"; 
                        $skin_type1 = "wpmm-askins-wrapper"; 
                        $theme_title = 'wpmega-'.$theme;
                        $arrow_type = "";
                  }
// exit();
          $apmega_general_settings = get_option('apmega_settings');

         /*
          * Pro features added : Sticky menu
          */
          if(isset($apmega_general_settings['active_sticky_menu']) && $apmega_general_settings['active_sticky_menu'] == 1){
            if(isset($apmega_general_settings['sticky_theme_location'])){
              if($apmega_general_settings['sticky_theme_location'] == $current_theme_location){
                 $sticky_class = "wpmm-pro-sticky"; 
              }else{
                 $sticky_class = ""; 
              }
            }
          }else{
            $sticky_class = ""; 
          }
         /* sticky menu end*/
 
          if(isset($apmega_general_settings['disable_submenu_retractor']) && $apmega_general_settings['disable_submenu_retractor'] ==1){
             $retractor = '';
             $retractor_txt = '';
          }else{
              $retractor = $responsive_submenus_retractor;
              $retractor_txt = $submenus_retractor_text;
          }
        
          if(isset($apmega_general_settings['enable_mobile']) && $apmega_general_settings['enable_mobile'] != 1){
            $addClass = "wpmega-disable-mobile-menu";
          }else{
             $addClass = "wpmega-enabled-mobile-menu";
          }

            $orientation   = (isset($settings[ $current_theme_location ]['orientation']) && $settings[ $current_theme_location ]['orientation'] != '')?esc_attr($settings[ $current_theme_location ]['orientation']):'';        
            $mobile_menu_location   = (isset($settings[ $current_theme_location ]['mobile_menu_location']) && $settings[ $current_theme_location ]['mobile_menu_location'] != '')?esc_attr($settings[ $current_theme_location ]['mobile_menu_location']):'';  

            $menu_settings = $settings[ $current_theme_location ]; /* Get data of specific menu location*/  
             $trigger_option = isset( $menu_settings['trigger_option']) ? 'wpmm-'.$menu_settings['trigger_option'] : 'wpmm-onhover';  //trigger option:hover_indent/onhover/onclick
            
            $wpmm_common_attributes = apply_filters("wpmegamenu_common_attributes", array(
                "id" => '%1$s',    
                "class" => 'wpmm-mega-wrapper wpmemgamenu-pro',
                "data-advanced-click" => isset( $settings['advanced_click'] ) ? $settings['advanced_click'] : 'wpmm-click-submenu',  
                "data-trigger-effect" =>  $trigger_option,    
            ), $menu_id, $menu_settings, $settings, $current_theme_location );

              $attributes = "";

               foreach( $wpmm_common_attributes as $attribute => $value ) {
                if ( strlen( $value ) ) {
                   // $attributes .= " ". esc_attr( $value );
                  $attributes .= " " . $attribute . '="' . esc_attr( $value ) . '"';
                }
               }

            $sanitized_location = str_replace( apply_filters("wpmegamenu_arg_replacements", array("-", " ") ), "-", $current_theme_location );
            $orientation = $menu_settings['orientation'];

            /* Integrate dynamic Stylesheet for menu */
              if($skin_type =="wpmm-custom-theme"){
               WPMM_Libary::get_custom_designs($current_theme_location,$settings);
              }
            /* End */


            /* Metabox options as per menu location here */
          
            if($orientation == "vertical"){
              $vertical_alignment_type   = (isset( $menu_settings['vertical_alignment_type'] ) && $menu_settings['vertical_alignment_type'] != "") ? 'wpmm-vertical-'.$menu_settings['vertical_alignment_type'].'-align' : 'wpmm-vertical-left-align';
            }else{
              $vertical_alignment_type = '';
            }
            $orientation    = "wpmm-orientation-".$orientation;
            $effectoption   = isset( $menu_settings['effect_option'] ) ? 'wpmm-'.$menu_settings['effect_option'] : 'wpmm-fade';
           
            /* END */

            /* other general common options */
            $hideallmenuicons = (isset( $settings['hide_icons'] ) && $settings['hide_icons'] == "1") ? 'hide-icons-true' : '';
            $mobile_toggle_option = (isset($apmega_general_settings['mobile_toggle_option']) && $apmega_general_settings['mobile_toggle_option'] == "toggle_standard") ? 'wpmm-toggle-standard' : 'wpmm-toggle-accordion';
            /* END */

            $dynamicclass = $skin_type1.' '.$theme_title.' '.$addClass.' '.$mobile_toggle_option.' '.$trigger_option.' '.$orientation.' '.$vertical_alignment_type.' '.$effectoption.' '.$sticky_class;
 
        if(wp_is_mobile()){
          if(isset($mobile_menu_location)){
             if($mobile_menu_location != $current_theme_location){
               $menu_id = $locations[ $mobile_menu_location ];
               $menu_location = $mobile_menu_location;
               $sanitized_location = str_replace( apply_filters("wpmegamenu_arg_replacements", array("-", " ") ), "-", $mobile_menu_location );
                $defaults = $this->overrider_walker_menu($retractor,$menu_id,$dynamicclass,$menu_location,$sanitized_location,$attributes,$submenus_retractor_text);
              }else{
                
               $defaults =  $this->overrider_walker_menu($retractor,$menu_id,$dynamicclass,$current_theme_location,$sanitized_location,$attributes,$submenus_retractor_text);
            
              }
          }else{
              $defaults = $this->overrider_walker_menu($retractor,$menu_id,$dynamicclass,$current_theme_location,$sanitized_location,$attributes,$submenus_retractor_text);
          }
        }else{
          
          $defaults = $this->overrider_walker_menu($retractor,$menu_id,$dynamicclass,$current_theme_location,$sanitized_location,$attributes,$submenus_retractor_text);

        }
                 


          $args = array_merge( $args, apply_filters( "wpmegamenu_menu_args", $defaults, $menu_id, $current_theme_location ) );
        }

        return $args;
    }    

    public function overrider_walker_menu($retractor,$menu_id,$dynamicclass,$menu_location,$sanitized_location,$attributes,$submenus_retractor_text){
          if($retractor != ''){ 
          if($retractor  == "wpmm-bottom-retractor"){
            $defaults = array(
                'menu'            => $menu_id,
                'container'       => 'div',
                'container_class' => 'wp-megamenu-main-wrapper '.$dynamicclass,
                'container_id'    => 'wpmm-wrap-' .$menu_location,
                'menu_class'      => 'wpmegamenu',
                'menu_id'         => 'wpmega-menu-' . $sanitized_location,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul' . $attributes . '>%3$s</ul><div class="wpmega-responsive-closebtn" id="close-'.$menu_location.'">'.$submenus_retractor_text.'</div>', 
                'depth'           => 0,
                'walker'          => new WPMegamenuWalker_Class()
            );

          }else{
            /* Top retractor */
            $defaults = array(
                'menu'            => $menu_id,
                'container'       => 'div',
                'container_class' => 'wp-megamenu-main-wrapper '.$dynamicclass,
                'container_id'    => 'wpmm-wrap-' .$menu_location,
                'menu_class'      => 'wpmegamenu',
                'menu_id'         => 'wpmega-menu-' . $sanitized_location,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      =>  '<div class="wpmega-responsive-closebtn" id="close-'.$menu_location.'">'.$submenus_retractor_text.'</div><ul' . $attributes . '>%3$s</ul>', 
                'depth'           => 0,
                'walker'          => new WPMegamenuWalker_Class()
            );

          }
         }else{
          //noretractor
           $defaults = array(
                'menu'            => $menu_id,
                'container'       => 'div',
                'container_class' => 'wp-megamenu-main-wrapper '.$dynamicclass,
                'container_id'    => 'wpmm-wrap-' .$menu_location,
                'menu_class'      => 'wpmegamenu',
                'menu_id'         => 'wpmega-menu-' . $sanitized_location,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      =>  '<ul' . $attributes . '>%3$s</ul>', 
                'depth'           => 0,
                'walker'          => new WPMegamenuWalker_Class()
            );

         } 
         return $defaults;
    }


           function searchForId($id,  $array) {
                if(isset($array) && !empty($array)){
                   foreach ($array as $key => $val) {
               
                       if ($val['id'] === $id ) {
                           return true;

                   }
                 }
               }
                  return false;
             }


     /**
     * Append the widget objects to the menu array before the
     * menu is processed by the walker.
     */
    public function wpmm_addwidgetsmegamenu( $items, $args ) {

        // make sure we're working with a Mega Menu
        if ( ! is_a( $args->walker, 'WPMegamenuWalker_Class' ) ) {
            return $items;
        }
        $items = apply_filters( "wpmegamenu_navmenu_before_setup", $items, $args );
        $mywidget_manager = new WPMM_Menu_Widget_Manager();
      if( isset($args->menu)){
          $menuid = $args->menu;
        }
       // WPMM_Libary::displayArr($items);
        foreach ( $items as $item ) {
         
          //echo $item->wpmegamenu_settings['menu_type']; megamenu or flyout  
         // echo "Menuparentid=".$item->menu_item_parent;     
          //WPMM_Libary::displayArr($mypanelwidgetss);

            // only look for widgets on top level items
            if ( $item->depth === 0 && $item->wpmegamenu_settings['menu_type'] == 'megamenu' ) {


              if(isset($item->wpmegamenu_settings['group_type']) && $item->wpmegamenu_settings['group_type']== "multiple"){

                //$count = 1;
                //multiple group

                 $mypanelwidgets = $mywidget_manager->wpmm_get_group_details( $item->ID);
                 $totalgroup = $mypanelwidgets->totalgroup;
                 $widget_details = unserialize($mypanelwidgets->widget_details);
                 $group_details = unserialize($mypanelwidgets->group_details);

                // WPMM_Libary::displayArr($group_details);
               //  WPMM_Libary::displayArr($widget_details);

                 if(isset($group_details) && !empty($group_details)){
                   foreach ($group_details as $key => $value) {
                    $this->group_counter = $this->group_counter + 100;

                     $newgroup      = $value['group_no'];
                     $total_columns = $value['column'];
                      if(isset($widget_details) && !empty($widget_details)){
                         foreach ($widget_details as $key => $val) {

                             if ($val['group_no'] === $newgroup ) {
                                 $lists = $val['lists'];
                                 $groupnum = $val['group_no'];
                                 $splitlists = explode(',', $lists);
                                 // WPMM_Libary::displayArr($splitlists);

                                $widgets_details = $mywidget_manager->wpmm_getwidgets_menuid( $item->ID , $menuid , 'multiple');
                                 for ($i=0; $i < count($splitlists); $i++) { 
                                    $megamenu_sets = get_post_meta($item->ID, '_wpmegamenu', true);

                             
                                   $getallwidgetsettings = array_merge( get_post_meta( $item->ID, '_wpmegamenu', true), array(
                                      'wpmm_mega_menu_columns' => isset($widgets_details[$splitlists[$i]]['columns'])?absint( $widgets_details[$splitlists[$i]]['columns'] ):'2',
                                      'wpmm_mega_menu_group_number' => isset($widgets_details[$splitlists[$i]]['group_number'])?absint( $widgets_details[$splitlists[$i]]['group_number'] ):'1',
                                      'wpmm_mega_menu_group_total_column' => $total_columns
                                      // 'wpmm_group_mega_menu_columns'  => $megamenu_sets['wpmm_group_mega_menu_columns']
                                     ) );
                               
                             
                                if($i == 0){
                                  $this->order = $this->order + 1;
                              $order = $this->order + $this->group_counter;
                                $groupsection = "start_group_widget";
                                   $wpmmmenuitems1 = array(
                                    'type'                      => 'widget',
                                    'group_section'             => $groupsection,
                                    'in_wpmegamenu'             => true,
                                    'title'                     => 'start_widget',
                                    'group_type'                => 'multiple',
                                    'group_number'              => $groupnum,
                                    'content'                   => '',
                                    'menu_item_parent'          => $item->ID,
                                    'object_id'                 => ! isset( $item->object_id ) ? get_post_meta( $item->ID, '_menu_item_object_id', true ) : $item->object_id,
                                     'url'                      => isset( $item->url ) ? $item->url : '',
                                    'db_id'                     => 0, // This menu item does not have any childen
                                    'ID'                        => $item->ID,
                                    'wp_menu_order'             => $order,
                                    'wpmegamenu_order'          => $order,
                                     'wpmegamenu_settings'       => $getallwidgetsettings,
                                    'depth'                     => 1,
                                    'classes'                   => array(
                                        "wpmm-start-group-section",
                                        "wpmm-group".$groupnum,
                                        "wpmm-mega-".$total_columns."columns"
                                    )
                                );

                                 $items[] = (object) $wpmmmenuitems1;   
                                }else if($i == count($splitlists) - 1 ){
                                  $groupsection = "end_group_widget";
                                }
                                
                                   if(intval($splitlists[$i])){
                                     $group_widget_type = "submenu";
                                     $content = "";

                                   }else{
                                     $group_widget_type = "widget";
                                     $content = $mywidget_manager->wpmmshowwidget(  $splitlists[$i] );
                                   }
                              $this->order = $this->order + 1;
                              $order = $this->order + $this->group_counter;


                                   $wpmmmenuitems = array(
                                    'type'                      => $group_widget_type,
                                    'group_section'             => $group_widget_type ,
                                    'in_wpmegamenu'             => true,
                                    'title'                     => $splitlists[$i],
                                    'group_type'                => 'multiple',
                                    'group_number'              => $groupnum,
                                    'content'                   => $content,
                                    'menu_item_parent'          => $item->ID,
                                     'object_id'                 => ! isset( $item->object_id ) ? get_post_meta( $item->ID, '_menu_item_object_id', true ) : $item->object_id,
                                     'url'                      => isset( $item->url ) ? $item->url : '',
                                    'db_id'                     => 0, // This menu item does not have any childen
                                    'ID'                        => $splitlists[$i] ,
                                    'wp_menu_order'             => $order,
                                    'wpmegamenu_order'          => $order,
                                    'wpmegamenu_settings'       => $getallwidgetsettings,
                                    'depth'                     => 1,
                                    'classes'                   => array(
                                        "menu-item",
                                        "menu-item-type-widget",
                                        "menu-widget-class-" . $mywidget_manager->wpmm_getwidget( $splitlists[$i]  ),
                                        $mywidget_manager->wpmm_getwidget( $splitlists[$i]  )
                                    )
                                );

                                 $items[] = (object) $wpmmmenuitems;    

                                 if($i == count($splitlists) - 1 ){
                                   $this->order = $this->order + 1;
                                   $order = $this->order + $this->group_counter;
                                     $wpmmmenuitems2 = array(
                                    'type'                      => 'widget',
                                    'group_section'             => 'end_group_widget',
                                    'in_wpmegamenu'             => true,
                                    'title'                     => 'end_widget',
                                    'group_type'                => 'multiple',
                                    'group_number'              => $groupnum,
                                    'content'                   => '',
                                    'menu_item_parent'          => $item->ID,
                                     'object_id'                 => ! isset( $item->object_id ) ? get_post_meta( $item->ID, '_menu_item_object_id', true ) : $item->object_id,
                                     'url'                      => isset( $item->url ) ? $item->url : '',
                                    'db_id'                     => 0, // This menu item does not have any childen
                                    'ID'                        => '' ,
                                    'wp_menu_order'             => $order,
                                    'wpmegamenu_order'          => $order,
                                    'depth'                     => 1,
                                    'classes'                   => array()
                                );


                                 $items[] = (object) $wpmmmenuitems2; 
                                 }


                                  
                                 }

                             }
                         }
                       }
              
                }
            }


              }else{
                //single group

                $mypanelwidgets = $mywidget_manager->wpmm_getwidgets_menuid( $item->ID, $args->menu ,'' );
                
                if ( count( $mypanelwidgets ) ) {

                    $wdposition = 0;
                    $nxtorder = $this->wpmm_getnextmenuorder( $item->ID, $items);
                    $totalwidgetsinwpmenu = count( $mypanelwidgets );

                    if ( ! in_array( 'menu-item-has-children', $item->classes ) ) {
                        $item->classes[] = 'menu-item-has-children';
                    }


                    foreach ( $mypanelwidgets as $mywidget ) {
                      if($mywidget['group_type'] != "multiple"){
                     
                        $getallwidgetsettings = array_merge( get_post_meta( $item->ID, '_wpmegamenu', true), array(
                            'wpmm_mega_menu_columns' => absint( $mywidget['columns'] )
                        ) );
                 
                        $wpmmmenuitem = array(
                            'type'                      => 'widget',
                            'in_wpmegamenu'             => true,
                            'title'                     => $mywidget['id'],
                            'group_type'                => $mywidget['group_type'],
                            'group_number'              => $mywidget['group_number'],
                            'content'                   => $mywidget_manager->wpmmshowwidget( $mywidget['id'] ),
                            'menu_item_parent'          => $item->ID,
                            'object_id'                 => ! isset( $item->object_id ) ? get_post_meta( $item->ID, '_menu_item_object_id', true ) : $item->object_id,
                            'url'                      => isset( $item->url ) ? $item->url : '',
                            'db_id'                     => 0, // This menu item does not have any childen
                            'ID'                        => $mywidget['id'],
                            'wp_menu_order'             => $nxtorder - $totalwidgetsinwpmenu + $wdposition,
                            'wpmegamenu_order'          => $mywidget['order'],
                            'wpmegamenu_settings'       => $getallwidgetsettings,
                            'depth'                     => 1,
                            'classes'                   => array(
                                "menu-item",
                                "menu-item-type-widget",
                                "menu-widget-class-" . $mywidget_manager->wpmm_getwidget( $mywidget['id'] ),
                                $mywidget_manager->wpmm_getwidget( $mywidget['id'] )
                            )
                        );

                        $items[] = (object) $wpmmmenuitem;

                        $wdposition++;
                        }
                    }
                }


              }
            
               
            }
        }
          //WPMM_Libary::displayArr($items);
          $items = apply_filters( "wpmm_navmenuafterobj", $items, $args );                
          return $items;
    }



     /**
     * Setup and array for each menu item from wp mega menu settings
     */
    public function wpmmsetupmenuitems( $items, $args ) {
        // apply depth
        $parray = array();
        foreach ( $items as $key => $value ) {
            if ( $value->menu_item_parent == 0 ) { // check menu parent id 0 if toplevel menu or not
                $parray[] = $value->ID;
                $value->depth = 0;
            }
        }
        if ( count( $parray ) ) {
            foreach ( $items as $key => $item ) {
                if ( in_array( $item->menu_item_parent, $parray ) ) {
                    $item->depth = 1;
                }
            }
        }

        // apply saved metadata to each menu item
        foreach ( $items as $elementKey => $item ) {
         
            $saved_settings = array_filter( (array) get_post_meta( $item->ID, '_wpmegamenu', true ) );
            $default_settings = new AP_Menu_Settings();
            $item->wpmegamenu_settings = array_merge( $default_settings->wpmm_menu_item_defaults(), $saved_settings );
            $item->wpmegamenu_order = isset( $item->wpmegamenu_settings['wp_menu_order'][$item->menu_item_parent] ) ? $item->wpmegamenu_settings['wp_menu_order'][$item->menu_item_parent] : 0;
            $item->in_wpmegamenu = false;
            $item->wpmenu_order = $item->menu_order * 1000;
            // add in_wpmegamenu
            if ( $item->depth == 1 ) {

                $parent_settings = array_filter( (array) get_post_meta( $item->menu_item_parent, '_wpmegamenu', true ) );

              // if ( isset( $parent_settings['group_type'] ) && $parent_settings['group_type'] == 'multiple' ) {
                 
              //     unset($items[$elementKey]);
            
              // }else{ 
                if ( isset( $parent_settings['menu_type'] ) && $parent_settings['menu_type'] == 'megamenu' ) {

                    $item->in_wpmegamenu = true;

                }
              //}

            }

        }
      //  WPMM_Libary::displayArr($items);

        return $items;
    }

    /**
      * This returns the menu order of the next top level menu item.
     */
    private function wpmm_getnextmenuorder( $item_id, $items ) {
        $get_next_parent = false;
        foreach ( $items as $key => $item ) {
            if ( $item->menu_item_parent != 0 ) {
                continue;
            }
            if ( $item->type == 'widget' ) {
                continue;
            }
            if ( $get_next_parent ) {
                return $item->menu_order;
            }
            if ( $item->ID == $item_id ) {
                $get_next_parent = true;
            }
            $last_menu_order = $item->menu_order;
        }
        // there isn't a next top level menu item
        return $last_menu_order + 1000;

    }

     /**
     * Reorder items within the wp mega menu.
     */
    public function wpmm_reordermenuitems( $items, $args ) {
           $new_items = array();
            foreach ( $items as $item ) {
               if ( $item->in_wpmegamenu && isset( $item->wpmegamenu_order ) && $item->wpmegamenu_order !== 0 ) {
                    $parent_post = get_post( $item->menu_item_parent );
                    $item->menu_order = $parent_post->menu_order * 1000 + $item->wpmegamenu_order;
                }
            }
            foreach ( $items as $item ) {
                $new_items[ $item->menu_order ] = $item;
            }
            ksort( $new_items );
            return $new_items;

    }
 

    /**
     * Apply column and clear classes to menu items (inc. widgets)
     */
    public function wpmm_setclassesmenuitems( $items, $args ) {
        // WPMM_Libary::displayArr($items);
        $parents = array();

       $current_theme_location = $args->theme_location; // get current menu location i.e primary
       $settings = get_option( 'apmega_settings' );

       $settings = get_option( 'wpmegabox_settings' ); //get all plugin metabox data
       //WPMM_Libary::displayArr($items);
       $orientation = isset($settings[$current_theme_location]['orientation'])?$settings[$current_theme_location]['orientation']:'horizontal';
        foreach ( $items as $item ) {
            if($item->title != "start_widget"){
              if($item->depth == 1){
                $item->classes[] = 'wp-mega-menu-header';
              }
            if ( $item->depth === 0 ) {
                  /* menu replacement class */
                 if (isset($item->wpmegamenu_settings['mega_menu_settings']['choose_menu_type']) && $item->wpmegamenu_settings['mega_menu_settings']['choose_menu_type'] == 'search_type') {
                    $item->classes[] = 'wpmega-custom-content wpmm-search-type';
                 }else if (isset($item->wpmegamenu_settings['mega_menu_settings']['choose_menu_type']) && $item->wpmegamenu_settings['mega_menu_settings']['choose_menu_type'] == 'woo_cart_total') {
                    $item->classes[] = 'wpmega-custom-content wpmm-woo-cart-total';
                 }else if (isset($item->wpmegamenu_settings['mega_menu_settings']['choose_menu_type']) && $item->wpmegamenu_settings['mega_menu_settings']['choose_menu_type'] == 'logo_image') {
                    $item->classes[] = 'wpmega-custom-content wpmm-clogo-image';
                 }else if (isset($item->wpmegamenu_settings['mega_menu_settings']['choose_menu_type']) && $item->wpmegamenu_settings['mega_menu_settings']['choose_menu_type'] == 'login_form') {
                    $item->classes[] = 'wpmega-custom-content wpmm-wplogin-form';
                 }else if (isset($item->wpmegamenu_settings['mega_menu_settings']['choose_menu_type']) && $item->wpmegamenu_settings['mega_menu_settings']['choose_menu_type'] == 'register_form') {
                    $item->classes[] = 'wpmega-custom-content wpmm-wpregister-form';
                 }else{
                    if(isset( $item->wpmegamenu_settings['menu_type']) &&  $item->wpmegamenu_settings['menu_type'] == "megamenu"){
                      $item->classes[] = 'wpmega-menu-' . $item->wpmegamenu_settings['menu_type'];
                    }else{
                      $item->classes[] = 'wpmega-menu-flyout';
                    }

                 }
                 /* menu replacement class end*/
               
            }

        
            if (isset($item->wpmegamenu_settings['general_settings']['hide_arrow']) && $item->wpmegamenu_settings['general_settings']['hide_arrow'] == 'true' ) {
                $item->classes[] = 'wpmega-hide-arrow';
            }else{
                $item->classes[] = 'wpmega-show-arrow';
            }

            if(isset($item->wpmegamenu_settings['general_settings']['activate_view_more_btn']) && $item->wpmegamenu_settings['general_settings']['activate_view_more_btn'] == 'true' ) {
                $item->classes[] = 'wpmega-view-more-btn';
            }
            

            if (isset($item->wpmegamenu_settings['general_settings']['visible_hidden_menu']) && $item->wpmegamenu_settings['general_settings']['visible_hidden_menu'] == 'true' ) {
                $item->classes[] = 'wpmega-visible-hide-menu';
            }

            if (isset($item->wpmegamenu_settings['general_settings']['active_single_menu']) && $item->wpmegamenu_settings['general_settings']['active_single_menu'] == 'enabled' ) {
                $item->classes[] = 'wpmega-enable-single-menu';
            }

             // if ( $item->depth  > 0 ) {
             //  if(isset($item->wpmegamenu_settings['general_settings']['submenu_align']) && $item->wpmegamenu_settings['general_settings']['submenu_align'] != '') {
             //      $item->classes[] = 'wpmm-submenu-align-' . $item->wpmegamenu_settings['general_settings']['submenu_align'];
             //  }else{
             //     $item->classes[] = 'wpmm-submenu-align-left';
             //  }
             // }


            if(isset($item->wpmegamenu_settings['general_settings']['menu_align']) && $item->depth == 0) {
                $item->classes[] = 'wpmm-menu-align-' . $item->wpmegamenu_settings['general_settings']['menu_align'];
            }else{
               $item->classes[] = 'wpmm-menu-align-left';
            }
       
            if (isset($item->wpmegamenu_settings['general_settings']['menu_icon']) && $item->wpmegamenu_settings['general_settings']['menu_icon'] == "enabled") {
              //show menu icon
                $item->classes[] = 'wpmega-show-menu-icon';
            }else{
              $item->classes[] = 'wpmega-hide-menu-icon';
            }

            if (isset($item->wpmegamenu_settings['general_settings']['hide_on_desktop']) && $item->wpmegamenu_settings['general_settings']['hide_on_desktop'] == 'true' ) {
                $item->classes[] = 'wpmega-hide-on-desktop';
            }

            if (isset($item->wpmegamenu_settings['general_settings']['hide_on_mobile']) && $item->wpmegamenu_settings['general_settings']['hide_on_mobile'] == 'true' ) {
                $item->classes[] = 'wpmega-hide-on-mobile';
            }


            if($item->depth === 0){
                    if($orientation == "horizontal"){
                      if(isset($item->wpmegamenu_settings['menu_type']) && $item->wpmegamenu_settings['menu_type'] == "megamenu"){
                        //megamenu
                            if ( isset($item->wpmegamenu_settings['mega_menu_settings']['horizontal-menu-position'])) {
                                  $item->classes[] = 'wpmega-horizontal-'.$item->wpmegamenu_settings['mega_menu_settings']['horizontal-menu-position'];
                              }else{
                                  $item->classes[] = 'wpmega-horizontal-full-width';
                              }
                          }else{
                          //flyout
                          if ( $item->depth === 0 ) {
                           if ( isset($item->wpmegamenu_settings['flyout_settings']['flyout-position'])) {
                                $item->classes[] = 'wpmega-flyout-horizontal-'.$item->wpmegamenu_settings['flyout_settings']['flyout-position'];
                            }else{
                                  $item->classes[] = 'wpmega-flyout-horizontal-left';
                              }
                            }

                          }
                    
                    }else{
                      //vertical
                       if(isset($item->wpmegamenu_settings['menu_type']) && $item->wpmegamenu_settings['menu_type'] == "megamenu"){
                        //megamenu
                         if ( isset($item->wpmegamenu_settings['mega_menu_settings']['vertical-menu-position'])) {
                                  $item->classes[] = 'wpmega-vertical-'.$item->wpmegamenu_settings['mega_menu_settings']['vertical-menu-position'];
                              }else{
                                 $item->classes[] = 'wpmega-vertical-full-height';
                              }


                       }else{
                        //flyout
                        if ( $item->depth === 0 ) {
                           if ( isset($item->wpmegamenu_settings['flyout_settings']['vertical-position'])) {
                                $item->classes[] = 'wpmega-flyout-vertical-'.$item->wpmegamenu_settings['flyout_settings']['vertical-position'];
                            }else{
                                 $item->classes[] = 'wpmega-flyout-vertical-full-height';
                              }
                            }

                       }


                    }

        
             }



              /* Tabs Section */
             $trigger_effect = (isset($item->wpmegamenu_settings['general_settings']['choose_trigger_effect']) && $item->wpmegamenu_settings['general_settings']['choose_trigger_effect'] == "onclick")?"onclick":"onhover";       
             $tabed_effect = "wpmm-tabbed-".$trigger_effect;
             if(isset($item->post_title) && $item->post_title == "[Tabs]"){
              $item->classes[] = "wpmega-tabs wpmega-vertical-tabs ".$tabed_effect;
             }else if(isset($item->post_title) && $item->post_title == "[HTabs]"){
               $item->classes[] = "wpmega-tabs wpmega-horizontal-tabs ".$tabed_effect;
             }
             /* Tabs Section End */

                    /* Roles & Restriction Section */
              if($item->depth === 0){
              if(isset($item->wpmegamenu_settings['restriction_roles']['display_mode'])){
              $display_mode = isset($item->wpmegamenu_settings['restriction_roles']['display_mode'])?$item->wpmegamenu_settings['restriction_roles']['display_mode']:'';// loggedinusers,loggedoutusers, all_users, by_role
              $roles_type = (isset($item->wpmegamenu_settings['restriction_roles']['roles_type'])?$item->wpmegamenu_settings['restriction_roles']['roles_type']:''); //adminsitrator, editor, subscriber, shop manager, customer,author, contributer.
              
               if ( is_user_logged_in() ) { 
                  $current_user_id = get_current_user_id(); 
                  $user_meta  = get_userdata($current_user_id);
                  $user_roles = $user_meta->roles; //array of roles the user is part of.
                 // WPMM_Libary::displayArr($user_roles);
                 if($display_mode == "logged_in_users"){
                  $item->classes[] = "wpmm-display-mode-off";
                 }else if($display_mode == "all_users"){
                  // all users except admin
                  if($user_roles[0] != "administrator"){
                      $item->classes[] = "wpmm-display-mode-off";
                  }
                 }
                 else if($display_mode == "by_role"){
                  if(!empty($roles_type)){
                  if(in_array($user_roles[0],$roles_type )){
                      $item->classes[] = "wpmm-display-mode-off";
                  }
                 }
                }
              
                }else{
                  
                if($display_mode == "logged_out_users"){
                   $item->classes[] = "wpmm-display-mode-off";
                }
              }

            }
            }
            /* Roles & Restriction Section */

          if(isset($item->wpmegamenu_settings['general_settings']['show_menu_to_users'])){
              $menu_users_check = $item->wpmegamenu_settings['general_settings']['show_menu_to_users']; //always/loggedin users or logged oout users
              if($menu_users_check != "always"){
                if($menu_users_check == "onlyloggedin_users"){
                  if ( !is_user_logged_in() ) { 
                    $item->classes[] = "wpmm-hide-menu-ltusers";
                  }
                }else if($menu_users_check == "onlyloggedout_users"){
                  if ( is_user_logged_in() ) { 
                   $item->classes[] = "wpmm-hide-menu-ltusers";
                  }

                }

              }
            }


            // add column classes for second level menu items displayed in mega menus
            if ( $item->in_wpmegamenu === true ) {

                $parent_settings = array_filter( (array) get_post_meta( $item->menu_item_parent, '_wpmegamenu', true ) );
                $default_settings = new AP_Menu_Settings();
                $parent_settings = array_merge(  $default_settings->wpmm_menu_item_defaults(), $parent_settings );

            
         
                $menu_item_parent = $item->menu_item_parent;
                 $get_megamenu_details = get_post_meta($menu_item_parent, '_wpmegamenu' ,true);
                 $grouptype = (isset($get_megamenu_details['group_type'])?$get_megamenu_details['group_type']:'single');
              
            
          
            $mywidget_manager = new WPMM_Menu_Widget_Manager();
            $wpmm_mega_menu_group_number = (isset($item->wpmegamenu_settings['wpmm_mega_menu_group_number']) && $item->wpmegamenu_settings['wpmm_mega_menu_group_number'] != '')?$item->wpmegamenu_settings['wpmm_mega_menu_group_number']:'1';  
              
              if(isset($item->wpmegamenu_settings['group_type']) && $item->wpmegamenu_settings['group_type'] == "multiple"){  
              //  $wpmm_mega_menu_group_total_column = (isset($item->wpmegamenu_settings['wpmm_mega_menu_group_total_column']) && $item->wpmegamenu_settings['wpmm_mega_menu_group_total_column'] != '')?$item->wpmegamenu_settings['wpmm_mega_menu_group_total_column']:'2';
              
                if(isset($item->wpmegamenu_settings['wpmm_mega_menu_group_total_column']) && $item->wpmegamenu_settings['wpmm_mega_menu_group_total_column'] != ''){
                 $wpmm_mega_menu_group_total_column = $item->wpmegamenu_settings['wpmm_mega_menu_group_total_column'];
                }else{
                 $grpwidgets = $mywidget_manager->wpmm_get_group_details($menu_item_parent);
                 $group_details = unserialize($grpwidgets->group_details);
                       if(isset($group_details) && !empty($group_details)){
                         foreach ($group_details as $key => $value) {
                           $newgroup      = $value['group_no'];
                           if($wpmm_mega_menu_group_number == $newgroup ){
                              $wpmm_mega_menu_group_total_column = $value['column'];
                           }
                         }
                       }
                }
                 $total_columns =   $wpmm_mega_menu_group_total_column;
                 if(isset($item->type) && $item->type == "widget"){
                   $span = (isset($item->wpmegamenu_settings['wpmm_mega_menu_columns']) && $item->wpmegamenu_settings['wpmm_mega_menu_columns'] != '')?$item->wpmegamenu_settings['wpmm_mega_menu_columns']:'1';
                 }else{
                   $span = (isset($item->wpmegamenu_settings['wpmm_group_mega_menu_columns']) && $item->wpmegamenu_settings['wpmm_group_mega_menu_columns'] != '')?$item->wpmegamenu_settings['wpmm_group_mega_menu_columns']:$total_columns;
                 }
                
               
              }else{
                if($grouptype == "multiple"){
                     if(isset($item->wpmegamenu_settings['wpmm_mega_menu_group_total_column']) && $item->wpmegamenu_settings['wpmm_mega_menu_group_total_column'] != ''){
                       $wpmm_mega_menu_group_total_column = $item->wpmegamenu_settings['wpmm_mega_menu_group_total_column'];
                      }else{

                         $grpwidgets = $mywidget_manager->wpmm_get_group_details($menu_item_parent);
                         $group_details = unserialize($grpwidgets->group_details);
                               if(isset($group_details) && !empty($group_details)){
                                 foreach ($group_details as $key => $value) {
                                   $newgroup      = $value['group_no'];
                                   if($wpmm_mega_menu_group_number == $newgroup ){
                                      $wpmm_mega_menu_group_total_column = $value['column'];
                                   }
                                 }
                               }
                      }
                       $total_columns = $wpmm_mega_menu_group_total_column;

                     // if(isset($item->type) && $item->type == "widget"){
                     //   $span = (isset($item->wpmegamenu_settings['wpmm_mega_menu_columns']) && $item->wpmegamenu_settings['wpmm_mega_menu_columns'] != '')?$item->wpmegamenu_settings['wpmm_mega_menu_columns']:'1';
                     // }else{
                     //   $span = (isset($item->wpmegamenu_settings['wpmm_group_mega_menu_columns']) && $item->wpmegamenu_settings['wpmm_group_mega_menu_columns'] != '')?$item->wpmegamenu_settings['wpmm_group_mega_menu_columns']:$total_columns;
                     // }

                    if(isset($item->type) && $item->type == "widget"){
                      
                $columnsettings = get_post_meta( $item->ID, '_wpmegamenu', true);
                $item_each_columns = (isset($columnsettings['wpmm_group_mega_menu_columns']) && $columnsettings['wpmm_group_mega_menu_columns'])?$columnsettings['wpmm_group_mega_menu_columns']:$columnsettings;
                    
                       $span = (isset($item->wpmegamenu_settings['wpmm_mega_menu_columns']) && $item->wpmegamenu_settings['wpmm_mega_menu_columns'] != '')?$item->wpmegamenu_settings['wpmm_mega_menu_columns']:'1';
                     }else{

                $columnsettings = get_post_meta( $item->ID, '_wpmegamenu', true);
                $item_each_columns = (isset($columnsettings['wpmm_group_mega_menu_columns']) && $columnsettings['wpmm_group_mega_menu_columns'])?$columnsettings['wpmm_group_mega_menu_columns']:$columnsettings;
                    
                       $span = (isset($item->wpmegamenu_settings['wpmm_group_mega_menu_columns']) && $item->wpmegamenu_settings['wpmm_group_mega_menu_columns'] != '')?$item->wpmegamenu_settings['wpmm_group_mega_menu_columns']:$item_each_columns;
                     }
                
                  }else{
                    //single column
                       $total_columns = $parent_settings['panel_columns']; 
                        $span = (isset($item->wpmegamenu_settings['wpmm_mega_menu_columns']) && $item->wpmegamenu_settings['wpmm_mega_menu_columns'] != '')?$item->wpmegamenu_settings['wpmm_mega_menu_columns']:'1';  
                  }
                    
                   
              }

                if ( $total_columns >= $span ) {
                    $item->classes[] = "wpmega-{$span}columns-{$total_columns}total";
                    $column_count = $span;
                } else {
                    $item->classes[] = "wpmega-{$total_columns}columns-{$total_columns}total";
                    $column_count = $total_columns;
                }

                if ( ! isset( $parents[ $item->menu_item_parent ] ) ) {
                    $parents[ $item->menu_item_parent ] = $column_count;
                } else {
                    $parents[ $item->menu_item_parent ] = $parents[ $item->menu_item_parent ] + $column_count;

                    if ( $parents[ $item->menu_item_parent ] > $total_columns ) {
                        $parents[ $item->menu_item_parent ] = $column_count;
                        $item->classes[] = 'wpmmclear';
                    }
                }

            }



        }
        else{
           
        }


      }
        return $items;
    }




     /**
     * Add responsive toggle box to the menu
     *
     */
    public function wpmm_mobiletoggle( $nav_menu, $args ) {
        // make sure we're working with a WP Mega Menu walker class
      // echo "<pre>";
      // print_r($args);
      // exit();
        if ( ! is_a( $args->walker, 'WPMegamenuWalker_Class' ) )
            return $nav_menu;

          $dynamicclass = 'class="' . $args->container_class . '">';

           $current_theme_location = $args->theme_location;
          
           if ( ! $current_theme_location ) {
                return false;
            }

            if ( ! has_nav_menu( $current_theme_location ) ) {
                return false;
            }
              $themes_style_manager = new AP_Theme_Settings();
              $themes = $themes_style_manager->get_custom_theme_data(''); // get all custom themes
        
             // if a current_theme_location has been passed, check to see if MMM has been enabled for the current_theme_location
             $settings = get_option( 'wpmegabox_settings' ); //get all plugin metabox data from nav menu location
           
      $apmega_general_settings = get_option('apmega_settings');
            if ( is_array( $settings ) && isset( $settings[ $current_theme_location ]['enabled'] ) && $settings[ $current_theme_location ]['enabled'] == 1) {
              if(isset($settings[ $current_theme_location ]['theme_type'] ) && $settings[ $current_theme_location ]['theme_type'] == "custom_themes" ){
                        $theme_id = $settings[ $current_theme_location ]['theme'];    
                        $menu_theme = $themes_style_manager->get_custom_theme_rowdata($theme_id);
                     
                        $theme_settings = unserialize($menu_theme->theme_settings);
                        $responsive_breakpoint_width = (isset($theme_settings['mobile_settings']['resposive_breakpoint_width']) && $theme_settings['mobile_settings']['resposive_breakpoint_width'] != '')?$theme_settings['mobile_settings']['resposive_breakpoint_width']:''; 
                  }else{
                         $theme_id = esc_attr($settings[ $current_theme_location ]['available_skin']);    
                         if(isset($apmega_general_settings['pre_responsive_bp']) && $apmega_general_settings['pre_responsive_bp'] != ''){
                           $pre_responsive_bp = $apmega_general_settings['pre_responsive_bp'];
                         }else{
                           $pre_responsive_bp = "910";
                         }
                         $responsive_breakpoint_width = $pre_responsive_bp; 
                  }

            }
       
        
          if(isset($apmega_general_settings['enable_mobile']) && $apmega_general_settings['enable_mobile'] != 1){
             $addClass = "wpmega-disable-menutoggle";
          }else{
             $addClass = "wpmega-enabled-menutoggle";
          }

        $main_content = "";

        $main_content = apply_filters( "wpmegamenu_togglebar_content", $main_content, $nav_menu, $args, $theme_id ,$apmega_general_settings);

        $replace = $dynamicclass . '<div class="wpmegamenu-toggle '. $addClass.'" data-responsive-breakpoint="'.$responsive_breakpoint_width.'">' . $main_content . '</div>';

        return str_replace( $dynamicclass, $replace, $nav_menu );

    }

     /**
     * Get the HTML output for the toggle blocks
     */
    public function wpmm_responsive_display_togglebar_content($content, $nav_menu, $args, $theme_id, $general_settings){

      $close_menu_icon =   $general_settings['close_menu_icon'];
      $open_menu_icon  =   $general_settings['open_menu_icon'];

       // if a current_theme_location has been passed, check to see if MMM has been enabled for the current_theme_location
       $settings = get_option( 'wpmegabox_settings' ); //get all plugin metabox data from nav menu location
       $current_theme_location = $args->theme_location;

        $menutoggle_name = __('Menu',APMM_PRO_TD);
        // this is for available theme toggle section
         $blocks_html = "<div class='wp-mega-toggle-block'>";
         $blocks_html .= "<div class='wpmega-closeblock'><i class='".$close_menu_icon."'></i></div>";
         $blocks_html .= "<div class='wpmega-openblock'><i class='".$open_menu_icon."'></i></div>";
         $blocks_html .= "<div class='menutoggle'>".$menutoggle_name."</div>";  
         $blocks_html .= "</div>";

      $content .= $blocks_html;

      return $content;
    }


  }//class termination


  /**
   * Plugin initialization with object creation
   */
  $wpmm_walker_obj = new WPMM_Walker_Class();
}//class exists check
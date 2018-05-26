<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if ( ! class_exists( 'WPMM_Menu_Widget_Manager' ) ) :
class WPMM_Menu_Widget_Manager extends WPMM_Libary{
    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'admin_init', array( $this, 'register_sidebar' ) ); // add sidebar to lists all wp mega menu added widgets on sidebar here
        /* Single Group Mega Menu */
        add_action( 'wp_ajax_wpmm_add_selected_widget', array( $this, 'wpmm_ajax_add_widget' ) ); // add widget on menu item using ajax
        add_action( 'wp_ajax_wpmm_selected_update_widget', array( $this, 'wpmm_ajax_update_widget' ) ); // update widgets 
        add_action( 'wp_ajax_wpmm_update_menu_item_columns', array( $this, 'wpmm_ajax_update_menu_item_columns' ) ); // save ajax mega menu for list of sub menu items
        add_action( 'wp_ajax_wpmm_reorder_widget_items', array( $this, 'wpmm_ajax_reorder_items' ) ); // reorder widgets by sortable techniques
        add_action( 'wp_ajax_wpmm_edit_widget_data', array( $this, 'wpmm_ajax_edit_widget_form' ) ); //edit widget data of specific widgets for menu item
        add_action( 'wp_ajax_wpmm_delete_widget', array( $this, 'wpmm_ajax_delete_widget_form' ) ); //edit widget data of specific widgets for menu item
        add_action( 'wp_ajax_wpmm_saveitemwidget', array( $this, 'wpmm_ajax_save_widget' ) );
          /* Multiple Group Mega Menu */
        add_filter( 'widget_update_callback', array( $this, 'wpmm_persist_mega_menu_widget_settings'), 10, 4 );
        add_action( 'wp_ajax_wpmm_add_selected_widget_lists', array( $this, 'wpmm_save_groupwise_widgetlists' ) ); // add widget on menu item using ajax
    
     }


      /**
     * Create our own widget area to store all mega menu widgets.
     * All widgets from all menus are stored here, they are filtered later
     * to ensure the correct widgets show under the correct menu item.
     */
    public function register_sidebar() {

        register_sidebar(
            array(
                'id' => 'wp-mega-menu',
                'name' => __("WP Mega Menu Pro Widgets", APMM_PRO_TD),
                'description'   => __("Do not manually edit this area.", APMM_PRO_TD)
            )
        );
    }


    function get_next_widget_idnum($id_base){
        global $wp_registered_widgets;
            $number = 1;
            foreach ( $wp_registered_widgets as $widget_id => $widget ) {
                if ( preg_match( '/' . $id_base . '-([0-9]+)$/', $widget_id, $matches ) )
                    $number = max($number, $matches[1]);
            }
            $number++;
            return $number;
    
    }



     /**
     * Add a widget to the right wp mega menu panel
     */
   public function wpmm_ajax_add_widget(){
      check_ajax_referer( 'apmm-ajax-nonce', '_wpnonce' );
     if(isset($_POST) && $_POST['id_base'] != '' && $_POST['menu_item_id'] != ''){
        $widgets_id_value    = sanitize_text_field($_POST['id_base']);
        $menu_item_id        = $_POST['menu_item_id'];
        $widget_title        = sanitize_text_field( $_POST['title'] );
        $group_type        = sanitize_text_field( $_POST['group_type'] );
        $group_no        = sanitize_text_field( $_POST['group_no'] );
        $added_widgets = $this->wpmm_add_widget_selected($widgets_id_value, $menu_item_id , $widget_title, $group_type,$group_no);
        if ( $added_widgets ) {
            if ( ob_get_contents() ) ob_clean();
              wp_send_json_success($added_widgets );
        } else {
            if ( ob_get_contents() ) ob_clean();
             wp_send_json_error();
        }

     }
      
    }

     /**
     * Adds a widget to WordPress. First creates a new widget instance
     */
   public function wpmm_add_widget_selected($widgets_id_value, $menu_item_id , $widget_title,$group_type,$group_no){
       
        require_once( ABSPATH . 'wp-admin/includes/widgets.php' );

        $next_id = $this->get_next_widget_idnum( $widgets_id_value );
        $my_current_widgetss = get_option( 'widget_' . $widgets_id_value );

       if($group_type == "multiple"){
        $my_current_widgetss[ $next_id ] = array(
            'wpmm_mega_menu_grouptype' => 'multiple',
            'wpmm_mega_menu_group_number' => $group_no,
            "wpmm_mega_menu_columns" => 2,
            "wpmm_mega_menu_parent_menu_id" => $menu_item_id
            
        );
       }else{
         $my_current_widgetss[ $next_id ] = array(
            "wpmm_mega_menu_columns" => 2,
            "wpmm_mega_menu_parent_menu_id" => $menu_item_id
        );
       }
     //  var_dump($my_current_widgetss);
        update_option( 'widget_' . $widgets_id_value, $my_current_widgetss );

        $widget_id = $widgets_id_value . '-' . $next_id;
        $sidebar_widgets = WPMM_Libary::wpmm_mm_sidebarwidgets();

         $sidebar_widgets[] = $widget_id;
         WPMM_Libary::wpmm_set_mm_sidebar_widgets($sidebar_widgets); 


       if($group_type == "multiple"){
        $classname = "wpmm_widget_areaa";
        }else{
        $classname = "wpmm_widget_area";
        }
         $return .= '<div id="' . $widget_id . '" class="'.$classname.'" data-title="' . esc_attr( $widget_title ) . '" data-columns="2" data-type="wp_widget" id="'.$widget_id.'" data-id="' . $widget_id . '">';
         $return .= '<div class="widget_main_top_section">';
         $return .= '<div class="widget_title">';
         $return .= '<span class="wpmm-drag-handler"><i class="fa fa-arrows" aria-hidden="true"></i></span>';
         $return .= '<span class="wptitle">' . esc_html( $widget_title ) . '</span></div>';
         $return .= '<div class="widget_right_action">';
         $return .= '<a class="widget-option wpmm_widget-contract" title="' . esc_attr( __("Contract",APMM_PRO_TD) ) . '">';
         $return .= '<i class="fa fa-caret-left" aria-hidden="true"></i></a>';
         $return .= '<span class="widget-cols"><span class="wpmm_widget-num-cols">2</span><span class="wpmm_widget-of">/</span>';
         $return .= '<span class="wpmm_widget-total-cols">X</span></span>';
         $return .= '<a class="widget-option wpmm_widget-expand" title="' . esc_attr( __("Expand", APMM_PRO_TD) ) . '"><i class="fa fa-caret-right" aria-hidden="true"></i></a>';
         $return .= '<a class="widget-option wpmm_widget-action" title="' . esc_attr( __("Edit",APMM_PRO_TD) ) . '">';
         $return .= '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
         $return .= '</div>';
         $return .= '</div>';
         $return .= '<div class="wpmm_widget_inner"></div>';
         $return .= '</div>';

        return $return;

    }


    /**
     * Depending on how a widget has been written, it may not necessarily base the new widget settings on
     * a copy the old settings. If this is the case, the mega menu data will be lost. This function
     * checks to make sure widgets persist the mega menu data when they're saved.
     * Note : This Function specially for plugin that need to filter a widget’s settings before saving.
     */
    public function wpmm_persist_mega_menu_widget_settings( $instance, $new_instance, $old_instance, $that ) {

        if ( isset( $old_instance["wpmm_mega_menu_columns"] ) && ! isset( $new_instance["wpmm_mega_menu_columns"] ) ) {
            $instance["wpmm_mega_menu_columns"] = $old_instance["wpmm_mega_menu_columns"];
        }

        if ( isset( $old_instance["wp_menu_order"] ) && ! isset( $new_instance["wp_menu_order"] ) ) {
            $instance["wp_menu_order"] = $old_instance["wp_menu_order"];
        }

        if ( isset( $old_instance["wpmm_mega_menu_parent_menu_id"] ) && ! isset( $new_instance["wpmm_mega_menu_parent_menu_id"] ) ) {
            $instance["wpmm_mega_menu_parent_menu_id"] = $old_instance["wpmm_mega_menu_parent_menu_id"];
        }

        return $instance;
    }



     /**
     * Update wp mega menu pro columns for a widget
     */
    public function wpmm_ajax_update_widget() {
        global $wp_registered_widget_controls;
        check_ajax_referer( 'apmm-ajax-nonce', '_wpnonce' );
        $widget_id = sanitize_text_field( $_POST['widget_unique_id'] );
        $columns = (int) $_POST['columns'];

        $widgetidbase = WPMM_Libary::wpmm_get_id_widget_id( $widget_id );   
        $widget_num =  absint( end( explode( "-", $widget_id )));
        $currentwidgets = get_option( 'widget_' . $widgetidbase );
        $currentwidgets[ $widget_num ]["wpmm_mega_menu_columns"] = absint( $columns) ;
        // Updates the number of wp mega columns for a specified widget.
        $get_results = update_option( 'widget_' . $widgetidbase, $currentwidgets );
        if ( ob_get_contents() ) ob_clean();
         if ($get_results) {
                wp_send_json_success();
         }else{
                wp_send_json_error();
        }
    }

     /**
     * Update the number of wp mega sub menu columns for a widget in mega menu
     */
    public function wpmm_ajax_update_menu_item_columns() {
        check_ajax_referer( 'apmm-ajax-nonce', '_wpnonce' );
        $submenuid = ( int ) $_POST['sub_menu_id'];
        $columns = ( int ) $_POST['columns'];
        $group_type = $_POST['group_type'];
        $megamenu_settings = get_post_meta( $submenuid, '_wpmegamenu', true);
        if($group_type == "single"){
             $megamenu_settings['wpmm_mega_menu_columns'] = absint( $columns );
        }else{
             $megamenu_settings['wpmm_group_mega_menu_columns'] = absint( $columns );
        }
       
        /* Updates the number of wp mega columns for a specified widget. */
        $updated = update_post_meta( $submenuid, '_wpmegamenu', $megamenu_settings );
        if ( ob_get_contents() ) ob_clean();
        if ( $updated ) {
                wp_send_json_success();
        } else {
                wp_send_json_error();
        }

    }    

    
     /**
     * In Single Group saved widget in sortable order
     */
    public function wpmm_ajax_reorder_items() {
        check_ajax_referer( 'apmm-ajax-nonce', '_wpnonce' );
        $items = isset( $_POST['menuitems'] ) ? $_POST['menuitems'] : false;
        if ( $items ) {
             foreach ( $items as $item ) {
                                if(isset($item['parent_menu_item_id'])){
                                      $parent_menu_id = $item['parent_menu_item_id'];
                                      $submitted_settings = array( 'submenu_ordering' => 'forced' );
                                      $default_settings = get_post_meta( $parent_menu_id, '_wpmegamenu', true );
                                      $itemid = $parent_menu_id;
                                }
                                // check if widget type menu items
                                 if($item['type'] == 'wp_widget' ) {
                                    //Change the order if its megamenu is widget added for top level menu and save data into postmeta with key as _wpmegamenu
                                    $widget_id = $item['id'];
                                    $order = $item['order'];
                                    $parent_menu_item_id = $item['parent_menu_item_id'];
                                    // Updates the order of a specified widget start //
                                    $widget_id_base = WPMM_Libary::wpmm_get_id_widget_id( $widget_id );
                                    $widget_number = absint( end ( explode( "-", $widget_id ) ) );
                                    $current_widgets = get_option( 'widget_' . $widget_id_base );
                                    $current_widgets[ $widget_number ]["wp_menu_order"] = array( $parent_menu_item_id => absint( $order ) );
                                    update_option( 'widget_' . $widget_id_base, $current_widgets );
                                     // Updates the order of a specified widget end//
                                  }else if($item['type'] == 'wpmm_menu_subitem'){
                                      // check if sub menu type menu items
                                    // Updates the order of a specified menu item. Change the order if its sub menu items of top level with data-type as wpmm_menu_subitem
                                    $submitted_settings['wp_menu_order'] = array($item['parent_menu_item_id']  => absint( $item['order'] ) );
                                    $default_settings = get_post_meta(  $item['id'] , '_wpmegamenu' , true);       
                                    $itemid = $item['id'];
                                  }     

                          if( isset( $default_settings ) ) {
                                if( is_array( $default_settings ) ) {
                                  $submitted_settings = array_merge( $default_settings, $submitted_settings );
                                }
                                update_post_meta(  $itemid, '_wpmegamenu', $submitted_settings );
                          }

                       }

                    if ( ob_get_contents() ) ob_clean();
                      wp_send_json_success();
                }else{
                      if ( ob_get_contents() ) ob_clean();
                        wp_send_json_error();
                }
        }

     /**
     * Display a Specific widget Form
     */
    public function wpmm_ajax_edit_widget_form() {
        check_ajax_referer( 'apmm-ajax-nonce', '_wpnonce' );
        $widget_id_base = sanitize_text_field( $_POST['widget_id_base'] );
        if ( ob_get_contents() ) ob_clean(); 
        wp_die( trim( WPMM_Libary::show_widget_form( $widget_id_base ) ) );
    }


    /*
     * Delete Widget method
     */
  public function wpmm_ajax_delete_widget_form(){
        check_ajax_referer( 'apmm-ajax-nonce', '_wpnonce' );
        $widget_id = sanitize_text_field( $_POST['widget_id_base'] );
       /* Removes a widget from the WP Mega Menu widget sidebar start*/
        $widgets = WPMM_Libary::wpmm_mm_sidebarwidgets();

        $get_widgets_except_removed_widgets = array();

        foreach ( $widgets as $widget ) {

            if ( $widget != $widget_id ){
                $get_widgets_except_removed_widgets[] = $widget;
            }

        }

        WPMM_Libary::wpmm_set_mm_sidebar_widgets($get_widgets_except_removed_widgets);
        /* Removes a widget from the WP Mega Menu widget sidebar end */
        /* Removes a widget from the WP Mega Menu widget sidebar start */
        $id_base = WPMM_Libary::wpmm_get_id_widget_id( $widget_id );
        
        $widget_number = absint( end( explode( "-", $widget_id ) ) );

        $current_widgets = get_option( 'widget_' . $id_base );
        if ( isset( $current_widgets[ $widget_number ] ) ) {
            unset( $current_widgets[ $widget_number ] );
           $results =  update_option( 'widget_' . $id_base, $current_widgets );
        }
        /* Removes a widget from the WP Mega Menu widget sidebar end*/

        if ( $results ) {
             wp_send_json_success();
        } else {
             wp_send_json_error();
        }
  }

  public static function get_widget_num($widget_id){
     /* get widget number from here */
        global $wp_registered_widget_controls;
        $control_widget = isset($wp_registered_widget_controls[$widget_id]) ? $wp_registered_widget_controls[$widget_id] : array();
        $widget_number = isset($control_widget['params'][0]['number']) ? $control_widget['params'][0]['number'] : '';
        /* get widget number from here end */
        return $widget_number;
  }


  /**
   * Save a widget Data
  */
  public function wpmm_ajax_save_widget(){

        global $wp_registered_widget_updates; 
        // echo "<pre>";
        // print_r($wp_registered_widget_updates);
        //  exit();
        $widget_id = sanitize_text_field( $_POST['widget_id'] );
        $id_base = sanitize_text_field( $_POST['id_base'] );
        //check_ajax_referer( 'wpmm_save_widget_' . $widget_id );
         /* Saves a widget. Calls the update callback on the widget. 
         The callback inspects the post values and updates all widget instances which match the base ID. */
         // echo  $widget_id;
         // echo  $id_base;
        $control_widgets = $wp_registered_widget_updates[$id_base];
        // echo "<pre>";
        // print_r($control_widgets);
        // exit();
        if ( is_callable( $control_widgets['callback'] ) ) {
             call_user_func_array( $control_widgets['callback'], $control_widgets['params'] );
             wp_send_json_success();
        }else{
             wp_send_json_error();
        }
  }


     /**
         * Returns an array of widgets and second level menu items for a specified parent menu item.
         * Used to display the widgets/menu items in the mega menu builder.
     */
    public function wpmm_get_widgets_and_menu_items_for_menu_id( $parent_menu_item_id, $menu_id , $grouptype ) {
       
        $menu_items = WPMM_Libary::get_all_sub_menu_items($menu_id,$parent_menu_item_id,$grouptype); //get all sub menu item
        $widgets = $this->wpmm_getwidgets_menuid( $parent_menu_item_id, $menu_id , $grouptype);
        $items = array_merge( $menu_items, $widgets );
        $parent_settings = get_post_meta( $parent_menu_item_id, '_wpmegamenu', true );
        $ordering = isset( $parent_settings['submenu_ordering'] ) ? $parent_settings['submenu_ordering'] : 'natural';
      
       if($grouptype == "multiple"){
               $end_items = array();
                $arr = array();
                     $group_details = $this->wpmm_get_group_details($parent_menu_item_id);
                    if(!empty($group_details )){
                     $widget_details = unserialize($group_details->widget_details);
                         $new_items = $items;
                         if(!empty($widget_details)){
                         foreach ($widget_details as $key => $value) {
                            $splitlists = explode(',', $value['lists']);
                        
                            $group_number = $value['group_no'];
                            if(!empty($splitlists)){
                                  for ($i=0; $i < count($splitlists); $i++) { 
                                   if($splitlists[$i] != ''){
                                      if(intval($splitlists[$i])){
                                         $arr[$i] = 
                                                 array(
                                                   'id' => $splitlists[$i],
                                                   'type' => $new_items[$i]['type'],
                                                   'title' => $new_items[$i]['title'],
                                                   'group_type' => 'multiple',
                                                   'group_number' => $group_number,
                                                   'columns' => $new_items[$i]['columns'],
                                                   'order' => $new_items[$i]['order'],
                                                 );
                                    }else{
                                        $arr[$splitlists[$i]] = 
                                                 array(
                                                   'id' => $splitlists[$i],
                                                   'type' => $new_items[$splitlists[$i]]['type'],
                                                   'title' => $new_items[$splitlists[$i]]['title'],
                                                   'group_type' => 'multiple',
                                                   'group_number' => $group_number,
                                                   'columns' => $new_items[$splitlists[$i]]['columns'],
                                                   'order' => $new_items[$splitlists[$i]]['order'],
                                                 );

                                    }
                                   }
                                    
                                  }
                            }
                         }
                     }
                 }
                $end_items = array_merge( $end_items, $arr );
                $array1 = $items;
                $array2 = $end_items;
                $arr1 = array();
                foreach ($array1 as $key1 => $value1) {
                    if(is_numeric($key1)) {
                        $arr1[] = $value1['id'];
                    }
                }
                $arr2 = array();
                foreach ($array2 as $key2 => $value2) {
                    if(is_numeric($key2)) {
                        $arr2[] = $value2['id'];
                    }
                }
                $common = array_diff($arr1, $arr2);

                foreach ($array1 as $key => $value) {
                    if(in_array($value['id'], $common)) {
                        $array2[] = $value;
                    }
                }
                $items =  $array2;
        }else{
                        
                    if ( $ordering == 'forced' ) {
                          uasort( $items, array( $this, 'wpmm_sort_by_order' ) );
                        $new_items = $items;
                        $end_items = array();
                        foreach ( $items as $key => $value ) {
                            if ( $value['order'] == 0 ) {
                                unset( $new_items[$key] );
                                $end_items[] = $value;
                            }
                        }
                        $items = array_merge( $new_items, $end_items );
                    }

                  }
                  
        return $items;
    }  


    /**
     * Returns an array of all widgets belonging to a specified menu item ID.
     * int $menu_item_id
     * used on walker class
     */    
    public static function wpmm_getwidgets_menuid( $parent_menu_item_id, $menu_id , $grouptype) {
        $widgets = array();
        $mega_menu_widgets = WPMM_Libary::wpmm_mm_sidebarwidgets();
        if (  $mega_menu_widgets ) {
            foreach ( $mega_menu_widgets as $widget_id ) {   
                $settings = WPMM_Menu_Widget_Manager::wpmm_get_settings_for_widget_id( $widget_id );
                if ( isset( $settings['wpmm_mega_menu_parent_menu_id'] ) && $settings['wpmm_mega_menu_parent_menu_id'] == $parent_menu_item_id ) {
                    $grptype = (isset($settings['wpmm_mega_menu_grouptype']) && $settings['wpmm_mega_menu_grouptype'] == "multiple")?'multiple':'single';
                    $grpnumber = isset($settings['wpmm_mega_menu_group_number'])?$settings['wpmm_mega_menu_group_number']:'1';
                    $widgetname = WPMM_Menu_Widget_Manager::wpmmgetnameforwidgetid( $widget_id ); //get widget real name
                    $wpmm_group_mega_menu_columns = (isset($settings['wpmm_group_mega_menu_columns']) && $settings['wpmm_group_mega_menu_columns'] != '')?$settings['wpmm_group_mega_menu_columns']:'';
                    $wpmm_mega_menu_columns = (isset($settings['wpmm_mega_menu_columns']) && $settings['wpmm_mega_menu_columns'] != '')?$settings['wpmm_mega_menu_columns']:'1';
                    $widgets[ $widget_id ] = array(
                        'id' => $widget_id,
                        'type' => 'wp_widget',
                        'title' => $widgetname,
                        'group_type' =>  $grptype,
                        'group_number' => $grpnumber,
                        'columns' => $wpmm_mega_menu_columns,
                        'group_columns' =>$wpmm_group_mega_menu_columns,
                        'order' => isset( $settings['wp_menu_order'][ $parent_menu_item_id ] ) ? $settings['wp_menu_order'][ $parent_menu_item_id ] : 0
                    );
                }

            }

        }

        return $widgets;

    } 



    /**
     * Returns the name/title of a Widget
     */
    public static function wpmmgetnameforwidgetid( $widget_id ) {
        global $wp_registered_widgets;
        $registered_widget = $wp_registered_widgets[$widget_id];
        return $registered_widget['name'];

    }


     /**
     * Returns the widget data as stored in the options table
     */
    public static function wpmm_get_settings_for_widget_id( $widget_id ) {
        $id_base = WPMM_Libary::wpmm_get_id_widget_id( $widget_id );

        if ( ! $id_base ) {
            return false;
        }
        $widget_number = WPMM_Menu_Widget_Manager::get_widget_num($widget_id);
        $current_widgets = get_option( 'widget_' . $id_base );

        return $current_widgets[ $widget_number ];

    }




    /**
     * Sorts a 2d array by the 'order' key
     */
    function wpmm_sort_by_order( $a, $b ) {

        if ($a['order'] == $b['order']) {
            return 1;
        }
        return ($a['order'] < $b['order']) ? -1 : 1;

    }


    /**
     * Returns the HTML for a single widget instance used on walker class
     */
    public function wpmmshowwidget( $id ) {
        global $wp_registered_widgets;
        if(isset( $id) &&  $id != ''){
        $widget_paramters_array = array_merge(
            array( array_merge( array( 'widgetid' => $id, 'widgetname' => $wp_registered_widgets[$id]['name'] ) ) ),
            (array) $wp_registered_widgets[$id]['params']
        );

        $widget_paramters_array[0]['before_title']  = apply_filters( "wpmm_before_widget_title", '<h4 class="wpmm-mega-block-title">', $wp_registered_widgets[$id] );
        $widget_paramters_array[0]['after_title']   = apply_filters( "wpmm_after_widget_title", '</h4>', $wp_registered_widgets[$id] );
        $widget_paramters_array[0]['before_widget'] = apply_filters( "wpmm_before_widget", "", $wp_registered_widgets[$id] );
        $widget_paramters_array[0]['after_widget']  = apply_filters( "wpmm_after_widget", "", $wp_registered_widgets[$id] );
        $callback = $wp_registered_widgets[$id]['callback'];
        if ( is_callable( $callback ) ) {
            ob_start();
            call_user_func_array( $callback, $widget_paramters_array );
            return ob_get_clean();
        }
       }else{
        return false;
       }

    }

    /**
     * Returns the class name for a widget instance.
     * used on walker class
     */
    public function wpmm_getwidget( $id ) {
        global $wp_registered_widgets;

        if ( isset ( $wp_registered_widgets[$id]['classname'] ) ) {
            return $wp_registered_widgets[$id]['classname'];
        }

        return "";
    }

   

    public static function wpmm_get_group_details($menu_item_idd ) {
        global $wpdb;
          $table_name    = $wpdb->prefix . "apmm_menugrouplists";
          $wpmm_groups   = $wpdb->get_row("SELECT * FROM $table_name where menuid = $menu_item_idd");
          return $wpmm_groups;


    }

    public function wpmm_save_groupwise_widgetlists(){
      global $wpdb;
      $table_name = $wpdb->prefix .'apmm_menugrouplists';

     check_ajax_referer( 'apmm-ajax-nonce', '_wpnonce' );
     if(isset($_POST) && $_POST['menu_item_id'] != ''){
        $wpmm_menu_item_id        = $_POST['menu_item_id'];
        $widget_details           = (isset($_POST['widget_details']) && !empty($_POST['widget_details'] )?$_POST['widget_details']:array());
        $group_type               = sanitize_text_field( $_POST['group_type'] );
        $wpmm_menu_details        = $wpdb->get_row("SELECT * FROM $table_name where menuid = $wpmm_menu_item_id ");
        if(!empty($wpmm_menu_details)){
           $idata = $wpdb->update( 
                    $table_name, 
                    array(
                                 'group_type'     =>  $group_type,
                                 'widget_details' => serialize($widget_details)   
                          ),
                      array('menuid'=>$wpmm_menu_item_id), 
                    array(
                          '%s',
                          '%s'
                      ),
                      array('%d')
                  );
        $results = $wpdb->query( $idata );

        }

     }

       if ( ob_get_contents() ) ob_clean();
        wp_send_json_success();

    }



}
$GLOBALS['widget_object'] = new WPMM_Menu_Widget_Manager();
endif;
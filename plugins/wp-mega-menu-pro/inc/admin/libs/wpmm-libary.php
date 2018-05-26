<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * WP Mega Menu Library Class
 * Contains all the common functions
 */
if ( !class_exists( 'WPMM_Libary' ) ) {

    class WPMM_Libary {

       /**
       * Print An Array
       */
       public function displayArr($array){
          echo "<pre>";
          print_r($array);
          echo "</pre>";
        }

        /**
         * Query WooCommerce activation check
        */
        public static function is_woocommerce_activated() {
          return class_exists( 'woocommerce' ) ? true : false;
        }

       /**
       * Get size information for all currently-registered image sizes.
       *
       * @global $_wp_additional_image_sizes
       * @uses   get_intermediate_image_sizes()
       * @return array $sizes Data for all currently-registered image sizes.
       */
        public static function wpmm_get_image_sizes() {
        global $_wp_additional_image_sizes;

        $sizes = array();

        foreach ( get_intermediate_image_sizes() as $_size ) {
          if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
            $sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
            $sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
            $sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
          } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array(
              'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
              'height' => $_wp_additional_image_sizes[ $_size ]['height'],
              'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
            );
          }
        }

        return $sizes;
      }


      /*
      * Append Custom CSS
      */
       public static function get_custom_designs($current_theme_location,$settings){           
          include(APMM_PRO_PATH.'/inc/frontend/custom_theme_css.php');
        }

        
     public static function wpmm_get_excerptbyid($post_id,$post_length){
            $the_post = get_post($post_id); //Gets post ID
            $the_excerpt = $the_post->post_excerpt; //Gets post_content to be used as a basis for the excerpt
            $excerpt_length = $post_length; //Sets excerpt length by word count
            $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
            $words = explode(' ', $the_excerpt, $excerpt_length + 1);
            if(count($words) > $excerpt_length) :
            array_pop($words);
            array_push($words, '');
            $the_excerpt = implode(' ', $words);
            endif;
            $the_excerpt =  $the_excerpt;
            return $the_excerpt;
         }

        /**
         * Get current taxonomy  
         * */
       public static function get_all_taxonomy_lists(){
            wp_reset_postdata();
            $args = array('public'   => true,'_builtin' => false); 
            $output = 'objects';  //or objects
            $operator = 'and';  //'and' or 'or'
            $taxonomies = get_taxonomies($args,$output,$operator);
            $taxanomy_lists = array();
            if(count($taxonomies) > 0){
                  foreach($taxonomies as $taxonomy => $vlue) :
                   //  $taxanomy_lists[] = $vlue->labels->singular_name;
                   $taxanomy_lists[] = $taxonomy;
                endforeach;
                return $taxanomy_lists;
            }
         }

          //returns all the registered post types only
        public static function wpmm_get_registered_post_types() {
           $post_types = get_post_types();
           unset($post_types['attachment']);
           unset($post_types['page']);
           unset($post_types['product_variation']);
           unset($post_types['shop_order']);
           unset($post_types['shop_order_refund']);
           unset($post_types['shop_coupon']);
           unset($post_types['shop_webhook']);
           unset($post_types['wp1slider']);
           unset($post_types['revision']);
           unset($post_types['nav_menu_item']);
           unset($post_types['wp-types-group']);
           unset($post_types['wp-types-user-group']);
           return $post_types;
       }

       //Set the Post Custom Field in the WP dashboard as Name/Value pair 
       public static function wpmm_PostViews($post_ID) {
         
            //Set the name of the Posts Custom Field.
            $count_key = 'post_views_count'; 
             
            //Returns values of the custom field with the specified key from the specified post.
            $count = get_post_meta($post_ID, $count_key, true);
             
            //If the the Post Custom Field value is empty. 
            if($count == ''){
                $count = 0; // set the counter to zero.
                 
                //Delete all custom fields with the specified key from the specified post. 
                delete_post_meta($post_ID, $count_key);
                 
                //Add a custom (meta) field (Name/value)to the specified post.
                add_post_meta($post_ID, $count_key, '0');
                return $count;
             
            //If the the Post Custom Field value is NOT empty.
            }else{
                $count++; //increment the counter by 1.
                //Update the value of an existing meta key (custom field) for the specified post.
                update_post_meta($post_ID, $count_key, $count);
                 
                //If statement, is just to have the singular form 'View' for the value '1'
                if($count == '1'){
                return $count;
                }
                //In all other cases return (count) Views
                else {
                return $count;
                }
            }
        }

    
     /**
     * Returns an unfiltered array of all widgets in our sidebar
     */
    public static function wpmm_mm_sidebarwidgets() {
        $wpmm_sidebar_widgets = wp_get_sidebars_widgets();
        if ( ! isset( $wpmm_sidebar_widgets[ 'wp-mega-menu'] ) ) {
            return false;
        }
        return $wpmm_sidebar_widgets[ 'wp-mega-menu' ];

    }

    /**
     * Sets the sidebar widgets
     */
    public static function wpmm_set_mm_sidebar_widgets( $widgets ) {

        $wpmm_sidebar_widgets = wp_get_sidebars_widgets();
        $wpmm_sidebar_widgets[ 'wp-mega-menu' ] = $widgets;
        wp_set_sidebars_widgets( $wpmm_sidebar_widgets );

    }


     /**
     * Returns an specific wp mega menu pro widget object.
     */
    public static function wpmm_get_specific_widgets() {
        global $wp_widget_factory;
        $wpmegamenupro_widgets = array(); 
        foreach( $wp_widget_factory->widgets as $wordpress_widget ) {
            $idbase = $wordpress_widget->id_base;
            $widget_name = $wordpress_widget->name;
            $description = $wordpress_widget->widget_options['description'];
              $wpmmpro_widgets = array(
                'wpmegamenu_contact_info',
                'wpmegamenu_pro_html_text',
                'wpmegamenu_pro_textimage',
                'wpmm_pro_post_heading_widget',
                'wpmegamenu_pro_poststimeline',
                'wpmegamenu_pro_blogformat',   
                'wpmm-featured-box-layout',
                'wpmm_pro_simple_recent_posts_widget_area',
                'wpmm_pro_recent_products_widget_area',
                'wpmm_pro_products_cart_widget_area',
                'wpmm_pro_productlist_widget_area',
                'wpmegamenu_pro_advanced_postslider',
                'wpmegamenu_pro_linkimage',
                'wpmegamenu_pro_gallery_image');

            if (in_array( $idbase , $wpmmpro_widgets ) ) {
                $wpmegamenupro_widgets[] = array(
                    'name' => $widget_name,
                    'value' => $idbase,
                    'description' => $description
                );

            }

        }
        return $wpmegamenupro_widgets;
    }


   /**
     * Returns an objects representing all widgets registered in woocommerce widgets
     */
   public static function wpmm_get_woo_widgets(){
        global $wp_widget_factory;
        $wordpress_widgets = array();
        foreach( $wp_widget_factory->widgets as $wordpress_widget ) {
            $idbase = $wordpress_widget->id_base;
            $widget_name = $wordpress_widget->name;
            $description = $wordpress_widget->widget_options['description'];
           if (strpos($idbase, 'woocommerce') !== false) {
                $wordpress_widgets[] = array(
                    'name' => $widget_name,
                    'value' => $idbase,
                    'description' => $description
                );
            }
        }
        return $wordpress_widgets;
    }




    /**
     * Returns an object representing all widgets registered in WordPress
     */
    public static function wpmm_get_available_widgets() {
        global $wp_widget_factory;
        $available_widgets = array();

        foreach( $wp_widget_factory->widgets as $wordpress_widget ) {
            $idbase = $wordpress_widget->id_base;
            $widget_name = $wordpress_widget->name;
            $description = $wordpress_widget->widget_options['description'];

               $disabled_widgets = array(
                'wpmegamenu_widget',
                'wpmegamenu_contact_info',
                'wpmegamenu_pro_html_text',
                'wpmegamenu_pro_textimage',
                'wpmm_pro_post_heading_widget',
                'wpmegamenu_pro_poststimeline',
                'wpmegamenu_pro_blogformat',   
                'wpmm-featured-box-layout',
                'wpmm_pro_simple_recent_posts_widget_area',
                'wpmm_pro_recent_products_widget_area',
                'wpmm_pro_products_cart_widget_area',
                'wpmm_pro_productlist_widget_area',
                'wpmegamenu_pro_advanced_postslider',
                'wpmegamenu_pro_linkimage',
                'wpmegamenu_pro_gallery_image');

            if ( ! in_array( $wordpress_widget->id_base, $disabled_widgets ) ) {
               if (strpos($idbase, 'woocommerce') !== false) { }else{
                 $available_widgets[] = array(
                     'name' => $widget_name,
                     'value' => $idbase,
                     'description' => $description
                );
               }
            }
        }
        return $available_widgets;

    }

    /**
     * Returns the id_base value for a Widget ID wpmm_get_id_base_for_widget_id
     */
    public static function wpmm_get_id_widget_id( $widget_id ) {
        global $wp_registered_widget_controls;

        if ( ! isset( $wp_registered_widget_controls[ $widget_id ] ) ) {
            return false;
        }

        $control = $wp_registered_widget_controls[ $widget_id ];

        $id_base = isset( $control['id_base'] ) ? $control['id_base'] : $control['id'];

        return $id_base;

    }
    
    /*
    * Widget CallBack Form: On edit specific widget on megamenu backend display widgets callback form 
    */
    public static function show_widget_form($widget_id_base){
     global $wp_registered_widget_controls;
        $control_widget =$wp_registered_widget_controls[$widget_id_base];
        $control = $wp_registered_widget_controls[ $widget_id_base ];
        $id_base = isset( $control['id_base'] ) ? $control['id_base'] : $control['id'];
        $widget_number = isset($control_widget['params'][0]['number']) ? $control_widget['params'][0]['number'] : '';
        $widget_nonce = wp_create_nonce('wpmm_save_widget_' . $widget_id_base);
        $before_form = '<form method="post">';
        $after_form = '</form>';?>
        
        <div class='wpmm_widget-content'>
             <?php echo $before_form; ?>
                <input type="hidden" name="widget_id" class="widget-id" value="<?php echo esc_attr($widget_id_base); ?>" />
                <input type='hidden' name='action' value='wpmm_saveitemwidget' />
                <input type='hidden' name='id_base' class="id_base" value='<?php echo esc_attr($id_base); ?>' />
                <input type='hidden' name='_wpnonce' value='<?php echo $widget_nonce ?>' />
                <input type="hidden" name="widget_number" class="widget_number" value="<?php echo esc_attr($widget_number); ?>" />

                <?php
                if ( isset( $control_widget['callback'] ) ) {
                    if ( is_callable( $control_widget['callback'] ) ) {
                        call_user_func_array( $control_widget['callback'], $control_widget['params'] );
                    }
                }else{ ?>
                   <p><?php  __('There are no options for this widget.',APMM_PRO_TD);?></p>
               <?php } ?>

                <div class='wpmm-widget-controls'>
                    <a class='wpmm_delete' href='#delete'><?php _e("Delete", APMM_PRO_TD); ?></a> |
                    <a class='wpmm_close' href='#close'><?php _e("Close", APMM_PRO_TD); ?></a>
                </div>

                <?php
                    submit_button( __( 'Save' ), 'button-primary alignright', 'wpmm_savewidget', false );
                ?>
            <?php echo $after_form; ?>
        </div>
   <?php  }


      public static function get_all_sub_menu_items($menu_id,$parent_menu_item_id,$grouptype){

    /* Returns an array of immediate child menu items for the current item*/
        if($grouptype == "multiple"){
            $groupnumber = '1';
        }else{
            $groupnumber = '';
        }
         $items = array();

        // check we're using a valid menu ID
        if ( ! is_nav_menu( $menu_id ) ) {
            return $items;
        }
         $menu = wp_get_nav_menu_items( $menu_id );
        if ( count( $menu ) ) {

            foreach ( $menu as $item ) {

                // find the child menu items
                if ( $item->menu_item_parent == $parent_menu_item_id ) {

                    $saved_settings = array_filter( (array) get_post_meta( $item->ID, '_wpmegamenu', true ) );
                    $submitted_default_settings = new AP_Menu_Settings();
                    $submitted_settings = $submitted_default_settings->wpmm_menu_item_defaults();
                    $settings = array_merge(  $submitted_settings , $saved_settings );
                      // echo "<pre>";
                      // print_r($submitted_settings);
                      // die();
                    if($groupnumber == ''){
                     $items[ $item->ID ] = array(
                        'id' => $item->ID,
                        'type' => 'wpmm_menu_subitem', //menu_item i.e second item display on mega menu
                        'title' => $item->title,
                        'columns' => $settings['wpmm_mega_menu_columns'],
                        'order' => isset( $settings['wp_menu_order'][ $parent_menu_item_id ] ) ? $settings['wp_menu_order'][ $parent_menu_item_id ] : 0
                    );
                    }else{
                        $items[ $item->ID ] = array(
                        'id' => $item->ID, 
                        'type' => 'wpmm_menu_subitem', //menu_item i.e second item display on mega menu
                        'title' => $item->title,
                        'columns' => $settings['wpmm_mega_menu_columns'],
                        'order' => isset( $settings['wp_menu_order'][ $parent_menu_item_id ] ) ? $settings['wp_menu_order'][ $parent_menu_item_id ] : 0,
                        'group_number' => $groupnumber,
                        'group_type' => 'multiple'
                    );

                    }
                   

                }

            }

        }

    return $items;
   }


    /*
    * Get Menu title from menu id
    */
    public static function get_sub_menu_items($parent_menu_item_id,$menu_id,$id){
         $items = array();

        // check we're using a valid menu ID
        if ( ! is_nav_menu( $menu_id ) ) {
            return $items;
        }
         $menu = wp_get_nav_menu_items( $menu_id );
        if ( count( $menu ) ) {

            foreach ( $menu as $item ) {

                // find the child menu items
                if ( $item->menu_item_parent == $parent_menu_item_id ) {
                  if($item->ID == $id){
                    $items[] = array(
                        'id' => $item->ID,
                        'type' => 'wpmm_menu_subitem', //menu_item i.e second item display on mega menu
                        'title' => $item->title
                    );
                   
                  }
                     
                   

                }

            }

        }

    return $items;
   }
   


           public static function get_id_base_for_widget_id( $widget_id ) {
        global $wp_registered_widget_controls;

        if ( ! isset( $wp_registered_widget_controls[ $widget_id ] ) ) {
            return false;
        }

        $control = $wp_registered_widget_controls[ $widget_id ];

        $id_base = isset( $control['id_base'] ) ? $control['id_base'] : $control['id'];

        return $id_base;

    }
        public static function get_widget_number_for_widget_id( $widget_id ) {

        $parts = explode( "-", $widget_id );

        return absint( end( $parts ) );

    }

         
// nav_menu_itemID


    }//class termination
}//class exists check
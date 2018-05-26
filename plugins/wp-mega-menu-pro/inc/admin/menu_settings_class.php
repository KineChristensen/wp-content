<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if ( ! class_exists( 'AP_Menu_Settings' ) ) :
/**
 * Admin Menu Settings
 */
class AP_Menu_Settings {

  var $wpmmenu_id = 0;
  var $wpmmenu_item_id = 0;
  var $wpmmenu_item_depth = 0;
  var $wpmmenu_item_meta = array();
    /**
     * Constructor
     */
    public function __construct() {
              add_action( 'admin_menu' , array($this ,  'apmm_menu_page') ); // add plugin menu
              add_action('admin_enqueue_scripts', array($this, 'apmegamenu_admin_scripts'));
              add_action( 'wp_megamenu_nav_menus_scripts', array( $this, 'enqueue_menu_page_scripts' ), 9 );
              add_action('admin_post_apmegamenu_save_settings',array($this,'apmegamenu_save_settings')); //recieves the posted values from general settings
             /* custom metabox to enable */
              add_action( 'admin_head', array($this, 'addAPMegamenuMetaBox')); // Metabox on left of menu to enable megamenu
              add_action('admin_footer', array( $this, 'wpmm_admin_footer_function' ));

              add_action( 'wp_ajax_wpmmsavesettings', array($this, 'wp_save_settings') ); //ajax ap menu settings save to options
              add_action( 'wp_ajax_wpmm_show_lightbox_html', array( $this, 'wpmm_getlightbox_by_ajax' ) );
              add_action( 'wp_ajax_wpmm_save_menuitem_settings', array( $this, 'save_menuitem_settings_byajax') ); //save ajax data of each menu item
              
              //pro features 
              add_action( 'admin_init' , array( $this,'wpmegamenu_custom_menu_items_meta_box') );
              add_filter( 'wpmm_custom_menu_item_types' , array( $this,'wpmm_pro_custom_menu_item_types') );

              add_action('wp_ajax_wpmm_save_menu_group_settings',array($this, 'save_menu_group_settings'));
              add_action('wp_ajax_wpmm_edit_menu_group_settings',array($this, 'edit_menu_group_settings'));

              add_filter('siteorigin_panels_is_admin_page', array( $this, 'enable_site_origin_page_builder' ) );

              if ( function_exists( 'siteorigin_panels_admin_enqueue_scripts' ) ) {
                  add_action( 'admin_print_scripts-nav-menus.php', array( $this, 'siteorigin_panels_admin_enqueue_scripts') );
              }

              if ( function_exists( 'siteorigin_panels_admin_enqueue_styles' ) ) {
                  add_action( 'admin_print_styles-nav-menus.php', array( $this, 'siteorigin_panels_admin_enqueue_styles') );
              }
           }



     /**
     * Enqueue Site Origin Page Builder scripts on nav-menus page.
     */
    public function enable_site_origin_page_builder( $enabled ) {
        $screen = get_current_screen();

        if ($screen->base == 'nav-menus') {
            return true;
        }

        return $enabled;
    }


     /**
     * Enqueue Page Builder scripts 
     * (https://wordpress.org/plugins/siteorigin-panels/)
     */
    public function siteorigin_panels_admin_enqueue_scripts() {
        siteorigin_panels_admin_enqueue_scripts('', true);
    }


    /**
     * Enqueue Page Builder styles
     */
    public function siteorigin_panels_admin_enqueue_styles() {
        siteorigin_panels_admin_enqueue_styles('', true);
    }


    /**
     * Return the default settings for each menu item
    */
    public static function wpmm_menu_item_defaults() {

        $defaults = array(
            'menu_type'              => 'flyout', //flyout or megamenu
            'group_type'             => 'single', //single or multiple group for mega menu only
            //'total_group'            => '', //single or multiple group for mega menu only
            'panel_columns'          => 6, // total number of columns displayed in the panel
            'wpmm_mega_menu_columns' => 1, // for sub menu items, how many columns to span in the panel,
            'wpmm_group_mega_menu_columns' => 1, // for sub menu items, how many columns to span in the panel,
            'wp_menu_order'          => 0,
            'general_settings'       => array(
                  'active_link'             => 'true',
                  'disable_text'            => 'false',
                  'disable_desc'            => 'false',
                  'visible_hidden_menu'     => 'false',
                  'hide_arrow'              => 'false',
                  'hide_on_mobile'          => 'false',
                  'hide_on_desktop'         => 'false',
                  'menu_icon'               => 'disabled',
                  'active_single_menu'      => 'disabled',   //useful for custom single menu links
                  'menu_align'              => 'left',      //default as left with left or right menitem useful for custom search bar:Right aligned items will appear in reverse order on the right hand side of the menu bar            
                  'top_menu_label'          => '',         // Hot! , New! for top menu
                  'hide_sub_menu_on_mobile' => 'false',
                  'submenu_align'           => 'left',       //left or right, // flyout menu
                  'show_menu_to_users'      => 'always_show',
                  'choose_trigger_effect'   => 'onhover',
                  'tabbed_animation'        => 'fadeInDown'
            ),
           'mega_menu_settings'      => array(
                    'horizontal-menu-position' => 'full-width', //full-width, center, left-edge and right-edge
                   'vertical-menu-position'    => 'full-height', //full-height or aligned-to-parent
                   'show_top_content'          => 'true',
                   'show_bottom_content'       => 'true',
                   'top' => array(
                        'top_content_type'     => 'text_only',
                        'top_content'          => '',
                        'image_url'            =>  '',
                        'html_content'         => ''
                    ),
                'bottom'                   => array(
                        'bottom_content_type'  => 'text_only',
                        'bottom_content'       => '',
                        'image_url'            => '',
                        'html_content'         => ''
                    ),
                    'choose_menu_type'         => 'default',  // for default as sub menu and search form display with custom content for shortcodes.
                    'custom_content'           => ''
              ),
           'flyout_settings'                => array(
                    'flyout-position'          => 'right',       //left or right
                    'vertical-position'        => 'full-height',// full-hegiht or aligned-to-parent,
                 ),
            'icons_settings'                => array(
                 'icon_choose'              => '',
                 'enable_customimg'         => 'false',
                 'custom_image_url'         => '',
                 'custom_width'             => '',
                 'custom_height'            => '',
                ),
             'upload_image_settings'        => array(
               'use_custom_settings'        => 'false',
               'text_position'              => 'left' ,          // left image, right image or onlyimage , for pro : above, below and image only.
               'display_posts_images'       =>'featured-image', //featured-image or custom-image of posts
               'default_thumbnail_imageurl' => '',
               'show_description'           => 'true',
               'show_desc_length'           => '',
               'display_readmore'           => 'true',
               'readmore_text'              => 'Read more >>',
               'display_post_date'          => 'true',
               'display_author_name'        => 'true',
               'display_cat_name'           => 'true',
               'image_size'                 => 'default',
               'enable_custom_inherit'      => '1',
               'custom_width'               => '',
               'enable_bg_image'            => 'false',
               'bg_image_type'              => 'single', //single or double
               'single_bg_image_url'        => '',
               'bg_image_url1'              => '',
               'bg_image_url2'              => '',
               'image_position'             => 'left top',
               'image_repeat'               => 'no-repeat',
               'cross_fading_type'          => 'changeonhover' //changeonhover or changeontimer
              ),
        // 'custom_extra_settings'        => array(
        //        'content_type'        => 'none',
        //        'content_description' => '',
        //        // 'content_html'        => '',
        //        'shortcodes'          => '',
        //       ),
            'custom_styling' => array(
               'enable_custom_styling' => 'false',
               'enable_menu_bg_color' => '',
               'menu_background_color' => '',
               'enable_menu_bg_hover_color' => '',
               'menu_bg_hover_color' => '',
               'enable_menu_font_color' => '',
               'menu_font_color' => '',
               'enable_menu_font_hover_color' => '',
               'menu_font_hover_color' => '',
               'enable_submenu_megamenu_width' => '',
               'submenu_megamenu_width' => '',
               'enable_submenu_bg_color' => '',
               'submenu_bg_color' => '',
               'enable_menu_icon_color' => '',
               'menu_icon_color' => '',
               'enable_menu_icon_hover_color' => '',
               'menu_icon_hover_color' => '',
               'enable_sub_cfont_color' => '',
               'submenu_cfont_color' => '',
               'enable_sub_heading_font_color' => '',
               'sub_heading_font_color' => '',

              ),
            'restriction_roles' => array(
            'display_mode' => 'loggedoutusers', // loggedinusers,loggedoutusers, all_users, by_role
            'roles_type' => '', //adminsitrator, editor, subscriber, shop manager, customer,author, contributer.
            ),
            );
           $wpmm_default_settings = get_option('wpmm_default_settings');
            if (empty($wpmm_default_settings)) {
                update_option('wpmm_default_settings', $defaults);
            }

          return $wpmm_default_settings;
      }

    /*
      * Includes ALl Class Files Here
      */
    function apmm_menu_page(){
            add_menu_page( __(APMM_PRO_TITLE,APMM_PRO_TD), __(APMM_PRO_TITLE,APMM_PRO_TD),'manage_options',APMM_PRO_TD, array($this, 'ap_main_page'),'dashicons-welcome-widgets-menus', 25);
            add_submenu_page(APMM_PRO_TD, __('General Settings',APMM_PRO_TD), __('General Settings',APMM_PRO_TD), 'manage_options', APMM_PRO_TD, array($this, 'ap_main_page'));    
            add_submenu_page(APMM_PRO_TD, __('Theme Settings',APMM_PRO_TD), __('Theme Settings',APMM_PRO_TD), 'manage_options', 'wpmm-theme-pro-settings', array($this, 'add_theme_settings'));
            add_submenu_page(APMM_PRO_TD, __('How to Use',APMM_PRO_TD), __('How to Use',APMM_PRO_TD), 'manage_options', 'wpmm-pro-how-to-use', array($this, 'how_to_use_page'));
            add_submenu_page(APMM_PRO_TD, __('About',APMM_PRO_TD), __('About',APMM_PRO_TD), 'manage_options', 'wpmm-pro-about-us', array($this, 'about_us_page'));
           if(isset($_GET['action']) && $_GET['action'] == 'edit_theme'){
            add_submenu_page('null', __('Edit theme',APMM_PRO_TD),__('Edit theme',APMM_PRO_TD), 'manage_options', 'wpmm-add-theme-pro', array($this, 'apmm_add_theme'));
           }else{
             add_submenu_page('null', __('Create theme',APMM_PRO_TD),__('Create theme',APMM_PRO_TD), 'manage_options', 'wpmm-add-theme-pro', array($this, 'apmm_add_theme'));
           }
    }

     /*
     * Main Settings Page
     */
      function ap_main_page(){
        include_once(APMM_PRO_PATH.'/inc/backend/main_page.php');
     }

    /*
     * Theme Lists Page
     */
     function add_theme_settings(){
      include_once(APMM_PRO_PATH.'/inc/backend/view/theme_lists_settings.php');
     }

     /*
     * How to use Page
     */
     function how_to_use_page(){
      include_once(APMM_PRO_PATH.'/inc/backend/how_to_use.php');
     }

     /*
     *About Us Page
     */
     function about_us_page(){
       include_once(APMM_PRO_PATH.'/inc/backend/about.php');
     }

     /*
     * Create New Theme Page
     */  
     function apmm_add_theme(){
      include_once(APMM_PRO_PATH.'/inc/backend/view/add_theme_settings.php');
     }

       /*
      *  Saves General Settings to database
      */
         function apmegamenu_save_settings(){
            if(!empty($_POST) && wp_verify_nonce($_POST['apmegamenu-nonce-setup'],'apmegamenu-nonce')){
                if(isset($_POST['settings_submit'])){
                  include_once(APMM_PRO_PATH.'/inc/backend/save_settings.php');
                }else if(isset($_POST['export_submit'])){
                      $custom_theme_id = sanitize_text_field( $_POST['custom_theme_id'] );
                      if ( $custom_theme_id != '' ) {

                          $theme_details = AP_Theme_Settings::get_theme_detail( $custom_theme_id );
                          $filename = sanitize_title( $theme_details['title'] );
                          $json = json_encode( $theme_details );

                          header( 'Content-disposition: attachment; filename=' . $filename . '.json' );
                          header( 'Content-type: application/json' );
                          echo( $json);
                      }else{
                         wp_redirect( admin_url( 'admin.php?page=wp-mega-menu-pro' ) );
                         exit;
                      } 

                }else if(isset($_POST['import_submit'])){
                    if ( !empty( $_FILES ) && $_FILES['import_theme_file']['name'] != '' ) {
                    $filename = $_FILES['import_theme_file']['name'];
                    $filename_array = explode( '.', $filename );
                    $filename_ext = end( $filename_array );
                    if ( $filename_ext == 'json' ) {

                        $new_filename = 'import-' . rand( 111111, 999999 ) . '.' . $filename_ext;
                        $upload_path = APMM_PRO_PATH . 'temp/' . $new_filename;
                        $source_path = $_FILES['import_theme_file']['tmp_name'];
                        $check = @move_uploaded_file( $source_path, $upload_path );

                        if ( $check ) {

                            $url = APMM_PRO_URL . 'temp/' . $new_filename;
                            $params = array(
                                'sslverify' => false,
                                'timeout' => 60
                            );
                            $connection = wp_remote_get( $url, $params );
                            if ( !is_wp_error( $connection ) ) {
                                $body = $connection['body'];
                                
                                $theme_row = json_decode( $body );
                         
                                unlink( $upload_path );
                                $check = AP_Theme_Settings::import_custom_theme( $theme_row );
                                if ( $check ) {
                                    $_SESSION['apmm_success'] = __( 'Custom Theme imported successfully.', APMM_PRO_TD );
                                     wp_redirect( admin_url( 'admin.php?page=wp-mega-menu-pro' ) );
                                    exit;

                                } else {
                                    $_SESSION['apmm_error'] = __( 'Something went wrong. Please try again later.', APMM_PRO_TD );
                                }
                            } else {

                                $_SESSION['apmm_error'] = __( 'Something went wrong. Please try again.', APMM_PRO_TD );
                            }
                        } else {
                            $_SESSION['apmm_error'] = __( 'Something went wrong. Please check the write permission of temp folder inside the plugin\'s folder', APMM_PRO_TD );
                        }
                    } else {
                        $_SESSION['apmm_error'] = __( 'Invalid File Extension', APMM_PRO_TD );
                    }
                }else{
                  $_SESSION['apmm_error'] = __( 'No any file uploaded.', APMM_PRO_TD );
                }

                }else if(isset($_POST['restore_old_settings'])){
                   $default_settings = APMM_Class_Pro::apmm_default_settings();
                   update_option('apmega_settings', $default_settings);
                   $_SESSION['apmm_success'] = __( 'Restored Default Settings Successfully.', APMM_PRO_TD );
                   wp_redirect( admin_url() . 'admin.php?page=wp-mega-menu-pro');
                }
            }
            else{
                die('No script kiddies please!');
            }
         }
        

       /*
        *  Admin Enqueue style and js
       */
       function apmegamenu_admin_scripts( $hook ){
            $plugin_pages = array( APMM_PRO_TD,'wpmm-theme-pro-settings','wpmm-pro-how-to-use','wpmm-add-theme-pro','wpmm-edit-theme-pro','wpmm-pro-about-us','wp-mega-menu-pro','wpmm-export-demo-settings');
            if ( isset( $_GET['page'] ) && in_array( $_GET['page'], $plugin_pages )) {
            wp_enqueue_style( 'wp_megamenu-bootstrap-style', APMM_PRO_CSS_DIR . '/bootstrap.min.css', false, APMM_PRO_VERSION );
            wp_enqueue_style( 'wp_megamenu-verticaltabs-style', APMM_PRO_CSS_DIR . '/bootstrap.vertical-tabs.css', false, APMM_PRO_VERSION );
            wp_enqueue_script( 'wp_megamenu-bootstrap-scripts', APMM_PRO_JS_DIR . '/bootstrap.min.js',array('jquery') ,false, APMM_PRO_VERSION ); 
            wp_enqueue_style( 'wp_megamenu-admin-style', APMM_PRO_CSS_DIR . '/backend.css', false, APMM_PRO_VERSION );
            wp_enqueue_style('wpmm-admin-font-awesome',APMM_PRO_CSS_DIR.'/wpmm-icons/font-awesome/font-awesome.css', false, APMM_PRO_VERSION );
            wp_enqueue_style('wpmegamenu-admin-flaticons', APMM_PRO_CSS_DIR . '/wpmm-icons/flaticons/flaticon.css',true,APMM_PRO_VERSION);
            wp_enqueue_style('wpmegamenu-icomoon-css', APMM_PRO_CSS_DIR.'/wpmm-icons/icomoon/icomoon.css', array(), APMM_PRO_VERSION);
            wp_enqueue_style('wpmegamenu-linecon-css', APMM_PRO_CSS_DIR.'/wpmm-icons/linecon/linecon.css', array(), APMM_PRO_VERSION);
            wp_enqueue_style('wpmm-codemirror-css', APMM_PRO_CSS_DIR . '/syntax/codemirror.css', false , APMM_PRO_VERSION );
            wp_enqueue_script( 'wpmm-codemirror-js', APMM_PRO_JS_DIR . '/syntax/codemirror.js', array('jquery'), APMM_PRO_VERSION );
            wp_enqueue_script( 'wpmm-codemirror-css-js', APMM_PRO_JS_DIR . '/syntax/css.js', array('jquery', 'wpmm-codemirror-js'), APMM_PRO_VERSION );
            wp_enqueue_style('wp-color-picker'); //for including color picker css
            wp_enqueue_script( 'wp_megamenu-color-alpha-scripts', APMM_PRO_JS_DIR . '/wp-color-picker-alpha.js',array('wp-color-picker') ,false, APMM_PRO_VERSION );
            wp_enqueue_style( 'wp_megamenu-admin-style2', APMM_PRO_CSS_DIR . '/available-style.css', false, APMM_PRO_VERSION );
            wp_enqueue_style( 'wpmm-custom-select-css', APMM_PRO_CSS_DIR . '/jquery.selectbox.css', array(), APMM_PRO_VERSION );
            wp_enqueue_script( 'wp-megamenu-custom-select-js', APMM_PRO_JS_DIR . '/jquery.selectbox-0.2.min.js', array( 'jquery' ), APMM_PRO_VERSION );
            wp_enqueue_script('wp_megamenu-admin-scripts', APMM_PRO_JS_DIR . '/backend.js',array('jquery','jquery-ui-core','wp-color-picker',
              'wp-megamenu-custom-select-js') ,false, APMM_PRO_VERSION );
            }
            if($hook == "nav-menus.php"){

              wp_enqueue_style( 'wp_megamenu-admin-style2', APMM_PRO_CSS_DIR . '/available-style.css', false, APMM_PRO_VERSION );
              wp_enqueue_style( 'wpmm-custom-select-css', APMM_PRO_CSS_DIR . '/jquery.selectbox.css', array(), APMM_PRO_VERSION );
              wp_enqueue_script( 'wp-megamenu-custom-select-js', APMM_PRO_JS_DIR . '/jquery.selectbox-0.2.min.js', array( 'jquery' ), APMM_PRO_VERSION );
              wp_enqueue_script('wp_megamenu-admin-scripts', APMM_PRO_JS_DIR . '/backend.js',array('jquery','jquery-ui-core','wp-color-picker',
                'wp-megamenu-custom-select-js') ,false, APMM_PRO_VERSION );
           }
       }

      /**
      * Enqueue required CSS and JS for WP Mega Menu
      */
       function enqueue_menu_page_scripts( $hook ){
          if( 'nav-menus.php' != $hook )
                      return;
          $apmm_variable = array(
                    'plugin_javascript_path' => APMM_PRO_JS_DIR,
                    'depth_check_message' => __('Option only available for top level menu.',APMM_PRO_TD),
                    'success_msg' => __('Successfully Saved.',APMM_PRO_TD),
                    'saving_msg' => __('Saving Data.',APMM_PRO_TD),
                    'saved_msg' => __('Saved.',APMM_PRO_TD),
                    'group_edit_message' => __('Edit this Group.',APMM_PRO_TD),
                    'menu_lightbox' => __("WP Mega Menu Pro", APMM_PRO_TD),
                    'ajax_url' => admin_url() . 'admin-ajax.php',
                    'checked_disabled_error' => __("Please enable WP Mega Menu Pro using the WP Mega Menu Pro Settings on left section of this page.", APMM_PRO_TD),
                    'ajax_nonce' => wp_create_nonce('apmm-ajax-nonce'));
        
            wp_localize_script( 'wp_megamenu-admin-scripts', 'apmm_variable', $apmm_variable ); //localization of php variable in edn-pro-frontend-js
            if ( class_exists( 'Tribe_Image_Widget' ) ) {
                $image_widget = new Tribe_Image_Widget;
                $image_widget->admin_setup();
            }
            wp_deregister_script('codemirror');
            wp_deregister_style('codemirror');

            wp_enqueue_style( 'wpmm-custom-select-css', APMM_PRO_CSS_DIR . '/jquery.selectbox.css', array(), APMM_PRO_VERSION );
            wp_enqueue_style( 'wpmm-mega-menu', APMM_PRO_CSS_DIR . '/backend.css', false, APMM_PRO_VERSION );
            wp_enqueue_media();
            // Get the WP Version global.
            global $wp_version;
            if($wp_version >= "4.8"){
              wp_enqueue_editor();
            }
            wp_enqueue_script('accordion');
            wp_enqueue_style('wp-color-picker'); //for including color picker css
            wp_enqueue_script( 'wp_megamenu-color-alpha', APMM_PRO_JS_DIR . '/wp-color-picker-alpha.js',array('wp-color-picker') ,false, APMM_PRO_VERSION );
            wp_enqueue_script( 'wpmm-ckeditor-js', APMM_PRO_JS_DIR . '/ckeditor/ckeditor.js', array( 'jquery' ), APMM_PRO_VERSION );
            wp_enqueue_script( 'wpmm-ckfinder-js', APMM_PRO_JS_DIR . '/ckfinder/ckfinder.js', array( 'jquery' ), APMM_PRO_VERSION );
            wp_enqueue_script( 'wp-megamenu-custom-select-js', APMM_PRO_JS_DIR . '/jquery.selectbox-0.2.min.js', array( 'jquery' ), APMM_PRO_VERSION );
            wp_enqueue_script( 'wpmm-mega-menu', APMM_PRO_JS_DIR . '/admin-menu.js', array(
            'jquery',
            'jquery-ui-core',
            'jquery-ui-sortable',
            'wp-color-picker',
            'jquery-ui-accordion'
            ), APMM_PRO_VERSION );

        
       }

         
      function displayArr($array){
          echo "<pre>";
          print_r($array);
          echo "</pre>";
        }

       /*
       * WP MEGA MENU PRO METABOX
       */
      function addAPMegamenuMetaBox() {
            if (wp_get_nav_menus()) {
                add_meta_box('nav-menu-theme-apmegamenus', __('Select WP Mega Menu Pro Settings', APMM_PRO_TD), array($this, 'createWPMegamenuMetaBox'), 'nav-menus', 'side', 'high');
            }
        }

       /*
       *  Metabox Location
       */
        function createWPMegamenuMetaBox(){
             $menulocations = array();

            echo "<div class='ap_megamenu-custom_metaBox'>";
          /* Get menu id of current opened page*/
            $mynavmenus = wp_get_nav_menus( array('orderby' => 'name') );
            $total_pgcount = wp_count_posts( 'page' ); // get total page count here
            $count = count($mynavmenus);
            $getselectedmenuid = (isset( $_GET['menu'] )? (int) $_GET['menu'] : 0);
            $newscreen = (isset($_GET['menu']) && $_GET['menu'] == 0 )?true:false;
            if(count( get_registered_nav_menus()) == 1 && ! $newscreen && empty($mynavmenus) && ! empty( $total_pgcount->publish )){
              $themelocationnomenus = 1;
            }else{
              $themelocationnomenus = 0;
            }
             $recentlyeditednavmenu = absint( get_user_option( 'nav_menu_recently_edited' ) ); //get recently edited nav menu
             if ( empty( $recentlyeditednavmenu ) && is_nav_menu( $getselectedmenuid ) ){
                $recentlyeditednavmenu = $getselectedmenuid;
             }
             if ( empty( $getselectedmenuid ) && ! isset( $_GET['menu'] )){
              if(is_nav_menu( $recentlyeditednavmenu )){
                $getselectedmenuid = $recentlyeditednavmenu; // use recently nav menu if none are selected
              }
             }
              if ( ! $newscreen && $count > 0 && isset( $_GET['action'] )){
                if($_GET['action'] == 'delete'){
                  $getselectedmenuid = $mynavmenus[0]->term_id; //on deletion of menu, if another menu exists, show it
                 }
              }
            if ( $themelocationnomenus == 1) { //set get selected menu id to 0 if there is no any menus
                $getselectedmenuid = 0;
            } else if (! empty( $mynavmenus ) && ! $newscreen && empty( $getselectedmenuid )) {
                $getselectedmenuid = $mynavmenus[0]->term_id; // no any menu so set first one menu
            }

            /* Get menu location of specific menu id/return the locations that a specific menu ID has been tagged to.*/
           $get_all_registered_menu_locations = get_registered_nav_menus();  //Returns all registered navigation menu locations in a theme.
           $navmenu_locations = get_nav_menu_locations(); // Returns an array with the registered navigation menu locations and the menu assigned to it

           foreach ($get_all_registered_menu_locations as $id => $title) {
              if ( isset( $navmenu_locations[ $id ] ) && $navmenu_locations[$id] == $getselectedmenuid )
                $menulocations[$id] = $title;
            }
          
          $check_menu_count = count ( $menulocations );

           $menu_general_settings = get_option( 'wpmegabox_settings' );
            if ( ! $check_menu_count  ) { ?>
           <p><?php __("To Enable WP Mega Menu Pro, First please assign this menu to theme location.<br/>This Menu is not assigned to any theme location yet.", APMM_PRO_TD);?></p>
           <?php  }else if(!count($get_all_registered_menu_locations)){ ?>
           <p><?php __("Please create a new menu location in order to activate WP Mega Menu Pro. This Theme doesnot have any menu location created yet.", APMM_PRO_TD);?></p>
           <?php }else{ 
             if ( $check_menu_count == 1 ){ 
                $getlocations = array_keys( $menulocations );
                $location = $getlocations[0];
                if (isset( $menulocations[ $location ] ) ) {
                
                  include(APMM_PRO_PATH.'/inc/backend/metabox_field/add_metabox_field.php'); 
                
                }
               }else{ // create accordion for multiple theme location if assigned to menu
                ?>
                <div id='apmegamenu_accordion'>
                    <?php foreach ( $get_all_registered_menu_locations as $location => $menu_name ){
                     if ( isset( $menulocations[ $location ] ) ){ ?>
                            <h3 class='theme_settings'><?php echo esc_html( $menu_name ); ?></h3>
                           
                            <div class='accordion_content' style='display: none;'>
                                <?php 
                                include(APMM_PRO_PATH.'/inc/backend/metabox_field/add_metabox_field.php');  
                                ?>
                           
                            </div>

                        <?php }  } ?>
                </div>
              <?php
                   } 
                   ?>
            <p class="submit"><input name="submit" id="submit" class="button ap-mega-menu-save button-primary alignright" value="Save" 
            type="submit"></p>
            <span class='apmm_loader' style="display:none;"><img src="<?php echo APMM_PRO_IMG_DIR;?>/ajaxloader.gif"/></span>
            <div class='apmm_success'></div>

           <?php }
            echo "</div>";
           
        }

     /**
     * Ajax Save Widget Menu Settings  Data (submitted from Menus Page Meta Box)
     */
    public function wp_save_settings() {
       check_ajax_referer( 'apmm-ajax-nonce', 'wp_nonce' );
       $submitsettings = array();
       if ( isset( $_POST['wp_menu_id'] ) && $_POST['wp_menu_id'] > 0) {
        if(is_nav_menu( $_POST['wp_menu_id'] ) && isset( $_POST['wp_megamenu_meta'] )){
          $megametadata = $_POST['wp_megamenu_meta'];
          $getparsedsubmitsettings = json_decode( stripslashes( $megametadata ), true );
          $wpmegabox_settings = get_option( 'wpmegabox_settings' );
            foreach ( $getparsedsubmitsettings as $key => $val ) {
                $title = $val['name'];
                preg_match_all( "/\[(.*?)\]/", $title, $matches );
                if ( isset( $matches[1][0] ) && isset( $matches[1][1] ) ) {
                    $mylocation = $matches[1][0];
                    $mysetting = $matches[1][1];
                    $submitsettings[$mylocation][$mysetting] = $val['value'];
                }
            }
             // echo "<pre>";
             // print_r($submitsettings);
            /*
            Array output results as 
             $submitsettings = Array
                  (
                      [primary] => Array
                          (
                              [enabled] => 1
                              [orientation] => horizontal
                              [vertical_alignment_type]  => left
                              [trigger_option] => onhover
                              [effect_option] => slide
                              [theme_type] => available_skins or custom themes
                              [theme] => 1  //default theme id
                              [available_skin] => 'black-white' //total 6 pre available skins.
                          )

                  )
            */
            if (!$wpmegabox_settings) {
                update_option( 'wpmegabox_settings', $submitsettings );
            } else {
                $setupsettings = get_option( 'wpmegabox_settings' );
                $settings = array_merge( $setupsettings, $submitsettings );
                update_option( 'wpmegabox_settings', $settings );
            }
       }
      }
        wp_die();

    }

    public function wpmm_getlightbox_by_ajax(){
      check_ajax_referer( 'apmm-ajax-nonce', 'wp_nonce' );
      if(isset($_POST) && $_POST['menu_item_id'] != '' && $_POST['menu_id'] != ''){
            $menu_item_title = sanitize_text_field($_POST['menu_item_title']);
            $menuitemid = sanitize_text_field($_POST['menu_item_id']);
            $menuid = sanitize_text_field($_POST['menu_id']);
            $menuitemdepth = sanitize_text_field($_POST['menu_item_depth']);
            if ( isset( $menuitemid ) ) {
                $this->wpmmenu_item_id = absint( $menuitemid  );
                $alreadysaved_settings = array_filter( (array) get_post_meta( $this->wpmmenu_item_id, '_wpmegamenu', true ) );
                $this->wpmmenu_item_meta =  $alreadysaved_settings;
            }
            $this->wpmmenu_item_depth = (isset($menuitemdepth)?absint( $menuitemdepth ):'');
            $this->wpmmenu_id = (isset($menuid)?absint( $menuid ):'');

            $menu_item_id      = $this->wpmmenu_item_id;
            $menu_id           = $this->wpmmenu_id;
            $menu_item_depth   = $this->wpmmenu_item_depth;
            $wpmmenu_item_meta = $this->wpmmenu_item_meta;

            if ( $menu_item_depth > 0 ) {
               include(APMM_PRO_PATH.'inc/backend/menu_settings/submenu_settings.php');
            }else{
                include(APMM_PRO_PATH.'inc/backend/menu_settings/top_menu_settings.php');
            }
        }  
        wp_die();
    }


     public static function save_menuitem_settings_byajax(){
       check_ajax_referer( 'apmm-ajax-nonce', '_wpnonce' );
  
       $wpmm_menu_item_id = absint( $_POST['wpmm_menu_item_id'] );

       if(isset($_POST['wpmm_settings']) && is_array($_POST['wpmm_settings']) &&  $wpmm_menu_item_id > 0){
        global $wpdb;
        $table_name = $wpdb->prefix .'apmm_menugrouplists';
         if ( isset( $_POST['wpmm_settings']['menu_type'] ) && isset($_POST['wpmm_settings']['group_type'])) {
             $_POST['wpmm_settings']['menu_type'] = $_POST['wpmm_settings']['menu_type'];
             $_POST['wpmm_settings']['group_type'] = $_POST['wpmm_settings']['group_type'];
             
             $resultss =  (isset($_POST['wpmm_settings']['total_results']) && !empty($_POST['wpmm_settings']['total_results'])?$_POST['wpmm_settings']['total_results']:array());
             if( $_POST['wpmm_settings']['group_type'] == "multiple" && !empty($resultss)){
              $submenulists = $_POST['wpmm_settings']['submenulists'];
              $checked_lists = $_POST['wpmm_settings']['checked_lists'];
              if($checked_lists == "grouplists"){
                   $widget_details =  $submenulists;
              }else{
                $widget_details = 
                  array(
                    '0' => array(
                    'group_no' => '1',
                    'lists' =>  $submenulists
                    ),
                    );
              }
              
               $wpmm_menu_detailss = $wpdb->get_row("SELECT * FROM $table_name where menuid = $wpmm_menu_item_id ");
             
              if(empty($wpmm_menu_detailss)){
              
               $idata = $wpdb->insert($table_name, array(
                              'menuid'         => $wpmm_menu_item_id,
                              'totalgroup'     => 1,
                              'group_type'     =>  sanitize_text_field($_POST['wpmm_settings']['group_type']),
                              'widget_details' =>  serialize( $widget_details),     
                              'group_details' =>serialize($resultss),            
                  ),
                  array(
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s'
                ));
                 $results = $wpdb->query( $idata );
             }else{
                  $idata = $wpdb->update( 
                    $table_name, 
                    array(
                                'totalgroup'     =>  1,
                                'group_type'     => sanitize_text_field($_POST['wpmm_settings']['group_type']),
                                  'widget_details' => serialize( $widget_details),     
                                 'group_details' =>serialize($resultss)   
                          ),
                      array('menuid'=>$wpmm_menu_item_id), 
                    array(
                          '%s',
                          '%s',
                          '%s',
                          '%s'
                      ),
                      array('%d')
                  );
                    $results = $wpdb->query( $idata );
             }


              
              }
         }
         else if ( isset( $_POST['wpmm_settings']['menu_type'] ) && isset($_POST['wpmm_settings']['panel_columns'])) {
             $_POST['wpmm_settings']['menu_type'] = $_POST['wpmm_settings']['menu_type'];
             $_POST['wpmm_settings']['panel_columns'] = $_POST['wpmm_settings']['panel_columns'];
           }else{    
            //general settings     
             $_POST['wpmm_settings']['general_settings']['disable_text'] = (isset($_POST['wpmm_settings']['general_settings']['disable_text']) && $_POST['wpmm_settings']['general_settings']['disable_text'] == true)?'true':'false';
             $_POST['wpmm_settings']['general_settings']['disable_desc'] = (isset($_POST['wpmm_settings']['general_settings']['disable_desc']) && $_POST['wpmm_settings']['general_settings']['disable_desc'] == true)?'true':'false';
             $_POST['wpmm_settings']['general_settings']['active_link'] = (isset($_POST['wpmm_settings']['general_settings']['active_link']) && $_POST['wpmm_settings']['general_settings']['active_link'] == true)?'true':'false';
             $_POST['wpmm_settings']['general_settings']['visible_hidden_menu'] = (!isset($_POST['wpmm_settings']['general_settings']['visible_hidden_menu'])?'false':'true');
             $_POST['wpmm_settings']['general_settings']['hide_arrow'] = (!isset($_POST['wpmm_settings']['general_settings']['hide_arrow'])?'false':'true');
             $_POST['wpmm_settings']['general_settings']['hide_on_mobile'] = (!isset($_POST['wpmm_settings']['general_settings']['hide_on_mobile'])?'false':'true');
             $_POST['wpmm_settings']['general_settings']['hide_on_desktop'] = (!isset($_POST['wpmm_settings']['general_settings']['hide_on_desktop'])?'false':'true');
             $_POST['wpmm_settings']['general_settings']['menu_icon'] = (!isset($_POST['wpmm_settings']['general_settings']['menu_icon'])?'disabled':'enabled'); 
                 //show menu icon enabled true
             $_POST['wpmm_settings']['general_settings']['active_single_menu'] = isset($_POST['wpmm_settings']['general_settings']['active_single_menu'])?'enabled':'disabled';
             $_POST['wpmm_settings']['general_settings']['choose_trigger_effect'] = (isset($_POST['wpmm_settings']['general_settings']['choose_trigger_effect']) && $_POST['wpmm_settings']['general_settings']['choose_trigger_effect'] == "onclick")?'onclick':'onhover';

             //sub custom settings     
             $_POST['wpmm_settings']['upload_image_settings']['use_custom_settings'] = isset($_POST['wpmm_settings']['upload_image_settings']['use_custom_settings'])?'true':'false';
             $_POST['wpmm_settings']['upload_image_settings']['show_description'] = isset($_POST['wpmm_settings']['upload_image_settings']['show_description'])?'true':'false';
             $_POST['wpmm_settings']['upload_image_settings']['display_readmore'] = isset($_POST['wpmm_settings']['upload_image_settings']['display_readmore'])?'true':'false';
             $_POST['wpmm_settings']['upload_image_settings']['display_post_date'] = isset($_POST['wpmm_settings']['upload_image_settings']['display_post_date'])?'true':'false';
             $_POST['wpmm_settings']['upload_image_settings']['display_author_name'] = isset($_POST['wpmm_settings']['upload_image_settings']['display_author_name'])?'true':'false';
             $_POST['wpmm_settings']['upload_image_settings']['display_cat_name'] = isset($_POST['wpmm_settings']['upload_image_settings']['display_cat_name'])?'true':'false';
            
             //megamenu settings 
               // $_POST['wpmm_settings']['general_settings']['hide_sub_menu_on_mobile'] = (!isset($_POST['wpmm_settings']['general_settings']['hide_sub_menu_on_mobile'])?'disabled':$_POST['wpmm_settings']['general_settings']['hide_sub_menu_on_mobile']);
               $_POST['wpmm_settings']['mega_menu_settings']['show_top_content'] = (!isset($_POST['wpmm_settings']['mega_menu_settings']['show_top_content'])?'false':'true');
               $_POST['wpmm_settings']['mega_menu_settings']['show_bottom_content'] = (!isset($_POST['wpmm_settings']['mega_menu_settings']['show_bottom_content'])?'false':'true');    
              
               $_POST['wpmm_settings']['mega_menu_settings']['top']['top_content_type'] = (isset($_POST['wpmm_settings']['mega_menu_settings']['top']['top_content_type'])?sanitize_text_field($_POST['wpmm_settings']['mega_menu_settings']['top']['top_content_type']):'text_only');    
               $_POST['wpmm_settings']['mega_menu_settings']['bottom']['bottom_content_type'] = (isset($_POST['wpmm_settings']['mega_menu_settings']['bottom']['bottom_content_type'])?sanitize_text_field($_POST['wpmm_settings']['mega_menu_settings']['bottom']['bottom_content_type']):'text_only');    
               $_POST['wpmm_settings']['mega_menu_settings']['top']['top_content'] = (isset($_POST['wpmm_settings']['mega_menu_settings']['top']['top_content'])?sanitize_text_field($_POST['wpmm_settings']['mega_menu_settings']['top']['top_content']):'');    
               $_POST['wpmm_settings']['mega_menu_settings']['bottom']['bottom_content'] = (isset($_POST['wpmm_settings']['mega_menu_settings']['bottom']['bottom_content'])?sanitize_text_field($_POST['wpmm_settings']['mega_menu_settings']['bottom']['bottom_content']):'');    
             
               $_POST['wpmm_settings']['mega_menu_settings']['top']['image_url'] = (isset($_POST['wpmm_settings']['mega_menu_settings']['top']['image_url'])?sanitize_text_field($_POST['wpmm_settings']['mega_menu_settings']['top']['image_url']):'');    
               $_POST['wpmm_settings']['mega_menu_settings']['bottom']['image_url'] = (isset($_POST['wpmm_settings']['mega_menu_settings']['bottom']['image_url'])?sanitize_text_field($_POST['wpmm_settings']['mega_menu_settings']['bottom']['image_url']):'');    
               $_POST['wpmm_settings']['mega_menu_settings']['top']['html_content'] = (isset($_POST['wpmm_settings']['mega_menu_settings']['top']['html_content']) && $_POST['wpmm_settings']['mega_menu_settings']['top']['html_content'] != '')?sanitize_text_field($_POST['wpmm_settings']['mega_menu_settings']['top']['html_content']):'';    
               $_POST['wpmm_settings']['mega_menu_settings']['bottom']['html_content'] = (isset($_POST['wpmm_settings']['mega_menu_settings']['bottom']['html_content']) && $_POST['wpmm_settings']['mega_menu_settings']['bottom']['html_content'] != '')?sanitize_text_field($_POST['wpmm_settings']['mega_menu_settings']['bottom']['html_content']):'';    
              
               $_POST['wpmm_settings']['restriction_roles']['display_mode'] = (isset($_POST['wpmm_settings']['restriction_roles']['display_mode']) && $_POST['wpmm_settings']['restriction_roles']['display_mode'] != '')?sanitize_text_field($_POST['wpmm_settings']['restriction_roles']['display_mode']):'show_to_all';    
             }
              $get_all_settings = get_post_meta( $wpmm_menu_item_id, '_wpmegamenu', true);
              if ( is_array( $get_all_settings ) ) {
                $_POST['wpmm_settings'] = array_merge( $get_all_settings,$_POST['wpmm_settings']);
              }
              update_post_meta( $wpmm_menu_item_id, '_wpmegamenu', $_POST['wpmm_settings'] );
           } 
            if ( ob_get_contents() ) ob_clean(); 
            wp_send_json_success();

    }

    public function wpmm_admin_footer_function()
    {
     echo "<div class='wpmm_menu_wrapper'><div class='wpmm_overlay'></div>";
     echo "<div id='wpmm_menu_settings_frame' style='display:none;'><div class='wpmm_frame_header'>";
     echo "<span class='close_btn'>x</span></div>";
     echo "<div class='wpmm_main_content'></div></div></div>";
    }

    /**
     * Returns the menu ID for a specified menu location, defaults to 0
     */
    private function wpmm_get_menu_id_for_location( $location ) {

        $locations = get_nav_menu_locations();

        $id = isset( $locations[ $location ] ) ? $locations[ $location ] : 0;

        return $id;

    }

    /* Pro Features added */

      /*
       *  WP Mega Menu Advanced Menu Items
      */
      function wpmegamenu_custom_menu_items_meta_box() {
            if (wp_get_nav_menus()) {
                add_meta_box('wpmm_custom_nav_items', __('WPMM Pro Advanced Menu Items', APMM_PRO_TD), array($this, 'wpmm_custom_menu_items_meta_box'), 'nav-menus', 'side', 'low');
            }
        }

  public function wpmm_custom_menu_items_meta_box(){
     global $_nav_menu_placeholder, $nav_menu_selected_id;
      $items = $this->wpmm_get_custom_menu_item_types();
      ?>
      <div id="wpmegamenu-custom-menu-metabox" class="posttypediv">
      <div id="tabs-panel-wpmegamenu-custom" class="tabs-panel tabs-panel-active">
      <ul id ="wpmegamenu-custom-checklist" class="categorychecklist form-no-clear">

      <?php foreach( $items as $id => $item ): 
        $url = '#wpmegamenu-'.$id;
        if( isset( $item['url'] ) ){
          $url = $item['url'];
        }
        ?>
        <li>
          <label class="menu-item-title">
            <input type="checkbox" class="menu-item-checkbox" name="menu-item[<?php echo $_nav_menu_placeholder ?>][menu-item-label]" value="0"> <?php echo $item['label']; ?>
            <span class="wpmmega-tooltip"><?php echo $item['desc']; ?></span>
          </label>
          <input type="hidden" class="menu-item-type" name="menu-item[<?php echo $_nav_menu_placeholder ?>][menu-item-type]" value="custom">
          <input type="hidden" class="menu-item-wpmegamenu-custom" name="menu-item[<?php echo $_nav_menu_placeholder ?>][menu-item-wpmegamenu-custom]" value="on">
          <input type="hidden" class="menu-item-title" name="menu-item[<?php echo $_nav_menu_placeholder ?>][menu-item-title]" value="<?php echo $item['title']; ?>">
          <input type="hidden" class="menu-item-url" name="menu-item[<?php echo $_nav_menu_placeholder ?>][menu-item-url]" value="<?php echo $url; ?>">
        </li>

      <?php endforeach; ?>

      </ul>
    </div>
    <p class="button-controls">
      
      <span class="add-to-menu">
        <input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-wpmegamenu-custom-menu-item" id="submit-wpmegamenu-custom-menu-metabox">
        <span class="spinner"></span>
      </span>
    </p>
  </div>
      <?php
    }

    
    
     public function wpmm_get_custom_menu_item_types(){
        $items['tabs'] = array(
          'label' =>  __( 'Vertical Tabs Block' , APMM_PRO_TD ),
          'title' =>  '['.__( 'Tabs' , APMM_PRO_TD ) . ']',
          'panels'=> array( 'tabs' , 'responsive' ),
          'desc'  => __( '(A group of vertical tabs.)' , APMM_PRO_TD ),
          'url' =>  '#wpmegamenupro-vertical-tabs',
        );
         $items['horizontal_tabs'] = array(
          'label' =>  __( 'Horizontal Tabs Block' , APMM_PRO_TD ),
          'title' =>  '['.__( 'HTabs' , APMM_PRO_TD ) . ']',
          'panels'=> array( 'tabs' , 'responsive' ),
          'desc'  => __( '(A group of horizontal tabs.)' , APMM_PRO_TD ),
          'url' =>  '#wpmegamenupro-horizontal-tabs',
        );
        return $items;  
      }


    /**
     * Save multiple group added menu id wise
     */
     public static function save_menu_group_settings(){
       global $wpdb;
       check_ajax_referer( 'apmm-ajax-nonce', '_wpnonce' );
  
       $wpmm_menu_item_id = absint( $_POST['wpmm_menu_item_id'] );
       $act =  sanitize_text_field($_POST['wpmm_group_settings']['act']);
       $resultss =  (isset($_POST['wpmm_group_settings']['total_results']) && !empty($_POST['wpmm_group_settings']['total_results'])?$_POST['wpmm_group_settings']['total_results']:array());
       $widget_details =  (isset($_POST['wpmm_group_settings']['widget_details']) && !empty($_POST['wpmm_group_settings']['widget_details'])?$_POST['wpmm_group_settings']['widget_details']:array());

       if(isset($_POST['wpmm_group_settings']) && is_array($_POST['wpmm_group_settings']) && 
        $wpmm_menu_item_id > 0){

             $table_name = $wpdb->prefix .'apmm_menugrouplists';

             $wpmm_menu_details = $wpdb->get_row("SELECT * FROM $table_name where menuid = $wpmm_menu_item_id ");
           

           if($act == "add"){
             if(empty($wpmm_menu_details)){
               $idata = $wpdb->insert($table_name, array(
                              'menuid'         => $wpmm_menu_item_id,
                              'totalgroup'     =>  sanitize_text_field($_POST['wpmm_group_settings']['totgroup']),
                              'group_type'     =>  'multiple',
                              'group_details'  =>serialize($resultss),  
                               'widget_details' => serialize($widget_details)            
                  ),
                  array(
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s'
                ));
               //  $results = $wpdb->query( $idata );
             }else{

                  $idata = $wpdb->update( 
                    $table_name, 
                    array(
                                'totalgroup'     =>  sanitize_text_field($_POST['wpmm_group_settings']['totgroup']),
                                'group_type'     =>  'multiple',
                                 'group_details' =>serialize($resultss),
                                  'widget_details' => serialize($widget_details)     
                          ),
                      array('menuid'=>$wpmm_menu_item_id), 
                    array(
                          '%d',
                          '%s',
                          '%s',
                          '%s'
                      ),
                      array('%d')
                  );
                 // $wpdb->print_error();
             }
           }else{
            //delete by updating group
            if(empty($resultss)){
             $wpdb->delete( $table_name, array( 'menuid'=>$wpmm_menu_item_id ), array( '%d' ) );
            }else{
                    $idata = $wpdb->update( 
                          $table_name, 
                          array(
                                       'totalgroup'     =>  sanitize_text_field($_POST['wpmm_group_settings']['totgroup']),
                                       'group_type'     =>  'multiple',
                                       'group_details' => serialize($resultss),
                                       'widget_details' => serialize($widget_details)  
                                ),
                            array('menuid'=>$wpmm_menu_item_id), 
                          array(
                                '%s',
                                '%s',
                                '%s',
                                '%s'
                            ),
                            array('%d')
                        );
            }
          

           }
          $results = $wpdb->query( $idata );
          
            if ( ob_get_contents() ) ob_clean(); // remove any warnings or output from other plugins which may corrupt the response

            wp_send_json_success();

      }


    }
    
    /*
    * Edit Group Column Wise To database
    */
    public function edit_menu_group_settings(){
      global $wpdb;
       check_ajax_referer( 'apmm-ajax-nonce', '_wpnonce' );
  
       $wpmm_menu_item_id = absint( $_POST['wpmm_menu_item_id'] );
       $total_group_columns =  (isset($_POST['wpmm_group_settings']['total_group_columns']) && !empty($_POST['wpmm_group_settings']['total_group_columns'])?$_POST['wpmm_group_settings']['total_group_columns']:array());
       $groupwidgets =  (isset($_POST['wpmm_group_settings']['groupwidgets']) && !empty($_POST['wpmm_group_settings']['groupwidgets'])?$_POST['wpmm_group_settings']['groupwidgets']:array());
      if(isset($_POST['wpmm_group_settings']) && is_array($_POST['wpmm_group_settings']) && 
         $wpmm_menu_item_id > 0){
         $table_name = $wpdb->prefix .'apmm_menugrouplists';
         $wpmm_menu_details = $wpdb->get_row("SELECT * FROM $table_name where menuid = $wpmm_menu_item_id ");
       if(empty($wpmm_menu_details)){
               $idata = $wpdb->insert($table_name, array(
                              'menuid'         => $wpmm_menu_item_id,
                              'totalgroup'     =>  sanitize_text_field($_POST['wpmm_group_settings']['totgroup']),
                              'group_type'     =>  'multiple',
                              'group_details'   =>serialize($total_group_columns),  
                               'widget_details' => serialize($groupwidgets)            
                  ),
                  array(
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s'
                ));
                 $results = $wpdb->query( $idata );
              }else{
              $idata = $wpdb->update( 
                    $table_name, 
                    array(
                                'totalgroup'       =>  sanitize_text_field($_POST['wpmm_group_settings']['totgroup']),
                                'group_type'       =>  'multiple',
                                 'group_details'   =>  serialize($total_group_columns),
                                  'widget_details' => serialize($groupwidgets)     
                          ),
                      array('menuid'=>$wpmm_menu_item_id), 
                    array(
                          '%s',
                          '%s',
                          '%s',
                          '%s'
                      ),
                      array('%d')
                  );
            $results = $wpdb->query( $idata );
           }
        }
        if ( ob_get_contents() ) ob_clean(); // remove any warnings or output from other plugins which may corrupt the response
        wp_send_json_success();
    }
}
$global['menu_obj'] = new AP_Menu_Settings();
endif;
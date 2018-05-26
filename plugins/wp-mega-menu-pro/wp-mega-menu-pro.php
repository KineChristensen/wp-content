<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/*
  Plugin Name: WP Mega Menu Pro |  VestaThemes.com
  Plugin URI:  https://accesspressthemes.com/wordpress-plugins/wp-mega-menu-pro/
  Description: Horizontal & Vertical layout Mega menu | Responsive & User friendly | Widgetized, Drag & Drop | Built-in and custom layouts
  Version:     1.0.9
  Author:      AccessPress Themes
  Author URI:  http://accesspressthemes.com
  License:     GPLv2 or later
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
  Domain Path: /languages
  Text Domain: wp-mega-menu-pro
 */

defined( 'APMM_PRO_VERSION' ) or define( 'APMM_PRO_VERSION', '1.0.9' ); //plugin version
defined( 'APMM_PRO_SOV' ) or define( 'APMM_PRO_SOV', '2.5.6' ); //siteorigin latest version compatible
defined( 'APMM_PRO_TITLE' ) or define( 'APMM_PRO_TITLE', 'WP MEGA MENU PRO' ); //plugin version
defined( 'APMM_PRO_TD' ) or define( 'APMM_PRO_TD', 'wp-mega-menu-pro' ); //plugin's text domain
defined( 'APMM_PRO_CSS_PREFIX' ) or define( 'APMM_PRO_CSS_PREFIX', 'wpmega-' ); //plugin's text domain
defined( 'APMM_PRO_IMG_DIR' ) or define( 'APMM_PRO_IMG_DIR', plugin_dir_url( __FILE__ ) . 'images' ); //plugin image directory
defined( 'APMM_PRO_JS_DIR' ) or define( 'APMM_PRO_JS_DIR', plugin_dir_url( __FILE__ ) . 'js' );  //plugin js directory
defined( 'APMM_PRO_CSS_DIR' ) or define( 'APMM_PRO_CSS_DIR', plugin_dir_url( __FILE__ ) . 'css' ); // plugin css dir
defined( 'APMM_PRO_PATH' ) or define( 'APMM_PRO_PATH', plugin_dir_path( __FILE__ ) );
defined( 'APMM_PRO_URL' ) or define( 'APMM_PRO_URL', plugin_dir_url( __FILE__ ) ); //plugin directory url
if( !defined('AP_MEGAMENU_ITEM_OPTIONS_PRO')){
    define( 'AP_MEGAMENU_ITEM_OPTIONS_PRO', 'ap-mega-menu-item-options' );
}

if( !defined('AP_MEGAMENU_MENU_LOCATION_PRO')){
    define( 'AP_MEGAMENU_MENU_LOCATION_PRO', 'ap-mega-menu-location' );
}

/* libarary*/
require_once APMM_PRO_PATH . 'inc/admin/libs/wpmm-libary.php';
require_once APMM_PRO_PATH . 'inc/frontend/core/wpmm_walker_class.php';
require_once APMM_PRO_PATH . 'inc/admin/wpmegamenu-widget.php';

if(!class_exists('APMM_Class_Pro')){

/**
* Plugin's main class
*/
  class APMM_Class_Pro 
  {
    var $apmega_settings;
    var $mylibrary;
   
    function __construct()
    {


      # code...
      $this->ap_megamenu_includes();
      $this->mylibrary = new WPMM_Libary();
      $this->apmega_settings = get_option('apmega_settings');
      add_action( 'init', array( $this, 'apmm_initialize' ) ); //executes when init hook is fired
      register_activation_hook( __FILE__, array($this,'apmm_pro_activation' ));
      /*
      * Frontend WP Mega Menu Display
      */

      add_shortcode( 'wp_megamenu_search_form', array( $this, 'wpmm_generate_search_shortcode' ) );
      add_action( 'widgets_init',  array( $this,'wpmm_mega_register_widget' ));

       add_shortcode( 'wpmegamenu', array( $this, 'wpmm_print_menu_shortcode' ) );
       add_action('wp_head',array($this,'prefix_add_header_styles'));
       add_action('wp_footer',array($this,'prefix_add_footer_scripts'));
       add_filter('widget_text', 'do_shortcode');

        add_filter( 'black_studio_tinymce_enable_pages' , array($this, 'wpmegamenu_blackstudio_tinymce' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'wp_admin_enqueue_scripts'), 11 ); // load custom admin js hool enqueue script for nav menu page metabox form      
              

        if (is_admin()) {
           
              new WPMM_Menu_Widget_Manager(); //get widget section for menu
             
           }else {
                add_action('wp_enqueue_scripts',array($this,'wpmm_megamenu_frontend_scripts') , 99);
            }
            $ap_theme_settings = new AP_Theme_Settings();   // Create new Theme Class
           
             // add_filter( 'add_to_cart_fragments',  array( $this,'wpmm_pro_cart_header_one_link_fragment')); add_to_cart_fragments for only woocommerce upto 3.0
            add_filter( 'woocommerce_add_to_cart_fragments',  array( $this,'wpmm_pro_cart_header_one_link_fragment')); //latest woocommerce

            add_shortcode( 'wp_megamenu_login_form', array($this,'login_form_shortcode') );
            add_shortcode( 'wp_megamenu_register_form', array($this,'register_form_shortcode') );
            // Enable the user with no privileges to run ajax_login() in AJAX
              add_action( 'wp_ajax_nopriv_ajaxlogin', array($this,'ajax_login' ));
            // Enable the user with no privileges to run ajax_register() in AJAX
              add_action( 'wp_ajax_nopriv_ajaxregister', array($this,'ajax_register') );  
    }


      /*
       * Enqueue Backend Scripts
      */
        function wp_admin_enqueue_scripts($hooks){
            if ( 'nav-menus.php' == $hooks ) {
                // do_action( 'sidebar_admin_setup' );
                // do_action( 'admin_enqueue_scripts', 'widgets.php' );
                do_action("wp_megamenu_nav_menus_scripts", $hooks );
             }
        }

  /*
  * Load script to footer
  */
  public function prefix_add_footer_scripts(){
    $options = get_option( 'apmega_settings' );  
    $enable_custom_js = (isset($options['enable_custom_js']) && $options['enable_custom_js'] == 1)?'1':'0';
    $custom_js = (isset($options['custom_js']))?$options['custom_js']:'';    
    if($enable_custom_js == 1){
          if($custom_js != ''){ ?>
              <script type="text/javascript">
               <?php echo $custom_js; ?>
               </script>
        <?php  
         }
    }
  }
   /*
   * Load Stylesheet on Header
   */
   public function prefix_add_header_styles(){
        $arr_results = array();
        $options = get_option( 'apmega_settings' );      
        $mlabel_animation_type = (isset($options['mlabel_animation_type']))?$options['mlabel_animation_type']:'none';
        $animation_delay = (isset($options['animation_delay']))?$options['animation_delay'].'s':'2s';
        $animation_duration = (isset($options['animation_duration']))?$options['animation_duration'].'s':'3s';
        $animation_iteration_count = (isset($options['animation_iteration_count']))?$options['animation_iteration_count']:'1';
        $enable_custom_css = (isset($options['enable_custom_css']) && $options['enable_custom_css'] == 1)?'1':'0';
        $custom_css = (isset($options['custom_css']))?$options['custom_css']:'';
        $icon_width = (isset($options['icon_width']) && $options['icon_width'] != '')?$options['icon_width']:'';
        $enable_mobile = (isset($options['enable_mobile']) && $options['enable_mobile'] == 1)?'1':'0';
        $pre_responsive_bp = (isset($options['pre_responsive_bp']) && $options['pre_responsive_bp'] != '')?$options['pre_responsive_bp']:'';
   
        echo "<style type='text/css'>";   
        if( $enable_mobile == 1){
        if(isset($pre_responsive_bp) && $pre_responsive_bp != ''  && $pre_responsive_bp != '910'){
           $custom_responsive_bp = $pre_responsive_bp;
           include_once(APMM_PRO_PATH.'/inc/frontend/custom-responsive.php');
         }
        } 

        if($mlabel_animation_type != 'none'){  ?>
          span.wpmm-mega-menu-label.wpmm_depth_first{
                   animation-duration:  <?php echo esc_attr($animation_duration);?>;
                   animation-delay:     <?php echo esc_attr($animation_delay);?>;
                   animation-iteration-count: <?php echo $animation_iteration_count;?>;
                   -webkit-animation-duration:  <?php echo esc_attr($animation_duration);?>;
                  -webkit-animation-delay:     <?php echo esc_attr($animation_delay);?>;
                  -webkit-animation-iteration-count: <?php echo $animation_iteration_count;?>;
          }
            span.wpmm-mega-menu-label.wpmm_depth_last{
                   animation-duration:  <?php echo esc_attr($animation_duration);?>;
                   animation-delay:     <?php echo esc_attr($animation_delay);?>;
                   animation-iteration-count: <?php echo $animation_iteration_count;?>;
                   -webkit-animation-duration:  <?php echo esc_attr($animation_duration);?>;
                  -webkit-animation-delay:     <?php echo esc_attr($animation_delay);?>;
                  -webkit-animation-iteration-count: <?php echo $animation_iteration_count;?>;
          }
         <?php  }
         if($icon_width != ''){?>
         .wp-megamenu-main-wrapper .wpmm-mega-menu-icon{
            font-size: <?php echo esc_attr($icon_width);?>;
          }
        <?php  }
         if($enable_custom_css == 1 && $custom_css != ''){
            echo $custom_css;
          }
          
      /* CSS Style for Custom Styling Menu Items Per Menu Location */
        $menus = get_registered_nav_menus();
        $settings = get_option( 'wpmegabox_settings' ); //get all plugin metabox data 
        foreach ($menus as $key => $value) {
             $locations = get_nav_menu_locations();
              /*
               * Check if wp mega menu is enabled or not for specific menu location
              */
            if ( isset ( $settings[ $key ]['enabled'] ) && $settings[ $key ]['enabled'] == 1 ) {
                 $orientation = $settings[ $key ]['orientation'];
                 if(isset($locations[ $key ] )){
                 $menu = wp_get_nav_menu_object( $locations[ $key ] );
                 $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) ); // get all menu items of specific menu location
                
                 if(isset($menuitems) && !empty($menuitems)):
                 foreach ($menuitems as $key => $value) {
                   $menuID = $value->ID;
                   $menu_item_parent = $value->menu_item_parent;
                   $get_details = get_post_meta($menuID, '_wpmegamenu' );
                    $top_menu_label = (isset($get_details[0]['general_settings']['top_menu_label']))?$get_details[0]['general_settings']['top_menu_label']:'';
                    $label_animation = (isset($get_details[0]['general_settings']['label_animation'])?$get_details[0]['general_settings']['label_animation']:'none');
                   if($top_menu_label != ''){ 
                    $duration = (isset($get_details[0]['general_settings']['animaton_duration'])?$get_details[0]['general_settings']['animaton_duration']:$animation_duration);
                    $delay = (isset($get_details[0]['general_settings']['animaton_delay'])?$get_details[0]['general_settings']['animaton_delay']:$animation_delay);
                    $iteration_count = (isset($get_details[0]['general_settings']['animation_iteration_count']) && $get_details[0]['general_settings']['animation_iteration_count'] != '')?esc_attr($get_details[0]['general_settings']['animation_iteration_count']):$animation_iteration_count;
                    if($label_animation != 'none'){ ?>
                       #wp_nav_menu-item-<?php echo $menuID;?> span.wpmm-mega-menu-label.wpmm_depth_first{
                       animation-iteration-count: <?php echo $iteration_count;?>;
                      -webkit-animation-iteration-count: <?php echo $iteration_count;?>;
                       animation-duration:  <?php echo esc_attr($duration);?>;
                       animation-delay:     <?php echo esc_attr($delay);?>;
                      -webkit-animation-duration:  <?php echo esc_attr($duration);?>;
                      -webkit-animation-delay:     <?php echo esc_attr($delay);?>;

                     }
                  <?php } }
                   $enable_bg_image = (isset($get_details[0]['upload_image_settings']['enable_bg_image']) && $get_details[0]['upload_image_settings']['enable_bg_image'] == true)?1:0;
                   $bg_image_type = (isset($get_details[0]['upload_image_settings']['bg_image_type'])?$get_details[0]['upload_image_settings']['bg_image_type']:'');
                   $bg_image_url1 = (isset($get_details[0]['upload_image_settings']['bg_image_url1'])?esc_url($get_details[0]['upload_image_settings']['bg_image_url1']):'');
                   $bg_image_url2 = (isset($get_details[0]['upload_image_settings']['bg_image_url2'])?esc_url($get_details[0]['upload_image_settings']['bg_image_url2']):'');
                   $cross_fading_type = (isset($get_details[0]['upload_image_settings']['cross_fading_type'])?$get_details[0]['upload_image_settings']['cross_fading_type']:'');
                   $image_position = (isset($get_details[0]['upload_image_settings']['image_position'])?$get_details[0]['upload_image_settings']['image_position']:'');
                   $image_repeat = (isset($get_details[0]['upload_image_settings']['image_repeat'])?$get_details[0]['upload_image_settings']['image_repeat']:'');
                   $duration_time = (isset($get_details[0]['upload_image_settings']['duration_time'])?$get_details[0]['upload_image_settings']['duration_time']:'10');
                   $animation_type = (isset($get_details[0]['upload_image_settings']['animation_type'])?$get_details[0]['upload_image_settings']['animation_type']:'FadeInOut');
                   $single_animation_type = (isset($get_details[0]['upload_image_settings']['single_animation_type'])?$get_details[0]['upload_image_settings']['single_animation_type']:'zoom');
                    
                  if($bg_image_type == "double_image"){
                    $animate_type = $animation_type;
                  }else{
                    $animate_type = $single_animation_type;
                  }

                  if( $menu_item_parent == 0 && $enable_bg_image == 1){ ?>
                     .first-image,.second-image{
                        background-repeat: <?php echo $image_repeat;?>;
                        background-size:cover;
                        background-position:  <?php echo $image_position;?>;
                     }
                  <?php 
                     if($cross_fading_type != "changeonhover"){ 
                      if($animate_type == "FadeInOut"){?>
                       #wpmm_cbg_<?php echo $menuID;?> img.top {
                        animation-name: <?php echo $animate_type;?>;
                        animation-timing-function: ease-in-out;
                        animation-iteration-count: infinite;
                        animation-duration: <?php echo $duration_time;?>s;
                        animation-direction: alternate;
                        }
                  <?php }else if($animate_type == "zoom"){ ?>                  
                         #wpmm_cbg_<?php echo $menuID;?>.zoom{
                         animation: <?php echo $duration_time;?>s ease-in-out 1s normal none infinite running image;
                         -webkit-animation: <?php echo $duration_time;?>s ease-in-out 1s normal none infinite running image;
                         opacity:0.5;
                        }

                    <?php } }else{ ?>
                       #wpmm_cbg_<?php echo $menuID;?> img {
                        -webkit-transition: opacity 1s ease-in-out;
                        -moz-transition: opacity 1s ease-in-out;
                        -o-transition: opacity 1s ease-in-out;
                        transition: opacity 1s ease-in-out;
                      }

                    <?php  }?>
                    
                  <?php
                }
               }
             endif;
              }
            }
             }
          echo "</style>";  
         foreach ($menus as $key => $value) {
             $locations = get_nav_menu_locations();
              /*
               * Check if wp mega menu is enabled or not for specific menu location
              */
            if ( isset ( $settings[ $key ]['enabled'] ) && $settings[ $key ]['enabled'] == 1 ) {
                 $orientation = $settings[ $key ]['orientation'];
                 if(!empty( $locations[ $key ])){
                $menu = wp_get_nav_menu_object( $locations[ $key ] );
                 $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) ); // get all menu items of specific menu location
                 if(isset($menuitems) && !empty($menuitems)):
                 foreach ($menuitems as $key => $value) {
                   # code...
                   $menuID = $value->ID;
                   $arr = array(
                    'menuid' => $menuID,
                    'orientation' => $orientation
                    );
                   array_push($arr_results, $arr);
                  }
                 endif;

                 }
                 
              }
             }
             //WPMM_Libary::displayArr(  $arr_results );
             if(isset($arr_results) && !empty($arr_results)){
               echo "<style type='text/css'>";  
               foreach ($arr_results as $key => $value) {
                 $get_custom_styling_details = get_post_meta($value['menuid'], '_wpmegamenu' );
                 $check = (isset($get_custom_styling_details[0]['custom_styling']['enable_custom_styling']) && $get_custom_styling_details[0]['custom_styling']['enable_custom_styling'] == true)?true:false;
                 include(APMM_PRO_PATH.'/inc/frontend/header_styling.php');
                }
               echo "</style>";  
             }

          }

     


    function wpmm_megamenu_frontend_scripts(){
       $options = get_option( 'apmega_settings' );              // Variables for JS scripts
       $enable_mobile = (isset($options['enable_mobile']) && $options['enable_mobile'] == 1)?'1':'0';
       $enable_rtl = (isset($options['enable_rtl']) && $options['enable_rtl'] == 1)?'1':'0';

       wp_enqueue_style( 'wpmm-frontend', APMM_PRO_CSS_DIR . '/style.css',APMM_PRO_VERSION );
       if( $enable_mobile == 1){
        wp_enqueue_style( 'wpmm-responsive-stylesheet', APMM_PRO_CSS_DIR . '/responsive.css',APMM_PRO_VERSION );
        if(isset($options['pre_responsive_bp']) && $options['pre_responsive_bp'] != '' && $options['pre_responsive_bp'] != '910'){
         }else{
            $pre_responsive_bp = "910";
             wp_enqueue_style( 'wpmm-default-responsive-stylesheet', APMM_PRO_CSS_DIR . '/default-responsive.css',APMM_PRO_VERSION );
         }
        } 

       if( is_rtl() && $enable_rtl == 1){
         wp_enqueue_style( 'wpmm-style-rtl', APMM_PRO_CSS_DIR . '/style-rtl.css',APMM_PRO_VERSION );
       }
       wp_enqueue_style( 'wpmm-animate-css', APMM_PRO_CSS_DIR . '/animate.css', false, APMM_PRO_VERSION );
       wp_enqueue_style( 'wpmm-colorbox', APMM_PRO_CSS_DIR . '/colorbox.css', false, APMM_PRO_VERSION );
       wp_enqueue_style( 'wpmm-frontwalker-stylesheet', APMM_PRO_CSS_DIR . '/frontend_walker.css', true, APMM_PRO_VERSION );
       wp_enqueue_style('wpmm-google-fonts-style', "//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700");
       
       wp_enqueue_style('wpmm-bxslider-style',APMM_PRO_CSS_DIR.'/jquery.bxslider.css',false,APMM_PRO_VERSION);
       wp_enqueue_script('wpmm-jquery-bxslider-min',APMM_PRO_JS_DIR.'/jquery.bxslider.min.js',array('jquery'),APMM_PRO_VERSION);

       wp_enqueue_script( 'wp_megamenu_actual_scripts', APMM_PRO_JS_DIR . '/jquery.actual.js',array('jquery') , APMM_PRO_VERSION );
       wp_enqueue_script( 'wp_megamenu_colorbox', APMM_PRO_JS_DIR . '/jquery.colorbox.js',array('jquery') , APMM_PRO_VERSION );
       wp_enqueue_script( 'wp_megamenu-frontend_scripts', APMM_PRO_JS_DIR . '/frontend.js',array('jquery') , APMM_PRO_VERSION );
       wp_enqueue_script( 'wp_megamenu_validate_scripts', APMM_PRO_JS_DIR . '/jquery.validate.js',array('jquery') , APMM_PRO_VERSION );
     
       wp_register_script('wpmm_ajax-auth-script', APMM_PRO_JS_DIR . '/ajax-auth-script.js', array('jquery') , APMM_PRO_VERSION); 
       wp_enqueue_script('wpmm_ajax-auth-script');

       
       if(WPMM_Libary::is_woocommerce_activated()){
              $wooenabled = "true";
        }else{
             $wooenabled = "false";
        }
     
        $mlabel_animation_type = (isset($options['mlabel_animation_type']))?$options['mlabel_animation_type']:'none';
        $animation_delay = (isset($options['animation_delay']))?$options['animation_delay']:'2';
        $animation_duration = (isset($options['animation_duration']))?$options['animation_duration']:'3';
        $animation_iteration_count = (isset($options['animation_iteration_count']))?$options['animation_iteration_count']:'1';
        wp_localize_script('wp_megamenu-frontend_scripts', 'wp_megamenu_params', array(
          'wpmm_mobile_toggle_option'      => esc_attr($options['mobile_toggle_option']),
          'wpmm_enable_rtl'                => $enable_rtl,
          'wpmm_event_behavior'            => esc_attr($options['advanced_click']), //click_submenu or follow_link
          'wpmm_ajaxurl'                   => admin_url('admin-ajax.php'),
          'wpmm_ajax_nonce'                => wp_create_nonce('wpm-ajax-nonce'),
          'check_woocommerce_enabled'      => $wooenabled,
          'wpmm_mlabel_animation_type'     => esc_attr($mlabel_animation_type),
          'wpmm_animation_delay'           => esc_attr($animation_delay),
          'wpmm_animation_duration'        => esc_attr($animation_duration),
          'wpmm_animation_iteration_count'      => esc_attr($animation_iteration_count),
          'enable_mobile'                     => $enable_mobile,
          'wpmm_sticky_opacity'            => (isset($options['sticky_opacity'])?esc_attr($options['sticky_opacity']):''), 
          'wpmm_sticky_offset'             => (isset($options['sticky_offset'])?esc_attr($options['sticky_offset']):''),
          'wpmm_sticky_zindex'             => (isset($options['sticky_zindex'])?esc_attr($options['sticky_zindex']):'')
        ));

       wp_localize_script( 'wpmm_ajax-auth-script', 'wp_megamenu_ajax_auth_object', array( 
          'ajaxurl' => admin_url( 'admin-ajax.php' ),
          'redirecturl' => home_url(),
          'loadingmessage' => __('Sending user info, please wait...')
      ));
      
       wp_enqueue_style('wpmegamenu-fontawesomes', APMM_PRO_CSS_DIR . '/wpmm-icons/font-awesome/font-awesome.css',true,APMM_PRO_VERSION);
       wp_enqueue_style('wpmegamenu-flaticons', APMM_PRO_CSS_DIR . '/wpmm-icons/flaticons/flaticon.css',true,APMM_PRO_VERSION);
       wp_enqueue_style('wpmegamenu-icomoon', APMM_PRO_CSS_DIR.'/wpmm-icons/icomoon/icomoon.css', array(), APMM_PRO_VERSION);
       wp_enqueue_style('wpmegamenu-linecon-css', APMM_PRO_CSS_DIR.'/wpmm-icons/linecon/linecon.css', array(), APMM_PRO_VERSION);
       wp_enqueue_style('wpmegamenu-genericons', APMM_PRO_CSS_DIR . '/wpmm-icons/genericons.css',true,APMM_PRO_VERSION);
       wp_enqueue_style( 'dashicons' );
    }




    /*
    * Includes All AP Mega Menu class
    */
    function ap_megamenu_includes(){
            foreach ( $this->menuincludes() as $id => $path ) {
                if ( is_readable( $path ) && ! class_exists( $id ) ) {
                    require_once $path;
                }
            }     
    }

    
      function menuincludes(){
            return array(
              'wpmegamenuwalker_class'          => APMM_PRO_PATH . 'inc/frontend/WPMegamenuWalker_Class.php',
              'ap_menu_settings'                => APMM_PRO_PATH . 'inc/admin/menu_settings_class.php',   //admin menu display class
              'ap_theme_settings'               => APMM_PRO_PATH . 'inc/admin/theme_settings_class.php',   //admin menu display class
              'wpmm_menu_widget_manager'        => APMM_PRO_PATH . 'inc/admin/widget-manager_class.php'
          );
      }

     /*
      * Loads the text domain for translation and Session Start, Header start Check
     */
    function apmm_initialize(){
      load_plugin_textdomain(APMM_PRO_TD, false, basename( dirname( __FILE__ ) ) . '/languages' ); //Loads plugin text domain for the translation
      if ( !session_id() && !headers_sent() ) {
        session_start(); //starts session if already not started
      }    
    }

    
     /*
      * Plugin Activation Default Setup
     */
       function apmm_pro_activation(){
           include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
           if (is_plugin_active('ap-mega-menu/ap-mega-menu.php')) {
             wp_die( __( 'You need to deactivate AP Mega Menu Free Plugin in order to activate AP Mega Menu Pro plugin.Please deactivate free one.', APMM_PRO_TD ) );
            // deactivate_plugins('wp-mega-menu/wp-mega-menu.php');
           }
          if ( is_multisite() ) {
          include('inc/backend/multisite-activation.php');
          }else{
           include('inc/backend/activation.php');
          }   

              /**
             * Load Default Settings
             * */
            if (!get_option('apmega_settings')) {
                $apmega_settings = $this->apmm_default_settings();
                update_option('apmega_settings', $apmega_settings);
            }

            /**
             * Google font save
             * */
            $family = array('ABeeZee','Abel','Abril Fatface','Aclonica','Acme','Actor','Adamina','Advent Pro','Aguafina Script','Akronim','Aladin','Aldrich','Alef','Alegreya','Alegreya SC','Alegreya Sans','Alegreya Sans SC','Alex Brush','Alfa Slab One','Alice','Alike','Alike Angular','Allan','Allerta','Allerta Stencil','Allura','Almendra','Almendra Display','Almendra SC','Amarante','Amaranth','Amatic SC','Amethysta','Amiri','Amita','Anaheim','Andada','Andika','Angkor','Annie Use Your Telescope','Anonymous Pro','Antic','Antic Didone','Antic Slab','Anton','Arapey','Arbutus','Arbutus Slab','Architects Daughter','Archivo Black','Archivo Narrow','Arimo','Arizonia','Armata','Artifika','Arvo','Arya','Asap','Asar','Asset','Astloch','Asul','Atomic Age','Aubrey','Audiowide','Autour One','Average','Average Sans','Averia Gruesa Libre','Averia Libre','Averia Sans Libre','Averia Serif Libre','Bad Script','Balthazar','Bangers','Basic','Battambang','Baumans','Bayon','Belgrano','Belleza','BenchNine','Bentham','Berkshire Swash','Bevan','Bigelow Rules','Bigshot One','Bilbo','Bilbo Swash Caps','Biryani','Bitter','Black Ops One','Bokor','Bonbon','Boogaloo','Bowlby One','Bowlby One SC','Brawler','Bree Serif','Bubblegum Sans','Bubbler One','Buda','Buenard','Butcherman','Butterfly Kids','Cabin','Cabin Condensed','Cabin Sketch','Caesar Dressing','Cagliostro','Calligraffitti','Cambay','Cambo','Candal','Cantarell','Cantata One','Cantora One','Capriola','Cardo','Carme','Carrois Gothic','Carrois Gothic SC','Carter One','Caudex','Cedarville Cursive','Ceviche One','Changa One','Chango','Chau Philomene One','Chela One','Chelsea Market','Chenla','Cherry Cream Soda','Cherry Swash','Chewy','Chicle','Chivo','Cinzel','Cinzel Decorative','Clicker Script','Coda','Coda Caption','Codystar','Combo','Comfortaa','Coming Soon','Concert One','Condiment','Content','Contrail One','Convergence','Cookie','Copse','Corben','Courgette','Cousine','Coustard','Covered By Your Grace','Crafty Girls','Creepster','Crete Round','Crimson Text','Croissant One','Crushed','Cuprum','Cutive','Cutive Mono','Damion','Dancing Script','Dangrek','Dawning of a New Day','Days One','Dekko','Delius','Delius Swash Caps','Delius Unicase','Della Respira','Denk One','Devonshire','Dhurjati','Didact Gothic','Diplomata','Diplomata SC','Domine','Donegal One','Doppio One','Dorsa','Dosis','Dr Sugiyama','Droid Sans','Droid Sans Mono','Droid Serif','Duru Sans','Dynalight','EB Garamond','Eagle Lake','Eater','Economica','Eczar','Ek Mukta','Electrolize','Elsie','Elsie Swash Caps','Emblema One','Emilys Candy','Engagement','Englebert','Enriqueta','Erica One','Esteban','Euphoria Script','Ewert','Exo','Exo 2','Expletus Sans','Fanwood Text','Fascinate','Fascinate Inline','Faster One','Fasthand','Fauna One','Federant','Federo','Felipa','Fenix','Finger Paint','Fira Mono','Fira Sans','Fjalla One','Fjord One','Flamenco','Flavors','Fondamento','Fontdiner Swanky','Forum','Francois One','Freckle Face','Fredericka the Great','Fredoka One','Freehand','Fresca','Frijole','Fruktur','Fugaz One','GFS Didot','GFS Neohellenic','Gabriela','Gafata','Galdeano','Galindo','Gentium Basic','Gentium Book Basic','Geo','Geostar','Geostar Fill','Germania One','Gidugu','Gilda Display','Give You Glory','Glass Antiqua','Glegoo','Gloria Hallelujah','Goblin One','Gochi Hand','Gorditas','Goudy Bookletter 1911','Graduate','Grand Hotel','Gravitas One','Great Vibes','Griffy','Gruppo','Gudea','Gurajada','Habibi','Halant','Hammersmith One','Hanalei','Hanalei Fill','Handlee','Hanuman','Happy Monkey','Headland One','Henny Penny','Herr Von Muellerhoff','Hind','Holtwood One SC','Homemade Apple','Homenaje','IM Fell DW Pica','IM Fell DW Pica SC','IM Fell Double Pica','IM Fell Double Pica SC','IM Fell English','IM Fell English SC','IM Fell French Canon','IM Fell French Canon SC','IM Fell Great Primer','IM Fell Great Primer SC','Iceberg','Iceland','Imprima','Inconsolata','Inder','Indie Flower','Inika','Inknut Antiqua','Irish Grover','Istok Web','Italiana','Italianno','Jacques Francois','Jacques Francois Shadow','Jaldi','Jim Nightshade','Jockey One','Jolly Lodger','Josefin Sans','Josefin Slab','Joti One','Judson','Julee','Julius Sans One','Junge','Jura','Just Another Hand','Just Me Again Down Here','Kadwa','Kalam','Kameron','Kantumruy','Karla','Karma','Kaushan Script','Kavoon','Kdam Thmor','Keania One','Kelly Slab','Kenia','Khand','Khmer','Khula','Kite One','Knewave','Kotta One','Koulen','Kranky','Kreon','Kristi','Krona One','Kurale','La Belle Aurore','Laila','Lakki Reddy','Lancelot','Lateef','Lato','League Script','Leckerli One','Ledger','Lekton','Lemon','Libre Baskerville','Life Savers','Lilita One','Lily Script One','Limelight','Linden Hill','Lobster','Lobster Two','Londrina Outline','Londrina Shadow','Londrina Sketch','Londrina Solid','Lora','Love Ya Like A Sister','Loved by the King','Lovers Quarrel','Luckiest Guy','Lusitana','Lustria','Macondo','Macondo Swash Caps','Magra','Maiden Orange','Mako','Mallanna','Mandali','Marcellus','Marcellus SC','Marck Script','Margarine','Marko One','Marmelad','Martel','Martel Sans','Marvel','Mate','Mate SC','Maven Pro','McLaren','Meddon','MedievalSharp','Medula One','Megrim','Meie Script','Merienda','Merienda One','Merriweather','Merriweather Sans','Metal','Metal Mania','Metamorphous','Metrophobic','Michroma','Milonga','Miltonian','Miltonian Tattoo','Miniver','Miss Fajardose','Modak','Modern Antiqua','Molengo','Molle','Monda','Monofett','Monoton','Monsieur La Doulaise','Montaga','Montez','Montserrat','Montserrat Alternates','Montserrat Subrayada','Moul','Moulpali','Mountains of Christmas','Mouse Memoirs','Mr Bedfort','Mr Dafoe','Mr De Haviland','Mrs Saint Delafield','Mrs Sheppards','Muli','Mystery Quest','NTR','Neucha','Neuton','New Rocker','News Cycle','Niconne','Nixie One','Nobile','Nokora','Norican','Nosifer','Nothing You Could Do','Noticia Text','Noto Sans','Noto Serif','Nova Cut','Nova Flat','Nova Mono','Nova Oval','Nova Round','Nova Script','Nova Slim','Nova Square','Numans','Nunito','Odor Mean Chey','Offside','Old Standard TT','Oldenburg','Oleo Script','Oleo Script Swash Caps','Open Sans','Open Sans Condensed','Oranienbaum','Orbitron','Oregano','Orienta','Original Surfer','Oswald','Over the Rainbow','Overlock','Overlock SC','Ovo','Oxygen','Oxygen Mono','PT Mono','PT Sans','PT Sans Caption','PT Sans Narrow','PT Serif','PT Serif Caption','Pacifico','Palanquin','Palanquin Dark','Paprika','Parisienne','Passero One','Passion One','Pathway Gothic One','Patrick Hand','Patrick Hand SC','Patua One','Paytone One','Peddana','Peralta','Permanent Marker','Petit Formal Script','Petrona','Philosopher','Piedra','Pinyon Script','Pirata One','Plaster','Play','Playball','Playfair Display','Playfair Display SC','Podkova','Poiret One','Poller One','Poly','Pompiere','Pontano Sans','Poppins','Port Lligat Sans','Port Lligat Slab','Pragati Narrow','Prata','Preahvihear','Press Start 2P','Princess Sofia','Prociono','Prosto One','Puritan','Purple Purse','Quando','Quantico','Quattrocento','Quattrocento Sans','Questrial','Quicksand','Quintessential','Qwigley','Racing Sans One','Radley','Rajdhani','Raleway','Raleway Dots','Ramabhadra','Ramaraja','Rambla','Rammetto One','Ranchers','Rancho','Ranga','Rationale','Ravi Prakash','Redressed','Reenie Beanie','Revalia','Rhodium Libre','Ribeye','Ribeye Marrow','Righteous','Risque','Roboto','Roboto Condensed','Roboto Mono','Roboto Slab','Rochester','Rock Salt','Rokkitt','Romanesco','Ropa Sans','Rosario','Rosarivo','Rouge Script','Rozha One','Rubik','Rubik Mono One','Rubik One','Ruda','Rufina','Ruge Boogie','Ruluko','Rum Raisin','Ruslan Display','Russo One','Ruthie','Rye','Sacramento','Sahitya','Sail','Salsa','Sanchez','Sancreek','Sansita One','Sarala','Sarina','Sarpanch','Satisfy','Scada','Scheherazade','Schoolbell','Seaweed Script','Sevillana','Seymour One','Shadows Into Light','Shadows Into Light Two','Shanti','Share','Share Tech','Share Tech Mono','Shojumaru','Short Stack','Siemreap','Sigmar One','Signika','Signika Negative','Simonetta','Sintony','Sirin Stencil','Six Caps','Skranji','Slabo 13px','Slabo 27px','Slackey','Smokum','Smythe','Sniglet','Snippet','Snowburst One','Sofadi One','Sofia','Sonsie One','Sorts Mill Goudy','Source Code Pro','Source Sans Pro','Source Serif Pro','Special Elite','Spicy Rice','Spinnaker','Spirax','Squada One','Sree Krushnadevaraya','Stalemate','Stalinist One','Stardos Stencil','Stint Ultra Condensed','Stint Ultra Expanded','Stoke','Strait','Sue Ellen Francisco','Sumana','Sunshiney','Supermercado One','Sura','Suranna','Suravaram','Suwannaphum','Swanky and Moo Moo','Syncopate','Tangerine','Taprom','Tauri','Teko','Telex','Tenali Ramakrishna','Tenor Sans','Text Me One','The Girl Next Door','Tienne','Tillana','Timmana','Tinos','Titan One','Titillium Web','Trade Winds','Trocchi','Trochut','Trykker','Tulpen One','Ubuntu','Ubuntu Condensed','Ubuntu Mono','Ultra','Uncial Antiqua','Underdog','Unica One','UnifrakturCook','UnifrakturMaguntia','Unkempt','Unlock','Unna','VT323','Vampiro One','Varela','Varela Round','Vast Shadow','Vesper Libre','Vibur','Vidaloka','Viga','Voces','Volkhov','Vollkorn','Voltaire','Waiting for the Sunrise','Wallpoet','Walter Turncoat','Warnes','Wellfleet','Wendy One','Wire One','Work Sans','Yanone Kaffeesatz','Yantramanav','Yellowtail','Yeseva One','Yesteryear','Zeyada');
            $apmm_font_family = get_option('apmm_font_family');
            if (empty($apmm_font_family)) {
                update_option('apmm_font_family', $family);
            }

           AP_Menu_Settings::wpmm_menu_item_defaults();
            /*
            * Available Skin Themes
            */
             $available_skin = array(
              '0' => 
             array('title' => 'Black & White',
                     'id' => 'black-white' ,
                     'color' => '#000000',
                  ), 
              '1' => 
             array('title' => 'Gold Yellowish',
                     'id' => 'gold-yellow-black',
                      'color' => '#dace2e' 
                  ), 
              '2' => 
             array('title' => 'Hunter Shades',
                     'id' => 'hunter-shades-white',
                      'color' => '#CFA66F' 
                  ), 
              '3' => 
             array('title' => 'Maroon Reddish',
                     'id' => 'maroon-reddish-black',
                      'color' => '#800000'
                  ), 
              '4' => 
             array('title' => 'Light Blue Sky',
                     'id' => 'light-blue-sky-white' ,
                      'color' => '#0AA2EE'
                  ), 
              '5' => 
             array('title' => 'Warm Purple',
                     'id' => 'warm-purple-white',
                     'color' => '#9768a8'
                  ), 
               '6' => 
             array('title' => 'SeaGreen',
                     'id' => 'sea-green-white',
                     'color' => '#2E8B57'
                  ), 
             '7' => 
             array('title' => 'Clean White',
                     'id' => 'clean-white',
                     'color' => '#fff'
                  ), 
               '8' => 
             array('title' => 'Black & Silver',
                     'id' => 'black-silver',
                     'color' => '#888'
                  ), 
                  '9' => 
             array('title' => 'Transparent With Hover Black',
                     'id' => 'transparent-hover-black',
                     'color' => '#323232'
                  ),     
                '10' => 
             array('title' => 'Prussian Blue',
                     'id' => 'prussian-blue-white',
                     'color' => '#003153'
                  ), 
                '11' => 
             array('title' => 'Mountain Meadow',
                     'id' => 'mountain-meadow-white',
                     'color' => '#30ba8f'
                  ), 
               '12' => 
             array('title' => 'Dark Blue',
                     'id' => 'white-blue',
                     'color' => '#0056c7'
                  ), 
              '13' => 
             array('title' => 'Simple Green',
                     'id' => 'simple-green',
                     'color' => '#570'
                  )

             );
           $available_skin_themes = get_option('apmm_pro_register_skin');
           if (empty($available_skin_themes)) {
               update_option('apmm_pro_register_skin', $available_skin);
            }       
       }

        /**
        * Returns Default Settings
       */
       public static function apmm_default_settings() {
            $apmega_settings = array(
                                'advanced_click'=>'click_submenu',
                                'mlabel_animation_type'=>'none',
                                'animation_delay'=>'2s',
                                'animation_duration'=>'3s',
                                'animation_iteration_count'=>'1',
                                'enable_mobile'=>'1',
                                'enable_rtl'   => '0',
                                'disable_submenu_retractor' => 0,
                                'mobile_toggle_option'=> 'toggle_standard',
                                'image_size' => 'thumbnail',
                                'hide_icons'     => 0,
                                'custom_width'   => '',
                                'close_menu_icon' => 'dashicons dashicons-menu',
                                'open_menu_icon'  => 'dashicons dashicons-no',
                                'icon_width' => '13px',
                                'active_sticky_menu' => '0',
                                'sticky_theme_location' => '',
                                // 'transition_style' => 'fade',//fade ,slide
                                'sticky_on_mobile' => '1',
                                'sticky_opacity' => '0',
                                'sticky_zindex' => '9999',
                                'choose_woo_cart_display' => 'both_pi',
                                'cart_display_pattern' => '(#price)#item_count items',
            );
            return $apmega_settings;
        }




    /**
    * Add Search icon with form Using Shortcode
    * [wp_megamenu_search_form template_type="inline-search" style="inline-toggle-left"] or 
    * [wp_megamenu_search_form template_type="inline-search" style="inline-toggle-right"]
    * [wp_megamenu_search_form template_type="popup-search-form"] //pro 
    * [wp_megamenu_search_form template_type="megamenu-type-search"]
    **/
    function wpmm_generate_search_shortcode($atts,$content = null){
              extract(shortcode_atts(array('template_type' => '','stype'=>''), $atts));
              ob_start();
              include( 'inc/backend/wpmm_search_shortcode.php' );
              $html = ob_get_contents();
              ob_get_clean();
              return $html;

    }



    function wpmm_mega_register_widget(){
         register_widget( 'WP_Mega_Menu_Widget_PRO' );
         register_widget( 'WP_Mega_Menu_PRO_Contact_Info' );
         register_widget('WP_Mega_Menu_Posts_Heading_Widget');
         register_widget('WP_Mega_Menu_PRO_PostsTimeline');
         register_widget('WP_Mega_Menu_PRO_PostsFormat');
         register_widget('WP_Mega_Menu_PRO_TextImage');
         register_widget('WP_Mega_Menu_PRO_FeatureBox');
         register_widget('WPMMPro_Simple_Recent_Posts');
         register_widget('WP_Mega_Menu_PRO_Posts_Slider_Widget');
         register_widget('WP_Mega_Menu_PRO_LinkImage');
         register_widget('WP_Mega_Menu_PRO_GalleryImageWidget');
         register_widget('WP_Mega_Menu_PRO_HtmlText');

         if(WPMM_Libary::is_woocommerce_activated()){
           register_widget( 'WPMMPro_prodlist_widget_area' );
           register_widget( 'WPMMPro_Recent_Products_widget_area' );
           register_widget( 'WPMMPro_Products_With_Cart_widget_area' );
         }
    } 


  
          /*
    *  Display Menu Using Shortcode [wpmegamenu menu_location=primary]
    */
    function wpmm_print_menu_shortcode($atts, $content = null) {
      extract(shortcode_atts(array( 'menu_location' => null), $atts));
      if ( ! isset( $menu_location ) ) {
            return false;
        }
         if ( has_nav_menu( $menu_location ) ) {
          $settings = get_option( 'wpmegabox_settings' ); //get all plugin metabox data 
          $current_theme_location = $menu_location; // get current menu location i.e primary
           if ( isset ( $settings[ $current_theme_location ]['enabled'] ) && $settings[ $current_theme_location ]['enabled'] == 1 ) {
           
             if(isset($settings[ $current_theme_location ]['theme_type'] ) && $settings[ $current_theme_location ]['theme_type'] == "custom_themes" ){
                        $skin_type = "wpmm-custom-theme"; 
                      }else{
                        $skin_type = '';
                      }
              if($skin_type =="wpmm-custom-theme"){
                WPMM_Libary::get_custom_designs($current_theme_location,$settings);
              }
               return wp_nav_menu( array( 'theme_location' => $menu_location, 'echo' => false ) );
           }

         
        }
         return "<!-- Menu Location Not found for [wpmegamenu menu_location={$menu_location}] -->";
    }

       public static function wpmm_pro_shopping_cart_ajax_data($woo_cart_display, $cart_display_pattern,$enable_custom_image, $custom_image_url,$custom_width,$custom_height,$nameimage,$icon_type,$icon_class,$customwidth,$customheight,$attr_class,$class){
     
        $woo_details = array(
            'woo_cart_display' => $woo_cart_display,
            'cart_display_pattern' => $cart_display_pattern,
            'enable_custom_image' => $enable_custom_image,
            'custom_image_url' => $custom_image_url,
            'custom_width' => $custom_width,
            'custom_height' => $custom_height,
            'nameimage' => $nameimage,
            'icon_type' => $icon_type,
            'customwidth' => $customwidth,
            'customheight' => $customheight,
            'icon_class' => $icon_class,
            'attr_class' => $attr_class,
            'class' => $class
          );

       update_option( 'wpmm_woo_settings',  $woo_details );
       $getsettings = get_option('wpmm_woo_settings');
      // WPMM_Libary::displayArr($getsettings);
          if(WPMM_Libary::is_woocommerce_activated()){
            $html_content ='<a class="wpmm-cart-contentsone '.$getsettings['class'].'" href="'.esc_url( WC()->cart->get_cart_url() ).'" title="View your shopping cart">';
                  if($getsettings['enable_custom_image'] == "1"){
                            //enable custom icon 
                          $html_content .= "<img src=".$custom_image_url." alt=".$nameimage[0]." width=".$custom_width." height=".$custom_height.">";
                           }else{
                            //show font icon instead
                           // if($attr_class != ''){ 

                               if(isset($getsettings['icon_type']) && $getsettings['icon_type'] == "custom"){
                                  $html_content .= '<span class="wpmm-mega-menu-icon"><img src="'.$getsettings['icon_class'].'" width="'.$getsettings['customwidth'].'" height="'.$getsettings['customheight'].'"/></span>';
                                } else{
                                   $html_content .= '<i class="wpmm-mega-menu-icon "'.$getsettings['icon_class'].'" aria-hidden="true"></i>';
                                 }
                              //}
                          }

                     switch ($getsettings['woo_cart_display']) {
                            case 'icon_only':
                              # Icon Only
                              break;
                            case 'item_only':
                              # Icon & Items Only
                            if(WPMM_Libary::is_woocommerce_activated()){
                              $html_content .= "<span class='wpmm-cart-count'>'".wp_kses_data( sprintf(  WC()->cart->get_cart_contents_count() ) )."'</span>";
                          }
                              break;
                            case 'price_only':
                              # Icon & Price Only
                              if(WPMM_Libary::is_woocommerce_activated()){
                                $html_content .= "<span class='wpmm-cart-amount'>'".wp_kses_data( WC()->cart->get_cart_subtotal())."'</span>";
                              }
                              break;
                            case 'both_pi':
                              # Icon Both Price and Items

                            if(WPMM_Libary::is_woocommerce_activated()){
                              $itemcount  = wp_kses_data( sprintf(  WC()->cart->get_cart_contents_count() ) );
                              $amt = wp_kses_data( WC()->cart->get_cart_subtotal());
                              if($getsettings['cart_display_pattern'] != ''){
                                $cart_display_pattern = $getsettings['cart_display_pattern'];
                                  $orginalstr = array("#item_count", "#price");
                                  $replacestr   = array($itemcount,$amt );
                                  $total_cart_display = str_replace($orginalstr, $replacestr,$cart_display_pattern );
                                  $html_content .= "<span class='wpmm-cart-count'>".$total_cart_display."</span>";
                              
                            }
                          }
                              break;
                            default:
                              # code...
                           
                              break;
                          }
              $html_content .= "</a>";  
            }else{
              $html_content = "";
            }
              //echo $html_content;                                    
             return  $html_content;    
                        
                    }

        public static function wpmm_pro_cart_header_one_link_fragment( $fragments) {

           global $woocommerce;     
           ob_start();

           $woo_settings = get_option('wpmm_woo_settings');

           $woo_cart_display = $woo_settings['woo_cart_display'];
           $cart_display_pattern = $woo_settings['cart_display_pattern'];
           $enable_custom_image = $woo_settings['enable_custom_image'];
           $custom_image_url = $woo_settings['custom_image_url'];
           $custom_width = $woo_settings['custom_width'];
           $custom_height =$woo_settings['custom_height'];
           $nameimage[0] = $woo_settings['nameimage'];
           $attr_class = $woo_settings['attr_class'];
           $class = $woo_settings['class'];   
           $icon_class  = $woo_settings['icon_class'];
           ?>
          <a class="wpmm-cart-contentsone <?php echo $class;?>" href="<?php echo esc_url( WC()->cart->get_cart_url() );?>" 
            title="View your shopping cart">
               <?php
                  if($enable_custom_image == "1"){
                            //enable custom icon ?>
                        <img src="<?php echo $custom_image_url;?>" alt="<?php echo $nameimage[0];?>" 
                           width="<?php echo  $custom_width;?>" height="<?php echo $custom_height;?>">
                           <?php }else{
                            //show font icon instead
                            if($attr_class != ''){ 
                            ?>
                            <i class="wpmm-mega-menu-icon <?php echo $icon_class;?>" aria-hidden="true"></i>
                          <?php   }
                          }

                     switch ($woo_cart_display) {
                            case 'icon_only':
                              # Icon Only
                              break;
                            case 'item_only':
                              # Icon & Items Only
                            if(WPMM_Libary::is_woocommerce_activated()){
                          ?>
                          <span class='wpmm-cart-count'><?php echo wp_kses_data( sprintf(  WC()->cart->get_cart_contents_count() ) );?></span>
                      <?php    }
                              break;
                            case 'price_only':
                              # Icon & Price Only
                              if(WPMM_Libary::is_woocommerce_activated()){
                     ?>
                     <span class='wpmm-cart-amount'><?php echo wp_kses_data( WC()->cart->get_cart_subtotal());?></span>
                     <?php
                              }
                              break;
                            case 'both_pi':
                              # Icon Both Price and Items
                            if(WPMM_Libary::is_woocommerce_activated()){
                              $itemcount  = wp_kses_data( sprintf(  WC()->cart->get_cart_contents_count() ) );
                              $amt = wp_kses_data( WC()->cart->get_cart_subtotal());
                              if($cart_display_pattern != ''){
                                  $orginalstr = array("#item_count", "#price");
                                  $replacestr   = array($itemcount,$amt );
                                  $total_cart_display = str_replace($orginalstr, $replacestr,$cart_display_pattern );
                                 ?>
                                 <span class='wpmm-cart-count'><?php echo $total_cart_display;?></span>
                                 <?php
                              
                            }
                          }
                              break;
                            default:
                              # code...
                           
                              break;
                          }
             ?>
             </a>
             <?php
            $fragments['a.wpmm-cart-contentsone'] = ob_get_clean();
           return $fragments;
       }




     /**
     * Add Login Form with form Using Shortcode
     * [wp_megamenu_login_form]
     **/
     function login_form_shortcode( $atts ) {
         global $post;
         extract( shortcode_atts( array(
              'title' => '',
           ), $atts ) );   
        ob_start();
        include( 'inc/backend/wpmm_login_form.php' );
        $html = ob_get_contents();
        ob_get_clean();
        return $html;
    }

     /**
     * Add Register Form with form Using Shortcode
     * [wp_megamenu_register_form]
     **/
     function register_form_shortcode( $atts ) {
         global $post;
         extract( shortcode_atts( array(
              'title' => '',
           ), $atts ) );   
        ob_start();
        include( 'inc/backend/wpmm_login_form.php' );
        $html = ob_get_contents();
        ob_get_clean();
        return $html;
    }



         /* Login Form Using Ajax */
    function ajax_login(){

        // First check the nonce, if it fails the function will break
        check_ajax_referer( 'ajax-login-nonce', 'security' );

        // Nonce is checked, get the POST data and sign user on
        // Call wpmm_auth_user_login
        $this->wpmm_auth_user_login($_POST['username'], $_POST['password'], 'Login'); 
      
        die();
    }

    function ajax_register(){

        // First check the nonce, if it fails the function will break
        check_ajax_referer( 'ajax-register-nonce', 'security' );
        
        // Nonce is checked, get the POST data and sign user on
        $info = array();
        $info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($_POST['username']) ;
        $info['user_pass'] = sanitize_text_field($_POST['password']);
        $info['user_email'] = sanitize_email( $_POST['email']);
      
      // Register the user
        $user_register = wp_insert_user( $info );
      if ( is_wp_error($user_register) ){ 
        $error  = $user_register->get_error_codes() ;
        
        if(in_array('empty_user_login', $error))
          echo json_encode(array('loggedin'=>false, 'message'=>__($user_register->get_error_message('empty_user_login'))));
        elseif(in_array('existing_user_login',$error))
          echo json_encode(array('loggedin'=>false, 'message'=>__('This username is already registered.')));
        elseif(in_array('existing_user_email',$error))
            echo json_encode(array('loggedin'=>false, 'message'=>__('This email address is already registered.')));
        } else {
        $this->wpmm_auth_user_login($info['nickname'], $info['user_pass'], 'Registration');       
        }

        die();
    }

    function wpmm_auth_user_login($user_login, $password, $login)
      {
          $info = array();
          $info['user_login'] = $user_login;
          $info['user_password'] = $password;
          $info['remember'] = true;
        
        $user_signon = wp_signon( $info, false );
          if ( is_wp_error($user_signon) ){
          echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
          } else {
          wp_set_current_user($user_signon->ID); 
              echo json_encode(array('loggedin'=>true, 'message'=>__($login.' successful, redirecting...')));
          }
        
        die();
      }

    /**
     * Black Studio TinyMCE Compatibility.
     * Load TinyMCE assets on nav-menus.php page.
     *
     * @since 1.0.0
     * @param array $pages
     * @return array $pages
     */
    public function wpmegamenu_blackstudio_tinymce( $pages ) {
        $pages[] = 'nav-menus.php';
        return $pages;
    }


  }

  $wpmmegamenu_pro_object = new APMM_Class_Pro();
  $wpmega_menu_pro_library = new WPMM_Libary();

}
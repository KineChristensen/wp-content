<?php
// if called directly, abort.
if (!defined('WPINC')) { die; }

class raysgrid_Base {

    public $rsgd_sections;

    public function __construct() {
        
        ob_start();
        
        $this->rsgd_sections['rsgd_naming']        = '<i class="dashicons dashicons-megaphone"></i>'.__( 'Naming' , RSGD_SLUG );
        $this->rsgd_sections['rsgd_source']        = '<i class="dashicons dashicons-admin-network"></i>'.__( 'Source' , RSGD_SLUG );
        $this->rsgd_sections['rsgd_gnrlsetting']   = '<i class="dashicons dashicons-admin-plugins"></i>'.__( 'Layout' , RSGD_SLUG );
        $this->rsgd_sections['rsgd_skins']         = '<i class="dashicons dashicons-admin-appearance"></i>'.__( 'Skins & Styles' , RSGD_SLUG );
        $this->rsgd_sections['rsgd_nav']           = '<i class="dashicons dashicons-admin-generic"></i>'.__( 'Nav Filter' , RSGD_SLUG );

        add_action('init', array($this, 'rsgd_portfolio_post'));
        add_action('init', array($this, 'rsgd_create_taxs'));

        add_action('admin_menu', array($this, 'rsgd_admin_menu'));

        add_action('admin_enqueue_scripts', array(&$this, 'rsgd_admin_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'rsgd_front_styles'), 56);
        
        add_shortcode( RSGD_PFX , array($this, 'rsgd_register_shortcode') );
        
    }

    public function rsgd_create_settings($id, $args = array()) {
        
        echo '<ul class="rsgd_tabs">';
            foreach ($this->rsgd_sections as $section_slug => $section) {
                echo '<li><a href="#' . $section_slug . '">' . $section . '</a></li>';
            }
        echo '</ul>';
        
        echo '<div class="rsgd_tab_content">';
            self::rsgd_all_sections($id);
        echo '</div>';
        
    }

    public function rsgd_all_sections($id) {
        
        foreach ($this->rsgd_sections as $section_slug => $section) {
            $cls = ( $section_slug == 'rsgd_naming') ? ' active' : "";
            
            echo '<div class="tab-pane'.$cls;
                echo ' "id="' . $section_slug . '">';
                $this->rsgd_diplay_section($id, $section_slug);
            echo '</div>';
        }
        
    }

    public function rsgd_diplay_section($id, $section_slug) {
        
        $configs        = new raysgrid_Config();
        $base           = new raysgrid_Tables();
        $fields         = new raysgrid_Field();
        $defult_args    = $base->rsgd_defult_args();
        $cnfg           = $configs->rsgd_configs();
        
        foreach ($cnfg as $sub) {
            
            $section = isset($sub['section']) ? $sub['section'] : $defult_args['section'];

            if ($section == $section_slug) {
                $config_data = self::rsgd_config_names($sub, $defult_args);
                $this->rsgd_wrapperStart($id, $section_slug, $config_data);
                    $fields->rsgd_display_field($id, $section_slug, $config_data);
                $this->rsgd_wrapperEnd($id, $section_slug, $config_data);
                
            }
        }
        
    }
    
    public function rsgd_wrapperStart ($id, $section_slug, $config_data){
        
        extract($config_data);
        
        // dependencies.
        $cm = $dep_element = $dep_value = $em_arr = $vll = $ell = '';  
        foreach ( $dependency as $key => $value ) {
            
            $dp = $dependency['element'];
            $v = isset( $dependency['value'] ) ? $dependency['value'] : '';
            $em = isset( $dependency['not_empty'] ) ? $dependency['not_empty'] : '';
            
            if( is_array($dp) ){
                $ard = array();
                foreach ($dp as $el){
                    $ard[] .= $cm . $el;
                    $cm = ',';
                }
                $dep_element = " data-dep='".trim(implode('', $ard), ',')."'";
            }else{
                $dep_element = " data-dep='".$dp."'";
            }
            
            if( is_array($v) ){
                $ar = array();
                foreach ($v as $vl){
                    $ar[] = $cm . $vl;
                    $cm = ',';
                }
                $dep_value = " data-vl='".trim(implode('', $ar), ',')."'";
            }else{
                $dep_value = " data-vl='".$v."'";
            }
            
            if ( $em ){
                $dep_element = " data-dep='".$dp."'";
                if($em == true){
                   $dep_value = " data-vl='1'"; 
                }else{
                    $dep_value = " data-vl=''";
                }
                
            }           
        }
        
        if( $type != 'hidden' ){
            $output = '<div class="item form-group"'.$dep_element.$dep_value.'>';
                $output .= '<div class="lbl"><label class="opt-lbl">' . $title . '</label><small class="description">' . $description . '</small></div>';
                    $output .= '<div class="control-input">'; 
            echo $output;   
        }
        
    }
    
    public function rsgd_wrapperEnd ($id, $section_slug, $config_data){
        
        extract($config_data);
        
        if($type != 'hidden'){    
                $output = '</div>';
            $output .= '</div>';
            echo $output; 
        }
        
    }

    public function rsgd_config_names($sub, $defult_args) {
        
        $config_data = $config_keys = array();

        foreach ($sub as $key => $value) {
            $config_data[$key] = $value;
            $config_keys[$key] = $key;
        }
        
        foreach ($defult_args as $defult_key => $defult_value) {
            if (in_array($defult_key, $config_keys)) {}
            else {
                $config_data[$defult_key] = $defult_value;
            }
        }
        
        return $config_data;
        
    }

    public function rsgd_admin_menu() {
        
        $insDB = new raysgrid_Tables();
        add_menu_page( RSGD_NAME, RSGD_NAME, 'administrator', RSGD_PFX, array($this, 'rsgd_main_form'), RSGD_URI.'/assets/admin/images/ico.png' );
        add_submenu_page(RSGD_PFX, __('Add New Grid', RSGD_SLUG), __('Add New', RSGD_SLUG), 'manage_options', RSGD_PFX.'&do=create', array($insDB, 'rsgd_insert_update'));
        add_submenu_page(RSGD_PFX, __('Import/Export Grids', RSGD_SLUG), __('Import/Export', RSGD_SLUG), 'manage_options', RSGD_PFX.'-exp', array($insDB, 'rsgd_import_export'));
        
    }

    public function rsgd_main_form() {
        
        require_once( RSGD_DIR . '/includes/form.php' );
        $rsgd_frm      = new raysgrid_Form();
        $rsgd_new_form = $rsgd_frm->rsgd_display_form();
        
    }

    public function rsgd_portfolio_post() {

        $labels = array(
            'name' => ' Portfolio Posts',
            'singular_name' => RSGD_NAME.' Posts',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Post',
            'edit' => 'Edit',
            'edit_item' => 'Edit Post',
            'new_item' => 'New Post',
            'view' => 'View',
            'view_item' => 'View Post',
            'search_items' => 'Search Post',
            'not_found' => 'No Posts found',
            'not_found_in_trash' => 'No Post found in Trash',
            'parent' => 'Parent Post'
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'publicly_queryable' => true,
            'rewrite' => array('slug' => 'raysgridpost'),
            'capability_type' => 'post',
            'hierarchical' => false,
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail',
                'revisions',
            ),
            'exclude_from_search' => false,
        );

        register_post_type('raysgridpost', $args);
    }

    public function rsgd_create_taxs() {

        register_taxonomy('raysgrid_tags', array('raysgridpost'), array(
            'labels' => array(
                'name' => 'Tags'
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            "hierarchical" => false,
            "singular_label" => "Tag",
            'rewrite' => array('slug' => 'raysgrid_tags', 'with_front' => false)
        ));

        register_taxonomy('raysgrid_categories', array('raysgridpost'), array(
            'labels' => array(
                'name' => 'Categories'
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            "hierarchical" => true,
            "singular_label" => "Category",
            'rewrite' => array('slug' => 'raysgrid_categories', 'with_front' => false)
        ));
    }

    public function rsgd_uninstall() {
        
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS " . RSGD_TBL);
        
    }
    
    public function rsgd_register_shortcode($atts, $content = null){
        
        extract(shortcode_atts(array(
            'alias' => '',
        ), $atts));
        
        return raysgrid_Shortcode($alias);
                
    }

    public function rsgd_admin_scripts() {
        wp_enqueue_style(RSGD_PFX.'-admin-css', RSGD_URI . 'assets/admin/css/admin.css');
        wp_enqueue_style( RSGD_PFX.'-main-font', '//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,700,700i,900,900i', false );
        
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script(RSGD_PFX.'-assets-js', RSGD_URI . 'assets/admin/js/assets.js', array('jquery'), null, true);
        wp_enqueue_script(RSGD_PFX.'-script-js', RSGD_URI . 'assets/admin/js/script.js', array('jquery'), null, true);
    }

    public function rsgd_front_styles() {
        
        wp_enqueue_style( RSGD_PFX, RSGD_URI . 'assets/public/css/style.css');
        wp_enqueue_style( RSGD_PFX.'assets', RSGD_URI . 'assets/public/css/assets.css');
        wp_enqueue_script( RSGD_PFX.'_assets', RSGD_URI . 'assets/public/js/assets.js', array('jquery'), null, true );
        wp_enqueue_script( RSGD_PFX.'_script', RSGD_URI . 'assets/public/js/script.js', array('jquery'), null, true );
        
    }
    
    public function rsgd_colors( $main_color ){

        $rsgd_col   = ( $main_color != '' ) ? $main_color : '#7da600';
        $rgbacolor  = rsgd_hex2RGB($rsgd_col, true, ',');
        
        $CSS = "
        .raysgrid.gemini .portfolio-item h4 a,.filter-by.style1 li.selected a,.raysgrid.solo .portfolio-item h4 a,.raysgrid.sublime .port-captions h4 a,.raysgrid.focus .port-captions p.description a,.filter-by.style5 ul li.selected a{
            color: {$rsgd_col};
        }
        
        .portfolio-item .rsgd_main-bg,.raysgrid.slick-slider .slick-dots li.slick-active button,.raysgrid.onair .port-captions p,.filter-by.style2 ul li.selected a span,.filter-by.style3 ul li.selected a span,.filter-by.style4 ul li.selected a span,
        .raysgrid.onair .port-captions p,.raysgrid.rotato .port-captions,.raysgrid.mass .port-captions,.raysgrid.mass .icon-links a,.raysgrid.marbele .port-captions:before,.raysgrid.astro .port-captions{
            background-color: {$rsgd_col};
            color: #fff;
        }
        
        .raysgrid.mass .port-img:before,.filter-by.style1 li.selected a:before,.raysgrid.sublime .port-captions,.raysgrid.resort .portfolio-item:hover .port-container{
            border-color: {$rsgd_col};
        }
        
        .raysgrid.ivy .icon-links a:after{
            border-color: {$rsgd_col} transparent transparent transparent;
        }
        
        .raysgrid.ivy .icon-links a.rsgd_zoom:after{
            border-color: transparent transparent {$rsgd_col} transparent;
        }
        
        .raysgrid.kara .port-captions:after{
            background-color:rgba({$rgbacolor},0.75);
        }
        
        .filter-by.style2,.filter-by.style3 ul{
            border-bottom-color: {$rsgd_col};
        }";
        
        $CSS = str_replace(': ', ':', str_replace(';}', '}', str_replace('; ',';',str_replace(' }','}',str_replace(' {', '{', str_replace('{ ','{',str_replace(array("\r\n","\r","\n","\t",'  ','    ','    '),"",preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!','',$CSS))))))));
        
        //return $CSS;
        
        wp_enqueue_style (RSGD_PFX.'-custom-short', RSGD_URI . 'assets/public/css/custom-style.css', array() );
        wp_add_inline_style (RSGD_PFX.'-custom-short', $CSS);
        
    }

}
new raysgrid_Base();

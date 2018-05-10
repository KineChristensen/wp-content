<?php
/**
 * FlowerShop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FlowerShop
 * @version 1.0
 */


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function flowershop_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/flowershop
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'flowershop' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'flowershop' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'flowershop' ),
		'footer' => esc_html__( 'Footer Menu', 'flowershop' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 300,
		'height'      => 60,
		'flex-width'  => true,
	) );

	// Add theme support for custom background
	add_theme_support( 'custom-background', array(
		'default-image' => '',
		'default-preset' => 'default',
		'default-position-x' => 'left',
		'default-position-y' => 'top',
		'default-size' => 'auto',
		'default-repeat' => 'repeat',
		'default-attachment' => 'scroll',
		'default-color' => '#ffffff',
		'wp-head-callback' => 'flowershop_custom_background_cb',
		'admin-head-callback' => '',
		'admin-preview-callback' => ''
	) );

	// Add theme support for custom header
	add_theme_support( 'custom-header', array(
		'default-image' => '',
		'random-default' => false,
		'flex-height' => false,
		'flex-width' => false,
		'default-text-color' => '#696969',
		'header-text' => true,
		'uploads' => true,
		'wp-head-callback' => '',
		'admin-head-callback' => '',
		'admin-preview-callback' => '',
		'video' => false,
		'video-active-callback' => 'is_front_page',
	) );

	// Declare WooTheme support
	// https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
	add_theme_support( 'woocommerce' );

}

add_action( 'after_setup_theme', 'flowershop_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function flowershop_content_width() {

	$content_width = 1140;

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param $content_width integer
	 */
	$GLOBALS['content_width'] = apply_filters( 'flowershop_content_width', $content_width );
}
add_action( 'after_setup_theme', 'flowershop_content_width', 0 );

/**
 * Register widget area.
 *
 * @version 1.1.0
 * @since   1.0.0
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function flowershop_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Search', 'flowershop' ),
		'id'            => 'flowershop-sidebar-search',
		'description'   => __( 'Reccomended for search widgets. It will appear on the Header', 'flowershop' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title sr-only">',
		'after_title'   => '</h3>',
	) );

	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'          => __( 'Filters', 'flowershop' ),
			'id'            => 'flowershop-sidebar-filters',
			'description'   => __( 'Add widgets here to appear in Filter list on product list pages', 'flowershop' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	register_sidebar( array(
		'name'          => __( 'Footer', 'flowershop' ),
		'id'            => 'flowershop-sidebar-footer',
		'description'   => __( 'Add widgets here to appear on footer.', 'flowershop' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="widget-content">',
	) );
}

add_action( 'widgets_init', 'flowershop_widgets_init' );



// Bootstrap row-count for some widgets
function flowershop_widgets_count($params) {

	$sidebar_id = $params[0]['id'];

	/* Footer */
	if ( $sidebar_id == 'flowershop-sidebar-footer' ) {
		$total_widgets = wp_get_sidebars_widgets();
		$sidebar_widgets = count($total_widgets[$sidebar_id]);
		$params[0]['before_widget'] = str_replace('class="', 'class="col-md-' . floor(12 / $sidebar_widgets) . ' ', $params[0]['before_widget']);
	}
	return $params;
}

add_filter('dynamic_sidebar_params','flowershop_widgets_count');




/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 */
function flowershop_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'flowershop_javascript_detection', 0 );


/**
 * Enqueue scripts and styles.
 * @version 1.1.2
 * @since   1.0.1
 */
function flowershop_enqueue_scripts() {
	wp_enqueue_style( 'google-open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' );

	wp_enqueue_style( 'flowershop-theme-style', get_stylesheet_uri() );

	// Vendor: Bootstrap Script
	wp_enqueue_script( 'bootstrap-v3', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.min.js', array(), '', true );

	// Main Theme JS file
	wp_enqueue_script( 'flowershop-theme-script', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), '', true );

	// Vendor: Footer Reveal (jQuery)
	wp_enqueue_script( 'footer-reveal', get_template_directory_uri() . '/vendor/footer-reveal/footer-reveal.js', array('jquery'), '', true );

	// Vendor: Footer Reveal (jQuery)
	wp_register_script( 'swipebox-script', get_template_directory_uri() . '/vendor/swipebox/js/jquery.swipebox.min.js', array('jquery'), '', false );
	wp_register_style( 'swipebox-style', get_template_directory_uri() . '/vendor/swipebox/css/swipebox.min.css' );

	// WP: Comments script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	flowershop_inline_style();

}
add_action( 'wp_enqueue_scripts', 'flowershop_enqueue_scripts' );

/**
 * Adds inline style
 *
 * @version 1.0.7
 * @since   1.0.7
 */
function flowershop_inline_style() {
	// Header image
	$header_image = get_header_image();
	if ( $header_image ) {
		$header_image_style = 'background-image:url(' . esc_url( $header_image ) . ');';
	} else {
		$header_image_style = '';
	}
	?>

	<?php
	// Header text color
	$header_text_style = 'color:#' . get_header_textcolor();

	if ( display_header_text() ) {
		$site_branding_text = 'display:block';
	} else {
		$site_branding_text = 'display:none';
	}

	$data = "
	    #site-jumbotron{	        
	        {$header_image_style}    
	    }
	    .site-branding-text *{
	        {$header_text_style}
	    }
	    .site-branding-text{
	        {$site_branding_text}
	    }
	";

	wp_add_inline_style( 'flowershop-theme-style', $data );
}

/**
 * VENDOR: Register Custom Navigation Walker
 */
require get_template_directory() . '/vendor/wp-bootstrap-navwalker/wp_bootstrap_navwalker.php';

/**
 * VENDOR: Bootstrap Pagination
 */
require get_template_directory() . '/vendor/wp-bootstrap-pagination/wp_bootstrap_pagination.php';


/**
 * VENDOR: Breadcrumbs
 */
require get_template_directory() . '/vendor/breadcrumbs/breadcrumbs.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load WooCommerce custom functions
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Show WooCommerce requirement
if ( !class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/wc-required-notice.php';
}

/*
- Get logo
-------------------------------------------------- */
function flowershop_get_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image          = wp_get_attachment_image_src( $custom_logo_id, 'full' );
	$image_alt      = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );

	return array(
		'image_info' => $image,
		'image_url'  => esc_url( $image[0] ),
		'image_alt'  => $image_alt
	);
}

/**
 * Checks if there is a custom logo registered or a site title
 *
 * @version 1.0.4
 * @since   1.0.4
 */
function flowershop_has_logo_or_site_title() {
	$blog_info_name = get_bloginfo( 'name' );
	return has_custom_logo() || !empty( $blog_info_name );
}

/**
 * Custom background callback.
 *
 * @version 1.0.7
 * @since   1.0.1
 */
function flowershop_custom_background_cb() {
    ob_start();
	_custom_background_cb();
	$style = ob_get_clean();
	$style = str_replace( 'body.custom-background', 'body.custom-background, #site-content', $style );
	echo $style;
}

/**
 * Registers an editor stylesheet for the theme.
 *
 * @version 1.0.1
 * @since   1.0.1
 */
function flowershop_add_editor_styles() {
	add_editor_style( 'custom-editor-style.css' );
}

add_action( 'admin_init', 'flowershop_add_editor_styles' );

/*
 * Removes products count after categories name
 * @version 1.0.5
 * @since   1.0.5
 */
function flowershop_remove_category_products_count() {
	return;
}
add_filter( 'woocommerce_subcategory_count_html', 'flowershop_remove_category_products_count' );

/*
 * Replaces current category class by bootstrap class
 * @version 1.0.6
 * @since   1.0.6
 */
function flowershop_replace_cat_class_by_bootstrap( $html ) {
	return str_replace( ' current-cat', ' active', $html );
}

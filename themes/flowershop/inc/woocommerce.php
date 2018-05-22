<?php
/**
 * FlowerShop: WooCommerce functions for this theme

 * @package FlowerShop
 * @since 1.0
 **/

/*
- WooCommerce styles and scripts
-------------------------------------------------- */
// disable main woocommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Disable and add other woocommerce styles and script
add_action( 'wp_enqueue_scripts', 'flowershop_grd_woocommerce_script_cleaner', 99 );
function flowershop_grd_woocommerce_script_cleaner() {

  // Dequeue the following styles and scripts
  wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
  wp_dequeue_script( 'prettyPhoto' );
  wp_dequeue_script( 'prettyPhoto-init' );

  // Enqueue Product Lightbox gallery script (swipebox)
  // only on product pages
  if (is_product()) {
    wp_enqueue_style('flowershop-swipebox-style');
    wp_enqueue_script('flowershop-swipebox-script');
  }
}


// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

/*
* add this classes to checkout form fields
**/
add_filter('woocommerce_checkout_fields', 'flowershop_add_bootstrap_to_checkout_fields' );
function flowershop_add_bootstrap_to_checkout_fields($fields) {
  foreach ($fields as &$fieldset) {
    foreach ($fieldset as &$field) {
      $field['class'][] = 'form-group';
      $field['input_class'][] = 'form-control';
    }
  }
  return $fields;
}

/*
* Replace the image filename/path with your own :)
* https://docs.woocommerce.com/document/change-the-placeholder-image/
*
**/
add_action( 'init', 'flowershop_custom_fix_thumbnail' );

function flowershop_custom_fix_thumbnail() {
	add_filter( 'woocommerce_placeholder_img_src', 'flowershop_woocommerce_placeholder_img_src' );

	function flowershop_woocommerce_placeholder_img_src( $src ) {

		$src = get_template_directory_uri() . '/assets/img/woo-placeholder.png';

		return $src;
	}
}


/*
- Template Functions
-------------------------------------------------- */

function flowershop_woocommerce_archive_filters() {
  wc_get_template( 'loop/filters.php' );
}
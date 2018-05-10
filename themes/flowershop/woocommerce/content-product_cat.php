<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce, $woocommerce_loop;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

switch ($woocommerce_loop['columns']) {
	case '2' :
		$col_size_class = 'col-md-6';
		break;
	case '3' :
		$col_size_class = 'col-md-4';
		break;
	case '4' :
		$col_size_class = 'col-md-3';
		break;
	case '5' :
		$col_size_class = 'col-md-2';
		if ( 0 === ( $woocommerce_loop['loop'] - 0 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
			if ($woocommerce_loop['columns'] == 5 ) {
				$col_size_class .=' col-md-offset-1';
			}
		}
		break;
	case '6' :
		$col_size_class = 'col-md-2';
		break;
	default:
    $col_size_class = 'col-md-3';
}


/**
 *
 * Get active class to attach to the categories loop below
 *
 */
 if (get_query_var('product_cat') ) {
	 $current_cat = get_query_var('product_cat');
	 if ( $current_cat == $category->slug) {
	 	$current_cat = " active";
	}  else {
		$current_cat = " ";
	}
 } else {
	 $current_cat = " ";
 }


?>

<div <?php wc_product_cat_class( $col_size_class . $current_cat, $category ); ?>>
	<?php
	/**
	 * woocommerce_before_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_open - 10
	 */
	do_action( 'woocommerce_before_subcategory', $category );

	/**
	 * woocommerce_before_subcategory_title hook.
	 *
	 * @hooked woocommerce_subcategory_thumbnail - 10
	 */
	do_action( 'woocommerce_before_subcategory_title', $category );

	/**
	 * woocommerce_shop_loop_subcategory_title hook.
	 *
	 * @hooked woocommerce_template_loop_category_title - 10
	 */
	do_action( 'woocommerce_shop_loop_subcategory_title', $category );

	/**
	 * woocommerce_after_subcategory_title hook.
	 */
	do_action( 'woocommerce_after_subcategory_title', $category );

	/**
	 * woocommerce_after_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_close - 10
	 */
	do_action( 'woocommerce_after_subcategory', $category ); ?>
</div>

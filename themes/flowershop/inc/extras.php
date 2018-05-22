<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package FlowerShop
 * @since 1.0
 */


/*
- Body Classes
- Adds custom classes to the array of body classes.
-------------------------------------------------- */
function flowershop_body_classes( $classes ) {

	// Add a class when Carousel is active
	if ( is_front_page() && is_active_sidebar( 'sidebar-slider' ) ) {
		$classes[] = 'has-slider';
	}

	return $classes;
}

add_filter( 'body_class', 'flowershop_body_classes' );


/*
- Add items to Primary menu
-------------------------------------------------- */
// "cart" menu item
function flowershop_nav_replace_wpse_189788( $item_output, $item ) {

	if ( in_array( 'menu-item-cart', $item->classes ) ) {

		global $woocommerce;

		ob_start();
		?>

        <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"
           title="<?php esc_attr_e( 'View Cart', 'flowershop' ); ?>">
            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
            <span><?php esc_html_e( 'Cart', 'flowershop' ); ?></span>

            <span class="cart-badge-wrapper">
        <?php if ( $woocommerce->cart->cart_contents_count ) : ?>
            <span class="badge"><span><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span></span>
        <?php endif; ?>
      </span>

        </a>

		<?php
		return ob_get_clean();
	}

	return $item_output;
}

add_filter( 'walker_nav_menu_start_el', 'flowershop_nav_replace_wpse_189788', 10, 2 );

/**
 * Navbar toggle check if cart has items
 *
 * @version 1.1.0
 * @since   1.0.0
 * @return string|void
 */
function flowershop_navbar_toggle_check_cart_items() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	if ( WC()->cart->get_cart_contents_count() ) {
		return "has-cart-items";
	} else {
		return;
	}
}

add_filter( 'woocommerce_add_to_cart_fragments', 'flowershop_navbar_toggle_check_cart_items_fragment' );

function flowershop_navbar_toggle_check_cart_items_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>

	<?php if ( $woocommerce->cart->cart_contents_count ) : ?>
        <span class="icon-bar has-cart-items"></span>
	<?php else: ?>
        <span class="icon-bar"></span>
	<?php endif; ?>

	<?php $fragments['#nav-primary .navbar-toggle .icon-bar'] = ob_get_clean();

	return $fragments;

}


// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php).
// Used in conjunction with https://gist.github.com/DanielSantoro/1d0dc206e242239624eb71b2636ab148
add_filter( 'woocommerce_add_to_cart_fragments', 'flowershop_woocommerce_header_add_to_cart_fragment' );

function flowershop_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>

    <span class="cart-badge-wrapper">
    <?php if ( $woocommerce->cart->cart_contents_count ) : ?>
        <span class="badge"><span><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span></span>
    <?php endif; ?>
  </span>

	<?php $fragments['.cart-badge-wrapper'] = ob_get_clean();

	return $fragments;

}
<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// hide coupon field on checkout page
function flowershop_hide_coupon_field_on_checkout( $enabled ) {
	if ( is_checkout() ) {
		$enabled = false;
	}
	return $enabled;
}
add_filter( 'woocommerce_coupons_enabled', 'flowershop_hide_coupon_field_on_checkout' );


wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'flowershop' ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<div class="row">

		<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="col-sm-6" id="customer_details">

				<div class="well">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>

				<div class="well">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>

                <div class="woocommerce-additional-fields">
					<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

					<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

                        <div class="well">
                            <?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>

                                <h3><?php _e( 'Additional information', 'flowershop' ); ?></h3>

                            <?php endif; ?>

                            <div class="woocommerce-additional-fields__field-wrapper">
                                <?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
                                    <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
                                <?php endforeach; ?>
                            </div>
                        </div>

					<?php endif; ?>

					<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
                </div>

			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<?php endif; ?>

		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div id="order_review" class="woocommerce-checkout-review-order col-md-6">
			<h3 id="order_review_heading" class="heading-with-border text-center"><b><?php _e( 'Your order', 'flowershop' ); ?></b></h3>
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>

		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

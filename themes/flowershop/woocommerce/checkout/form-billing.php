<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
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
 * @version 3.0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */

?>
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<legend class="heading-with-border"><b><?php _e( 'Billing &amp; Shipping', 'flowershop' ); ?></b></legend>

	<?php else : ?>

		<legend class="heading-with-border"><b><?php _e( 'Billing Details', 'flowershop' ); ?></b></legend>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

    <div class="woocommerce-billing-fields__field-wrapper">
		<?php
		$fields = $checkout->get_checkout_fields( 'billing' );

		foreach ( $fields as $key => $field ) {
			if ( isset( $field['country_field'], $fields[ $field['country_field'] ] ) ) {
				$field['country'] = $checkout->get_value( $field['country_field'] );
			}
			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		}
		?>
    </div>

	<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>

	<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

        <?php $checkout_fields = $checkout->get_checkout_fields( 'account' ); ?>

		<?php if ( ! empty( $checkout_fields ) ) : ?>

			<div class="create-account show">
				<hr>
				<p class="text-muted"><?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'flowershop' ); ?></p>

				<?php foreach ( $checkout_fields as $key => $field ) : ?>

					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

				<?php endforeach; ?>

				<div class="clear"></div>

			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

	<?php endif; ?>
</div>

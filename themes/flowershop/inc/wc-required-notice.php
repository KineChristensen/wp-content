<?php
add_action( 'admin_notices', 'flowershop_wc_required_notice' );

/**
 * Displays a notice regarding woocommerce requirement
 *
 * @version 1.1.0
 * @since   1.0.4
 */
function flowershop_wc_required_notice() {
	$user = wp_get_current_user();
	if ( filter_var( get_user_meta( $user->ID, 'flowershop_wc_recommended_dismissed', true ), FILTER_VALIDATE_BOOLEAN ) ) {
		return;
	}
	?>
    <div class="notice notice-info is-dismissible flowershop-wc-recommended">
		<?php if ( current_user_can( 'install_plugins' ) && current_user_can( 'activate_plugins' ) ) : ?>
            <p><?php echo sprintf( __( 'Flowershop is recommended to use with <a href="%s" target="_blank">WooCommerce plugin.</a>', 'flowershop' ), 'https://wordpress.org/plugins/woocommerce/' ); ?></p>
		<?php endif; ?>
    </div>

    <script>
        jQuery(function($) {
            $( document ).on( 'click', '.flowershop-wc-recommended', function () {
                $.ajax( ajaxurl,
                    {
                        type: 'POST',
                        data: {
                            action: 'wc_recommended_dismissed_handler'
                        }
                    } );
            } );
        });
    </script>
	<?php
}

add_action( 'wp_ajax_wc_recommended_dismissed_handler', 'flowershop_wc_recommended_dismissed_handler' );

/**
 * Handles the WooCommerce plugin recommendation notice
 * @version 1.1.0
 * @since   1.0.0
 */
function flowershop_wc_recommended_dismissed_handler() {
	$user = wp_get_current_user();
	update_user_meta( $user->ID, 'flowershop_wc_recommended_dismissed', true );
}
<?php
/**
 * Sanitize.
 * @version 1.1.0
 * @since 1.0.0
 * @package flowershop
 */

/**
 * Sanitize Checkbox.
 * @param $input
 * @return int|string
 */
function flowershop_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Sanitize Number.
 * @param $input
 * @return int
 */
function flowershop_sanitize_positive_number( $input ) {
	$input = absint( $input );

	// If the input is an absolute integer, return it.
	// otherwise, return the default.
	return ( $input ? $input : $setting->default );
}

/**
 * Sanitize URL.
 * @param $input
 * @return string
 */
function flowershop_sanitize_url( $input ) {
	return esc_url_raw( $input );
}


?>
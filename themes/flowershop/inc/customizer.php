<?php
/**
 * FlowerShop: Customizer
 *
 * @package FlowerShop
 * @since 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 * @version 1.1.1
 * @since 1.0.0
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function flowershop_customize_register( $wp_customize ) {
	// Sanitization.
	require_once trailingslashit( get_template_directory() ) . '/inc/sanitize.php';

	// Load options.
	require_once trailingslashit( get_template_directory() ) . '/inc/options.php';

	// Load Upgrade to Pro control.
	require_once trailingslashit( get_template_directory() ) . '/inc/upgrade-to-pro/control.php';

	// Register custom section types.
	$wp_customize->register_section_type( 'FlowerShop_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new FlowerShop_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'FlowerShop Plus', 'flowershop' ),
				'pro_text' => esc_html__( 'Upgrade to PRO', 'flowershop' ),
				'pro_url'  => 'https://wpcodefactory.com/item/flowershop-theme-for-woocommerce/',
				'priority' => 1,
			)
		)
	);

}
add_action( 'customize_register', 'flowershop_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function flowershop_customize_preview_js() {
	wp_enqueue_script( 'flowershop_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'flowershop_customize_preview_js' );

/**
 * Enqueue style for custom customize control.
 */
function flowershop_custom_customize_enqueue() {
	wp_enqueue_script( 'flowershop-customize-controls', get_template_directory_uri() . '/inc/upgrade-to-pro/customize-control.js', array( 'customize-controls' ) );

	wp_enqueue_style( 'flowershop-customize-controls', get_template_directory_uri() . '/inc/upgrade-to-pro/customize-control.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'flowershop_custom_customize_enqueue' );

<?php
/**
 * Additional Information tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/additional-information.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$attributes = $product->get_attributes();

$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional Information', 'flowershop' ) );

//var_dump ($attributes);

// check if any attribute is visible
$is_visible = false;

foreach ( $attributes as $attribute ) :
	if ( !empty( $attribute['is_visible'] ) ) {
		$is_visible = true;
		break;
	}
endforeach;


?>

<?php if ($is_visible) : ?>
	<hr>
	<div class="additional-information">
		<?php if ( $heading ): ?>
			<h3><?php echo $heading; ?></h3>
		<?php endif; ?>
		<?php wc_display_product_attributes($product); ?>
	</div>
<?php endif; ?>


<?php
	/**
	 * woocommerce_after_additional_information hook.
	 *
	 */
	do_action( 'woocommerce_after_additional_information' );
?>

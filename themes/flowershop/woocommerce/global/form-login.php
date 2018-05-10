<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
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
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form method="post" class="login well form-horizontal woocommerce-form woocommerce-form-login login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

	<div class="form-group">
		<label for="username" class="control-label col-sm-3"><?php _e( 'Username or email', 'flowershop' ); ?> <span class="required">*</span></label>
		<div class="col-md-9">
			<input type="text" class="input-text form-control" name="username" id="username" />
		</div>
	</div>

	<div class="form-group">
		<label for="password" class="control-label col-sm-3"><?php _e( 'Password', 'flowershop' ); ?> <span class="required">*</span></label>
		<div class="col-md-9">
			<input class="input-text form-control" type="password" name="password" id="password" />
		</div>
	</div>

	<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <div class="checkbox">
        <label for="rememberme">
        	<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'flowershop' ); ?>
        </label>
      </div>
    </div>
  </div>

	<div class="form-group">
    <div class="col-md-offset-3 col-sm-9">
      <input type="submit" class="btn btn-primary" name="login" value="<?php esc_attr_e( 'Login', 'flowershop' ); ?>" />
    </div>
  </div>

	<div class="form-group">
    <div class="col-md-offset-3 col-sm-9">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'flowershop' ); ?></a>
    </div>
  </div>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<?php wp_nonce_field( 'woocommerce-login' ); ?>
	<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />


	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>

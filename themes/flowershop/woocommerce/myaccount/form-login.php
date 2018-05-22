<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<p class="lead"><?php _e( 'Welcome to your account page. Here you can manager all your orders and edit your shopping details', 'flowershop' ); ?></p>

<div class="row flex-equal-height-parent">

	<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
	<div class="col-md-6 flex-equal-height-item">
	<?php else : ?>
	<div class="col-md-12">
	<?php endif; ?>

	<form method="post" class="login well">

		<legend>
			<?php _e( 'Login', 'flowershop' ); ?>
		</legend>

		<?php do_action( 'woocommerce_login_form_start' ); ?>

			<div class="form-group form-row-wide woocommerce-form-row woocommerce-form-row--wide form-row">
				<label for="username"><?php esc_html_e( 'Username or email address', 'flowershop' ); ?> <span class="required">*</span></label>
				<input type="text" class="form-control" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
			</div>
			<div class="form-group woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password"><?php esc_html_e( 'Password', 'flowershop' ); ?> <span class="required">*</span></label>
				<input class="form-control" type="password" name="password" id="password" />
			</div>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<div class="form-group checkbox form-row-wide">
				<label for="rememberme" class="inline">
				<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'flowershop' ); ?>
			</label>
			</div>

			<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
			<div class="form-group checkbox form-row-wide">
				<input type="submit" class="btn btn-primary" name="login" value="<?php esc_attr_e( 'Login', 'flowershop' ); ?>" />
			</div>

			<p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'flowershop' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

	</div>

	<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
	<div class="col-md-6 flex-equal-height-item">

		<form method="post" class="register well">

			<legend><?php _e( 'Register', 'flowershop' ); ?></legend>

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="form-group form-row-wide woocommerce-form-row woocommerce-form-row--wide form-row">
					<label for="reg_username"><?php esc_html_e( 'Username', 'flowershop' ); ?> <span class="required">*</span></label>
					<input type="text" class="form-control woocommerce-Input woocommerce-Input--text input-tex" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
				</p>

			<?php endif; ?>

			<p class="form-group form-row-wide woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'flowershop' ); ?> <span class="required">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="woocommerce-form form-group form-row-wide woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e( 'Password', 'flowershop' ); ?> <span class="required">*</span></label>
					<input type="password" class="form-control" name="password" id="reg_password" />
				</p>

			<?php endif; ?>

			<!-- Spam Trap -->
			<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'flowershop' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

			<?php do_action( 'woocommerce_register_form' ); ?>
			<?php do_action( 'register_form' ); ?>

			<p class="woocommerce-FormRow form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<input type="submit" class="woocommerce-Button button btn btn-info" name="register" value="<?php esc_attr_e( 'Register', 'flowershop' ); ?>" />
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>
	<?php endif; ?>

</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>

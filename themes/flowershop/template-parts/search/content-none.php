<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FlowerSHop
 * @version 1.0
 */

?>

<div class="no-results not-found alert alert-warning" role="alert">

	<h2 class="page-title"><?php esc_html_e( 'Nothing Found', 'flowershop' ); ?></h2>

	<div class="page-content">

		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'flowershop' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'flowershop' ); ?></p>
			<?php
				//get_search_form();

		endif; ?>

</div><!-- .no-results -->

<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FlowerShop
 * @version 1.0
 */

?>

	</section><!-- #site-content -->

	<footer id="site-footer" class="footer-reveal">

		<div class="container">

			<?php if (is_active_sidebar('flowershop-sidebar-footer')) : ?>
			 <div id="footer-widgets-area">
				 <div class="row">
					 <?php dynamic_sidebar('Footer'); ?>
				 </div>
				</div>

			 <hr>
			<?php endif; ?>

            <p id="site-copyright" class="pull-left">
				<?php echo esc_html( '&#169;' ); ?><?php echo esc_html( date( 'Y' ) ); ?><?php esc_html( get_bloginfo( 'name' ) ); ?>
            </p>

			<?php wp_nav_menu( array(
				'theme_location' => 'footer',
				'container' => false,
				'menu_class' => 'footer-menu list-inline',
				'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
			)); ?>

		</div>

	 </footer>

	 <?php wp_footer(); ?>

</body>
</html>

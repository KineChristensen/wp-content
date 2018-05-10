<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FlowerShop
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<a class="skip-link sr-only" href="#site-content"><?php esc_html_e( 'Skip to content', 'flowershop' ); ?></a>

<header id="site-header" class="">

    <nav id="nav-primary" class="navbar navbar-default navbar-fixed-top">

        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'flowershop' ); ?></span>
                    <span class="icon-bar <?php esc_html( flowershop_navbar_toggle_check_cart_items() ); ?>"></span>
                    <span class="icon-bar <?php esc_html( flowershop_navbar_toggle_check_cart_items() ); ?>"></span>
                    <span class="icon-bar <?php esc_html( flowershop_navbar_toggle_check_cart_items() ); ?>"></span>
                    <span class="glyphicon glyphicon-remove hidden text-danger" aria-hidden="true"></span>
                </button>
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="<?php esc_attr_e( 'home', 'flowershop' ); ?>">
					<?php if ( has_custom_logo() ) : ?>
						<?php $flowershop_logo = flowershop_get_logo(); ?>
						<?php $flowershop_logo_url = $flowershop_logo['image_url']; ?>
                        <img src='<?php echo esc_url( $flowershop_logo_url ); ?>' alt='<?php echo esc_attr( $flowershop_logo['image_alt'] ); ?>'>
					<?php else: ?>
                        <div class="site-title" style="margin:0">
							<?php echo esc_html( get_bloginfo( 'name', 'display' ) ); ?>
                        </div>
					<?php endif; ?>
                </a>
            </div>

            <div id="navbar" class="collapse navbar-collapse">

				<?php if ( is_active_sidebar( 'flowershop-sidebar-search' ) ) : ?>
                    <div id="site-search" class="navbar-form navbar-right">
						<?php dynamic_sidebar( 'flowershop-sidebar-search' ); ?>
                    </div>
				<?php endif; ?>

				<?php wp_nav_menu( array(
					'theme_location' => 'primary',
					'depth'          => 2,
					'container'      => false,
					'menu_class'     => 'nav navbar-nav navbar-right',
					'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
					'walker'         => new wp_bootstrap_navwalker()
				) );
				?>

            </div><!--#navbar -->

        </div><!--.container -->

    </nav>

</header>

<div id="site-overlay" class=""></div>

<?php
// Header image
$header_image = get_header_image();
if ( $header_image ) {
	$header_image_style = 'background-image:url(' . esc_url( $header_image ) . ');';
} else {
	$header_image_style = '';
}
?>

<?php
// Header text color
if ( display_header_text() ) {
	$style = ' style="color:#' . get_header_textcolor() . ';"';
} else {
	$style = ' style="display:none;"';
}
?>


	            <?php if ( display_header_text() == true ) { ?>
                    <div class="site-branding-text">
                        <div class="container">
                            <h2 class="site-name"><?php bloginfo( 'name' ); ?></h2>
                            <span class="site-description"> - <?php bloginfo( 'description' ); ?></span>
                        </div>
                    </div>
	            <?php } ?>


<section id="site-content">

	<?php if ( is_home() || is_front_page() ) : ?>
        <div id="site-jumbotron" class="jumbotron text-center">

        <header class="entry-header text-center">
            <div class="container">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
            </div>
        </header>

        </div><!-- #site-jumbotron -->
	<?php endif; ?>

	<?php if (is_front_page() ) : ?>
	<?php if (is_active_sidebar('sidebar-slider')) : ?>
        <div id="site-slider" class="">
			<?php dynamic_sidebar('sidebar-slider'); ?>
        </div>
	<?php endif; ?>
<?php endif; ?>
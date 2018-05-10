<?php
/**
 * Template Name: FrontPage
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package flowershop
 * @version 1.1.0
 * @since 1.0.0
 */
	get_header();
?>
<div id="primary" class="content-area">

	<main id="main" class="site-main">

		<div class="container">
			<?php
				$latest_product = get_theme_mod( 'flowershop_latest_product_disable', '1' );
				if( $latest_product == '1' ) :
					$latest_product_title = get_theme_mod( 'flowershop_latest_product_title', __('Latest Products','flowershop') );
					$latest_product_number = get_theme_mod( 'flowershop_latest_product_number', 4 );
					$latest_product_column = get_theme_mod( 'flowershop_latest_product_column', 4 );
			?>

				<h2 class="heading-with-border text-center"><b><?php echo esc_html($latest_product_title); ?></b></h2>
				<?php echo do_shortcode('[recent_products per_page="'.$latest_product_number.'" columns="'.$latest_product_column.'"]'); ?>
			<?php
				endif;
			?>
			<?php
				$top_rated_product = get_theme_mod( 'flowershop_top_rated_product_disable', '1' );
				if( $top_rated_product == '1' ) :
					$top_rated_product_title = get_theme_mod( 'flowershop_top_rated_product_title', __('Top Rated Products','flowershop') );
					$top_rated_product_number = get_theme_mod( 'flowershop_top_rated_product_number', 4 );
					$top_rated_product_column = get_theme_mod( 'flowershop_top_rated_product_column', 4 );
			?>
				<h2 class="heading-with-border text-center"><b><?php echo esc_html($top_rated_product_title); ?></b></h2>
				<?php echo do_shortcode('[top_rated_products per_page="'.$top_rated_product_number.'" columns="'.$top_rated_product_column.'"]'); ?>
			<?php
				endif;
			?>
			<?php
				$on_sales_product = get_theme_mod( 'flowershop_on_sales_product_disable', '1' );
				if( $on_sales_product == '1' ) :
					$on_sales_product_title = get_theme_mod( 'flowershop_on_sales_product_title', __('On Sales Products','flowershop') );
					$on_sales_product_number = get_theme_mod( 'flowershop_on_sales_product_number', 4 );
					$on_sales_product_column = get_theme_mod( 'flowershop_on_sales_product_column', 4 );
			?>
				<h2 class="heading-with-border text-center"><b><?php echo esc_html( $on_sales_product_title); ?></b></h2>
				<?php echo do_shortcode('[sale_products per_page="'.$on_sales_product_number.'" columns="'.$on_sales_product_column.'"]'); ?>
			<?php
				endif;
			?>
		</div>
			<?php
				$product_hightlight = get_theme_mod('flowershop_product_highlight_disable', '1');
				if( $product_hightlight == '1' ) :
					$highlight_title = get_theme_mod( 'flowershop_product_highlight_title', '' );
					$highlight_button_name = get_theme_mod( 'flowershop_product_highlight_button_name', __('View Product','flowershop') );
					$highlight_button_link = get_theme_mod( 'flowershop_product_highlight_button_link', '' );
					$highlight_background_image = get_theme_mod( 'flowershop_product_highlight_background_image_link', '' );
			?>
				<div class="site-parallax parallax" style="background-image: url('<?php echo esc_attr( $highlight_background_image ); ?>'); background-position: center !important;">
					<div class="container">
						<div class="site-parallax-inner">
							<h2><?php echo esc_html( $highlight_title ); ?></h2>
							<a class="btn btn-lg btn-default" href="<?php echo esc_url( $highlight_button_link ); ?>"><?php echo esc_html( $highlight_button_name ); ?></a>
						</div>
					</div>
				</div>
			<?php
				endif;
			?>
		<div class="container">
			<?php
				$product_category = get_theme_mod( 'flowershop_product_category_disable', '1' );
				if( $product_category == '1' ) :
					$product_category_title = get_theme_mod( 'flowershop_product_category_title', __('Browse By Categories','flowershop') );
					$product_category_subtitle = get_theme_mod( 'flowershop_product_category_subtitle', '' );
					$product_category_number = get_theme_mod( 'flowershop_product_category_number', 6 );
					$product_category_column = get_theme_mod( 'flowershop_product_category_column', 6 );
			?>
				<h2 class="heading-with-border text-center"><b><?php echo esc_html( $product_category_title); ?></b></h2>
				<p class="lead text-center"><?php echo esc_html( $product_category_subtitle); ?></p>
				<?php echo do_shortcode('[product_categories per_page="'.$product_category_number.'" columns="'.$product_category_column.'"]'); ?>
			<?php
				endif;
			?>
		</div>

	</main>
</div>
<?php
	get_footer();
?>
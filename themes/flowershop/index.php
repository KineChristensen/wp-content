<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FlowerShop
 * @version 1.0
 */


get_header(); ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main">

		<div class="container">

			<ul class="nav nav-tabs nav-sta site-narrow wp-list-categories">

				<?php
				 add_filter( 'wp_list_categories', 'flowershop_replace_cat_class_by_bootstrap' );

				 // check if is current for all posts link below
				 if ( get_permalink ( get_option( 'page_for_posts' )) == home_url(add_query_arg(array(),$wp->request).'/' ) ) {
					 $post_links_active = "active";
				 } else {
					 $post_links_active = " ";
				 }

				 ?>
				<li class="<?php echo esc_html($post_links_active); ?>"><a href="<?php echo esc_url(get_permalink ( get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'All Posts', 'flowershop' ); ?></a></li>


				<?php

					wp_list_categories (
						$defaults = array(
							'depth'               => 1,
							'hide_empty'          => 1,
							'hide_title_if_empty' => false,
							'hierarchical'        => true,
							'order'               => 'ASC',
							'orderby'             => 'name',
							'separator'           => '',
							'show_count'          => 0,
							'show_option_all'     => '',
							'show_option_none'    => __( 'No categories','flowershop' ),
							'style'               => 'list',
							'taxonomy'            => 'category',
							'title_li'            => '',
							'use_desc_for_title'  => 1,
							)
						) ;

			 		?>

			</ul>

			<?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/post/content-archive', get_post_format() );

				endwhile;

				the_posts_navigation();
				//wp_bootstrap_pagination();

			else :

				get_template_part( 'template-parts/post/content', 'none' );

			endif; ?>

		</div><!--.container-->

	</main><!-- #main -->

</div><!-- #primary -->

<?php
get_footer();

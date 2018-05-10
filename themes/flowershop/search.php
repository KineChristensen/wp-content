<?php
/**
 * Template Name: Search Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package flowershop
 */


get_header();
?>


<section id="primary" class="content-area">

	<main id="main" class="site-main" role="main">

		<header class="entry-header text-center">
			<div class="container">
				<h1 class="page-title">
					<?php printf( esc_html__( 'Search Results for: %s', 'flowershop' ), '<span>' . get_search_query() . '</span>' ); ?>
				</h1>
			</div>
		</header><!-- .page-header -->


		<div class="container">

			<div class="well">
				<h2><?php esc_html_e( 'Search again', 'flowershop' ); ?></h2>
				<?php get_search_form(); ?>
			</div>

			<?php
			if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

	  			get_template_part( 'template-parts/search/content', 'search' );

	  		endwhile; // End of the loop.

				//the_posts_navigation();
				wp_bootstrap_pagination();

			else :

				get_template_part( 'template-parts/search/content', 'none' );

			endif; ?>

		</div><!-- .container -->

	</main><!-- #main -->

</section><!-- #primary -->



<?php
//get_sidebar( 'right');
get_footer();

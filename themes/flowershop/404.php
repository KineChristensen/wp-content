<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package flowershop
 */

get_header();
?>

<div id="primary" class="content-area">

  <main id="main" class="site-main" role="main">

		<div class="error-404 not-found">

      <header class="entry-header text-center">
        <div class="container">
				  <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'flowershop' ); ?></h1>
        </div>
			</header><!-- .page-header -->

			<div class="page-content container">
				<p class="alert alert-warning" role="alert">
          <?php esc_html_e( 'It looks like nothing was found at this location. Please start from homepage or search through our Search Form above', 'flowershop' ); ?>
        </p>
        <p><a class="btn btn-warning" role="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( '&laquo; Go back to homepage', 'flowershop' ); ?></a></p>
			</div><!-- .page-content -->


		</div><!-- .error-404 -->

	</main><!-- #main -->

</div><!-- #primary -->

<?php
get_footer();

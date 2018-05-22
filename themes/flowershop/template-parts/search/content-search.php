<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FlowerSHop
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<?php if ( 'post' === get_post_type() ) : ?>
	<div class="entry-meta">
		<?php flowershop_posted_on(); ?>
	</div><!-- .entry-meta -->
	<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
	<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php flowershop_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

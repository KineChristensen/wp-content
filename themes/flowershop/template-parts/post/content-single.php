<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package flowershop
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-single site-narrow'); ?>>

	<header>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php flowershop_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php	if ( has_post_thumbnail() ) : ?>
			<p><?php the_post_thumbnail('large', array( 'class' => 'img-responsive thumbnail' )); ?> </p>
		<?php endif; ?>

		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'flowershop' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text sr-only">"', '"</span>', false )
			) );
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'flowershop' ),
                'after'  => '</div>',
            ) );

		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php flowershop_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package flowershop
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('site-narrow content-archive'); ?>>

	<header>
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );	?>
		<div class="entry-meta">
			<?php flowershop_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php	if ( has_post_thumbnail() ) : ?>
			<span class="pull-left">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="wp-post-thumbnail thumbnail">
	 				<?php the_post_thumbnail('thumbnail', array( 'class' => 'img-responsive' )); ?>
				</a>
			</span>
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

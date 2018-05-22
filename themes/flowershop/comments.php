<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * -----  www.OfficialTheme.com -----
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

?>

<hr class="site-sep">

<div id="comments" class="comments-area site-narrow">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>

		<h2 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One comment on &ldquo;%s&rdquo;', 'comments title', 'flowershop' ), get_the_title() );
			} else {
				printf(
				/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Comment on &ldquo;%2$s&rdquo;',
						'%1$s Comments to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'flowershop'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h2>

		<ol class="comment-list list-unstyled">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text sr-only"><?php esc_html_e( 'Comment navigation', 'flowershop' ); ?></h2>
			<ul class="nav-links pager">
				<li class="nav-previous previous"><?php previous_comments_link( esc_html__( '&laquo; Older Comments', 'flowershop' ) ); ?></li>
				<li class="nav-next next"><?php next_comments_link( esc_html__( 'Newer Comments &raquo;', 'flowershop' ) ); ?></li>
			</ul><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'flowershop' ); ?></p>
	<?php
	endif;



	// Comemnt for with Bootstrap support
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields =  array(
	  'author' =>
	    '<div class="form-group comment-form-author"><label for="author">' . __( 'Name', 'flowershop' ) . '</label> ' .
	    ( $req ? '<span class="required">*</span>' : '' ) .
	    '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
	    '" size="30"' . $aria_req . ' /></div>',

	  'email' =>
	    '<div class="form-group comment-form-email"><label for="email">' . __( 'Email', 'flowershop' ) . '</label> ' .
	    ( $req ? '<span class="required">*</span>' : '' ) .
	    '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
	    '" size="30"' . $aria_req . ' /></div>',

	  'url' =>
	    '<div class="form-group comment-form-url"><label for="url">' . __( 'Website', 'flowershop' ) . '</label>' .
	    '<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
	    '" size="30" /></div>',
	);


	$comments_args = array(
		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
		'class_submit'      => 'btn btn-primary',
	    'comment_field' => '<div class="form-group"><label for="comment">' . _x( 'Comment', 'noun','flowershop' ) . '</label><textarea id="comment" name="comment" class="form-control" aria-required="true" rows="5"></textarea></div>',
	);

	comment_form($comments_args);

	?>

</div><!-- #comments -->

<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Bin_Bill
 * @since 1.0
 * @version 1.0
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

<div id="comments" class="comments-area">
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( 'One Comment' );
			} else {
				printf( $comments_number.' Comments');
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'avatar_size' => 100,
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => binbill_get_svg( array( 'icon' => 'mail-reply' ) ) . __( 'Reply', 'binbill' ),
				) );
			?>
		</ol>

		<?php the_comments_pagination( array(
			'prev_text' => binbill_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous', 'binbill' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'binbill' ) . '</span>' . binbill_get_svg( array( 'icon' => 'arrow-right' ) ),
		) );

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'binbill' ); ?></p>
	<?php
	endif;
	$fields = array(
		'email'=>'',
		'author' =>
		  '<p class="comment-form-author"><label for="author">' . __( 'Name', 'domainreference' ) . '</label> ' .
		  ( $req ? '<span class="required">*</span>' : '' ) .
		  '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		  '" size="30"' . $aria_req . ' /></p>'
	  );
	$argc = array(
		'label_submit'      => __( 'Submit' ),
		'comment_notes_before'  => '<p class="comment-notes"></p>',
		'comment_field' 		=>  '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
		'fields' 				=> apply_filters( 'comment_form_default_fields', $fields )
	);
	comment_form($argc);
	?>

</div><!-- #comments -->

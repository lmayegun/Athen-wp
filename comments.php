 <?php
/**
 * File Description : The template for displaying Comments.
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @version     1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependant : comments-callback.php.
 */

// Return if password is required
if ( post_password_required() ) {
	return;
}

// Add classes to the comments main wrapper
$comments_wrap_classes = ' comments-area clr';

if ( ! comments_open() && get_comments_number() < 1 ) {
	$comments_wrap_classes .= ' empty-closed-comments';
	return;
}

if ( 'full-screen' == Athen_Post_Layout::athen_get_post_layout() ) {
	$comments_wrap_classes .= ' container';
} ?>

<div id="comments" class="<?php echo $comments_wrap_classes; ?>">

	<?php if ( have_comments() ) : ?>

		<?php
		// Get comments title
		$comments_number = number_format_i18n( get_comments_number() );
		if ( '1' == $comments_number ) {
			$comments_title = __( 'This Post Has One Comment', 'athen_transl' );
		} else {
			$comments_title = sprintf( __( 'This Post Has %s Comments', 'athen_transl' ), $comments_number );
		}
		$comments_title = apply_filters( 'athen_comments_title', $comments_title );

		// Display comments heading
		athen_heading( array(
			'content'		=> $comments_title,
			'tag'			=> 'h2',
			'classes'		=> array( 'comments-title' ) ,
			'apply_filters'	=> 'comments',
		) ); ?>

		<ol class="commentlist">
			<?php
			// List comments
			wp_list_comments( array(
				'callback'	=> 'athen_comment',
				'style'		=> 'ol'
			) ); ?>
		</ol><!-- .comment-list -->

		<?php
		// Display comment navigation
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

			<nav class="navigation comment-navigation row clr" role="navigation">
				<h4 class="assistive-text section-heading heading"><span><?php _e( 'Comment navigation', 'athen_transl' ); ?></span></h4>
				<div class="nav-previous span_12 col col-1"><?php previous_comments_link( __( '&larr; Older Comments', 'athen_transl' ) ); ?></div>
				<div class="nav-next span_12 col"><?php next_comments_link( __( 'Newer Comments &rarr;', 'athen_transl' ) ); ?></div>
			</nav>

		<?php endif; ?>

		<?php
		// Display comments closed message
		if ( ! comments_open() && get_comments_number() ) : ?>

			<p class="no-comments"><i class="icon-remove-circle"></i><?php _e( 'Comments are closed.' , 'athen_transl' ); ?></p>

		<?php endif; ?>

	<?php endif; ?>

	<?php
	// The comment form
	comment_form( array(
		'cancel_reply_link'	=> '<i class="fa fa-times"></i>'. __ ( 'Cancel comment reply', 'athen_transl' ),
	) ); ?>

</div><!-- #comments -->
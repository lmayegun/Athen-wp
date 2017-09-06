<?php
/**
 *
 * File Description : Template for comment display and pingbacks
 * 
 * @package     Athen
 * @subpackage  Closer - View/Controller
 * @since       Closer 1.0.0
 * @version     1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 */

if ( ! function_exists( 'athen_comment' ) ) {
	function athen_comment( $comment, $args, $depth ) {
        //print_r($comment);
        //print_r($args);
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
            
    <div class="comment-author vcard">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    </div>
            
            
    <?php if ( $comment->comment_approved == '0' ) : ?>
         <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
          <br />
    <?php endif; ?>

    <div class="comment-meta commentmetadata">
        <?php printf( __( '<h4 class="author-name">%s</h4>' ), get_comment_author_link() ); ?>
        <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
            <?php
                /* translators: 1: date, 2: time */
                printf( __('<h4 class="date-time">%1$s at %2$s</h4>'),get_comment_date(),  get_comment_time() ); 
            ?>
        </a>
        <?php edit_comment_link( __( '<h4 class="edit-comment-link">(Edit)</h4>' ), '  ', '' );
        ?>
    </div>
          
    <div class="comment-text">
        <?php comment_text(); ?>
    </div>
          
    <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
	}
}
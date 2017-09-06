<?php
/**
 * Blog entry avatar
 *
 * @package		Total
 * @subpackage	Partials/Blog
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<?php if ( athen_post_entry_author_avatar_enabled( get_the_ID() ) ) : ?>
	<div class="blog-entry-author-avatar">
		<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo __( 'Visit Author Page', 'athen_transl' ); ?>">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'athen_blog_entry_author_avatar_size', 74 ) ) ?>
		</a>
	</div><!-- .blog-entry-author-avatar -->
<?php endif; ?>
<?php
/**
 * Blog single post audio format media
 *
 * @package		Total
 * @subpackage	Partials/Blog/Media
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get post audio
$audio = athen_get_post_audio_html();

// Show featured image for password-protected post or if audio isn't defined
if ( post_password_required() || ! $audio ) {
    get_template_part( 'partials/blog/media/blog-single', 'thumbnail' );
    return;
} ?>

<div id="post-media" class="clr">
	<div class="blog-post-audio clr">
		<?php echo $audio; ?>
	</div><!-- .blog-post-audio -->
</div><!-- #post-media -->
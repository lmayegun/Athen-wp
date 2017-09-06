<?php
/**
 * Blog entry video format media
 *
 * @package     Total
 * @subpackage  Partials/Blog/Media
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.6.0
 * @version     2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get post video
$video = athen_get_post_video_html();

// Show featured image for password-protected post or if video isn't defined
if ( post_password_required() || ! $video ) {
    get_template_part( 'partials/blog/media/blog-entry', 'thumbnail' );
    return;
} ?>

<div class="blog-entry-media clr">
    <div class="blog-entry-video">
        <?php echo $video; ?>
    </div><!-- .blog-entry-video -->
</div><!-- .blog-entry-media -->
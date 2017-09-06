<?php
/**
 * Blog entry audio format media
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

// Get post video
$music = athen_get_post_audio_html();

// Return if there isn't a thumbnail
if ( ! $music ) {
    return;
} ?>

<div class="blog-entry-media clr">
	<a href="<?php athen_permalink(); ?>" title="<?php athen_esc_title(); ?>" rel="bookmark" class="blog-entry-img-link<?php athen_entry_image_animation_classes(); ?>">
		<?php //echo $music; ?>
		<div class="blog-entry-audio"><?php echo $music; ?></div>
	</a><!-- .blog-entry-media-link -->
</div><!-- .blog-entry-media -->
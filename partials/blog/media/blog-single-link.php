<?php
/**
 * Blog single post link format media
 * Link formats should redirect to the URL defined in the custom fields
 * This template file is used as a fallback only.
 *
 * @package		Total
 * @subpackage	Partials/Blog/Media
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get thumbnail
$thumbnail = athen_get_blog_post_thumbnail();

// Return if there isn't a thumbnail
if ( ! $thumbnail ) {
    return;
} ?>

<div id="post-media" class="clr">
	<?php
	// Image with lightbox link
	if ( athen_get_mod( 'blog_post_image_lightbox' ) ) : ?>

		<a href="<?php athen_permalink(); ?>" title="<?php athen_esc_title(); ?>" class="wpex-lightbox<?php athen_img_animation_classes(); ?>" data-type="iframe" data-options="width:1920,height:1080">
			<?php echo $thumbnail; ?>
		</a>

	<?php
	// No lightbox
	else : ?>

		<a href="<?php athen_permalink(); ?>" title="<?php athen_esc_title(); ?>" class="<?php athen_img_animation_classes(); ?>"><?php echo $thumbnail; ?></a>

	<?php endif; ?>

	<?php
	// Blog entry caption
	if ( athen_get_mod( 'blog_thumbnail_caption' ) && $caption = athen_featured_image_caption() ) : ?>
		<div class="post-media-caption clr">
			<?php echo $caption; ?>
		</div><!-- .post-media-caption -->
	<?php endif; ?>

</div><!-- #post-media -->
<?php
/**
 * Blog single post related entry
 *
 * @package		Total
 * @subpackage	Partials/Blog
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		2.0.0
 * @version		2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Disable embeds
$show_embeds = apply_filters( 'athen_related_blog_posts_embeds', false );

// Check if experts are enabled
$has_excerpt = athen_get_mod( 'blog_related_excerpt', true );

// Get post format
$format = get_post_format();

// Get featured image
$thumbnail = athen_get_post_thumbnail( array(
	'size' => 'blog_related',
) );

// Add classes
$classes	= array( 'related-post', 'clr', 'nr-col' );
$classes[]	= athen_grid_class( 4 );
$classes[]	= 'col-'. $athen_count; ?>

<article <?php post_class( $classes ); ?>>

	<?php
	// Display post video
	if ( $show_embeds && 'video' == $format && $video = athen_get_post_video_html() ) : ?>

		<div class="related-post-video">
			<?php echo $video; ?>
		</div><!-- .related-post-video -->

	<?php
	// Display post audio
	elseif ( $show_embeds && 'audio' == $format && $audio = athen_get_post_audio_html() ) : ?>

		<div class="related-post-video">
			<?php echo $audio; ?>
		</div><!-- .related-post-audio -->

	<?php
	// Display post thumbnail
	elseif ( $thumbnail ) : ?>

		<a href="<?php the_permalink(); ?>" title="<?php athen_esc_title(); ?>" rel="bookmark" class="related-post-thumb<?php athen_entry_image_animation_classes(); ?>">
			<?php echo $thumbnail; ?>
		</a><!-- .related-post-thumb -->

	<?php endif; ?>

	<?php
	// Display post excerpt
	if ( $has_excerpt ) : ?>

		<div class="related-post-content equal-height-content clr">

			<h4 class="related-post-title">
				<a href="<?php athen_permalink(); ?>" title="<?php athen_esc_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h4><!-- .related-post-title -->

			<div class="related-post-excerpt clr">

				<?php athen_excerpt( array(
					'length' => athen_get_mod( 'blog_related_excerpt_length', '15' ),
				) ); ?>

			</div><!-- related-post-excerpt -->

		</div><!-- .related-post-content -->

	<?php endif; ?>

</article><!-- .related-post -->
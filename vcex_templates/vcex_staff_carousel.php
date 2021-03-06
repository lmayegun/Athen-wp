<?php
/**
 * Output for the Staff Carousel Visual Composer module
 *
 * @package     Total
 * @subpackage  vcex_templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Not needed in admin ever
if ( is_admin() ) {
	return;
}

// Get shortcode atts
$atts = shortcode_atts( array(
	'unique_id'                     => '',
	'visibility'                    => '',
	'css_animation'                 => '',
	'post_type'                     => 'staff',
	'classes'                       => '',
	'style'                         => 'default',
	'term_slug'                     => '',
	'include_categories'            => '',
	'exclude_categories'            => '',
	'count'                         => '8',
	'center'                        => 'false',
	'timeout_duration'              => '5000',
	'items'                         => '4',
	'items_margin'                  => '15',
	'infinite_loop'                 => 'true',
	'items_scroll'                  => '1',
	'auto_play'                     => 'false',
	'arrows'                        => 'true',
	'dots'                          => 'false',
	'order'                         => 'DESC',
	'orderby'                       => 'date',
	'tax_query'                     => '',
	'orderby_meta_key'              => '',
	'thumbnail_link'                => 'post',
	'img_size'                      => 'athen_custom',
	'img_crop'                      => 'center-center',
	'img_width'                     => '',
	'img_height'                    => '',
	'title'                         => '',
	'excerpt'                       => '',
	'excerpt_length'                => '30',
	'social'                        => '',
	'taxonomy'                      => '',
	'terms'                         => '',
	'img_hover_style'               => '',
	'img_rendering'                 => '',
	'overlay_style'                 => '',
	'content_background'            => '',
	'content_heading_line_height'   => '',
	'content_heading_margin'        => '',
	'content_heading_weight'        => '',
	'content_heading_transform'     => '',
	'content_margin'                => '',
	'content_font_size'             => '',
	'content_padding'               => '',
	'content_border'                => '',
	'content_color'                 => '',
	'content_opacity'               => '',
	'content_heading_color'         => '',
	'content_heading_size'          => '',
	'content_alignment'             => '',
	'tablet_items'                  => '3',
	'mobile_landscape_items'        => '2',
	'mobile_portrait_items'         => '1',
), $atts );

// Extract shortcode atts
extract( $atts );

// Fallback for term slug
if ( $term_slug ) {
	$include_categories = $term_slug;
}

// Build the WordPress query
$my_query = vcex_build_wp_query( $atts );

//Output posts
if ( $my_query->have_posts() ) :

	// Sanitize Data
	$center         = ( $center ) ? $center : 'false';
	$infinite_loop  = ( $infinite_loop ) ? $infinite_loop : 'true';
	$auto_play      = ( $auto_play ) ? $auto_play : 'false';
	$arrows         = ( $arrows ) ? $arrows : 'true';

	// Load scripts
	$inline_js = array( 'carousel' );
	if ( 'lightbox' == $thumbnail_link ) {
		$inline_js[] = 'ilightbox';
		vcex_enque_style( 'ilightbox' );
	}
	vcex_inline_js( $inline_js );

	// Prevent auto play in visual composer
	if ( vc_is_inline() ) {
		$auto_play = 'false';
	}

	// Item Margin
	if ( 'no-margins' == $style ) {
		$items_margin = '0';
	}

	// Items to scroll fallback for old setting
	if ( 'page' == $items_scroll ) {
		$items_scroll = $items;
	}

	// Main Classes
	$wrap_classes = array( 'wpex-carousel', 'wpex-carousel-staff', 'clr', 'owl-carousel' );
	if ( $style ) {
		$wrap_classes[] = $style;
	}
	if ( $visibility ) {
		$wrap_classes[] = $visibility;
	}
	if ( $css_animation ) {
		$wrap_classes[] = $this->getCSSAnimation( $css_animation );
	}
	if ( $classes ) {
		$wrap_classes[] = $this->getExtraClass( $classes );
	}
	$wrap_classes = implode( ' ', $wrap_classes );

	// Entry media classes
	$media_classes = array( 'wpex-carousel-entry-media', 'clr' );
	if ( $img_hover_style ) {
		$media_classes[] = athen_image_hover_classes( $img_hover_style );
	}
	if ( $img_rendering ) {
		$media_classes[] = athen_image_rendering_class( $img_rendering );
	}
	if ( $overlay_style ) {
		$media_classes[] = athen_overlay_classes( $overlay_style );
	}
	$media_classes = implode( ' ', $media_classes );

	// Content Design
	$content_style = vcex_inline_style( array(
		'background'    => $content_background,
		'padding'       => $content_padding,
		'margin'        => $content_margin,
		'border'        => $content_border,
		'font_size'     => $content_font_size,
		'color'         => $content_color,
		'opacity'       => $content_opacity,
		'text_align'    => $content_alignment,

	) );

	// Title design
	if ( 'false' != $title ) {

		$heading_style = vcex_inline_style( array(
			'margin'            => $content_heading_margin,
			'text_transform'    => $content_heading_transform,
			'font_weight'       => $content_heading_weight,
			'font_size'         => $content_heading_size,
			'line_height'       => $content_heading_line_height,
		) );

		$heading_link_style = vcex_inline_style( array(
			'color' => $content_heading_color,
		) );

	} ?>

	<div class="<?php echo $wrap_classes; ?>"<?php vcex_unique_id( $unique_id ); ?> data-items="<?php echo $items; ?>" data-slideby="<?php echo $items_scroll; ?>" data-nav="<?php echo $arrows; ?>" data-dots="<?php echo $dots; ?>" data-autoplay="<?php echo $auto_play; ?>" data-loop="<?php echo $infinite_loop; ?>" data-autoplay-timeout="<?php echo $timeout_duration ?>" data-center="<?php echo $center; ?>" data-margin="<?php echo intval( $items_margin ); ?>" data-items-tablet="<?php echo $tablet_items; ?>" data-items-mobile-landscape="<?php echo $mobile_landscape_items; ?>" data-items-mobile-portrait="<?php echo $mobile_portrait_items; ?>">

		<?php
		// Loop through posts
		while ( $my_query->have_posts() ) :

			// Get post from query
			$my_query->the_post();

			// Create new post object
			$post = new stdClass();
		
			// Post VARS
			$post->id           = get_the_ID();
			$post->permalink    = athen_get_permalink( $post->id ); ?>

			<?php
			// Generate image
			$thumbnail = athen_get_post_thumbnail( array(
				'size'      => $img_size,
				'crop'      => $img_crop,
				'width'     => $img_width,
				'height'    => $img_height,
				'alt'       => athen_get_esc_title(),
			) ); ?>

			<div class="wpex-carousel-slide">

				<?php
				// Media Wrap
				if ( has_post_thumbnail() ) : ?>

					<div class="<?php echo $media_classes; ?>">
						<?php
						// No links
						if ( in_array( $thumbnail_link, array( 'none', 'nowhere' ) ) ) { ?>
							
							<?php echo $thumbnail; ?>

						<?php }
						// Lightbox
						elseif ( 'lightbox' == $thumbnail_link ) { ?>
							<a href="<?php athen_lightbox_image(); ?>" title="<?php athen_esc_title(); ?>" class="wpex-carousel-entry-img wpex-lightbox">
								<?php echo $thumbnail; ?>
						<?php }
						// Link to post
						else { ?>
							<a href="<?php echo $post->permalink; ?>" title="<?php athen_esc_title(); ?>" class="wpex-carousel-entry-img">
								<?php echo $thumbnail; ?>
						<?php } ?>
						<?php
						// Overlay & close link
						if ( in_array( $thumbnail_link, array( 'none', 'nowhere' ) ) ) {
							// Inner Overlay
							if ( $overlay_style ) {
								athen_overlay( 'inside_link', $overlay_style );
							}
							// Close link
							echo '</a><!-- .wpex-carousel-entry-img -->';
							// Outside Overlay
							if ( $overlay_style ) {
								athen_overlay( 'outside_link', $overlay_style );
							}
						} ?>
					</div><!-- .wpex-carousel-entry-media -->

				<?php endif; ?>

				<?php
				// Title
				if ( 'false' != $title || 'false' != $excerpt || 'true' == $social ) : ?>

					<div class="wpex-carousel-entry-details clr"<?php echo $content_style; ?>>

						<?php
						// Title
						if ( 'false' != $title ) : ?>

							<div class="wpex-carousel-entry-title entry-title"<?php echo $heading_style; ?>>
								<a href="<?php echo $post->permalink; ?>" title="<?php athen_esc_title(); ?>"<?php echo $heading_link_style; ?>><?php the_title(); ?></a>
							</div><!-- .wpex-carousel-entry-title -->

						<?php endif; ?>

						<?php
						// Check if the excerpt is enabled
						if ( 'false' != $excerpt ) : ?>

							<?php
							// Generate excerpt
							$post->excerpt = athen_get_excerpt( array (
								'length' => intval( $excerpt_length ),
							) );

							// Display excerpt if there is one
							if ( $post->excerpt ) : ?>

								<div class="wpex-carousel-entry-excerpt clr">
									<?php echo $post->excerpt; ?>
								</div><!-- .wpex-carousel-entry-excerpt -->

							<?php endif; ?>

						<?php endif; ?>

						<?php
						// Check if social is enabled
						if ( 'true' == $social ) : ?>

							<?php
							// Display social links
							echo athen_get_staff_social( get_the_ID() ); ?>

						<?php endif; ?>

					</div><!-- .wpex-carousel-entry-details -->

				<?php endif; ?>

			</div><!-- .wpex-carousel-slide -->

		<?php endwhile; ?>

	</div><!-- .wpex-carousel -->

	<?php
	// Remove post object from memory
	$post = null;

	// Reset the post data to prevent conflicts with WP globals
	wp_reset_postdata(); ?>

<?php
// If no posts are found display message
else : ?>

	<?php
	// Display no posts found error if function exists
	echo vcex_no_posts_found_message( $atts ); ?>

<?php
// End post check
endif; ?>
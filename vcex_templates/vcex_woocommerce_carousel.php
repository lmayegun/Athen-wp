<?php
/**
 * Output for the bullets Visual Composer module
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

// Extract shortcode attributes
$atts = shortcode_atts( array(
	'unique_id'                     => '',
	'css_animation'                 => '',
	'visibility'                    => '',
	'entry_output'                  => '',
	'classes'                       => '',
	'post_type'                     => 'product',
	'tax_query'                     => '',
	'style'                         => 'default',
	'featured_products_only'        => '',
	'term_slug'                     => '',
	'include_categories'            => '',
	'exclude_categories'            => '',
	'exclude_products_out_of_stock' => '',
	'count'                         => '8',
	'center'                        => 'false',
	'timeout_duration'              => '5000',
	'arrows'                        => 'true',
	'dots'                          => 'false',
	'items'                         => '4',
	'items_margin'                  => '15',
	'infinite_loop'                 => 'true',
	'items_scroll'                  => '1',
	'auto_play'                     => 'false',
	'arrows'                        => 'true',
	'order'                         => 'DESC',
	'orderby'                       => 'date',
	'orderby_meta_key'              => '',
	'thumbnail_link'                => '',
	'img_size'                      => 'athen_custom',
	'img_crop'                      => '',
	'img_width'                     => '',
	'img_height'                    => '',
	'title'                         => 'true',
	'price'                         => 'true',
	'taxonomy'                      => '',
	'terms'                         => '',
	'img_filter'                    => '',
	'img_hover_style'               => '',
	'img_rendering'                 => '',
	'overlay_style'                 => '',
	'content_background'            => '',
	'content_heading_margin'        => '',
	'content_heading_line_height'   => '',
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
if ( $term_slug && empty( $include_categories ) ) {
	$include_categories = $term_slug;
}

// Build the WordPress query
$my_query = vcex_build_wp_query( $atts );

// Output posts
if ( $my_query->have_posts() ) :

	// Sanitize Data
	$center         = ( $center ) ? $center : 'false';
	$infinite_loop  = ( $infinite_loop ) ? $infinite_loop : 'true';
	$auto_play      = ( $auto_play ) ? $auto_play : 'false';
	$arrows         = ( $arrows ) ? $arrows : 'true';

	// Disable auto play if there is only 1 post
	if ( '1' == count( $my_query->posts ) ) {
		$auto_play = false;
	}

	// Output js for front-end editor
	vcex_inline_js( 'carousel' );

	// Load lightbox skin
	if ( 'lightbox' == $thumbnail_link ) {
		vcex_enque_style( 'ilightbox' );
	}

	// Prevent auto play in visual composer
	if ( athen_is_front_end_composer() ) {
		$auto_play = 'false';
	}

	// Overlay Style
	if ( empty( $overlay_style ) ) {
		$overlay_style = 'none';
	} else {
		$overlay_style = $overlay_style;
	}

	// Item Margin
	if ( 'no-margins' == $style ) {
		$items_margin = '0';
	}

	// Items to scroll fallback for old setting
	if ( 'page' == $items_scroll ) {
		$items_scroll = $items;
	}

	// Wrap Classes
	$wrap_classes = array( 'wpex-carousel', 'wpex-carousel-woocommerce', 'owl-carousel', 'clr' );
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
	if ( $entry_output == 'woocommerce' ) {
		$wrap_classes[] = 'products';
	}
	$wrap_classes = implode( ' ', $wrap_classes );

	// Entry media classes
	$media_classes = array( 'wpex-carousel-entry-media', 'clr' );
	if ( $img_filter ) {
		$media_classes[] = athen_image_filter_class( $img_filter );
	}
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
		'opacity'       => $content_opacity,
		'text_align'    => $content_alignment,
		'color'         => $content_color,
		'font_size'     => $content_font_size,
	) );

	// Title design
	if ( $title ) {
		$heading_style = vcex_inline_style( array(
			'margin'            => $content_heading_margin,
			'font_size'         => $content_heading_size,
			'font_weight'       => $content_heading_weight,
			'text_transform'    => $content_heading_transform,
			'line_height'       => $content_heading_line_height,
			'color'             => $content_heading_color,
		) );
		$heading_link_style = vcex_inline_style( array(
			'color' => $content_heading_color,
		) );
	} ?>

	<?php
	// Open WooCommerce wrap
	if ( $entry_output == 'woocommerce' ) : ?>
		<div class="woocommerce clr">
	<?php endif; ?>

	<ul class="<?php echo $wrap_classes; ?>"<?php vcex_unique_id( $unique_id ); ?> data-items="<?php echo $items; ?>" data-slideby="<?php echo $items_scroll; ?>" data-nav="<?php echo $arrows; ?>" data-dots="<?php echo $dots; ?>" data-autoplay="<?php echo $auto_play; ?>" data-loop="<?php echo $infinite_loop; ?>" data-autoplay-timeout="<?php echo $timeout_duration ?>" data-center="<?php echo $center; ?>" data-margin="<?php echo intval( $items_margin ); ?>" data-items-tablet="<?php echo $tablet_items; ?>" data-items-mobile-landscape="<?php echo $mobile_landscape_items; ?>" data-items-mobile-portrait="<?php echo $mobile_portrait_items; ?>">

		<?php
		// Loop through posts
		while ( $my_query->have_posts() ) :

			// Get post from query
			$my_query->the_post();

			// Create new post object.
			$post = new stdClass();

			// Get post data
			$get_post = get_post(); ?>

			<div class="wpex-carousel-slide">

				<?php
				// Display standard woo style posts
				if ( $entry_output == 'woocommerce' ) : ?>

					<?php
					// Get woocommerce template part
					woocommerce_get_template_part( 'content', 'product' ); ?>

				<?php
				// Custom output (default)
				else : ?>

					<?php
					// Post VARS
					$post->ID           = $get_post->ID;
					$post->title        = $get_post->post_title;
					$post->permalink    = athen_get_permalink( $post->ID );

					// Generate thumbnail
					$post->thumbnail = athen_get_post_thumbnail( array(
						'size'      => $img_size,
						'crop'      => $img_crop,
						'width'     => $img_width,
						'height'    => $img_height,
						'alt'       => athen_get_esc_title(),
					) ); ?>

					<?php
					// Media Wrap
					if ( has_post_thumbnail() ) : ?>

						<div class="<?php echo $media_classes; ?>">
							<?php
							// No links
							if ( 'none' == $thumbnail_link) : ?>

								<?php echo $post->thumbnail; ?>

							<?php
							// Lightbox
							elseif ( 'lightbox' == $thumbnail_link ) : ?>

								<a href="<?php athen_lightbox_image(); ?>" title="<?php athen_esc_title(); ?>" class="wpex-carousel-entry-img wpex-lightbox">

									<?php echo $post->thumbnail; ?>

							<?php
							// Link to post
							else : ?>

								<a href="<?php echo $post->permalink; ?>" title="<?php athen_esc_title(); ?>" class="wpex-carousel-entry-img">
									
									<?php echo $post->thumbnail; ?>

							<?php endif; ?>

							<?php
							// Overlay & close link
							if ( ! in_array( $thumbnail_link, array( 'none', 'nowhere' ) ) ) : ?>

								<?php
								// Inner Overlay
								if ( $overlay_style ) : ?>

									<?php athen_overlay( 'inside_link', $overlay_style ); ?>

								<?php endif; ?>

								<?php
								// Close link
								echo '</a><!-- .wpex-carousel-entry-img -->'; ?>

								<?php
								// Outside Overlay
								if ( $overlay_style ) : ?>

									<?php athen_overlay( 'outside_link', $overlay_style ); ?>

								<?php endif ?>

							<?php endif; ?>

						</div><!-- .wpex-carousel-entry-media -->

					<?php endif; // Thumbnail check ?>

					<?php
					// Title
					if ( 'true' == $title || 'true' == $price ) : ?>

						<div class="wpex-carousel-entry-details clr"<?php echo $content_style; ?>>

							<?php
							// Title
							if ( 'true' == $title && $post->title ) : ?>

								<div class="wpex-carousel-entry-title entry-title"<?php echo $heading_style; ?>>
									<a href="<?php echo $post->permalink; ?>" title="<?php athen_esc_title(); ?>"<?php echo $heading_link_style; ?>><?php echo $post->title; ?></a>
								</div><!-- .wpex-carousel-entry-title -->

							<?php endif; ?>

							<?php
							// Excerpt
							if ( 'true' == $price && $get_price = athen_get_woo_product_price() ) : ?>
								
								<div class="wpex-carousel-entry-price">
									<?php echo $get_price; ?>
								</div><!-- .wpex-carousel-entry-price -->

							<?php endif; ?>

						</div><!-- .wpex-carousel-entry-details -->

					<?php endif; ?>

				<?php endif; ?>

			</div><!-- .wpex-carousel-slide -->

		<?php endwhile; ?>

	</ul><!-- .wpex-carousel -->

	<?php
	// Close WooCommerce wrap
	if ( $entry_output == 'woocommerce' ) echo '</div>'; ?>

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
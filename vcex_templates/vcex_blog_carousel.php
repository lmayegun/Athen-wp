<?php
/**
 * Output for the blog carousel Visual Composer module
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
	'unique_id'                   => '',
	'classes'                     => '',
	'visibility'                  => '',
	'css_animation'               => '',
	'style'                       => '',
	'post_type'                   => 'post',
	'tax_query'                   => '',
	'ignore_sticky_posts'         => '',
	'term_slug'                   => '',
	'include_categories'          => '',
	'exclude_categories'          => '',
	'count'                       => '8',
	'center'                      => 'false',
	'timeout_duration'            => '5000',
	'items'                       => '4',
	'items_margin'                => '15',
	'infinite_loop'               => 'true',
	'items_scroll'                => '1',
	'auto_play'                   => 'false',
	'arrows'                      => 'true',
	'dots'                        => 'false',
	'order'                       => 'DESC',
	'orderby'                     => 'date',
	'orderby_meta_key'            => '',
	'media'                       => '',
	'thumbnail_link'              => '',
	'img_size'                    => '',
	'img_width'                   => '',
	'img_height'                  => '',
	'img_crop'                    => 'center-center',
	'title'                       => '',
	'date'                        => '',
	'date_color'                  => '',
	'date_font_size'              => '',
	'excerpt'                     => '',
	'excerpt_length'              => '30',
	'custom_excerpt_trim'         => '',
	'filter_content'              => 'false',
	'offset'                      => 0,
	'taxonomy'                    => '',
	'terms'                       => '',
	'img_hover_style'             => '',
	'img_rendering'               => '',
	'overlay_style'               => '',
	'content_background'          => '',
	'content_heading_margin'      => '',
	'content_heading_weight'      => '',
	'content_heading_transform'   => '',
	'content_margin'              => '',
	'content_font_size'           => '',
	'content_padding'             => '',
	'content_border'              => '',
	'content_color'               => '',
	'content_opacity'             => '',
	'content_heading_color'       => '',
	'content_heading_size'        => '',
	'content_heading_line_height' => '',
	'content_alignment'           => '',
	'tablet_items'                => '3',
	'mobile_landscape_items'      => '2',
	'mobile_portrait_items'       => '1',
), $atts );

// Extract shortcode atts
extract( $atts );

// Fallback for term slug
if ( $term_slug && empty( $include_categories ) ) {
	$include_categories = $term_slug;
}

// Build the WordPress query
$my_query = vcex_build_wp_query( $atts );

//Output posts
if ( $my_query->have_posts() ) :

	// Inline JS for front-end composer
	vcex_inline_js( array( 'carousel', 'ilightbox' ) );

	// Sanitize & declare variables
	$overlay_style  = empty( $overlay_style ) ? '/none' : $overlay_style;
	$items_margin   = ( 'no-margins' == $style ) ? '0' : $items_margin;
	$items_scroll   = ( 'page' == $items_scroll ) ? $items : $items_scroll;
	$excerpt        = ( 'false' == $excerpt ) ? false : true;
	$title          = ( 'false' == $title ) ? false : true;
	$date           = ( 'false' == $date ) ? false : true;
	$center         = ( $center ) ? $center : 'false';
	$infinite_loop  = ( $infinite_loop ) ? $infinite_loop : 'true';
	$auto_play      = ( $auto_play ) ? $auto_play : 'false';
	$arrows         = ( $arrows ) ? $arrows : 'true';

	// Prevent auto play in visual composer
	if ( vc_is_inline() ) {
		$auto_play = 'false';
	}

	// Main Classes
	$wrap_classes = array( 'athen-blog-carousel', 'vcex-blog-carousel-wrap', 'owl-carousel', 'clr' );
	if ( $style ) {
		$wrap_classes[] = $style;
	}
	if ( $css_animation ) {
		$wrap_classes[] = $this->getCSSAnimation( $css_animation );
	}
	if ( $classes ) {
		$wrap_classes[] = $this->getExtraClass( $classes );
	}
	if ( $visibility ) {
		$wrap_classes[] = $visibility;
	}
	$wrap_classes = implode( ' ', $wrap_classes );

	// Link Classes
	$thumbnail_link_classes = 'wpex-carousel-entry-img';
	if ( 'lightbox' == $thumbnail_link ) {
		$thumbnail_link_classes .= ' wpex-lightbox';
		vcex_enque_style( 'ilightbox' ); // Load lightbox stylesheet
	}

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
		'opacity'       => $content_opacity,
		'text_align'    => $content_alignment,
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
	}

	// Date design
	if ( $date ) {
		$date_style = vcex_inline_style( array(
			'color'     => $date_color,
			'font_size' => $date_font_size,
		) );
	}

	// Excerpt style
	if ( $excerpt ) {
		$excerpt_styling = vcex_inline_style( array(
			'color'     => $content_color,
			'font_size' => $content_font_size,
		) );
	} ?>

	<div class="<?php echo $wrap_classes; ?>" data-items="<?php echo $items; ?>" data-slideby="<?php echo $items_scroll; ?>" data-nav="<?php echo $arrows; ?>" data-dots="<?php echo $dots; ?>" data-autoplay="<?php echo $auto_play; ?>" data-loop="<?php echo $infinite_loop; ?>" data-autoplay-timeout="<?php echo $timeout_duration ?>" data-center="<?php echo $center; ?>" data-margin="<?php echo intval( $items_margin ); ?>" data-items-tablet="<?php echo $tablet_items; ?>" data-items-mobile-landscape="<?php echo $mobile_landscape_items; ?>" data-items-mobile-portrait="<?php echo $mobile_portrait_items; ?>"<?php vcex_unique_id( $unique_id ); ?>>
		<?php
		// Start loop
		while ( $my_query->have_posts() ) :

			// Get post from query
			$my_query->the_post();

			// Create new post object.
			$post = new stdClass();

			// Get post data
			$get_post = get_post();
		
			// Post VARS
			$post->ID               = $get_post->ID;
			$post->permalink        = athen_get_permalink( $post->ID );
			$post->title            = get_the_title();
			$post->title_attribute  = esc_attr( the_title_attribute( 'echo=0' ) );
			$post->thumbnail        = get_post_thumbnail_id( $post->ID );
			$post->thumbnail_url    = wp_get_attachment_url( $post->thumbnail );
			$post->thumbnail_link   = ( 'lightbox' == $thumbnail_link ) ? $post->thumbnail_url : $post->permalink; ?>

			<div class="wpex-carousel-slide">
			
				<?php
				// Display thumbnail if enabled and defined
				if ( 'false' != $media && has_post_thumbnail() ) : ?>

					<div class="<?php echo $media_classes; ?>">

						<?php
						// If thumbnail link doesn't equal none
						if ( 'none' != $thumbnail_link) : ?>

							<a href="<?php echo $post->thumbnail_link; ?>" title="<?php echo $post->title_attribute; ?>" class="<?php echo $thumbnail_link_classes; ?>">

						<?php endif; ?>

						<?php
						// Display post thumbnail
						athen_post_thumbnail( array(
							'width'     => $img_width,
							'height'    => $img_height,
							'size'      => $img_size,
							'crop'      => $img_crop,
							'alt'       => $post->title_attribute,
						) ); ?>

						<?php
						// Inner link overlay html
						athen_overlay( 'inside_link', $overlay_style ); ?>

						<?php if ( 'none' != $thumbnail_link ) echo '</a>'; ?>

						<?php
						// Outer link overlay HTML
						athen_overlay( 'outside_link', $overlay_style ); ?>

					</div><!-- .wpex-carousel-entry-media -->

				<?php endif; ?>

				<?php
				// Open details element if the title or excerpt are true
				if ( $title || $excerpt ) : ?>

					<div class="wpex-carousel-entry-details clr"<?php echo $content_style; ?>>

						<?php
						// Display title if $title is true and there is a post title
						if ( $title && $post->title ) : ?>
							<div class="wpex-carousel-entry-title entry-title"<?php echo $heading_style; ?>>
								<a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title_attribute; ?>"<?php echo $heading_link_style; ?>><?php echo $post->title; ?></a>
							</div>
						<?php endif; ?>

						<?php
						// Display publish date if $date is enabled
						if ( $date ) : ?>
							<div class="vcex-blog-entry-date"<?php echo $date_style; ?>><?php echo get_the_date(); ?></div>
						<?php endif; ?>

						<?php
						// Display excerpt if $excerpt is true
						if ( $excerpt ) : ?>

							<div class="wpex-carousel-entry-excerpt clr"<?php echo $excerpt_styling; ?>>
								<?php vcex_excerpt( $excerpt_length ); ?>
							</div><!-- .wpex-carousel-entry-excerpt -->
							
						<?php endif ?>

					</div><!-- .wpex-carousel-entry-details -->

				<?php endif; ?>

			</div><!-- .wpex-carousel-slide -->

		<?php
		// End entry loop
		endwhile; ?>

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
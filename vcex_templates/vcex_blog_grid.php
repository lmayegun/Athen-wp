<?php
/**
 * Output for the blog grid Visual Composer module
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
	'classes'                       => '',
	'visibility'                    => '',
	'css_animation'                 => '',
	'term_slug'                     => '',
	'include_categories'            => '',
	'exclude_categories'            => '',
	'post_type'                     => 'post',
	'ignore_sticky_posts'           => '',
	'tax_query'                     => '',
	'posts_per_page'                => '4',
	'grid_style'                    => '',
	'columns'                       => '3',
	'columns_gap'                   => '',
	'columns_responsive'            => '',
	'order'                         => 'DESC',
	'orderby'                       => 'date',
	'orderby_meta_key'              => '',
	'filter'                        => '',
	'filter_taxonomy'               => 'category',
	'masonry_layout_mode'           => 'masonry',
	'filter_speed'                  => '0.4',
	'center_filter'                 => '',
	'thumbnail_link'                => 'post',
	'entry_media'                   => 'true',
	'img_size'                      => '',
	'img_width'                     => '',
	'img_height'                    => '',
	'img_crop'                      => 'center-center',
	'thumb_link'                    => '',
	'img_rendering'                 => '',
	'img_hover_style'               => '',
	'overlay_style'                 => 'none',
	'img_filter'                    => '',
	'title'                         => '',
	'date'                          => '',
	'date_font_size'                => '',
	'date_color'                    => '',
	'excerpt'                       => '',
	'excerpt_length'                => '15',
	'read_more'                     => '',
	'readmore_style'                => '',
	'readmore_background'           => '',
	'readmore_style_color'          => '',
	'readmore_color'                => '',
	'readmore_hover_color'          => '',
	'readmore_hover_background'     => '',
	'readmore_size'                 => '',
	'readmore_padding'              => '',
	'readmore_margin'               => '',
	'readmore_border_radius'        => '',
	'read_more_text'                => '',
	'readmore_rarr'                 => '',
	'pagination'                    => '',
	'filter_content'                => '',
	'offset'                        => '',
	'taxonomy'                      => '',
	'terms'                         => '',
	'all_text'                      => '',
	'featured_video'                => 'true',
	'url_target'                    => '',
	'content_heading_margin'        => '',
	'content_heading_transform'     => '',
	'content_background'            => '',
	'content_margin'                => '',
	'content_font_size'             => '',
	'content_heading_weight'        => '',
	'content_heading_line_height'   => '',
	'content_padding'               => '',
	'content_border'                => '',
	'content_color'                 => '',
	'content_opacity'               => '',
	'content_heading_color'         => '',
	'content_heading_size'          => '',
	'content_alignment'             => '',
	'equal_heights_grid'            => '',
	'single_column_style'           => '',
	'thumb_lightbox_caption'        => '',
	'css_editor'                    => '',
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

	// Sanitize & declare variables
	$inline_js          = array( 'ilightbox' );
	$is_isotope         = false;
	$title              = ( 'false' == $title ) ? false : true;
	$excerpt            = ( 'false' == $excerpt ) ? false : true;
	$read_more          = ( 'false' == $read_more ) ? false : true;
	$read_more_text     = $read_more_text ? $read_more_text : __( 'read more', 'athen_transl' );
	$filter             = ( 'true' == $filter ) ? true : false;
	$css_animation      = $css_animation ? $this->getCSSAnimation( $css_animation ) : '';
	$css_animation      = ( $filter ) ? false : $css_animation;
	$equal_heights_grid = ( 'true' == $equal_heights_grid ) ? true : false;
	$equal_heights_grid = ( $equal_heights_grid && $columns > '1' ) ? true : false;
	$overlay_style      = empty( $overlay_style ) ? 'none' : $overlay_style;
	$url_target         = vcex_html( 'target_attr', $url_target );
	$center_filter      = ( 'yes' == $center_filter ) ? ' center' : '';
	$all_text           = $all_text ? $all_text : __( 'All', 'athen_transl' );
	$entry_media        = ( 'false' == $entry_media ) ? false : true;
	$date               = ( 'false' == $date ) ? false : true;

	// Enable Isotope?
	if ( $filter || 'masonry' == $grid_style ) {
		$is_isotope         = true;
		$equal_heights_grid = false;
	}

	// No need for masonry if not enough columns and filter is disabled
	if ( 'true' != $filter && 'masonry' == $grid_style ) {
		$post_count = count( $my_query->posts );
		if ( $post_count <= $columns ) {
			$is_isotope = false;
		}
	}

	// Content style
	$content_style = vcex_inline_style( array(
		'background'    => $content_background,
		'padding'       => $content_padding,
		'margin'        => $content_margin,
		'color'         => $content_color,
		'opacity'       => $content_opacity,
		'text_align'    => $content_alignment,
		'border'        => $content_border,
	) );

	// Heading style
	if ( $title ) {

		$heading_style = vcex_inline_style( array(
			'margin'            => $content_heading_margin,
			'color'             => $content_heading_color,
			'font_size'         => $content_heading_size,
			'font_weight'       => $content_heading_weight,
			'line_height'       => $content_heading_line_height,
			'text_transform'    => $content_heading_transform,
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
		$excerpt_style = vcex_inline_style( array(
			'font_size' => $content_font_size,
		) );
	}

	// Readmore design and classes
	if ( $read_more ) {
	
		// Readmore classes
		$readmore_classes   = array( 'vcex-button animate-on-hover' );
		if ( $readmore_hover_color || $readmore_hover_background ) {
			$readmore_classes[] = 'wpex-data-hover';
		}
		if ( $readmore_style ) {
			$readmore_classes[] = $readmore_style;
		}
		if ( $readmore_style_color ) {
			$readmore_classes[] = $readmore_style_color;
		}
		$readmore_classes = implode( ' ', $readmore_classes );

		// Readmore style
		$readmore_style = vcex_inline_style( array(
			'background'    => $readmore_background,
			'color'         => $readmore_color,
			'font_size'     => $readmore_size,
			'padding'       => $readmore_padding,
			'border_radius' => $readmore_border_radius,
			'margin'        => $readmore_margin,
		) );

		// Readmore data
		$readmore_data = array();
		if ( $readmore_hover_color ) {
			$readmore_data[] = 'data-hover-color="'. $readmore_hover_color .'"';
		}
		if ( $readmore_hover_background ) {
			$readmore_data[] = 'data-hover-background="'. $readmore_hover_background .'"';
		}
		$readmore_data = ' '. implode( ' ', $readmore_data );

	}

	// Wrap classes
	$wrap_classes = array( 'vcex-blog-grid-wrap', 'clr' );
	if ( $visibility ) {
		$wrap_classes[] = $visibility;
	}
	if ( $classes ) {
		$wrap_classes[] = vcex_get_extra_class( $classes );
	}
    if ( $css_animation ) {
        $wrap_classes[] = $this->getCSSAnimation( $css_animation );
    }
    
	$wrap_classes = implode( ' ', $wrap_classes );

	// Grid classes
	$grid_classes = array( 'wpex-row', 'vcex-blog-grid', 'clr' );
	if ( $columns_gap ) {
		$grid_classes[] = 'gap-'. $columns_gap;
	}
	if ( $is_isotope ) {
		$grid_classes[] = 'vcex-isotope-grid';
	}
	if ( 'left_thumbs' == $single_column_style ) {
		$grid_classes[] = 'left-thumbs';
	}
	if ( $equal_heights_grid ) {
		$grid_classes[] = 'match-height-grid';
	}
	$grid_classes = implode( ' ', $grid_classes );

	// Media classes
	$media_classes = array( 'vcex-blog-entry-media' );
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

	// Load inline JS for front-end composer
	if ( $is_isotope ) {
		$inline_js[] = 'isotope';
	}
	if ( $readmore_hover_color || $readmore_hover_background ) {
		$inline_js[] = 'data_hover';
	}
	if ( $equal_heights_grid ) {
		$inline_js[] = 'equal_heights';
	}
	vcex_inline_js( $inline_js ); ?>


	<div class="<?php echo $wrap_classes; ?>">

		<?php
		// Display filter links
		if ( $filter ) : ?>

			<?php
			// Define filter args
			$args = vcex_grid_filter_args( $atts );

			// Get terms for the filter
			$terms = get_terms( 'category', $args ); ?>

			<?php
			// Loop through terms
			if ( $terms && count( $terms ) > '1' ) : ?>
			
				<ul class="vcex-blog-filter vcex-filter-links<?php echo $center_filter; ?> clr">
					<li class="active"><a href="#" data-filter="*"><span><?php echo $all_text; ?></span></a></li>
					<?php foreach ( $terms as $term ) : ?>
						<li class="filter-cat-<?php echo $term->term_id; ?>"><a href="#" data-filter=".cat-<?php echo $term->term_id; ?>"><?php echo $term->name; ?></a></li>
					<?php endforeach; ?>
				</ul><!-- .vcex-blog-filter -->

			<?php endif; ?>

		<?php endif; ?>

		<div class="<?php echo esc_attr( $grid_classes ); ?>" data-layout-mode="<?php echo esc_attr( $masonry_layout_mode ); ?>" data-transition-duration="<?php echo esc_attr( $filter_speed ); ?>"<?php vcex_unique_id( $unique_id ); ?>>

			<?php
			// Define counter var to clear floats
			$count = '';

			// Start loop
			while ( $my_query->have_posts() ) :

				// Get post from query
				$my_query->the_post();

				// Create new post object.
				$post = new stdClass();

				// Get post data
				$get_post = get_post();

				// Post Data
				$post->ID           = $get_post->ID;
				$post->title        = $get_post->post_title;
				$post->permalink    = athen_get_permalink( $post->ID );
				$post->format       = get_post_format( $post->ID );
				$post->excerpt      = '';

				// Post Excerpt
				if ( $excerpt || 'true' == $thumb_lightbox_caption ) {
					$post->excerpt = athen_get_excerpt( array (
						'length' => intval( $excerpt_length ),
					) );
				}

				// Counter
				$count++;

				// Get video
				if ( 'video' == $post->format ) {
					$post->video        = athen_get_post_video( $post->ID );
					$post->video_oembed = athen_get_post_video_html( $post->video );
				}

				// Entry Classes
				$entry_classes      = array( 'vcex-blog-entry' );
				$entry_classes[]    = 'athen-col-'. $columns;
				$entry_classes[]    = 'col-'. $count;
				if ( 'false' == $columns_responsive ) {
					$entry_classes[] = 'nr-col';
				} else {
					$entry_classes[] = 'col';
				}
				if ( $is_isotope ) {
					$entry_classes[] = 'vcex-isotope-entry';
				}
				if ( $css_animation ) {
					$entry_classes[] = $css_animation;
				}
				// Create a list of terms to add as classes to the entry
				if ( $post_terms = get_the_terms( $post, 'category' ) ) {
					foreach ( $post_terms as $post_term ) {
						$entry_classes[] = 'cat-'. $post_term->term_id;
					}
				}
				if ( ! $entry_media ) {
					$entry_classes[] = 'vcex-blog-no-media-entry';
				} ?>

				<div <?php post_class( $entry_classes ); ?>>

					<?php
					// If media is enabled
					if ( $entry_media ) : ?>

						<?php
						// Display post video if defined and is video format
						if ( 'true' == $featured_video && ! empty( $post->video ) && $post->video_oembed ) : ?>

							<div class="vcex-blog-entry-media">
								<?php echo $post->video_oembed; ?>
							</div><!-- .vcex-blog-entry-media -->

						<?php
						// Otherwise if post thumbnail is defined
						elseif ( has_post_thumbnail( $post->ID ) ) : ?>

							<div class="<?php echo esc_attr( $media_classes ); ?>">

								<?php
								// Open link tag if thumblink does not equal nowhere
								if ( 'nowhere' != $thumb_link ) : ?>

									<?php
									// Lightbox Links
									if ( $thumb_link == 'lightbox' ) : ?>

										<?php
										// Load lightbox stylesheet;
										vcex_enque_style( 'ilightbox' ); ?>

										<?php
										// Video lightbox link
										if ( 'video' == $post->format ) : ?>

											<?php
											// Try and convert video URL into embed URL
											$embed_url = athen_sanitize_data( $post->video, 'embed_url' );
											$video_url = $embed_url ? $embed_url : $post->video;

											// Data options
											$data_options =  'width:1920,height:1080';

											// Add smart recognition if we can't generate an embed_url
											if ( ! $embed_url ) {
												$data_options .=',smartRecognition:true';
											} ?>

											<a href="<?php echo $video_url; ?>" title="<?php athen_esc_title(); ?>" class="wpex-lightbox" data-type="iframe" data-options="<?php echo $data_options; ?>">

										<?php
										// Image lightbox link
										else : ?>

											<a href="<?php athen_lightbox_image(); ?>" title="<?php athen_esc_title(); ?>" class="wpex-lightbox">

										<?php endif; ?>

									<?php else : ?>

										 <a href="<?php echo $post->permalink; ?>" title="<?php athen_esc_title(); ?>"<?php echo $url_target; ?>>

									<?php endif; ?>

								<?php endif; ?>

									<?php
									// Display featured image
									athen_post_thumbnail( array(
										'size'      => $img_size,
										'width'     => $img_width,
										'height'    => $img_height,
										'alt'       => athen_get_esc_title(),
										'crop'      => $img_crop,
										'class'     => 'vcex-blog-entry-img',
									) ); ?>

									<?php
									// Inner link overlay HTML
									athen_overlay( 'inside_link', $overlay_style ); ?>

								<?php
								// Close link tag
								if ( 'nowhere' != $thumb_link ) echo '</a>'; ?>

								<?php
								// Outer link overlay HTML
								athen_overlay( 'outside_link', $overlay_style ); ?>

							</div><!-- .blog-entry-media -->

						<?php endif; // Video/thumbnail checks ?>

					<?php endif; // Display media check ?>

					<?php
					// Open entry details div if the $title, $excerpt or $read_more vars are true
					if ( $title || $excerpt || $read_more ) : ?>

						<div class="vcex-blog-entry-details clr" <?php echo $content_style; ?>>

							<?php
							// Open equal heights div if equal heights is enabled
							if ( $equal_heights_grid ) echo '<div class="match-height-content">'; ?>

							<?php
							// Display title if $title is true
							if ( $title ) : ?>
								<h2 class="vcex-blog-entry-title entry-title"<?php echo $heading_style; ?>><a href="<?php echo $post->permalink; ?>" title="<?php athen_esc_title(); ?>"<?php echo $url_target; ?><?php echo $heading_link_style; ?>><?php echo $post->title; ?></a></h2>
							<?php endif; ?>

							<?php
							// Display date if $date is true
							if ( $date ) : ?>
								<div class="vcex-blog-entry-date"<?php echo $date_style; ?>><?php echo get_the_date(); ?></div>
							<?php endif; ?>

							<?php
							// Display excerpt
							if ( $excerpt ) : ?>

								<div class="vcex-blog-entry-excerpt entry clr"<?php echo $excerpt_style; ?>>

									<?php
									// Display excerpt
									if ( $excerpt && $post->excerpt ) : ?>

										<?php echo $post->excerpt; ?>

									<?php endif; ?>

								</div><!-- .vcex-blog-entry-excerpt -->

							<?php endif; ?>

							<?php
							// Display read more button if $read_more is true and $read_more_text isn't empty
							if ( $read_more && $read_more_text ) : ?>

								<div class="vcex-blog-entry-readmore-wrap clr">

									<a href="<?php echo $post->permalink; ?>" title="<?php echo esc_attr( $read_more_text ); ?>" rel="bookmark" class="<?php echo $readmore_classes; ?>"<?php echo $url_target; ?><?php echo $readmore_style; ?><?php echo $readmore_data; ?>>
										<?php echo $read_more_text; ?>
										<?php
										// Display readmore button rarr if enabled
										if ( 'true' == $readmore_rarr ) : ?>
											<span class="vcex-readmore-rarr"><?php echo athen_element( 'rarr' ); ?></span>
										<?php endif; ?>
									</a>

								</div><!-- .vcex-blog-entry-readmore-wrap -->

							<?php endif; ?>

							<?php
							// Close equal heights div if equal heights is enabled
							if ( $equal_heights_grid ) echo '</div>'; ?>

						</div><!-- .blog-entry-details -->

					<?php endif; // title/excerpt check ?>

				</div><!-- .blog-entry -->

			<?php
			// Reset entry counter
			if ( $count == $columns ) $count = '0'; ?>

			<?php
			// End main loop
			endwhile; ?>
			
		</div><!-- .vcex-blog-grid -->

		<?php
		// Display pagination if enabled
		if ( 'true' == $pagination ) : ?>
			<?php athen_pagination( $my_query ); ?>
		<?php endif; ?>

	</div><!-- <?php echo $wrap_classes; ?> -->

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
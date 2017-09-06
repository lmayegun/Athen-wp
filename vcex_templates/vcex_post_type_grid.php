<?php
/**
 * Output for the Post Type Grid Visual Composer module
 *
 * @package     Total
 * @subpackage  vcex_templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     2.0.2
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
	'unique_id'                 => '',
	'classes'                   => '',
	'visibility'                => '',
	'css_animation'             => '',
	'post_types'                => '',
	'tax_query'                 => '',
	'tax_query_taxonomy'        => '',
	'tax_query_terms'           => '',
	'posts_per_page'            => '12',
	'taxonomies'                => '',
	'grid_style'                => 'fit_columns',
	'columns'                   => '3',
	'columns_gap'               => '',
	'columns_responsive'        => '',
	'single_column_style'       => '',
	'order'                     => 'DESC',
	'orderby'                   => 'date',
	'orderby_meta_key'          => '',
	'filter'                    => '',
	'filter_taxonomy'           => 'portfolio_category',
	'masonry_layout_mode'       => '',
	'filter_speed'              => '',
	'center_filter'             => '',
	'posts_in'                  => '',
	'author_in'                 => '',
	'entry_media'               => '',
	'img_size'                  => '',
	'img_crop'                  => '',
	'img_width'                 => '',
	'img_height'                => '',
	'thumb_link'                => 'post',
	'img_filter'                => '',
	'title'                     => '',
	'date'                      => '',
	'excerpt'                   => '',
	'excerpt_length'            => '',
	'custom_excerpt_trim'       => '',
	'read_more'                 => '',
	'readmore_style'            => 'flat',
	'readmore_background'       => '',
	'readmore_style_color'      => '',
	'readmore_color'            => '',
	'readmore_hover_color'      => '',
	'readmore_hover_background' => '',
	'readmore_size'             => '',
	'readmore_padding'          => '',
	'readmore_margin'           => '',
	'readmore_border_radius'    => '',
	'read_more_text'            => __( 'read more', 'athen_transl' ),
	'readmore_rarr'             => '',
	'pagination'                => 'false',
	'taxonomy'                  => '',
	'terms'                     => '',
	'all_text'                  => '',
	'featured_video'            => '',
	'url_target'                => '',
	'thumbnail_query'           => '',
	'overlay_style'             => '',
	'img_rendering'             => '',
	'img_hover_style'           => '',
	'date_color'                => '',
	'date_font_size'            => '',
	'content_heading_margin'    => '',
	'content_heading_line_height'   => '',
	'content_background'        => '',
	'content_margin'            => '',
	'content_font_size'         => '',
	'content_padding'           => '',
	'content_border'            => '',
	'content_color'             => '',
	'content_opacity'           => '',
	'content_heading_color'     => '',
	'content_heading_size'      => '',
	'content_heading_transform' => '',
	'content_heading_weight'    => '',
	'content_alignment'         => '',
	'readmore_background'       => '',
	'readmore_color'            => '',
	'equal_heights_grid'        => '',
	'filter_type'               => '',
	'filter_taxonomy'           => '',
), $atts );

// Extract shortcode atts
extract( $atts );

// Build the WordPress query
$my_query = vcex_build_wp_query( $atts );

// Output posts
if ( $my_query->have_posts() ) :

	// Declare and Sanitize variables
	$title              = ( 'false' == $title ) ? false : true;
	$date               = ( 'false' == $date ) ? false : true;
	$entry_media        = ( 'false' == $entry_media ) ? false : true;
	$excerpt            = ( 'false' == $excerpt ) ? false : true;
	$read_more          = ( 'false' == $read_more ) ? false : true;
	$featured_video     = ( 'false' == $featured_video ) ? false : true;
	$filter             = ( 'true' == $filter ) ? true : false;
	$excerpt_length     = $excerpt_length ? $excerpt_length : '20';
	$read_more_text     = $read_more_text ? $read_more_text : __( 'read more', 'athen_transl' );
	$url_target         = vcex_html( 'target_attr', $url_target );
	$equal_heights_grid = ( 'true' == $equal_heights_grid ) ? true : false;
	$equal_heights_grid = ( $equal_heights_grid && $columns > '1' ) ? true : false;
	$center_filter      = ( 'yes' == $center_filter ) ? true : false;
	$all_text           = $all_text ? $all_text : __( 'All', 'athen_transl' );
	$css_animation      = $css_animation ? $this->getCSSAnimation( $css_animation ) : '';
	$css_animation      = ( $filter ) ? false : $css_animation;
	$is_isotope         = false;
	$wrap_data          = '';
	$inline_js          = array();

	// Advanced sanitization
	if ( $filter || 'masonry' == $grid_style || 'no_margins' == $grid_style ) {
		$is_isotope         = true;
		$equal_heights_grid = false;
	}
	if ( ! $filter && 'masonry' == $grid_style ) {
		$post_count = count( $my_query->posts );
		if ( $post_count <= $columns ) {
			$is_isotope = false;
		}
	}

	// Load lightbox stylesheet
	if ( 'lightbox' == $thumb_link ) {
		$inline_js[] = 'ilightbox';
		vcex_enque_style( 'ilightbox' );
	}

	// Turn post types into array
	$post_types = $post_types ? $post_types : 'post';
	$post_types = explode( ',', $post_types );

	// Add inline JS
	if ( $equal_heights_grid ) {
		$inline_js[] = 'equal_heights';
	}
	if ( $is_isotope ) {
		$inline_js[] = 'isotope';
	}
	if ( $readmore_hover_color || $readmore_hover_background ) {
		$inline_js[] = 'data_hover';
	}
	vcex_inline_js( $inline_js );

	// Wrap classes
	$wrap_classes = array( 'vcex-post-type-grid-wrap', 'clr' );
	if ( $visibility ) {
		$wrap_classes[] = $visibility;
	}
	if ( $classes ) {
		$wrap_classes[] = vcex_get_extra_class( $classes );
	}
	$wrap_classes = implode( ' ', $wrap_classes );

	// Grid classes
	$grid_classes = array( 'wpex-row', 'vcex-post-type-grid', 'clr' );
	if ( $columns_gap ) {
		$grid_classes[] = 'gap-'. $columns_gap;
	}
	if ( 'left_thumbs' == $single_column_style ) {
		$grid_classes[] = 'left-thumbs';
	}
	if ( $is_isotope ) {
		$grid_classes[] = 'vcex-isotope-grid';
	}
	if ( 'no_margins' == $grid_style ) {
		$grid_classes[] = 'vcex-no-margin-grid';
	}
	if ( $equal_heights_grid ) {
		$grid_classes[] = 'match-height-grid';
	}
	$grid_classes = implode( ' ', $grid_classes );

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

	// Heading Design
	if ( $title ) {
		$heading_style = vcex_inline_style( array(
			'margin'            => $content_heading_margin,
			'font_size'         => $content_heading_size,
			'color'             => $content_heading_color,
			'line_height'       => $content_heading_line_height,
			'text_transform'    => $content_heading_transform,
			'font_weight'       => $content_heading_weight,
		) );
		$heading_link_style = vcex_inline_style( array(
			'color'             => $content_heading_color,
		) );
	}

	// Readmore design and classes
	if ( $read_more ) {

		// Readmore classes
		$readmore_classes = array( 'vcex-button', 'animate-on-hover' );
		if ( $readmore_hover_color || $readmore_hover_background ) {
			$readmore_classes[] = 'wpex-data-hover';
		}
		$readmore_classes[] = $readmore_style;
		$readmore_classes[] = $readmore_style_color;
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

	// Date design
	if ( $date ) {
		$date_style = vcex_inline_style( array(
			'color'     => $date_color,
			'font_size' => $date_font_size,
		) );
	}

	// Data
	if ( $is_isotope && $filter) {
		if ( 'no_margins' != $grid_style && $masonry_layout_mode ) {
			$wrap_data .= ' data-layout-mode="'. $masonry_layout_mode .'"';
		}
		if ( $filter_speed ) {
			$wrap_data .= ' data-transition-duration="'. $filter_speed .'"';
		}
	}
	if ( 'no_margins' == $grid_style && 'true' != $filter ) {
		$wrap_data .= ' data-transition-duration="0.0"';
	}

	// Static entry classes
	$static_entry_classes = array( 'vcex-post-type-entry', 'clr' );
	if ( 'false' == $columns_responsive ) {
		$static_entry_classes[] = ' nr-col';
	} else {
		$static_entry_classes[] = ' col';
	}
	$static_entry_classes[] = ' span_1_of_'. $columns;
	if ( $is_isotope ) {
		$static_entry_classes[] = ' vcex-isotope-entry';
	}
	if ( 'no_margins' == $grid_style ) {
		$static_entry_classes[] = ' vcex-no-margin-entry';
	}
	if ( $css_animation ) {
		$static_entry_classes[] = ' '. $css_animation;
	}
	if ( ! $entry_media ) {
		$static_entry_classes[] = ' vcex-post-type-no-media-entry';
	}

	// Entry media classes
	$media_classes = array( 'vcex-post-type-entry-media' );
	if ( $entry_media ) {
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
	}
	$media_classes = ' '. implode( ' ', $media_classes ); ?>

	<div class="<?php echo $wrap_classes; ?>">

		<?php
		// Display filter links
		if ( $filter ) : ?>

			<?php if ( count( $post_types ) > 1 || 'taxonomy' == $filter_type ) : ?>

				<?php
				// Filter classes
				$filter_classes = 'vcex-post-type-filter vcex-filter-links clr';
				if ( $center_filter ) {
					$filter_classes .= ' center';
				} ?>

				<ul class="<?php echo $filter_classes; ?>">

					<li class="active"><a href="#" data-filter="*"><span><?php echo $all_text; ?></span></a></li>

					<?php if ( 'taxonomy' == $filter_type ) : ?>

						<?php if ( taxonomy_exists( $filter_taxonomy ) ) { ?>

							<?php $terms = get_terms( $filter_taxonomy ); ?>

							<?php if ( $terms ) { ?>

								<?php foreach ( $terms as $term ) : ?>
									<li class="filter-cat-<?php echo $term->term_id; ?>"><a href="#" data-filter=".cat-<?php echo $term->term_id; ?>"><?php echo $term->name; ?></a></li>
								<?php endforeach; ?>

							<?php } ?>

						<?php } ?>

					<?php else : ?>

						<?php foreach ( $post_types as $post_type ) : ?>
							
							<?php $obj = get_post_type_object( $post_type ); ?>

							<li class="vcex-filter-link-<?php echo $post_type; ?>"><a href="#" data-filter=".post-type-<?php echo $post_type; ?>"><?php echo $obj->labels->name; ?></a></li>

						<?php endforeach; ?>

					<?php endif; ?>

				</ul><!-- .vcex-post-type-filter -->

			<?php endif; ?>

		<?php endif; ?>

		<div class="<?php echo $grid_classes; ?>"<?php echo vcex_unique_id( $unique_id ); ?><?php echo $wrap_data; ?>>
			<?php
			// Define counter var to clear floats
			$count='';

			// Loop through posts
			while ( $my_query->have_posts() ) :

				// Get post from query
				$my_query->the_post();

				// Create new post object.
				$post = new stdClass();

				// Get post data
				$get_post = get_post();

				// Add to counter var
				$count++;

				// Post Data
				$post->ID               = $get_post->ID;
				$post->content          = $get_post->post_content;
				$post->type             = get_post_type( $post->ID );
				$post->title            = $get_post->post_title;
				$post->permalink        = athen_get_permalink( $post->ID );
				$post->format           = get_post_format( $post->ID );
				$post->excerpt          = '';
				$post->thumbnail        = wp_get_attachment_url( get_post_thumbnail_id() );
				$post->video            = athen_get_post_video_html();

				// Entry Classes
				$entry_classes  = array();
				$entry_classes[] = 'col-'. $count;
				$entry_classes[] = 'post-type-'. get_post_type( $post->ID );
				if ( taxonomy_exists( $filter_taxonomy ) ) {
					if ( $post_terms = get_the_terms( $post, $filter_taxonomy ) ) {
						foreach ( $post_terms as $post_term ) {
							$entry_classes[] = 'cat-'. $post_term->term_id;
						}
					}
				}
				$entry_classes = array_merge( $static_entry_classes, $entry_classes );

				// Define entry link and entry link classes
				$entry_link = $post->permalink;
				if ( $thumb_link == 'lightbox' ) {
					//$entry_link           = $post->video ? $post->video : $post->thumbnail;
					//$entry_link_classes   = $post->video ? 'wpex-lightbox-video' : 'wpex-lightbox';
					$entry_link         = $post->thumbnail;
					$entry_link_classes = 'wpex-lightbox';
				}
				$entry_link_classes = ! empty( $entry_link_classes ) ? 'class="'. $entry_link_classes .'"' : '';

				// Entry image output HTMl
				if ( $post->thumbnail ) {
					$entry_image = athen_get_post_thumbnail( array(
						'size'      => $img_size,
						'crop'      => $img_crop,
						'width'     => $img_width,
						'height'    => $img_height,
						'alt'       => athen_get_esc_title(),
					) );
				} ?>

				<div <?php post_class( $entry_classes ); ?>>

					<?php if ( $entry_media ) : ?>

						<?php
						// Display video
						if ( $featured_video && $post->video ) : ?>

							<div class="vcex-post-type-entry-media">
								<div class="vcex-video-wrap">
									<?php echo $post->video; ?>
								</div>
							</div><!-- .vcex-post-type-entry-media -->

						<?php
						// Display featured image
						elseif ( $post->thumbnail ) : ?>

							<div class="<?php echo $media_classes; ?>">

								<?php if ( $thumb_link == 'post' || $thumb_link == 'lightbox' ) : ?>

									<a href="<?php echo $entry_link; ?>" title="<?php athen_esc_title(); ?>"<?php echo $url_target; ?><?php echo $entry_link_classes; ?>>
										<?php echo $entry_image; ?>
										<?php athen_overlay( 'inside_link', $overlay_style ); ?>
									</a>

								<?php else : ?>

									<?php echo $entry_image; ?>

								<?php endif; ?>

								<?php athen_overlay( 'outside_link', $overlay_style ); ?>

							</div><!-- .post_type-entry-media -->

						<?php endif; ?>

					<?php endif; ?>

					<?php if ( $title || $excerpt || $read_more ) : ?>

						<div class="vcex-post-type-entry-details clr" <?php echo $content_style; ?>>

							<?php if ( $equal_heights_grid ) echo '<div class="match-height-content">'; ?>

							<?php
							// Display title
							if ( $title ) : ?>

								<h2 class="vcex-post-type-entry-title entry-title" <?php echo $heading_style; ?>>
									<a href="<?php echo $post->permalink; ?>" title="<?php athen_esc_title(); ?>"<?php echo $url_target; ?><?php echo $heading_link_style; ?>><?php the_title(); ?></a>
								</h2>

							<?php endif; ?>

							<?php
							// Display date
							if ( $date ) : ?>

								<div class="vcex-post-type-entry-date"<?php echo $date_style; ?>>
									<?php if ( 'tribe_events' == $post->type && function_exists( 'tribe_get_start_date' ) ) { ?>
										<?php echo tribe_get_start_date( $post->ID, false, get_option( 'date_format' ) ); ?>
									<?php } else { ?> 
										<?php echo get_the_date(); ?>
									<?php } ?>
								</div><!-- .vcex-post-type-entry-date -->

							<?php endif; ?>

							<?php
							// Display excerpt
							if ( $excerpt ) : ?>

								<div class="vcex-post-type-entry-excerpt clr">

									<?php
									// Display Excerpt
									athen_excerpt( array (
										'length' => intval( $excerpt_length ),
									) ); ?>

								</div><!-- .vcex-post-type-entry-excerpt -->

							<?php endif; ?>

							<?php
							// Display read more button
							if ( $read_more && $read_more_text ) : ?>

								<div class="vcex-post-type-entry-readmore-wrap clr">

									<a href="<?php echo $post->permalink; ?>" title="<?php echo esc_attr( $read_more_text ); ?>" rel="bookmark" class="<?php echo $readmore_classes; ?>"<?php echo $url_target; ?><?php echo $readmore_style; ?><?php echo $readmore_data; ?>>
										<?php echo $read_more_text; ?>
										<?php if ( 'true' == $readmore_rarr ) : ?>
											<span class="vcex-readmore-rarr"><?php echo athen_element( 'rarr' ); ?></span>
										<?php endif; ?>
									</a>

								</div><!-- .vcex-post-type-entry-readmore-wrap -->

							<?php endif; ?>

							<?php if ( $equal_heights_grid ) echo '</div>'; ?>

						</div><!-- .post_type-entry-details -->

					<?php endif; ?>

				</div><!-- .post_type-entry -->

			<?php if ( $count == $columns ) $count = ''; ?>

			<?php endwhile; // End main loop ?>

		</div><!-- .vcex-post-type-grid -->
		
		<?php
		// Display pagination
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
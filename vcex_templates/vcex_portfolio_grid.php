<?php
/**
 * Output for the portfolio grid Visual Composer module
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

// Get shortcode attributes
$atts = shortcode_atts( array(
	'unique_id'                 => '',
	'classes'                   => '',
	'visibility'                => '',
	'css_animation'             => '',
	'post_type'                 => 'portfolio',
	'order'                     => 'DESC',
	'orderby'                   => 'date',
	'author_in'                 => '',
	'orderby_meta_key'          => '',
	'term_slug'                 => '',
	'include_categories'        => '',
	'exclude_categories'        => '',
	'posts_per_page'            => '8',
	'pagination'                => '',
	'taxonomy'                  => '',
	'terms'                     => '',
	'tax_query'                 => '',
	'grid_style'                => 'fit_columns',
	'masonry_layout_mode'       => 'masonry',
	'filter_speed'              => '',
	'columns'                   => '4',
	'columns_gap'               => '',
	'columns_responsive'        => '',
	'filter'                    => '',
	'filter_taxonomy'           => 'portfolio_category',
	'center_filter'             => 'no',
	'thumb_link'                => 'post',
	'thumb_lightbox_gallery'    => '',
	'thumb_lightbox_title'      => '',
	'thumb_lightbox_caption'    => '',
	'img_size'                  => 'athen_custom',
	'img_crop'                  => 'center-center',
	'img_width'                 => '',
	'img_height'                => '',
	'img_filter'                => '',
	'title'                     => 'true',
	'title_link'                => 'post',
	'link_target'               => '',
	'excerpt'                   => '',
	'excerpt_length'            => 30,
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
	'img_hover_style'           => '',
	'img_overlay_disable'       => '',
	'img_rendering'             => '',
	'all_text'                  => '',
	'overlay_style'             => '',
	'content_heading_margin'    => '',
	'content_heading_weight'    => '',
	'content_heading_transform' => '',
	'content_background'        => '',
	'content_margin'            => '',
	'content_font_size'         => '',
	'content_padding'           => '',
	'content_border'            => '',
	'content_color'             => '',
	'content_opacity'           => '',
	'content_heading_color'     => '',
	'content_heading_line_height'   => '',
	'content_heading_size'      => '',
	'content_alignment'         => '',
	'readmore_background'       => '',
	'readmore_color'            => '',
	'equal_heights_grid'        => '',
	'single_column_style'       => '',
	'featured_video'            => '',
	'entry_media'               => '',
	'show_categories'           => '',
	'show_first_category_only'  => '',
	'lightbox_skin'             => '',
	'categories_margin'         => '',
	'categories_font_size'      => '',
), $atts );

// Extract shortcode atts
extract( $atts );

// Fallback for term slug
if ( $term_slug ) {
	$include_categories = $term_slug;
}

// Build the WordPress query
$my_query = vcex_build_wp_query( $atts );

// Output posts
if ( $my_query->have_posts() ) :

	// Sanitize data & declare main variables
	$inline_js          = array();
	$grid_data          = array();
	$is_isotope         = false;
	$title              = ( 'false' != $title ) ? true : false;
	$excerpt            = ( 'false' != $excerpt ) ? true : false;
	$read_more          = ( 'false' != $read_more ) ? true : false;
	$excerpt_length     = $excerpt_length ? $excerpt_length : '30';
	$excerpt_length     = ( ! $excerpt ) ? '0' : $excerpt_length;
	$entry_media        = ( 'false' != $entry_media ) ? true : false;
	$center_filter      = 'yes' == $center_filter ? ' center' : '';
	$all_text           = $all_text ? $all_text : __( 'All', 'athen_transl' );
	$css_animation      = $css_animation ? $this->getCSSAnimation( $css_animation ) : '';
	$css_animation      = ( 'true' == $filter ) ? false : $css_animation;
	$filter             = ( 'true' == $filter ) ? true : false;
	$overlay_style      = $overlay_style ? $overlay_style : 'none';
	$equal_heights_grid = ( 'true' == $equal_heights_grid ) ? true : false;
	$equal_heights_grid = ( $equal_heights_grid && $columns > '1' ) ? true : false;

	// Load lightbox scripts
	if ( 'lightbox' == $thumb_link ) {
		vcex_enque_style( 'ilightbox', $lightbox_skin );
	}

	// Enable Isotope
	if ( 'true' == $filter || 'masonry' == $grid_style || 'no_margins' == $grid_style ) {
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

	// Add inline js
	if ( $is_isotope ) {
		$inline_js[] = 'isotope';
	}
	if ( 'lightbox' == $thumb_link ) {
		$inline_js[] = 'ilightbox';
	}
	if ( $readmore_hover_color || $readmore_hover_background ) {
		$inline_js[] = 'data_hover';
	}
	if ( $equal_heights_grid ) {
		$inline_js[] = 'equal_heights';
	}
	if ( $inline_js ) {
		vcex_inline_js( $inline_js );
	}

	// Wrap classes
	$wrap_classes = array( 'vcex-portfolio-grid-wrap', 'clr' );
	if ( $visibility ) {
		$wrap_classes[] = $visibility;
	}
	if ( $classes ) {
		$wrap_classes[] = vcex_get_extra_class( $classes );
	}
	$wrap_classes = implode( ' ', $wrap_classes );

	// Main grid classes
	$grid_classes = array( 'wpex-row', 'vcex-portfolio-grid', 'clr' );
	if ( $columns_gap ) {
		$grid_classes[] = 'gap-'. $columns_gap;
	}
	if ( $is_isotope ) {
		$grid_classes[] = 'vcex-isotope-grid';
	}
	if ( 'no_margins' == $grid_style ) {
		$grid_classes[] = 'vcex-no-margin-grid';
	}
	if ( 'left_thumbs' == $single_column_style ) {
		$grid_classes[] = 'left-thumbs';
	}
	if ( $equal_heights_grid ) {
		$grid_classes[] = 'match-height-grid';
	}
	if ( 'true' == $thumb_lightbox_gallery ) {
		$grid_classes[] = ' lightbox-group';
		if ( $lightbox_skin ) {
			$grid_data[] = 'data-skin="'. $lightbox_skin .'"';
		}
		$lightbox_single_class = ' lightbox-group-item';
	} else {
		$lightbox_single_class = ' wpex-lightbox';
	}
	$grid_classes = implode( ' ', $grid_classes );

	// Grid data attributes
	if ( $is_isotope && $filter ) {
		if ( 'no_margins' != $grid_style && $masonry_layout_mode ) {
			$grid_data[] = 'data-layout-mode="'. $masonry_layout_mode .'"';
		}
		if ( $filter_speed ) {
			$grid_data[] = 'data-transition-duration="'. $filter_speed .'"';
		} elseif ( '0' == $filter_speed ) {
			$grid_data[] = 'data-transition-duration="0.0"';
		}
	}
	if ( ! $filter ) {
		$grid_data[] = 'data-transition-duration="0.0"';
	}
	if ( 'no_margins' == $grid_style && ! $filter ) {
		$grid_data[] = 'data-transition-duration="0.0"';
	}
	$grid_data = ' '. implode( ' ', $grid_data );

	// Media classes
	$media_classes = array( 'portfolio-entry-media' );
	if ( $img_filter ) {
		$media_classes[] = athen_image_filter_class( $img_filter );
	}
	if ( $img_hover_style ) {
		$media_classes[] = athen_image_hover_classes( $img_hover_style );
	}
	if ( $img_rendering ) {
		$media_classes[] = athen_image_rendering_class( $img_rendering );
	}
	if ( 'none' != $overlay_style ) {
		$media_classes[] = Athen_Overlay::athen_overlay_classes( $overlay_style );
	}
	$media_classes = implode( ' ', $media_classes );

	// Content Design
	$content_style = vcex_inline_style( array(
		'background'    => $content_background,
		'padding'       => $content_padding,
		'margin'        => $content_margin,
		'border'        => $content_border,
		'color'         => $content_color,
		'opacity'       => $content_opacity,
		'text_align'    => $content_alignment,
	) );

	// Heading style
	if ( $title ) {

		// Heading Design
		$heading_style = vcex_inline_style( array(
			'margin'            => $content_heading_margin,
			'font_size'         => $content_heading_size,
			'color'             => $content_heading_color,
			'font_weight'       => $content_heading_weight,
			'text_transform'    => $content_heading_transform,
			'line_height'       => $content_heading_line_height,
		) );

		// Heading Link style
		$heading_link_style = vcex_inline_style( array(
			'color' => $content_heading_color,
		) );

	}

	// Categories style
	if ( 'true' == $show_categories ) {
		$categories_style = vcex_inline_style( array(
			'margin'    => $categories_margin,
			'font_size' => $categories_font_size,
		) );
	}

	// Excerpt style
	if ( $excerpt ) {
		$excerpt_style = vcex_inline_style( array(
			'font_size' => $content_font_size,
		) );
	}

	// Readmore design
	if ( $read_more ) {

		// Readmore classes
		$readmore_classes   = array( 'vcex-button', 'animate-on-hover' );
		if ( $readmore_hover_color || $readmore_hover_background ) {
			$readmore_classes[] = 'wpex-data-hover';
		}
		$readmore_classes[] = $readmore_style;
		$readmore_classes[] = $readmore_style_color;
		$readmore_classes   = implode( ' ', $readmore_classes );

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
	} ?>

	<div class="<?php echo $wrap_classes; ?>">

		<?php
		// Display filter links
		if ( 'true' == $filter && taxonomy_exists( 'portfolio_category' ) ) : ?>

			<?php
			// Define filter args
			$args = vcex_grid_filter_args( $atts );

			// Get filter terms
			$terms = get_terms( 'portfolio_category', $args ); ?>

			<?php
			// Display filter if terms are found and there are more then one
			if ( $terms && count( $terms ) > '1' ) : ?>

				<ul class="vcex-portfolio-filter vcex-filter-links clr<?php echo $center_filter; ?>">
					<li class="active"><a href="#" data-filter="*"><span><?php echo $all_text; ?></span></a></li>
					<?php
					// Loop through terms to display filter links
					foreach ( $terms as $term ) : ?>
						<li class="filter-cat-<?php echo $term->term_id; ?>"><a href="#" data-filter=".cat-<?php echo $term->term_id; ?>"><?php echo $term->name; ?></a></li>
					<?php endforeach; ?>
				</ul><!-- .vcex-portfolio-filter -->

			<?php endif; ?>

		<?php endif; ?>

		<div class="<?php echo esc_attr( $grid_classes ); ?>"<?php echo vcex_unique_id( $unique_id ); ?> <?php echo $grid_data; ?>>
			<?php
			// Define counter var to clear floats
			$count = 0;

			// Start loop
			while ( $my_query->have_posts() ) :

				// Get post from query
				$my_query->the_post();

				// Create new post object
				$post = new stdClass();

				// Get post data
				$get_post = get_post();

				// Post Data
				$post->ID               = $get_post->ID;
				$post->permalink        = athen_get_permalink( $post->ID );
				$post->title            = $get_post->post_title;
				$post->video            = athen_get_post_video( $post->ID );
				$post->video_output     = athen_get_post_video_html( $post->video );
				$post->excerpt          = '';

				// Post Excerpt
				if ( $excerpt || 'true' == $thumb_lightbox_caption ) {
					$post->excerpt = athen_get_excerpt( array (
						'length' => intval( $excerpt_length ),
					) );
				}

				// Add to the counter var
				$count++;

				// Add classes to the entries
				$entry_classes = array( 'portfolio-entry' );
				$entry_classes[] = 'athen-col-'. $columns;
				if ( 'false' == $columns_responsive ) {
					$entry_classes[] = 'nr-col';
				} else {
					$entry_classes[] = 'col';
				}
				if ( $count ) {
					$entry_classes[] = 'col-'. $count;
				}
				if ( $css_animation ) {
					$entry_classes[] = $css_animation;
				}
				if ( $is_isotope ) {
					$entry_classes[] = 'vcex-isotope-entry';
				}
				if ( 'no_margins' == $grid_style ) {
					$entry_classes[] = 'vcex-no-margin-entry';
				}
				if ( taxonomy_exists( 'portfolio_category' ) ) {
					$post_terms = get_the_terms( $post->ID, 'portfolio_category' );
					if ( $post_terms ) {
						foreach ( $post_terms as $post_term ) {
							$entry_classes[] = 'cat-'. $post_term->term_id;
						}
					}
				} ?>

				<div <?php post_class( $entry_classes ); ?>>

					<?php
					// Entry Media
					if ( $entry_media ) : ?>
						
						<?php
						// Video
						if ( 'false' !== $featured_video && $post->video_output ) : ?>

							<div class="portfolio-entry-media portfolio-featured-video clr">
								<?php echo $post->video_output; ?>
							</div><!-- .portfolio-featured-video -->

						<?php 
						// Featured Image
						elseif ( has_post_thumbnail( $post->ID ) ) : ?>

							<div class="<?php echo $media_classes; ?>">

								<?php
								// Open link tag if thumblink does not equal nowhere
								if ( 'nowhere' != $thumb_link ) : ?>

									<?php
									// Lightbox
									if ( 'lightbox' == $thumb_link ) : ?>

										<?php
										// Display lightbox title
										$lightbox_data = array();
										if ( $lightbox_skin && 'true' !== $thumb_lightbox_gallery ) {
											$lightbox_data[] = 'data-skin="'. $lightbox_skin .'"';
										}
										if ( 'true' == $thumb_lightbox_title ) {
											$lightbox_data[] = 'data-title="'. athen_get_esc_title() .'"';
										}
										// Display lightbox
										if ( 'true' == $thumb_lightbox_caption && $post->excerpt ) {
											$lightbox_data[] = 'data-caption="'. str_replace( '"',"'", $post->excerpt ) .'"';
										}
										$lightbox_data = ' '. implode( ' ', $lightbox_data ); ?>
										<a href="<?php athen_lightbox_image(); ?>" title="<?php athen_esc_title(); ?>" class="portfolio-entry-media-link<?php echo $lightbox_single_class; ?>"<?php echo $lightbox_data; ?>>

									<?php 
									// Standard post link
									else : ?>

										<a href="<?php echo $post->permalink; ?>" title="<?php athen_esc_title(); ?>" class="portfolio-entry-media-link"<?php echo vcex_html( 'target_attr', $link_target ); ?>>

									<?php endif; ?>

								<?php endif; ?>

								<?php
								// Display post thumbnail
								athen_post_thumbnail( array(
									'width'     => $img_width,
									'height'    => $img_height,
									'crop'      => $img_crop,
									'alt'       => athen_get_esc_title(),
									'class'     => 'portfolio-entry-img',
									'size'      => $img_size,
								) ); ?>

								<?php
								// Inner link overlay HTML
								Athen_Overlay::athen_overlay( 'inside_link', $overlay_style ); ?>

								<?php
								// Close link tag
								if ( 'nowhere' != $thumb_link ) echo '</a>'; ?>

								<?php
								// Outer link overlay HTML
								Athen_Overlay::athen_overlay( 'outside_link', $overlay_style ); ?>

							</div><!-- .portfolio-entry-media -->

						<?php endif; ?>

					<?php endif; ?>

					<?php
					// Display content if there is either a title or excerpt
					if ( $title || $post->excerpt ) : ?>
					
						<div class="portfolio-entry-details clr"<?php echo $content_style; ?>>

							<?php
							// Equal height div
							if ( $equal_heights_grid && ! $is_isotope ) echo '<div class="match-height-content">'; ?>

							<?php if ( $title ) : ?>

								<h2 class="portfolio-entry-title entry-title"<?php echo $heading_style; ?>>

									<?php
									// Link title to post
									if ( 'post' == $title_link ) : ?>

										<a href="<?php echo $post->permalink; ?>" title="<?php athen_esc_title(); ?>"<?php echo $heading_link_style; ?><?php echo vcex_html( 'target_attr', $link_target ); ?>>
											<?php echo $post->title; ?>
										</a>

									<?php
									// Link title to lightbox
									elseif ( 'lightbox' == $title_link ) : ?>

										<?php
										// Load lightbox scripts
										vcex_enque_style( 'ilightbox', $lightbox_skin );
										vcex_inline_js( 'ilightbox' ); ?>

										<?php
										$lightbox_data = array();
										// Lightbox data
										if ( $lightbox_skin && 'true' !== $thumb_lightbox_gallery ) {
											$lightbox_data[] = 'data-skin="'. $lightbox_skin .'"';
										}
										if ( 'true' == $thumb_lightbox_title ) {
											$lightbox_data[] = 'data-title="'. athen_get_esc_title() .'"';
										}
										// Display lightbox
										if ( 'true' == $thumb_lightbox_caption && $post->excerpt ) {
											$lightbox_data[] = 'data-caption="'. str_replace( '"',"'", $post->excerpt ) .'"';
										}
										$lightbox_data = ' '. implode( ' ', $lightbox_data ); ?>

										<a href="<?php athen_lightbox_image(); ?>" title="<?php athen_esc_title(); ?>" class="wpex-lightbox"<?php echo $heading_link_style; ?><?php echo $lightbox_data; ?>>
											<?php echo $post->title; ?>
										</a>

									<?php
									// Display title without link
									else : ?>

										<?php  echo $post->title; ?>

									<?php endif ?>

								</h2>

							<?php endif; ?>

							<?php
							// Display categories
							if ( $show_categories ) : ?>

								<div class="portfolio-entry-categories clr"<?php echo $categories_style; ?>>
									<?php if ( $show_first_category_only ) { ?>
										<?php athen_first_term_link( $post->ID, 'portfolio_category' ); ?>
									<?php } else { ?>
										<?php athen_list_post_terms( 'portfolio_category', true, true ); ?>
									<?php } ?>
								</div><!-- .portfolio-entry-categories -->

							<?php endif; ?>

							<?php
							// Display excerpt
							if ( $excerpt && $post->excerpt ) : ?>

								<div class="portfolio-entry-excerpt clr"<?php echo $excerpt_style; ?>>
									<?php echo $post->excerpt; ?>
								</div><!-- .portfolio-entry-excerpt -->

							<?php endif; ?>

							<?php
							// Display read more button
							if ( $read_more && $read_more_text ) : ?>

								<div class="portfolio-entry-readmore-wrap clr">

									<a href="<?php echo $post->permalink; ?>" title="<?php echo esc_attr( $read_more_text ); ?>" rel="bookmark" class="<?php echo $readmore_classes; ?>"<?php echo $readmore_style; ?><?php echo $readmore_data; ?><?php echo vcex_html( 'target_attr', $link_target ); ?>>
										<?php echo $read_more_text; ?>
										<?php if ( 'true' == $readmore_rarr ) : ?>
											<span class="vcex-readmore-rarr"><?php echo athen_element( 'rarr' ); ?></span>
										<?php endif; ?>
									</a>

								</div><!-- .portfolio-entry-readmore-wrap -->

							<?php endif; ?>
							
							<?php
							// Close Equal height container
							if ( $equal_heights_grid && ! $is_isotope ) echo '</div>'; ?>

						</div><!-- .portfolio-entry-details -->

					<?php endif; ?>

				</div><!-- .portfolio-entry -->

				<?php
				// Reset entry counter
				if ( $count == $columns ) $count = ''; ?>
			
			<?php
			// End post loop
			endwhile; ?>

		</div><!-- .vcex-portfolio-grid -->
		
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
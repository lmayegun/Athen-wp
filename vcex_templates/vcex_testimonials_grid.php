<?php
/**
 * Output for the testimonials grid Visual Composer module
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
	'unique_id'             => '',
	'visibility'			=> '',
	'classes'               => '',
	'term_slug'             => 'all',
	'css_animation'         => '',
	'post_type'             => 'testimonials',
	'tax_query'             => '',
	'include_categories'    => '',
	'exclude_categories'    => '',
	'posts_per_page'        => '12',
	'grid_style'            => 'fit_columns',
	'masonry_layout_mode'   => '',
	'filter_speed'          => '',
	'columns_gap'           => '',
	'columns'               => '4',
	'order'                 => 'DESC',
	'orderby'               => 'date',
	'orderby_meta_key'      => '',
	'filter'                => '',
	'filter_taxonomy'       => 'testimonials_category',
	'center_filter'         => '',
	'title'                 => 'true',
	'excerpt'               => 'false',
	'excerpt_length'        => '20',
	'read_more'             => 'true',
	'read_more_text'        => __( 'read more', 'athen_transl' ),
	'read_more_rarr'        => '',
	'pagination'            => 'false',
	'filter_content'        => 'false',
	'offset'                => 0,
	'taxonomy'              => '',
	'terms'                 => '',
	'all_text'              => __( 'All', 'athen_transl' ),
	'img_size'              => 'athen_custom',
	'img_crop'              => '',
	'img_border_radius'     => '',
	'img_width'             => '',
	'img_height'            => '',
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

	// Declare and sanitize vars
	$inline_js      = array();
	$css_animation  = $css_animation ? $this->getCSSAnimation( $css_animation ) : '';
	$filter         = ( 'true' == $filter ) ? true : false;
	$css_animation  = ( $filter ) ? false : $css_animation;

	// Is Isotope var
	if ( 'true' == $filter || 'masonry' == $grid_style ) {
		$is_isotope = true;
	} else {
		$is_isotope = false;
	}

	// No need for masonry if not enough columns and filter is disabled
	if ( ! $filter && 'masonry' == $grid_style ) {
		$post_count = count( $my_query->posts );
		if ( $post_count <= $columns ) {
			$is_isotope = false;
		}
	}

	// Output script for inline JS for the Visual composer front-end builder
	if ( $is_isotope ) {
		$inline_js[] = 'isotope';
	}

	// Image Style
	$img_style = vcex_inline_style( array(
		'border_radius' => $img_border_radius,
	), false );

	// Image classes
	$img_classes = '';
	if ( $img_width || $img_height || 'athen_custom' != $img_size ) {
		$img_classes = 'remove-dims';
	}

	// Wrap classes
	$wrap_classes = array( 'vcex-testimonials-grid-wrap', 'clr' );
	if ( $visibility ) {
		$wrap_classes[] = $visibility;
	}
	if ( $classes ) {
		$wrap_classes[] = vcex_get_extra_class( $classes );
	}
	$wrap_classes = implode( ' ', $wrap_classes );

	// Grid Classes
	$grid_classes = array( 'wpex-row', 'vcex-testimonials-grid', 'clr' );
	if ( $columns_gap ) {
		$grid_classes[] = 'gap-'. $columns_gap;
	}
	if ( $is_isotope ) {
		$grid_classes[] = 'vcex-isotope-grid';
	}
	$grid_classes = implode( ' ', $grid_classes );

	// Data
	$grid_data = array();
	if ( $is_isotope && $filter) {
		if ( 'no_margins' != $grid_style && $masonry_layout_mode ) {
			$grid_data[] = 'data-layout-mode="'. $masonry_layout_mode .'"';
		}
		if ( $filter_speed ) {
			$grid_data[] = 'data-transition-duration="'. $filter_speed .'"';
		}
	}
	$grid_data = ' '. implode( ' ', $grid_data );

	// Load inline js
	if ( $inline_js ) {
		vcex_inline_js( $inline_js );
	} ?>

	<div class="<?php echo $wrap_classes; ?>">

		<?php
		// Display filter links
		if ( $filter && taxonomy_exists( 'testimonials_category' ) ) : ?>

			<?php
			// Define filter args
			$args = vcex_grid_filter_args( $atts );

			// Get filter terms
			$terms = get_terms( 'testimonials_category', $args ); ?>

			<?php
			// Display filter 
			if ( $terms && count( $terms ) > '1' ) : ?>

				<?php $center_filter = 'yes' == $center_filter ? 'center' : ''; ?>

				<ul class="vcex-testimonials-filter vcex-filter-links <?php echo $center_filter; ?> clr">
					<li class="active"><a href="#" data-filter="*"><span><?php echo $all_text; ?></span></a></li>
					<?php foreach ($terms as $term ) : ?>
						<li class="filter-cat-<?php echo $term->term_id; ?>"><a href="#" data-filter=".cat-<?php echo $term->term_id; ?>"><?php echo $term->name; ?></a></li>
					<?php endforeach; ?>
				</ul><!-- .vcex-testimonials-filter -->

			<?php endif; ?>

		<?php endif; ?>

		<div class="<?php echo $grid_classes; ?>"<?php vcex_unique_id( $unique_id ); ?><?php echo $grid_data; ?>>

			<?php
			// Define counter var to clear floats
			$count = 0;

			// Start loop
			while ( $my_query->have_posts() ) :

				// Get post from query
				$my_query->the_post();

				// Add to the counter var
				$count++;

				// Create new post object
				$testimonial = new stdClass();

				// Get post data
				$testimonial->ID        = get_the_ID();
				$testimonial->author    = get_post_meta( get_the_ID(), 'athen_testimonial_author', true );
				$testimonial->company   = get_post_meta( get_the_ID(), 'athen_testimonial_company', true );
				$testimonial->url       = get_post_meta( get_the_ID(), 'athen_testimonial_url', true );

				// Add classes to the entries
				$entry_classes = array( 'testimonial-entry', 'col' );
				$entry_classes[] = ' span_1_of_'. $columns;
				$entry_classes[] = ' col-'. $count;
				if ( $css_animation ) {
					$entry_classes[] = $css_animation;
				}
				if ( $is_isotope ) {
					$entry_classes[] = ' vcex-isotope-entry';
				}
				if ( taxonomy_exists( 'testimonials_category' ) && $post_terms = get_the_terms( $testimonial->ID, 'testimonials_category' ) ) {
					foreach ( $post_terms as $post_term ) {
						$entry_classes[] = ' cat-'. $post_term->term_id;
					}
				} ?>

				<div <?php post_class( $entry_classes ); ?>>

					<div class="testimonial-entry-content clr">

						<span class="testimonial-caret"></span>

						<?php
						// Display excerpt if enabled (default dispays full content )
						if ( 'true' == $excerpt ) :

							// Custom readmore text
							if ( 'true' == $read_more ) :

								// Add arrow
								if ( 'false' != $read_more_rarr ) {
									$read_more_rarr_html = '<span>&rarr;</span>';
								} else {
									$read_more_rarr_html = '';
								}

								// Read more text
								if ( is_rtl() ) {
									$read_more_link = '...<a href="'. athen_get_permalink() .'" title="'. esc_attr( $read_more_text ) .'">'. $read_more_text .'</a>';
								} else {
									$read_more_link = '...<a href="'. athen_get_permalink() .'" title="'. esc_attr( $read_more_text ) .'">'. $read_more_text . $read_more_rarr_html .'</a>';
								}

							else :

								$read_more_link = '...';

							endif;

							// Custom Excerpt function
							athen_excerpt( array(
								'post_id'   => $testimonial->ID,
								'length'    => intval( $excerpt_length ),
								'more'      => $read_more_link,
							) );

						// Display full post content
						else :

							the_content();
						
						endif; ?>

					</div><!-- .home-testimonial-entry-content-->

					<div class="testimonial-entry-bottom">

						<?php
						// Check if post thumbnail is defined
						if ( has_post_thumbnail() ) : ?>

							<div class="testimonial-entry-thumb">

								<?php
								// Display post thumbnail
								athen_post_thumbnail( array(
									'size'      => $img_size,
									'width'     => $img_width,
									'height'    => $img_height,
									'class'     => $img_classes,
									'style'     => $img_style,
									'crop'      => $img_crop,
								) ); ?>

							</div><!-- /testimonial-thumb -->

						<?php endif; ?>

						<div class="testimonial-entry-meta">

							<?php
							// Display testimonial author
							if ( $testimonial->author ) : ?>

								<span class="testimonial-entry-author"><?php echo $testimonial->author; ?></span>

							<?php endif; ?>

							<?php
							// Display testimonial company
							if ( $testimonial->company ) : ?>

								<?php
								// Display testimonial company with URL
								if ( $testimonial->url ) : ?>

									<a href="<?php echo esc_url( $testimonial->url ); ?>" class="testimonial-entry-company" title="<?php echo $testimonial->company; ?>" target="_blank"><?php echo $testimonial->company; ?></a>

								<?php
								// Display testimonial company without URL since it's not defined
								else : ?>

									<span class="testimonial-entry-company"><?php echo $testimonial->company; ?></span>

								<?php endif; ?>

							<?php endif; ?>

						</div><!-- .testimonial-entry-meta -->

					</div><!-- .home-testimonial-entry-bottom -->

				</div><!-- .testimonials-entry -->

				<?php
				// Reset post loop counter
				if ( $count == $columns ) $count = ''; ?>

			<?php endwhile; ?>

		</div><!-- .vcex-testimonials-grid -->
		
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
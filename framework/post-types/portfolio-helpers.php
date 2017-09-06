<?php
/**
 * Description : Function for portfolio post-type related components. 
 * 
 * @package     Athen
 * @subpackage  Closer - Controller
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

/**
 * Returns portfolio entry blocks
 *
 * @since  2.1.0
 * @return array
 */
function athen_portfolio_entry_blocks() {

	// Defaults
	$defaults = array(
		'media',
		'title',
		'content',
		'read_more',
	);

	// Get layout blocks
	$blocks = athen_get_mod( 'portfolio_entry_composer' );

	// If blocks are 100% empty return defaults
	$blocks = $blocks ? $blocks : $defaults;
				
	// Apply filters to entry layout blocks
	$blocks = apply_filters( 'athen_portfolio_entry_blocks', $blocks );

	// Convert blocks to array so we can loop through them
	if ( ! is_array( $blocks ) ) {
		$blocks = explode( ',', $blocks );
	}

	// Return blocks
	return $blocks;

}

/**
 * Returns portfolio post blocks
 *
 * @since  2.1.0
 * @return array
 */
function athen_portfolio_post_blocks() {

	// Defaults
	$defaults = array(
		'content',
		'share',
		'related',
	);

	// Get layout blocks
	$blocks = athen_get_mod( 'portfolio_post_composer' );

	// If blocks are 100% empty return defaults
	$blocks = $blocks ? $blocks : $defaults;
				
	// Apply filters to entry layout blocks
	$blocks = apply_filters( 'athen_portfolio_single_blocks', $blocks );

	// Convert blocks to array so we can loop through them
	if ( ! is_array( $blocks ) ) {
		$blocks = explode( ',', $blocks );
	}

	// Return blocks
	return $blocks;

}

/**
 * Returns correct thumbnail HTML for the portfolio entries
 *
 * @since 2.0.0
 */
function athen_get_portfolio_entry_thumbnail() {

	// Define thumbnail args
	$args = array(
		'size'  => 'portfolio_entry',
		'class' => 'portfolio-entry-img',
		'alt'   => athen_get_esc_title(),
	);

	// Apply filters
	$args = apply_filters( 'athen_get_portfolio_entry_thumbnail_args', $args );

	// Return thumbanil
	return athen_get_post_thumbnail( $args );

}

/**
 * Returns correct thumbnail HTML for the portfolio posts
 *
 * @since 2.0.0
 */
function athen_get_portfolio_post_thumbnail( $args = array() ) {

	// Define thumbnail args
	$defaults = array(
		'size'       => 'portfolio_post',
		'class'      => 'portfolio-single-media-img',
		'alt'        => athen_get_esc_title(),
	);

	// Parse arguments
	$args = wp_parse_args( $args, $defaults );

	// Apply filters
	$args = apply_filters( 'athen_get_portfolio_post_thumbnail_args', $args );

	// Return thumbanil
	return athen_get_post_thumbnail( $args );

}

/**
 * Displays the media (featured image or video ) for the portfolio entries
 *
 * @since Total 1.3.6
 */
if ( ! function_exists( 'athen_portfolio_entry_media' ) ) {
	function athen_portfolio_entry_media() {
		get_template_part( 'partials/portfolio/entry-media' );
	}
}

/**
 * Displays the details for the portfolio entries
 *
 * @since Total 1.3.6
 */
if ( ! function_exists( 'athen_portfolio_entry_content' ) ) {
	function athen_portfolio_entry_content() {
		get_template_part( 'partials/portfolio/entry-content' );
	}
}

/**
 * Returns correct classes for the portfolio wrap
 *
 * @since   Total 1.5.3
 * @return  var $classes
 */
if ( ! function_exists( 'athen_get_portfolio_wrap_classes' ) ) {
	function athen_get_portfolio_wrap_classes() {

		// Get grid style
		$grid_style = athen_get_mod( 'portfolio_archive_grid_style' ) ? athen_get_mod( 'portfolio_archive_grid_style' ) : 'fit-rows';

		// Add default classes
		$classes = array( 'wpex-row', 'clr' );

		// Add grid style class
		$classes[] = 'portfolio-'. $grid_style;

		// Add equal height class
		$classes[] = athen_portfolio_match_height() ? 'match-height-grid' : '';

		// Apply filters
		$classes  = apply_filters( 'athen_portfolio_wrap_classes', $classes );

		// Turn into string
		$classes = implode( " ",$classes );

		// Return classes
		return $classes;

	}
}

/**
 * Returns portfolio archive columns
 *
 * @since 2.0.0
 */
function athen_portfolio_archive_columns() {
	return athen_get_mod( 'portfolio_entry_columns', '4' );
}

/**
 * Checks if match heights are enabled for the portfolio
 *
 * @since   Total 1.5.3
 * @return  bool
 */
if ( ! function_exists( 'athen_portfolio_match_height' ) ) {
	function athen_portfolio_match_height() {
		$grid_style = athen_get_mod( 'portfolio_archive_grid_style', 'fit-rows' ) ? athen_get_mod( 'portfolio_archive_grid_style', 'fit-rows' ) : 'fit-rows';
		$columns    = athen_get_mod( 'portfolio_entry_columns', '4' ) ? athen_get_mod( 'portfolio_entry_columns', '4' ) : '4';
		if ( 'fit-rows' == $grid_style && athen_get_mod( 'portfolio_archive_grid_equal_heights' ) && $columns > '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Returns correct classes for the portfolio grid
 *
 * @since   Total 1.5.2
 * @return  string
 */
if ( ! function_exists( 'athen_portfolio_column_class' ) ) {
	function athen_portfolio_column_class( $query ) {
		if ( 'related' == $query ) {
			$columns = athen_get_mod( 'portfolio_related_columns', '4' );
		} else {
			$columns = athen_get_mod( 'portfolio_entry_columns', '4' );
		}
		return athen_grid_class( $columns );
	}
}

/**
 * Returns portfolio featured video url
 *
 * @since   Total 1.5.2
 * @return  string
 */
if ( ! function_exists( 'athen_get_portfolio_featured_video_url' ) ) {
	function athen_get_portfolio_featured_video_url( $post_id = '') {
		if ( function_exists( 'athen_post_video' ) ) {
			return athen_get_post_video( $post_id );
		}
	}
}

/**
 * Displays the portfolio featured video
 *
 * @since   Total 1.5.2
 * @return  html
 */
if ( ! function_exists( 'athen_portfolio_post_video' ) ) {
	function athen_portfolio_post_video( $post_id = '', $video = false ) {
		echo athen_get_portfolio_post_video();
	}
}

/**
 * Displays the portfolio featured video
 *
 * @since   Total 1.5.2
 * @return  html
 */
function athen_get_portfolio_post_video() {

	// Get video URl
	$video = athen_get_post_video_html();

	// Return if no video
	if ( empty( $video ) ) {
		return;
	}

	// Return video
	return '<div class="portfolio-featured-video clr">'. $video .'</div>';

}

/**
 * Gets correct heading for the related blog items
 *
 * @since 2.0.0
 */
function athen_portfolio_related_heading() {

	// Get heading text
	$heading = athen_get_mod( 'portfolio_related_title' );

	// Fallback
	$heading = $heading ? $heading : __( 'Related Projects', 'athen_transl' );

	// Translate heading with WPML
	$heading = athen_translate_theme_mod( 'portfolio_related_title', $heading );

	// Return heading
	return $heading;

}

/**
 * Displays Portfolio Categories For current postid
 *
 * @since Total 1.0
 */
if ( ! function_exists( 'athen_portfolio_cats' ) ) {
	function athen_portfolio_cats( $postid ) {
		$cats = get_the_terms( $postid, 'portfolio_category' );
		if( $cats ) {
			$output = '';
			$output .= '<div class="portfolio-entry-cats clearfix">';
				foreach( $cats as $cat ) {
					$output .= '<a href="'. get_term_link($cat->slug, 'portfolio_category') .'" title="'. $cat->name .'">'. $cat->name .'<span>,</span></a>';
				}
			$output .='</div><!-- .portfolio-entry-cats -->';
			return $output; 
		} else {
			return;
		}
	}
}

/**
 * Displays the first category of a given portfolio
 *
 * @since Total 1.0.0
 */
if ( ! function_exists( 'athen_portfolio_first_cat' ) ) {
	function athen_portfolio_first_cat( $postid=false ) {
		global $post;
		$postid = $postid ? $postid : $post->ID;
		$cats   = get_the_terms( $postid, 'portfolio_category' );
		$output = '';   
		if( $cats ) {
			$count=0;
			foreach( $cats as $cat ) {
				$count++;
				if ( $count == 1 ) {
					$output .= '<a href="'. get_term_link($cat->slug, 'portfolio_category') .'" title="'. $cat->name .'">'. $cat->name .'</a>';
				}
			}
		}
		return $output;
	}
}

/**
 * Output Portfolio terms for use with isotope scripts
 *
 * @since Total 1.0.0
 */
if ( ! function_exists( 'athen_portfolio_entry_terms' ) ) {
	function athen_portfolio_entry_terms() {
		if ( ! post_type_exists( 'portfolio' ) ) {
			return;
		}
		global $post;
		if ( ! $post ) {
			return;
		}
		$output ='';
		$terms = get_the_terms( $post, 'portfolio_category' );
		if( $terms ) {
			$output = '';
			foreach ( $terms as $term ) {
				$output .= $term->slug .' ';
			}
		}
		return $output;
	}
}
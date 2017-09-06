<?php
/**
 * Description : Class use to modify page title to the correct one either it page/archive or post. 
 * 
 * @package     Athen
 * @subpackage  Closer - controller
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

function athen_title() {

	// Default title is null
	$title = NULL;
	
	// Get global object
	$athen_std_theme = athen_global_obj();
	
	// Homepage - display blog description if not a static page
	if ( is_front_page() && ! is_singular( 'page' ) ) {
		
		if ( get_bloginfo( 'description' ) ) {
			$title = get_bloginfo( 'description' );
		} else {
			return __( 'Recent Posts', 'athen_transl' );
		}

	// Homepage posts page
	} elseif ( is_home() && ! is_singular( 'page' ) ) {

		$title = get_the_title( get_option( 'page_for_posts', true ) );

	}

	// Search => NEEDS to go before archives
	elseif ( is_search() ) {
		global $wp_query;
		$title = '<span id="search-results-count">'. $wp_query->found_posts .'</span> '. __( 'Search Results Found', 'athen_transl' );
	}
		
	// Archives
	elseif ( is_archive() ) {

		// Author
		if ( is_author() ) {
			/*$title = sprintf(
				__( 'All posts by%s', 'athen_transl' ),': <span class="vcard">' . get_the_author() . '</span>'
			);*/
			$title = get_the_archive_title();
		}

		// Post Type archive title
		elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		}

		// Daily archive title
		elseif ( is_day() ) {
			$title = sprintf( __( 'Daily Archives: %s', 'athen_transl' ), get_the_date() );
		}

		// Monthly archive title
		elseif ( is_month() ) {
			$title = sprintf( __( 'Monthly Archives: %s', 'athen_transl' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'athen_transl' ) ) );
		}

		// Yearly archive title
		elseif ( is_year() ) {
			$title = sprintf( __( 'Yearly Archives: %s', 'athen_transl' ), get_the_date( _x( 'Y', 'yearly archives date format', 'athen_transl' ) ) );
		}

		// Categories/Tags/Other
		else {

			// Get term title
			$title = single_term_title( '', false );

			// Fix for bbPress and other plugins that are archives but use pages
			if ( ! $title ) {
				global $post;
				$title = get_the_title( $athen_std_theme->post_id );
			}

		}

	} // End is archive check

	// 404 Page
	elseif ( is_404() ) {

		$title = athen_get_mod( 'error_page_title' );
		$title = $title ? $title : __( '404: Page Not Found', 'athen_transl' );
		$title = athen_translate_theme_mod( 'error_page_title', $title );

	}
	
	// Anything else with a post_id defined
	elseif ( $athen_std_theme->post_id ) {

		// Single posts custom text
		if ( is_singular( 'post' ) && 'custom_text' == athen_get_mod( 'blog_single_header', 'custom_text' ) ) {
			$title = athen_get_mod( 'blog_single_header_custom_text', __( 'Blog', 'athen_transl' ) );
		}
		
		// Post title
		else {
			$title = get_the_title( $athen_std_theme->post_id );
		}

	}

	// Backup
	$title = $title ? $title : get_the_title();

	// Apply filters
	$title = apply_filters( 'athen_title', $title );

	// Return title
	return $title;
	
}
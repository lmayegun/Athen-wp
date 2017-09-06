<?php
/**
 * Description : File for creating overlay effect for images. 
 * 
 * @package     Athen
 * @subpackage  Closer - controller
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 */


	/**
	 * Displays the Overlay HTML
	 *
	 * @since Total 1.0.0
	 */
	
	function athen_overlay( $position = 'inside_link', $style = '', $args = array() ) {

		// If style is set to none lets bail
		if ( 'none' == $style ) {
			return;
		}

		// If style not defined get correct style based on theme_mods
		elseif ( ! $style ) {
			$style = athen_overlay_style();
		}

		// If style is defined lets locate and include the overlay template
		if ( $style ) {

			// Load the overlay template
			$overlays_dir	= 'partials/overlays/';
			$template		= $overlays_dir . $style .'.php';
			$template		= locate_template( $template, false );

			// Only load template if it exists
			if ( $template ) {
				include( $template );
			}

		}
	}
	
	/**
	 * Create an array of overlay styles so they can be altered via child themes
	 *
	 * @since Total 1.0.0
	 */

	function athen_overlay_styles_array( $style = NULL ) {
		$array = array(
			''								=> __( 'None', 'athen_transl' ),
			'plus-hover'					=> __( 'Plus Icon Hover', 'athen_transl' ),
			'plus-two-hover'				=> __( 'Plus Icon #2 Hover', 'athen_transl' ),
			'view-lightbox-buttons-buttons'	=> __( 'View/Lightbox Icons Hover', 'athen_transl' ),
			'view-lightbox-buttons-text'	=> __( 'View/Lightbox Text Hover', 'athen_transl' ),
			'title-excerpt-hover'			=> __( 'Title + Excerpt Hover', 'athen_transl' ),
			'title-category-hover'			=> __( 'Title + Category Hover', 'athen_transl' ),
			'title-category-visible'		=> __( 'Title + Category Visible', 'athen_transl' ),
			'title-date-hover'				=> __( 'Title + Date Hover', 'athen_transl' ),
			'title-date-visible'			=> __( 'Title + Date Visible', 'athen_transl' ),
			'slideup-title-white'			=> __( 'Slide-Up Title White', 'athen_transl' ),
			'slideup-title-black'			=> __( 'Slide-Up Title Black', 'athen_transl' ),
		);
		$array = apply_filters( 'athen_overlay_styles_array', $array );
		return $array;
	}
	
	/**
	 * Returns the overlay type depending on your theme options & post type
	 *
	 * @since Total 1.0.0
	 */

	function athen_overlay_style( $style = '' ) {

		// Get style
		$style = $style ? $style : get_post_type();

		// Portfolio
		if ( 'portfolio' == $style ) {
			return athen_get_mod( 'portfolio_entry_overlay_style' );
		}
		
		// Staff
		elseif ( 'staff' == $style ) {
			return athen_get_mod( 'staff_entry_overlay_style' );
		}
	}
	
	/**
	 * Returns the correct overlay Classname
	 *
	 * @since Total 1.0.0
	 */

	function athen_overlay_classes( $style = '' ) {

		// Return if style is set to none
		if ( 'none' == $style ) {
			return;
		}

		// If style is empty get the style
		if ( empty( $style ) ) {
			$style = Athen_Overlay::athen_overlay_style();
		}

		// Return classes
		if ( $style ) {
			return 'overlay-parent overlay-parent-'. $style;
		}
	}	



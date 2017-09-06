<?php
/**
 * Description : Class use to modify toggle bar of theme. 
 * 
 * @package     Athen
 * @subpackage  Closer - controller
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

class Athen_Toggle_Bar{
	
	public function __construct(){
		
	}
	
	/**
	 * Returns the correct togglebar ID
	 *
	 * @since Total 1.0.0
	 */
	public function athen_toggle_bar_content_id() {
		
		// Get toggle bar page content based on ID
		$id = athen_get_mod( 'toggle_bar_page' );

		// Apply filters
		$id	= apply_filters( 'athen_toggle_bar_content_id', $id );

		// Return the ID
		return $id;
	}
	
	/**
	 * Checks if the toggle bar is enabled
	 *
	 * @since	Total 1.0.0
	 * @return	bool
	 */
	public function athen_has_togglebar( $post_id = NULL ) {

		// Get global object
		$athen_std_theme = athen_global_obj();

		// Return if toggle bar page is not defined
		if ( ! $athen_std_theme->toggle_bar_content_id ) {
			return false;
		}

		// Return true by default
		$return = true;

		// Disabled for front-end composer
		if ( athen_is_front_end_composer() ) {
			$return = false;
		}

		// Return false if disabled via the Customizer
		if ( ! athen_get_mod( 'toggle_bar' ) ) {
			$return = false;
		}

		// Return false if disabled via the page settings
		if ( 'enable' == get_post_meta( $post_id, 'athen_disable_toggle_bar', true ) ) {
			$return = true;
		}

		// Return trie if enabled via the page settings
		if ( 'on' == get_post_meta( $post_id, 'athen_disable_toggle_bar', true ) ) {
			$return = false;
		}

		// Apply filters for child theming
		$return = apply_filters( 'athen_toggle_bar_active', $return );

		// Return
		return $return;
	}
	
	/**
	 * Returns correct togglebar classes
	 *
	 * @since Total 1.0.0
	 */
	public static function athen_toggle_bar_classes() {

		// Add default classes
		$classes = array( 'clr' );

		// Add animation classes
		if ( $animation = athen_get_mod( 'toggle_bar_animation', 'fade' ) ) {
			$classes[] = 'toggle-bar-'. $animation;
		}

		// Add visibility classes
		if ( $visibility = athen_get_mod( 'toggle_bar_visibility', 'always-visible' ) ) {
			$classes[] = $visibility;
		}

		// Apply filters for child theming
		$classes = apply_filters( 'athen_toggle_bar_active', $classes );

		// Turn classes into space seperated string
		$classes = implode( ' ', $classes );

		// Return classes
		return $classes;

	}	
}
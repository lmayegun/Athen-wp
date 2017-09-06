<?php
/**
 * Main footer functions
 * 
 * Descripting : Class that help in modification of fonts 
 * 
 * @package     Athen
 * @subpackage  Closer - Controller 
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependent : http://codex.wordpress.org/Template_Hierarchy
 */

 class Athen_Footer{
	
	public function __construct(){}
	
	
	/**
	 * Conditional check if the footer should display or not
	 *
	 * @since	Total 1.0
	 * @return	bool
	 */
	function athen_has_footer( $post_id = '' ) {

		// Return true by default
		$return		= true;

		// Disabled on landing page
		if ( is_page_template( 'templates/landing-page.php' ) ) {
			$return = false;
		}

		// Check if disabled via page settings
		if ( 'on' == get_post_meta( $post_id, 'athen_disable_footer', true ) ) {
			$return = false;
		}

		// Check if enabled via page settings
		if ( 'enable' == get_post_meta( $post_id, 'athen_disable_footer', true ) ) {
			$return = true;
		}

		// Apply filters
		$return = apply_filters( 'athen_display_footer', $return );

		// Return
		return $return;

	}
	
	/**
	 * Conditional check if the footer widgets should display or not
	 *
	 * @since	Total 1.54
	 * @return	bool
	 */
	function athen_has_footer_widgets( $post_id = '' ) {

		// Check if enabled via the customizer
		$return = athen_get_mod( 'footer_widgets', true );

		// Check if disabled via page settings
		if ( 'on' == get_post_meta( $post_id, 'athen_disable_footer_widgets', true ) ) {
			$return = false;
		}

		// Check if enabled via page settings
		if ( 'enable' == get_post_meta( $post_id, 'athen_disable_footer_widgets', true ) ) {
			$return = true;
		}

		// Apply filters for child theming
		$return = apply_filters( 'athen_display_footer_widgets', $return );

		// Return bool
		return $return;

	}
	
	/**
	 * Conditional check if the footer reveal is enabled
	 *
	 * @since	Total 1.0
	 * @return	bool
	 */
	function athen_has_footer_reveal() {

		// Global object
		$athen_std_theme = athen_global_obj();

		// Disabled by default
		$return = false;

		// Theme option check
		if ( athen_get_mod( 'footer_reveal', false ) ) {
			$return = true;
		}

		// Meta check
		if ( $athen_std_theme->post_id ) {
			if ( 'on' == get_post_meta( $athen_std_theme->post_id, 'athen_footer_reveal', true ) ) {
				$return = true;
			} elseif ( 'off' == get_post_meta( $athen_std_theme->post_id, 'athen_footer_reveal', true ) ) {
				$return = false;
			}
		}

		// Disable on 404
		if ( is_404() ) {
			$return = false;
		}

		// Apply filters
		$return = apply_filters( 'athen_has_footer_reveal', $return );

		// Disable on boxed style - ALWAYS
		if ( 'boxed' == $athen_std_theme->main_layout ) {
			$return = false;
		}

		// Return
		return $return;
	}
    
	public static function athen_footer_classes() {

		// Get global object
		$obj = athen_global_obj();

		// Apply filters
		apply_filters( 'athen_footer_classes', $classes );
        
        $classes[] = "footer-main";
        
        if(athen_get_mod('athen_bootstrap_container', true)){
            $classes []= 'container';
        }elseif (athen_get_mod('athen_footer_main_container')) {
            $classes []= 'container';
        }

		// Turn into comma seperated list
		$classes = implode( ' ', $classes );

		// Return classes
		return $classes;
	}
}

<?php
/**
 * Description : Class use to modify top bar functions for the theme 
 * 
 * @package     Athen
 * @subpackage  Closer - controller
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

 class Athen_Header_Top{
	 
	public function __construct(){
		

	}
	
	/**
	 * Checks if the top bar should display or not
	 *
	 * @since	1.6.0
	 * @return	bool
	 */
	public function athen_has_top_bar( $post_id = '' ) {

		// Return true by default
		$return = false;
		
		// Get Global Object
		$obj = athen_global_obj();

		// Return false if disabled via Customizer
		if ( athen_get_mod( 'enable_topbar' ) ) {
			$return = true;
		}
        /*
		// Return false if disabled via post meta
		if ( 'on' == get_post_meta( $post_id, 'athen_disable_top_bar', true ) ) {
			$return = false;
		}

		// Return false if disabled via post meta
		if ( 'enable' == get_post_meta( $post_id, 'athen_disable_top_bar', true ) ) {
			$return = true;
		}
         
        */
		// Apply filers for child theming
		$return = apply_filters( 'athen_is_top_bar_enabled', $return );
        
		// Return bool
		return $return;
	}
	
	/**
	 * Topbar content
	 *
	 * @since 2.0.0
	 */
	public static function athen_header_top_content() {

		// Get topbar content from Customizer
		$content = athen_get_mod( 'athen_headertop_aside_content', '[font_awesome icon="phone" margin_right="5px"] 1-800-987-654 [font_awesome icon="envelope" margin_right="5px" margin_left="20px"] admin@total.com [font_awesome icon="user" margin_right="5px" margin_left="20px" ] [wp_login_url text="User Login" logout_text="Logout"]' );

		// Translate the content
		$content = athen_translate_theme_mod( 'athen_headertop_aside_content', $content );

		// Apply filters
		$content = apply_filters( 'athen_header_top_content', $content );

		// Return content
		return $content;
	}
	
	/*-------- Sticky Topbar
	* @since 1.0.0
	* @return : boolean
	* @reminder : include option in post_metabox on version 2
	*/
	public function athen_enable_sticky_topheader(){
		
		// Set a checker variable 
		$return = true;
		
		// Check if option is enable
		if ( ! athen_get_mod( 'athen_headertop_sticky', true ) ){
			$return = false;
		}
		
		return $return;
	}
    
    /**
	 * Returns header logo img url
	 *
	 * @since Total 1.5.3
	 */
	public static function athen_header_top_logo_img() {

		// Get logo img from admin panel
		$logo = athen_get_mod( 'athen_headertop_custom_logo' );

		// WPML translation
		$logo = athen_translate_theme_mod( 'athen_headertop_custom_logo', $logo );

		// Apply filter for child theming
		$logo = apply_filters( 'athen_header_top_logo_img_url', $logo );

		// Sanitize URL
		$logo = esc_url( $logo );
		
		// Return logo
		return $logo;
	}
    
    	/**
	 * Topbar classes
	 *
	 * @since 2.0.0
	 */
	public static function athen_header_top_classes( $part ) {

		$athen_std_theme = athen_global_obj();
        
        $header_style = $athen_std_theme->header_style;
        
        // Add clearfix class
		$classes[] = 'clr';
        
        if( $part == 'wrap' ){
            // Default Class
            $classes[] = 'header-top';

            // Get topbar style
            $classes[] = ATHEN_NAME_THEME . '-header-top';

            // Get header style
            $classes[] = 'header-'.$header_style;
        }
        
        if( $part == 'row' ){
            if(athen_get_mod('athen_bootstrap_container', true)){
                $classes[] = 'container';
            }elseif ( athen_get_mod('athen_header_top_container')) {
                $classes[] = 'container';
            }
        }
		// Apply filters for child theming
		$classes = apply_filters( 'athen_top_bar_classes', $classes );

		// Turn classes array into space seperated string
		$classes = implode( ' ', $classes );

		// Return classes
		return esc_attr( $classes );
	}
}

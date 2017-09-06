<?php
/**
 * Description : Class use to modify sharing function in content area. especially achives and single pages 
 * 
 * @package     Athen
 * @subpackage  Closer - controller
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

class Athen_Social_Share{
	
	public function __construct(){
		
	}
	
	/**
	 * Returns social sharing template part
	 *
	 * @since   2.0.0
	 * @return  array
	 */
	public static function athen_social_share_sites() {
		$defs  = array( 'twitter', 'facebook', 'google_plus', 'pinterest', 'linkedin' );
		$sites = athen_get_mod( 'social_share_sites', $defs );
		$sites = apply_filters( 'athen_social_share_sites', $sites );
		if ( $sites && ! is_array( $sites ) ) {
			$sites  = explode( ',', $sites );
		}
		return $sites;
	}
	
	/**
	 * Checks if current page has social share
	 *
	 * @since 2.0.0
	 */
	public function athen_has_social_share( $post_id = '' ) {

		// Return false by default
		$return = true;

		// Check page settings first to overrides theme mods and filters
		if ( $meta = get_post_meta( $post_id, 'athen_disable_social', true ) ) {

			// Check if disabled by meta options
			if ( 'on' == $meta ) {
				return false;
			}

			// Return true if enabled via meta option
			if ( 'enable' == $meta ) {
				return true;
			}

		}

		// Page check
		if ( is_page() ) {
			if ( athen_get_mod( 'social_share_pages' ) ) {
				$return = true;
			}
		}

		// Check if enabled on single blog posts
		elseif ( is_singular( 'post' ) ) {
			if ( athen_get_mod( 'blog_social_share', true ) ) {
				$return = true;
			}
		}

		// Check if enabled for blog entries
		elseif ( ! is_singular() && 'post' == get_post_type( $post_id ) && athen_get_mod( 'social_share_blog_entries' ) ) {
			$return = true;
		}

		// Apply filters
		$return = apply_filters( 'athen_has_social_share', $return );

		// Return
		return $return;

	}
	
	/**
	 * Returns correct social share position
	 *
	 * @since 2.0.0
	 */
	public static function athen_social_share_position() {

		// Get option from Customizer
		$position = athen_get_mod( 'social_share_position' );

		// Sanitize
		$position = $position ? $position : 'horizontal';

		// Apply filters
		$position = apply_filters( 'athen_social_share_position', $position );

		// Return positon
		return $position;

	}
	
	/**
	 * Returns correct social share style
	 *
	 * @since 2.0.0
	 */
	public static function athen_social_share_style() {

		// Get option from Customizer
		$style = athen_get_mod( 'social_share_style' );

		// Sanitize
		$style = $style ? $style : 'minimal';

		// Apply filters
		$style = apply_filters( 'athen_social_share_position', $style );

		// Return style
		return $style;
	}
    
    /**
     * Return Social Share Animation 
     */
    public static function athen_social_share_animation(){
        
        // Get option from customizer
        $animation = athen_get_mod('athen_social_share_animation');
        
        // Sanitize
        $animation = $animation ? $animation : 'static';
        
        // Apply filter
        $animation = apply_filters( 'athen_social_share_animation', $animation);
        
        // Return animation 
        return $animation;
        
    }
	
	/**
	 * Returns the social share heading
	 *
	 * @since 2.0.0
	 */
	public static function athen_social_share_heading() {

		// Get heading from customizer setting
		$heading = athen_get_mod( 'social_share_heading' );

		// Sanitize to make sure heading isn't empty
		$heading = $heading ? $heading : __( 'Share Post', 'athen_transl' );

		// Translate heading for WPML and Polylang
		$heading = athen_translate_theme_mod( 'social_share_heading', $heading );

		// Apply filters for child theming
		$heading = apply_filters( 'athen_social_share_heading', $heading );

		// Return heading
		return $heading;
	}
}

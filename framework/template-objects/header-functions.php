<?php
/**
 * Site Header Helper Functions
 *
 * Description : Class that help modify header of theme and function . 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependent : http://codex.wordpress.org/Template_Hierarchy
 */
class Athen_Header {
	
	public function __construct(){
		
		add_action( 'wp_head', array(&$this,'athen_retina_logo') );
		
	}
	
	/**
	 * Whether the header should display or not.
	 * Used by the global $athen_std_theme object.
	 *
	 * @since   Total 1.5.3
	 * @return  bool
	 */
	public function athen_has_header( $post_id = '' ) {

		// Return true by default
		$return = true;

		// Check if disabled via meta option
		if ( 'on' == get_post_meta( $post_id, 'athen_disable_header', true ) ) {
			$return = false;
		}

		// Apply filter for child theming
		$return = apply_filters( 'athen_display_header', $return );

		// Return
		return $return;
	}


	/**
	 * Check if the fixed header is enabled
	 *
	 * @since   2.0.0
	 * @return  bool
	 */
	public function athen_has_fixed_header() {

		// Disable on front-end builder
		if ( athen_is_front_end_composer() ) {
			$return = false;
		} elseif ( athen_get_mod( 'fixed_header', true ) ) {
			$return = true;
		} else {
			$return = false;
		}

		// Apply filters
		$return = apply_filters( 'athen_has_fixed_header', $return );

		// Return
		return $return;

	}

	/**
	 * Get correct header style
	 *
	 * @since   Total 1.5.3
	 * @return  bool
	 */
	public function athen_get_header_style( $post_id = '' ) {

		// Check URL
		if ( ! empty( $_GET['header_style'] ) ) {
			return $_GET['header_style'];
		}

		// Get global object
		$athen_std_theme = athen_global_obj();

		// Get header style from customizer setting
		$style = athen_get_mod( 'header_style', 'one' );

		// Check for custom header style defined in meta options
		if ( $meta = get_post_meta( $post_id, 'athen_header_style', true ) ) {
			$style = $meta;
		}

		// Return header style one if Header Overlay enabled
		if ( $athen_std_theme->has_overlay_header ) {
			$style = 'one';
		}

		// Sanitize style to make sure it isn't empty
		if ( empty( $style ) ) {
			$style = 'one';
		}

		// Apply filters for child theming
		$style = apply_filters( 'athen_header_style', $style );

		// Return style
		return $style;

	}

	/**
	 * Check if the header overlay style is enabled
	 *
	 * @since   Total 1.5.3
	 * @return  bool
	 */
	public function athen_has_header_overlay( $post_id = '' ) {
		
		// Return false by default
		$return = false;

		// Return true if enabled via the post meta
		if ( $post_id && 'on' == get_post_meta( $post_id, 'athen_overlay_header', true ) ) {
			$return = true;
		}

		// Apply filters for child theming
		$return = apply_filters( 'athen_has_header_overlay', $return );

		// Return false if not enabled
		return $return;

	}

	/**
	 * Returns page header overlay logo
	 *
	 * @since   2.0.0
	 * @return  string
	 */
	public static function athen_header_overlay_logo() {

		// Get global object
		$athen_std_theme = athen_global_obj();

		// Return false if disabled
		if ( ! $athen_std_theme->has_overlay_header ) {
			return false;
		}

		// No custom overlay logo by default
		$logo = false;

		// Get logo via custom field
		$logo = get_post_meta( $athen_std_theme->post_id, 'athen_overlay_header_logo', true );

		// Check old method
		if ( is_array( $logo ) ) {
			if ( ! empty( $logo['url'] ) ) {
				$logo = $logo['url'];
			} else {
				$logo = false;
			}
		}

		// Apply filters for child theming
		$logo = apply_filters( 'athen_header_overlay_logo', $logo );

		// Sanitize URL
		if ( is_numeric( $logo ) ) {
			$logo = wp_get_attachment_image_src( $logo, 'full' );
			$logo = $logo[0];
		} else {
			$logo = esc_url( $logo );
		}

		// Return logo
		return $logo;

	}


	/**
	 * Add classes to the header wrap
	 *
	 * @since   Total 1.5.3
	 * @return  string
	 */
	public static function athen_header_classes( $part ) {
		
		// Get global object
		$athen_std_theme = athen_global_obj();
		
		// Get Header Style 
		$header_style 	= $athen_std_theme->header_style;

		// Setup classes array
		$classes = array();
		
		if ( $part == "header-outer" ){

			// Clearfix class
			$classes['clr'] = 'clr';

			// Main header style
			$classes['header_style'] = 'header-'. $athen_std_theme->header_style;

			// Sticky Header
			if ( $athen_std_theme->has_fixed_header && 'one' == $athen_std_theme->header_style ) {
				$classes['fixed_scroll'] = 'fixed-scroll';
			}

			// Header Overlay Style
			if ( $athen_std_theme->has_overlay_header ) {

				// Remove fixed scroll class
				//unset( $classes['fixed_scroll'] );

				// Add overlay header class
				$classes['overlay_header'] = 'overlay-header';

				// Add a fixed class for the overlay-header style only
				if ( $athen_std_theme->has_fixed_header ) {
					$classes['fix_on_scroll'] = 'fix-overlay-header';
				}

				// Add overlay header class
				$classes['overlay_header'] = 'overlay-header';

				// Add overlay header style class
				$overlay_style                      = $athen_std_theme->header_overlay_style;
				$overlay_style                      = $overlay_style ? $overlay_style : 'light';
				$classes['overlay_header_style']    = $overlay_style .'-style';

			}
		}
		
		if ( $part == "header-main" ){
			
			$classes['header-inner-style'] = 'header-main';
			$classes['clear'] = 'clr';
			
            if(athen_get_mod('athen_bootstrap_container', true)){
                $classes['container'] = 'container'; 
            }elseif (athen_get_mod('athen_header_main_container')) {
                $classes['container'] = 'container'; 
            }
		}
		

		if ( $part == "header-top" ){
			
			//Add class selector topbar 
			$classes['header-topbar'] = 'header-top';
			
		}

		// Set keys equal to vals
		$classes = array_combine( $classes, $classes );
		
		// Apply filters for child theming
		$classes = apply_filters( 'athen_header_classes', $classes );

		// Turn classes into space seperated string
		$classes = implode( ' ', $classes );

		// return classes
		return $classes;
	}
    
    	/**
	 * Topbar classes
	 *
	 * @since 2.0.0
	 */
	public static function athen_header_bottom_classes() {

		$athen_std_theme = athen_global_obj();
        
        $header_style = $athen_std_theme->header_style;
        
        // Add clearfix class
		$classes[] = 'clr';
       
        // Default Class
        $classes[] = 'header-bottom';
        
        // Get topbar style
		$classes[] = ATHEN_NAME_THEME . '-header-bottom';
        
        // Get header style
        $classes[] = 'header-'.$header_style;
        
        // Boostrap container
        if(athen_get_mod('athen_bootstrap_container', true)){
            $classes[] = 'container';
        }elseif (athen_get_mod('athen_header_bottom_container')) {
            $classes[] = 'container';
        }
        
		// Apply filters for child theming
		$classes = apply_filters( 'athen_header_bottom_classes', $classes );

		// Turn classes array into space seperated string
		$classes = implode( ' ', $classes );

		// Return classes
		return esc_attr( $classes );
	}


	/**
	 * Returns header logo img url
	 *
	 * @since Total 1.5.3
	 */
	public static function athen_header_logo_img() {

		// Get logo img from admin panel
		$logo = athen_get_mod( 'custom_logo' );

		// WPML translation
		$logo = athen_translate_theme_mod( 'custom_logo', $logo );

		// Apply filter for child theming
		$logo = apply_filters( 'athen_header_logo_img_url', $logo );

		// Sanitize URL
		$logo = esc_url( $logo );
		
		// Return logo
		return $logo;

	}


	/**
	 * Returns header logo icon
	 *
	 * @since 2.0.0
	 */
	public static function athen_header_logo_icon() {

		// Get logo img from admin panel
		$icon = athen_get_mod( 'logo_icon' );

		// Apply filter for child theming
		$icon = apply_filters( 'athen_header_logo_icon', $icon );

		// Return icon
		if ( $icon && 'none' != $icon ) {
			return '<span class="fa fa-'. $icon .'"></span>';
		} else {
			return NULL;
		}
	}


	/**
	 * Returns header logo title
	 *
	 * @since 2.0.0
	 */
	public static function athen_header_logo_title() {
		$title  = get_bloginfo( 'name' );
		$title  = apply_filters( 'athen_logo_title', $title );
		return $title;
	}

	/**
	 * Returns header logo URL
	 *
	 * @since 2.0.0
	 */
	public static function athen_header_logo_url() {
		$url    = esc_url( home_url( '/' ) );
		$url    = apply_filters( 'athen_logo_url', $url );
		return $url;
	}

	/**
	 * Header logo classes
	 *
	 * @since 2.0.0
	 */
	public static function athen_header_logo_classes() {

		// Define classes array
		$classes = array( 'site-branding' );

		// Get global object
		$athen_std_theme = athen_global_obj();

		// Default class
		$classes[] = 'header-'. $athen_std_theme->header_style .'-logo';

		// Get custom overlay logo
		if ( $athen_std_theme->has_overlay_header && athen_header_overlay_logo() ) {
			$classes[] = 'has-overlay-logo';
		}

		// Apply filters for child theming
		$classes = apply_filters( 'athen_header_logo_classes', $classes );

		// Turn classes into space seperated string
		$classes = implode( ' ', $classes );

		// Return classes
		return $classes;

	}

	/**
	 * Returns fixed header logo
	 *
	 * @since Total 1.7.0
	 */
	function athen_fixed_header_logo( $post_id ) {

		// Get custom logo from Customizer
		$logo = athen_get_mod( 'fixed_header_logo' );

		// Apply filters for child theming
		apply_filters( 'athen_fixed_header_logo', $logo );

		// Return logo
		return $logo;
	}

	/**
	 * Return Header Content 
	 *
	 * @Since Total 1.0.0
	**/

	public static function athen_header_aside_mod () {
		
		// Get Global Object
		$obj = athen_global_obj();
		
		// Organize Shortcode Variable 
		$shortcode = '[font_awesome icon="mobile" ] + 097 637 293 [font_awesome icon="envelope" ] info@youremail.com';
		
		// Construct output 
		if ($obj->header_style == 'one'){
			$content = athen_get_mod ('header_aside', $shortcode );
			
		}
		return $content;
	}

	/**
	 * Adds js for the retina logo
	 *
	 * @since Total 1.1.0
	 */
	function athen_retina_logo() {

		// Get theme options
		$logo_url       = athen_get_mod( 'retina_logo' );
		$logo_height    = athen_get_mod( 'retina_logo_height' );

		// WPML translation
		$logo_url       = athen_translate_theme_mod( 'retina_logo', $logo_url );
		$logo_height    = athen_translate_theme_mod( 'retina_logo_height', $logo_height );

		// Output JS for retina logo
		if ( $logo_url && $logo_height ) {
			$output = '<!-- Retina Logo --><script type="text/javascript">jQuery(function($){if (window.devicePixelRatio >= 2) {$("#site-logo img").attr("src", "'. $logo_url .'");$("#site-logo img").css("max-height", "'. intval( $logo_height ) .'px");}});</script>';
			echo $output;
		}
	}
}



<?php
/**
 * Description : Construct classes that will be added to body tag on browser. 
 * 
 * @package     Athen
 * @subpackage  Closer - controller
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Associated : HTML browser body tag. 
 */

class Athen_Body_Style{
	
	public function __construct(){
		
		add_filter( 'body_class', array(&$this, 'athen_body_classes') );
		
	}
	
	function athen_body_classes( $classes ) {
		
		// Get global object
		$obj = athen_global_obj();
		
		/*--- Closer Class ---*/
		$classes[] = 'Closer-theme';
		
		/*--- Header Type ---*/
		if ( $obj->header_style ){
			$classes[] = 'using-header-'.$obj->header_style;
		}
		
		// Responsive
		if ( $obj->responsive ) {
			$classes[] = 'athen-responsive';
		}

		// Layout Style
		$classes[] = 'athen-'. $obj->main_layout;
		
		// Add skin to body classes
		$classes[] = 'skin-'. $obj->skin;

		// Check if the Visual Composer is being used on this page
		if ( $obj->has_composer ) {
			$classes[] = 'has-composer';
		} else {
			$classes[] = 'no-composer';
		}
		
		// Boxed Layout dropshadow
		if( 'layout-three' == $obj->main_layout && athen_get_mod( 'boxed_dropdshadow' ) ) {
			$classes[] = 'alt-dropshadow';
		}

		// Content layout
		if ( $obj->post_layout ) {
			$classes[] = 'athen-content-layout-'. $obj->post_layout;
		}

		// Single Post cagegories
		if ( is_singular( 'post' ) ) {
			$cats = get_the_category( $obj->post_id );
			foreach ( $cats as $cat ) {
				$classes[] = 'post-in-category-'. $cat->category_nicename;
			}
		}

		// Breadcrumbs
		if ( $obj->has_breadcrumbs && 'default' == athen_get_mod( 'breadcrumbs_position', 'default' ) ) {
			$classes[] = 'has-breadcrumbs';
		}

		// Shrink fixed header
		if ( $obj->has_fixed_header && 'one' == $obj->header_style && $obj->shrink_fixed_header ) {
			$classes[] = 'shrink-fixed-header';
		}

		// Topbar
		if ( $obj->has_top_bar ) {
			$classes[] = 'has-topbar';
		}

		// Widget Icons
		if ( athen_get_mod( 'has_widget_icons', true ) ) {
			$classes[] = 'sidebar-widget-icons';
		}

		// Overlay header style
		if ( $obj->has_overlay_header ) {
			$classes[] = 'has-overlay-header';
		}

		// Footer reveal
		if ( $obj->has_footer_reveal ) {
			$classes[] = 'footer-has-reveal';
		}

		// Slider
		if ( $obj->has_post_slider ) {
			$classes[] = 'page-with-slider';
		}

		// No header margin
		if ( 'on' == get_post_meta( $obj->post_id, 'athen_disable_header_margin', true ) ) {
			$classes[] = 'no-header-margin';
		}

		// Title with Background Image
		if ( 'background-image' == $obj->page_header_style ) {
			$classes[] = 'page-with-background-title';
		}

		// Disabled header
		if ( ! $obj->has_page_header ) {
			$classes[] = 'page-header-disabled';
		}

		// Page slider
		if ( $obj->has_post_slider && $slider_position = Athen_Post_Slider::athen_post_slider_position( $obj->post_id ) ) {
			$classes[] = 'has-post-slider';
			$slider_position = str_replace( '_', '-', $slider_position );
			$classes[] = 'post-slider-'. $slider_position;
		}

		// Font smoothing
		if ( athen_get_mod( 'enable_font_smoothing' ) ) {
			$classes[] = 'smooth-fonts';
		}

		// Mobile menu style
		if ( 'disabled' == $obj->mobile_menu_style ) {
			$classes[] = 'mobile-menu-disabled';
		} else {
			 $classes[] = 'has-mobile-menu';
		}
		
		// Return classes
		return $classes;

	}
}

new Athen_Body_Style();
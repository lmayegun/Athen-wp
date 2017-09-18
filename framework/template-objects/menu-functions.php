<?php
/**
 * Description  : File for modifying navbar menu function 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 */
 
 
class Athen_Menu {
	
	public function __construct(){
		
		 add_filter( 'wp_nav_menu_items', array(&$this, 'mobile_menu_bars'), 9, 2 ); 
		 
	}

	/**
	 * Returns correct menu classes
	 *
	 * @since 2.0.0
	 */
	public static function athen_header_menu_classes( $return ) {

		// Define classes array
		$classes = array();

		// Get global object
		$athen_std_theme = athen_global_obj();

		// Get data
		$header_style   = athen_get_mod('athen_menu_style', 'one');
		$header_height  = absint( athen_get_mod( 'header_height' ) );
		$woo_icon       = athen_get_mod( 'woo_menu_icon', true );

		// Return wrapper classes
		if ( 'wrapper' == $return ) {

			// Add clearfix
			$classes[] = 'clr';
			
			// SASS Categorizer 
			$classes[] = 'navbar';
			
			// Add Header Style to wrapper
			$classes[] = 'navbar-style-'. $header_style;

			// Add the fixed-nav class if the fixed header option is enabled
			if ( 'one' != $header_style && 'three' != $header_style && athen_get_mod( 'fixed_header', true ) ){
				$classes[] = 'fixed-nav';
			}

			// Add fixed height class if it's header style one and a header height is defined in the admin
			if ( 'one' == $header_style && $header_height && '0' != $header_height && 'auto' != $header_height ) {
				$classes[] = 'nav-custom-height';
			}

			// Add special class if the dropdown top border option in the admin is enabled
			if ( athen_get_mod( 'menu_dropdown_top_border' ) ) {
				$classes[] = 'nav-dropdown-top-border';
			}

			// Set keys equal to vals
			$classes = array_combine( $classes, $classes );

			// Apply filters
			$classes = apply_filters( 'athen_header_menu_wrap_classes', $classes );

		}

		// Inner Classes
		elseif ( 'inner' == $return ) {

			// Core
			$classes[] = 'navigation';
			$classes[] = 'main-navigation';
			$classes[] = 'clr';

			// Add the container div for specific header styles
			if ( in_array( $header_style, array( 'four' ) ) ) {
				$classes[] = 'container';
			}

			// Add classes if the search setting is enabled
			if ( Athen_Search_func::athen_search_in_menu() ) {
				$classes[] = 'has-search-icon';
				if ( ATHEN_CHECK_WOOCOMMERCE && $woo_icon ) {
					$classes[] = 'has-cart-icon';
				}
			}

			// Set keys equal to vals
			$classes = array_combine( $classes, $classes );

			// Apply filters
			$classes = apply_filters( 'athen_header_menu_classes', $classes );

		}

		// Return
		if ( is_array( $classes ) ) {
			return implode( ' ', $classes );
		} else {
			return $return;
		}
	}
	
	
	/**
	 * Checks for custom menus.
	 *
	 * @since Total 1.3.0
	 */
	public static function athen_custom_menu( $menu = '' ) {

		// Get global object
		$athen_std_theme = athen_global_obj();

		// Get post ID
		$post_id = $athen_std_theme->post_id;

		// Check for custom menu
		if ( $post_id ) {
			$meta = get_post_meta( $post_id, 'athen_custom_menu', true );
			if ( $meta && 'default' != $meta ) {
				$menu = $meta;
			}
		}

		// Return custom menu
		return apply_filters( 'athen_custom_menu', $menu );
	}
	
	/**
	 * Display Mobile Menu Bars
	 *
	 * @since Athen 1.1.0
	 **/
	 function mobile_menu_bars( $items , $args ){
		
         $menu_location = athen_get_mod('athen_mobile_menu_icon', 'topbar_menu');
         
		// Check if Mobile Menu is 'Main'
		if(athen_get_mod('athen_menu_bar', true)){
            // Update Class Base on Header Syle
			$items .= '<li class="mobile-icon">';
				$items .= '<a href="#mobile-menu" class="mobile-menu-toggle" >';
					$items .= '<span class="fa fa-bars">';
					$items .= '</span>';
				$items .= '</a>';
			$items .= '</li>';
        }
	
		// Return HTML 
		return $items; 
	}
	 
	/**
	 * Get Mega Menu Column Width 
	 *
	 * @Return Integer 
	 * @Since Athen 1.0.0
	**/
	function athen_mega_menu_width() {
			
		// Get Value From 'theme_mod'
		$width = athen_get_mod( 'mega_menu_width', 280); 
			
		// Hook For Child Theme 
		$width = apply_filters( 'athen_mega_menu_width', $width );
			
		// Return Integer 
		return $width;	
	}
	
	/**
	 * Returns correct mobile menu style
	 *
	 * @since   Total 1.3.3
	 * @return  string
	 */
	function athen_mobile_menu_style() {

		// Get global object
		$athen_std_theme = athen_global_obj();

		// Get style defined in Customizer
		$style = athen_get_mod( 'mobile_menu_style', 'sidr' );

		// Sanitize
		$style = $style ? $style : 'sidr';

		// Disable if responsive is disabled
		$style = $athen_std_theme->responsive ? $style : 'disabled';

		// Apply filters
		$style = apply_filters( 'athen_mobile_menu_style', $style );

		// Return
		return $style;

	}
	
	/**
	 * The source for the sidr mobile menu
	 *
	 * @since   Total 1.5.1
	 * @return  string
	 */
	function athen_mobile_menu_source() {

		// Define array of items
		$items = array();

		// Add close button
		//$items['sidrclose'] = '#sidr-close';

		// Add mobile menu alternative if defined
		if ( has_nav_menu( 'mobile_menu_alt' ) ) {
			$items['nav'] = '#mobile-menu-alternative';
		}

		// If mobile menu alternative is not defined add main navigation
		else {
			$items['nav'] = '#site-navigation';
		}

		// Add search form
		$items['search'] = '#mobile-menu-search';

		// Apply filters for child theming
		$items = apply_filters( 'athen_mobile_menu_source', $items );

		// Turn items into comma seperated list
		$items = implode( ', ', $items );

		// Return items
		return $items;
	}
}
 



/**
 * Custom menu walker
 *
 * @since Total 1.3.0
 */
if ( ! class_exists( 'WPEX_Dropdown_Walker_Nav_Menu' ) ) {
    class WPEX_Dropdown_Walker_Nav_Menu extends Walker_Nav_Menu {
        function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

            // Get field ID
            $id_field = $this->db_fields['id'];
		
            // Down Arrows
            if ( ! empty( $children_elements[$element->$id_field] ) && ( $depth == 0 ) ) {
                $element->classes[] = 'dropdown';
                if ( athen_get_mod( 'menu_arrow_down', true ) ) {
                    $element->title .= ' <span class="nav-arrow fa fa-angle-down"></span>';
                }
            }

            // Right/Left Arrows
            if ( ! empty( $children_elements[$element->$id_field] ) && ( $depth > 0 ) ) {
                $element->classes[] = 'dropdown';
                if ( athen_get_mod( 'menu_arrow_side', true ) ) {
                    if ( is_rtl() ) {
                        $element->title .= '<span class="nav-arrow fa fa-angle-left"></span>';
                    } else {
                        $element->title .= '<span class="nav-arrow fa fa-angle-right"></span>';
                    }
                }
            }

            // Define walker
            Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
        }
		
		function start_el(&$output, $item, $depth = 0, $args=array(), $id = 0) {
			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			
			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="' . esc_attr( $class_names ) . '"';

			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

			$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
			$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '<br /><span class="sub">' . $item->description . '</span>';
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
    }
}

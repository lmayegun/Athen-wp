<?php
/**
 * Used for custom site backgrounds
 *
 * @package     Total
 * @subpackage  Framework
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'WPEX_Site_Backgrounds' ) ) {
	
	class WPEX_Site_Backgrounds {

		/**
		 * Main constructor
		 *
		 * @since 2.0.0
		 */
		function __construct() {
			add_filter( 'init', array( &$this, 'init' ) );
		}

		/**
		 * Add custom CSS to athen_head_css hook
		 * Hooked into init to prevent bug with the Customizer
		 *
		 * @since 2.0.0
		 */
		public function init() {
			add_filter( 'athen_head_css', array( &$this, 'get_css' ), 999 );
		}

		/**
		 * Generates the CSS output
		 *
		 * @since 2.0.0
		 */
		public function get_css( $output ) {

			// Get global object
			$athen_std_theme = athen_global_obj();

			// Vars
			$css = $add_css = '';

			// Global vars
			$css     = '';
			$color   = athen_get_mod( 'background_color' );
			$image   = athen_get_mod( 'background_image' );
			$style   = athen_get_mod( 'background_style' );
			$pattern = athen_get_mod( 'background_pattern' );
			$post_id = $athen_std_theme->post_id;

			// Single post vars
			if ( $post_id ) {

				// Color
				$single_color = get_post_meta( $post_id, 'athen_page_background_color', true );
				$single_color = str_replace( '#', '', $single_color );

				// Image
				$single_image = get_post_meta( $post_id, 'athen_page_background_image_redux', true );
				if ( $single_image ) {
					if ( is_array( $single_image ) ) {
						$single_image = ( ! empty( $single_image['url'] ) ) ? $single_image['url'] : '';
					} else {
						$single_image = $single_image;
					}
				} else {
					$single_image = get_post_meta( $post_id, 'athen_page_background_image', true );
				}

				// Background style
				$single_style = get_post_meta( $post_id, 'athen_page_background_image_style', true );

			}

			/*-----------------------------------------------------------------------------------*/
			/*  - Sanitize Data
			/*-----------------------------------------------------------------------------------*/

			// Color
			$color  = ! empty( $single_color ) ? $single_color : $color;
			$color  = str_replace( '#', '', $color );

			// Image
			$image  = ! empty( $single_image ) ? $single_image : $image;

			// Check if image is a URL or an ID
			if ( is_numeric( $image ) ) {
				$image = wp_get_attachment_image_src( $image, 'full' );
				$image = $image[0];
			}

			// Style
			$style  = ( ! empty( $single_image ) && ! empty( $single_style ) ) ? $single_style : $style;
			$style  = $style ? $style : 'stretched';

			/*-----------------------------------------------------------------------------------*/
			/*  - Generate CSS
			/*-----------------------------------------------------------------------------------*/

			// Color
			if ( $color ) {
				$css .= 'background-color:#'. $color .'!important;';
			}
			
			// Image
			if ( $image && ! $pattern ) {
				$css .= 'background-image:url('. $image .');';
				if ( $style == 'stretched' ) {
					$css .= '-webkit-background-size: cover;
							-moz-background-size: cover;
							-o-background-size: cover;
							background-size: cover;
							background-position: center center;
							background-attachment: fixed;
							background-repeat: no-repeat;';
				}
				elseif ( $style == 'repeat' ) {
					$css .= 'background-repeat:repeat;';
				}
				elseif ( $style == 'fixed' ) {
					$css .= 'background-repeat: no-repeat;
							background-position: center center;
							background-attachment: fixed;';
				}
			}
			
			// Pattern
			if ( $pattern ) {
				$css .= 'background-image:url('. $pattern .'); background-repeat:repeat;';
			}

			/*-----------------------------------------------------------------------------------*/
			/*  - Return $css
			/*-----------------------------------------------------------------------------------*/
			if ( ! empty( $css ) ) {
				$css = '/*SITE BACKGROUND*/#outer-wrap{'. $css .'}';
				$output .= $css;
			}

			// Return output css
			return $output;

		}

	}

}
new WPEX_Site_Backgrounds();
<?php
/**
 * Description : Template for displaying custom header image background. 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependent : http://codex.wordpress.org/Template_Hierarchy
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'Athen_Custom_Header' ) ) {

	class Athen_Custom_Header {

		/**
		 * Main constructor
		 *
		 * @access  public
		 * @since Total 1.6.3
		 */
		public function __construct() {
			add_filter( 'after_setup_theme', array( $this, 'add_support' ) );
			add_filter( 'athen_head_css', array( $this, 'custom_header_css' ), 99 );		
		}

		/**
		 * Retrieves cached CSS or generates the responsive CSS
		 *
		 * @access  public
		 * @return  void
		 * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
		 * @since   1.6.0
		 */
		public function add_support() {

			// Include support for the custom header
			add_theme_support( 'custom-header', apply_filters( 'athen_custom_header_args', array(
				'default-image'			=> '',
				'width'				=> 0,
				'height'			=> 0,
				'flex-width'                    => true,
				'flex-height'			=> true,
				'admin-head-callback'		=> 'athen_admin_header_style',
				'admin-preview-callback'	=> 'athen_admin_header_image',
			) ) );

		}

		/**
		 * Displays header image as a background for the header
		 *
		 * @access  public
		 * @return  void
		 * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
		 * @since   1.6.0
		 */
		public function custom_header_css( $output ) {

			// Add header image as site-header background
			if ( $header_image = get_header_image() ) {
				$output .= '#site-header{background-image:url('. $header_image .');background-size: cover;}';
			}

			return $output;

		}

	}
}
new Athen_Custom_Header();
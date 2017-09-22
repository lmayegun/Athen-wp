<?php
/**
 * Page Animation Functions
 *
 * Description : Class use to modify and create onload page animation
 * 
 * @package     Athen
 * @subpackage  Closer - controller/view
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'Athen_Page_Animations' ) ) {

	class Athen_Page_Animations {

		/**
		 * Main constructor
		 *
		 * @access public
		 * @since  2.1.0
		 */
		public function __construct() {

			// Define main vars
			$this->animate_in  = '';
			$this->animate_out = '';
			$this->enabled     = false;

			// Run animations check
			add_action( 'init', array( &$this, 'get_animations' ) );

			// Add an X-UA-Compatible header
			add_filter( 'wp_headers', array( &$this, 'x_ua_compatible_headers' ) );

			// Open wrapper
			add_action( 'athen_outer_wrap_before', array( &$this, 'open_wrapper' ) );

			// Close wrapper
			add_action( 'athen_outer_wrap_after', array( &$this, 'close_wrapper' ) );
		   
			// Add to localize array
			add_action( 'athen_localize_array', array( &$this, 'localize' ) );

		}

		/**
		 * Retrieves cached CSS or generates the responsive CSS
		 *
		 * @access public
		 * @link   http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
		 * @since  2.1.0
		 */
		public function get_animations() {

			// Get animations
			$this->animate_in  = athen_get_mod( 'page_animation_in' );
			$this->animate_in  = apply_filters( 'athen_page_animation_in', $this->animate_in );
			$this->animate_out = athen_get_mod( 'page_animation_out' );
			$this->animate_out = apply_filters( 'athen_page_animation_out', $this->animate_out );

			// Set enabled to true
			if ( $this->animate_in || $this->animate_out ) {
				$this->enabled = true;
			}
		   
		}

		/**
		 * Localize script
		 *
		 * @access public
		 * @since  2.1.0
		 */
		public function localize( $array ) {

			// Return if disabled
			if ( $this->enabled ) {

				// Set animation to true
				$array['pageAnimation'] = true;

				// Animate In
				if ( $this->animate_in && array_key_exists( $this->animate_in, $this->in_transitions() ) ) {
					$array['pageAnimationIn'] = $this->animate_in;
				}

				// Animate out
				if ( $this->animate_out && array_key_exists( $this->animate_out, $this->out_transitions() ) ) {
					$array['pageAnimationOut'] = $this->animate_out;
				}

				// Animation Speeds
				$array['pageAnimationInDuration']  = 1500;
				$array['pageAnimationOutDuration'] = 1500;

				// Loading text
				$text = athen_get_mod( 'page_animation_loading' );
				$text = $text ? $text : __( 'Loading...', 'athen_transl' );
				$array['pageAnimationLoadingText'] = $text;

			}
	
			// Output opening div
			return $array;

		}

		/**
		 * Open wrapper
		 *
		 * @access public
		 * @since  2.1.0
		 *
		 */
		public function open_wrapper() {
			if ( $this->enabled ) {
				echo '<div class="wpex-page-animation-wrap animsition clr">';
			}
		}

		/**
		 * Close Wrapper
		 *
		 * @access public
		 * @since  2.1.0
		 *
		 */
		public function close_wrapper() {
			if ( $this->enabled ) {
				echo '</div><!-- .animsition -->';
			}
		}

		/**
		 * Add headers for IE to override IE's Compatibility View Settings
		 *
		 * @access public
		 * @since  2.1.0
		 *
		 */
		public function x_ua_compatible_headers( $headers ) {
			if ( $this->enabled && isset( $_SERVER['HTTP_USER_AGENT'] ) && ( strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false ) ) {
				$headers['X-UA-Compatible'] = 'IE=edge,chrome=1';
			}
			return $headers;
		}

		/**
		 * In Transitions
		 *
		 * @access public
		 * @return array
		 *
		 * @since  2.1.0
		 *
		 */
		public static function in_transitions() {
			return array(
				''              => __( 'None', 'athen_transl' ),
				'fade-in'       => __( 'Fade In', 'athen_transl' ),
				'fade-in-up'    => __( 'Fade In Up', 'athen_transl' ),
				'fade-in-down'  => __( 'Fade In Down', 'athen_transl' ),
				'fade-in-left'  => __( 'Fade In Left', 'athen_transl' ),
				'fade-in-right' => __( 'Fade In Right', 'athen_transl' ),
				'rotate-in'     => __( 'Rotate In', 'athen_transl' ),
				'flip-in-x'     => __( 'Flip In X', 'athen_transl' ),
				'flip-in-y'     => __( 'Flip In Y', 'athen_transl' ),
				'zoom-in'       => __( 'Zoom In', 'athen_transl' ),
			);
		}

		/**
		 * Out Transitions
		 *
		 * @access public
		 * @return array
		 *
		 * @since  2.1.0
		 */
		public static function out_transitions() {
			return array(
				''               => __( 'None', 'athen_transl' ),
				'fade-out'       => __( 'Fade Out', 'athen_transl' ),
				'fade-out-up'    => __( 'Fade Out Up', 'athen_transl' ),
				'fade-out-down'  => __( 'Fade Out Down', 'athen_transl' ),
				'fade-out-left'  => __( 'Fade Out Left', 'athen_transl' ),
				'fade-out-right' => __( 'Fade Out Right', 'athen_transl' ),
				'rotate-out'     => __( 'Rotate Out', 'athen_transl' ),
				'flip-out-x'     => __( 'Flip Out X', 'athen_transl' ),
				'flip-out-y'     => __( 'Flip Out Y', 'athen_transl' ),
				'zoom-out'       => __( 'Zoom Out', 'athen_transl' ),
			);
		}

	}

}

$athen_page_transitions = new Athen_Page_Animations();
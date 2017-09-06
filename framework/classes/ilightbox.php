<?php
/**
 * Description : Template for modify iLightbox effect. 
 * 
 * @package     Athen
 * @subpackage  Closer - Controller/View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'Athen_iLightbox' ) ) {
	
	class Athen_iLightbox {

		/**
		 * Main constructor
		 *
		 * @access public
		 * @since  2.1.0
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'register_style_sheets' ), 20 );
		}

		/**
		 * Holds an array of lightbox skins
		 *
		 * @access public
		 * @since  2.1.0
		 */
		public static function skins() {

			$skins = array(
				'minimal'     => __( 'Minimal', 'athen_transl' ),
				'dark'        => __( 'Dark', 'athen_transl' ),
				'light'       => __( 'Light', 'athen_transl' ),
				'mac'         => __( 'Mac', 'athen_transl' ),
				'metro-black' => __( 'Metro Black', 'athen_transl' ),
				'metro-white' => __( 'Metro White', 'athen_transl' ),
				'parade'      => __( 'Parade', 'athen_transl' ),
				'smooth'      => __( 'Smooth', 'athen_transl' ),
			);
			return apply_filters( 'athen_ilightbox_skins', $skins );

		}

		/**
		 * Returns active lightbox skin
		 *
		 * @access public
		 * @since  2.1.0
		 */
		public static function active_skin() {

			// Get skin from Customizer setting
			$skin = athen_get_mod( 'lightbox_skin', 'minimal' );

			// Sanitize
			$skin = $skin ? $skin : 'minimal';
				
			// Apply filters
			$skin = apply_filters( 'athen_lightbox_skin', $skin );

			// Return
			return $skin;

		}

		/**
		 * Returns correct skin stylesheet
		 *
		 * @access public
		 * @since  2.1.0
		 */
		public static function skin_style( $skin = null ) {

			// Sanitize skin
			if ( ! $skin ) {
				$skin = self::active_skin();
			}

			// Loop through skins
			$stylesheet = ATHEN_CSS_DIR_URI .'ilightbox/'. $skin .'/skin.css';

			// Apply filters
			$stylesheet = apply_filters( 'athen_ilightbox_stylesheet', $stylesheet );

			// Return directory uri
			return $stylesheet;

		}

		 /**
		 * Enqueues iLightbox skin stylesheet
		 *
		 * @access public
		 * @since  2.1.0
		 */
		public static function enqueue_style( $skin = null ) {

			// Get default skin if custom skin not defined
			if ( ! $skin ) {
				$skin = self::active_skin();
			}

			// Enqueue stylesheet
			wp_enqueue_style( 'wpex-ilightbox-'. $skin );

		}

		/**
		 * Registers all stylesheets for quick usage
		 *
		 * @access public
		 * @since  2.1.0
		 */
		public function register_style_sheets() {

			// Register stylesheets
			foreach( self::skins() as $key => $val ) {
				wp_register_style( 'wpex-ilightbox-'. $key, $this->skin_style( $key ), false, ATHEN_FRAMEWORK_VERSION );
			}

		}

		/**
		 * Loads the stylesheet
		 *
		 * @access public
		 * @since  2.1.0
		 */
		public function load_css() {
			self::enqueue_style();
		}

	}

}
new Athen_iLightbox();


/* Helper functions
-------------------------------------------------------------------------------*/

/**
 * Returns array of ilightbox Skins
 *
 * @since   2.0.0
 * @return  array
 */
function athen_ilightbox_skins() {
	return Athen_iLightbox::skins();
}

/**
 * Returns lightbox skin
 *
 * @return  $skin
 * @since   Total 1.3.3
 */
function athen_ilightbox_skin() {
	return Athen_iLightbox::active_skin();
}

/**
 * Returns lightbox skin stylesheet
 *
 * @return  $skin
 * @since   Total 1.3.3
 */
function athen_ilightbox_stylesheet( $skin = null ) {
	return Athen_iLightbox::skin_style( $skin );
}

/**
 * Enqueues lightbox stylesheet
 *
 * @return  $skin
 * @since   Total 1.3.3
 */
function athen_enqueue_ilightbox_skin( $skin = null ) {
	return Athen_iLightbox::enqueue_style( $skin );
}

/**
 * Echo lightbox image URL
 *
 * @since   2.0.0
 * @return  string
 */
function athen_lightbox_image( $attachment = '' ) {
	echo athen_get_lightbox_image( $attachment );
}

/**
 * Returns lightbox image URL.
 *
 * @since   2.0.0
 * @return  string
 */
function athen_get_lightbox_image( $attachment = '' ) {

	// If attachment is empty lets set it to the post thumbnail id
	if ( ! $attachment ) {
		$attachment = get_post_thumbnail_id();
	}

	// Set default size
	$size = apply_filters( 'athen_get_lightbox_image_size', 'large' );

	// If the attachment is an ID lets get the URL
	if ( is_numeric( $attachment ) ) {
		$image = wp_get_attachment_image_src( $attachment, $size );
	} elseif ( is_array( $attachment ) ) {
		$image = $attachment[0];
	} else {
		$image = $attachment;
	}

	// Sanitize data
	if ( ! empty( $image[0] ) ) {
		$image = $image[0];
	} else {
		$image = wp_get_attachment_url( $attachment );   
	}

	// Return escaped image
	return esc_url( $image );
}
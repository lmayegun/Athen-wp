<?php
/**
 * Description : Class to configure and modify wpml plugin. 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

if ( ! class_exists( 'Athen_WPML_Config' ) ) {

	class Athen_WPML_Config {

		/**
		 * Start things up
		 *
		 * @since 1.6.0
		 */
		public function __construct() {

			// Register strings for translation
			add_action( 'admin_init', array( &$this, 'register_strings' ) );

			// Fix for when users have the Language URL Option on "different domains"
			add_filter( 'upload_dir', array( &$this, 'convert_base_url' ) );

			// Converts toggle page ID to WPML compatible ID
			add_filter( 'athen_toggle_bar_content_id', array( &$this, 'toggle_bar_content_id' ) );

		}

		/**
		 * Registers theme_mod strings into WPML
		 *
		 * @since 1.6.0
		 */
		public function register_strings() {

			// Make sure strings translation plugin is active
			if ( ! function_exists( 'icl_register_string' ) ) {
				return;
			}
			
			// Array of strings to translate
			$strings = array(
				'custom_logo'				=> false,
				'retina_logo'				=> false,
				'retina_logo_height'		=> false,
				'error_page_title'			=> '404: Page Not Found',
				'error_page_text'			=> false,
				'top_bar_content'			=> '[font_awesome icon="phone" margin_right="5px" color="#000"] 1-800-987-654 [font_awesome icon="envelope" margin_right="5px" margin_left="20px" color="#000"] admin@total.com [font_awesome icon="user" margin_right="5px" margin_left="20px" color="#000"] [wp_login_url text="User Login" logout_text="Logout"]',
				'top_bar_social_alt'		=> false,
				'header_aside'				=> false,
				'breadcrumbs_home_title'	=> false,
				'blog_entry_readmore_text'	=> 'Read More',
				'social_share_heading'		=> 'Please Share This',
				'portfolio_related_title'	=> 'Related Projects',
				'staff_related_title'		=> 'Related Staff',
				'blog_related_title'		=> 'Related Posts',
				'callout_text'				=> 'I am the footer call-to-action block, here you can add some relevant/important information about your company or product. I can be disabled in the theme options.',
				'callout_link'				=> 'http://www.wpexplorer.com',
				'callout_link_txt'			=> 'Get In Touch',
				'footer_copyright_text'		=> 'Copyright <a href="#">Your Business LLC.</a> - All Rights Reserved',
				'woo_shop_single_title'		=> false,
				'woo_menu_icon_custom_link'	=> '',
			);

			// Register strings
			foreach( $strings as $string => $default ) {
				icl_register_string( 'Theme Mod', $string, get_theme_mod( $string, $default ) );
			}

		}

		/**
		 * Fix for when users have the Language URL Option on "different domains"
		 * which causes cropped images to fail.
		 * Runs if 'WPML_SUNRISE_MULTISITE_DOMAINS' constant is defined
		 *
		 * @since 1.6.0
		 */
		public function convert_base_url( $param ) {

			// Check if WPML is set to multisite domains
			if ( defined( 'WPML_SUNRISE_MULTISITE_DOMAINS' ) ) {
				global $sitepress;
				if ( $sitepress ) {
					// Convert upload directory base URL to correct language 
					$param['baseurl'] = $sitepress->convert_url( $param['baseurl'] );
				}
			}

			// Return param
			return $param;

		}

		/**
		 * Converts toggle page ID to WPML compatible ID
		 *
		 * @since 1.6.0
		 */
		public function toggle_bar_content_id( $id ) {

			// Make sure function exists
			if ( ! function_exists( 'icl_object_id' ) ) {
				return;
			}

			// Convert ID to WPML compatible ID
			if ( ICL_LANGUAGE_CODE ) {
				$id = icl_object_id( $id, 'page', false, ICL_LANGUAGE_CODE );
			}

			// Return ID
			return $id;

		}

	}
	
}
new Athen_WPML_Config();
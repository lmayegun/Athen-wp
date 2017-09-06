<?php
/**
 * Neat Skin Class
 *
 * @package     Total
 * @subpackage  Skins
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.3.0
 * @version     2.1.0
 */


if ( ! class_exists( 'Total_Neat_Skin' ) ) {
	
	class Total_Neat_Skin {

		/**
		 * Main constructor.
		 *
		 * @since   1.3.0
		 * @access  public
		 */
		public function __construct() {

			// Load skin CSS
			add_action( 'wp_enqueue_scripts', array( &$this, 'load_styles' ), 999 );

			// Add accent colors
			add_filter( 'athen_accent_backgrounds', array( &$this, 'accent_backgrounds' ) );
			add_filter( 'athen_accent_texts', array( &$this, 'accent_texts' ) );

		}

		/**
		 * Load custom stylesheet for this skin.
		 *
		 * @since   1.3.0
		 * @access  public
		 *
		 * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
		 * @link    http://codex.wordpress.org/Function_Reference/wp_enqueue_style
		 */
		public function load_styles() {
			wp_enqueue_style( 'wpex-neat-skin', ATHEN_SKIN_DIR_URI .'classes/neat/css/neat-style.css', array( 'wpex-style' ), '1.0', 'all' );
		}

		/**
		 * Adds background accents for this skin
		 *
		 * @since   2.1.0
		 * @access  public
		 */
		public function accent_backgrounds( $backgrounds ) {
			$new = array(
				'#top-bar-wrap',
				'.vcex-filter-links a:hover',
				'.vcex-filter-links li.active a',
				'.vcex-navbar.style-buttons a:hover',
				'.vcex-navbar.style-buttons a.active',
				'.page-numbers a:hover',
				'.page-numbers.current',
				'.page-numbers.current:hover',
				'.woocommerce nav.woocommerce-pagination ul li a:focus',
				'.woocommerce nav.woocommerce-pagination ul li a:hover',
				'.woocommerce nav.woocommerce-pagination ul li span.current',
			);
			$backgrounds = array_merge( $new, $backgrounds );
			return $backgrounds;
		}


		/**
		 * Adds color accents for this skin
		 *
		 * @since   2.1.0
		 * @access  public
		 */
		public function accent_texts( $texts ) {
			$new = array(
				'#site-navigation .dropdown-menu > li.sfHover > a',
				'#site-navigation .dropdown-menu > li > a:hover',
				'#site-navigation .dropdown-menu a:hover',
				'#site-navigation .dropdown-menu > .current-menu-parent > a',
				'#site-navigation .dropdown-menu > .current-menu-item > a',
			);
			$texts = array_merge( $new, $texts );
			return $texts;
		}

	}

}
new Total_Neat_Skin();
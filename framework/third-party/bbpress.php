<?php
/**
 * bbPress Configuration Class
 *
 * @package		Total
 * @subpackage	Framework
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link 		http://www.wpexplorer.com
 * @since		2.1.0
 * @version		2.1.0
 */

if ( ! class_exists( 'WPEX_BBpress_Config' ) ) {

	class WPEX_BBpress_Config {

		/**
		 * Start things up
		 *
		 * @access public
		 * @since  2.1.0
		 */
		public function __construct() {

			// Load custom CSS for bbPress
			add_action( 'wp_enqueue_scripts', array( &$this, 'styles' ) );

			// Add a bbPress sidebar
			add_filter( 'widgets_init', array( &$this, 'register_sidebar' ), 10 );

			// Alter main sidebar to display bbPress sidebar
			add_filter( 'athen_get_sidebar', array( &$this, 'display_sidebar' ), 10 );

		}

		/**
		 * Load custom CSS for bbPress
		 *
		 * @access public
		 * @since  2.1.0
		 */
		public function styles( $id ) {

			if ( is_bbpress() ) {
				wp_enqueue_style( 'wpex-bbpress', ATHEN_CSS_DIR_URI .'wpex-bbpress.css', array( 'bbp-default' ), '2.0.0' );
			}

		}

		/**
		 * Registers a bbpress_sidebar widget area
		 *
		 * @access public
		 * @since  2.1.0
		 */
		public function register_sidebar() {

			// Return if custom sidebar is disabled
			if ( ! athen_get_mod( 'bbpress_custom_sidebar', true ) ) {
				return;
			}

			// Get correct heading tag
			$heading_tag = athen_get_mod( 'sidebar_headings', 'div' );
			$heading_tag = $heading_tag ? $heading_tag : 'div';

			// Register new bbpress_sidebar
			register_sidebar( array (
				'name'          => __( 'bbPress Sidebar', 'athen_transl' ),
				'id'            => 'bbpress_sidebar',
				'before_widget' => '<div class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. $heading_tag .' class="widget-title">',
				'after_title'   => '</'. $heading_tag .'>',
			) );
		}

		/**
		 * Alter main sidebar to display bbpress_sidebar sidebar
		 *
		 * @access public
		 * @since  2.1.0
		 */
		public function display_sidebar( $sidebar ) {
			if ( is_bbpress() && athen_get_mod( 'bbpress_custom_sidebar', true ) ) {
				$sidebar = 'bbpress_sidebar';
			}
			return $sidebar;
		}

	}
	
}
new WPEX_BBpress_Config();
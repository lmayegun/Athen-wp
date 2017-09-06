<?php
/**
 * Description : Class to configure tribe event plugin. 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'Athen_Tribe_Events_Config' ) ) {

	class Athen_Tribe_Events_Config {

		/**
		 * Start things up
		 *
		 * @since 2.0.0
		 */
		public function __construct() {

			// Load custom stylesheet for tweaks
			add_action( 'wp_enqueue_scripts', array( &$this, 'load_custom_stylesheet' ), 10 );

			// Alter the post layouts for all events
			add_filter( 'athen_post_layout_class', array( &$this, 'layouts' ), 10 );

			// Add the Page Settings metabox to the events calendar
			add_filter( 'athen_main_metaboxes_post_types', array( &$this, 'metaboxes' ), 10 );

			// Alter the page header title
			add_filter( 'athen_title', array( &$this, 'page_header_title' ), 10 );

			// Add a tribe events sidebar
			add_filter( 'widgets_init', array( &$this, 'register_events_sidebar' ), 10 );

			// Alter main sidebar to display events sidebar
			add_filter( 'athen_get_sidebar', array( &$this, 'display_events_sidebar' ), 10 );

			// Disable single next/prev
			add_filter( 'athen_has_next_prev', array( &$this, 'next_prev' ) );

			// Add accent colors
			add_filter( 'athen_accent_backgrounds', array( &$this, 'accent_backgrounds' ) );

		}

		/**
		 * Load custom CSS file for tweaks
		 *
		 * @since 2.0.0
		 */
		public function load_custom_stylesheet() {
			$obj = athen_global_obj();
			if ( 'base' == $obj->skin || ! $obj->skin ) {
				wp_enqueue_style( 'wpex-tribe-events', ATHEN_CSS_DIR_URI .'wpex-tribe-events.css' );
			}
		}

		/**
		 * Alter the post layouts for all events
		 *
		 * @since 2.0.0
		 */
		public function layouts( $class ) {

			// Return full-width for event posts and archives
			if ( $this->is_tribe_events() ) {
				$class = 'full-width';
			}

			// Return class
			return $class;

		}

		/**
		 * Add the Page Settings metabox to the events calendar
		 *
		 * @since 2.0.0
		 */
		public function metaboxes( $types ) {
			$types[] = 'tribe_events';
			return $types;
		}

		/**
		 * Alter the main page header title text for tribe events
		 *
		 * @since 2.0.0
		 */
		public function page_header_title( $title ) {

			// Fixes issue with search results
			if ( is_search() ) {
				return $title;
			}

			// Customize title for event pages
			if ( tribe_is_event_category() ) {
				$title = get_the_archive_title();
			} elseif ( tribe_is_month() ) {
				$title = __( 'Events Calendar', 'athen_transl' );
			} elseif ( tribe_is_event() && ! tribe_is_day() && ! is_single() ) {
				$title = __( 'Events List', 'athen_transl' );
			} elseif ( tribe_is_event() && ! tribe_is_day() && is_single() ) {
				$title = '<span>'. __( 'Event:', 'athen_transl' ) .'</span> '. get_the_title();
			} elseif ( tribe_is_day() ) {
				$title = __( 'Single Day', 'athen_transl' );
			}

			// Return title
			return $title;

		}

		/**
		 * Register a new events sidebar area
		 *
		 * @since 2.0.0
		 */
		public function register_events_sidebar() {
			$headings   = athen_get_mod( 'sidebar_headings', 'div' );
			$headings   = $headings ? $headings : 'div';
			register_sidebar( array (
				'name'          => __( 'Events Sidebar', 'athen_transl' ),
				'id'            => 'tribe_events_sidebar',
				'before_widget' => '<div class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. $headings .' class="widget-title">',
				'after_title'   => '</'. $headings .'>',
			) );
		}

		/**
		 * Alter main sidebar to display events sidebar
		 *
		 * @since 2.0.0
		 */
		public function display_events_sidebar( $sidebar ) {
			if ( $this->is_tribe_events() && is_active_sidebar( 'tribe_events_sidebar' ) ) {
				$sidebar = 'tribe_events_sidebar';
			}
			return $sidebar;
		}

		/**
		 * Helper function checks if we are currently on an events page/post/archive
		 *
		 * @since 2.0.0
		 */
		public function is_tribe_events() {
			if ( is_search() ) {
				return false;
			}
			if ( tribe_is_event()
				|| tribe_is_event_category()
				|| tribe_is_in_main_loop()
				|| tribe_is_view()
				|| is_singular( 'tribe_events' ) ) {
				return true;
			}
		}

		/**
		 * Disables the next/previous links for tribe events because they already have some.
		 *
		 * @since   2.0.0
		 * @access  public
		 * @return  bool
		 */
		public function next_prev( $return ) {
			if ( is_singular( 'tribe_events' ) ) {
				$return = false;
			}
			return $return;
		}

		/**
		 * Adds background accents for tribe events
		 *
		 * @since   2.1.0
		 * @access  public
		 */
		public function accent_backgrounds( $backgrounds ) {
			$new = array(
				'#tribe-events .tribe-events-button',
				'#tribe-events .tribe-events-button:hover',
				'#tribe_events_filters_wrapper input[type=submit]',
				'.tribe-events-button',
				'.tribe-events-button.tribe-active:hover',
				'.tribe-events-button.tribe-inactive',
				'.tribe-events-button:hover',
				'.tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]',
				'.tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]>a',
			);
			$backgrounds = array_merge( $new, $backgrounds );
			return $backgrounds;
		}

	}

}
new Athen_Tribe_Events_Config();